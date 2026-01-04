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

    $sql = "
        SELECT shiftID, startedAt 
        FROM AssistantShifts
        WHERE assistantUserID = ? 
          AND cabinetID = ?
          AND shiftDate = ? 
          AND endedAt IS NULL
        ORDER BY startedAt DESC 
        LIMIT 1
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('iis', $assistantID, $cabinetID, $today);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    $stmt->close();

    if (!$row) {
        $now = date('Y-m-d H:i:s');
        $ins = $conn->prepare("
            INSERT INTO AssistantShifts (assistantUserID, cabinetID, shiftDate, startedAt)
            VALUES (?, ?, ?, ?)
        ");
        if (!$ins) {
            throw new Exception('Prepare failed: ' . $conn->error);
        }
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
        'started_at' => $startedAt,
    ];

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
}

echo json_encode($response);
