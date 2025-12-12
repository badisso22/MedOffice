<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cabinet Information - MedOffice</title>
  <link rel="stylesheet" href="../CSS/general.css">
  <link rel="stylesheet" href="../CSS/dashboard.css">
  <link rel="stylesheet" href="../CSS/patient.css">
  <style>
    .info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 24px;
      margin-bottom: 32px;
    }

    .info-card {
      background: white;
      border-radius: 12px;
      padding: 28px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .info-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 4px 16px rgba(0,0,0,0.12);
    }

    .info-card h3 {
      margin: 0 0 20px 0;
      font-size: 1.4rem;
      color: #2c3e50;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .info-card h3 svg {
      width: 24px;
      height: 24px;
      stroke: #3498db;
      fill: none;
      stroke-width: 2;
      stroke-linecap: round;
      stroke-linejoin: round;
    }

    .info-item {
      display: flex;
      align-items: flex-start;
      margin-bottom: 16px;
      padding: 12px;
      background: #f8f9fa;
      border-radius: 8px;
      transition: background 0.2s;
    }

    .info-item:hover {
      background: #e9ecef;
    }

    .info-item:last-child {
      margin-bottom: 0;
    }

    .info-label {
      font-weight: 600;
      color: #495057;
      min-width: 100px;
      margin-right: 12px;
    }

    .info-value {
      color: #2c3e50;
      flex: 1;
    }

    .hours-table {
      width: 100%;
      border-collapse: collapse;
    }

    .hours-table tr {
      border-bottom: 1px solid #e9ecef;
    }

    .hours-table tr:last-child {
      border-bottom: none;
    }

    .hours-table td {
      padding: 12px 8px;
    }

    .hours-table td:first-child {
      font-weight: 600;
      color: #495057;
      width: 40%;
    }

    .hours-table td:last-child {
      color: #2c3e50;
      text-align: right;
    }

    .status-badge {
      display: inline-block;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 600;
    }

    .status-open {
      background: #d4edda;
      color: #155724;
    }

    .status-closed {
      background: #f8d7da;
      color: #721c24;
    }

    .map-container {
      background: white;
      border-radius: 12px;
      padding: 28px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      margin-bottom: 32px;
    }

    .map-container h3 {
      margin: 0 0 20px 0;
      font-size: 1.4rem;
      color: #2c3e50;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .map-placeholder {
      width: 100%;
      height: 300px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 1.1rem;
      opacity: 0.9;
    }

    .action-buttons {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
    }

    .btn-icon {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 12px 24px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.2s;
      border: none;
      cursor: pointer;
      font-size: 1rem;
    }

    .btn-icon svg {
      width: 18px;
      height: 18px;
    }

    @media (max-width: 768px) {
      .info-grid {
        grid-template-columns: 1fr;
      }
      
      .action-buttons {
        flex-direction: column;
      }
      
      .btn-icon {
        width: 100%;
        justify-content: center;
      }
    }
  </style>
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
      <span class="user-name">John Smith</span>
      <a href="logout.php" class="btn btn-secondary">Logout</a>
    </div>
  </div>
</nav>

<div class="drawer" id="drawer">
  <div class="drawer-header">
    <div class="logo">
      <div class="logo-icon">⚕</div>
      MedOffice
    </div>
    <button class="drawer-close" onclick="toggleDrawer()">&times;</button>
  </div>
  <ul class="drawer-menu">
    <li><a href="dashboard_p.php">
      <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
      Dashboard
    </a></li>
    <li><a href="profileP.php">
      <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
      My Profile
    </a></li>
    <li><a href="calendarP.php">
      <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
      Calendar
    </a></li>
    <li><a href="myRecords.php">
      <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
      Medical Records
    </a></li>
    <li><a href="myPrescriptions.php">
      <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
      Prescriptions
    </a></li>
    <li><a href="about_cabinet.php" class="active">
      <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
      Cabinet Info
    </a></li>
    <li><a href="myAppointment.php">
      <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><path d="M8 2v4M16 2v4M3 10h18"></path></svg>
      My Appointments
    </a></li>
    <li><a href="settings.php">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="3"></circle>
        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06A2 2 0 1 1 6.92 4.58l.06.06c.37.37.86.54 1.34.41a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09c0 .49.19.97.54 1.34a1.65 1.65 0 0 0 1.82.33h.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82c.1.63.52 1.15 1.15 1.25z"/>
      </svg>
      Settings
    </a></li>
    
  </ul>
</div>

