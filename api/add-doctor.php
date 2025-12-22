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

    $raw = file_get_contents('php://input');
    $input = json_decode($raw, true);

    if (!is_array($input)) {
        throw new Exception('Invalid request body');
    }

    $firstName = isset($input['firstName']) ? trim($input['firstName']) : '';
    $lastName = isset($input['lastName']) ? trim($input['lastName']) : '';
    $dob = isset($input['dob']) ? trim($input['dob']) : '';
    $gender = isset($input['gender']) ? trim($input['gender']) : '';
    $addr = isset($input['addr']) ? trim($input['addr']) : '';
    $phone = isset($input['phone']) ? trim($input['phone']) : '';
    $specialty = isset($input['specialty']) ? trim($input['specialty']) : '';
    $yearsExp = isset($input['yearsExp']) ? (int)$input['yearsExp'] : 0;
    $licenseNo = isset($input['licenseNo']) ? trim($input['licenseNo']) : '';
    $bio = isset($input['bio']) ? trim($input['bio']) : '';
    $username = isset($input['username']) ? trim($input['username']) : '';
    $email = isset($input['email']) ? trim($input['email']) : '';
    $password = isset($input['pass']) ? $input['pass'] : '';
    $availability = isset($input['availability']) ? $input['availability'] : [];

    if (!$firstName || !$lastName || !$email || !$phone || !$username || !$password || !$specialty) {
        throw new Exception('Missing required fields');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email format');
    }

    $cabinetID = isset($_SESSION['cabinetID']) ? (int)$_SESSION['cabinetID'] : 1;
    $roleID = 3; 

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

    $sqlUsers = "INSERT INTO Users (roleID, username, email, password, account_status) VALUES (?, ?, ?, ?, 'active')";
    $stmt = $conn->prepare($sqlUsers);
    $stmt->bind_param('isss', $roleID, $username, $email, $hashedPassword);
    $stmt->execute();
    $userID = $stmt->insert_id;
    $stmt->close();

    if (!$userID) {
        throw new Exception('Failed to create user');
    }

    $sqlProfile = "INSERT INTO UserProfile (userID, firstName, lastName, dateOfBirth, gender, address, phoneNumber) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sqlProfile);
    $stmt->bind_param('issssss', $userID, $firstName, $lastName, $dob, $gender, $addr, $phone);
    $stmt->execute();
    $stmt->close();

    $sqlDoctor = "INSERT INTO DoctorProfile (userID, cabinetID, speciality, licenseNumber, yearsOfExperience, bio, isActive, isArchived) VALUES (?, ?, ?, ?, ?, ?, 1, 0)";
    $stmt = $conn->prepare($sqlDoctor);
    $stmt->bind_param('iissis', $userID, $cabinetID, $specialty, $licenseNo, $yearsExp, $bio);
    $stmt->execute();
    $doctorID = $stmt->insert_id;
    $stmt->close();

    if (!$doctorID) {
        throw new Exception('Failed to create doctor profile');
    }

    if (!empty($availability)) {
        $sqlAvail = "INSERT INTO DoctorAvailability (doctorID, dayOfWeek, startTime, endTime, isAvailable) VALUES (?, ?, ?, ?, 1)";
        $dayMap = [
            'monday' => 'Monday',
            'tuesday' => 'Tuesday',
            'wednesday' => 'Wednesday',
            'thursday' => 'Thursday',
            'friday' => 'Friday',
            'saturday' => 'Saturday',
            'sunday' => 'Sunday'
        ];

        foreach ($availability as $day => $times) {
            if (isset($dayMap[$day]) && isset($times['start']) && isset($times['end'])) {
                $stmt = $conn->prepare($sqlAvail);
                $stmt->bind_param('isss', $doctorID, $dayMap[$day], $times['start'], $times['end']);
                $stmt->execute();
            }
        }
        if (isset($stmt)) $stmt->close();
    }

    $response['success'] = true;
    $response['message'] = 'Doctor added successfully';
    $response['data'] = [
        'doctorID' => $doctorID,
        'fullName' => $firstName . ' ' . $lastName,
        'email' => $email,
        'username' => $username
    ];

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['success'] = false;
    $response['message'] = 'Error adding doctor';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
