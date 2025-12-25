<?php
session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = [
    'success' => false,
    'message' => '',
    'data'    => [],
    'errors'  => []
];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    $cabinetID = isset($_SESSION['cabinetID']) ? (int)$_SESSION['cabinetID'] : 0;
    if (!$cabinetID) {
        throw new Exception('Cabinet ID not found in session');
    }

    $sql = "
        SELECT DISTINCT
            dp.doctorID,
            up.firstName,
            up.lastName,
            dp.speciality,
            da.startTime,
            da.endTime,
            da.dayOfWeek
        FROM DoctorProfile dp
        INNER JOIN UserProfile up ON up.userID = dp.userID
        INNER JOIN DoctorAvailability da ON da.doctorID = dp.doctorID
        WHERE dp.isArchived = 0
          AND dp.isActive = 1
          AND dp.cabinetID = ?
          AND da.isAvailable = 1
        ORDER BY up.firstName, up.lastName
    ";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param('i', $cabinetID);
    $stmt->execute();
    $result = $stmt->get_result();

    $doctors = [];
    while ($row = $result->fetch_assoc()) {
        $doctors[] = [
            'doctorID'  => (int)$row['doctorID'],
            'firstName' => $row['firstName'],
            'lastName'  => $row['lastName'],
            'specialty' => $row['speciality'],
            'startTime' => $row['startTime'],
            'endTime'   => $row['endTime'],
            'dayOfWeek' => $row['dayOfWeek']
        ];
    }
    $stmt->close();

    $response['success'] = true;
    $response['message'] = 'Doctors loaded';
    $response['data']    = $doctors;
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    http_response_code(500);
    $response['success'] = false;
    $response['message'] = 'Server error';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
