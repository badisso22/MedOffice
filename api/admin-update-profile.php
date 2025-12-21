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

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$conn->begin_transaction();

try {
    $sql = "SELECT doctorID FROM DoctorProfile WHERE userID = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    if (!$stmt) throw new Exception($conn->error);
    $stmt->bind_param('i', $userID);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    $stmt->close();

    if (!$row) {
        throw new Exception('Doctor profile not found');
    }
    $doctorID = (int)$row['doctorID'];

    $firstName      = trim($_POST['firstName'] ?? '');
    $lastName       = trim($_POST['lastName'] ?? '');
    $email          = trim($_POST['email'] ?? '');
    $phone          = trim($_POST['phone'] ?? '');
    $address        = trim($_POST['address'] ?? '');
    $speciality     = trim($_POST['specialty'] ?? '');
    $licenseNumber  = trim($_POST['licenseNumber'] ?? '');
    $yearsExp       = isset($_POST['experience']) && $_POST['experience'] !== '' ? (int)$_POST['experience'] : null;
    $bio            = trim($_POST['about'] ?? '');
    $languagesStr   = trim($_POST['languages'] ?? '');

    if ($firstName === '' || $lastName === '' || $email === '' || $speciality === '' || $licenseNumber === '') {
        throw new Exception('Required fields are missing');
    }

    $sql = "UPDATE Users SET email = ? WHERE userID = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) throw new Exception($conn->error);
    $stmt->bind_param('si', $email, $userID);
    $stmt->execute();
    $stmt->close();

    $sql = "
    INSERT INTO UserProfile (userID, firstName, lastName, address, phoneNumber)
    VALUES (?,?,?,?,?)
    ON DUPLICATE KEY UPDATE
        firstName  = VALUES(firstName),
        lastName   = VALUES(lastName),
        address    = VALUES(address),
        phoneNumber= VALUES(phoneNumber)
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) throw new Exception($conn->error);
    $stmt->bind_param('issss', $userID, $firstName, $lastName, $address, $phone);
    $stmt->execute();
    $stmt->close();


    $sql = "
        UPDATE DoctorProfile
        SET speciality = ?, licenseNumber = ?, yearsOfExperience = ?, bio = ?
        WHERE doctorID = ?
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) throw new Exception($conn->error);
    $stmt->bind_param('ssisi', $speciality, $licenseNumber, $yearsExp, $bio, $doctorID);
    $stmt->execute();
    $stmt->close();

    if (!empty($_FILES['photo']['name']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $ext = strtolower($ext);
        $allowed = ['jpg','jpeg','png','gif'];
        if (in_array($ext, $allowed)) {
            $uploadDir = '../uploads/profile_photos/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = 'user_'.$userID.'_'.time().'.'.$ext;
            $target = $uploadDir.$filename;
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
                $relPath = 'uploads/profile_photos/'.$filename;
                $sql = "UPDATE Users SET profilepicture = ? WHERE userID = ?";
                $stmt = $conn->prepare($sql);
                if (!$stmt) throw new Exception($conn->error);
                $stmt->bind_param('si', $relPath, $userID);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    $sql = "DELETE FROM DoctorEducation WHERE doctorID = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) throw new Exception($conn->error);
    $stmt->bind_param('i', $doctorID);
    $stmt->execute();
    $stmt->close();

    $degrees      = $_POST['education_degree'] ?? [];
    $institutions = $_POST['education_institution'] ?? [];
    $years        = $_POST['education_year'] ?? [];

    $sql = "
        INSERT INTO DoctorEducation (doctorID, degree, institution, year)
        VALUES (?,?,?,?)
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) throw new Exception($conn->error);

    for ($i = 0; $i < count($degrees); $i++) {
        $deg  = trim($degrees[$i]);
        $inst = trim($institutions[$i] ?? '');
        $yr   = trim($years[$i] ?? '');
        if ($deg === '' || $inst === '') continue;
        $yrVal = $yr !== '' ? $yr : null;
        $stmt->bind_param('isss', $doctorID, $deg, $inst, $yrVal);
        $stmt->execute();
    }
    $stmt->close();

    $sql = "DELETE FROM DoctorLanguages WHERE doctorID = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) throw new Exception($conn->error);
    $stmt->bind_param('i', $doctorID);
    $stmt->execute();
    $stmt->close();

    if ($languagesStr !== '') {
        $langs = array_filter(array_map('trim', explode(',', $languagesStr)));
        $sql = "
            INSERT INTO DoctorLanguages (doctorID, language, proficiency)
            VALUES (?,?, 'fluent')
        ";
        $stmt = $conn->prepare($sql);
        if (!$stmt) throw new Exception($conn->error);

        foreach ($langs as $lang) {
            $stmt->bind_param('is', $doctorID, $lang);
            $stmt->execute();
        }
        $stmt->close();
    }

    $sql = "DELETE FROM DoctorAvailability WHERE doctorID = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) throw new Exception($conn->error);
    $stmt->bind_param('i', $doctorID);
    $stmt->execute();
    $stmt->close();

    $daysSelected = $_POST['days'] ?? [];
    $allDays = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];

    $sql = "
        INSERT INTO DoctorAvailability (doctorID, dayOfWeek, startTime, endTime, isAvailable)
        VALUES (?,?,?,?,?)
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) throw new Exception($conn->error);

    foreach ($allDays as $day) {
        $isAvailable = in_array($day, $daysSelected) ? 1 : 0;
        $startKey = strtolower($day) . '_start';
        $endKey   = strtolower($day) . '_end';
        $start = $_POST[$startKey] ?? '';
        $end   = $_POST[$endKey] ?? '';

        if ($isAvailable && $start !== '' && $end !== '') {
            $stmt->bind_param('isssi', $doctorID, $day, $start, $end, $isAvailable);
            $stmt->execute();
        }
    }
    $stmt->close();


        $conn->commit();

        echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);
    } catch (Exception $e) {
        $conn->rollback();
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Update failed',
            'error'   => $e->getMessage()
        ]);
    }
