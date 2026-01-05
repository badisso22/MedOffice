<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'message' => '', 'errors' => []];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    if (empty($_SESSION['loggedIn'])) {
        throw new Exception('Unauthorized');
    }

    $cabinetID = 0;
    if (isset($_SESSION['activeCabinetID'])) {
        $cabinetID = (int)$_SESSION['activeCabinetID'];
    } elseif (isset($_SESSION['cabinetID'])) {
        $cabinetID = (int)$_SESSION['cabinetID'];
    }
    if ($cabinetID <= 0) {
        throw new Exception('Cabinet ID not found in session');
    }

    $raw   = file_get_contents('php://input');
    $input = json_decode($raw, true);
    if (!is_array($input)) {
        throw new Exception('Invalid JSON payload');
    }

    $appointmentID = isset($input['id']) ? (int)$input['id'] : 0;
    if ($appointmentID <= 0) {
        throw new Exception('Invalid appointment ID');
    }

    $sql = "DELETE FROM Appointments WHERE appointmentID = ? AND cabinetID = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('ii', $appointmentID, $cabinetID);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        throw new Exception('Appointment not found');
    }
    $stmt->close();

    $response['success'] = true;
    $response['message'] = 'Appointment deleted';

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
