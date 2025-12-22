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

    $roleID = isset($_SESSION['roleID']) ? (int)$_SESSION['roleID'] : 0;
    $cabinetID = isset($_SESSION['cabinetID']) ? (int)$_SESSION['cabinetID'] : 0;

    if ($cabinetID <= 0) {
        throw new Exception('Cabinet ID not found in session');
    }

    $today = date('Y-m-d');
    if ($roleID == 3) {
        $doctorID = isset($_SESSION['doctorID']) ? (int)$_SESSION['doctorID'] : 0;
        if ($doctorID <= 0) {
            throw new Exception('Doctor ID not found in session');
        }

        $sql = "
            SELECT 
                a.appointmentID,
                a.patientID,
                a.date,
                a.appointmentTime,
                a.purpose,
                a.status,
                p.firstname,
                p.lastname
            FROM Appointments a
            INNER JOIN PatientTable p ON p.patientID = a.patientID
            WHERE a.doctorID = ?
              AND a.cabinetID = ?
              AND a.date = ?
            ORDER BY a.appointmentTime ASC
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iis', $doctorID, $cabinetID, $today);

    } elseif ($roleID == 2) {
        $sql = "
            SELECT 
                a.appointmentID,
                a.patientID,
                a.date,
                a.appointmentTime,
                a.purpose,
                a.status,
                p.firstname,
                p.lastname
            FROM Appointments a
            INNER JOIN PatientTable p ON p.patientID = a.patientID
            WHERE a.cabinetID = ?
              AND a.date = ?
            ORDER BY a.appointmentTime ASC
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('is', $cabinetID, $today);

    } else {
        throw new Exception('Unauthorized access');
    }

    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $appointments = [];
    $now = new DateTime();
    $currentTime = $now->format('H:i:s');

    while ($row = $result->fetch_assoc()) {
        $appointments[] = [
            'appointmentID' => (int)$row['appointmentID'],
            'patientID' => (int)$row['patientID'],
            'patientName' => $row['firstname'] . ' ' . $row['lastname'],
            'time' => $row['appointmentTime'],
            'purpose' => $row['purpose'],
            'status' => $row['status']
        ];
    }
    $stmt->close();

    $completed = [];
    $current = null;
    $upcoming = [];

    foreach ($appointments as $apt) {
        $aptTime = $apt['time'];
        
        if ($apt['status'] === 'cancelled') {
            continue;
        }
        if ($aptTime < $currentTime) {
            $completed[] = $apt;
        } elseif (!$current && $aptTime >= $currentTime) {
            $current = $apt;
        } else {
            $upcoming[] = $apt;
        }
    }

    $response['success'] = true;
    $response['message'] = 'Appointments loaded';
    $response['data'] = [
        'current' => $current,
        'completed' => $completed,
        'upcoming' => $upcoming,
        'total' => count($appointments),
        'completedCount' => count($completed),
        'currentCount' => $current ? 1 : 0,
        'remainingCount' => count($upcoming)
    ];

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['success'] = false;
    $response['message'] = 'Error loading appointments';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
