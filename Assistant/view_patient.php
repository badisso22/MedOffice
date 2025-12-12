<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Patient Details - MedOffice</title>
  <link rel="stylesheet" href="../CSS/general.css" />
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
            <span class="user-name">Assistant Kim</span>
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
          <div class="patient-avatar">SB</div>
          <div class="patient-info">
            <h1 class="patient-name">Samia Boulkrinat</h1>
            <p class="patient-id">Patient ID: <strong>001</strong></p>
            <span class="status-badge">Active Patient</span>
          </div>
        </div>

        <div class="info-grid">
          <div class="info-card">
            <div class="info-label">Age</div>
            <div class="info-value">29 years</div>
          </div>
          <div class="info-card">
            <div class="info-label">Gender</div>
            <div class="info-value">Female</div>
          </div>
          <div class="info-card">
            <div class="info-label">Blood Type</div>
            <div class="info-value">O+</div>
          </div>
          <div class="info-card">
            <div class="info-label">Phone</div>
            <div class="info-value">+213 555 123 456</div>
          </div>
        </div>
      </div>

      <div class="section contact-info-box">
        <h2 class="section-title">Contact Information</h2>
        <div class="detail-row">
          <span class="detail-label">Email</span>
          <span class="detail-value">samia.boulkrinat@email.com</span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Phone</span>
          <span class="detail-value">+213 555 123 456</span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Address</span>
          <span class="detail-value">123 Medical Street, Algiers, Algeria</span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Emergency Contact</span>
          <span class="detail-value">Ahmed Boulkrinat - +213 555 789 012</span>
        </div>
      </div>
    </div>

    <div class="info-sections-row">
      <div class="section section-half">
        <h2 class="section-title">Recent Visits</h2>
        <div class="detail-row">
          <span class="detail-label">Last Visit</span>
          <span class="detail-value">October 15, 2025</span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Reason</span>
          <span class="detail-value">Regular Checkup</span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Next Appointment</span>
          <span class="detail-value">November 12, 2025</span>
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
