<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = [
    'success' => false,
    'message' => '',
    'data' => null,
    'errors' => []
];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    $cabinetID = isset($_SESSION['cabinetID']) ? (int)$_SESSION['cabinetID'] : 0;
    if ($cabinetID <= 0) {
        throw new Exception('Cabinet ID not found');
    }

    $period = isset($_GET['period']) ? $_GET['period'] : 'month';
    
    $today = date('Y-m-d');
    switch ($period) {
        case 'today':
            $startDate = $today;
            $endDate = $today;
            break;
        case 'week':
            $startDate = date('Y-m-d', strtotime('-7 days'));
            $endDate = $today;
            break;
        case 'month':
            $startDate = date('Y-m-01');
            $endDate = date('Y-m-t');
            break;
        case 'year':
            $startDate = date('Y-01-01');
            $endDate = date('Y-12-31');
            break;
        default:
            $startDate = '2000-01-01';
            $endDate = $today;
    }

    $sqlPatients = "SELECT COUNT(*) as total FROM PatientTable WHERE cabinetID = ? AND archived = 0";
    $stmt = $conn->prepare($sqlPatients);
    $stmt->bind_param('i', $cabinetID);
    $stmt->execute();
    $totalPatients = $stmt->get_result()->fetch_assoc()['total'];
    $stmt->close();

    $sqlAppointments = "SELECT COUNT(*) as total FROM Appointments WHERE cabinetID = ? AND date BETWEEN ? AND ?";
    $stmt = $conn->prepare($sqlAppointments);
    $stmt->bind_param('iss', $cabinetID, $startDate, $endDate);
    $stmt->execute();
    $totalAppointments = $stmt->get_result()->fetch_assoc()['total'];
    $stmt->close();

    $sqlRevenue = "
        SELECT SUM(medicalfees) as total 
        FROM PatientConsultationInfo c
        INNER JOIN PatientTable p ON p.patientID = c.PatientID
        WHERE p.cabinetID = ? AND c.consultationdate BETWEEN ? AND ?
    ";
    $stmt = $conn->prepare($sqlRevenue);
    $stmt->bind_param('iss', $cabinetID, $startDate, $endDate);
    $stmt->execute();
    $totalRevenue = $stmt->get_result()->fetch_assoc()['total'] ?? 0;
    $stmt->close();

    $sqlCompleted = "SELECT COUNT(*) as total FROM PatientConsultationInfo c INNER JOIN PatientTable p ON p.patientID = c.PatientID WHERE p.cabinetID = ? AND c.consultationdate BETWEEN ? AND ?";
    $stmt = $conn->prepare($sqlCompleted);
    $stmt->bind_param('iss', $cabinetID, $startDate, $endDate);
    $stmt->execute();
    $completedConsultations = $stmt->get_result()->fetch_assoc()['total'];
    $stmt->close();

    $sqlAge = "
        SELECT 
            CASE
                WHEN YEAR(CURDATE()) - YEAR(dateofbirth) BETWEEN 0 AND 18 THEN '0-18'
                WHEN YEAR(CURDATE()) - YEAR(dateofbirth) BETWEEN 19 AND 35 THEN '19-35'
                WHEN YEAR(CURDATE()) - YEAR(dateofbirth) BETWEEN 36 AND 55 THEN '36-55'
                ELSE '56+'
            END as ageGroup,
            COUNT(*) as count
        FROM PatientTable
        WHERE cabinetID = ? AND archived = 0
        GROUP BY ageGroup
    ";
    $stmt = $conn->prepare($sqlAge);
    $stmt->bind_param('i', $cabinetID);
    $stmt->execute();
    $ageResult = $stmt->get_result();
    $ageDistribution = [];
    $totalPatientsForAge = 0;
    while ($row = $ageResult->fetch_assoc()) {
        $ageDistribution[$row['ageGroup']] = (int)$row['count'];
        $totalPatientsForAge += (int)$row['count'];
    }
    $stmt->close();

    foreach (['0-18', '19-35', '36-55', '56+'] as $group) {
        if (!isset($ageDistribution[$group])) {
            $ageDistribution[$group] = 0;
        }
    }

    $sqlTypes = "
        SELECT purpose, COUNT(*) as count
        FROM Appointments
        WHERE cabinetID = ? AND date BETWEEN ? AND ?
        GROUP BY purpose
        ORDER BY count DESC
    ";
    $stmt = $conn->prepare($sqlTypes);
    $stmt->bind_param('iss', $cabinetID, $startDate, $endDate);
    $stmt->execute();
    $typesResult = $stmt->get_result();
    $appointmentTypes = [];
    $totalApptsForTypes = 0;
    while ($row = $typesResult->fetch_assoc()) {
        $appointmentTypes[] = [
            'type' => $row['purpose'],
            'count' => (int)$row['count']
        ];
        $totalApptsForTypes += (int)$row['count'];
    }
    $stmt->close();

    $sqlRecent = "
        SELECT c.consultationdate, c.consultationtype, c.diagnosis, c.medicalfees,
               p.firstname, p.lastname
        FROM PatientConsultationInfo c
        INNER JOIN PatientTable p ON p.patientID = c.PatientID
        WHERE p.cabinetID = ?
        ORDER BY c.consultationdate DESC
        LIMIT 10
    ";
    $stmt = $conn->prepare($sqlRecent);
    $stmt->bind_param('i', $cabinetID);
    $stmt->execute();
    $recentResult = $stmt->get_result();
    $recentConsultations = [];
    while ($row = $recentResult->fetch_assoc()) {
        $recentConsultations[] = [
            'date' => $row['consultationdate'],
            'patient' => $row['firstname'] . ' ' . $row['lastname'],
            'type' => $row['consultationtype'],
            'diagnosis' => $row['diagnosis'],
            'fees' => $row['medicalfees']
        ];
    }
    $stmt->close();

    $response['success'] = true;
    $response['data'] = [
        'totalPatients' => $totalPatients,
        'totalAppointments' => $totalAppointments,
        'totalRevenue' => (float)$totalRevenue,
        'completedConsultations' => $completedConsultations,
        'ageDistribution' => $ageDistribution,
        'totalPatientsForAge' => $totalPatientsForAge,
        'appointmentTypes' => $appointmentTypes,
        'totalApptsForTypes' => $totalApptsForTypes,
        'recentConsultations' => $recentConsultations
    ];

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['success'] = false;
    $response['message'] = 'Error loading reports';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
