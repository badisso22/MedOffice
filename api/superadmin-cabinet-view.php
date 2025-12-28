<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
require_once '../config/config.php'; 

$response = ['success' => false, 'data' => null, 'errors' => []];

try {
    if (!isset($_SESSION['roleID']) || intval($_SESSION['roleID']) !== 1) {
        throw new Exception('Superadmin access required');
    }

    $cabinetID = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($cabinetID <= 0) {
        throw new Exception('Cabinet ID required');
    }

    $sql = "SELECT
                cabinetID,
                cabinetname,
                cabinetlocation,
                contact_email,
                cabinetphonenumber,
                cabinetspeciality,
                subscription_plan,
                status,
                created_at
            FROM CabinetInfo
            WHERE cabinetID = ?
            LIMIT 1";

    $stmt = $conn->prepare($sql);
    if (!$stmt) throw new Exception('Prepare failed: ' . $conn->error);

    $stmt->bind_param('i', $cabinetID);
    $stmt->execute();
    $res = $stmt->get_result();
    $cabinet = $res->fetch_assoc();
    $stmt->close();

    if (!$cabinet) {
        throw new Exception('Cabinet not found');
    }

    $admin = [
        'name'  => 'N/A',
        'email' => 'N/A'
    ];

    $response['success'] = true;
    $response['data'] = [
        'cabinet' => $cabinet,
        'admin'   => $admin
    ];

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
