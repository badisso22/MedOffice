<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = [
    'success' => false,
    'message' => '',
    'errors' => []
];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    $appointmentID = 0;
    
    if (!empty($_POST['appointmentID'])) {
        $appointmentID = (int)$_POST['appointmentID'];
    } else {
        $raw = file_get_contents('php://input');
        $input = json_decode($raw, true);
        if (is_array($input) && isset($input['appointmentID'])) {
            $appointmentID = (int)$input['appointmentID'];
        }
    }

    if ($appointmentID <= 0) {
        throw new Exception('Invalid appointment ID');
    }

    $sql = "UPDATE Appointments SET status = 'completed' WHERE appointmentID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $appointmentID);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $stmt->close();
        throw new Exception('Appointment not found or already completed');
    }

    $stmt->close();

    $response['success'] = true;
    $response['message'] = 'Appointment marked as completed';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['success'] = false;
    $response['message'] = 'Error ending appointment';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
