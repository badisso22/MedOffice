<?php
session_start();
require '../config/config.php';

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true || $_SESSION['roleID'] != 1) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$sql = "SELECT cabinetID, cabinetname FROM CabinetInfo ORDER BY cabinetname ASC";
$result = $conn->query($sql);

$cabinets = [];
while ($row = $result->fetch_assoc()) {
    $cabinets[] = [
        'cabinetID' => (int)$row['cabinetID'],
        'cabinetname' => $row['cabinetname']
    ];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode(['data' => $cabinets]);
?>
