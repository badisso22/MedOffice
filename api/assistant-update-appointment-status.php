<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'message' => '', 'errors' => []];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    if (!isset($_SESSION['roleID']) || (int)$_SESSION['roleID'] !== 4) {
        throw new Exception('Unauthorized');
    }

    if (!isset($_SESSION['cabinetID'])) {
        throw new Exception('No cabinet context');
    }

    $cabinetID = (int)$_SESSION['cabinetID'];

    $raw   = file_get_contents('php://input');
    $input = json_decode($raw, true);

    $appointmentID = isset($input['appointmentId']) ? (int)$input['appointmentId'] : 0;
    $action        = isset($input['action']) ? trim($input['action']) : '';

    if (!$appointmentID || !in_array($action, ['accept', 'decline'], true)) {
        throw new Exception('Invalid request');
    }

    $newStatus = $action === 'accept' ? 'accepted' : 'declined';

    $sql = "
      UPDATE Appointments 
      SET status = ? 
      WHERE appointmentID = ? 
        AND cabinetID = ? 
        AND status = 'pending'
      LIMIT 1
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sii', $newStatus, $appointmentID, $cabinetID);
    $stmt->execute();

    if ($stmt->affected_rows === 0) {
        throw new Exception('Appointment not found or already processed');
    }

    $stmt->close();

    $response['success'] = true;
    $response['message'] = "Appointment {$newStatus}";
    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
