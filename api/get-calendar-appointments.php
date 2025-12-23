<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'message' => '', 'appointments' => [], 'errors' => []];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    $cabinetID = isset($_SESSION['cabinetID']) ? (int)$_SESSION['cabinetID'] : 0;
    $roleID = isset($_SESSION['roleID']) ? (int)$_SESSION['roleID'] : 0;

    if ($cabinetID <= 0) {
        throw new Exception('Cabinet ID not found');
    }

    $month = isset($_GET['month']) ? (int)$_GET['month'] : date('n');
    $year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

    $startDate = "$year-" . str_pad($month, 2, '0', STR_PAD_LEFT) . "-01";
    $endDate = date('Y-m-t', strtotime($startDate));

    if ($roleID == 3) {
        $doctorID = isset($_SESSION['doctorID']) ? (int)$_SESSION['doctorID'] : 0;
        $sql = "
            SELECT a.appointmentID, a.patientID, a.date, a.appointmentTime, a.purpose, a.status,
                   p.firstname, p.lastname, p.phonenumber
            FROM Appointments a
            INNER JOIN PatientTable p ON p.patientID = a.patientID
            WHERE a.doctorID = ? AND a.cabinetID = ? AND a.date BETWEEN ? AND ?
            ORDER BY a.date, a.appointmentTime
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iiss', $doctorID, $cabinetID, $startDate, $endDate);
    } else {
        $sql = "
            SELECT a.appointmentID, a.patientID, a.date, a.appointmentTime, a.purpose, a.status,
                   p.firstname, p.lastname, p.phonenumber
            FROM Appointments a
            INNER JOIN PatientTable p ON p.patientID = a.patientID
            WHERE a.cabinetID = ? AND a.date BETWEEN ? AND ?
            ORDER BY a.date, a.appointmentTime
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iss', $cabinetID, $startDate, $endDate);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $appointments = [];
    while ($row = $result->fetch_assoc()) {
        $appointments[] = [
            'id' => (int)$row['appointmentID'],
            'patientId' => (int)$row['patientID'],
            'patientName' => $row['firstname'] . ' ' . $row['lastname'],
            'patientPhone' => $row['phonenumber'],
            'date' => $row['date'],
            'time' => substr($row['appointmentTime'], 0, 5),
            'type' => $row['purpose'],
            'status' => $row['status']
        ];
    }
    $stmt->close();

    $response['success'] = true;
    $response['appointments'] = $appointments;
    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
