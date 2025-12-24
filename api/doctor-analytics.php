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

    $doctorId = $_SESSION['doctorID'] ?? null;
    if (!$doctorId) {
        throw new Exception('Missing doctor ID');
    }

    $sqlSummary = "
        SELECT
            COUNT(*) AS total_patients,
            COUNT(DISTINCT date) AS days_worked
        FROM Appointments
        WHERE doctorID = ?
          AND status IN ('accepted','completed')
          AND YEARWEEK(date, 1) = YEARWEEK(CURDATE(), 1)
    ";
    $stmt = $conn->prepare($sqlSummary);
    $stmt->bind_param('i', $doctorId);
    $stmt->execute();
    $summary = $stmt->get_result()->fetch_assoc() ?: ['total_patients' => 0, 'days_worked' => 0];
    $stmt->close();

    $sqlDaily = "
        SELECT
            DAYNAME(date) AS day_name,
            COUNT(*) AS consultations
        FROM Appointments
        WHERE doctorID = ?
          AND status IN ('accepted','completed')
          AND YEARWEEK(date, 1) = YEARWEEK(CURDATE(), 1)
        GROUP BY date
        ORDER BY date
    ";
    $stmt = $conn->prepare($sqlDaily);
    $stmt->bind_param('i', $doctorId);
    $stmt->execute();
    $res = $stmt->get_result();
    $daily = [];
    while ($row = $res->fetch_assoc()) {
        $daily[] = $row;
    }
    $stmt->close();

    $sqlMetrics = "
        SELECT
            SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) AS completed_cnt,
            COUNT(*) AS total_cnt
        FROM Appointments
        WHERE doctorID = ?
          AND YEARWEEK(date, 1) = YEARWEEK(CURDATE(), 1)
    ";
    $stmt = $conn->prepare($sqlMetrics);
    $stmt->bind_param('i', $doctorId);
    $stmt->execute();
    $metrics = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    $completionRate = ($metrics['total_cnt'] ?? 0) > 0
        ? round($metrics['completed_cnt'] * 100 / $metrics['total_cnt'], 1)
        : 0.0;

    $response['success'] = true;
    $response['message'] = 'Doctor analytics loaded';
    $response['data'] = [
        'summary' => $summary,
        'daily'   => $daily,
        'completionRate' => $completionRate
    ];

    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(500);
    $response['message'] = 'Error loading analytics';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response);
}
