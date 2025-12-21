<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'message' => '', 'errors' => [], 'data' => null];

if (!($conn instanceof mysqli)) {
    http_response_code(500);
    $response['message'] = 'Database connection error';
    echo json_encode($response);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    $response['message'] = 'Method not allowed';
    echo json_encode($response);
    exit;
}

$patientID = isset($_POST['patientID']) ? (int)$_POST['patientID'] : 0;

if ($patientID <= 0) {
    http_response_code(400);
    $response['message'] = 'Invalid patient ID';
    echo json_encode($response);
    exit;
}

try {
    $stmt = $conn->prepare("UPDATE PatientTable SET archived = 0 WHERE patientID = ?");
    $stmt->bind_param('i', $patientID);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        http_response_code(404);
        $response['message'] = 'Patient not found or already active';
        echo json_encode($response);
        $stmt->close();
        exit;
    }

    $stmt->close();

    $response['success'] = true;
    $response['message'] = 'Patient unarchived successfully';
    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(500);
    $response['message'] = 'Server error';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response);
}
