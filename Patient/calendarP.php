<?php
session_start();
$fullname = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'User';

$cabinetID = isset($_GET['cabinetID']) ? (int)$_GET['cabinetID'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Appointments - MedOffice</title>
  <link rel="stylesheet" href="../CSS/general.css">
  <link rel="stylesheet" href="../CSS/dashboard.css">
  <link rel="stylesheet" href="../CSS/admin.css">
  <link rel="stylesheet" href="../CSS/calendar.css">
  <link rel="stylesheet" href="../CSS/calendar_assistant.css">
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
        <span class="user-name">Patient <?= htmlspecialchars($fullname, ENT_QUOTES, 'UTF-8') ?></span>
        <div class="top-icons">
          <a href="patient_messages.php" class="icon-btn" title="Chat">
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
      <li><a href="dashboard_p.php">
        <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
        Dashboard
      </a></li>
      <li><a href="profileP.php">
        <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        My Profile
      </a></li>
      <li><a href="calendarP.php" class="active">
        <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        Calendar
      </a></li>
      <li><a href="appointmentsP.php">
        <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        Appointments
      </a></li>
      <li><a href="myRecords.php">
        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
        Medical Records
      </a></li>
      <li><a href="myPrescriptions.php">
        <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
        Prescriptions
      </a></li>
      <li><a href="about_cabinet.php">
        <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
        Cabinet Info
      </a></li>
      <li><a href="medAi.php">
        <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
          <circle cx="8" cy="10" r="1.5" fill="white"></circle>
          <circle cx="12" cy="7" r="1.5" fill="white"></circle>
          <circle cx="16" cy="10" r="1.5" fill="white"></circle>
          <circle cx="10" cy="14" r="1.5" fill="white"></circle>
          <circle cx="14" cy="14" r="1.5" fill="white"></circle>
          <circle cx="12" cy="17" r="1.5" fill="white"></circle>
          <line x1="8" y1="10" x2="12" y2="7" stroke="white" stroke-width="1"></line>
          <line x1="12" y1="7" x2="16" y2="10" stroke="white" stroke-width="1"></line>
          <line x1="8" y1="10" x2="10" y2="14" stroke="white" stroke-width="1"></line>
          <line x1="16" y1="10" x2="14" y2="14" stroke="white" stroke-width="1"></line>
          <line x1="10" y1="14" x2="12" y2="17" stroke="white" stroke-width="1"></line>
          <line x1="14" y1="14" x2="12" y2="17" stroke="white" stroke-width="1"></line>
        </svg>
        Med Ai
      </a></li>
      <li><a href="settings.php">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="3"></circle>
          <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06A2 2 0 1 1 6.92 4.58l.06.06c.37.37.86.54 1.34.41a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09c0 .49.19.97.54 1.34a1.65 1.65 0 0 0 1.82.33h.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82c.1.63.52 1.15 1.15 1.25z"></path>
        </svg>
        Settings
      </a></li>
    </ul>
  </div>

  <div class="drawer-overlay" id="drawerOverlay" onclick="toggleDrawer()"></div>

  <main class="layout">
    <section class="page-title">
      <h1>My Appointments</h1>
      <p style="color:#6b7280;margin-top:0.5rem;">
        View and book your appointments
      </p>
    </section>

    <div class="calendar-modern">
      <div class="cal-header-modern">
        <h2 id="monthYear">Loading...</h2>
        <div class="cal-nav">
          <button class="cal-nav-btn" onclick="prevMonth()" title="Previous Month">‹</button>
          <button class="cal-nav-btn cal-today-btn" onclick="today()" title="Go to Today">Today</button>
          <button class="cal-nav-btn" onclick="nextMonth()" title="Next Month">›</button>
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
          <div class="cal-legend-box has-appointments"></div>
          <span>Appointments</span>
        </div>
        <div class="cal-legend-item">
          <div class="cal-legend-box past-date"></div>
          <span>Past Dates</span>
        </div>
      </div>
    </div>

    <br>
    <a href="dashboard_p.php" class="btn btn-secondary">← Back to Dashboard</a>
  </main>

  <div class="modal-overlay" id="modalOverlay">
    <div class="modal modal-large">
      <div class="modal-header">
        <h3 id="modalTitle">Step 1: Select Cabinet</h3>
        <button class="modal-close" id="closeModalBtn">×</button>
      </div>

      <div class="wizard-progress">
        <div class="progress-step active">
          <div class="progress-circle">1</div>
          <div class="progress-label">Cabinet</div>
        </div>
        <div class="progress-step">
          <div class="progress-circle">2</div>
          <div class="progress-label">Doctor</div>
        </div>
        <div class="progress-step">
          <div class="progress-circle">3</div>
          <div class="progress-label">Time</div>
        </div>
        <div class="progress-step">
          <div class="progress-circle">4</div>
          <div class="progress-label">Details</div>
        </div>
        <div class="progress-step">
          <div class="progress-circle">5</div>
          <div class="progress-label">Confirm</div>
        </div>
      </div>

      <div class="modal-body">
        <input type="date" id="appointmentDate" style="display:none;">
        <input type="hidden" id="appointmentTime">
        <input type="hidden" id="appointmentDoctor">
        <input type="hidden" id="appointmentCabinet">

        <div id="step0" class="wizard-step active">
          <div class="modal-form-group">
            <label>Search Cabinets</label>
            <div class="search-container">
              <input type="text" id="cabinetSearch" placeholder="Search by name or location...">
              <div id="cabinetList" class="search-results"></div>
            </div>
          </div>
          <div id="cabinetSelectedInfo" class="selected-info-card" style="display:none;"></div>
        </div>

        <div id="step1" class="wizard-step">
          <div class="modal-form-group">
            <label>Select Doctor *</label>
            <div id="doctorsContainer" class="doctors-grid"></div>
          </div>
          <div id="doctorSelectedInfo" class="selected-info-card" style="display:none;"></div>
        </div>

        <div id="step2" class="wizard-step">
          <p style="color:#6b7280;margin-bottom:1.5rem;text-align:center;">
            Available time slots for <strong id="selectedDateDisplay"></strong>
          </p>
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
            <textarea id="notes" placeholder="Any special requirements or additional information..." style="min-height:120px;"></textarea>
          </div>
        </div>

        <div id="step4" class="wizard-step">
          <div id="confirmationSummary" class="confirmation-summary"></div>
        </div>

        <div id="step5" class="wizard-step">
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
          <div id="resultMessage"></div>
        </div>
      </div>

      <div class="wizard-footer" id="wizardFooter">
        <div class="wizard-footer-left">
          <button type="button" class="btn-modal btn-modal-secondary" id="prevBtn" style="display:none;">← Previous</button>
        </div>
        <div class="wizard-footer-right">
          <button type="button" class="btn-modal btn-modal-secondary" onclick="closeModal()">Cancel</button>
          <button type="button" class="btn-modal btn-modal-primary" id="nextBtn">Next →</button>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <div class="footer-content">
      <div class="footer-section">
        <h3>MedOffice</h3>
        <p>Medical practice management system</p>
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
    window.cabinetID = <?= $cabinetID ?>;

    function toggleDrawer() {
      const drawer = document.getElementById('drawer');
      const overlay = document.getElementById('drawerOverlay');
      if (!drawer || !overlay) return;
      drawer.classList.toggle('open');
      overlay.classList.toggle('active');
    }
  </script>
  <script>
  window.patientId = <?= isset($_SESSION['patientID']) ? (int)$_SESSION['patientID'] : 0 ?>;
</script>
<script src="../JS/calendarPatient.js"></script>

</body>
</html>