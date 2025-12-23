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

    $raw = file_get_contents('php://input');
    $input = json_decode($raw, true);

    $appointmentID = isset($input['id']) ? (int)$input['id'] : 0;
    $cabinetID = isset($_SESSION['cabinetID']) ? (int)$_SESSION['cabinetID'] : 0;

    if ($appointmentID <= 0) {
        throw new Exception('Invalid appointment ID');
    }

    $sql = "DELETE FROM Appointments WHERE appointmentID = ? AND cabinetID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $appointmentID, $cabinetID);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        throw new Exception('Appointment not found');
    }

    $stmt->close();

    $response['success'] = true;
    $response['message'] = 'Appointment deleted';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
