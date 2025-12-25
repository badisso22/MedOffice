<?php
session_start();
require '../config/config.php';
header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'errors' => []];

try {
    if (!$conn instanceof mysqli) throw new Exception('DB connection error');
    if (!isset($_SESSION['userID'], $_SESSION['cabinetID']) || $_SESSION['roleID'] != 4) {
        throw new Exception('Unauthorized');
    }

    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true);
    if (!is_array($data)) throw new Exception('Invalid JSON payload');

    $userID    = (int)$_SESSION['userID'];
    $cabinetID = (int)$_SESSION['cabinetID'];

    $firstName = trim($data['firstName'] ?? '');
    $lastName  = trim($data['lastName'] ?? '');
    $phone     = trim($data['phoneNumber'] ?? '');
    $address   = trim($data['address'] ?? '');

    $yearsExperience = isset($data['yearsExperience']) ? (float)$data['yearsExperience'] : 0.0;
    $employeeCode    = trim($data['employeeCode'] ?? '');
    $status          = $data['status'] ?? 'available';

    $skills          = is_array($data['skills'] ?? null) ? $data['skills'] : [];
    $availability    = is_array($data['availability'] ?? null) ? $data['availability'] : [];

    $sql = "SELECT assistantID FROM AssistantProfile
            WHERE userID = ? AND cabinetID = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $userID, $cabinetID);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    if (!$row) throw new Exception('Assistant profile not found');
    $assistantID = (int)$row['assistantID'];

    $sql = "INSERT INTO UserProfile (userID, firstName, lastName, address, phoneNumber)
            VALUES (?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
              firstName = VALUES(firstName),
              lastName  = VALUES(lastName),
              address   = VALUES(address),
              phoneNumber = VALUES(phoneNumber)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('issss', $userID, $firstName, $lastName, $address, $phone);
    $stmt->execute();
    $stmt->close();

    $sql = "UPDATE AssistantProfile
            SET yearsExperience = ?, employeeCode = ?, status = ?
            WHERE assistantID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('dssi', $yearsExperience, $employeeCode, $status, $assistantID);
    $stmt->execute();
    $stmt->close();

    $del = $conn->prepare("DELETE FROM AssistantSkills WHERE assistantID = ?");
    $del->bind_param('i', $assistantID);
    $del->execute();
    $del->close();

    if (!empty($skills)) {
        $ins = $conn->prepare("INSERT INTO AssistantSkills (assistantID, skillName) VALUES (?, ?)");
        foreach ($skills as $skill) {
            $skillName = trim($skill);
            if ($skillName === '') continue;
            $ins->bind_param('is', $assistantID, $skillName);
            $ins->execute();
        }
        $ins->close();
    }

    $del = $conn->prepare("DELETE FROM AssistantAvailability WHERE assistantID = ?");
    $del->bind_param('i', $assistantID);
    $del->execute();
    $del->close();

    if (!empty($availability)) {
        $ins = $conn->prepare(
            "INSERT INTO AssistantAvailability (assistantID, dayOfWeek, startTime, endTime, isAvailable)
             VALUES (?, ?, ?, ?, ?)"
        );
        foreach ($availability as $slot) {
            $day   = $slot['dayOfWeek'] ?? null;
            if (!$day) continue;
            $start = $slot['startTime'] ?? null;
            $end   = $slot['endTime'] ?? null;
            $isAv  = isset($slot['isAvailable']) ? (int)$slot['isAvailable'] : 0;
            $ins->bind_param('isssi', $assistantID, $day, $start, $end, $isAv);
            $ins->execute();
        }
        $ins->close();
    }

    $response['success'] = true;
} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
}

echo json_encode($response);
