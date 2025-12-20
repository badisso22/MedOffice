<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescriptions - MedOffice</title>
    <link rel="stylesheet" href="../CSS/view_medication_detail.css" />
</head>
<body>
    <nav>
        <div class="nav-container">
            <a href="dashboard_d.php" class="logo">
                <div class="logo-icon">⚕</div>
                MedOffice
            </a>
            <div class="nav-cta">
                <span class="user-name">Dr. John Doe</span>
                <a href="logout.php" class="btn btn-secondary">Logout</a>
            </div>
        </div>
    </nav>
    <div class="page-container">
        <div class="back-header">
            <a href="view_patient.php?patientID=<?php echo $patientID; ?>" id="back-to-patient" class="back-button">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Back to Patient
            </a>
            <h1 class="page-title">Prescriptions</h1>
            <a href="#" id="add-prescription-link" class="btn btn-add-prescription" style="margin-left: auto;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 0.5rem;">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Add Prescription
            </a>
        </div>
        <div class="patient-info-card">
            <div class="patient-avatar" id="patient-avatar"></div>
            <div class="patient-details">
                <h2 id="patient-name"></h2>
                <p id="patient-meta"></p>
            </div>
        </div>
        <h2 class="section-title">Active Prescriptions</h2>
        <div class="prescriptions-grid" id="prescriptions-grid">
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

    <script src="../ajax/prescriptions.js"></script>
</body>
</html>
