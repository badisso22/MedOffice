<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard - MedOffice</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="../CSS/dashboard.css">
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
            <li><a href="dashboard_p.php" class="active">
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
            <li><a href="calendarP.php">
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
          <!--  <li><a href="myPrescriptions.php">
                <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                Consultations
            </a></li>-->
            <li><a href="about_cabinet.php">
                <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                Cabinet Info
            </a></li>
            <li><a href="medAi.php">
                <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                    <circle cx="8" cy="10" r="1.5" fill="white"/>
                    <circle cx="12" cy="7" r="1.5" fill="white"/>
                    <circle cx="16" cy="10" r="1.5" fill="white"/>
                    <circle cx="10" cy="14" r="1.5" fill="white"/>
                    <circle cx="14" cy="14" r="1.5" fill="white"/>
                    <circle cx="12" cy="17" r="1.5" fill="white"/>
                    <line x1="8" y1="10" x2="12" y2="7" stroke="white" stroke-width="1"/>
                    <line x1="12" y1="7" x2="16" y2="10" stroke="white" stroke-width="1"/>
                    <line x1="8" y1="10" x2="10" y2="14" stroke="white" stroke-width="1"/>
                    <line x1="16" y1="10" x2="14" y2="14" stroke="white" stroke-width="1"/>
                    <line x1="10" y1="14" x2="12" y2="17" stroke="white" stroke-width="1"/>
                    <line x1="14" y1="14" x2="12" y2="17" stroke="white" stroke-width="1"/>
                </svg>                Med Ai
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
    <main class="dashboard-main">
        <section class="dashboard-hero">
            <div class="hero-badge">Patient Portal</div>
            <h1>Welcome back, <span class="highlight">Samia boulekrinate</span></h1>
            <p>Manage your appointments, medical records, and health information from your personalized dashboard</p>
        </section>
        <section class="dashboard-content">
            
            <div class="section-group">
                <div class="section-header">
                    <h2>Appointment Management</h2>
                </div>
                <div class="features-grid">
                    <a href="myAppointments.php" class="feature-card" aria-label="Go to My Appointments">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        </div>
                        <h3>My Appointments</h3>
                        <p>View and manage your upcoming appointments with doctors</p>
                    </a>
                    <a href="calendarP.php" class="feature-card" aria-label="Go to Calendar">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line><circle cx="8" cy="14" r="1"></circle><circle cx="12" cy="14" r="1"></circle><circle cx="16" cy="14" r="1"></circle><circle cx="8" cy="18" r="1"></circle><circle cx="12" cy="18" r="1"></circle></svg>
                        </div>
                        <h3>Calendar</h3>
                        <p>View your appointment schedule and important dates</p>
                    </a>
                    <a href="search_doctor.php" class="feature-card" aria-label="Go to Find a Doctor">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>                        </div>
                        <h3>Find a Doctor</h3>
                        <p>Search for doctors by specialty, location, and availability</p>
                    </a>
                </div>
            </div>
            <div class="section-group">
                <div class="section-header">
                    <h2>My Informations</h2>
                </div>
                <div class="features-grid">
                    <a href="myRecords.php" class="feature-card" aria-label="Go to Medical Records">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                        </div>
                        <h3>Medical Records</h3>
                        <p>Access your complete medical history and test results</p>
                    </a>
                    <a href="myPrescriptions.php" class="feature-card" aria-label="Go to My Prescriptions">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                        </div>
                        <h3>My Prescriptions</h3>
                        <p>View and refill your current prescriptions</p>
                    </a>
                    <!--   <a href="myConsultations.php" class="feature-card" aria-label="Go to My Consultations">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    </div>
                    <h3>My Consultations</h3>
                    <p>Review past consultations and doctor notes</p>
                </a>-->
                </div>
            </div>
            <div class="section-group">
                <div class="section-header">
                    <h2>MedOffice AI</h2>
                </div>
                <div class="features-grid">
                    <a href="medai.php" class="feature-card" aria-label="Go to MedAI">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                                <circle cx="8" cy="10" r="1.5" fill="white"/>
                                <circle cx="12" cy="7" r="1.5" fill="white"/>
                                <circle cx="16" cy="10" r="1.5" fill="white"/>
                                <circle cx="10" cy="14" r="1.5" fill="white"/>
                                <circle cx="14" cy="14" r="1.5" fill="white"/>
                                <circle cx="12" cy="17" r="1.5" fill="white"/>
                                <line x1="8" y1="10" x2="12" y2="7" stroke="white" stroke-width="1"/>
                                <line x1="12" y1="7" x2="16" y2="10" stroke="white" stroke-width="1"/>
                                <line x1="8" y1="10" x2="10" y2="14" stroke="white" stroke-width="1"/>
                                <line x1="16" y1="10" x2="14" y2="14" stroke="white" stroke-width="1"/>
                                <line x1="10" y1="14" x2="12" y2="17" stroke="white" stroke-width="1"/>
                                <line x1="14" y1="14" x2="12" y2="17" stroke="white" stroke-width="1"/>
                            </svg>
                        </div>
                        <h3>MedAI</h3>
                        <p>AI-powered health insights and personalized medical recommendations</p>
                    </a>
                </div>
            </div>
            <div class="section-group">
                <div class="section-header">
                    <h2>Cabinet Settings</h2>
                </div>
                <div class="features-grid">
                    <a href="about_cabinet.php" class="feature-card" aria-label="Go to Cabinet Information">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    </div>
                    <h3>Cabinet Information</h3>
                    <p>View details about your medical cabinet and staff</p>
                </a>
                </div>
            </div>
        </section>
        <!-- Note : this will be removed , and th doctor will automatically send a feedback option via notification to each patient they served-->
        <a href="feedBack.php" class="feature-card" aria-label="Go to Medical Records">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                    </div>
                    <h3>Feed-back</h3>
                    <p>give feedback to your consultations</p> 
        </a>
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
