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
    if (!isset($_SESSION['activeCabinetID'])) {
        throw new Exception('Unauthorized');
    }

    $cabinetID = (int)$_SESSION['activeCabinetID'];
    if ($cabinetID <= 0) {
        throw new Exception('Cabinet ID not found');
    }

    $sql = "
      SELECT 
        a.appointmentID,
        a.date,
        a.appointmentTime,
        a.purpose,
        a.status,
        CONCAT(p.firstname, ' ', p.lastname) AS patientName,
        p.patientID,
        up.firstName AS doctorFirstName,
        up.lastName  AS doctorLastName
      FROM Appointments a
      JOIN PatientTable p ON p.patientID = a.patientID
      LEFT JOIN DoctorProfile d ON d.doctorID = a.doctorID
      LEFT JOIN Users u ON u.userID = d.userID
      LEFT JOIN UserProfile up ON up.userID = u.userID
      WHERE a.cabinetID = ?
        AND a.status = 'pending'
      ORDER BY a.date ASC, a.appointmentTime ASC
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
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
