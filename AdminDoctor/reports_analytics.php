<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Analytics - Doctor Dashboard</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="../CSS/report_analytics.css">
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
            <li><a href="dashboard_ad.php" class="active">
                <svg viewBox="0 0 24 24" width="20" height="20"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                Dashboard
            </a></li>
            <li><a href="profileAD.php">
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
            <!--<li><a href="medical_records.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                Medical Records
            </a></li>
            <li><a href="prescriptions.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                Prescriptions
            </a></li>-->
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
            <button class="drawer-logout" onclick="logout()">Logout</button>
        </ul>
    </div>

    <div class="drawer-overlay" id="drawerOverlay" onclick="toggleDrawer()"></div>

    <div class="drawer" id="drawer">
        <div class="drawer-header">
            <div class="logo">
                <div class="logo-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="1"></circle>
                        <path d="M12 1v6m0 6v6M4.22 4.22l4.24 4.24m3.08 3.08l4.24 4.24M1 12h6m6 0h6M4.22 19.78l4.24-4.24m3.08-3.08l4.24-4.24"/>
                    </svg>
                </div>
                MedOffice
            </div>
            <button class="drawer-close" onclick="toggleDrawer()">&times;</button>
        </div>
        <ul class="drawer-menu">
            <li><a href="dashboard_d.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                Dashboard
            </a></li>
            <li><a href="profileD.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Profile
            </a></li>
            <li><a href="report_analytics.php" class="active">
                <svg viewBox="0 0 24 24" width="20" height="20"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                Reports
            </a></li>
            <li><a href="appointments.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Appointments
            </a></li>
            <li><a href="medical_records.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                Medical Records
            </a></li>
            <li><a href="settings.php">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06A2 2 0 1 1 6.92 4.58l.06.06c.37.37.86.54 1.34.41a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09c0 .49.19.97.54 1.34a1.65 1.65 0 0 0 1.82.33h.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82c.1.63.52 1.15 1.15 1.25z"/>
                </svg>
                Settings
            </a></li>
        </ul>
    </div>

    <div class="drawer-overlay" id="drawerOverlay" onclick="toggleDrawer()"></div>

    <main class="dashboard-main">
        <div class="page-container">
            <div class="page-header">
                <h1>Analytics & Reports</h1>
                <div class="header-actions">
                    <select class="time-period-select">
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month" selected>This Month</option>
                        <option value="year">This Year</option>
                        <option value="custom">Custom Range</option>
                    </select>
                </div>
            </div>
            <div class="metrics-grid">
                <div class="metric-card">
                    <div class="metric-icon" style="background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                        </svg>
                    </div>
                    <div class="metric-content">
                        <div class="metric-label">Total Patients</div>
                        <div class="metric-value">1,248</div>
                        <div class="metric-change positive">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 19V5M5 12l7-7 7 7"/>
                            </svg>
                            <span>12% from last month</span>
                        </div>
                    </div>
                </div>

                <div class="metric-card">
                    <div class="metric-icon" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <path d="M16 2v4M8 2v4M3 10h18"/>
                        </svg>
                    </div>
                    <div class="metric-content">
                        <div class="metric-label">Appointments This Month</div>
                        <div class="metric-value">342</div>
                        <div class="metric-change positive">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 19V5M5 12l7-7 7 7"/>
                            </svg>
                            <span>8% from last month</span>
                        </div>
                    </div>
                </div>

                <div class="metric-card">
                    <div class="metric-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>
                        </svg>
                    </div>
                    <div class="metric-content">
                        <div class="metric-label">Revenue Generated</div>
                        <div class="metric-value">$48,392</div>
                        <div class="metric-change positive">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 19V5M5 12l7-7 7 7"/>
                            </svg>
                            <span>15% from last month</span>
                        </div>
                    </div>
                </div>

                <div class="metric-card">
                    <div class="metric-icon" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                        </svg>
                    </div>
                    <div class="metric-content">
                        <div class="metric-label">Active Prescriptions</div>
                        <div class="metric-value">186</div>
                        <div class="metric-change negative">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 5v14M5 12l7 7 7-7"/>
                            </svg>
                            <span>3% from last month</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card performance-card">
                <div class="card-header">
                    <h2>Performance Overview</h2>
                </div>
                <div class="performance-grid">
                    <div class="performance-item">
                        <div class="performance-label">Avg. Consultation Time</div>
                        <div class="performance-value">24 min</div>
                        <div class="performance-bar">
                            <div class="performance-fill" style="width: 80%;"></div>
                        </div>
                    </div>
                    <div class="performance-item">
                        <div class="performance-label">Patient Satisfaction</div>
                        <div class="performance-value">96%</div>
                        <div class="performance-bar">
                            <div class="performance-fill" style="width: 96%;"></div>
                        </div>
                    </div>
                    <div class="performance-item">
                        <div class="performance-label">Appointment Completion Rate</div>
                        <div class="performance-value">98%</div>
                        <div class="performance-bar">
                            <div class="performance-fill" style="width: 98%;"></div>
                        </div>
                    </div>
                    <div class="performance-item">
                        <div class="performance-label">Prescription Accuracy</div>
                        <div class="performance-value">99%</div>
                        <div class="performance-bar">
                            <div class="performance-fill" style="width: 99%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="demographics-grid">
                <div class="card demographics-card">
                    <h2>Age Distribution</h2>
                    <div class="demographics-list">
                        <div class="demographics-item">
                            <div class="demographics-label">0-18 years</div>
                            <div class="demographics-bar">
                                <div class="demographics-fill" style="width: 18%; background: #0891b2;"></div>
                            </div>
                            <div class="demographics-value">18%</div>
                        </div>
                        <div class="demographics-item">
                            <div class="demographics-label">19-35 years</div>
                            <div class="demographics-bar">
                                <div class="demographics-fill" style="width: 32%; background: #06b6d4;"></div>
                            </div>
                            <div class="demographics-value">32%</div>
                        </div>
                        <div class="demographics-item">
                            <div class="demographics-label">36-55 years</div>
                            <div class="demographics-bar">
                                <div class="demographics-fill" style="width: 28%; background: #10b981;"></div>
                            </div>
                            <div class="demographics-value">28%</div>
                        </div>
                        <div class="demographics-item">
                            <div class="demographics-label">56+ years</div>
                            <div class="demographics-bar">
                                <div class="demographics-fill" style="width: 22%; background: #f59e0b;"></div>
                            </div>
                            <div class="demographics-value">22%</div>
                        </div>
                    </div>
                </div>

                <div class="card demographics-card">
                    <h2>Appointment Types</h2>
                    <div class="demographics-list">
                        <div class="demographics-item">
                            <div class="demographics-label">General Checkup</div>
                            <div class="demographics-bar">
                                <div class="demographics-fill" style="width: 35%; background: #0891b2;"></div>
                            </div>
                            <div class="demographics-value">35%</div>
                        </div>
                        <div class="demographics-item">
                            <div class="demographics-label">Follow-up</div>
                            <div class="demographics-bar">
                                <div class="demographics-fill" style="width: 25%; background: #06b6d4;"></div>
                            </div>
                            <div class="demographics-value">25%</div>
                        </div>
                        <div class="demographics-item">
                            <div class="demographics-label">Consultation</div>
                            <div class="demographics-bar">
                                <div class="demographics-fill" style="width: 25%; background: #10b981;"></div>
                            </div>
                            <div class="demographics-value">25%</div>
                        </div>
                        <div class="demographics-item">
                            <div class="demographics-label">Emergency</div>
                            <div class="demographics-bar">
                                <div class="demographics-fill" style="width: 15%; background: #ef4444;"></div>
                            </div>
                            <div class="demographics-value">15%</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card table-card">
                <div class="table-header">
                    <h2>Most Prescribed Medications</h2>
                </div>
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Medication</th>
                                <th>Prescriptions</th>
                                <th>Percentage</th>
                                <th>Trend</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Amoxicillin</td>
                                <td><strong>145</strong></td>
                                <td>18%</td>
                                <td><span class="trend positive">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 19V5M5 12l7-7 7 7"/>
                                    </svg> Up 5%
                                </span></td>
                            </tr>
                            <tr>
                                <td>Lisinopril</td>
                                <td><strong>132</strong></td>
                                <td>16%</td>
                                <td><span class="trend positive">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 19V5M5 12l7-7 7 7"/>
                                    </svg> Up 3%
                                </span></td>
                            </tr>
                            <tr>
                                <td>Metformin</td>
                                <td><strong>118</strong></td>
                                <td>15%</td>
                                <td><span class="trend neutral">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg> Stable
                                </span></td>
                            </tr>
                            <tr>
                                <td>Atorvastatin</td>
                                <td><strong>105</strong></td>
                                <td>13%</td>
                                <td><span class="trend positive">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 19V5M5 12l7-7 7 7"/>
                                    </svg> Up 2%
                                </span></td>
                            </tr>
                            <tr>
                                <td>Omeprazole</td>
                                <td><strong>98</strong></td>
                                <td>12%</td>
                                <td><span class="trend negative">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 5v14M5 12l7 7 7-7"/>
                                    </svg> Down 1%
                                </span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>MedOffice</h3>
                <p>Professional healthcare management system</p>
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
        function logout() {
            window.location.href = '../index.html';
        }
    </script>
</body>
</html>
