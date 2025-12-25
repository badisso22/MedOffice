<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'data' => [], 'message' => '', 'errors' => []];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    $date = isset($_GET['date']) ? trim($_GET['date']) : '';
    $cabinetID = isset($_SESSION['cabinetID']) ? (int)$_SESSION['cabinetID'] : 0;

    if (!$date) {
        $response['errors'][] = 'Date is required';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }

    if (!$cabinetID) {
        $response['success'] = true;
        $response['message'] = 'No cabinet ID in session';
        $response['data'] = [];
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }

    $dayOfWeek = date('l', strtotime($date)); 

    $sql = "
        SELECT DISTINCT 
            d.doctorID,
            u.firstName,
            u.lastName,
            d.speciality,
            d.yearsOfExperience,
            da.dayOfWeek,
            da.startTime,
            da.endTime
        FROM DoctorProfile d
        INNER JOIN Users u ON d.userID = u.userID
        INNER JOIN DoctorAvailability da ON d.doctorID = da.doctorID
        WHERE d.cabinetID = ?
          AND da.dayOfWeek = ?
          AND d.isActive = 1
          AND da.isAvailable = 1
        ORDER BY u.firstName ASC
    ";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    
    $stmt->bind_param('is', $cabinetID, $dayOfWeek);
    $stmt->execute();
    $result = $stmt->get_result();

    $doctors = [];
    while ($row = $result->fetch_assoc()) {
        $doctors[] = [
            'doctorID' => (int)$row['doctorID'],
            'firstName' => $row['firstName'],
            'lastName' => $row['lastName'],
            'speciality' => $row['speciality'],
            'yearsOfExperience' => (int)$row['yearsOfExperience'],
            'dayOfWeek' => $row['dayOfWeek'],
            'startTime' => $row['startTime'],
            'endTime' => $row['endTime']
        ];
    }

    $stmt->close();

    $response['success'] = true;
    $response['data'] = $doctors;
    $response['message'] = count($doctors) > 0 ? 'Doctors found' : 'No doctors available for this date';
    
    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
?>
