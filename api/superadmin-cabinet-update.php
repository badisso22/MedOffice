<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
require_once '../config/config.php';

$response = ['success' => false, 'errors' => []];

try {
  if (!isset($_SESSION['roleID']) || intval($_SESSION['roleID']) !== 1) {
    throw new Exception('Superadmin access required');
  }

  $input = json_decode(file_get_contents('php://input'), true);
  if (!$input) throw new Exception('Invalid JSON');

  $cabinetID = intval($input['cabinetID'] ?? 0);
  if ($cabinetID <= 0) throw new Exception('cabinetID is required');

  $fields = [];
  $types = '';
  $values = [];

  $map = [
    'cabinetname' => 'cabinetname',
    'cabinetlocation' => 'cabinetlocation',
    'contact_email' => 'contact_email',
    'cabinetphonenumber' => 'cabinetphonenumber',
    'cabinetspeciality' => 'cabinetspeciality',
    'subscription_plan' => 'subscription_plan'
  ];

  foreach ($map as $key => $col) {
    if (array_key_exists($key, $input)) {
      $fields[] = "$col = ?";
      $types .= 's';
      $values[] = trim((string)$input[$key]);
    }
  }

  if (array_key_exists('status', $input)) {
    $status = $input['status'];
    if ($status === 'active') $isactive = 1;
    elseif ($status === 'suspended') $isactive = 0;
    else throw new Exception('Invalid status (use active/suspended)');

    $fields[] = "isactive = ?";
    $types .= 'i';
    $values[] = $isactive;
  }

  if (!$fields) throw new Exception('Nothing to update');

  $sql = "UPDATE CabinetInfo SET " . implode(', ', $fields) . " WHERE cabinetID = ?";
  $types .= 'i';
  $values[] = $cabinetID;

  $stmt = $conn->prepare($sql);
  if (!$stmt) throw new Exception('Prepare failed: ' . $conn->error);

  $stmt->bind_param($types, ...$values);
  if (!$stmt->execute()) throw new Exception('Update failed: ' . $stmt->error);
  $stmt->close();

  $response['success'] = true;

} catch (Exception $e) {
  http_response_code(400);
  $response['errors'][] = $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
