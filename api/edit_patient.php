<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'message' => '', 'errors' => [], 'data' => null];

if (!($conn instanceof mysqli)) {
    http_response_code(500);
    $response['message'] = 'Database connection error';
    echo json_encode($response);
    exit;
}

$role = $_SESSION['role'] ?? '';

if (!in_array($role, ['admin', 'assistant'], true)) {
    http_response_code(403);
    $response['message'] = 'Forbidden';
    echo json_encode($response);
    exit;
}


$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $patientID = isset($_GET['patientID']) ? (int)$_GET['patientID'] : 0;
    if ($patientID <= 0) {
        http_response_code(400);
        $response['message'] = 'Invalid patient ID';
        echo json_encode($response);
        exit;
    }

    $stmt = $conn->prepare("
        SELECT patientID, userID, firstname, lastname, dateofbirth, gender, address, phonenumber
        FROM PatientTable
        WHERE patientID = ?
    ");
    $stmt->bind_param('i', $patientID);
    $stmt->execute();
    $result  = $stmt->get_result();
    $patient = $result->fetch_assoc();
    $stmt->close();

    if (!$patient) {
        http_response_code(404);
        $response['message'] = 'Patient not found';
        echo json_encode($response);
        exit;
    }

    $response['success'] = true;
    $response['message'] = 'Patient loaded';
    $response['data']    = $patient;
    echo json_encode($response);
    exit;
}

if ($method === 'POST') {
    $patientID = isset($_POST['patientID']) ? (int)$_POST['patientID'] : 0;
    $firstName = trim($_POST['firstName'] ?? '');
    $lastName  = trim($_POST['lastName'] ?? '');
    $dob       = $_POST['dob'] ?? '';
    $gender    = $_POST['gender'] ?? '';
    $address   = trim($_POST['addr'] ?? '');
    $phone     = trim($_POST['phone'] ?? '');

    if ($patientID <= 0) {
        $response['errors'][] = 'Invalid patient ID';
    }
    if ($firstName === '') {
        $response['errors'][] = 'First name is required';
    }
    if ($lastName === '') {
        $response['errors'][] = 'Last name is required';
    }
    if ($dob === '') {
        $response['errors'][] = 'Date of birth is required';
    }
    if ($gender !== 'male' && $gender !== 'female') {
        $response['errors'][] = 'Gender is required';
    }
    if ($address === '') {
        $response['errors'][] = 'Address is required';
    }
    if ($phone === '') {
        $response['errors'][] = 'Phone number is required';
    }

    if (!empty($response['errors'])) {
        http_response_code(400);
        $response['message'] = 'Validation failed';
        echo json_encode($response);
        exit;
    }

    $stmt = $conn->prepare("SELECT userID FROM PatientTable WHERE patientID = ?");
    $stmt->bind_param('i', $patientID);
    $stmt->execute();
    $stmt->bind_result($userID);
    $stmt->fetch();
    $stmt->close();

    if (!$userID) {
        http_response_code(404);
        $response['message'] = 'Linked user not found for this patient';
        echo json_encode($response);
        exit;
    }

    try {
        $conn->begin_transaction();

        $stmt = $conn->prepare("
            UPDATE PatientTable
            SET firstname = ?, lastname = ?, dateofbirth = ?, gender = ?, address = ?, phonenumber = ?
            WHERE patientID = ?
        ");
        $stmt->bind_param(
            'ssssssi',
            $firstName,
            $lastName,
            $dob,
            $gender,
            $address,
            $phone,
            $patientID
        );
        $stmt->execute();
        $stmt->close();

        $stmt = $conn->prepare("
            UPDATE UserProfile
            SET firstName = ?, lastName = ?, dateOfBirth = ?, gender = ?, address = ?, phoneNumber = ?
            WHERE userID = ?
        ");
        $stmt->bind_param(
            'ssssssi',
            $firstName,
            $lastName,
            $dob,
            $gender,
            $address,
            $phone,
            $userID
        );
        $stmt->execute();
        $stmt->close();

        $conn->commit();

        $response['success'] = true;
        $response['message'] = 'Patient updated successfully';
        echo json_encode($response);
    } catch (Exception $e) {
        $conn->rollback();
        http_response_code(500);
        $response['message']  = 'Server error';
        $response['errors'][] = $e->getMessage();
        echo json_encode($response);
    }

    exit;
}

http_response_code(405);
$response['message'] = 'Method not allowed';
echo json_encode($response);
