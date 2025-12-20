<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'message' => '', 'errors' => [], 'data' => []];

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    $response['message'] = 'Method not allowed';
    echo json_encode($response);
    exit;
}

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('DB not initialized');
    }

    $patientID = isset($_GET['patientID']) ? (int)$_GET['patientID'] : 0;
    if ($patientID <= 0) {
        http_response_code(400);
        $response['message'] = 'Invalid patient ID';
        $response['errors'][] = 'Missing or invalid patientID';
        echo json_encode($response);
        exit;
    }
    $patientSql = "
        SELECT
            p.patientID,
            p.firstname,
            p.lastname,
            p.dateofbirth,
            p.phonenumber,
            MAX(c.consultationdate) AS last_visit
        FROM PatientTable p
        LEFT JOIN PatientConsultationInfo c ON c.PatientID = p.patientID
        WHERE p.patientID = ?
        GROUP BY p.patientID
        LIMIT 1
    ";
    $stmt = $conn->prepare($patientSql);
    $stmt->bind_param('i', $patientID);
    $stmt->execute();
    $res = $stmt->get_result();
    $patient = $res->fetch_assoc();
    $stmt->close();

    if (!$patient) {
        http_response_code(404);
        $response['message'] = 'Patient not found';
        echo json_encode($response);
        exit;
    }

    $age = null;
    if (!empty($patient['dateofbirth']) && $patient['dateofbirth'] !== '0000-00-00') {
        $dob = new DateTime($patient['dateofbirth']);
        $age = (new DateTime())->diff($dob)->y;
    }

    $patientData = [
        'patientID'  => (int)$patient['patientID'],
        'fullName'   => trim($patient['firstname'] . ' ' . $patient['lastname']),
        'avatar'     => mb_strtoupper(
            mb_substr($patient['firstname'], 0, 1) .
            mb_substr($patient['lastname'], 0, 1)
        ),
        'code'       => '#P-' . str_pad($patient['patientID'], 4, '0', STR_PAD_LEFT),
        'age'        => $age,
        'last_visit' => $patient['last_visit'],
    ];

    $presSql = "
        SELECT
            pr.prescriptionID,
            pr.prescribedDate,
            d.doctorID,
            up.firstName AS doctorFirstName,
            up.lastName  AS doctorLastName,
            pr.dosage,
            pr.frequency,
            pr.duration,
            pr.expiryDate
        FROM Prescriptions pr
        LEFT JOIN DoctorProfile d ON d.doctorID = pr.doctorID
        LEFT JOIN UserProfile up ON up.userID = d.userID
        WHERE pr.patientID = ?
        ORDER BY pr.prescribedDate DESC
    ";
    $stmt = $conn->prepare($presSql);
    $stmt->bind_param('i', $patientID);
    $stmt->execute();
    $res = $stmt->get_result();

    $prescriptions = [];
    while ($row = $res->fetch_assoc()) {
        $status = 'Active';
        if (!empty($row['expiryDate'])) {
            $today = new DateTime();
            $exp   = new DateTime($row['expiryDate']);
            if ($exp < $today) {
                $status = 'Completed';
            }
        }

        $prescriptions[] = [
            'prescriptionID'  => (int)$row['prescriptionID'],
            'date'            => $row['prescribedDate'],
            'status'          => $status,
            'doctorName'      => trim(($row['doctorFirstName'] ?? '') . ' ' . ($row['doctorLastName'] ?? '')),
            'medicationCount' => 1, 
        ];
    }
    $stmt->close();

    $response['success'] = true;
    $response['message'] = 'Prescriptions loaded';
    $response['data'] = [
        'patient'       => $patientData,
        'prescriptions' => $prescriptions,
    ];

    echo json_encode($response);

} catch (Exception $e) {
    http_response_code(500);
    $response['success'] = false;
    $response['message'] = 'Server error';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response);
}
