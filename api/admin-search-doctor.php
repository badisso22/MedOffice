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
    'doctors' => [],
    'errors'  => [],
];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    $searchName = isset($_GET['searchName']) ? trim($_GET['searchName']) : '';

    $sql = "
        SELECT
            dp.doctorID,
            dp.userID,
            dp.cabinetID,
            dp.speciality,
            dp.isActive,
            dp.isArchived,
            up.firstName,
            up.lastName,
            up.dateOfBirth,
            up.phoneNumber,
            u.email
        FROM DoctorProfile dp
        INNER JOIN Users u ON u.userID = dp.userID
        INNER JOIN UserProfile up ON up.userID = u.userID
        WHERE dp.isArchived = 0
    ";

    $params = [];
    $types  = '';

    $cabinetID = isset($_SESSION['activeCabinetID']) ? (int)$_SESSION['activeCabinetID'] : null;
    if ($cabinetID !== null) {
        $sql    .= " AND dp.cabinetID = ?";
        $types  .= 'i';
        $params[] = $cabinetID;
    }

    if ($searchName !== '') {
        $sql    .= " AND CONCAT(up.firstName, ' ', up.lastName) LIKE ?";
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

    $doctors = [];
    $today = new DateTime();

    while ($row = $result->fetch_assoc()) {
        $age = null;
        if (!empty($row['dateOfBirth'])) {
            $dob = new DateTime($row['dateOfBirth']);
            $age = $dob->diff($today)->y;
        }

        $doctors[] = [
            'doctorID'   => (int)$row['doctorID'],
            'fullName'   => $row['firstName'] . ' ' . $row['lastName'],
            'speciality' => $row['speciality'],
            'age'        => $age,
            'email'      => $row['email'],
            'phone'      => $row['phoneNumber'],
            'isActive'   => (int)$row['isActive'],
        ];
    }

    $response['success'] = true;
    $response['message'] = 'Doctors loaded';
    $response['doctors'] = $doctors;

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(500);
    $response['success'] = false;
    $response['message'] = 'Server error';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
