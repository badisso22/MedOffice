<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'data' => [], 'errors' => []];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    if (!isset($_SESSION['cabinetID'])) {
        throw new Exception('Unauthorized');
    }

    $cabinetID = (int)$_SESSION['cabinetID'];

    $doctorIdFilter = isset($_GET['doctorId']) && $_GET['doctorId'] !== 'all'
        ? (int)$_GET['doctorId']
        : null;

    $params = [$cabinetID];
    $types  = 'i';

    $doctorWhere = '';
    if ($doctorIdFilter) {
        $doctorWhere = ' AND a.doctorID = ? ';
        $params[] = $doctorIdFilter;
        $types   .= 'i';
    }

    $sql = "
        SELECT 
            a.appointmentID,
            a.date,
            a.appointmentTime,
            a.purpose,
            a.status,
            p.patientID,
            CONCAT(p.firstname, ' ', p.lastname) AS patientName,
            d.doctorID,
            up.firstName AS doctorFirstName,
            up.lastName AS doctorLastName,
            d.speciality AS specialty
        FROM Appointments a
        JOIN PatientTable p ON p.patientID = a.patientID
        LEFT JOIN DoctorProfile d ON d.doctorID = a.doctorID
        LEFT JOIN Users u ON u.userID = d.userID
        LEFT JOIN UserProfile up ON up.userID = u.userID
        WHERE a.cabinetID = ?
          AND a.date = CURDATE()
          AND a.status IN ('accepted', 'in_consultation')
          {$doctorWhere}
        ORDER BY a.status = 'in_consultation' DESC,
                 a.appointmentTime ASC
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $res = $stmt->get_result();

    $current = null;
    $waiting = [];

    while ($row = $res->fetch_assoc()) {
        if ($row['status'] === 'in_consultation' && $current === null) {
            $current = $row;
        } else {
            $waiting[] = $row;
        }
    }

    $stmt->close();

    $sqlDoc = "
        SELECT 
            d.doctorID, 
            up.firstName, 
            up.lastName, 
            d.speciality AS specialty
        FROM DoctorProfile d
        JOIN Users u ON u.userID = d.userID
        LEFT JOIN UserProfile up ON up.userID = u.userID
        WHERE d.cabinetID = ?
        ORDER BY up.firstName, up.lastName
    ";
    $stmtDoc = $conn->prepare($sqlDoc);
    $stmtDoc->bind_param('i', $cabinetID);
    $stmtDoc->execute();
    $resDoc = $stmtDoc->get_result();
    $doctors = [];
    while ($doc = $resDoc->fetch_assoc()) {
        $doctors[] = $doc;
    }
    $stmtDoc->close();

    $response['success'] = true;
    $response['data'] = [
        'current'  => $current,
        'waiting'  => $waiting,
        'doctors'  => $doctors
    ];

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
