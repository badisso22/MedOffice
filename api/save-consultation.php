<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

require __DIR__ . '/../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$response = ['success' => false, 'message' => '', 'errors' => []];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    $raw   = file_get_contents('php://input');
    $input = json_decode($raw, true);

    $appointmentID    = isset($input['appointmentID']) ? (int)$input['appointmentID'] : 0;
    $patientID        = isset($input['patientID']) ? (int)$input['patientID'] : 0;
    $consultationType = isset($input['consultationType']) ? trim($input['consultationType']) : '';
    $consultationDate = isset($input['consultationDate']) ? trim($input['consultationDate']) : '';
    $symptoms         = isset($input['symptoms']) ? trim($input['symptoms']) : '';
    $diagnosis        = isset($input['diagnosis']) ? trim($input['diagnosis']) : '';
    $treatmentPlan    = isset($input['treatmentPlan']) ? trim($input['treatmentPlan']) : '';
    $additionalNotes  = isset($input['additionalNotes']) ? trim($input['additionalNotes']) : '';
    $medicalFees      = isset($input['medicalFees']) ? (float)$input['medicalFees'] : 0;

    $nextAppointment = date('Y-m-d', strtotime('+1 month'));

    if (
        !$patientID || !$consultationType || !$consultationDate ||
        !$symptoms || !$diagnosis || !$treatmentPlan || !$additionalNotes
    ) {
        throw new Exception('Missing required fields');
    }

    $sql = "
        INSERT INTO PatientConsultationInfo 
        (PatientID, consultationdate, consultationtype, symptoms, diagnosis, treatmentplan, additionalnotes, nextappointment, medicalfees) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        'isssssssd',
        $patientID,
        $consultationDate,
        $consultationType,
        $symptoms,
        $diagnosis,
        $treatmentPlan,
        $additionalNotes,
        $nextAppointment,
        $medicalFees
    );
    $stmt->execute();
    $consultationID = $stmt->insert_id;
    $stmt->close();

    $sqlUpdate = "UPDATE Appointments SET status = 'completed', consultationID = ? WHERE appointmentID = ?";
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param('ii', $consultationID, $appointmentID);
    $stmt->execute();
    $stmt->close();

    $stmt = $conn->prepare("
        SELECT 
            p.firstname,
            p.lastname,
            u.email
        FROM PatientTable p
        LEFT JOIN Users u ON u.userID = p.userID
        WHERE p.patientID = ?
        LIMIT 1
    ");
    $stmt->bind_param('i', $patientID);
    $stmt->execute();
    $pat = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!empty($pat['email'])) {
        $patientName  = trim(($pat['firstname'] ?? '') . ' ' . ($pat['lastname'] ?? ''));
        $patientEmail = $pat['email'];

        $feedbackLink = 'http://localhost/MedOffice/Patient/feedback.php?consultationID=' . urlencode((string)$consultationID);

        $safeName = htmlspecialchars($patientName, ENT_QUOTES, 'UTF-8');
        $safeLink = htmlspecialchars($feedbackLink, ENT_QUOTES, 'UTF-8');
        $safeDate = htmlspecialchars($consultationDate, ENT_QUOTES, 'UTF-8');
        $safeType = htmlspecialchars($consultationType, ENT_QUOTES, 'UTF-8');

        try {
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host       = env('MAIL_HOST', 'sandbox.smtp.mailtrap.io');
            $mail->SMTPAuth   = true;
            $mail->Username   = env('MAIL_USERNAME');
            $mail->Password   = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = (int) env('MAIL_PORT', 587);

            $mail->setFrom(
                env('MAIL_FROM_ADDRESS', 'badiso@med-office.com'),
                env('MAIL_FROM_NAME', 'MedOffice')
            );
            $mail->addReplyTo(
                env('MAIL_FROM_ADDRESS', 'badiso@med-office.com'),
                env('MAIL_FROM_NAME', 'MedOffice')
            );

            $mail->addAddress($patientEmail, $patientName);

            $mail->isHTML(true);
            $mail->Subject = 'How was your recent visit at MedOffice?';

            $mail->Body = "
<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>MedOffice – Visit Feedback</title>
</head>
<body style=\"margin:0;padding:0;background:#f8fafc;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;color:#0f172a;\">
    <table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"background:#f8fafc;padding:24px 0;\">
        <tr>
            <td align=\"center\">
                <table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width:640px;background:#ffffff;border-radius:16px;box-shadow:0 10px 30px rgba(15,23,42,0.12);overflow:hidden;\">
                    <tr>
                        <td style=\"padding:20px 28px 16px;border-bottom:1px solid #e2e8f0;\">
                            <table width=\"100%\">
                                <tr>
                                    <td style=\"font-size:1.25rem;font-weight:700;color:#0891b2;display:flex;align-items:center;gap:8px;\">
                                        <span style=\"
                                            width:36px;height:36px;border-radius:10px;
                                            background:linear-gradient(135deg,#0891b2 0%,#06b6d4 100%);
                                            display:inline-flex;align-items:center;justify-content:center;
                                            color:#ffffff;font-size:1.35rem;
                                        \">⚕</span>
                                        MedOffice
                                    </td>
                                    <td align=\"right\" style=\"font-size:0.8rem;color:#64748b;\">Patient feedback</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"padding:24px 28px 8px;\">
                            <p style=\"font-size:0.9rem;color:#0f172a;margin:0 0 8px;\">Hello <strong>$safeName</strong>,</p>
                            <h1 style=\"font-size:1.4rem;margin:4px 0 10px;color:#0f172a;\">How was your recent visit?</h1>
                            <p style=\"font-size:0.94rem;color:#475569;margin:0 0 16px;line-height:1.6;\">
                                You recently had a consultation on <strong>$safeDate</strong> for <strong>$safeType</strong> at MedOffice.
                                Your feedback helps us improve the quality of care we provide.
                            </p>

                            <div style=\"
                                margin:18px 0;
                                padding:14px 16px;
                                border-radius:12px;
                                background:linear-gradient(135deg,#ecfeff 0%,#cffafe 100%);
                                border:1px solid rgba(8,145,178,0.25);
                                color:#0e7490;
                                font-size:0.9rem;
                            \">
                                <strong>It only takes a minute:</strong> Share your experience with your doctor and our clinic.
                            </div>

                            <p style=\"margin:16px 0 18px;font-size:0.95rem;color:#1f2937;\">
                                Click the button below to open your feedback form.
                            </p>

                            <p style=\"margin:0 0 22px;\">
                                <a href=\"$safeLink\"
                                   style=\"
                                        display:inline-block;
                                        padding:10px 22px;
                                        border-radius:999px;
                                        background:linear-gradient(135deg,#0891b2 0%,#06b6d4 100%);
                                        color:#ffffff;
                                        text-decoration:none;
                                        font-weight:600;
                                        font-size:0.95rem;
                                        box-shadow:0 4px 14px rgba(8,145,178,0.35);
                                   \">
                                    Leave your feedback
                                </a>
                            </p>

                            <p style=\"font-size:0.8rem;color:#64748b;margin:0 0 4px;\">
                                Or paste this link into your browser:
                            </p>
                            <p style=\"font-size:0.8rem;color:#0f172a;background:#f1f5f9;border-radius:8px;padding:8px 10px;word-break:break-all;\">
                                $safeLink
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"padding:16px 28px 8px;border-top:1px solid #e2e8f0;background:#f9fafb;\">
                            <p style=\"font-size:0.8rem;color:#64748b;margin:0 0 4px;\">
                                Best regards,<br>
                                <strong>MedOffice Team</strong>
                            </p>
                            <p style=\"font-size:0.75rem;color:#94a3b8;margin:10px 0 0;\">
                                This email was sent from <a href=\"mailto:badiso@med-office.com\" style=\"color:#0891b2;text-decoration:none;\">badiso@med-office.com</a>.
                                If you did not have a recent consultation, please ignore this message.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
";

            $mail->AltBody = "Hello {$patientName},\n\n"
                . "Thank you for your consultation on {$consultationDate} for {$consultationType} at MedOffice.\n"
                . "We would love to hear your feedback.\n\n"
                . "Open this link to fill out your feedback form: {$feedbackLink}\n\n"
                . "Best regards,\nMedOffice Team\nFrom: badiso@med-office.com";

            $mail->send();
        } catch (Exception $eMail) {
            error_log('Feedback mail error: ' . $eMail->getMessage());
        }
    }

    $response['success'] = true;
    $response['message'] = 'Consultation record saved and appointment completed';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
