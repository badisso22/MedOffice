<?php
session_start();
require '../config/config.php';
header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'data' => [], 'errors' => []];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    if (empty($_SESSION['loggedIn']) || !isset($_SESSION['userID'], $_SESSION['cabinetID']) || $_SESSION['roleID'] != 5) {
        throw new Exception('Unauthorized');
    }

    $userID    = (int)$_SESSION['userID'];
    $cabinetID = (int)$_SESSION['cabinetID'];

    $sql = "SELECT patientID FROM PatientTable WHERE userID = ? AND cabinetID = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $userID, $cabinetID);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$row) {
        throw new Exception('Patient record not found for this user');
    }
    $patientID = (int)$row['patientID'];

    $sql = "
      SELECT 
        a.appointmentID,
        a.date,
        a.appointmentTime,
        a.purpose,
        a.status,
        d.doctorID,
        up.firstName AS doctorFirstName,
        up.lastName  AS doctorLastName,
        d.speciality AS specialty
      FROM Appointments a
      LEFT JOIN DoctorProfile d ON d.doctorID = a.doctorID
      LEFT JOIN Users u ON u.userID = d.userID
      LEFT JOIN UserProfile up ON up.userID = u.userID
      WHERE a.patientID = ?
        AND a.cabinetID = ?
      ORDER BY a.date DESC, a.appointmentTime DESC
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $patientID, $cabinetID);
    $stmt->execute();
    $res = $stmt->get_result();

    $appointments = [];
    while ($row = $res->fetch_assoc()) {
        $appointments[] = $row;
    }
    $stmt->close();

    $response['success'] = true;
    $response['data'] = ['appointments' => $appointments];

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
