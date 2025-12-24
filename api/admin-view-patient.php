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
    'errors'  => [],
    'data'    => [],
];

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    $response['message'] = 'Method not allowed';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

try {
    if (!$conn instanceof mysqli) {
        throw new Exception("Database connection not initialized.");
    }

    $patientID = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if ($patientID <= 0) {
        http_response_code(400);
        $response['message'] = 'Invalid patient ID';
        $response['errors'][] = 'Missing or invalid id parameter';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }

    $sql = "
        SELECT
            p.patientID,
            p.userID,
            p.firstname,
            p.lastname,
            p.dateofbirth,
            p.gender,
            p.address,
            p.phonenumber,
            p.archived,
            u.email,
            ec.firstName   AS ec_firstName,
            ec.lastName    AS ec_lastName,
            ec.phoneNumber AS ec_phone,
            ec.relationship AS ec_relationship,
            MAX(c.consultationdate) AS last_visit
        FROM PatientTable p
        LEFT JOIN Users u ON u.userID = p.userID
        LEFT JOIN EmergencyContact ec ON ec.patientID = p.patientID
        LEFT JOIN PatientConsultationInfo c ON c.PatientID = p.patientID
        WHERE p.patientID = ?
        GROUP BY p.patientID
        LIMIT 1
    ";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param('i', $patientID);
    $stmt->execute();
    $result  = $stmt->get_result();
    $patient = $result->fetch_assoc();
    $stmt->close();

    if (!$patient) {
        http_response_code(404);
        $response['message'] = 'Patient not found';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }

    $age = null;
    if (!empty($patient['dateofbirth']) && $patient['dateofbirth'] !== '0000-00-00') {
        $dob   = new DateTime($patient['dateofbirth']);
        $today = new DateTime();
        $age   = $today->diff($dob)->y;
    }

    $data = [
        'patientID'  => (int)$patient['patientID'],
        'fullName'   => trim($patient['firstname'] . ' ' . $patient['lastname']),
        'initials'   => mb_strtoupper(
            mb_substr($patient['firstname'], 0, 1) .
            mb_substr($patient['lastname'], 0, 1)
        ),
        'age'        => $age,
        'gender'     => $patient['gender'],
        'phone'      => $patient['phonenumber'],
        'email'      => $patient['email'],
        'address'    => $patient['address'],
        'archived'   => (int)$patient['archived'],
        'last_visit' => $patient['last_visit'],
        'emergency_contact' => [
            'name'  => trim(($patient['ec_firstName'] ?? '') . ' ' . ($patient['ec_lastName'] ?? '')),
            'phone' => $patient['ec_phone'] ?? null,
            'relationship' => $patient['ec_relationship'] ?? null,
        ],
    ];
    $data['medical_history'] = [];
    $mhSql = "
        SELECT consultationdate, symptoms, diagnosis
        FROM PatientConsultationInfo
        WHERE PatientID = ?
        ORDER BY consultationdate DESC
        LIMIT 5
    ";
    $mhStmt = $conn->prepare($mhSql);
    if ($mhStmt) {
        $mhStmt->bind_param('i', $patientID);
        $mhStmt->execute();
        $mhRes = $mhStmt->get_result();

        while ($row = $mhRes->fetch_assoc()) {
            $label = !empty($row['consultationdate'])
                ? date('Y-m-d', strtotime($row['consultationdate']))
                : 'Consultation';

            $valueParts = [];
            if (!empty($row['symptoms'])) {
                $valueParts[] = 'Symptoms: ' . $row['symptoms'];
            }
            if (!empty($row['diagnosis'])) {
                $valueParts[] = 'Diagnosis: ' . $row['diagnosis'];
            }

            $data['medical_history'][] = [
                'label' => $label,
                'value' => $valueParts ? implode(' | ', $valueParts) : 'No details',
            ];
        }
        $mhStmt->close();
    }
    $data['recent_visits'] = [
        'last_visit_date'   => null,
        'last_visit_reason' => null,
        'next_appointment'  => null,
    ];

    if (!empty($data['medical_history'])) {
        $first = $data['medical_history'][0];
        $data['recent_visits']['last_visit_date'] = $first['label'];
        $data['recent_visits']['last_visit_reason'] = null;
        if (isset($first['value'])) {
            $parts = explode('Diagnosis:', $first['value']);
            if (count($parts) > 1) {
                $data['recent_visits']['last_visit_reason'] = trim($parts[1]);
            }
        }
    }
    $data['prescriptions'] = [];

    $response['success'] = true;
    $response['message'] = 'Patient details loaded';
    $response['data']    = $data;

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(500);
    $response['success'] = false;
    $response['message'] = 'Server error';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
