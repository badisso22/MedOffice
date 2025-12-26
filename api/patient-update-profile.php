<?php
session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'message' => '', 'errors' => []];

try {
    if (!isset($_SESSION['userID'])) {
        throw new Exception('Not authenticated');
    }
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    $userID = (int)$_SESSION['userID'];

    $raw   = file_get_contents('php://input');
    $input = json_decode($raw, true);

    if (!is_array($input)) {
        throw new Exception('Invalid JSON payload');
    }

    $fullName = trim($input['fullname'] ?? '');
    $email    = trim($input['email'] ?? '');
    $phone    = trim($input['phone'] ?? '');
    $address  = trim($input['address'] ?? '');
    $username = trim($input['username'] ?? '');

    if ($fullName === '' || $email === '' || $username === '') {
        throw new Exception('Full name, email and username are required');
    }

    // split full name into first + last
    $parts     = preg_split('/\s+/', $fullName);
    $firstName = array_shift($parts);
    $lastName  = implode(' ', $parts);

    // update Users
    $sqlUser = "UPDATE Users SET username = ?, email = ? WHERE userID = ?";
    $stmtUser = $conn->prepare($sqlUser);
    if (!$stmtUser) {
        throw new Exception('Prepare failed (Users): ' . $conn->error);
    }
    $stmtUser->bind_param('ssi', $username, $email, $userID);
    $stmtUser->execute();
    $stmtUser->close();

    // update or insert UserProfile
    $sqlCheck = "SELECT userProfileID FROM UserProfile WHERE userID = ? LIMIT 1";
    $stmtCheck = $conn->prepare($sqlCheck);
    if (!$stmtCheck) {
        throw new Exception('Prepare failed (check profile): ' . $conn->error);
    }
    $stmtCheck->bind_param('i', $userID);
    $stmtCheck->execute();
    $resCheck = $stmtCheck->get_result();
    $exists   = $resCheck->fetch_assoc();
    $stmtCheck->close();

    if ($exists) {
        $sqlProfile = "
            UPDATE UserProfile
            SET firstName = ?, lastName = ?, address = ?, phoneNumber = ?
            WHERE userID = ?
        ";
        $stmtProfile = $conn->prepare($sqlProfile);
        if (!$stmtProfile) {
            throw new Exception('Prepare failed (update profile): ' . $conn->error);
        }
        $stmtProfile->bind_param('ssssi', $firstName, $lastName, $address, $phone, $userID);
        $stmtProfile->execute();
        $stmtProfile->close();
    } else {
        $sqlProfile = "
            INSERT INTO UserProfile (userID, firstName, lastName, address, phoneNumber, createdAt)
            VALUES (?, ?, ?, ?, ?, NOW())
        ";
        $stmtProfile = $conn->prepare($sqlProfile);
        if (!$stmtProfile) {
            throw new Exception('Prepare failed (insert profile): ' . $conn->error);
        }
        $stmtProfile->bind_param('issss', $userID, $firstName, $lastName, $address, $phone);
        $stmtProfile->execute();
        $stmtProfile->close();
    }

    $response['success'] = true;
    $response['message'] = 'Profile updated successfully';
} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
