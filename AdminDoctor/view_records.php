<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Records - MedOffice</title>
    <link rel="stylesheet" href="../CSS/view_records.css" />
</head>
<body>
    <div class="records-container">
        <a href="view_patient.php?patientID=<?php echo isset($_GET['patientID']) ? htmlspecialchars($_GET['patientID']) : ''; ?>" id="back-to-patient" class="back-button">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Back to Patient
        </a>

        <div class="records-header">
            <h1>Medical Records</h1>
            <a href="add_medical_records.php?patientID=<?php echo isset($_GET['patientID']) ? htmlspecialchars($_GET['patientID']) : ''; ?>" id="add-record-link" class="add-record-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Add Record
            </a>
        </div>
        <div class="patient-info-card">
            <div class="patient-avatar" id="patient-avatar"></div>
            <div class="patient-details">
                <h2 id="patient-name"></h2>
                <p id="patient-code"></p>
                <p id="patient-age"></p>
                <p id="patient-last-visit"></p>
            </div>
        </div>

        <div class="records-grid" id="records-grid">
        </div>
        <div class="records-timeline">
            <h2>Medical History Timeline</h2>
            <div id="timeline-list">
            </div>
        </div>
    </div>
    <footer>
      <div class="footer-content">
        <div class="footer-section">
          <h3>MedOffice</h3>
          <p>Professional medical practice management system</p>
        </div>
        <div class="footer-section">
          <h3>Support</h3>
          <ul>
            <li><a href="#help">Help Center</a></li>
            <li><a href="#contact">Contact Support</a></li>
            <li><a href="#privacy">Privacy Policy</a></li>
            <li><a href="#terms">Terms of Service</a></li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2025 MedOffice. All rights reserved. HIPAA-compliant medical practice management.</p>
      </div>
    </footer>

    <script src="../ajax/records.js"></script>
</body>
</html>
