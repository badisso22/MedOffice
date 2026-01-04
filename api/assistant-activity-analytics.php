<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';
header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'data' => [], 'errors' => []];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database error');
    }
    if (
        !isset($_SESSION['userID'], $_SESSION['roleID'], $_SESSION['activeCabinetID']) ||
        (int)$_SESSION['roleID'] !== 4
    ) {
        throw new Exception('Unauthorized');
    }

    $assistantID = (int)$_SESSION['userID'];
    $cabinetID   = (int)$_SESSION['activeCabinetID'];
    if ($cabinetID <= 0) {
        throw new Exception('Cabinet ID not found');
    }

    $today     = new DateTimeImmutable('today');
    $weekStart = $today->modify('-' . ($today->format('N') - 1) . ' days'); 
    $weekEnd   = $weekStart->modify('+6 days');

    $weekStartDate = $weekStart->format('Y-m-d');
    $weekEndDate   = $weekEnd->format('Y-m-d');

    $sqlShifts = "
      SELECT shiftDate,
             SUM(TIMESTAMPDIFF(MINUTE, startedAt, endedAt)) AS minutesWorked
      FROM AssistantShifts
      WHERE assistantUserID = ?
        AND cabinetID = ?
        AND shiftDate BETWEEN ? AND ?
        AND endedAt IS NOT NULL
      GROUP BY shiftDate
    ";
    $stmt = $conn->prepare($sqlShifts);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('iiss', $assistantID, $cabinetID, $weekStartDate, $weekEndDate);
    $stmt->execute();
    $res = $stmt->get_result();
    $minutesByDate    = [];
    $totalMinutesWeek = 0;
    while ($row = $res->fetch_assoc()) {
        $d = $row['shiftDate'];
        $m = (int)($row['minutesWorked'] ?? 0);
        $minutesByDate[$d] = $m;
        $totalMinutesWeek += $m;
    }
    $stmt->close();

    $sqlAppts = "
      SELECT date AS apptDate,
             COUNT(*) AS cnt
      FROM Appointments
      WHERE cabinetID = ?
        AND date BETWEEN ? AND ?
        AND status IN ('accepted','checked_in','in_consultation','finished')
      GROUP BY date
    ";
    $stmt = $conn->prepare($sqlAppts);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param('iss', $cabinetID, $weekStartDate, $weekEndDate);
    $stmt->execute();
    $res = $stmt->get_result();
    $apptsByDate    = [];
    $totalApptsWeek = 0;
    while ($row = $res->fetch_assoc()) {
        $d = $row['apptDate'];
        $c = (int)$row['cnt'];
        $apptsByDate[$d] = $c;
        $totalApptsWeek += $c;
    }
    $stmt->close();

    $daily            = [];
    $cur              = $weekStart;
    $daysWithWork     = 0;
    $sumMinutesForAvg = 0;

    for ($i = 0; $i < 7; $i++) {
        $dStr    = $cur->format('Y-m-d');
        $dayName = $cur->format('l');

        $mins  = $minutesByDate[$dStr] ?? 0;
        $appts = $apptsByDate[$dStr] ?? 0;

        if ($mins > 0) {
            $daysWithWork++;
            $sumMinutesForAvg += $mins;
        }

        $daily[] = [
            'date'          => $dStr,
            'dayName'       => $dayName,
            'minutesWorked' => $mins,
            'appointments'  => $appts,
        ];

        $cur = $cur->modify('+1 day');
    }

    $avgDailyMinutes = $daysWithWork > 0
        ? (int)floor($sumMinutesForAvg / $daysWithWork)
        : 0;

    $response['success'] = true;
    $response['data'] = [
        'totalMinutesWeek'   => $totalMinutesWeek,
        'totalAppointments'  => $totalApptsWeek,
        'avgDailyMinutes'    => $avgDailyMinutes,
        'daily'              => $daily,
    ];

} catch (Exception $e) {
    http_response_code(400);
    $response['errors'][] = $e->getMessage();
}

echo json_encode($response);
