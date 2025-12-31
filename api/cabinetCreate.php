<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
session_start();
require("../config/config.php");

$cabinetName   = trim($_POST['cabinet_name'] ?? '');
$cabinetLoc    = trim($_POST['cabinet_location'] ?? '');      
$contactEmail  = trim($_POST['contact_email'] ?? '');
$phone         = trim($_POST['phone'] ?? '');
$workTime      = trim($_POST['work_time'] ?? '');             
$speciality    = trim($_POST['speciality'] ?? '');
$facilitiesStr = trim($_POST['facilities'] ?? '');            

if ($cabinetName === '' || $cabinetLoc === '' || $contactEmail === '' || $phone === '' || $speciality === '') {
    echo json_encode(['success' => false, 'error' => 'Please fill all required fields.']);
    exit;
}

if (!filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'error' => 'Invalid contact email.']);
    exit;
}

$stmt = $conn->prepare("
    INSERT INTO CabinetInfo (
        cabinetname,
        cabinetlocation,
        contact_email,
        cabinetphonenumber,
        cabinetworktime,
        cabinetspeciality
    ) VALUES (?, ?, ?, ?, ?, ?)
");

if (!$stmt) {
    echo json_encode(['success' => false, 'error' => 'Prepare failed: '.$conn->error]);
    exit;
}

$stmt->bind_param(
    "ssssss",
    $cabinetName,
    $cabinetLoc,
    $contactEmail,
    $phone,
    $workTime,
    $speciality
);

if (!$stmt->execute()) {
    echo json_encode(['success' => false, 'error' => 'Insert failed: '.$stmt->error]);
    $stmt->close();
    exit;
}

$cabinetId = $stmt->insert_id;
$stmt->close();

if ($facilitiesStr !== '') {
    $facilities = array_filter(array_map('trim', explode(',', $facilitiesStr)));
    if (!empty($facilities)) {
        $facStmt = $conn->prepare("
            INSERT INTO CabinetFacilities (cabinetID, facility)
            VALUES (?, ?)
        ");
        if ($facStmt) {
            foreach ($facilities as $facility) {
                if ($facility === '') continue;
                $facStmt->bind_param("is", $cabinetId, $facility);
                $facStmt->execute();
            }
            $facStmt->close();
        }
    }
}

echo json_encode([
    'success'    => true,
    'message'    => 'Cabinet created.',
    'cabinet_id' => $cabinetId
]);
