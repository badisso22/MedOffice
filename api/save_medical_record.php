<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'message' => '', 'errors' => [], 'data' => []];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    $response['message'] = 'Method not allowed';
    echo json_encode($response);
    exit;
}

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection not initialized');
    }

    $patientID        = isset($_POST['patient_id']) ? (int)$_POST['patient_id'] : 0;
    $consultationdate = $_POST['consultationdate'] ?? '';
    $consultationtype = $_POST['consultationtype'] ?? '';
    $symptoms         = trim($_POST['symptoms'] ?? '');
    $diagnosis        = trim($_POST['diagnosis'] ?? '');
    $treatmentplan    = trim($_POST['treatmentplan'] ?? '');
    $additionalnotes  = trim($_POST['additionalnotes'] ?? '');
    $nextappointment  = $_POST['nextappointment'] ?? '';
    $medicalfees      = $_POST['medicalfees'] ?? null;

    if ($patientID <= 0) {
        $response['errors'][] = 'Invalid patient ID';
    }
    if ($consultationdate === '') {
        $response['errors'][] = 'Consultation date is required';
    }
    if ($consultationtype === '') {
        $response['errors'][] = 'Consultation type is required';
    }
    if ($symptoms === '') {
        $response['errors'][] = 'Symptoms summary is required';
    }
    if ($diagnosis === '') {
        $response['errors'][] = 'Diagnosis is required';
    }
    if ($treatmentplan === '') {
        $response['errors'][] = 'Treatment plan is required';
    }

    if (!empty($response['errors'])) {
        http_response_code(400);
        $response['message'] = 'Validation failed';
        echo json_encode($response);
        exit;
    }

    if ($nextappointment === '') {
        $nextappointment = date('Y-m-d', strtotime($consultationdate . ' +6 months'));
    }

    $summaryfilePath = null;
    if (!empty($_FILES['summaryfile']['name']) && $_FILES['summaryfile']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/records/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $ext        = pathinfo($_FILES['summaryfile']['name'], PATHINFO_EXTENSION);
        $safeName   = 'record_' . $patientID . '_' . time() . '.' . $ext;
        $targetPath = $uploadDir . $safeName;

        if (move_uploaded_file($_FILES['summaryfile']['tmp_name'], $targetPath)) {
            $summaryfilePath = 'uploads/records/' . $safeName;
        } else {
            $response['errors'][] = 'File upload failed';
            http_response_code(400);
            $response['message'] = 'Upload error';
            echo json_encode($response);
            exit;
        }
    }

    if ($medicalfees === '' || $medicalfees === null) {
        $medicalfeesParam = null;
    } else {
        $medicalfeesParam = (float)$medicalfees;
    }

    $sql = "
        INSERT INTO PatientConsultationInfo
        (PatientID, consultationdate, consultationtype, symptoms, diagnosis,
         treatmentplan, additionalnotes, nextappointment, medicalfees, filepath, summaryfile)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NULL, ?)
    ";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param(
        'isssssssds',
        $patientID,    
        $consultationdate,   
        $consultationtype,  
        $symptoms,           
        $diagnosis,          
        $treatmentplan,     
        $additionalnotes,    
        $nextappointment,    
        $medicalfeesParam,   
        $summaryfilePath     
    );

    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        throw new Exception('Insert failed');
    }

    $newID = $stmt->insert_id;
    $stmt->close();

    $response['success'] = true;
    $response['message'] = 'Medical record saved';
    $response['data']    = ['consultationID' => $newID];

    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(500);
    $response['success'] = false;
    $response['message'] = 'Server error';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response);
}
