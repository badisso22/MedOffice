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

    $raw   = file_get_contents('php://input');
    $input = json_decode($raw, true);

    $appointmentID    = isset($input['appointmentID']) ? (int)$input['appointmentID'] : 0;
    $patientID        = isset($input['patientID']) ? (int)$input['patientID'] : 0;
    $consultationType = isset($input['consultationType']) ? trim($input['consultationType']) : '';
    $consultationDate = isset($input['consultationDate']) ? trim($input['consultationDate']) : '';
    $symptoms         = isset($input['symptoms']) ? trim($input['symptoms']) : '';
    $diagnosis        = isset($input['diagnosis']) ? trim($input['diagnosis']) : '';
    $treatmentPlan    = isset($input['treatmentPlan']) ? trim($input['treatmentPlan']) : '';
    $additionalNotes  = isset($input['additionalNotes']) ? trim($input['additionalNotes']) : '';
    $medicalFees      = isset($input['medicalFees']) ? (float)$input['medicalFees'] : 0;

    $nextAppointment = date('Y-m-d', strtotime('+1 month'));

    if (
        !$patientID || !$consultationType || !$consultationDate ||
        !$symptoms || !$diagnosis || !$treatmentPlan || !$additionalNotes
    ) {
        throw new Exception('Missing required fields');
    }

    $sql = "
        INSERT INTO PatientConsultationInfo 
        (PatientID, consultationdate, consultationtype, symptoms, diagnosis, treatmentplan, additionalnotes, nextappointment, medicalfees) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        'isssssssd',
        $patientID,
        $consultationDate,
        $consultationType,
        $symptoms,
        $diagnosis,
        $treatmentPlan,
        $additionalNotes,
        $nextAppointment,
        $medicalFees
    );
    $stmt->execute();
    $consultationID = $stmt->insert_id;
    $stmt->close();

    $sqlUpdate = "UPDATE Appointments SET status = 'completed', consultationID = ? WHERE appointmentID = ?";
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param('ii', $consultationID, $appointmentID);
    $stmt->execute();
    $stmt->close();

    $sqlPat = "
        SELECT 
            p.userID,
            p.cabinetID,
            p.firstname,
            p.lastname
        FROM PatientTable p
        WHERE p.patientID = ?
        LIMIT 1
    ";
    $stmt = $conn->prepare($sqlPat);
    $stmt->bind_param('i', $patientID);
    $stmt->execute();
    $patRow = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($patRow && !empty($patRow['userID'])) {
        $patientUserID = (int)$patRow['userID'];
        $cabinetID     = (int)$patRow['cabinetID'];

        $feedbackLink = '../Patient/feedBack.php?appointmentID=' . urlencode((string)$appointmentID);

        $title   = 'How was your recent visit?';
        $message = 'You had a consultation on ' . $consultationDate .
                   ' for ' . $consultationType .
                   '. Please share your feedback about your experience.';

        $sqlNotif = "
            INSERT INTO Notifications (
                userID,
                cabinetID,
                type,
                title,
                message,
                link,
                isRead,
                createdAt
            ) VALUES (
                ?, ?, ?, ?, ?, ?, 0, NOW()
            )
        ";
        $stmt = $conn->prepare($sqlNotif);
        $type = 'patient_feedback';
        $stmt->bind_param(
            'iissss',
            $patientUserID,
            $cabinetID,
            $type,
            $title,
            $message,
            $feedbackLink
        );
        $stmt->execute();
        $stmt->close();
    }

    $response['success'] = true;
    $response['message'] = 'Consultation record saved and appointment completed';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
