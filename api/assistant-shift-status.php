<?php
session_start();
require '../config/config.php';
header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'data' => [], 'errors' => []];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('DB error');
    }

    if (
        !isset($_SESSION['userID'], $_SESSION['roleID'], $_SESSION['activeCabinetID']) ||
        (int)$_SESSION['roleID'] !== 4
    ) {
        throw new Exception('Unauthorized');
    }

    $assistantID = (int)$_SESSION['userID'];
    $cabinetID   = (int)$_SESSION['activeCabinetID'];
    if ($cabinetID <= 0) {
        throw new Exception('Cabinet ID not found');
    }

    $today = date('Y-m-d');

    $sqlTotal = "
        SELECT SUM(TIMESTAMPDIFF(MINUTE, startedAt, endedAt)) AS m
        FROM AssistantShifts
        WHERE assistantUserID = ?
          AND cabinetID = ?
          AND shiftDate = ?
          AND endedAt IS NOT NULL
    ";
    $stmt = $conn->prepare($sqlTotal);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('iis', $assistantID, $cabinetID, $today);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    $workedMinutes = (int)($res['m'] ?? 0);

    $sqlOpen = "
        SELECT shiftID, startedAt
        FROM AssistantShifts
        WHERE assistantUserID = ?
          AND cabinetID = ?
          AND shiftDate = ?
          AND endedAt IS NULL
        ORDER BY startedAt DESC
        LIMIT 1
    ";
    $stmt = $conn->prepare($sqlOpen);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('iis', $assistantID, $cabinetID, $today);
    $stmt->execute();
    $open = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    $response['success'] = true;
    $response['data'] = [
        'active'               => $open ? true : false,
        'started_at'           => $open['startedAt'] ?? null,
        'worked_minutes_today' => $workedMinutes,
    ];

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
}

echo json_encode($response);
