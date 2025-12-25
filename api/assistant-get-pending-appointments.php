<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'data' => [], 'errors' => []];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    if (!isset($_SESSION['cabinetID'])) {
        throw new Exception('Unauthorized');
    }

    $cabinetID = (int)$_SESSION['cabinetID'];

    $sql = "
      SELECT 
        a.appointmentID,
        a.date,
        a.appointmentTime,
        a.purpose,
        a.status,
        p.name AS patientName,
        p.patientID,
        d.firstName AS doctorFirstName,
        d.lastName AS doctorLastName
      FROM Appointments a
      JOIN Patients p ON p.patientID = a.patientID
      LEFT JOIN Doctors d ON d.doctorID = a.doctorID
      WHERE a.cabinetID = ?
        AND a.status = 'pending'
      ORDER BY a.date ASC, a.appointmentTime ASC
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $cabinetID);
    $stmt->execute();
    $result = $stmt->get_result();

    $appointments = [];
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }

    $stmt->close();

    $response['success'] = true;
    $response['data'] = ['appointments' => $appointments];
    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