<main class="layout">
  <section class="page-title">
    <h1>Cabinet Information</h1>
    <p style="color: #6c757d; margin-top: 8px;">Find all the details about our medical practice</p>
  </section>

  <div class="info-grid">
    <div class="info-card">
      <h3>
        <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
        Contact Information
      </h3>
      <div class="info-item">
        <span class="info-label">Name:</span>
        <span class="info-value">Central Medical Cabinet</span>
      </div>
      <div class="info-item">
        <span class="info-label">Address:</span>
        <span class="info-value">12 Rue de la Santé, Algiers</span>
      </div>
      <div class="info-item">
        <span class="info-label">Phone:</span>
        <span class="info-value">+213 21 00 00 00</span>
      </div>
      <div class="info-item">
        <span class="info-label">Email:</span>
        <span class="info-value">contact@cabinet.example.dz</span>
      </div>
      <div style="margin-top:16px">
        <a href="view_more_info.php" class="btn btn-primary btn-icon" aria-label="View more about this cabinet">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px;height:18px;margin-right:8px;vertical-align:middle">
            <path d="M12 2l9 7-9 7-9-7 9-7z"></path>
          </svg>
          View more
        </a>
      </div>
    </div>

    <div class="info-card">
      <h3>
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
        Opening Hours
      </h3>
      <table class="hours-table">
        <tr>
          <td>Monday - Thursday</td>
          <td>08:30 - 17:30</td>
        </tr>
        <tr>
          <td>Friday</td>
          <td>08:30 - 12:00</td>
        </tr>
        <tr>
          <td>Saturday - Sunday</td>
          <td><span class="status-badge status-closed">Closed</span></td>
        </tr>
      </table>
      <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid #e9ecef;">
        <span class="status-badge status-open">Currently Open</span>
      </div>
      <h3>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="12" y1="1" x2="12" y2="23"/>
         <path d="M17 5c0-2-2-3-5-3s-5 1-5 3 2 3 5 3 5 1 5 3-2 3-5 3-5-1-5-3"/>
        </svg>

        Budget
      </h3>
      <table class="hours-table">
        <tr>
          <td>Average price :</td>
          <td>$$$$$</td>
        </tr>
      </table>
    </div>
  </div>



  <div class="action-buttons">
    <a href="dashboard_p.php" class="btn btn-secondary btn-icon">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="19" y1="12" x2="5" y2="12"></line>
        <polyline points="12 19 5 12 12 5"></polyline>
      </svg>
      Back to Dashboard
    </a>
    <a href="calendarP.php" class="btn btn-primary btn-icon">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
        <line x1="16" y1="2" x2="16" y2="6"></line>
        <line x1="8" y1="2" x2="8" y2="6"></line>
      </svg>
      Book Appointment
    </a>
  </div>
</main>

<footer>
  <div class="footer-content">
    <div class="footer-section">
      <h3>MedOffice</h3>
      <p>Your trusted healthcare management platform</p>
    </div>
    <div class="footer-section">
      <h3>Support</h3>
      <ul>
        <li><a href="#">Help Center</a></li>
        <li><a href="#">Contact Support</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms of Service</a></li>
      </ul>
    </div>
    <div class="footer-section">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="#">Book Appointment</a></li>
        <li><a href="#">View Records</a></li>
        <li><a href="#">Message Doctor</a></li>
        <li><a href="#">Account Settings</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; 2025 MedOffice. All rights reserved. HIPAA-compliant medical practice management.</p>
  </div>
</footer>

<script>
  function toggleDrawer() {
    const d = document.getElementById('drawer');
    d.classList.toggle('open');
  }

  // Simulate current status check
  function updateStatus() {
    const now = new Date();
    const day = now.getDay();
    const hour = now.getHours();
    const minute = now.getMinutes();
    const currentTime = hour * 60 + minute;
    
    const statusBadge = document.querySelector('.info-card:nth-child(2) .status-badge');
    
    // Check if currently open
    let isOpen = false;
    if (day >= 1 && day <= 4) { // Mon-Thu
      if (currentTime >= 510 && currentTime <= 1050) { // 8:30-17:30
        isOpen = true;
      }
    } else if (day === 5) { // Friday
      if (currentTime >= 510 && currentTime <= 720) { // 8:30-12:00
        isOpen = true;
      }
    }
    
    if (isOpen) {
      statusBadge.textContent = 'Currently Open';
      statusBadge.className = 'status-badge status-open';
    } else {
      statusBadge.textContent = 'Currently Closed';
      statusBadge.className = 'status-badge status-closed';
    }
  }
  
  updateStatus();
</script>
</body>
</html>