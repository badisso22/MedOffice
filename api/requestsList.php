<?php
header('Content-Type: application/json');
session_start();
require("../config/config.php");


$sql = "SELECT requestID, name, email, message, status, created_at
        FROM Requests
        ORDER BY created_at DESC";

$result = $conn->query($sql);
$rows = [];

if ($result && $result->num_rows > 0) {
    while ($r = $result->fetch_assoc()) {
        $rows[] = $r;
    }
}

echo json_encode([
    'success' => true,
    'data'    => $rows
]);
