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

    $userID      = (int)$_SESSION['userID'];
    $cabinetID   = (int)$_SESSION['cabinetID'];
    $appointmentID = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($appointmentID <= 0) {
        throw new Exception('Invalid appointment ID');
    }

    $sql = "SELECT patientID FROM PatientTable WHERE userID = ? AND cabinetID = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $userID, $cabinetID);
    $stmt->execute();
    $patientRow = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$patientRow) {
        throw new Exception('Patient not found for this account');
    }
    $patientID = (int)$patientRow['patientID'];

    $sql = "
      SELECT
        a.appointmentID,
        a.date,
        a.appointmentTime,
        a.purpose,
        a.status,
        a.consultationID,
        d.doctorID,
        up.firstName   AS doctorFirstName,
        up.lastName    AS doctorLastName,
        d.speciality   AS specialty,
        u.email        AS doctorEmail,
        up.phoneNumber AS doctorPhone
      FROM Appointments a
      LEFT JOIN DoctorProfile d ON d.doctorID = a.doctorID
      LEFT JOIN Users u ON u.userID = d.userID
      LEFT JOIN UserProfile up ON up.userID = u.userID
      WHERE a.appointmentID = ?
        AND a.patientID = ?
        AND a.cabinetID = ?
      LIMIT 1
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $appointmentID, $patientID, $cabinetID);
    $stmt->execute();
    $appt = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$appt) {
        throw new Exception('Appointment not found');
    }

    $response['success'] = true;
    $response['data'] = ['appointment' => $appt];

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
