<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'message' => ''];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    if (
        empty($_SESSION['loggedIn']) ||
        !isset($_SESSION['userID'], $_SESSION['activeCabinetID'])
    ) {
        throw new Exception('Unauthorized');
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method');
    }

    $userID    = (int)$_SESSION['userID'];
    $cabinetID = (int)$_SESSION['activeCabinetID'];

    $raw   = file_get_contents('php://input');
    $input = json_decode($raw, true);
    if (!is_array($input) || empty($input['notificationID'])) {
        throw new Exception('Missing notification ID');
    }
    $notifID = (int)$input['notificationID'];

    $sql = "
        UPDATE Notifications
        SET isRead = 1
        WHERE id = ? AND userID = ? AND cabinetID = ?
        LIMIT 1
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('iii', $notifID, $userID, $cabinetID);
    $stmt->execute();
    $stmt->close();

    $response['success'] = true;
    $response['message'] = 'Notification updated';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['message'] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
