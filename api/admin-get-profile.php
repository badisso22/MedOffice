<?php
session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

if (empty($_SESSION['loggedIn']) || !isset($_SESSION['userID'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

$userID = $_SESSION['userID'];   

try {
    $sql = "
    SELECT 
        u.userID,
        u.username,
        u.email,
        u.account_status,      
        u.profile_picture,
        up.firstName,
        up.lastName,
        up.gender,
        up.address,
        up.phoneNumber,
        up.dateOfBirth,
        dp.doctorID,
        dp.speciality,
        dp.licenseNumber,
        dp.yearsOfExperience,
        dp.bio,
        c.cabinetname,
        c.cabinetlocation,
        c.cabinetworktime,
        c.cabinetphonenumber
    FROM Users u
    LEFT JOIN UserProfile   up ON up.userID  = u.userID
    LEFT JOIN DoctorProfile dp ON dp.userID  = u.userID
    LEFT JOIN CabinetInfo   c  ON c.cabinetID = dp.cabinetID
    WHERE u.userID = ?
    LIMIT 1
";

    $stmt = $conn->prepare($sql);
    if (!$stmt) throw new Exception($conn->error);
    $stmt->bind_param('i', $userID);
    $stmt->execute();
    $res = $stmt->get_result();
    $profile = $res->fetch_assoc();
    $stmt->close();

    if (!$profile || empty($profile['doctorID'])) {
        throw new Exception('Doctor profile not found');
    }

    $doctorID = (int)$profile['doctorID'];

    $education = [];
    $sqlEdu = "
        SELECT educationID, degree, institution, year
        FROM DoctorEducation
        WHERE doctorID = ?
        ORDER BY year ASC, educationID ASC
    ";
    $stmt = $conn->prepare($sqlEdu);
    $stmt->bind_param('i', $doctorID);
    $stmt->execute();
    $resEdu = $stmt->get_result();
    while ($row = $resEdu->fetch_assoc()) {
        $education[] = $row;
    }
    $stmt->close();

    $experience = [];
    $sqlExp = "
        SELECT experienceID, title, location, startDate, endDate, description
        FROM DoctorExperience
        WHERE doctorID = ?
        ORDER BY startDate ASC, experienceID ASC
    ";
    $stmt = $conn->prepare($sqlExp);
    $stmt->bind_param('i', $doctorID);
    $stmt->execute();
    $resExp = $stmt->get_result();
    while ($row = $resExp->fetch_assoc()) {
        $experience[] = $row;
    }
    $stmt->close();

    $languages = [];
    $sqlLang = "
        SELECT languageID, language, proficiency
        FROM DoctorLanguages
        WHERE doctorID = ?
        ORDER BY language ASC
    ";
    $stmt = $conn->prepare($sqlLang);
    $stmt->bind_param('i', $doctorID);
    $stmt->execute();
    $resLang = $stmt->get_result();
    while ($row = $resLang->fetch_assoc()) {
        $languages[] = $row;
    }
    $stmt->close();

    $availability = [];
    $sqlAvail = "
        SELECT dayOfWeek, startTime, endTime, isAvailable
        FROM DoctorAvailability
        WHERE doctorID = ?
        ORDER BY FIELD(dayOfWeek,
            'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')
    ";
    $stmt = $conn->prepare($sqlAvail);
    $stmt->bind_param('i', $doctorID);
    $stmt->execute();
    $resAvail = $stmt->get_result();
    while ($row = $resAvail->fetch_assoc()) {
        $availability[] = $row;
    }
    $stmt->close();

    echo json_encode([
        'success' => true,
        'data' => [
            'profile'      => $profile,
            'education'    => $education,
            'experience'   => $experience,
            'languages'    => $languages,
            'availability' => $availability,
        ]
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Server error',
        'error'   => $e->getMessage()
    ]);
}
