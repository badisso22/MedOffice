<?php
session_start();
require '../config/config.php';

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true || $_SESSION['roleID'] != 1) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit();
}

if (!isset($_POST['userId']) || !ctype_digit($_POST['userId'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid user ID']);
    exit();
}

$userID = (int)$_POST['userId'];

$checkSql = "SELECT userID FROM Users WHERE userID = ? AND roleID = 2 LIMIT 1";
$check = $conn->prepare($checkSql);
$check->bind_param('i', $userID);
$check->execute();
$result = $check->get_result();
$check->close();

if ($result->num_rows === 0) {
    http_response_code(404);
    echo json_encode(['status' => 'error', 'message' => 'Admin user not found']);
    exit();
}

$conn->begin_transaction();

try {
    $sql1 = "UPDATE DoctorProfile SET isArchived = 0 WHERE userID = ?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param('i', $userID);
    $stmt1->execute();
    $stmt1->close();

    $sql2 = "UPDATE Users SET account_status = 'active' WHERE userID = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param('i', $userID);
    $stmt2->execute();
    $stmt2->close();

    $conn->commit();

    echo json_encode(['status' => 'success', 'message' => 'User restored successfully']);
} catch (Exception $e) {
    $conn->rollback();
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Failed to restore user']);
}
