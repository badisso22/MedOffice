<?php
header('Content-Type: application/json');
session_start();
require("../config/config.php");

require __DIR__ . '/../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$requestId  = isset($_POST['request_id']) ? (int)$_POST['request_id'] : 0;
$approvedBy = $_SESSION['userID'] ?? null;

if ($requestId <= 0) {
    echo json_encode(['success' => false, 'error' => 'Invalid request ID.']);
    exit;
}

$stmt = $conn->prepare("
    SELECT requestID, name, email, message, status
    FROM Requests
    WHERE requestID = ?
");
$stmt->bind_param("i", $requestId);
$stmt->execute();
$result  = $stmt->get_result();
$request = $result->fetch_assoc();
$stmt->close();

if (!$request || $request['status'] !== 'pending') {
    echo json_encode(['success' => false, 'error' => 'Request not found or already processed.']);
    exit;
}

$update = $conn->prepare("
    UPDATE Requests
    SET status = 'approved',
        approved_by = ?,
        approved_at = NOW(),
        updated_at  = NOW()
    WHERE requestID = ? AND status = 'pending'
");
$update->bind_param("ii", $approvedBy, $requestId);

if (!$update->execute() || $update->affected_rows === 0) {
    echo json_encode(['success' => false, 'error' => 'Could not update request.']);
    $update->close();
    exit;
}
$update->close();

try {
    $mail = new PHPMailer(true);

 
    $mail->isSMTP();
$mail->Host       = env('MAIL_HOST', 'sandbox.smtp.mailtrap.io');
$mail->SMTPAuth   = true;
$mail->Username   = env('MAIL_USERNAME');
$mail->Password   = env('MAIL_PASSWORD');
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port       = (int) env('MAIL_PORT', 587);

$mail->setFrom(env('MAIL_FROM_ADDRESS', 'badiso@med-office.com'),env('MAIL_FROM_NAME', 'MedOffice Onboarding'));
$mail->addReplyTo(env('MAIL_FROM_ADDRESS', 'badiso@med-office.com'),env('MAIL_FROM_NAME', 'MedOffice Onboarding'));


    $mail->addAddress($request['email'], $request['name']);

    $mail->isHTML(true);
    $mail->Subject = 'Your MedOffice cabinet request is approved';

    $createLink = 'http://localhost/MedOffice/cabinet_onboarding.php?email=' . urlencode($request['email']);

    $safeName = htmlspecialchars($request['name'], ENT_QUOTES, 'UTF-8');
    $safeLink = htmlspecialchars($createLink, ENT_QUOTES, 'UTF-8');

    $mail->Body = "
<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>MedOffice – Cabinet Approved</title>
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
                                    <td align=\"right\" style=\"font-size:0.8rem;color:#64748b;\">Cabinet onboarding</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"padding:24px 28px 8px;\">
                            <p style=\"font-size:0.9rem;color:#0f172a;margin:0 0 8px;\">Hello <strong>$safeName</strong>,</p>
                            <h1 style=\"font-size:1.4rem;margin:4px 0 10px;color:#0f172a;\">Your cabinet request has been approved 🎉</h1>
                            <p style=\"font-size:0.94rem;color:#475569;margin:0 0 16px;line-height:1.6;\">
                                Thank you for choosing <strong>MedOffice</strong>. Your request to create a cabinet has been approved
                                and your workspace is ready to be set up.
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
                                <strong>Next step:</strong> Create your cabinet and admin account in a quick 3-step wizard.
                            </div>

                            <p style=\"margin:16px 0 18px;font-size:0.95rem;color:#1f2937;\">
                                Click the button below to open your onboarding page and start configuring your cabinet.
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
                                    Start your cabinet setup
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
                                If you did not request a cabinet, please ignore this message.
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

    $mail->AltBody = "Hello {$request['name']},\n\n"
        . "Your request to create a cabinet on MedOffice has been approved.\n\n"
        . "Open this link to start your setup: {$createLink}\n\n"
        . "Best regards,\nMedOffice Team\nFrom: badiso@med-office.com";

    $mail->send();

    echo json_encode(['success' => true, 'message' => 'Request approved and email sent.']);
} catch (Exception $e) {
    echo json_encode([
        /*'success' => false,
        'error'   => 'Mailer error: ' . $mail->ErrorInfo*/
        'success' => true,
        'message' => 'Request approved, but email could not be sent.',
        'email_error' => $mail->ErrorInfo
    ]);
}
