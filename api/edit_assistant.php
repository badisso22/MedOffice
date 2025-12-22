<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false,'message' => '','data'    => null,'errors'  => []];

try {
    if (!$conn instanceof mysqli) {
        throw new Exception('Database connection error');
    }

    $assistantID = isset($_GET['assistantID']) ? (int)$_GET['assistantID'] : 0;
    if (isset($_POST['assistantID'])) {
        $assistantID = (int)$_POST['assistantID'];
    }

    if ($assistantID <= 0) {
        throw new Exception('Invalid assistant ID');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sql = "
            SELECT 
                ap.assistantID,
                ap.yearsExperience,
                ap.employeeCode,
                ap.status,
                up.firstName,
                up.lastName,
                up.phoneNumber,
                u.email
            FROM AssistantProfile ap
            INNER JOIN Users u ON u.userID = ap.userID
            INNER JOIN UserProfile up ON up.userID = u.userID
            WHERE ap.assistantID = ?
            LIMIT 1
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $assistantID);
        $stmt->execute();
        $res = $stmt->get_result();
        $assistant = $res->fetch_assoc();
        $stmt->close();

        if (!$assistant) {
            throw new Exception('Assistant not found');
        }

        $skills = [];
        $sqlSkills = "SELECT skillName FROM AssistantSkills WHERE assistantID = ? ORDER BY skillName";
        if ($stmt = $conn->prepare($sqlSkills)) {
            $stmt->bind_param('i', $assistantID);
            $stmt->execute();
            $resSkills = $stmt->get_result();
            while ($row = $resSkills->fetch_assoc()) {
                $skills[] = $row['skillName'];
            }
            $stmt->close();
        }

        $availability = [];
        $sqlAvail = "SELECT dayOfWeek, startTime, endTime, isAvailable FROM AssistantAvailability WHERE assistantID = ? ORDER BY FIELD(dayOfWeek,'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')";
        if ($stmt = $conn->prepare($sqlAvail)) {
            $stmt->bind_param('i', $assistantID);
            $stmt->execute();
            $resAvail = $stmt->get_result();
            while ($row = $resAvail->fetch_assoc()) {
                $availability[] = $row;
            }
            $stmt->close();
        }

        $response['success'] = true;
        $response['message'] = 'Assistant data loaded';
        $response['data'] = [
            'assistantID' => (int)$assistant['assistantID'],
            'firstName' => $assistant['firstName'],
            'lastName' => $assistant['lastName'],
            'email' => $assistant['email'],
            'phone' => $assistant['phoneNumber'],
            'employeeCode' => $assistant['employeeCode'],
            'yearsExp' => $assistant['yearsExperience'],
            'status' => $assistant['status'],
            'skills' => $skills,
            'availability' => $availability
        ];
    }
    else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstName = isset($_POST['firstName']) ? trim($_POST['firstName']) : '';
        $lastName = isset($_POST['lastName']) ? trim($_POST['lastName']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
        $employeeCode = isset($_POST['employeeId']) ? trim($_POST['employeeId']) : '';
        $yearsExp = isset($_POST['experience']) ? (float)$_POST['experience'] : 0;
        $status = isset($_POST['status']) ? strtolower(trim($_POST['status'])) : 'available';
        $skills = isset($_POST['skills']) ? trim($_POST['skills']) : '';
        $availability = isset($_POST['days']) ? $_POST['days'] : [];

        if (!$firstName || !$lastName || !$email || !$phone) {
            throw new Exception('Missing required fields');
        }

        $sqlUser = "SELECT userID FROM AssistantProfile WHERE assistantID = ? LIMIT 1";
        $stmt = $conn->prepare($sqlUser);
        $stmt->bind_param('i', $assistantID);
        $stmt->execute();
        $resUser = $stmt->get_result();
        $row = $resUser->fetch_assoc();
        $stmt->close();

        if (!$row) {
            throw new Exception('Assistant not found');
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

        $sqlAssistant = "UPDATE AssistantProfile SET yearsExperience = ?, employeeCode = ?, status = ? WHERE assistantID = ?";
        $stmt = $conn->prepare($sqlAssistant);
        $stmt->bind_param('dssi', $yearsExp, $employeeCode, $status, $assistantID);
        $stmt->execute();
        $stmt->close();

        $sqlDelSkills = "DELETE FROM AssistantSkills WHERE assistantID = ?";
        $stmt = $conn->prepare($sqlDelSkills);
        $stmt->bind_param('i', $assistantID);
        $stmt->execute();
        $stmt->close();

        if (!empty($skills)) {
            $skillArray = array_map('trim', explode(',', $skills));
            $sqlInsertSkill = "INSERT INTO AssistantSkills (assistantID, skillName) VALUES (?, ?)";
            $stmt = $conn->prepare($sqlInsertSkill);
            foreach ($skillArray as $skill) {
                if (!empty($skill)) {
                    $stmt->bind_param('is', $assistantID, $skill);
                    $stmt->execute();
                }
            }
            $stmt->close();
        }

        $sqlDelAvail = "DELETE FROM AssistantAvailability WHERE assistantID = ?";
        $stmt = $conn->prepare($sqlDelAvail);
        $stmt->bind_param('i', $assistantID);
        $stmt->execute();
        $stmt->close();

        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $sqlInsertAvail = "INSERT INTO AssistantAvailability (assistantID, dayOfWeek, startTime, endTime, isAvailable) VALUES (?, ?, ?, ?, ?)";
        
        foreach ($days as $day) {
            $dayLower = strtolower($day);
            $isAvailable = in_array($day, $availability) ? 1 : 0;
            $startKey = $dayLower . '_start';
            $endKey = $dayLower . '_end';
            $startTime = isset($_POST[$startKey]) && !empty($_POST[$startKey]) ? $_POST[$startKey] : NULL;
            $endTime = isset($_POST[$endKey]) && !empty($_POST[$endKey]) ? $_POST[$endKey] : NULL;

            $stmt = $conn->prepare($sqlInsertAvail);
            $stmt->bind_param('isssi', $assistantID, $day, $startTime, $endTime, $isAvailable);
            $stmt->execute();
        }
        $stmt->close();

        $response['success'] = true;
        $response['message'] = 'Assistant updated successfully';
    }

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(400);
    $response['success'] = false;
    $response['message'] = 'Error processing request';
    $response['errors'][] = $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
