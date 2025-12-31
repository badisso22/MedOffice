<?php
header('Content-Type: application/json');
session_start();
require("../config/config.php");

$requestId = isset($_POST['request_id']) ? (int)$_POST['request_id'] : 0;
$approvedBy = $_SESSION['userID'] ?? null;

if ($requestId <= 0) {
    echo json_encode(['success' => false, 'error' => 'Invalid request ID.']);
    exit;
}

$stmt = $conn->prepare("
    UPDATE Requests
    SET status = 'rejected',
        approved_by = ?,
        approved_at = NOW(),
        updated_at  = NOW()
    WHERE requestID = ? AND status = 'pending'
");
$stmt->bind_param("ii", $approvedBy, $requestId);

if ($stmt->execute() && $stmt->affected_rows > 0) {
    echo json_encode(['success' => true, 'message' => 'Request rejected.']);
} else {
    echo json_encode(['success' => false, 'error' => 'Request not found or already processed.']);
}

$stmt->close();
