<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'message' => '', 'data' => null, 'errors' => []];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    $cabinetID = isset($_SESSION['activeCabinetID']) ? (int)$_SESSION['activeCabinetID'] : 0;
    if ($cabinetID <= 0) {
        throw new Exception('Cabinet ID not found');
    }

    $sql = "
        SELECT
            cabinetname,
            cabinetlocation,
            contact_email,
            cabinetphonenumber,
            cabinetworktime,
            cabinetspeciality,
            cabinetbio,
            websiteUrl,
            facebookUrl,
            twitterUrl,
            instagramUrl,
            linkedinUrl
        FROM CabinetInfo
        WHERE cabinetID = ?
        LIMIT 1
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('i', $cabinetID);
    $stmt->execute();
    $cabinet = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$cabinet) {
        throw new Exception('Cabinet not found');
    }

    $sqlDoctors = "
        SELECT 
            dp.doctorID,
            dp.speciality,
            dp.yearsOfExperience,
            dp.bio,
            up.firstName,
            up.lastName
        FROM DoctorProfile dp
        INNER JOIN Users u ON u.userID = dp.userID
        INNER JOIN UserProfile up ON up.userID = u.userID
        WHERE dp.cabinetID = ? 
          AND dp.isArchived = 0
        ORDER BY up.firstName, up.lastName
    ";
    $stmt = $conn->prepare($sqlDoctors);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('i', $cabinetID);
    $stmt->execute();
    $doctorsResult = $stmt->get_result();

    $doctors = [];
    while ($row = $doctorsResult->fetch_assoc()) {
        $doctors[] = [
            'id'         => (int)$row['doctorID'],
            'name'       => 'Dr. ' . $row['firstName'] . ' ' . $row['lastName'],
            'specialty'  => $row['speciality'],
            'experience' => $row['yearsOfExperience'],
            'bio'        => $row['bio']
        ];
    }
    $stmt->close();

    $sqlPricing = "
        SELECT serviceName, price, description
        FROM Pricing
        WHERE cabinetID = ? 
          AND isActive = 1
        ORDER BY price DESC
    ";
    $stmt = $conn->prepare($sqlPricing);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('i', $cabinetID);
    $stmt->execute();
    $pricingResult = $stmt->get_result();

    $pricing = [];
    while ($row = $pricingResult->fetch_assoc()) {
        $pricing[] = [
            'service'     => $row['serviceName'],
            'price'       => (float)$row['price'],
            'description' => $row['description']
        ];
    }
    $stmt->close();

    $sqlFacilities = "
        SELECT facility
        FROM CabinetFacilities
        WHERE cabinetID = ?
        ORDER BY facility
    ";
    $stmt = $conn->prepare($sqlFacilities);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('i', $cabinetID);
    $stmt->execute();
    $facilitiesResult = $stmt->get_result();

    $facilities = [];
    while ($row = $facilitiesResult->fetch_assoc()) {
        $facilities[] = $row['facility'];
    }
    $stmt->close();

    $sqlReviews = "
        SELECT 
            pf.feedback_title,
            pf.feedback_message,
            pf.created_at,
            COALESCE(pf.doctor_competence_rating, 0) AS rating,
            u.username
        FROM PatientFeedback pf
        INNER JOIN Users u ON u.userID = pf.patient_id
        WHERE pf.cabinet_id = ? 
          AND pf.feedback_message IS NOT NULL
        ORDER BY pf.created_at DESC
        LIMIT 10
    ";
    $stmt = $conn->prepare($sqlReviews);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('i', $cabinetID);
    $stmt->execute();
    $reviewsResult = $stmt->get_result();

    $reviews      = [];
    $totalRating  = 0;
    $ratingCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

    while ($row = $reviewsResult->fetch_assoc()) {
        $rating = (int)$row['rating'];
        if ($rating > 0) {
            $totalRating += $rating;
            $ratingCounts[$rating]++;
        }

        $reviews[] = [
            'username' => $row['username'],
            'rating'   => $rating,
            'title'    => $row['feedback_title'],
            'message'  => $row['feedback_message'],
            'date'     => $row['created_at']
        ];
    }
    $stmt->close();

    $totalReviews  = count($reviews);
    $averageRating = $totalReviews > 0 ? round($totalRating / $totalReviews, 1) : 0;

    $response['success'] = true;
    $response['data'] = [
        'cabinet' => [
            'name'               => $cabinet['cabinetname'],
            'location'           => $cabinet['cabinetlocation'],
            'email'              => $cabinet['contact_email'],
            'phone'              => $cabinet['cabinetphonenumber'],
            'hours'              => $cabinet['cabinetworktime'],
            'specialty'          => $cabinet['cabinetspeciality'],
            'bio'                => $cabinet['cabinetbio'],
            'websiteUrl'         => $cabinet['websiteUrl'] ?? null,
            'facebookUrl'        => $cabinet['facebookUrl'] ?? null,
            'twitterUrl'         => $cabinet['twitterUrl'] ?? null,
            'instagramUrl'       => $cabinet['instagramUrl'] ?? null,
            'linkedinUrl'        => $cabinet['linkedinUrl'] ?? null,
            'establishedYear'    => $cabinet['establishedYear'] ?? null,
            'additionalServices' => $cabinet['additionalServices'] ?? null,
        ],
        'doctors'    => $doctors,
        'reviews'    => $reviews,
        'rating'     => [
            'average'   => $averageRating,
            'total'     => $totalReviews,
            'breakdown' => $ratingCounts
        ],
        'pricing'    => $pricing,
        'facilities' => $facilities
    ];

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
