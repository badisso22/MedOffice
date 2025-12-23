<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'message' => '', 'errors' => []];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    $cabinetID = isset($_SESSION['cabinetID']) ? (int)$_SESSION['cabinetID'] : 0;
    if ($cabinetID <= 0) {
        throw new Exception('Cabinet ID not found');
    }

    $raw   = file_get_contents('php://input');
    $input = json_decode($raw, true);
    if (!is_array($input)) {
        throw new Exception('Invalid JSON payload');
    }

    $cabinetName = trim($input['cabinetName'] ?? '');
    $email       = trim($input['email']       ?? '');
    $phone       = trim($input['phone']       ?? '');

    $locationOld = trim($input['location'] ?? '');
    $addressNew  = trim($input['address']  ?? '');
    $address     = $addressNew !== '' ? $addressNew : $locationOld;

    $specialtySingle = trim($input['specialty'] ?? '');

    $workStartTime    = trim($input['workStartTime']    ?? '');
    $workEndTime      = trim($input['workEndTime']      ?? '');
    $workingHoursText = trim($input['workingHoursText'] ?? '');

    $cabinetBio  = trim($input['cabinetBio']  ?? '');
    $website     = trim($input['website']     ?? '');

    $specializationsArr = $input['specializations'] ?? [];
    $otherSpecs         = trim($input['otherSpecializations'] ?? '');

    $facebook   = trim($input['facebook']   ?? '');
    $twitter    = trim($input['twitter']    ?? '');
    $instagram  = trim($input['instagram']  ?? '');
    $linkedin   = trim($input['linkedin']   ?? '');

    $facilities = $input['facilities'] ?? [];
    $additionalServices = trim($input['additionalServices'] ?? '');

    $priceGeneral    = isset($input['priceGeneral'])    ? (float)$input['priceGeneral']    : 0;
    $priceSpecialist = isset($input['priceSpecialist']) ? (float)$input['priceSpecialist'] : 0;
    $priceFollowup   = isset($input['priceFollowup'])   ? (float)$input['priceFollowup']   : 0;
    $priceEmergency  = isset($input['priceEmergency'])  ? (float)$input['priceEmergency']  : 0;

    $isNewForm = ($addressNew !== '' || isset($input['specializations']) || isset($input['facilities']));

    if ($isNewForm) {
        if ($cabinetName === '' || $cabinetBio === '' || $address === '' ||
            $phone === '' || $email === '') {
            throw new Exception('Missing required fields');
        }
    } else {
        if ($cabinetName === '' || $address === '' || $email === '' || $phone === '' ||
            $workStartTime === '' || $workEndTime === '') {
            throw new Exception('Missing required fields');
        }
    }

    $specialties = [];

    if (is_array($specializationsArr)) {
        foreach ($specializationsArr as $s) {
            $s = trim($s);
            if ($s !== '') $specialties[] = $s;
        }
    }
    if ($otherSpecs !== '') {
        $specialties[] = $otherSpecs;
    }
    if (empty($specialties) && $specialtySingle !== '') {
        $specialties[] = $specialtySingle;
    }
    $specialtyStr = implode(', ', $specialties);

$sql = "
    UPDATE CabinetInfo
    SET cabinetname        = ?,
        cabinetlocation    = ?,
        contact_email      = ?,
        cabinetphonenumber = ?,
        cabinetspeciality  = ?,
        workStartTime      = NULLIF(?, ''),
        workEndTime        = NULLIF(?, ''),
        cabinetworktime    = ?,
        cabinetbio         = NULLIF(?, ''),
        websiteUrl         = NULLIF(?, ''),
        facebookUrl        = NULLIF(?, ''),
        twitterUrl         = NULLIF(?, ''),
        instagramUrl       = NULLIF(?, ''),
        linkedinUrl        = NULLIF(?, '')
    WHERE cabinetID = ?
";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    'ssssssssssssssi',  
    $cabinetName,
    $address,
    $email,
    $phone,
    $specialtyStr,
    $workStartTime,
    $workEndTime,
    $workingHoursText,
    $cabinetBio,
    $website,
    $facebook,
    $twitter,
    $instagram,
    $linkedin,
    $cabinetID
);

    if (!$stmt->execute()) {
        throw new Exception('Failed to update cabinet info: ' . $stmt->error);
    }
    $stmt->close();

    if ($isNewForm) {
        $stmt = $conn->prepare("DELETE FROM CabinetFacilities WHERE cabinetID = ?");
        if ($stmt) {
            $stmt->bind_param('i', $cabinetID);
            $stmt->execute();
            $stmt->close();
        }

        if (is_array($facilities) && count($facilities) > 0) {
            $stmt = $conn->prepare("INSERT INTO CabinetFacilities (cabinetID, facility) VALUES (?, ?)");
            if ($stmt) {
                foreach ($facilities as $f) {
                    $fTrim = trim($f);
                    if ($fTrim === '') continue;
                    $stmt->bind_param('is', $cabinetID, $fTrim);
                    $stmt->execute();
                }
                $stmt->close();
            }
        }
    }

    if ($isNewForm) {
        $pricingData = [
            'General Consultation' => $priceGeneral,
            'Specialist Visit'     => $priceSpecialist,
            'Follow-up'            => $priceFollowup,
            'Emergency Visit'      => $priceEmergency
        ];

        foreach ($pricingData as $serviceName => $priceValue) {
            if ($priceValue <= 0) continue;

            $stmt = $conn->prepare("SELECT pricingID FROM Pricing WHERE cabinetID = ? AND serviceName = ? LIMIT 1");
            $stmt->bind_param('is', $cabinetID, $serviceName);
            $stmt->execute();
            $res = $stmt->get_result();
            $row = $res->fetch_assoc();
            $stmt->close();

            if ($row) {
                $pricingID = (int)$row['pricingID'];
                $stmt = $conn->prepare("UPDATE Pricing SET price = ?, isActive = 1 WHERE pricingID = ?");
                $stmt->bind_param('di', $priceValue, $pricingID);
                $stmt->execute();
                $stmt->close();
            } else {
                $stmt = $conn->prepare("INSERT INTO Pricing (cabinetID, serviceName, price, isActive) VALUES (?, ?, ?, 1)");
                $stmt->bind_param('isd', $cabinetID, $serviceName, $priceValue);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    $response['success']  = true;
    $response['message']  = 'Cabinet information updated successfully';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
