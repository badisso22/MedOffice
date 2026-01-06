<?php
session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'message' => ''];

try {
    if (!isset($_SESSION['userID'])) {
        throw new Exception('Not authenticated');
    }

    $userID = (int)$_SESSION['userID'];

    $sql = "SELECT profilePicture FROM UserProfile WHERE userID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $userID);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    $stmt->close();

    if ($row && $row['profilePicture']) {
        $filepath = '../uploads/profile-pictures/' . $row['profilePicture'];
        if (file_exists($filepath)) {
            unlink($filepath);
        }
    }

    $sql = "UPDATE UserProfile SET profilePicture = NULL WHERE userID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $userID);
    $stmt->execute();
    $stmt->close();

    $response['success'] = true;
    $response['message'] = 'Profile picture deleted';

} catch (Exception $e) {
    http_response_code(400);
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
