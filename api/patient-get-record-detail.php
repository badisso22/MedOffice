<?php
session_start();
require '../config/config.php';
header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'data' => null, 'errors' => []];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    if (empty($_SESSION['loggedIn']) || !isset($_SESSION['userID'], $_SESSION['cabinetID']) || $_SESSION['roleID'] != 5) {
        throw new Exception('Unauthorized');
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception('Invalid request method');
    }

    $userID    = (int)$_SESSION['userID'];
    $cabinetID = (int)$_SESSION['cabinetID'];

    $consultationID = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if ($consultationID <= 0) {
        throw new Exception('Invalid record ID');
    }

    $sql = "SELECT patientID FROM PatientTable WHERE userID = ? AND cabinetID = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $userID, $cabinetID);
    $stmt->execute();
    $patientRow = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$patientRow) {
        throw new Exception('Patient not found');
    }

    $patientID = (int)$patientRow['patientID'];

    $sql = "SELECT consultationID, consultationdate, consultationtype, symptoms,
                   diagnosis, treatmentplan, additionalnotes, nextappointment,
                   medicalfees
            FROM PatientConsultationInfo
            WHERE consultationID = ? AND PatientID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $consultationID, $patientID);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    $stmt->close();

    if (!$row) {
        throw new Exception('Record not found');
    }

    $response['success'] = true;
    $response['data'] = [
        'id'              => (int)$row['consultationID'],
        'date'            => $row['consultationdate'],
        'type'            => $row['consultationtype'], 
        'symptoms'        => $row['symptoms'],
        'diagnosis'       => $row['diagnosis'],
        'treatmentplan'   => $row['treatmentplan'],
        'additionalnotes' => $row['additionalnotes'],
        'nextappointment' => $row['nextappointment'],
        'medicalfees'     => $row['medicalfees'],
    ];

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
