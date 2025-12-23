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

    $cabinetID = isset($_SESSION['cabinetID']) ? (int)$_SESSION['cabinetID'] : 0;
    if ($cabinetID <= 0) {
        throw new Exception('Cabinet ID not found');
    }

    // Get cabinet info
    $sql = "SELECT cabinetname, cabinetlocation, contact_email, cabinetphonenumber, cabinetworktime, cabinetspeciality FROM CabinetInfo WHERE cabinetID = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $cabinetID);
    $stmt->execute();
    $cabinet = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$cabinet) {
        throw new Exception('Cabinet not found');
    }

    // Get stats
    $sqlPatients = "SELECT COUNT(*) as total FROM PatientTable WHERE cabinetID = ? AND archived = 0";
    $stmt = $conn->prepare($sqlPatients);
    $stmt->bind_param('i', $cabinetID);
    $stmt->execute();
    $totalPatients = $stmt->get_result()->fetch_assoc()['total'];
    $stmt->close();

    $sqlDoctors = "SELECT COUNT(*) as total FROM DoctorProfile WHERE cabinetID = ? AND isArchived = 0";
    $stmt = $conn->prepare($sqlDoctors);
    $stmt->bind_param('i', $cabinetID);
    $stmt->execute();
    $totalDoctors = $stmt->get_result()->fetch_assoc()['total'];
    $stmt->close();

    $sqlAssistants = "SELECT COUNT(*) as total FROM AssistantProfile WHERE cabinetID = ? AND isArchived = 0";
    $stmt = $conn->prepare($sqlAssistants);
    $stmt->bind_param('i', $cabinetID);
    $stmt->execute();
    $totalAssistants = $stmt->get_result()->fetch_assoc()['total'];
    $stmt->close();

    $thisMonth = date('Y-m-01');
    $sqlAppointments = "SELECT COUNT(*) as total FROM Appointments WHERE cabinetID = ? AND date >= ?";
    $stmt = $conn->prepare($sqlAppointments);
    $stmt->bind_param('is', $cabinetID, $thisMonth);
    $stmt->execute();
    $totalAppointments = $stmt->get_result()->fetch_assoc()['total'];
    $stmt->close();

    $response['success'] = true;
    $response['data'] = [
        'cabinet' => [
            'name' => $cabinet['cabinetname'],
            'location' => $cabinet['cabinetlocation'],
            'email' => $cabinet['contact_email'],
            'phone' => $cabinet['cabinetphonenumber'],
            'hours' => $cabinet['cabinetworktime'],
            'specialty' => $cabinet['cabinetspeciality']
        ],
        'stats' => [
            'patients' => $totalPatients,
            'doctors' => $totalDoctors,
            'assistants' => $totalAssistants,
            'appointments' => $totalAppointments
        ]
    ];

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
