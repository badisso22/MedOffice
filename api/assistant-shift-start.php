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
    $cabinetID   = (int)$_SESSION['cabinetID'];
    $today       = date('Y-m-d');

    $sql = "SELECT shiftID, startedAt FROM AssistantShifts
            WHERE assistantUserID = ? AND shiftDate = ? AND endedAt IS NULL
            ORDER BY startedAt DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('is', $assistantID, $today);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    $stmt->close();

    if (!$row) {
        $now = date('Y-m-d H:i:s');
        $ins = $conn->prepare(
            "INSERT INTO AssistantShifts (assistantUserID, cabinetID, shiftDate, startedAt)
             VALUES (?, ?, ?, ?)"
        );
        $ins->bind_param('iiss', $assistantID, $cabinetID, $today, $now);
        $ins->execute();
        $shiftID   = $ins->insert_id;
        $startedAt = $now;
        $ins->close();
    } else {
        $shiftID   = (int)$row['shiftID'];
        $startedAt = $row['startedAt'];
    }

    $response['success'] = true;
    $response['data'] = [
        'shiftID'    => $shiftID,
        'started_at' => $startedAt
    ];
} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
}
echo json_encode($response);
