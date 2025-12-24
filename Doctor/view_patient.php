<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Patient Details - MedOffice</title>
  <link rel="stylesheet" href="../CSS/view_patient.css" />
</head>
<body data-role="doctor">
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

  <div class="container">
    <div class="patient-top-row">
      <div class="header-section">
        <div class="patient-header">
          <div class="patient-avatar" id="patient-avatar">SB</div>
          <div class="patient-info">
            <h1 class="patient-name" id="patient-name">Samia Boulkrinat</h1>
            <p class="patient-id">Patient ID: <strong id="patient-id">001</strong></p>
            <span class="status-badge" id="patient-status">Active Patient</span>
          </div>
        </div>

        <div class="info-grid">
          <div class="info-card">
            <div class="info-label">Age</div>
            <div class="info-value" id="patient-age">29 years</div>
          </div>
          <div class="info-card">
            <div class="info-label">Gender</div>
            <div class="info-value" id="patient-gender">Female</div>
          </div>
          <div class="info-card">
            <div class="info-label">Phone</div>
            <div class="info-value" id="patient-phone">+213 555 123 456</div>
          </div>
        </div>
      </div>

      <div class="section contact-info-box">
        <h2 class="section-title">Contact Information</h2>
        <div class="detail-row">
          <span class="detail-label">Email</span>
          <span class="detail-value" id="patient-email">samia.boulkrinat@email.com</span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Phone</span>
          <span class="detail-value" id="patient-phone-2">+213 555 123 456</span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Address</span>
          <span class="detail-value" id="patient-address">123 Medical Street, Algiers, Algeria</span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Emergency Contact</span>
          <span class="detail-value" id="patient-emergency">Ahmed Boulkrinat - +213 555 789 012</span>
        </div>
      </div>
    </div>

    <div class="info-sections-row">
      <div class="section section-half">
        <h2 class="section-title">Medical History</h2>
        <ul class="medical-history-list" id="medical-history-list">
          <li><strong>Hypertension</strong> - Diagnosed 2020, Currently managed with medication</li>
          <li><strong>Allergies</strong> - Penicillin (severe), Shellfish (mild)</li>
          <li><strong>Previous Surgeries</strong> - Appendectomy (2018)</li>
          <li><strong>Current Medications</strong> - Lisinopril 10mg daily, Vitamin D supplements</li>
        </ul>
      </div>

      <div class="section section-half">
        <h2 class="section-title">Recent Visits</h2>
        <div class="detail-row">
          <span class="detail-label">Last Visit</span>
          <span class="detail-value" id="patient-last-visit">October 15, 2025</span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Reason</span>
          <span class="detail-value" id="patient-last-reason">Regular Checkup</span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Next Appointment</span>
          <span class="detail-value" id="patient-next-appointment">November 12, 2025</span>
        </div>
      </div>
    </div>

    <div class="action-bar">
      <a href="searchP.php" class="btn btn-white">← Back to Search</a>
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

  <script src="../ajax/admin_view_patient.js"></script>
</body>
</html>
