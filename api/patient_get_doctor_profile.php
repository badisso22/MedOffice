<?php
session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'message' => '', 'data' => null];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    if (empty($_GET['doctor_id'])) {
        throw new Exception('Missing doctor id');
    }

    $doctorID  = (int)$_GET['doctor_id'];
    $cabinetID = isset($_SESSION['activeCabinetID']) ? (int)$_SESSION['activeCabinetID'] : 0;

    $sql = "
        SELECT 
            d.doctor_id,
            u.fullName      AS doctor_name,
            d.speciality,
            d.experience_years,
            d.languages,
            d.location,
            d.photo_url,
            d.bio,
            d.education_json,
            d.expertise_json,
            IFNULL(r.avg_rating, 0)      AS avg_rating,
            IFNULL(r.review_count, 0)    AS review_count
        FROM Doctors d
        JOIN Users u ON u.userID = d.user_id
        LEFT JOIN (
            SELECT 
                doctor_id,
                AVG(overall_rating) AS avg_rating,
                COUNT(*)            AS review_count
            FROM DoctorReviews
            GROUP BY doctor_id
        ) r ON r.doctor_id = d.doctor_id
        WHERE d.doctor_id = ? 
          AND d.cabinet_id = ?
        LIMIT 1
    ";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param('ii', $doctorID, $cabinetID);
    $stmt->execute();
    $result = $stmt->get_result();
    $doctor = $result->fetch_assoc();
    $stmt->close();

    if (!$doctor) {
        throw new Exception('Doctor not found');
    }

    $doctor['education'] = [];
    if (!empty($doctor['education_json'])) {
        $doctor['education'] = json_decode($doctor['education_json'], true) ?: [];
    }

    $doctor['expertise'] = [];
    if (!empty($doctor['expertise_json'])) {
        $doctor['expertise'] = json_decode($doctor['expertise_json'], true) ?: [];
    }

    $response['success'] = true;
    $response['data']    = $doctor;
    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['message'] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
