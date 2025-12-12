<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Records - MedOffice</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="../CSS/myRecords.css">
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
                <span class="user-name">Patient Samia</span>
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
            <li><a href="calendarP.php">
                <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Calendar
            </a></li>
            <li><a href="myAppointments.php">
                <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Appointments
            </a></li>
            <li><a href="myRecords.php" class="active">
                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                Medical Records
            </a></li>
            <li><a href="myPrescriptions.php">
                <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                Prescriptions
            </a></li>
            <li><a href="cabinet_info.php">
                <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                Cabinet Info
            </a></li>
            <li><a href="settings.php">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06A2 2 0 1 1 6.92 4.58l.06.06c.37.37.86.54 1.34.41a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09c0 .49.19.97.54 1.34a1.65 1.65 0 0 0 1.82.33h.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82c.1.63.52 1.15 1.15 1.25z"/>
                </svg>
                Settings
            </a></li>
            <button class="drawer-logout" onclick="logout()">Logout</button>
        </ul>
    </div>

    <div class="drawer-overlay" id="drawerOverlay" onclick="toggleDrawer()"></div>

    <div class="records-container">
        <div class="records-header">
            <div class="header-content">
                <div>
                    <h1>Medical Records</h1>
                    <p>Access your complete medical history, lab results, and diagnostic reports</p>
                </div>
                <a href="dashboard_p.php" class="btn-back-dashboard">Back to dashboard</a>
            </div>
            
            <div class="search-bar">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                <input type="text" placeholder="Search by record type, date, or doctor...">
            </div>
        </div>

        <div class="content-wrapper">
            <div class="records-section">
                <div class="section-header">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="12" y1="11" x2="12" y2="17"></line>
                        <line x1="9" y1="14" x2="15" y2="14"></line>
                    </svg>
                    <h2>Medical History</h2>
                </div>
                <div class="records-list">
                    <div class="record-item" onclick="viewRecord('hypertension')">
                        <div class="record-info">
                            <div class="record-title">Hypertension Diagnosis</div>
                            <div class="record-meta">
                                <span>Diagnosed: Sept 15, 2024</span>
                                <span>Dr. Sarah Johnson</span>
                                <span>Status: Active</span>
                            </div>
                        </div>
                        <div class="record-actions">
                            <button class="btn-action btn-view" onclick="event.stopPropagation(); viewRecord('hypertension')">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                View Details
                            </button>
                            <button class="btn-action btn-download">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                Download
                            </button>
                        </div>
                    </div>
                    <div class="record-item" onclick="viewRecord('diabetes')">
                        <div class="record-info">
                            <div class="record-title">Diabetes Type 2</div>
                            <div class="record-meta">
                                <span>Diagnosed: March 22, 2023</span>
                                <span>Dr. Ahmed Mohamed</span>
                                <span>Status: Active</span>
                            </div>
                        </div>
                        <div class="record-actions">
                            <button class="btn-action btn-view" onclick="event.stopPropagation(); viewRecord('diabetes')">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                View Details
                            </button>
                            <button class="btn-action btn-download">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                Download
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="records-section">
                <div class="section-header">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 9l6-3 6 3v6l-6 3-6-3z"></path>
                        <line x1="12" y1="12" x2="12" y2="21"></line>
                    </svg>
                    <h2>Latest Lab Results - Nov 2, 2025</h2>
                </div>
                <div class="lab-results-grid">
                    <div class="lab-card" onclick="viewRecord('labs-blood-glucose')">
                        <div class="lab-name">Blood Glucose</div>
                        <div class="lab-value">115</div>
                        <div class="lab-unit">mg/dL</div>
                        <div class="status-badge status-elevated">Elevated</div>
                    </div>
                    <div class="lab-card" onclick="viewRecord('labs-cholesterol')">
                        <div class="lab-name">Cholesterol</div>
                        <div class="lab-value">185</div>
                        <div class="lab-unit">mg/dL</div>
                        <div class="status-badge status-normal">Normal</div>
                    </div>
                    <div class="lab-card" onclick="viewRecord('labs-hdl')">
                        <div class="lab-name">HDL</div>
                        <div class="lab-value">52</div>
                        <div class="lab-unit">mg/dL</div>
                        <div class="status-badge status-normal">Normal</div>
                    </div>
                    <div class="lab-card" onclick="viewRecord('labs-ldl')">
                        <div class="lab-name">LDL</div>
                        <div class="lab-value">110</div>
                        <div class="lab-unit">mg/dL</div>
                        <div class="status-badge status-normal">Normal</div>
                    </div>
                </div>
            </div>
            <div class="records-section">
                <div class="section-header">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                        <path d="M21 15l-5-5L5 21"></path>
                    </svg>
                    <h2>Imaging & Diagnostics</h2>
                </div>
                <div class="records-list">
                    <div class="record-item" onclick="viewRecord('chest-xray')">
                        <div class="record-info">
                            <div class="record-title">Chest X-Ray</div>
                            <div class="record-meta">
                                <span>Date: Oct 28, 2025</span>
                                <span>Result: Normal</span>
                                <span>Dr. Lisa Martinez</span>
                            </div>
                        </div>
                        <div class="record-actions">
                            <button class="btn-action btn-view" onclick="event.stopPropagation(); viewRecord('chest-xray')">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                View Details
                            </button>
                            <button class="btn-action btn-download">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                Download
                            </button>
                        </div>
                    </div>
                    <div class="record-item" onclick="viewRecord('ecg')">
                        <div class="record-info">
                            <div class="record-title">ECG (Electrocardiogram)</div>
                            <div class="record-meta">
                                <span>Date: Oct 20, 2025</span>
                                <span>Result: Normal Rhythm</span>
                                <span>Dr. Ahmed Mohamed</span>
                            </div>
                        </div>
                        <div class="record-actions">
                            <button class="btn-action btn-view" onclick="event.stopPropagation(); viewRecord('ecg')">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                View Details
                            </button>
                            <button class="btn-action btn-download">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                Download
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                </ul>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">Book Appointment</a></li>
                    <li><a href="#">Message Doctor</a></li>
                    <li><a href="#">Account Settings</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <script>
        function toggleDrawer() {
            const drawer = document.getElementById('drawer');
            const overlay = document.getElementById('drawerOverlay');
            drawer.classList.toggle('open');
            overlay.classList.toggle('active');
        }

        function viewRecord(recordId) {
            window.location.href = `record_details.php`;
        }

        function logout() {
            window.location.href = '../index.html';
        }
    </script>
</body>
</html>
