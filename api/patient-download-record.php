<?php
session_start();
require '../config/config.php';

if (!$conn instanceof mysqli) {
    http_response_code(500);
    echo 'DB error';
    exit;
}

if (
    empty($_SESSION['loggedIn']) ||
    !isset($_SESSION['userID'], $_SESSION['roleID'], $_SESSION['activeCabinetID']) ||
    (int)$_SESSION['roleID'] !== 5
) {
    http_response_code(401);
    echo 'Unauthorized';
    exit;
}

$consultationID = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($consultationID <= 0) {
    http_response_code(400);
    echo 'Invalid record ID';
    exit;
}

$userID    = (int)$_SESSION['userID'];
$cabinetID = (int)$_SESSION['activeCabinetID'];
if ($cabinetID <= 0) {
    http_response_code(400);
    echo 'Cabinet ID not found';
    exit;
}

$sql = "
    SELECT patientID, firstname, lastname 
    FROM PatientTable 
    WHERE userID = ? AND cabinetID = ? 
    LIMIT 1
";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $userID, $cabinetID);
$stmt->execute();
$patientRow = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$patientRow) {
    http_response_code(404);
    echo 'Patient not found';
    exit;
}

$patientID   = (int)$patientRow['patientID'];
$patientName = $patientRow['firstname'] . ' ' . $patientRow['lastname'];

$sql = "
    SELECT 
        consultationID,
        consultationdate,
        consultationtype,
        symptoms,
        diagnosis,
        treatmentplan,
        additionalnotes,
        nextappointment,
        medicalfees
    FROM PatientConsultationInfo
    WHERE consultationID = ? 
      AND PatientID = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $consultationID, $patientID);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
$stmt->close();

if (!$row) {
    http_response_code(404);
    echo 'Record not found';
    exit;
}

$title    = $row['diagnosis'] ?: $row['consultationtype'] ?: 'Medical Record';
$date     = $row['consultationdate'];
$type     = $row['consultationtype'];
$symptoms = $row['symptoms'];
$diag     = $row['diagnosis'];
$treat    = $row['treatmentplan'];
$notes    = $row['additionalnotes'];
$next     = $row['nextappointment'];
$fees     = $row['medicalfees'];

$filename = 'record_' . $consultationID . '.html';

header('Content-Type: text/html; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

echo '<!DOCTYPE html><html><head><meta charset="utf-8"><title>'
    . htmlspecialchars($title, ENT_QUOTES, 'UTF-8')
    . '</title></head><body>';

echo '<h1>' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</h1>';
echo '<p><strong>Patient:</strong> ' . htmlspecialchars($patientName, ENT_QUOTES, 'UTF-8') . '</p>';
echo '<p><strong>Date:</strong> ' . htmlspecialchars($date, ENT_QUOTES, 'UTF-8') . '</p>';
echo '<p><strong>Type:</strong> ' . htmlspecialchars($type, ENT_QUOTES, 'UTF-8') . '</p>';
echo '<p><strong>Next appointment:</strong> ' . htmlspecialchars($next, ENT_QUOTES, 'UTF-8') . '</p>';
echo '<p><strong>Medical fees:</strong> ' . htmlspecialchars((string)$fees, ENT_QUOTES, 'UTF-8') . '</p>';

echo '<h2>Symptoms</h2><p>' . nl2br(htmlspecialchars($symptoms, ENT_QUOTES, 'UTF-8')) . '</p>';
echo '<h2>Diagnosis</h2><p>' . nl2br(htmlspecialchars($diag, ENT_QUOTES, 'UTF-8')) . '</p>';
echo '<h2>Treatment plan</h2><p>' . nl2br(htmlspecialchars($treat, ENT_QUOTES, 'UTF-8')) . '</p>';
echo '<h2>Additional notes</h2><p>' . nl2br(htmlspecialchars($notes, ENT_QUOTES, 'UTF-8')) . '</p>';

echo '</body></html>';
