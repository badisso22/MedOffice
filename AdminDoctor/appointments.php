<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today's Appointments - MedOffice</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="../CSS/appointments.css">
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
  <div class="drawer" id="drawer">
    <div class="drawer-header">
      <div class="logo">
        <div class="logo-icon">⚕</div>
        MedOffice
      </div>
      <button class="drawer-close" onclick="toggleDrawer()">&times;</button>
    </div>
    <ul class="drawer-menu">
      <li><a href="dashboard_ad.php">
        <svg viewBox="0 0 24 24" width="20" height="20"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
        Dashboard
      </a></li>
      <li><a href="profileD.php">
        <svg viewBox="0 0 24 24" width="20" height="20"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        Profile
      </a></li>
      <li><a href="searchP.php" class="active">
        <svg viewBox="0 0 24 24" width="20" height="20"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.35-4.35"></path></svg>
        Search Patients
      </a></li>
      <li><a href="searchA.php">
        <svg viewBox="0 0 24 24" width="20" height="20"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
        Search Assistant
      </a></li>
      <li><a href="calendarAD.php">
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
      <li><a href="medical_records.php">
        <svg viewBox="0 0 24 24" width="20" height="20"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
        Medical Records
      </a></li>
      <li><a href="prescriptions.php">
        <svg viewBox="0 0 24 24" width="20" height="20"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
        Prescriptions
      </a></li>
      <li><a href="reports_analytics.php">
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
    </ul>
    <button class="drawer-logout" onclick="window.location.href='logout.php'">
      <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" style="display: inline-block; margin-right: 0.5rem; vertical-align: middle;">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
        <polyline points="16 17 21 12 16 7"></polyline>
        <line x1="21" y1="12" x2="9" y2="12"></line>
      </svg>
      Logout
    </button>
  </div>

  <div class="drawer-overlay" id="drawerOverlay" onclick="toggleDrawer()"></div>

    <main class="appointments-main">
        <section class="appointments-hero">
            <div class="hero-badge">Today's Schedule</div>
            <h1>Upcoming <span class="highlight">Appointments</span></h1>
            <p class="date-display">Thursday, January 9, 2025</p>
        </section>

        <div class="appointments-container">
            <div class="next-appointment-card">
                <div class="next-badge">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    Next Appointment
                </div>
                <div class="next-content">
                    <div class="patient-info">
                        <div class="patient-avatar">SM</div>
                        <div class="patient-details">
                            <h2>Samia Boulekrinat</h2>
                            <p class="patient-meta">Patient ID: #P-2847 • Age: 34 • Regular Checkup</p>
                        </div>
                    </div>
                    <div class="appointment-time">
                        <div class="time-display">10:30 AM</div>
                        <div class="time-remaining">In 15 minutes</div>
                    </div>
                </div>
                <div class="quick-actions">
                    <button class="action-btn btn-primary">View Records</button>
                    <button class="action-btn btn-secondary">Start Consultation</button>
                </div>
            </div>
            <div class="appointments-list">
                <div class="list-header">
                    <h3>All Appointments Today</h3>
                    <div class="stats-badge">
                        <span class="stat-number">8</span>
                        <span class="stat-label">Total</span>
                    </div>
                </div>
                <div class="appointment-card completed">
                    <div class="appointment-status">
                        <span class="status-badge status-completed">Completed</span>
                    </div>
                    <div class="appointment-content">
                        <div class="time-slot">
                            <div class="time">08:00 AM</div>
                            <div class="duration">30 min</div>
                        </div>
                        <div class="patient-info-compact">
                            <div class="patient-avatar-small">JD</div>
                            <div>
                                <h4>James Davidson</h4>
                                <p>Follow-up Consultation</p>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="appointment-card completed">
                    <div class="appointment-status">
                        <span class="status-badge status-completed">Completed</span>
                    </div>
                    <div class="appointment-content">
                        <div class="time-slot">
                            <div class="time">09:00 AM</div>
                            <div class="duration">45 min</div>
                        </div>
                        <div class="patient-info-compact">
                            <div class="patient-avatar-small">ER</div>
                            <div>
                                <h4>Emily Rodriguez</h4>
                                <p>Annual Physical Exam</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="appointment-card in-progress">
                    <div class="appointment-status">
                        <span class="status-badge status-current">Current</span>
                    </div>
                    <div class="appointment-content">
                        <div class="time-slot">
                            <div class="time">10:30 AM</div>
                            <div class="duration">30 min</div>
                        </div>
                        <div class="patient-info-compact">
                            <div class="patient-avatar-small">SM</div>
                            <div>
                                <h4>Sarah Mitchell</h4>
                                <p>Regular Checkup</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="appointment-card upcoming">
                    <div class="appointment-status">
                        <span class="status-badge status-upcoming">Upcoming</span>
                    </div>
                    <div class="appointment-content">
                        <div class="time-slot">
                            <div class="time">11:30 AM</div>
                            <div class="duration">30 min</div>
                        </div>
                        <div class="patient-info-compact">
                            <div class="patient-avatar-small">MT</div>
                            <div>
                                <h4>Michael Thompson</h4>
                                <p>Blood Pressure Monitoring</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="appointment-card upcoming">
                    <div class="appointment-status">
                        <span class="status-badge status-upcoming">Upcoming</span>
                    </div>
                    <div class="appointment-content">
                        <div class="time-slot">
                            <div class="time">01:00 PM</div>
                            <div class="duration">45 min</div>
                        </div>
                        <div class="patient-info-compact">
                            <div class="patient-avatar-small">LC</div>
                            <div>
                                <h4>Lisa Chen</h4>
                                <p>Diabetes Management</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="appointment-card upcoming">
                    <div class="appointment-status">
                        <span class="status-badge status-upcoming">Upcoming</span>
                    </div>
                    <div class="appointment-content">
                        <div class="time-slot">
                            <div class="time">02:30 PM</div>
                            <div class="duration">30 min</div>
                        </div>
                        <div class="patient-info-compact">
                            <div class="patient-avatar-small">RP</div>
                            <div>
                                <h4>Robert Patterson</h4>
                                <p>Post-Surgery Follow-up</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="appointment-card upcoming">
                    <div class="appointment-status">
                        <span class="status-badge status-upcoming">Upcoming</span>
                    </div>
                    <div class="appointment-content">
                        <div class="time-slot">
                            <div class="time">03:30 PM</div>
                            <div class="duration">30 min</div>
                        </div>
                        <div class="patient-info-compact">
                            <div class="patient-avatar-small">AW</div>
                            <div>
                                <h4>Amanda Wilson</h4>
                                <p>Allergy Consultation</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="appointment-card upcoming">
                    <div class="appointment-status">
                        <span class="status-badge status-upcoming">Upcoming</span>
                    </div>
                    <div class="appointment-content">
                        <div class="time-slot">
                            <div class="time">04:30 PM</div>
                            <div class="duration">30 min</div>
                        </div>
                        <div class="patient-info-compact">
                            <div class="patient-avatar-small">DM</div>
                            <div>
                                <h4>David Martinez</h4>
                                <p>Prescription Renewal</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="summary-section">
                <div class="summary-card">
                    <div class="summary-icon completed-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <div class="summary-content">
                        <div class="summary-number">2</div>
                        <div class="summary-label">Completed</div>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-icon current-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div class="summary-content">
                        <div class="summary-number">1</div>
                        <div class="summary-label">In Progress</div>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-icon upcoming-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <div class="summary-content">
                        <div class="summary-number">5</div>
                        <div class="summary-label">Remaining</div>
                    </div>
                </div>
            </div>
        </div>
         <div class="nav-cta">
                <a href="dashboard_ad.php" class="action-btn btn-primary ">Back to Dashboard</a>
         </div>
    </main>

    <footer>
        <div class="footer-bottom">
            <p>&copy; 2025 MedOffice. All rights reserved. HIPAA-compliant medical practice management.</p>
        </div>
    </footer>
    <script>
        function toggleDrawer() {
            const drawer = document.getElementById('drawer');
            const overlay = document.getElementById('drawerOverlay');
            drawer.classList.toggle('open');
            overlay.classList.toggle('active');
        }

        function logout() {
            window.location.href = '../index.html';
        }
    </script>
</body>
</html>