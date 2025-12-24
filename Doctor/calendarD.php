<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendar - MedOffice</title>
  <link rel="stylesheet" href="../CSS/general.css">
  <link rel="stylesheet" href="../CSS/dashboard.css">
  <link rel="stylesheet" href="../CSS/admin.css">
  <link rel="stylesheet" href="../CSS/calendar.css">
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
                <span class="user-name">Dr.<?= htmlspecialchars($fullname ?? 'User') ?></span>
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
            <li><a href="dashboard_d.php" class="active">
                <svg viewBox="0 0 24 24" width="20" height="20"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                Dashboard
            </a></li>
            <li><a href="profileD.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Profile
            </a></li>
            <li><a href="searchP.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.35-4.35"></path></svg>
                Search Patients
            </a></li>
            <li><a href="searchA.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><path d="M17 11h6m-3-3v6"></path></svg>
                Search Assistant
            </a></li>
            <li><a href="calendarD.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Calendar
            </a></li>
            <li><a href="add-patient.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                Add Patient
            </a></li>
            <li><a href="add-assistant.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                Add Assistant
            </a></li>
            <li><a href="appointments.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Appointments
            </a></li>
            <!--<li><a href="medical_records.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                Medical Records
            </a></li>
            <li><a href="prescriptions.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                Prescriptions
            </a></li>-->
            <li><a href="report_analytics.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                Reports
            </a></li>
            <li><a href="settings.php">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06A2 2 0 1 1 6.92 4.58l.06.06c.37.37.86.54 1.34.41a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09c0 .49.19.97.54 1.34a1.65 1.65 0 0 0 1.82.33h.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82c.1.63.52 1.15 1.15 1.25z"/>
                </svg>
                Settings
            </a></li>
            <button class="drawer-logout" onclick="logout()">Logout</button>
        </ul>
   </div>
  <div class="drawer-overlay" id="drawerOverlay" onclick="toggleDrawer()"></div>

<main class="layout">
  <section class="page-title">
    <h1>System Appointments Calendar</h1>
    <p style="color: #6b7280; margin-top: 0.5rem;">Monitor all appointments across the clinic</p>
  </section>

  <div class="calendar-modern">
    <div class="cal-header-modern">
      <h2 id="monthYear"></h2>
      <div class="cal-nav">
        <button class="cal-nav-btn" onclick="prevMonth()">‹</button>
        <button class="cal-nav-btn cal-today-btn" onclick="goToToday()">Today</button>
        <button class="cal-nav-btn" onclick="nextMonth()">›</button>
      </div>
    </div>

    <div class="cal-grid-modern">
      <div class="cal-day-header">Mon</div>
      <div class="cal-day-header">Tue</div>
      <div class="cal-day-header">Wed</div>
      <div class="cal-day-header">Thu</div>
      <div class="cal-day-header">Fri</div>
      <div class="cal-day-header">Sat</div>
      <div class="cal-day-header">Sun</div>
      <div id="calendarDays" style="display: contents;"></div>
    </div>

    <div class="cal-legend">
      <div class="cal-legend-item">
        <div class="cal-legend-box today"></div>
        <span>Today</span>
      </div>
      <div class="cal-legend-item">
        <div class="cal-legend-box appointment"></div>
        <span>Appointment</span>
      </div>
    </div>
  </div>
  <br>
  <a href="dashboard_d.php" class="btn btn-secondary">← Dashboard</a>
</main>
<div class="modal-overlay" id="modalOverlay">
  <div class="modal modal-large">
    <div class="modal-header">
      <h3 id="modalTitle">Step 1: Select Patient</h3>
      <button class="modal-close" onclick="closeModal()">×</button>
    </div>
    
    <div class="wizard-progress">
      <div class="progress-step active">
        <div class="progress-circle">1</div>
        <div class="progress-label">Patient</div>
      </div>
      <div class="progress-step">
        <div class="progress-circle">2</div>
        <div class="progress-label">Time</div>
      </div>
      <div class="progress-step">
        <div class="progress-circle">3</div>
        <div class="progress-label">Details</div>
      </div>
    </div>
    
    <div class="modal-body">
      <input type="date" id="appointmentDate" style="display: none;">
      <input type="text" id="appointmentTime" style="display: none;">
      
      <div id="step1" class="wizard-step active">
        <div class="search-container">
          <label style="display: block; margin-bottom: 0.75rem; font-weight: 600; color: #1f2937; font-size: 1rem;">Search Patient</label>
          <div class="search-input-wrapper">
            <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="11" cy="11" r="8"></circle>
              <path d="m21 21-4.35-4.35"></path>
            </svg>
            <input type="text" id="patientSearch" class="search-input" placeholder="Search by name, ID, or phone..." oninput="searchPatients()">
          </div>
        </div>
        
        <div class="modal-form-group">
          <label for="patientSelect">Select Patient *</label>
          <select id="patientSelect" size="8" class="patient-select-large" onchange="loadPatientInfo()">
            <option value="">-- Select Patient --</option>
          </select>
        </div>
        
        <div class="modal-form-group">
          <label for="patientPhone">Patient Phone</label>
          <input type="tel" id="patientPhone" placeholder="Phone number will appear here" readonly style="background-color: #f3f4f6;">
        </div>
      </div>
      
      <div id="step2" class="wizard-step">
        <p style="color: #6b7280; margin-bottom: 1.5rem; text-align: center;">Select an available time slot for the appointment</p>
        <div id="timeSlotsContainer" class="time-slots-grid"></div>
      </div>
      
      <div id="step3" class="wizard-step">
        <div class="modal-form-group">
          <label for="appointmentType">Appointment Type *</label>
          <select id="appointmentType" required>
            <option value="">-- Select Type --</option>
            <option value="General Consultation">General Consultation</option>
            <option value="Medical Follow-up">Medical Follow-up</option>
            <option value="Emergency">Emergency</option>
            <option value="Vaccination">Vaccination</option>
            <option value="Test Results">Test Results</option>
          </select>
        </div>
        <div class="modal-form-group">
          <label for="notes">Additional Notes (optional)</label>
          <textarea id="notes" placeholder="Add any additional information about this appointment..." style="min-height: 120px;"></textarea>
        </div>
      </div>
      
      <div id="step4" class="wizard-step">
        <div class="loading-screen">
          <div class="medical-loader">
            <svg class="heartbeat" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#0891b2" stroke-width="2">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
            </svg>
            <div class="pulse-ring"></div>
          </div>
          <div class="loading-text">Booking Appointment<span class="loading-dots"></span></div>
          <div class="loading-subtext">Please wait while we process your request</div>
        </div>
      </div>
      
      <div id="resultStep" class="wizard-step">
        <div id="resultContainer"></div>
      </div>
    </div>
    
    <div class="wizard-footer" id="wizardFooter">
      <div class="wizard-footer-left">
        <button type="button" class="btn-modal btn-modal-secondary" onclick="prevStep()" id="prevBtn" style="display: none;">← Previous</button>
      </div>
      <div class="wizard-footer-right">
        <button type="button" class="btn-modal btn-modal-secondary" onclick="closeModal()">Cancel</button>
        <button type="button" class="btn-modal btn-modal-primary" onclick="nextStep()" id="nextBtn">Next →</button>
      </div>
    </div>
  </div>
</div>
<footer>
    <div class="footer-content">
      <div class="footer-section">
        <h3>MedOffice</h3>
        <p></p>
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
<script src="../JS/calendarAdmin.js"></script>
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
