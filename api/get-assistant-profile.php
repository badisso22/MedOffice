<?php
session_start();
require '../config/config.php';
header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'data' => [], 'errors' => []];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('DB connection error');
    }

    if (
        !isset($_SESSION['userID'], $_SESSION['roleID'], $_SESSION['activeCabinetID']) ||
        (int)$_SESSION['roleID'] !== 4
    ) {
        throw new Exception('Unauthorized');
    }

    $userID    = (int)$_SESSION['userID'];
    $cabinetID = (int)$_SESSION['activeCabinetID'];
    if ($cabinetID <= 0) {
        throw new Exception('Cabinet ID not found');
    }

    $sql = "
        SELECT 
            ap.assistantID,
            ap.cabinetID,
            ap.assignedDoctorID,
            ap.isActive,
            ap.yearsExperience,
            ap.employeeCode,
            ap.status,
            ap.isArchived,
            ap.createdAt
        FROM AssistantProfile ap
        WHERE ap.userID = ? 
          AND ap.cabinetID = ?
        LIMIT 1
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('ii', $userID, $cabinetID);
    $stmt->execute();
    $apRes = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$apRes) {
        throw new Exception('Assistant profile not found');
    }

    $assistantID = (int)$apRes['assistantID'];

    $sql = "
        SELECT 
            u.username, 
            u.email, 
            up.firstName, 
            up.lastName, 
            up.phoneNumber, 
            up.address
        FROM Users u
        LEFT JOIN UserProfile up ON up.userID = u.userID
        WHERE u.userID = ?
        LIMIT 1
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('i', $userID);
    $stmt->execute();
    $userRes = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    $sql = "
        SELECT skillName
        FROM AssistantSkills
        WHERE assistantID = ?
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('i', $assistantID);
    $stmt->execute();
    $skillsRes = $stmt->get_result();
    $skills = [];
    while ($row = $skillsRes->fetch_assoc()) {
        $skills[] = $row['skillName'];
    }
    $stmt->close();

    $sql = "
        SELECT dayOfWeek, startTime, endTime, isAvailable
        FROM AssistantAvailability
        WHERE assistantID = ?
        ORDER BY FIELD(dayOfWeek,
            'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('i', $assistantID);
    $stmt->execute();
    $availRes = $stmt->get_result();
    $availability = [];
    while ($row = $availRes->fetch_assoc()) {
        $availability[] = [
            'dayOfWeek'   => $row['dayOfWeek'],
            'startTime'   => $row['startTime'],
            'endTime'     => $row['endTime'],
            'isAvailable' => (int)$row['isAvailable'],
        ];
    }
    $stmt->close();

    $response['success'] = true;
    $response['data'] = [
        'assistant'    => $apRes,
        'user'         => $userRes,
        'skills'       => $skills,
        'availability' => $availability,
    ];

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
}

echo json_encode($response);
