<?php
header('Content-Type: application/json');
session_start();
require("../config/config.php");

require __DIR__ . '/../vendor/autoload.php'; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$requestId = isset($_POST['request_id']) ? (int)$_POST['request_id'] : 0;
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
$result = $stmt->get_result();
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
    $mail->Host       = 'smtp.yourdomain.com';   
    $mail->SMTPAuth   = true;
    $mail->Username   = 'no-reply@yourdomain.com';
    $mail->Password   = 'your_smtp_password';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('no-reply@yourdomain.com', 'MedOffice');
    $mail->addAddress($request['email'], $request['name']);

    $mail->isHTML(true);
    $mail->Subject = 'Your MedOffice cabinet request has been approved';

    $createLink = 'https://your-domain.com/create-cabinet?email=' . urlencode($request['email']);

    $mail->Body = "
        <h2>Hello {$request['name']},</h2>
        <p>Your request to create a cabinet on <strong>MedOffice</strong> has been <strong>approved</strong>.</p>
        <p>You can now start creating your cabinet by clicking the button below:</p>
        <p>
            <a href=\"{$createLink}\" 
               style=\"display:inline-block;padding:10px 18px;background:#2563eb;color:#fff;
                      text-decoration:none;border-radius:4px;font-weight:bold;\">
                Create your cabinet
            </a>
        </p>
        <p>If the button does not work, copy and paste this link into your browser:</p>
        <p><code>{$createLink}</code></p>
        <p>Best regards,<br>MedOffice Team</p>
    ";

    $mail->AltBody = "Hello {$request['name']},\n\n".
        "Your request to create a cabinet on MedOffice has been approved.\n\n".
        "Open this link to start: {$createLink}\n\n".
        "Best regards,\nMedOffice Team";

    $mail->send();

    echo json_encode(['success' => true, 'message' => 'Request approved and email sent.']);
} catch (Exception $e) {
    echo json_encode([
        'success' => true,
        'message' => 'Request approved, but email could not be sent.',
        'email_error' => $mail->ErrorInfo
    ]);
}
