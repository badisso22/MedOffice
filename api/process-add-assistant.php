<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/../config/config.php';
header('Content-Type: application/json; charset=utf-8');

$response = [
    'success' => false,
    'message' => '',
    'errors' => [],
    'data' => null,
];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    $response['message'] = 'Method not allowed';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

try {
    $rawBody = file_get_contents('php://input');
    $input = json_decode($rawBody, true);

    if (!is_array($input) || empty($input)) {
        $input = $_POST;
    }

    $firstName = trim($input['firstName'] ?? '');
    $lastName = trim($input['lastName'] ?? '');
    $dob = trim($input['dob'] ?? '');
    $gender = trim($input['gender'] ?? '');
    $address = trim($input['addr'] ?? '');
    $phone = trim($input['phone'] ?? '');
    $email = trim($input['email'] ?? '');
    $username = trim($input['username'] ?? '');
    $password = (string)($input['pass'] ?? '');

    if ($firstName === '') $response['errors'][] = 'First name is required';
    if ($lastName === '') $response['errors'][] = 'Last name is required';
    if ($dob === '') $response['errors'][] = 'Date of birth is required';
    if ($gender === '') $response['errors'][] = 'Gender is required';
    if ($address === '') $response['errors'][] = 'Address is required';
    if ($phone === '') $response['errors'][] = 'Phone is required';
    if ($email === '') {
        $response['errors'][] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['errors'][] = 'Invalid email format';
    }
    if ($username === '') $response['errors'][] = 'Username is required';
    if ($password === '') $response['errors'][] = 'Password is required';

    if (!empty($response['errors'])) {
        http_response_code(400);
        $response['message'] = 'Validation errors';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }

    $cabinetID = isset($_SESSION['cabinetID']) ? (int)$_SESSION['cabinetID'] : 1;

    if (!isset($conn) || !$conn instanceof mysqli) {
        throw new Exception('Database connection not initialized.');
    }

    $conn->begin_transaction();

    $stmt = $conn->prepare('SELECT COUNT(*) FROM Users WHERE username = ?');
    if (!$stmt) throw new Exception('Prepare failed: ' . $conn->error);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        http_response_code(400);
        $response['message'] = 'Validation errors';
        $response['errors'][] = 'Username already exists';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        $conn->rollback();
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $roleID = 4;

    $stmt = $conn->prepare('INSERT INTO Users (username, email, password, roleID) VALUES (?, ?, ?, ?)');
    if (!$stmt) throw new Exception('Insert user prepare failed: ' . $conn->error);
    $stmt->bind_param('sssi', $username, $email, $hashedPassword, $roleID);
    if (!$stmt->execute()) throw new Exception('Error creating user: ' . $stmt->error);
    $userId = $conn->insert_id;
    $stmt->close();

    $stmt = $conn->prepare('INSERT INTO UserProfile (userID, firstName, lastName, dateOfBirth, gender, address, phoneNumber) VALUES (?, ?, ?, ?, ?, ?, ?)');
    if (!$stmt) throw new Exception('Insert profile prepare failed: ' . $conn->error);
    $stmt->bind_param('issssss', $userId, $firstName, $lastName, $dob, $gender, $address, $phone);
    if (!$stmt->execute()) throw new Exception('Error creating profile: ' . $stmt->error);
    $stmt->close();

    $stmt = $conn->prepare('INSERT INTO AssistantProfile (userID, cabinetID, assignedDoctorID, isActive, isArchived) VALUES (?, ?, NULL, 1, 0)');
    if (!$stmt) throw new Exception('Insert assistant prepare failed: ' . $conn->error);
    $stmt->bind_param('ii', $userId, $cabinetID);
    if (!$stmt->execute()) throw new Exception('Error creating assistant: ' . $stmt->error);
    $stmt->close();

    $conn->commit();

    $response['success'] = true;
    $response['message'] = 'Assistant added successfully';
    $response['data'] = [
        'userID' => $userId,
        'username' => $username,
        'firstName' => $firstName,
        'lastName' => $lastName,
        'createdAt' => date('Y-m-d H:i:s'),
    ];

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;

} catch (Exception $e) {
    if (isset($conn) && $conn instanceof mysqli && $conn->ping()) {
        $conn->rollback();
    }

    http_response_code(500);
    $response['success'] = false;
    $response['message'] = 'Server error';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}
