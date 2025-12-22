<?php
session_start();
$doctorID = isset($_GET['doctorID']) ? (int)$_GET['doctorID'] : 0;
if ($doctorID <= 0) {
    die('Invalid doctor ID');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Doctor Details - MedOffice</title>
  <link rel="stylesheet" href="../CSS/general.css" />
  <link rel="stylesheet" href="../CSS/view_patient.css" />
  <link rel="stylesheet" href="../CSS/view_doctor.css" />
</head>
<body>
  <nav>
        <div class="nav-container">
            <button class="drawer-toggle" onclick="toggleDrawer()">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <a href="#" class="logo">
                <div class="logo-icon">⚕</div>
                MedOffice
            </a>
            <div class="nav-cta">
                <span class="user-name">Dr. John Doe</span>
                <div class="top-icons">
                    <a href="messages.php" class="icon-btn" title="Chat">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                    </a>
                    <a href="notifications.php" class="icon-btn" title="Notifications">
                        <svg viewBox="0 0 24 24">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span class="notification-badge">3</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
  <div class="container">
    <div class="patient-top-row">
      <div class="header-section">
        <div class="patient-header">
          <div class="patient-avatar" id="doctor-avatar">DR</div>
          <div class="patient-info">
            <h1 class="patient-name" id="doctor-name">Doctor Name</h1>
            <p class="patient-id">Doctor ID: <strong id="doctor-id">—</strong></p>
            <span class="status-badge" id="doctor-status">Status</span>
          </div>
        </div>

        <div class="info-grid">
          <div class="info-card">
            <div class="info-label">Specialization</div>
            <div class="info-value" id="doctor-speciality">—</div>
          </div>
          <div class="info-card">
            <div class="info-label">Experience</div>
            <div class="info-value" id="doctor-experience">—</div>
          </div>
          <div class="info-card">
            <div class="info-label">License</div>
            <div class="info-value" id="doctor-license">—</div>
          </div>
        </div>
      </div>

      <div class="section contact-info-box">
        <h2 class="section-title">Contact Information</h2>
        <div class="detail-row">
          <span class="detail-label">Email</span>
          <span class="detail-value" id="doctor-email">—</span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Phone</span>
          <span class="detail-value" id="doctor-phone">—</span>
        </div>
      </div>
    </div>

    <div class="info-sections-row">
      <div class="section section-half" id="education-section">
        <h2 class="section-title">Education</h2>
        <div class="qualifications-grid" id="doctor-education">
        </div>
      </div>

      <div class="section section-half" id="availability-section">
        <h2 class="section-title">Work Schedule</h2>
        <div class="availability-schedule" id="doctor-availability">
        </div>
      </div>
    </div>

    <div class="section" id="bio-section">
      <h2 class="section-title">Professional Summary</h2>
      <p id="doctor-bio" style="color: var(--text-medium); line-height: 1.8; margin-bottom: 1rem;">
      </p>
    </div>

    <div class="action-bar">
      <a href="searchD.php" class="btn btn-white">← Back to Doctors List</a>
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
  <script src="../ajax/admin_view_doctor.js"></script>
</body>
</html>
