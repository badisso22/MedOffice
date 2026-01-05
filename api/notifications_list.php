<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'message' => '', 'notifications' => []];

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

    $userID    = (int)$_SESSION['userID'];
    $cabinetID = (int)$_SESSION['activeCabinetID'];

    $sql = "
        SELECT 
            id,
            type,
            title,
            message,
            link,
            isRead,
            createdAt
        FROM Notifications
        WHERE userID = ? AND cabinetID = ?
        ORDER BY createdAt DESC
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('ii', $userID, $cabinetID);
    $stmt->execute();
    $res = $stmt->get_result();

    while ($row = $res->fetch_assoc()) {
        $response['notifications'][] = [
            'id'        => (int)$row['id'],
            'type'      => $row['type'],
            'title'     => $row['title'],
            'message'   => $row['message'],
            'link'      => $row['link'],
            'isRead'    => (int)$row['isRead'],
            'createdAt' => $row['createdAt'],
        ];
    }
    $stmt->close();

    $response['success'] = true;
    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['message'] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
