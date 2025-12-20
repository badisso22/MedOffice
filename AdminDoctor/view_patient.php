<?php
session_start();

$patientID = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($patientID <= 0) {
    die('Invalid patient ID');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Patient Details - MedOffice</title>
  <link rel="stylesheet" href="../CSS/view_patient.css" />
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

  <div class="container">
    <div class="patient-top-row">
      <div class="header-section">
        <div class="patient-header">
          <div class="patient-avatar" id="patient-avatar"></div>
          <div class="patient-info">
            <h1 class="patient-name" id="patient-name"></h1>
            <p class="patient-id">Patient ID: <strong id="patient-id"></strong></p>
            <span class="status-badge" id="patient-status"></span>
          </div>
        </div>

        <div class="info-grid">
          <div class="info-card">
            <div class="info-label">Age</div>
            <div class="info-value" id="patient-age"></div>
          </div>
          <div class="info-card">
            <div class="info-label">Gender</div>
            <div class="info-value" id="patient-gender"></div>
          </div>
          <div class="info-card">
            <div class="info-label">Blood Type</div>
            <div class="info-value" id="patient-blood-type"></div>
          </div>
          <div class="info-card">
            <div class="info-label">Phone</div>
            <div class="info-value" id="patient-phone"></div>
          </div>
        </div>
      </div>

      <div class="section contact-info-box">
        <h2 class="section-title">Contact Information</h2>
        <div class="detail-row">
          <span class="detail-label">Email</span>
          <span class="detail-value" id="patient-email"></span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Phone</span>
          <span class="detail-value" id="patient-phone-2"></span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Address</span>
          <span class="detail-value" id="patient-address"></span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Emergency Contact</span>
          <span class="detail-value" id="patient-emergency"></span>
        </div>
      </div>
    </div>

    <div class="info-sections-row">
      <div class="section section-half">
        <h2 class="section-title">Medical History</h2>
        <ul class="medical-history-list" id="medical-history-list">
        </ul>
      </div>

      <div class="section section-half">
        <h2 class="section-title">Recent Visits</h2>
        <div class="detail-row">
          <span class="detail-label">Last Visit</span>
          <span class="detail-value" id="patient-last-visit"></span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Reason</span>
          <span class="detail-value" id="patient-last-reason"></span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Next Appointment</span>
          <span class="detail-value" id="patient-next-appointment"></span>
        </div>
      </div>
    </div>

    <div class="section">
      <div class="section-header">
        <h2 class="section-title">Medical Records & Prescriptions</h2>
      </div>
      <div class="tabs-container">
        <div class="tabs">
          <button class="tab-btn active" data-tab="records">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
              <polyline points="14 2 14 8 20 8"></polyline>
            </svg>
            Medical Records
          </button>
          <button class="tab-btn" data-tab="prescriptions">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
              <line x1="8" y1="21" x2="16" y2="21"></line>
              <line x1="12" y1="17" x2="12" y2="21"></line>
            </svg>
            Prescriptions
          </button>
        </div>
      </div>
      <div class="tab-content active" id="records">
        <div class="records-list" id="records-list">
        </div>
        <div class="view-more-container">
          <a href="view_records.php?patientID=<?php echo $patientID; ?>" class="btn btn-primary">View All Medical Records</a>
        </div>
      </div>
      <div class="tab-content" id="prescriptions">
        <div class="prescriptions-list" id="prescriptions-list">
        </div>
        <div class="view-more-container">
          <a href="view_prescription.php?patientID=<?php echo $patientID; ?>" class="btn btn-primary">View All Prescriptions</a>
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
  <script>
    document.querySelectorAll('.tab-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const tabName = this.getAttribute('data-tab');
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        this.classList.add('active');
        document.getElementById(tabName).classList.add('active');
      });
    });
  </script>
</body>
</html>
