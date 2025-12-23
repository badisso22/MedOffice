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

    $cabinetID = isset($_SESSION['cabinetID']) ? (int)$_SESSION['cabinetID'] : 0;
    if ($cabinetID <= 0) {
        throw new Exception('Cabinet ID not found');
    }

    $raw = file_get_contents('php://input');
    $input = json_decode($raw, true);

    $cabinetName = isset($input['cabinetName']) ? trim($input['cabinetName']) : '';
    $location = isset($input['location']) ? trim($input['location']) : '';
    $email = isset($input['email']) ? trim($input['email']) : '';
    $phone = isset($input['phone']) ? trim($input['phone']) : '';
    $specialty = isset($input['specialty']) ? trim($input['specialty']) : '';
    $workStartTime = isset($input['workStartTime']) ? trim($input['workStartTime']) : '';
    $workEndTime = isset($input['workEndTime']) ? trim($input['workEndTime']) : '';
    $workingHoursText = isset($input['workingHoursText']) ? trim($input['workingHoursText']) : '';

    if (!$cabinetName || !$location || !$email || !$phone || !$workStartTime || !$workEndTime) {
        throw new Exception('Missing required fields');
    }

    $sql = "
        UPDATE CabinetInfo 
        SET cabinetname = ?, 
            cabinetlocation = ?, 
            contact_email = ?, 
            cabinetphonenumber = ?,
            cabinetspeciality = ?,
            workStartTime = ?,
            workEndTime = ?,
            cabinetworktime = ?
        WHERE cabinetID = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssssi', $cabinetName, $location, $email, $phone, $specialty, $workStartTime, $workEndTime, $workingHoursText, $cabinetID);
    $stmt->execute();
    $stmt->close();

    $response['success'] = true;
    $response['message'] = 'Cabinet information updated successfully';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
