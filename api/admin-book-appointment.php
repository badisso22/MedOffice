<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'message' => '', 'errors' => []];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    $raw = file_get_contents('php://input');
    $input = json_decode($raw, true);

    $patientID = isset($input['patientId']) ? (int)$input['patientId'] : 0;
    $date = isset($input['date']) ? trim($input['date']) : '';
    $time = isset($input['time']) ? trim($input['time']) : '';
    $purpose = isset($input['type']) ? trim($input['type']) : '';
    $appointmentID = isset($input['id']) ? (int)$input['id'] : 0;

    $cabinetID = isset($_SESSION['cabinetID']) ? (int)$_SESSION['cabinetID'] : 0;
    $roleID = isset($_SESSION['roleID']) ? (int)$_SESSION['roleID'] : 0;

    if (!$patientID || !$date || !$time || !$purpose || !$cabinetID) {
        throw new Exception('Missing required fields');
    }

    $doctorID = null;
    $status = 'pending'; 

    if ($roleID == 3) {
        $doctorID = isset($_SESSION['doctorID']) ? (int)$_SESSION['doctorID'] : null;
        $status = 'accepted';
    } elseif ($roleID == 2) {
        $sqlDoctor = "SELECT doctorID FROM DoctorProfile WHERE userID = ? LIMIT 1";
        $stmtDoctor = $conn->prepare($sqlDoctor);
        $stmtDoctor->bind_param('i', $_SESSION['userID']);
        $stmtDoctor->execute();
        $resDoctor = $stmtDoctor->get_result();
        $docRow = $resDoctor->fetch_assoc();
        $stmtDoctor->close();

        $doctorID = $docRow ? (int)$docRow['doctorID'] : null;
        $status = 'accepted';
    } elseif ($roleID == 4) {
        $status = 'accepted';
    }

    if ($appointmentID > 0) {
        $sql = "UPDATE Appointments SET patientID = ?, doctorID = ?, date = ?, appointmentTime = ?, purpose = ?, status = ? WHERE appointmentID = ? AND cabinetID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iisssiii', $patientID, $doctorID, $date, $time, $purpose, $status, $appointmentID, $cabinetID);
        $stmt->execute();
        $stmt->close();
        $response['message'] = 'Appointment updated successfully';
    } else {
        $timeShort = substr($time, 0, 5);
        $sql = "INSERT INTO Appointments (patientID, doctorID, date, appointmentTime, time, purpose, status, cabinetID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iisssssi', $patientID, $doctorID, $date, $time, $timeShort, $purpose, $status, $cabinetID);
        $stmt->execute();
        $stmt->close();
        $response['message'] = 'Appointment booked successfully';
    }

    $response['success'] = true;
    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
