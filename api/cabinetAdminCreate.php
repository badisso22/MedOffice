<?php
header('Content-Type: application/json');
session_start();
require("../config/config.php");

$cabinetId     = (int)($_POST['cabinet_id'] ?? 0);
$adminName     = trim($_POST['admin_name'] ?? '');
$adminUsername = trim($_POST['admin_username'] ?? '');
$adminEmail    = trim($_POST['admin_email'] ?? '');
$adminPhone    = trim($_POST['admin_phone'] ?? '');
$adminPassword = $_POST['admin_password'] ?? '';

if (
    $cabinetId <= 0 ||
    $adminName === '' ||
    $adminUsername === '' ||
    $adminEmail === '' ||
    $adminPhone === '' ||
    $adminPassword === ''
) {
    echo json_encode(['success' => false, 'error' => 'All fields are required.']);
    exit;
}

if (!filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'error' => 'Invalid email address.']);
    exit;
}

$checkCab = $conn->prepare("SELECT cabinetID FROM CabinetInfo WHERE cabinetID = ?");
$checkCab->bind_param("i", $cabinetId);
$checkCab->execute();
$checkCab->store_result();
if ($checkCab->num_rows === 0) {
    echo json_encode(['success' => false, 'error' => 'Cabinet not found.']);
    $checkCab->close();
    exit;
}
$checkCab->close();

$checkUser = $conn->prepare("SELECT userID FROM Users WHERE username = ? OR email = ?");
$checkUser->bind_param("ss", $adminUsername, $adminEmail);
$checkUser->execute();
$checkUser->store_result();
if ($checkUser->num_rows > 0) {
    echo json_encode(['success' => false, 'error' => 'Username or email already in use.']);
    $checkUser->close();
    exit;
}
$checkUser->close();


$roleId = 2;

$hashedPassword = password_hash($adminPassword, PASSWORD_BCRYPT);

$insertUser = $conn->prepare("
    INSERT INTO Users (roleID, username, email, password)
    VALUES (?, ?, ?, ?)
");
if (!$insertUser) {
    echo json_encode(['success' => false, 'error' => 'Prepare user failed: '.$conn->error]);
    exit;
}
$insertUser->bind_param("isss", $roleId, $adminUsername, $adminEmail, $hashedPassword);

if (!$insertUser->execute()) {
    echo json_encode(['success' => false, 'error' => 'Could not create user: '.$insertUser->error]);
    $insertUser->close();
    exit;
}
$userId = $insertUser->insert_id;
$insertUser->close();

$parts = explode(' ', $adminName, 2);
$firstName = $parts[0];
$lastName  = $parts[1] ?? '';

$profile = $conn->prepare("
    INSERT INTO UserProfile (userID, firstName, lastName, phoneNumber)
    VALUES (?, ?, ?, ?)
");
if ($profile) {
    $profile->bind_param("isss", $userId, $firstName, $lastName, $adminPhone);
    $profile->execute();
    $profile->close();
}

$doctor = $conn->prepare("
    INSERT INTO DoctorProfile (userID, cabinetID, speciality)
    VALUES (?, ?, ?)
");
if (!$doctor) {
    echo json_encode([
        'success' => false,
        'error'   => 'Could not prepare doctor profile: '.$conn->error
    ]);
    exit;
}

$speciality = ''; 
$doctor->bind_param("iis", $userId, $cabinetId, $speciality);

if (!$doctor->execute()) {
    echo json_encode([
        'success' => false,
        'error'   => 'Could not create doctor profile: '.$doctor->error
    ]);
    $doctor->close();
    exit;
}
$doctorId = $doctor->insert_id;
$doctor->close();

echo json_encode([
    'success'   => true,
    'message'   => 'Admin user and doctor profile created and linked to cabinet.',
    'user_id'   => $userId,
    'doctor_id' => $doctorId
]);
