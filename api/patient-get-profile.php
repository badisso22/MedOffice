<?php
session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'data' => null, 'errors' => []];

try {
    if (!isset($_SESSION['userID'])) {
        throw new Exception('Not authenticated');
    }
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    $userID = (int)$_SESSION['userID'];

    $sql = "
        SELECT 
            u.userID,
            u.username,
            u.email,
            u.account_status,
            up.firstName,
            up.lastName,
            up.dateOfBirth,
            up.gender,
            up.address,
            up.phoneNumber,
            up.createdAt AS profileCreatedAt
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
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    $stmt->close();

    if (!$row) {
        throw new Exception('User profile not found');
    }

    $fullName = trim(($row['firstName'] ?? '') . ' ' . ($row['lastName'] ?? ''));
    if ($fullName === '') {
        $fullName = $row['username'];
    }

    $response['success'] = true;
    $response['data'] = [
        'userID'      => (int)$row['userID'],
        'fullName'    => $fullName,
        'email'       => $row['email'],
        'phone'       => $row['phoneNumber'] ?? '',
        'address'     => $row['address'] ?? '',
        'username'    => $row['username'],
        'status'      => $row['account_status'] ?? 'active',
        'dateOfBirth' => $row['dateOfBirth'] ?? null,
        'gender'      => $row['gender'] ?? null,
        'createdAt'   => $row['created_at'] ?? $row['profileCreatedAt'] ?? null,
    ];
} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
