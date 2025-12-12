<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Queue - Assistant Panel - MedOffice</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="../CSS/appointments.css">
    <link rel="stylesheet" href="../CSS/appointments_list.css">
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

    <div class="drawer" id="drawer">
        <div class="drawer-header">
            <div class="logo">
                <div class="logo-icon">⚕</div>
                MedOffice
            </div>
            <button class="drawer-close" onclick="toggleDrawer()">&times;</button>
        </div>
        <ul class="drawer-menu">
            <li><a href="dashboard_a.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                Dashboard
            </a></li>
            <li><a href="profileA.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Profile
            </a></li>
            <li><a href="appointmets_list.php" class="active">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                Appointments List
            </a></li>
            <li><a href="medical_records.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                Medical Records
            </a></li>
            <li><a href="prescriptions.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                Prescriptions
            </a></li>
            <li><a href="reports.php">
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
            <div class="hero-badge">Queue Management</div>
            <h1>Patient <span class="highlight">Queue</span></h1>
            <p class="date-display">Manage waiting patients and next appointments</p>
        </section>

        <div class="appointments-container">
            <div class="queue-controls">
                <div class="queue-info">
                    <strong>Tip:</strong> Select a patient from the dropdown to set them as the next in line, or use the arrow buttons to reorder the queue.
                </div>

                <div class="control-group">
                    <label class="control-label">Set Next Patient:</label>
                    <select class="select-next" id="nextPatientSelect" >
                        <option value="">-- Select a patient --</option>
                        <option value="0">Sarah Mitchell - Regular Checkup</option>
                        <option value="1">Michael Thompson - Blood Pressure Monitoring</option>
                        <option value="2">Lisa Chen - Diabetes Management</option>
                        <option value="3">Robert Patterson - Post-Surgery Follow-up</option>
                        <option value="4">Amanda Wilson - Allergy Consultation</option>
                    </select>
                    <div class="queue-actions">
                        <button class="action-btn btn-update" >
                            Confirm & Update
                        </button>
                        <button class="action-btn btn-reset">
                            Reset Queue
                        </button>
                    </div>
                </div>
            </div>

            <!-- Queue List -->
            <div class="queue-list">
                <div class="list-header">
                    <h3>Patient Queue</h3>
                    <div class="stats-badge">
                        <span class="stat-number">5</span>
                        <span class="stat-label">Waiting</span>
                    </div>
                </div>

                <div class="queue-item active" id="patient-0">
                    <div class="queue-position">
                        <div class="position-badge next">1</div>
                        <div class="position-info">
                            <h4>Sarah Mitchell</h4>
                            <div class="position-meta">
                                <span>Patient ID: #P-2847</span>
                                <span>Regular Checkup</span>
                                <span>10:30 AM</span>
                            </div>
                        </div>
                    </div>
                    <div class="queue-item-actions">
                        <button class="btn-move" title="Move down">↓</button>
                    </div>
                </div>

                <div class="queue-item" id="patient-1">
                    <div class="queue-position">
                        <div class="position-badge waiting">2</div>
                        <div class="position-info">
                            <h4>Michael Thompson</h4>
                            <div class="position-meta">
                                <span>Patient ID: #P-2920</span>
                                <span>Blood Pressure Monitoring</span>
                                <span>11:30 AM</span>
                            </div>
                        </div>
                    </div>
                    <div class="queue-item-actions">
                        <button class="btn-move" title="Move up" onclick="moveUp(1)">↑</button>
                        <button class="btn-move" title="Move down" onclick="moveDown(1)">↓</button>
                    </div>
                </div>

                <div class="queue-item" id="patient-2">
                    <div class="queue-position">
                        <div class="position-badge waiting">3</div>
                        <div class="position-info">
                            <h4>Lisa Chen</h4>
                            <div class="position-meta">
                                <span>Patient ID: #P-3001</span>
                                <span>Diabetes Management</span>
                                <span>01:00 PM</span>
                            </div>
                        </div>
                    </div>
                    <div class="queue-item-actions">
                        <button class="btn-move" title="Move up" onclick="moveUp(2)">↑</button>
                        <button class="btn-move" title="Move down" onclick="moveDown(2)">↓</button>
                    </div>
                </div>

                <div class="queue-item" id="patient-3">
                    <div class="queue-position">
                        <div class="position-badge waiting">4</div>
                        <div class="position-info">
                            <h4>Robert Patterson</h4>
                            <div class="position-meta">
                                <span>Patient ID: #P-3087</span>
                                <span>Post-Surgery Follow-up</span>
                                <span>02:30 PM</span>
                            </div>
                        </div>
                    </div>
                    <div class="queue-item-actions">
                        <button class="btn-move" title="Move up" onclick="moveUp(3)">↑</button>
                        <button class="btn-move" title="Move down" onclick="moveDown(3)">↓</button>
                    </div>
                </div>

                <div class="queue-item" id="patient-4">
                    <div class="queue-position">
                        <div class="position-badge waiting">5</div>
                        <div class="position-info">
                            <h4>Amanda Wilson</h4>
                            <div class="position-meta">
                                <span>Patient ID: #P-3152</span>
                                <span>Allergy Consultation</span>
                                <span>03:30 PM</span>
                            </div>
                        </div>
                    </div>
                    <div class="queue-item-actions">
                        <button class="btn-move" title="Move up" onclick="moveUp(4)">↑</button>
                    </div>
                </div>
            </div>
        <div class="nav-cta">
            <a href="dashboard_a.php" class="action-btn btn-primary">Back to Dashboard</a>
        </div>
    </main>

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
        function toggleDrawer() {
      const drawer = document.getElementById('drawer');
      const overlay = document.getElementById('drawerOverlay');
      drawer.classList.toggle('open');
      overlay.classList.toggle('active');
    }
    </script>
</body>
</html>
