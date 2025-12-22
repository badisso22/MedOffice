<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = [
    'success' => false,
    'message' => '',
    'data'    => null,
    'errors'  => []
];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    $assistantID = isset($_GET['assistantID']) ? (int)$_GET['assistantID'] : 0;
    if ($assistantID <= 0) {
        throw new Exception('Invalid assistant ID');
    }

    $sql = "
        SELECT 
            ap.assistantID,
            ap.yearsExperience,
            ap.employeeCode,
            ap.status,
            up.firstName,
            up.lastName,
            up.phoneNumber,
            u.email
        FROM AssistantProfile ap
        INNER JOIN Users u        ON u.userID = ap.userID
        INNER JOIN UserProfile up ON up.userID = u.userID
        WHERE ap.assistantID = ?
        LIMIT 1
    ";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('i', $assistantID);
    $stmt->execute();
    $res = $stmt->get_result();
    $assistant = $res->fetch_assoc();
    $stmt->close();

    if (!$assistant) {
        throw new Exception('Assistant not found');
    }

    $skills = [];
    $sqlSkills = "SELECT skillName FROM AssistantSkills WHERE assistantID = ? ORDER BY skillName";
    if ($stmt = $conn->prepare($sqlSkills)) {
        $stmt->bind_param('i', $assistantID);
        $stmt->execute();
        $resSkills = $stmt->get_result();
        while ($row = $resSkills->fetch_assoc()) {
            $skills[] = $row['skillName'];
        }
        $stmt->close();
    }

    $availability = [];
    $sqlAvail = "
        SELECT dayOfWeek, startTime, endTime, isAvailable
        FROM AssistantAvailability
        WHERE assistantID = ?
        ORDER BY FIELD(dayOfWeek,'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')
    ";
    if ($stmt = $conn->prepare($sqlAvail)) {
        $stmt->bind_param('i', $assistantID);
        $stmt->execute();
        $resAvail = $stmt->get_result();
        while ($row = $resAvail->fetch_assoc()) {
            $availability[] = $row;
        }
        $stmt->close();
    }

    $data = [
        'assistantID'   => (int)$assistant['assistantID'],
        'fullName'      => $assistant['firstName'] . ' ' . $assistant['lastName'],
        'status'        => $assistant['status'],
        'yearsExp'      => $assistant['yearsExperience'],
        'employeeCode'  => $assistant['employeeCode'],
        'email'         => $assistant['email'],
        'phone'         => $assistant['phoneNumber'],
        'skills'        => $skills,
        'availability'  => $availability
    ];

    $response['success'] = true;
    $response['message'] = 'Assistant details loaded';
    $response['data']    = $data;

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['success'] = false;
    $response['message'] = 'Error loading assistant';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
