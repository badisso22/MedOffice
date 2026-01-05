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

    if (
        empty($_SESSION['loggedIn']) ||
        !isset($_SESSION['userID'], $_SESSION['roleID'], $_SESSION['activeCabinetID']) ||
        (int)$_SESSION['roleID'] !== 5
    ) {
        throw new Exception('Unauthorized');
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method');
    }

    $userID    = (int)$_SESSION['userID'];
    $cabinetID = (int)$_SESSION['activeCabinetID'];
    if ($cabinetID <= 0) {
        throw new Exception('Cabinet ID not found');
    }

    $sql = "
        SELECT patientID 
        FROM PatientTable 
        WHERE userID = ? AND cabinetID = ?
        LIMIT 1
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('ii', $userID, $cabinetID);
    $stmt->execute();
    $patRow = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$patRow) {
        throw new Exception('Patient not found');
    }
    $patientID = (int)$patRow['patientID'];

    $raw   = file_get_contents('php://input');
    $input = json_decode($raw, true);
    if (!is_array($input)) {
        throw new Exception('Invalid JSON payload');
    }

    $appointmentID = isset($input['appointmentID']) ? (int)$input['appointmentID'] : 0;
    if ($appointmentID <= 0) {
        $response['errors'][] = 'Missing appointment ID.';
    }

    $medicalAssistantRating      = isset($input['medicalStaff']) ? (int)$input['medicalStaff'] : null;
    $doctorCompetenceRating      = isset($input['doctorCompetence']) ? (int)$input['doctorCompetence'] : null;
    $appointmentPunctualityRating= isset($input['appointmentPunctuality']) ? (int)$input['appointmentPunctuality'] : null;
    $cleanlinessRating           = isset($input['cleanliness']) ? (int)$input['cleanliness'] : null;
    $equipmentQualityRating      = isset($input['equipmentQuality']) ? (int)$input['equipmentQuality'] : null;
    $parkingAvailabilityRating   = isset($input['parkingAvailability']) ? (int)$input['parkingAvailability'] : null;

    $appointmentMethod           = isset($input['appointmentMethod']) ? trim($input['appointmentMethod']) : '';
    $feedbackTitle               = isset($input['feedbackTitle']) ? trim($input['feedbackTitle']) : '';
    $feedbackMessage             = isset($input['feedbackMessage']) ? trim($input['feedbackMessage']) : '';

    if ($appointmentMethod === '') {
        $response['errors'][] = 'Appointment method is required.';
    }

    if (
        $medicalAssistantRating === null &&
        $doctorCompetenceRating === null &&
        $appointmentPunctualityRating === null &&
        $cleanlinessRating === null &&
        $equipmentQualityRating === null &&
        $parkingAvailabilityRating === null
    ) {
        $response['errors'][] = 'Please provide at least one rating.';
    }

    if (!empty($response['errors'])) {
        http_response_code(400);
        $response['message'] = 'Validation failed';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }

    $sql = "
        INSERT INTO PatientFeedback (
            patient_id,
            cabinet_id,
            appointment_id,
            medical_assistant_rating,
            doctor_competence_rating,
            appointment_punctuality_rating,
            cleanliness_rating,
            equipment_quality_rating,
            parking_availability_rating,
            appointment_method,
            feedback_title,
            feedback_message,
            created_at
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW()
        )
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param(
        'iiiIIIIIIsss',
        $patientID,
        $cabinetID,
        $appointmentID,
        $medicalAssistantRating,
        $doctorCompetenceRating,
        $appointmentPunctualityRating,
        $cleanlinessRating,
        $equipmentQualityRating,
        $parkingAvailabilityRating,
        $appointmentMethod,
        $feedbackTitle,
        $feedbackMessage
    );

    $stmt->execute();
    if ($stmt->affected_rows <= 0) {
        throw new Exception('Could not save feedback');
    }
    $stmt->close();

    $response['success'] = true;
    $response['message'] = 'Feedback submitted successfully';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
