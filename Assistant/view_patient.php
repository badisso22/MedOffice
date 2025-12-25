<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Patient Details - MedOffice</title>
  <link rel="stylesheet" href="../CSS/general.css" />
  <link rel="stylesheet" href="../CSS/view_patient.css" />
</head>
<body data-role="doctor">
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
                <span class="user-name">Assistant Kim</span>
                <div class="top-icons">
                    <a href="assistant_messages.php" class="icon-btn" title="Chat">
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
    <div class="action-bar">
      <a href="search_patient.php" class="btn btn-white">← Back to Search</a>
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
