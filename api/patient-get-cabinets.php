<?php
session_start();
require '../config/config.php';
header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'data' => [], 'errors' => []];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    $sql = "SELECT cabinetID,
                   cabinetname,
                   cabinetlocation,
                   contact_email,
                   websiteUrl,
                   cabinetphonenumber,
                   cabinetspeciality,
                   is_active
            FROM CabinetInfo
            WHERE is_active = 1
            ORDER BY cabinetname ASC";
    $result = $conn->query($sql);
    if (!$result) {
        throw new Exception('Query failed: ' . $conn->error);
    }

    while ($row = $result->fetch_assoc()) {
        $response['data'][] = [
            'id'            => (int)$row['cabinetID'],
            'name'          => $row['cabinetname'],
            'location'      => $row['cabinetlocation'],     
            'phone'         => $row['cabinetphonenumber'],
            'speciality'    => $row['cabinetspeciality'],
            'email'         => $row['contact_email'],
            'website'       => $row['websiteUrl'],
            'rating'        => null,                        
            'ratingDisplay' => '',
            'ratingValue'   => '',
            'reviews'       => null,
            'doctors'       => null,
            'featured'      => false,
        ];
    }

    $response['success'] = true;

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
