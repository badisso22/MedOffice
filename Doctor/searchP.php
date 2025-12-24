<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Patient List - MedOffice</title>
  <link rel="stylesheet" href="../CSS/general.css" />
  <link rel="stylesheet" href="../CSS/searchP.css" />
  <link rel="stylesheet" href="../CSS/search_doc.css" />
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
  <div class="drawer" id="drawer">
    <div class="drawer-header">
      <div class="logo">
        <div class="logo-icon">⚕</div>
        MedOffice
      </div>
      <button class="drawer-close" onclick="toggleDrawer()">&times;</button>
    </div>
    <ul class="drawer-menu">
      <li><a href="dashboard_d.php">
        <svg viewBox="0 0 24 24" width="20" height="20">
          <rect x="3" y="3" width="7" height="7"></rect>
          <rect x="14" y="3" width="7" height="7"></rect>
          <rect x="14" y="14" width="7" height="7"></rect>
          <rect x="3" y="14" width="7" height="7"></rect>
        </svg>
        Dashboard
      </a></li>
      <li><a href="profileD.php">
        <svg viewBox="0 0 24 24" width="20" height="20">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
          <circle cx="12" cy="7" r="4"></circle>
        </svg>
        Profile
      </a></li>
      <li><a href="searchP.php" class="active">
        <svg viewBox="0 0 24 24" width="20" height="20">
          <circle cx="11" cy="11" r="8"></circle>
          <path d="m21 21-4.35-4.35"></path>
        </svg>
        Search Patients
      </a></li>
      <li><a href="searchA.php">
        <svg viewBox="0 0 24 24" width="20" height="20">
          <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
          <circle cx="8.5" cy="7" r="4"></circle>
          <line x1="20" y1="8" x2="20" y2="14"></line>
          <line x1="23" y1="11" x2="17" y2="11"></line>
        </svg>
        Search Assistant
      </a></li>
      <li><a href="calendarD.php">
        <svg viewBox="0 0 24 24" width="20" height="20">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
          <line x1="16" y1="2" x2="16" y2="6"></line>
          <line x1="8" y1="2" x2="8" y2="6"></line>
          <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>
        Calendar
      </a></li>
      <li><a href="add-patient.php">
        <svg viewBox="0 0 24 24" width="20" height="20">
          <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
          <circle cx="8.5" cy="7" r="4"></circle>
          <line x1="20" y1="8" x2="20" y2="14"></line>
          <line x1="23" y1="11" x2="17" y2="11"></line>
        </svg>
        Add Patient
      </a></li>
      <li><a href="add-assistant.php">
        <svg viewBox="0 0 24 24" width="20" height="20">
          <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
          <circle cx="8.5" cy="7" r="4"></circle>
          <line x1="20" y1="8" x2="20" y2="14"></line>
          <line x1="23" y1="11" x2="17" y2="11"></line>
        </svg>
        Add Assistant
      </a></li>
      <li><a href="appointments.php">
        <svg viewBox="0 0 24 24" width="20" height="20">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
          <line x1="16" y1="2" x2="16" y2="6"></line>
          <line x1="8" y1="2" x2="8" y2="6"></line>
          <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>
        Appointments
      </a></li>
      <li><a href="medical_records.php">
        <svg viewBox="0 0 24 24" width="20" height="20">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
          <polyline points="14 2 14 8 20 8"></polyline>
        </svg>
        Medical Records
      </a></li>
      <li><a href="prescriptions.php">
        <svg viewBox="0 0 24 24" width="20" height="20">
          <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
          <line x1="8" y1="21" x2="16" y2="21"></line>
          <line x1="12" y1="17" x2="12" y2="21"></line>
        </svg>
        Prescriptions
      </a></li>
      <li><a href="report_analytics.php">
        <svg viewBox="0 0 24 24" width="20" height="20">
          <line x1="18" y1="20" x2="18" y2="10"></line>
          <line x1="12" y1="20" x2="12" y2="4"></line>
          <line x1="6" y1="20" x2="6" y2="14"></line>
        </svg>
        Reports
      </a></li>
      <li><a href="settings.php">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="3"></circle>
          <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33h.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06A2 2 0 1 1 6.92 4.58l.06.06c.37.37.86.54 1.34.41a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09c0 .49.19.97.54 1.34a1.65 1.65 0 0 0 1.82.33h.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82c.1.63.52 1.15 1.15 1.25z"/>
        </svg>
        Settings
      </a></li>
    </ul>
    <button class="drawer-logout" onclick="window.location.href='logout.php'">
      <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" style="display:inline-block;margin-right:.5rem;vertical-align:middle;">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
        <polyline points="16 17 21 12 16 7"></polyline>
        <line x1="21" y1="12" x2="9" y2="12"></line>
      </svg>
      Logout
    </button>
  </div>

  <div class="drawer-overlay" id="drawerOverlay" onclick="toggleDrawer()"></div>

  <div class="container">
    <h1>Patient's List</h1>

    <form id="patient-search-form">
      <div class="form-group">
        <label for="searchName">Patient Name</label>
        <input type="text" id="searchName" name="searchName" placeholder="Enter name..." />
      </div>
      <div class="button-bar">
        <button type="submit" class="btn btn-primary">Search</button>
        <button type="reset" class="btn">Clear</button>
      </div>
    </form>
    <div id="patients-result"></div>

    <table id="patientsTable">
      <thead>
        <tr>
          <th>Name</th>
          <th>Age</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="patients-tbody">
      </tbody>
    </table>

    <a href="dashboard_d.php" class="btn btn-white btn-large">← back to the dashboard</a>
  </div>
  <footer>
    <div class="footer-content">
      <div class="footer-section">
        <h3>MedOffice</h3>
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
  <script src="../JS/admin_searchP.js"></script>
  <script src="../ajax/admin_searchP.js"></script>
  <script>
    function toggleDrawer() {
      const drawer = document.getElementById('drawer');
      const overlay = document.getElementById('drawerOverlay');
      drawer.classList.toggle('open');
      overlay.classList.toggle('active');
    }
  </script>
</body>
</html>
