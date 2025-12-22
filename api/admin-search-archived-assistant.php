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
    'assistants' => [],
    'errors' => []
];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    $searchName = isset($_GET['searchName']) ? trim($_GET['searchName']) : '';

    $sql = "
        SELECT
            ap.assistantID,
            ap.userID,
            ap.cabinetID,
            up.firstName,
            up.lastName,
            up.dateOfBirth,
            up.phoneNumber,
            u.email
        FROM AssistantProfile ap
        INNER JOIN Users u ON u.userID = ap.userID
        INNER JOIN UserProfile up ON up.userID = u.userID
        WHERE ap.isArchived = 1
    ";

    $params = [];
    $types  = '';

    if ($searchName !== '') {
        $sql .= " AND CONCAT(up.firstName, ' ', up.lastName) LIKE ?";
        $params[] = '%' . $searchName . '%';
        $types   .= 's';
    }

    $sql .= " ORDER BY up.firstName, up.lastName";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }

    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $assistants = [];
    $today = new DateTime();

    while ($row = $result->fetch_assoc()) {
        $age = null;
        if (!empty($row['dateOfBirth'])) {
            $dob = new DateTime($row['dateOfBirth']);
            $age = $dob->diff($today)->y;
        }

        $assistants[] = [
            'assistantID' => (int)$row['assistantID'],
            'fullName'    => $row['firstName'] . ' ' . $row['lastName'],
            'age'         => $age,
            'email'       => $row['email'],
            'phone'       => $row['phoneNumber'],
        ];
    }

    $response['success']    = true;
    $response['message']    = 'Archived assistants loaded';
    $response['assistants'] = $assistants;

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(500);
    $response['success'] = false;
    $response['message'] = 'Server error';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
