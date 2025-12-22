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
    'errors'  => []
];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    $raw = file_get_contents('php://input');
    $body = json_decode($raw, true);

    if (!is_array($body)) {
        throw new Exception('Invalid request body');
    }

    $assistantID = isset($body['assistantID']) ? (int)$body['assistantID'] : 0;
    if ($assistantID <= 0) {
        throw new Exception('Invalid assistant ID');
    }

    $cabinetID = isset($_SESSION['cabinetID']) ? (int)$_SESSION['cabinetID'] : 0;

    if ($cabinetID > 0) {
        $sql = "
            UPDATE AssistantProfile
            SET isArchived = 1
            WHERE assistantID = ?
              AND cabinetID  = ?
              AND isArchived = 0
        ";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception('Prepare failed: ' . $conn->error);
        }
        $stmt->bind_param('ii', $assistantID, $cabinetID);
    } else {
        $sql = "
            UPDATE AssistantProfile
            SET isArchived = 1
            WHERE assistantID = ?
              AND isArchived = 0
        ";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception('Prepare failed: ' . $conn->error);
        }
        $stmt->bind_param('i', $assistantID);
    }

    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $stmt->close();
        throw new Exception('Assistant not found or already archived');
    }

    $stmt->close();

    $response['success'] = true;
    $response['message'] = 'Assistant archived successfully';

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['success'] = false;
    $response['message'] = 'Error archiving assistant';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
