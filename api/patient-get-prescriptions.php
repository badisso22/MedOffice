<?php
session_start();
require '../config/config.php';
header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'data' => [], 'errors' => []];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    if (empty($_SESSION['loggedIn']) || !isset($_SESSION['userID'], $_SESSION['cabinetID']) || $_SESSION['roleID'] != 5) {
        throw new Exception('Unauthorized');
    }

    $userID    = (int)$_SESSION['userID'];
    $cabinetID = (int)$_SESSION['cabinetID'];

    $sql = "SELECT patientID FROM PatientTable WHERE userID = ? AND cabinetID = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $userID, $cabinetID);
    $stmt->execute();
    $patRow = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$patRow) {
        throw new Exception('Patient not found');
    }

    $patientID = (int)$patRow['patientID'];

    $sql = "SELECT p.prescriptionID, p.dosage, p.frequency, p.duration, p.instructions,
               p.prescribedDate, p.expiryDate,
               m.medicationName,
               up.firstName AS doctorFirstName,
               up.lastName AS doctorLastName
        FROM Prescriptions p
        JOIN Medications m ON p.medicationID = m.medicationID
        JOIN DoctorProfile dp ON p.doctorID = dp.doctorID
        JOIN UserProfile up ON dp.userID = up.userID
        WHERE p.patientID = ?
        ORDER BY p.prescribedDate DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $patientID);
    $stmt->execute();
    $result = $stmt->get_result();

    $today = new DateTimeImmutable('today');

    while ($row = $result->fetch_assoc()) {
        $prescribed = $row['prescribedDate'];
        $expiry     = $row['expiryDate'];
        $status     = 'active';

        if ($expiry) {
            $expDate = new DateTimeImmutable($expiry);
            if ($expDate < $today) {
                $status = 'expired';
            } else {
                $diff = $today->diff($expDate)->days;
                if ($diff !== false && $diff <= 7) {
                    $status = 'expiring';
                } else {
                    $status = 'active';
                }
            }
        }

        $response['data'][] = [
            'id'          => (int)$row['prescriptionID'],
            'medication'  => $row['medicationName'],
            'dosage'      => $row['dosage'],
            'frequency'   => $row['frequency'],
            'duration'    => $row['duration'],
            'instructions'=> $row['instructions'],
            'prescribed'  => $prescribed,
            'expiry'      => $expiry,
            'doctor'      => trim($row['doctorFirstName'] . ' ' . $row['doctorLastName']),
            'status'      => $status, 
        ];
    }
    $stmt->close();

    $response['success'] = true;

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
