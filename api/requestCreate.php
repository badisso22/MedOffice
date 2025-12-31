<?php
header('Content-Type: application/json');

require("../config/config.php");

if (!isset($conn) || $conn->connect_error) {
    echo json_encode([
        'success' => false,
        'error'   => 'DB connection not available'
    ]);
    exit;
}

$name    = trim($_POST['name']    ?? '');
$email   = trim($_POST['email']   ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $email === '' || $message === '') {
    echo json_encode([
        'success' => false,
        'error'   => 'All fields are required.'
    ]);
    exit;
}

$stmt = $conn->prepare("
    INSERT INTO Requests (name, email, message, status)
    VALUES (?, ?, ?, 'pending')
");

if (!$stmt) {
    echo json_encode([
        'success' => false,
        'error'   => 'Prepare failed: ' . $conn->error
    ]);
    exit;
}

$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'message' => 'Request submitted successfully.',
        'requestID' => $stmt->insert_id
    ]);
} else {
    echo json_encode([
        'success' => false,
        'error'   => 'Insert failed: ' . $stmt->error
    ]);
}

$stmt->close();
$conn->close();
