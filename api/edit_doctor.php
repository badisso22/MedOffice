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
    if (isset($_POST['doctorID'])) {
        $doctorID = (int)$_POST['doctorID'];
    }

    if ($doctorID <= 0) {
        throw new Exception('Invalid doctor ID');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sql = "
            SELECT 
                dp.doctorID,
                dp.speciality,
                dp.licenseNumber,
                dp.yearsOfExperience,
                dp.bio,
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

        $availability = [];
        $sqlAvail = "SELECT dayOfWeek, startTime, endTime, isAvailable FROM DoctorAvailability WHERE doctorID = ? ORDER BY FIELD(dayOfWeek,'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')";
        if ($stmt = $conn->prepare($sqlAvail)) {
            $stmt->bind_param('i', $doctorID);
            $stmt->execute();
            $resAvail = $stmt->get_result();
            while ($row = $resAvail->fetch_assoc()) {
                $availability[] = $row;
            }
            $stmt->close();
        }

        $response['success'] = true;
        $response['message'] = 'Doctor data loaded';
        $response['data'] = [
            'doctorID' => (int)$doctor['doctorID'],
            'firstName' => $doctor['firstName'],
            'lastName' => $doctor['lastName'],
            'email' => $doctor['email'],
            'phone' => $doctor['phoneNumber'],
            'speciality' => $doctor['speciality'],
            'licenseNumber' => $doctor['licenseNumber'],
            'yearsExp' => $doctor['yearsOfExperience'],
            'bio' => $doctor['bio'],
            'availability' => $availability
        ];
    }
    else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstName = isset($_POST['firstName']) ? trim($_POST['firstName']) : '';
        $lastName = isset($_POST['lastName']) ? trim($_POST['lastName']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
        $speciality = isset($_POST['speciality']) ? trim($_POST['speciality']) : '';
        $licenseNumber = isset($_POST['licenseNumber']) ? trim($_POST['licenseNumber']) : '';
        $yearsExp = isset($_POST['yearsExp']) ? (int)$_POST['yearsExp'] : 0;
        $bio = isset($_POST['bio']) ? trim($_POST['bio']) : '';
        $availability = isset($_POST['days']) ? $_POST['days'] : [];

        if (!$firstName || !$lastName || !$email || !$phone || !$speciality) {
            throw new Exception('Missing required fields');
        }

        $sqlUser = "SELECT userID FROM DoctorProfile WHERE doctorID = ? LIMIT 1";
        $stmt = $conn->prepare($sqlUser);
        $stmt->bind_param('i', $doctorID);
        $stmt->execute();
        $resUser = $stmt->get_result();
        $row = $resUser->fetch_assoc();
        $stmt->close();

        if (!$row) {
            throw new Exception('Doctor not found');
        }

        $userID = $row['userID'];

        $sqlProfile = "UPDATE UserProfile SET firstName = ?, lastName = ?, phoneNumber = ? WHERE userID = ?";
        $stmt = $conn->prepare($sqlProfile);
        $stmt->bind_param('sssi', $firstName, $lastName, $phone, $userID);
        $stmt->execute();
        $stmt->close();

        $sqlUsers = "UPDATE Users SET email = ? WHERE userID = ?";
        $stmt = $conn->prepare($sqlUsers);
        $stmt->bind_param('si', $email, $userID);
        $stmt->execute();
        $stmt->close();

        $sqlDoctor = "UPDATE DoctorProfile SET speciality = ?, licenseNumber = ?, yearsOfExperience = ?, bio = ? WHERE doctorID = ?";
        $stmt = $conn->prepare($sqlDoctor);
        $stmt->bind_param('ssisi', $speciality, $licenseNumber, $yearsExp, $bio, $doctorID);
        $stmt->execute();
        $stmt->close();

        $sqlDelAvail = "DELETE FROM DoctorAvailability WHERE doctorID = ?";
        $stmt = $conn->prepare($sqlDelAvail);
        $stmt->bind_param('i', $doctorID);
        $stmt->execute();
        $stmt->close();

        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $sqlInsertAvail = "INSERT INTO DoctorAvailability (doctorID, dayOfWeek, startTime, endTime, isAvailable) VALUES (?, ?, ?, ?, ?)";
        
        foreach ($days as $day) {
            $dayLower = strtolower($day);
            $isAvailable = in_array($day, $availability) ? 1 : 0;
            $startKey = $dayLower . '_start';
            $endKey = $dayLower . '_end';
            $startTime = isset($_POST[$startKey]) && !empty($_POST[$startKey]) ? $_POST[$startKey] : NULL;
            $endTime = isset($_POST[$endKey]) && !empty($_POST[$endKey]) ? $_POST[$endKey] : NULL;

            if ($isAvailable && $startTime && $endTime) {
                $stmt = $conn->prepare($sqlInsertAvail);
                $stmt->bind_param('isssi', $doctorID, $day, $startTime, $endTime, $isAvailable);
                $stmt->execute();
            }
        }
        if (isset($stmt)) $stmt->close();

        $response['success'] = true;
        $response['message'] = 'Doctor updated successfully';
    }

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['success'] = false;
    $response['message'] = 'Error processing request';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
