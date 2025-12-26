<?php
session_start();
require '../config/config.php';

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true || $_SESSION['roleID'] != 1) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit();
}

$fullName = $_POST['fullName'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$cabinetID = $_POST['cabinetID'] ?? '';

if (empty($fullName) || empty($email) || empty($password) || empty($cabinetID)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit();
}

if (!ctype_digit($cabinetID)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid cabinet ID']);
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid email format']);
    exit();
}

$cabinetCheck = "SELECT cabinetID FROM CabinetInfo WHERE cabinetID = ? LIMIT 1";
$stmt = $conn->prepare($cabinetCheck);
$stmt->bind_param('i', $cabinetID);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result->num_rows === 0) {
    http_response_code(404);
    echo json_encode(['status' => 'error', 'message' => 'Cabinet not found']);
    exit();
}

$emailCheck = "SELECT userID FROM Users WHERE email = ? LIMIT 1";
$stmt = $conn->prepare($emailCheck);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result->num_rows > 0) {
    http_response_code(409);
    echo json_encode(['status' => 'error', 'message' => 'Email already exists']);
    exit();
}

$conn->begin_transaction();

try {
    $nameParts = explode(' ', trim($fullName), 2);
    $firstName = $nameParts[0] ?? '';
    $lastName = $nameParts[1] ?? '';

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $username = explode('@', $email)[0] . '_' . substr(md5(time()), 0, 5);

    $sql1 = "INSERT INTO Users (roleID, username, email, password, account_status) VALUES (2, ?, ?, ?, 'active')";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param('sss', $username, $email, $hashedPassword);
    $stmt1->execute();
    $newUserID = $conn->insert_id;
    $stmt1->close();

    if ($newUserID === 0) {
        throw new Exception('Failed to create user');
    }

    $sql2 = "INSERT INTO UserProfile (userID, firstName, lastName) VALUES (?, ?, ?)";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param('iss', $newUserID, $firstName, $lastName);
    $stmt2->execute();
    $stmt2->close();

    $sql3 = "INSERT INTO DoctorProfile (userID, cabinetID, speciality, isArchived) VALUES (?, ?, 'Admin', 0)";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->bind_param('ii', $newUserID, $cabinetID);
    $stmt3->execute();
    $stmt3->close();

    $conn->commit();

    echo json_encode([
        'status' => 'success',
        'message' => 'Admin user created successfully',
        'userID' => $newUserID
    ]);
} catch (Exception $e) {
    $conn->rollback();
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Failed to create admin user: ' . $e->getMessage()]);
}
?>
