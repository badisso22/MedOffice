<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Cache-Control: no-cache, no-store, must-revalidate');

require '../config/config.php';

$action = $_GET['action'] ?? $_POST['action'] ?? '';

try {
    switch ($action) {
        case 'specialties':
            handleSpecialties($conn);
            break;
            
        case 'verify_specialty':
            $specialty = $_POST['specialty'] ?? '';
            handleVerifySpecialty($conn, $specialty);
            break;
            
        case 'criteria_options':
            $specialty = $_POST['specialty'] ?? '';
            handleCriteriaOptions($conn, $specialty);
            break;
            
        case 'recommendations':
            handleRecommendations($conn);
            break;
            
        default:
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Invalid action']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}


function handleSpecialties($conn) {
    $query = "
        SELECT DISTINCT dp.speciality, COUNT(dp.doctorID) as doctor_count
        FROM DoctorProfile dp
        WHERE dp.isActive = 1 AND dp.isArchived = 0
        AND EXISTS (
            SELECT 1 FROM CabinetInfo ci 
            WHERE ci.cabinetID = dp.cabinetID AND ci.is_active = 1
        )
        GROUP BY dp.speciality
        HAVING doctor_count > 0
        ORDER BY doctor_count DESC
    ";
    
    $result = $conn->query($query);
    if (!$result) {
        http_response_code(500);
        die(json_encode(['success' => false, 'error' => $conn->error]));
    }
    
    $specialties = $result->fetch_all(MYSQLI_ASSOC) ?? [];
    echo json_encode(['success' => true, 'data' => $specialties, 'count' => count($specialties)]);
}

function handleVerifySpecialty($conn, $specialty) {
    if (empty($specialty)) {
        http_response_code(400);
        die(json_encode(['success' => false, 'error' => 'Specialty is required']));
    }
    
    $specialty = $conn->real_escape_string($specialty);
    
    $query = "
        SELECT COUNT(dp.doctorID) as doctor_count
        FROM DoctorProfile dp
        WHERE dp.speciality = '$specialty'
        AND dp.isActive = 1
        AND dp.isArchived = 0
        AND EXISTS (
            SELECT 1 FROM CabinetInfo ci 
            WHERE ci.cabinetID = dp.cabinetID AND ci.is_active = 1
        )
    ";
    
    $result = $conn->query($query);
    if (!$result) {
        http_response_code(500);
        die(json_encode(['success' => false, 'error' => $conn->error]));
    }
    
    $row = $result->fetch_assoc();
    $doctor_count = intval($row['doctor_count'] ?? 0);
    
    if ($doctor_count === 0) {
        echo json_encode([
            'success' => false,
            'error' => "No doctors available for $specialty specialty",
            'doctor_count' => 0
        ]);
    } else {
        echo json_encode([
            'success' => true,
            'doctor_count' => $doctor_count
        ]);
    }
}


function handleCriteriaOptions($conn, $specialty) {
    if (empty($specialty)) {
        http_response_code(400);
        die(json_encode(['success' => false, 'error' => 'Specialty is required']));
    }
    
    $facilitiesQuery = "
        SELECT DISTINCT facility
        FROM CabinetFacilities
        ORDER BY facility
    ";
    $facilitiesResult = $conn->query($facilitiesQuery);
    $facilities = [];
    if ($facilitiesResult) {
        while ($row = $facilitiesResult->fetch_assoc()) {
            $facilities[] = $row['facility'];
        }
    }
    
    $locations = [
        'Algiers', 'Blida', 'Oran', 'Constantine', 'Tizi Ouzou',
        'Setif', 'Batna', 'Bejaia', 'Jijel', 'Saida', 'Tlemcen'
    ];
    
    echo json_encode([
        'success' => true,
        'data' => [
            'facilities' => $facilities,
            'locations' => $locations
        ]
    ]);
}


function handleRecommendations($conn) {
    $specialty = $_POST['specialty'] ?? '';
    $criteria = json_decode($_POST['criteria'] ?? '{}', true);
    $ranking = json_decode($_POST['ranking'] ?? '[]', true);
    $preferences = json_decode($_POST['preferences'] ?? '{}', true);
    
    if (empty($specialty) || empty($ranking)) {
        http_response_code(400);
        die(json_encode(['success' => false, 'error' => 'Specialty and ranking are required']));
    }
    
    $specialty = $conn->real_escape_string($specialty);
    $verifyQuery = "
        SELECT COUNT(doctorID) as count
        FROM DoctorProfile
        WHERE speciality = '$specialty' AND isActive = 1 AND isArchived = 0
    ";
    $verifyResult = $conn->query($verifyQuery);
    $verifyRow = $verifyResult->fetch_assoc();
    
    if (intval($verifyRow['count'] ?? 0) === 0) {
        echo json_encode([
            'success' => true,
            'data' => [],
            'message' => "No doctors available for this specialty"
        ]);
        return;
    }
    
    $doctorsQuery = "
        SELECT 
            dp.doctorID, dp.userID, dp.speciality, dp.yearsOfExperience, dp.bio,
            ci.cabinetID, ci.cabinetname, ci.cabinetlocation,
            up.firstName, up.lastName
        FROM DoctorProfile dp
        JOIN CabinetInfo ci ON dp.cabinetID = ci.cabinetID
        JOIN UserProfile up ON dp.userID = up.userID
        WHERE dp.speciality = '$specialty' AND dp.isActive = 1 AND dp.isArchived = 0
        ORDER BY dp.yearsOfExperience DESC
    ";
    
    $doctorsResult = $conn->query($doctorsQuery);
    if (!$doctorsResult) {
        http_response_code(500);
        die(json_encode(['success' => false, 'error' => $conn->error]));
    }
    
    $doctors = $doctorsResult->fetch_all(MYSQLI_ASSOC) ?? [];
    
    if (empty($doctors)) {
        echo json_encode([
            'success' => true,
            'data' => [],
            'message' => 'No doctors found for this specialty'
        ]);
        return;
    }
    
    $weights = rankingToWeights($ranking);
    $totalWeight = array_sum($weights);
    if ($totalWeight > 0) {
        foreach ($weights as &$w) {
            $w = $w / $totalWeight;
        }
    }
    
    $rankedDoctors = [];
    foreach ($doctors as $doctor) {
        $scores = calculateScores($conn, $doctor, $criteria, $preferences);
        $wsm = calculateWSM($scores, $criteria, $weights);
        
        $rankedDoctors[] = [
            'doctor' => $doctor,
            'scores' => $scores,
            'wsm_score' => round($wsm, 1),
            'rank_explanation' => generateExplanation($scores, $criteria, $weights)
        ];
    }
    
    usort($rankedDoctors, fn($a, $b) => $b['wsm_score'] <=> $a['wsm_score']);
    
    $topDoctors = array_slice($rankedDoctors, 0, 10);
    
    echo json_encode([
        'success' => true,
        'data' => $topDoctors,
        'total_results' => count($rankedDoctors),
        'returned' => count($topDoctors)
    ]);
}


function calculateScores($conn, $doctor, $criteria, $preferences) {
    $scores = [];
    
    if (isset($criteria['price']) && $criteria['price']) {
        $scores['price'] = calculatePriceScore($conn, $doctor['cabinetID']);
    }
    
    if (isset($criteria['availability']) && $criteria['availability']) {
        $scores['availability'] = calculateAvailabilityScore($conn, $doctor['doctorID']);
    }
    
    if (isset($criteria['facilities']) && $criteria['facilities']) {
        $selectedFacilities = $preferences['selectedFacilities'] ?? [];
        if (!empty($selectedFacilities)) {
            $scores['facilities'] = calculateFacilitiesScore($conn, $doctor['cabinetID'], $selectedFacilities);
        }
    }
    
    if (isset($criteria['location']) && $criteria['location']) {
        $location = $preferences['location'] ?? '';
        if (!empty($location)) {
            $scores['location'] = calculateLocationScore($doctor['cabinetlocation'], $location);
        }
    }
    
    if (isset($criteria['feedback']) && $criteria['feedback']) {
        $scores['feedback'] = calculateFeedbackScore($conn, $doctor['doctorID']);
    }
    
    return $scores;
}


function calculatePriceScore($conn, $cabinetID) {
    $cabinetID = intval($cabinetID);
    
    $avgQuery = "SELECT AVG(price) as avg_price FROM Pricing WHERE cabinetID = $cabinetID AND isActive = 1";
    $avgResult = $conn->query($avgQuery);
    $avgRow = $avgResult->fetch_assoc();
    $avg_price = floatval($avgRow['avg_price'] ?? 0);
    
    $minMaxQuery = "SELECT MIN(price) as min_price, MAX(price) as max_price FROM Pricing WHERE isActive = 1";
    $minMaxResult = $conn->query($minMaxQuery);
    $minMaxRow = $minMaxResult->fetch_assoc();
    
    $min_price = floatval($minMaxRow['min_price'] ?? 500);
    $max_price = floatval($minMaxRow['max_price'] ?? 2000);
    
    if ($min_price == $max_price) return 0.5;
    
    $normalized = ($max_price - $avg_price) / ($max_price - $min_price);
    return max(0, min(1, $normalized));
}


function calculateAvailabilityScore($conn, $doctorID) {
    $doctorID = intval($doctorID);
    
    $query = "
        SELECT COUNT(DISTINCT CAST(DATE_ADD(CURDATE(), INTERVAL d.day DAY) AS DATE)) as available_days
        FROM DoctorAvailability da
        CROSS JOIN (SELECT 0 as day UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6) d
        LEFT JOIN DoctorTimeOff dto ON da.doctorID = dto.doctorID
            AND DATE_ADD(CURDATE(), INTERVAL d.day DAY) BETWEEN dto.startDate AND COALESCE(dto.endDate, '9999-12-31')
        WHERE da.doctorID = $doctorID AND da.isAvailable = 1
            AND DAYNAME(DATE_ADD(CURDATE(), INTERVAL d.day DAY)) = da.dayOfWeek
            AND dto.timeOffID IS NULL
    ";
    
    $result = $conn->query($query);
    if (!$result) return 0.5;
    
    $row = $result->fetch_assoc();
    $available_days = intval($row['available_days'] ?? 0);
    
    return min(1, $available_days / 7.0);
}


function calculateFacilitiesScore($conn, $cabinetID, $selectedFacilities) {
    $cabinetID = intval($cabinetID);
    
    if (empty($selectedFacilities)) return 0.5;
    
    $facilityList = implode("','", array_map(fn($f) => $conn->real_escape_string($f), $selectedFacilities));
    
    $query = "SELECT COUNT(*) as matching_count FROM CabinetFacilities WHERE cabinetID = $cabinetID AND facility IN ('$facilityList')";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $matching_count = intval($row['matching_count'] ?? 0);
    
    return $matching_count / count($selectedFacilities);
}


function calculateLocationScore($cabinetLocation, $preferredLocation) {
    if (empty($preferredLocation)) return 0.5;
    
    $preferredLocation = strtolower(trim($preferredLocation));
    $location = strtolower(trim($cabinetLocation));
    
    if (stripos($location, $preferredLocation) !== false) return 1.0;
    
    $cities = ['algiers', 'oran', 'constantine', 'blida', 'batna', 'setif', 'tizi ouzou', 'bejaia', 'jijel'];
    foreach ($cities as $city) {
        if (stripos($location, $city) !== false && stripos($preferredLocation, $city) !== false) {
            return 0.7;
        }
    }
    
    return 0.0;
}


function calculateFeedbackScore($conn, $doctorID) {
    $doctorID = intval($doctorID);
    
    $query = "
        SELECT AVG(COALESCE(pf.doctor_competence_rating, 0)) as avg_rating, COUNT(pf.id) as feedback_count
        FROM PatientFeedback pf
        JOIN Appointments ap ON pf.appointment_id = ap.appointmentID
        WHERE ap.doctorID = $doctorID AND ap.status IN ('completed', 'accepted')
    ";
    
    $result = $conn->query($query);
    if (!$result) return 0.5;
    
    $row = $result->fetch_assoc();
    $feedback_count = intval($row['feedback_count'] ?? 0);
    
    if ($feedback_count < 1) return 0.5;
    
    $avg_rating = floatval($row['avg_rating'] ?? 0);
    return min(1, $avg_rating / 5.0);
}


function calculateWSM($scores, $criteria, $weights) {
    $totalWeight = 0;
    $weightedSum = 0;
    
    foreach ($criteria as $criterion => $enabled) {
        if (!$enabled || !isset($scores[$criterion])) continue;
        
        $weight = floatval($weights[$criterion] ?? 0);
        $score = floatval($scores[$criterion] ?? 0);
        
        $weightedSum += $weight * $score;
        $totalWeight += $weight;
    }
    
    return $totalWeight > 0 ? ($weightedSum / $totalWeight) * 100 : 50;
}

function generateExplanation($scores, $criteria, $weights) {
    $criteriaNames = [
        'price' => 'Price',
        'availability' => 'Availability',
        'facilities' => 'Facilities',
        'location' => 'Location',
        'feedback' => 'Patient Feedback'
    ];
    
    $explanation = [];
    
    foreach ($criteria as $criterion => $enabled) {
        if (!$enabled || !isset($scores[$criterion])) continue;
        
        $weight = floatval($weights[$criterion] ?? 0);
        $score = floatval($scores[$criterion] ?? 0);
        $percentage = round($weight * 100, 0);
        $points = round($weight * $score * 100, 1);
        
        $explanation[] = [
            'criterion' => $criteriaNames[$criterion] ?? $criterion,
            'weight_percent' => intval($percentage),
            'score' => intval($score * 100),
            'contribution_points' => floatval($points)
        ];
    }
    
    usort($explanation, fn($a, $b) => $b['contribution_points'] <=> $a['contribution_points']);
    
    return $explanation;
}

function rankingToWeights($ranking) {
    $n = count($ranking);
    if ($n === 0) return [];
    
    $weights = [];
    $sum = ($n * ($n + 1)) / 2;
    
    foreach ($ranking as $rank => $criterion) {
        $weight = ($n - $rank) / $sum;
        $weights[$criterion] = round($weight, 3);
    }
    
    return $weights;
}
?>
