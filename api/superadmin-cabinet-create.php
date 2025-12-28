<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
require_once '../config/config.php'; 

$response = ['success' => false, 'message' => '', 'errors' => [], 'data' => null];

function fail($msg) {
  throw new Exception($msg);
}

function first_specialty($s) {
  $parts = array_filter(array_map('trim', explode(',', (string)$s)));
  return count($parts) ? $parts[0] : 'General';
}

try {
  if (!isset($_SESSION['roleID']) || intval($_SESSION['roleID']) !== 1) {
    fail('Superadmin access required');
  }

  $input = json_decode(file_get_contents('php://input'), true);
  if (!$input) fail('Invalid JSON');

  
  $cab = $input['cabinet'] ?? $input;

  $cabinetname      = trim($cab['cabinetname'] ?? $cab['cabinetName'] ?? '');
  $cabinetlocation  = trim($cab['cabinetlocation'] ?? $cab['cabinetLocation'] ?? '');
  $contactemail     = trim($cab['contact_email'] ?? $cab['contactemail'] ?? $cab['cabinetEmail'] ?? '');
  $cabinetphone     = trim($cab['cabinetphonenumber'] ?? $cab['cabinetPhone'] ?? '');
  $speciality       = trim($cab['cabinetspeciality'] ?? $cab['cabinetSpecialties'] ?? '');
  $subscriptionplan = trim($cab['subscription_plan'] ?? $cab['subscriptionplan'] ?? 'basic');

  $capacity         = trim((string)($cab['cabinetCapacity'] ?? ''));
  $description      = trim($cab['cabinetDescription'] ?? '');
  $cabinetbio = '';
  if ($capacity !== '') $cabinetbio .= "Capacity: {$capacity}\n";
  if ($description !== '') $cabinetbio .= "Description: {$description}\n";

  if ($cabinetname === '') fail('Cabinet name is required');
  if ($cabinetlocation === '') fail('Cabinet location is required');
  if ($contactemail === '') fail('Cabinet email is required');
  if ($cabinetphone === '') fail('Cabinet phone is required');

  $conn->begin_transaction();

  $sqlCab = "INSERT INTO CabinetInfo
    (cabinetname, cabinetlocation, contact_email, cabinetphonenumber, cabinetspeciality, cabinetbio, subscription_plan, is_active, created_at)
    VALUES (?, ?, ?, ?, ?, ?, ?, 1, NOW())";

  $stmt = $conn->prepare($sqlCab);
  if (!$stmt) fail('Prepare failed (CabinetInfo): ' . $conn->error);

  $stmt->bind_param(
    'sssssss',
    $cabinetname,
    $cabinetlocation,
    $contactemail,
    $cabinetphone,
    $speciality,
    $cabinetbio,
    $subscriptionplan
  );

  if (!$stmt->execute()) fail('Insert cabinet failed: ' . $stmt->error);
  $cabinetID = $conn->insert_id;
  $stmt->close();

  if (!isset($input['admin'])) {
    $conn->commit();
    $response['success'] = true;
    $response['message'] = 'Cabinet created successfully';
    $response['data'] = ['cabinetID' => $cabinetID];
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
  }

  $admin = $input['admin'];

  $username  = trim($admin['username'] ?? $admin['adminUsername'] ?? '');
  $email     = trim($admin['email'] ?? $admin['adminEmail'] ?? '');
  $firstName = trim($admin['firstName'] ?? $admin['adminFirstName'] ?? '');
  $lastName  = trim($admin['lastName'] ?? $admin['adminLastName'] ?? '');
  $phone     = trim($admin['phone'] ?? $admin['adminPhone'] ?? '');
  $password  = (string)($admin['password'] ?? $admin['adminPassword'] ?? '');

  if ($username === '' || $email === '' || $firstName === '' || $lastName === '' || $phone === '' || $password === '') {
    fail('Admin fields are required');
  }
  if (strlen($password) < 8) fail('Password must be at least 8 characters');

  $hashed = password_hash($password, PASSWORD_BCRYPT);
  if (!$hashed) fail('Password hash failed');

  $sqlUser = "INSERT INTO Users (roleID, username, email, password, account_status)
              VALUES (2, ?, ?, ?, 'active')";
  $stmt = $conn->prepare($sqlUser);
  if (!$stmt) fail('Prepare failed (Users): ' . $conn->error);
  $stmt->bind_param('sss', $username, $email, $hashed);
  if (!$stmt->execute()) fail('Insert user failed (username/email already exists?): ' . $stmt->error);
  $userID = $conn->insert_id;
  $stmt->close();

  $sqlProfile = "INSERT INTO UserProfile (userID, firstName, lastName, phoneNumber)
                 VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sqlProfile);
  if (!$stmt) fail('Prepare failed (UserProfile): ' . $conn->error);
  $stmt->bind_param('isss', $userID, $firstName, $lastName, $phone);
  if (!$stmt->execute()) fail('Insert profile failed: ' . $stmt->error);
  $stmt->close();

  $adminSpeciality = first_specialty($speciality);
  $sqlDoc = "INSERT INTO DoctorProfile (userID, cabinetID, speciality, isActive, isArchived)
             VALUES (?, ?, ?, 1, 0)";
  $stmt = $conn->prepare($sqlDoc);
  if (!$stmt) fail('Prepare failed (DoctorProfile): ' . $conn->error);
  $stmt->bind_param('iis', $userID, $cabinetID, $adminSpeciality);
  if (!$stmt->execute()) fail('Insert doctor profile failed: ' . $stmt->error);
  $doctorID = $conn->insert_id;
  $stmt->close();

  $conn->commit();

  $response['success'] = true;
  $response['message'] = 'Cabinet + admin created successfully';
  $response['data'] = [
    'cabinetID' => $cabinetID,
    'adminUserID' => $userID,
    'doctorID' => $doctorID
  ];

} catch (Exception $e) {
  if (isset($conn) && $conn instanceof mysqli) {
    try { $conn->rollback(); } catch (Throwable $t) {}
  }
  http_response_code(400);
  $response['errors'][] = $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
