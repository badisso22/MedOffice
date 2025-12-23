<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'message' => '', 'data' => null, 'errors' => []];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    $appointmentID = isset($_GET['appointmentID']) ? (int)$_GET['appointmentID'] : 0;
    $patientID = isset($_GET['patientID']) ? (int)$_GET['patientID'] : 0;

    if ($appointmentID <= 0 || $patientID <= 0) {
        throw new Exception('Invalid IDs');
    }

    $sqlPatient = "
        SELECT p.firstname, p.lastname, p.dateofbirth, p.gender, p.address, p.phonenumber, u.email
        FROM PatientTable p
        LEFT JOIN Users u ON u.userID = p.userID
        WHERE p.patientID = ?
        LIMIT 1
    ";
    $stmt = $conn->prepare($sqlPatient);
    $stmt->bind_param('i', $patientID);
    $stmt->execute();
    $patient = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$patient) {
        throw new Exception('Patient not found');
    }

    $age = null;
    if (!empty($patient['dateofbirth'])) {
        $dob = new DateTime($patient['dateofbirth']);
        $today = new DateTime();
        $age = $dob->diff($today)->y;
    }

    $sqlAppt = "SELECT date, appointmentTime, purpose FROM Appointments WHERE appointmentID = ? LIMIT 1";
    $stmt = $conn->prepare($sqlAppt);
    $stmt->bind_param('i', $appointmentID);
    $stmt->execute();
    $appointment = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$appointment) {
        throw new Exception('Appointment not found');
    }

    $response['success'] = true;
    $response['data'] = [
        'patient' => [
            'name' => $patient['firstname'] . ' ' . $patient['lastname'],
            'age' => $age,
            'gender' => ucfirst($patient['gender']),
            'phone' => $patient['phonenumber'],
            'address' => $patient['address'],
            'email' => $patient['email']
        ],
        'appointment' => [
            'date' => $appointment['date'],
            'time' => $appointment['appointmentTime'],
            'purpose' => $appointment['purpose']
        ]
    ];

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
