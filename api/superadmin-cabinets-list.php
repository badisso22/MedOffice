<?php
header('Content-Type: application/json');
session_start();
require_once '../config/config.php';

$response = ['success' => false, 'data' => null, 'errors' => []];

try {
    $cabinetID = isset($_GET['id']) ? intval($_GET['id']) : null;
    
    if ($cabinetID) {
        $sql = "SELECT cabinetID, cabinetname, cabinetlocation, contact_email, cabinetphonenumber, status, subscription_plan FROM CabinetInfo WHERE cabinetID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $cabinetID);
        $stmt->execute();
        $result = $stmt->get_result();
        $cabinet = $result->fetch_assoc();
        $stmt->close();
        
        $response['success'] = true;
        $response['data'] = ['cabinets' => [$cabinet], 'count' => 1];
    } else {
        $status = $_GET['status'] ?? 'all';
        $search = $_GET['search'] ?? '';
        
        $sql = "SELECT cabinetID, cabinetname, cabinetlocation, contact_email, cabinetphonenumber, status, subscription_plan FROM CabinetInfo WHERE 1=1";
        $params = []; $types = '';
        
        if ($status !== 'all') {
            $sql .= " AND status = ?";
            $params[] = $status; $types .= 's';
        }
        if (!empty($search)) {
            $sql .= " AND (cabinetname LIKE ? OR cabinetlocation LIKE ?)";
            $searchTerm = "%$search%";
            $params[] = $searchTerm; $params[] = $searchTerm; $types .= 'ss';
        }
        $sql .= " ORDER BY cabinetID DESC";
        
        $stmt = $conn->prepare($sql);
        if (!empty($params)) $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        $cabinets = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        
        $response['success'] = true;
        $response['data'] = ['cabinets' => $cabinets, 'count' => count($cabinets)];
    }
} catch (Exception $e) {
    $response['errors'][] = $e->getMessage();
}

echo json_encode($response);
?>
