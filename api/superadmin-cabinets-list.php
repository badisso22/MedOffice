<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
require_once '../config/config.php';

$response = ['success' => false, 'data' => null, 'errors' => []];

try {
  if (!isset($_SESSION['roleID']) || intval($_SESSION['roleID']) !== 1) {
    throw new Exception('Superadmin access required');
  }

  $cabinetID = isset($_GET['id']) ? intval($_GET['id']) : null;

  if ($cabinetID) {
    $sql = "SELECT
              cabinetID,
              cabinetname,
              cabinetlocation,
              contact_email,
              cabinetphonenumber,
              cabinetspeciality,
              subscription_plan,
              CASE WHEN is_active = 1 THEN 'active' ELSE 'suspended' END AS status,
              created_at AS created_at
            FROM CabinetInfo
            WHERE cabinetID = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $cabinetID);
    $stmt->execute();
    $result = $stmt->get_result();

    $cabinet = $result->fetch_assoc();
    $stmt->close();

    $response['success'] = true;
    $response['data'] = ['cabinets' => $cabinet ? [$cabinet] : [], 'count' => $cabinet ? 1 : 0];
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
  }

  $status = $_GET['status'] ?? 'all';
  $search = $_GET['search'] ?? '';

  $sql = "SELECT
            cabinetID,
            cabinetname,
            cabinetlocation,
            contact_email,
            cabinetphonenumber,
            cabinetspeciality,
            subscription_plan,
            CASE WHEN is_active = 1 THEN 'active' ELSE 'suspended' END AS status,
            created_at AS created_at
          FROM CabinetInfo
          WHERE 1=1";

  $params = [];
  $types = '';

  if ($status !== 'all') {
    if ($status === 'active') {
      $sql .= " AND is_active = 1";
    } elseif ($status === 'suspended') {
      $sql .= " AND is_active = 0";
    }
  }

  if ($search !== '') {
    $sql .= " AND (cabinetname LIKE ? OR cabinetlocation LIKE ?)";
    $like = "%$search%";
    $params[] = $like;
    $params[] = $like;
    $types .= 'ss';
  }

  $sql .= " ORDER BY cabinetID DESC";

  $stmt = $conn->prepare($sql);
  if ($types !== '') {
    $stmt->bind_param($types, ...$params);
  }

  $stmt->execute();
  $result = $stmt->get_result();
  $cabinets = $result->fetch_all(MYSQLI_ASSOC);
  $stmt->close();

  $response['success'] = true;
  $response['data'] = ['cabinets' => $cabinets, 'count' => count($cabinets)];

} catch (Exception $e) {
  http_response_code(400);
  $response['errors'][] = $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
