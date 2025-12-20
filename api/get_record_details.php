<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'message' => '', 'errors' => [], 'data' => null];

$consultationID = isset($_GET['consultationID']) ? (int)$_GET['consultationID'] : 0;
if ($consultationID <= 0) {
    http_response_code(400);
    $response['message'] = 'Invalid record ID';
    echo json_encode($response);
    exit;
}

$doctorName = isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'User';

try {
    $stmt = $conn->prepare("
        SELECT 
            pci.consultationID,
            pci.consultationdate,
            pci.consultationtype,
            pci.symptoms,
            pci.diagnosis,
            pci.treatmentplan,
            pci.additionalnotes,
            pci.nextappointment,
            pci.medicalfees,
            p.patientID,
            p.firstname,
            p.lastname
        FROM PatientConsultationInfo pci
        JOIN PatientTable p ON pci.PatientID = p.patientID
        WHERE pci.consultationID = ?
    ");
    $stmt->bind_param('i', $consultationID);
    $stmt->execute();
    $result = $stmt->get_result();
    $record = $result->fetch_assoc();
    $stmt->close();

    if (!$record) {
        http_response_code(404);
        $response['message'] = 'Record not found';
        echo json_encode($response);
        exit;
    }

    $record['doctorName'] = $doctorName;

    $response['success'] = true;
    $response['message'] = 'Record loaded';
    $response['data']    = $record;

    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(500);
    $response['message'] = 'Server error';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response);
}
