<?php
session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'message' => '', 'errors' => []];

try {
    if (!isset($_SESSION['roleID']) || $_SESSION['roleID'] != 1) {
        throw new Exception('Superadmin access required');
    }

    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input || !isset($input['cabinetID'])) {
        throw new Exception('Cabinet ID required');
    }

    $cabinetID = (int)$input['cabinetID'];

    $stmt = $conn->prepare("DELETE FROM CabinetInfo WHERE cabinetID = ?");
    if (!$stmt) throw new Exception('Prepare failed: ' . $conn->error);

    $stmt->bind_param('i', $cabinetID);
    if (!$stmt->execute()) {
        throw new Exception('Delete failed: ' . $stmt->error);
    }

    $affected = $stmt->affected_rows;
    $stmt->close();

    if ($affected === 0) {
        throw new Exception('Cabinet not found');
    }

    $response['success'] = true;
    $response['message'] = 'Cabinet deleted successfully';
    $response['data'] = ['cabinetID' => $cabinetID, 'affected_rows' => $affected];

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
