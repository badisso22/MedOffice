<?php
session_start();
require '../config/config.php';
header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'errors' => []];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    if (empty($_SESSION['loggedIn']) || !isset($_SESSION['userID'], $_SESSION['cabinetID']) || $_SESSION['roleID'] != 5) {
        throw new Exception('Unauthorized');
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method');
    }

    $userID    = (int)$_SESSION['userID'];
    $cabinetID = (int)$_SESSION['cabinetID'];

    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true);

    if (!is_array($data)) {
        throw new Exception('Invalid payload');
    }

    $appointmentID = isset($data['appointmentID']) ? (int)$data['appointmentID'] : 0;
    $reason        = isset($data['reason']) ? trim($data['reason']) : '';
    $comments      = isset($data['comments']) ? trim($data['comments']) : '';

    if ($appointmentID <= 0) {
        throw new Exception('Invalid appointment ID');
    }
    if ($reason === '') {
        throw new Exception('Cancellation reason is required');
    }

    $sql = "SELECT patientID FROM PatientTable WHERE userID = ? AND cabinetID = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $userID, $cabinetID);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$row) {
        throw new Exception('Patient not found for this account');
    }

    $patientID = (int)$row['patientID'];

    $sql = "
      UPDATE Appointments
      SET status = 'cancelled'
      WHERE appointmentID = ?
        AND patientID = ?
        AND cabinetID = ?
        AND status IN ('pending','accepted')
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $appointmentID, $patientID, $cabinetID);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $stmt->close();
        throw new Exception('This appointment cannot be cancelled (maybe already completed or cancelled).');
    }
    $stmt->close();


    $response['success'] = true;

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
