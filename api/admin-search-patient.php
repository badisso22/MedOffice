<?php
require_once '../config/config.php'; 

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
        throw new Exception('Database connection not initialized.');
    }

    $search = trim($_GET['searchName'] ?? '');

    $sql = "
        SELECT
            p.patientID,
            p.firstname,
            p.lastname,
            p.dateofbirth,
            p.address,
            p.phonenumber,
            u.email,
            p.archived
        FROM PatientTable p
        LEFT JOIN Users u ON u.userID = p.userID
        WHERE 1 = 1
    ";

    $params = [];
    $types  = '';

    $cabinetID = isset($_SESSION['cabinetID']) ? (int)$_SESSION['cabinetID'] : null;
    if ($cabinetID !== null) {
        $sql   .= " AND p.cabinetID = ?";
        $types .= 'i';
        $params[] = $cabinetID;
    }

    if ($search !== '') {
        $sql   .= " AND (p.firstname LIKE ? OR p.lastname LIKE ?)";
        $like   = '%' . $search . '%';
        $types .= 'ss';
        $params[] = $like;
        $params[] = $like;
    }

    $sql .= " ORDER BY p.lastname, p.firstname";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }

    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $patients = [];
    $today = new DateTime();

    while ($row = $result->fetch_assoc()) {
        $age = null;
        if (!empty($row['dateofbirth']) && $row['dateofbirth'] !== '0000-00-00') {
            $dob  = new DateTime($row['dateofbirth']);
            $age  = $today->diff($dob)->y;
        }

        $patients[] = [
            'patientID' => (int)$row['patientID'],
            'name'      => trim($row['firstname'] . ' ' . $row['lastname']),
            'age'       => $age,
            'email'     => $row['email'],
            'phone'     => $row['phonenumber'],
            'archived'  => (int)$row['archived'],
        ];
    }

    $stmt->close();

    $response['success'] = true;
    $response['message'] = 'Patients retrieved successfully';
    $response['data'] = [
        'patients' => $patients,
        'count'    => count($patients),
    ];

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(500);
    $response['success'] = false;
    $response['message'] = 'Server error';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
