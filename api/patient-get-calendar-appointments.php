<?php
session_start();
require '../config/config.php';
header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'appointments' => [], 'errors' => []];

try {
    if (!isset($_SESSION['patientID'])) {
        throw new Exception('Not authenticated as patient');
    }

    $patientID = (int)$_SESSION['patientID'];  // from login
    $month = isset($_GET['month']) ? (int)$_GET['month'] : 0;
    $year  = isset($_GET['year']) ? (int)$_GET['year'] : 0;

    if ($month < 1 || $month > 12 || $year < 2000) {
        throw new Exception('Invalid month/year');
    }

    $startDate = sprintf('%04d-%02d-01', $year, $month);
    $endDate   = date('Y-m-t', strtotime($startDate));

    $sql = "
        SELECT 
            a.appointmentID,
            a.date,
            a.time,
            a.purpose,
            a.status,
            a.cabinetID,
            d.doctorID,
            up.firstName,
            up.lastName
        FROM Appointments a
        LEFT JOIN DoctorProfile d ON d.doctorID = a.doctorID
        LEFT JOIN Users u ON u.userID = d.userID
        LEFT JOIN UserProfile up ON up.userID = u.userID
        WHERE a.patientID = ? 
          AND a.date BETWEEN ? AND ?
        ORDER BY a.date, a.time
    ";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('iss', $patientID, $startDate, $endDate);
    $stmt->execute();
    $result = $stmt->get_result();

    $appointments = [];
    while ($row = $result->fetch_assoc()) {
        $appointments[] = [
            'id'          => (int)$row['appointmentID'],
            'date'        => $row['date'],
            'time'        => $row['time'],
            'type'        => $row['purpose'],
            'status'      => $row['status'],
            'doctorId'    => $row['doctorID'] ? (int)$row['doctorID'] : null,
            'doctorName'  => trim(($row['firstName'] ?? '') . ' ' . ($row['lastName'] ?? '')),
            'cabinetID'   => (int)$row['cabinetID'],
        ];
    }

    $response['success'] = true;
    $response['appointments'] = $appointments;
} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
