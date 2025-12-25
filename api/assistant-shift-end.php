<?php
session_start();
require '../config/config.php';
header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'data' => [], 'errors' => []];

try {
    if (!$conn instanceof mysqli) throw new Exception('DB error');
    if (!isset($_SESSION['userID'], $_SESSION['cabinetID']) || $_SESSION['roleID'] != 4) {
        throw new Exception('Unauthorized');
    }

    $assistantID = (int)$_SESSION['userID'];
    $today       = date('Y-m-d');

    $sql = "SELECT shiftID, startedAt FROM AssistantShifts
            WHERE assistantUserID = ? AND shiftDate = ? AND endedAt IS NULL
            ORDER BY startedAt DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('is', $assistantID, $today);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$row) throw new Exception('No active shift to end');

    $now = date('Y-m-d H:i:s');
    $upd = $conn->prepare("UPDATE AssistantShifts SET endedAt = ? WHERE shiftID = ?");
    $upd->bind_param('si', $now, $row['shiftID']);
    $upd->execute();
    $upd->close();

    $response['success'] = true;
    $response['data'] = ['ended_at' => $now];
} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
}
echo json_encode($response);
