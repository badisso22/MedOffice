<?php
session_start();
require '../config/config.php';
header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'data' => [], 'errors' => []];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    if (
        empty($_SESSION['loggedIn']) ||
        !isset($_SESSION['userID'], $_SESSION['roleID'], $_SESSION['activeCabinetID']) ||
        (int)$_SESSION['roleID'] !== 5
    ) {
        throw new Exception('Unauthorized');
    }

    $userID    = (int)$_SESSION['userID'];
    $cabinetID = (int)$_SESSION['activeCabinetID'];
    if ($cabinetID <= 0) {
        throw new Exception('Cabinet ID not found');
    }

    $sql = "
        SELECT patientID, firstname, lastname 
        FROM PatientTable 
        WHERE userID = ? AND cabinetID = ? 
        LIMIT 1
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('ii', $userID, $cabinetID);
    $stmt->execute();
    $patientRow = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$patientRow) {
        throw new Exception('Patient not found');
    }

    $patientID = (int)$patientRow['patientID'];

    $sql = "
        SELECT 
            consultationID, 
            consultationdate, 
            consultationtype, 
            diagnosis, 
            treatmentplan 
        FROM PatientConsultationInfo
        WHERE PatientID = ?
        ORDER BY consultationdate DESC
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('i', $patientID);
    $stmt->execute();
    $result = $stmt->get_result();

    $records = [];
    while ($row = $result->fetch_assoc()) {
        $records[] = [
            'id'      => (int)$row['consultationID'],
            'date'    => $row['consultationdate'],
            'type'    => $row['consultationtype'],
            'title'   => $row['diagnosis'] ?: $row['consultationtype'],
            'summary' => $row['treatmentplan'],
        ];
    }
    $stmt->close();

    $response['success'] = true;
    $response['data']    = $records;

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
