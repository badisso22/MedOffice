<?php
session_start();
$assistantID = isset($_GET['assistantID']) ? (int)$_GET['assistantID'] : 0;
if ($assistantID <= 0) {
    die('Invalid assistant ID');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assistant Details - MedOffice</title>
    <link rel="stylesheet" href="../CSS/view_assistant.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Assistant Details</h1>
            <a href="searchA.php" class="back-btn">← Back to Search</a>
        </div>

        <div class="main-content">
            <div class="sidebar">
                <div class="profile-card">
                    <div class="avatar"></div>
                    <h2 id="assistant-name">Assistant Name</h2>
                    <div class="title">Medical Assistant</div>
                    <div id="assistant-status" class="status-badge">Status</div>

                    <div class="quick-stats single-stat">
                        <div class="stat">
                            <div id="assistant-years-exp" class="stat-value">–</div>
                            <div class="stat-label">Years Exp.</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-area">
                <div class="section" id="skills-section">
                    <h3>Specialties &amp; Skills</h3>
                    <div id="assistant-skills" class="specialties">
                    </div>
                </div>
                <div class="section">
                    <h3>Contact Information</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <span id="assistant-email" class="info-value">—</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Phone</span>
                            <span id="assistant-phone" class="info-value">—</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Employee ID</span>
                            <span id="assistant-employee-id" class="info-value">—</span>
                        </div>
                    </div>
                </div>

                <div class="section" id="availability-section">
                    <h3>Weekly Availability</h3>
                    <div id="assistant-availability" class="availability-grid">
                    </div>
                </div>

                <div class="action-buttons">
                    <button class="btn btn-secondary">Send Message</button>
                </div>
            </div>
        </div>
    </div>
    <script src="../ajax/admin_view_assistant.js"></script>
</body>
</html>