<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = [
    'success' => false,
    'message' => '',
    'data'    => null,
    'errors'  => []
];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    $doctorID = isset($_GET['doctorID']) ? (int)$_GET['doctorID'] : 0;
    if ($doctorID <= 0) {
        throw new Exception('Invalid doctor ID');
    }

    $sql = "
        SELECT 
            dp.doctorID,
            dp.speciality,
            dp.licenseNumber,
            dp.yearsOfExperience,
            dp.bio,
            dp.isActive,
            up.firstName,
            up.lastName,
            up.phoneNumber,
            u.email
        FROM DoctorProfile dp
        INNER JOIN Users u ON u.userID = dp.userID
        INNER JOIN UserProfile up ON up.userID = u.userID
        WHERE dp.doctorID = ?
        LIMIT 1
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $doctorID);
    $stmt->execute();
    $res = $stmt->get_result();
    $doctor = $res->fetch_assoc();
    $stmt->close();

    if (!$doctor) {
        throw new Exception('Doctor not found');
    }

    $education = [];
    $sqlEdu = "SELECT degree, institution, year FROM DoctorEducation WHERE doctorID = ? ORDER BY year DESC";
    if ($stmt = $conn->prepare($sqlEdu)) {
        $stmt->bind_param('i', $doctorID);
        $stmt->execute();
        $resEdu = $stmt->get_result();
        while ($row = $resEdu->fetch_assoc()) {
            $education[] = $row;
        }
        $stmt->close();
    }

    $availability = [];
    $sqlAvail = "
        SELECT dayOfWeek, startTime, endTime, isAvailable
        FROM DoctorAvailability
        WHERE doctorID = ?
        ORDER BY FIELD(dayOfWeek,'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')
    ";
    if ($stmt = $conn->prepare($sqlAvail)) {
        $stmt->bind_param('i', $doctorID);
        $stmt->execute();
        $resAvail = $stmt->get_result();
        while ($row = $resAvail->fetch_assoc()) {
            $availability[] = $row;
        }
        $stmt->close();
    }

    $languages = [];
    $sqlLang = "SELECT language, proficiency FROM DoctorLanguages WHERE doctorID = ? ORDER BY language";
    if ($stmt = $conn->prepare($sqlLang)) {
        $stmt->bind_param('i', $doctorID);
        $stmt->execute();
        $resLang = $stmt->get_result();
        while ($row = $resLang->fetch_assoc()) {
            $languages[] = $row;
        }
        $stmt->close();
    }

    $data = [
        'doctorID'      => (int)$doctor['doctorID'],
        'fullName'      => $doctor['firstName'] . ' ' . $doctor['lastName'],
        'speciality'    => $doctor['speciality'],
        'licenseNumber' => $doctor['licenseNumber'],
        'yearsExp'      => $doctor['yearsOfExperience'],
        'bio'           => $doctor['bio'],
        'isActive'      => (int)$doctor['isActive'],
        'email'         => $doctor['email'],
        'phone'         => $doctor['phoneNumber'],
        'education'     => $education,
        'availability'  => $availability,
        'languages'     => $languages
    ];

    $response['success'] = true;
    $response['message'] = 'Doctor details loaded';
    $response['data']    = $data;

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['success'] = false;
    $response['message'] = 'Error loading doctor';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
