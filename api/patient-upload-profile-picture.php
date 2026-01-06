<?php
session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'message' => '', 'data' => null];

try {
    if (!isset($_SESSION['userID'])) {
        throw new Exception('Not authenticated');
    }

    $userID = (int)$_SESSION['userID'];

    if (!isset($_FILES['profilePicture'])) {
        throw new Exception('No file uploaded');
    }

    $file = $_FILES['profilePicture'];
    $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $maxSize = 5 * 1024 * 1024; 

    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('Upload error: ' . $file['error']);
    }

    if ($file['size'] > $maxSize) {
        throw new Exception('File size exceeds 5MB limit');
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mimeType, $allowedMimes)) {
        throw new Exception('Invalid file type. Only JPEG, PNG, GIF, and WebP are allowed');
    }

    $projectRoot = realpath(__DIR__ . '/..'); 

    $uploadsDir  = $projectRoot . '/uploads/profile-pictures/';

    $baseUploads = $projectRoot . '/uploads/';

    if (!is_dir($baseUploads)) {
        if (!mkdir($baseUploads, 0777, true)) {
            throw new Exception('Cannot create uploads directory');
        }
    }

    if (!is_dir($uploadsDir)) {
        if (!mkdir($uploadsDir, 0777, true)) {
            throw new Exception('Cannot create profile-pictures directory');
        }
    }

    @chmod($uploadsDir, 0777);

    if (!is_writable($uploadsDir)) {
        throw new Exception('Upload directory is not writable. Path: ' . $uploadsDir);
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename  = 'profile_' . $userID . '_' . time() . '.' . $extension;
    $filepath  = $uploadsDir . $filename; 

    if (!move_uploaded_file($file['tmp_name'], $filepath)) {
        throw new Exception('Failed to save file. Path: ' . $filepath);
    }

    $sql = "
        UPDATE UserProfile 
        SET profilePicture = ? 
        WHERE userID = ?
    ";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        unlink($filepath);
        throw new Exception('Database error: ' . $conn->error);
    }

   
    $picturePath = '/uploads/profile-pictures/' . $filename;

    $stmt->bind_param('si', $picturePath, $userID);
    $stmt->execute();
    $stmt->close();

    $response['success'] = true;
    $response['message'] = 'Profile picture updated successfully';
    $response['data'] = ['picturePath' => $picturePath];

} catch (Exception $e) {
    http_response_code(400);
    $response['message'] = $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
