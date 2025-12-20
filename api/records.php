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

    $recSql = "
        SELECT
            consultationID,
            consultationdate,
            consultationtype,
            diagnosis,
            treatmentplan
        FROM PatientConsultationInfo
        WHERE PatientID = ?
        ORDER BY consultationdate DESC, consultationID DESC
    ";
    $stmt = $conn->prepare($recSql);
    $stmt->bind_param('i', $patientID);
    $stmt->execute();
    $res = $stmt->get_result();

    $records = [];
    while ($row = $res->fetch_assoc()) {
        $type = $row['consultationtype'];
        $typeLower = strtolower($type);
        $badge = 'consultation';
        if (strpos($typeLower, 'check') !== false || strpos($typeLower, 'lab') !== false) {
            $badge = 'lab';
        } elseif (strpos($typeLower, 'imaging') !== false || strpos($typeLower, 'x-ray') !== false) {
            $badge = 'imaging';
        } elseif (strpos($typeLower, 'diagnosis') !== false) {
            $badge = 'diagnosis';
        }

        $records[] = [
            'id'          => (int)$row['consultationID'],
            'date'        => $row['consultationdate'],
            'type'        => $type,
            'badgeClass'  => $badge,
            'title'       => mb_strimwidth($row['diagnosis'], 0, 40, '...'),
            'summary'     => mb_strimwidth($row['treatmentplan'], 0, 100, '...'),
            'doctorName'  => 'Dr. John Doe', // Placeholder
        ];
    }
    $stmt->close();

    $response['success'] = true;
    $response['message'] = 'Records loaded';
    $response['data'] = [
        'patient' => $patientData,
        'records' => $records,
    ];

    echo json_encode($response);

} catch (Exception $e) {
    http_response_code(500);
    $response['success'] = false;
    $response['message'] = 'Server error';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response);
}
