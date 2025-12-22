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

    $firstName = isset($_POST['firstName']) ? trim($_POST['firstName']) : '';
    $lastName = isset($_POST['lastName']) ? trim($_POST['lastName']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['pass']) ? $_POST['pass'] : '';
    $employeeCode = isset($_POST['employeeId']) ? trim($_POST['employeeId']) : '';
    $yearsExp = isset($_POST['experience']) ? (float)$_POST['experience'] : 0;
    $skills = isset($_POST['skills']) ? trim($_POST['skills']) : '';

    if (!$firstName || !$lastName || !$email || !$phone || !$username || !$password) {
        throw new Exception('Missing required fields');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email format');
    }

    $cabinetID = isset($_SESSION['cabinetID']) ? (int)$_SESSION['cabinetID'] : 1;
    $roleID = 4; 

    $sqlCheck = "SELECT userID FROM Users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sqlCheck);
    $stmt->bind_param('ss', $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        throw new Exception('Username or email already exists');
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $sqlUsers = "INSERT INTO Users (roleID, username, email, password, accountstatus) VALUES (?, ?, ?, ?, 'active')";
    $stmt = $conn->prepare($sqlUsers);
    $stmt->bind_param('isss', $roleID, $username, $email, $hashedPassword);
    $stmt->execute();
    $userID = $stmt->insert_id;
    $stmt->close();

    if (!$userID) {
        throw new Exception('Failed to create user');
    }

    $sqlProfile = "INSERT INTO UserProfile (userID, firstName, lastName, phoneNumber) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sqlProfile);
    $stmt->bind_param('isss', $userID, $firstName, $lastName, $phone);
    $stmt->execute();
    $stmt->close();

    $sqlAssistant = "INSERT INTO AssistantProfile (userID, cabinetID, yearsExperience, employeeCode, status, isActive, isArchived) VALUES (?, ?, ?, ?, 'available', 1, 0)";
    $stmt = $conn->prepare($sqlAssistant);
    $stmt->bind_param('iids', $userID, $cabinetID, $yearsExp, $employeeCode);
    $stmt->execute();
    $assistantID = $stmt->insert_id;
    $stmt->close();

    if (!$assistantID) {
        throw new Exception('Failed to create assistant profile');
    }

    if (!empty($skills)) {
        $skillArray = array_map('trim', explode(',', $skills));
        $sqlSkill = "INSERT INTO AssistantSkills (assistantID, skillName) VALUES (?, ?)";
        $stmt = $conn->prepare($sqlSkill);
        foreach ($skillArray as $skill) {
            if (!empty($skill)) {
                $stmt->bind_param('is', $assistantID, $skill);
                $stmt->execute();
            }
        }
        $stmt->close();
    }

    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    $sqlAvail = "INSERT INTO AssistantAvailability (assistantID, dayOfWeek, startTime, endTime, isAvailable) VALUES (?, ?, ?, ?, ?)";

    foreach ($days as $day) {
        $dayLower = strtolower($day);
        $startKey = $dayLower . '_start';
        $endKey = $dayLower . '_end';
        $checkboxKey = $dayLower;

        $isAvailable = isset($_POST[$checkboxKey]) && $_POST[$checkboxKey] ? 1 : 0;
        $startTime = isset($_POST[$startKey]) && !empty($_POST[$startKey]) ? $_POST[$startKey] : NULL;
        $endTime = isset($_POST[$endKey]) && !empty($_POST[$endKey]) ? $_POST[$endKey] : NULL;

        $stmt = $conn->prepare($sqlAvail);
        $stmt->bind_param('isssi', $assistantID, $day, $startTime, $endTime, $isAvailable);
        $stmt->execute();
    }
    $stmt->close();

    $response['success'] = true;
    $response['message'] = 'Assistant added successfully';
    $response['data'] = [
        'assistantID' => $assistantID,
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'username' => $username
    ];

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['success'] = false;
    $response['message'] = 'Error adding assistant';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
