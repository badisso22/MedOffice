<?php
session_start();
require '../config/config.php';

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true || $_SESSION['roleID'] != 1) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid user id']);
    exit();
}

$userID = (int)$_GET['id'];

$sql = "
    SELECT
        u.userID,
        u.username,
        u.email,
        u.account_status,
        u.last_login,
        u.profile_picture,
        up.firstName,
        up.lastName,
        up.phoneNumber,
        dp.doctorID,
        dp.cabinetID,
        dp.speciality,
        dp.licenseNumber,
        dp.yearsOfExperience,
        dp.isArchived,
        dp.createdAt AS doctorCreatedAt,
        ci.cabinetname,
        ci.cabinetlocation
    FROM Users u
    LEFT JOIN UserProfile up ON up.userID = u.userID
    LEFT JOIN DoctorProfile dp ON dp.userID = u.userID
    LEFT JOIN CabinetInfo ci ON ci.cabinetID = dp.cabinetID
    WHERE u.userID = ? AND u.roleID = 2
    LIMIT 1
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userID);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();

if (!$data) {
    http_response_code(404);
    echo json_encode(['error' => 'Admin user not found']);
    exit();
}

$fullName = trim(($data['firstName'] ?? '') . ' ' . ($data['lastName'] ?? ''));
if ($fullName === '') {
    $fullName = $data['username'];
}

$response = [
    'userID'          => (int)$data['userID'],
    'userCode'        => 'USR-' . str_pad($data['userID'], 3, '0', STR_PAD_LEFT),
    'fullName'        => $fullName,
    'email'           => $data['email'],
    'phone'           => $data['phoneNumber'] ?? '',
    'status'          => $data['account_status'],
    'last_login'      => $data['last_login'],
    'roleName'        => 'Admin',
    'profile_picture' => $data['profile_picture'] ?? '',
    'speciality'      => $data['speciality'] ?? '',
    'licenseNumber'   => $data['licenseNumber'] ?? '',
    'yearsOfExperience' => $data['yearsOfExperience'] ?? null,
    'cabinetName'     => $data['cabinetname'] ?? '',
    'cabinetID'       => $data['cabinetID'] ? ('CAB-' . str_pad($data['cabinetID'], 3, '0', STR_PAD_LEFT)) : '',
    'cabinetAddress'  => $data['cabinetlocation'] ?? '',
    'createdAt'       => $data['doctorCreatedAt'],
    'isArchived'      => (int)($data['isArchived'] ?? 0),
];

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
