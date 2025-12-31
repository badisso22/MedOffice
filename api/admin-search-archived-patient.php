<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'message' => '', 'errors' => [], 'data' => null];

if (!($conn instanceof mysqli)) {
    http_response_code(500);
    $response['message'] = 'Database connection error';
    echo json_encode($response);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    $response['message'] = 'Method not allowed';
    echo json_encode($response);
    exit;
}

$searchName = isset($_GET['searchName']) ? trim($_GET['searchName']) : '';

try {
    $sql = "
        SELECT
            p.patientID,
            CONCAT(p.firstname, ' ', p.lastname) AS name,
            TIMESTAMPDIFF(YEAR, p.dateofbirth, CURDATE()) AS age,
            u.email,
            p.phonenumber AS phone,
            p.dateofregistration AS archivedDate,
            p.archived
        FROM PatientTable p
        LEFT JOIN Users u ON u.userID = p.userID
        WHERE p.archived = 1
    ";

    $params = [];
    $types  = '';

    $cabinetID = isset($_SESSION['activeCabinetID']) ? (int)$_SESSION['activeCabinetID'] : null;
    if ($cabinetID !== null) {
        $sql    .= " AND p.cabinetID = ?";
        $types  .= 'i';
        $params[] = $cabinetID;
    }

    if ($searchName !== '') {
        $sql    .= " AND CONCAT(p.firstname, ' ', p.lastname) LIKE ? ";
        $params[] = '%' . $searchName . '%';
        $types   .= 's';
    }

    $sql .= " ORDER BY p.dateofregistration DESC";

    if ($params) {
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception('Prepare failed: ' . $conn->error);
        }
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $result = $conn->query($sql);
    }

    if (!$result) {
        throw new Exception('Query failed: ' . $conn->error);
    }

    $patients = [];
    while ($row = $result->fetch_assoc()) {
        $patients[] = [
            'patientID'    => (int)$row['patientID'],
            'name'         => $row['name'],
            'age'          => $row['age'] !== null ? (int)$row['age'] : null,
            'email'        => $row['email'],
            'phone'        => $row['phone'],
            'archivedDate' => $row['archivedDate'],
        ];
    }

    if (isset($stmt) && $stmt instanceof mysqli_stmt) {
        $stmt->close();
    }

    $response['success'] = true;
    $response['message'] = 'Archived patients loaded';
    $response['data']    = ['patients' => $patients];

    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(500);
    $response['message'] = 'Server error';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response);
}
