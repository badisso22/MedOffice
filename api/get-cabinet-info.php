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

    $cabinetID = isset($_SESSION['activeCabinetID']) ? (int)$_SESSION['activeCabinetID'] : 0;
    if ($cabinetID <= 0) {
        throw new Exception('Cabinet ID not found');
    }

    $sql = "
        SELECT 
            cabinetname,
            cabinetlocation,
            contact_email,
            cabinetphonenumber,
            cabinetworktime,
            cabinetspeciality,
            workStartTime,
            workEndTime,
            cabinetbio,
            websiteUrl,
            facebookUrl,
            twitterUrl,
            instagramUrl,
            linkedinUrl
        FROM CabinetInfo
        WHERE cabinetID = ?
        LIMIT 1
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('i', $cabinetID);
    $stmt->execute();
    $cabinet = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$cabinet) {
        throw new Exception('Cabinet not found');
    }

    $sqlPatients = "
        SELECT COUNT(*) AS total 
        FROM PatientTable 
        WHERE cabinetID = ? AND archived = 0
    ";
    $stmt = $conn->prepare($sqlPatients);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('i', $cabinetID);
    $stmt->execute();
    $totalPatients = $stmt->get_result()->fetch_assoc()['total'] ?? 0;
    $stmt->close();

    $sqlDoctors = "
        SELECT COUNT(*) AS total 
        FROM DoctorProfile 
        WHERE cabinetID = ? AND isArchived = 0
    ";
    $stmt = $conn->prepare($sqlDoctors);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('i', $cabinetID);
    $stmt->execute();
    $totalDoctors = $stmt->get_result()->fetch_assoc()['total'] ?? 0;
    $stmt->close();

    $sqlFacilities = "
        SELECT facility 
        FROM CabinetFacilities 
        WHERE cabinetID = ? 
        ORDER BY facility
    ";
    $stmt = $conn->prepare($sqlFacilities);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('i', $cabinetID);
    $stmt->execute();
    $resFacilities = $stmt->get_result();
    $facilities = [];
    while ($row = $resFacilities->fetch_assoc()) {
        $facilities[] = $row['facility'];
    }
    $stmt->close();

    $sqlPricing = "
        SELECT serviceName, price 
        FROM Pricing 
        WHERE cabinetID = ? AND isActive = 1
    ";
    $stmt = $conn->prepare($sqlPricing);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('i', $cabinetID);
    $stmt->execute();
    $resPricing = $stmt->get_result();
    $pricing = [];
    while ($row = $resPricing->fetch_assoc()) {
        $pricing[] = [
            'service' => $row['serviceName'],
            'price'   => (float)$row['price']
        ];
    }
    $stmt->close();

    $sqlAssistants = "
        SELECT COUNT(*) AS total 
        FROM AssistantProfile 
        WHERE cabinetID = ? AND isArchived = 0
    ";
    $stmt = $conn->prepare($sqlAssistants);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('i', $cabinetID);
    $stmt->execute();
    $totalAssistants = $stmt->get_result()->fetch_assoc()['total'] ?? 0;
    $stmt->close();

    $thisMonth = date('Y-m-01');
    $sqlAppointments = "
        SELECT COUNT(*) AS total 
        FROM Appointments 
        WHERE cabinetID = ? AND date >= ?
    ";
    $stmt = $conn->prepare($sqlAppointments);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('is', $cabinetID, $thisMonth);
    $stmt->execute();
    $totalAppointments = $stmt->get_result()->fetch_assoc()['total'] ?? 0;
    $stmt->close();

    $response['success'] = true;
    $response['data'] = [
        'cabinet' => [
            'name'          => $cabinet['cabinetname'],
            'location'      => $cabinet['cabinetlocation'],
            'email'         => $cabinet['contact_email'],
            'phone'         => $cabinet['cabinetphonenumber'],
            'hours'         => $cabinet['cabinetworktime'],
            'specialty'     => $cabinet['cabinetspeciality'],
            'workStartTime' => $cabinet['workStartTime'],
            'workEndTime'   => $cabinet['workEndTime'],
            'bio'           => $cabinet['cabinetbio'],
            'websiteUrl'    => $cabinet['websiteUrl'],
            'facebookUrl'   => $cabinet['facebookUrl'],
            'twitterUrl'    => $cabinet['twitterUrl'],
            'instagramUrl'  => $cabinet['instagramUrl'],
            'linkedinUrl'   => $cabinet['linkedinUrl'],
        ],
        'facilities' => $facilities,
        'pricing'    => $pricing,
        'stats'      => [
            'patients'     => $totalPatients,
            'doctors'      => $totalDoctors,
            'assistants'   => $totalAssistants,
            'appointments' => $totalAppointments,
        ]
    ];

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
