<?php
// superadmin_get_admins.php
session_start();
require '../config/config.php';

// Only superadmin (roleID = 1) can call this
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true || $_SESSION['roleID'] != 1) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

// archived=0 => active list, archived=1 => archived list
$archived = isset($_GET['archived']) && $_GET['archived'] == '1' ? 1 : 0;

// Admins are roleID = 2 (Roles table) [file:2]
// They also have a DoctorProfile row that contains cabinetID and isArchived. [file:2]
$sql = "
    SELECT 
        u.userID,
        u.username,
        u.email,
        u.account_status,
        u.last_login,
        up.firstName,
        up.lastName,
        dp.isArchived,
        ci.cabinetname
    FROM Users u
    INNER JOIN DoctorProfile dp ON dp.userID = u.userID
    LEFT JOIN UserProfile up ON up.userID = u.userID
    LEFT JOIN CabinetInfo ci ON ci.cabinetID = dp.cabinetID
    WHERE u.roleID = 2
      AND dp.isArchived = ?
      AND u.account_status <> 'deleted'
    ORDER BY u.userID ASC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $archived);
$stmt->execute();
$result = $stmt->get_result();

$admins = [];
while ($row = $result->fetch_assoc()) {
    $fullName = trim(($row['firstName'] ?? '') . ' ' . ($row['lastName'] ?? ''));
    if ($fullName === '') {
        $fullName = $row['username'];
    }

    $admins[] = [
        'userID'     => (int)$row['userID'],
        'username'   => $row['username'],
        'fullName'   => $fullName,
        'email'      => $row['email'],
        'cabinet'    => $row['cabinetname'] ?? '—',
        'status'     => $row['account_status'],
        'last_login' => $row['last_login'],
        'isArchived' => (int)$row['isArchived'],
    ];
}

$stmt->close();

header('Content-Type: application/json; charset=utf-8');
echo json_encode(['data' => $admins]);
