<?php
session_start();
require '../config/config.php';

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true || $_SESSION['roleID'] != 2) {
    header("Location: ../login-forms/login.php");
    exit();
}
$userID = $_SESSION['userID'];
$userEmail = $_SESSION['email'];
$profileQuery = $conn->prepare(
    "SELECT u.username, up.firstName, up.lastName, up.dateOfBirth, up.gender, up.address, up.phoneNumber 
     FROM Users u 
     LEFT JOIN UserProfile up ON u.userID = up.userID 
     WHERE u.userID = ?"
);
$profileQuery->bind_param("i", $userID);
$profileQuery->execute();
$profileResult = $profileQuery->get_result();
$userProfile = $profileResult->fetch_assoc();
$fullname= trim($userProfile['lastName'] . ' ' . $userProfile['firstName']);
$profileQuery->close();

$firstName = $userProfile['firstName'] ?? 'Patient';
$lastName = $userProfile['lastName'] ?? '';
$fullName = trim("$firstName $lastName");
$messagesQuery = $conn->prepare(
    "SELECT COUNT(*) as unread FROM Messages WHERE recipientID = ? AND isRead = 0"
);
$messagesQuery->bind_param("i", $userID);
$messagesQuery->execute();
$messagesResult = $messagesQuery->get_result();
$messagesRow = $messagesResult->fetch_assoc();
$unreadMessages = $messagesRow['unread'] ?? 0;
$messagesQuery->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard - MedOffice</title>
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
                <span class="user-name">Dr. <?= htmlspecialchars($fullname ?? 'User') ?></span>
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
    </div>

    <div class="drawer-overlay" id="drawerOverlay" onclick="toggleDrawer()"></div>

    <main class="dashboard-main">
        <section class="dashboard-hero">
            <div class="hero-badge">Doctor Portal</div>
            <h1>Welcome back, <span class="highlight">Dr.<?= htmlspecialchars($fullname ?? 'User') ?></span></h1>
            <p>Manage your patients, appointments, and medical records from your personalized dashboard</p>
        </section>
        <section class="dashboard-content">
            
            <div class="section-group">
                <div class="section-header">
                    <h2>Patient Management</h2>
                </div>
                <div class="features-grid">
                    <a href="searchP.php" class="feature-card dashboard-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.35-4.35"></path></svg>
                        </div>
                        <h3>Search Patients</h3>
                        <p>Find patient records quickly by name, ID, or medical history</p>
                    </a>

                    <a href="add-patient.php" class="feature-card dashboard-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                        </div>
                        <h3>Add New Patient</h3>
                        <p>Register new patients and create their medical profiles</p>
                    </a>

                    <a href="archive_patient.php" class="feature-card dashboard-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24">
                                <rect x="2" y="3" width="20" height="5" rx="2"></rect>
                                <path d="M4 8v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8"></path>
                                <path d="M10 12h4"></path>
                            </svg>
                        </div>
                        <h3>Patient Archive</h3>
                        <p>Access archived patient records and historical data</p>
                    </a>
                </div>
            </div>
            <div class="section-group">
                <div class="section-header">
                    <h2>Assistant Management</h2>
                </div>
                <div class="features-grid">
                    <a href="searchA.php" class="feature-card dashboard-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><path d="M17 11h6m-3-3v6"></path></svg>
                        </div>
                        <h3>Search Assistant</h3>
                        <p>Find assistant records quickly by name, ID, or credentials</p>
                    </a>

                    <a href="add-assistant.php" class="feature-card dashboard-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M20 7h-4V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
                                <path d="M10 5h4v2h-4V5z"></path>
                                <circle cx="12" cy="13" r="2"></circle>
                                <path d="M16 17a4 4 0 0 0-8 0"></path>
                            </svg>
                        </div>
                        <h3>Add New Assistant</h3>
                        <p>Register new assistants into the cabinet</p>
                    </a>
                    
                    <a href="archive_assistant.php" class="feature-card dashboard-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24">
                                <rect x="2" y="3" width="20" height="5" rx="2"></rect>
                                <path d="M4 8v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8"></path>
                                <path d="M10 12h4"></path>
                            </svg>
                        </div>
                        <h3>Assistant Archive</h3>
                        <p>View archived assistant records and past staff information</p>
                    </a>
                </div>
            </div>
            <div class="section-group">
                <div class="section-header">
                    <h2>Doctor Management</h2>
                </div>
                <div class="features-grid">
                    <a href="searchD.php" class="feature-card dashboard-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.35-4.35"></path></svg>
                        </div>
                        <h3>Search Doctors</h3>
                        <p>Find doctors quickly by name or ID</p>
                    </a>

                    <a href="add-doctor.php" class="feature-card dashboard-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                        </div>
                        <h3>Add New Doctor</h3>
                        <p>Register new doctors and create their profiles</p>
                    </a>

                    <a href="archive_doctor.php" class="feature-card dashboard-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24">
                                <rect x="2" y="3" width="20" height="5" rx="2"></rect>
                                <path d="M4 8v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8"></path>
                                <path d="M10 12h4"></path>
                            </svg>
                        </div>
                        <h3>Doctor Archive</h3>
                        <p>Access archived doctors historical data</p>
                    </a>
                </div>
            </div>
            <div class="section-group">
                <div class="section-header">
                    <h2>Scheduling & Appointments</h2>
                </div>
                <div class="features-grid">
                    <a href="calendarAD.php" class="feature-card dashboard-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                <circle cx="8" cy="14" r="1"></circle>
                                <circle cx="12" cy="14" r="1"></circle>
                                <circle cx="16" cy="14" r="1"></circle>
                                <circle cx="8" cy="18" r="1"></circle>
                                <circle cx="12" cy="18" r="1"></circle>
                            </svg>
                        </div>
                        <h3>Calendar</h3>
                        <p>View and manage your daily schedule and appointments</p>
                    </a>

                    <a href="appointments.php" class="feature-card dashboard-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        </div>
                        <h3>Appointments</h3>
                        <p>View and manage your appointment schedule</p>
                    </a>
                </div>
            </div>
         <!--   <div class="section-group">
                <div class="section-header">
                    <h2>Medical Information</h2>
                </div>
                <div class="features-grid">
                    <a href="medical_records.php" class="feature-card dashboard-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                        </div>
                        <h3>Medical Records</h3>
                        <p>Access and update patient medical histories</p>
                    </a>

                    <a href="prescriptions.php" class="feature-card dashboard-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                        </div>
                        <h3>Prescriptions</h3>
                        <p>Create and manage patient prescriptions</p>
                    </a>
                </div>
            </div> -->
            <div class="section-group">
                <div class="section-header">
                    <h2>Analytics & Reporting</h2>
                </div>
                <div class="features-grid">
                    <a href="report_analytics.php" class="feature-card dashboard-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                        </div>
                        <h3>Reports & Analytics</h3>
                        <p>View practice statistics and generate reports</p>
                    </a>
                </div>
            </div>
            <div class="section-group">
                <div class="section-header">
                    <h2>Cabinet Settings</h2>
                </div>
                <div class="features-grid">
                    <a href="about-cabinet.php" class="feature-card dashboard-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                <line x1="9" y1="6" x2="9" y2="6.01"></line>
                                <line x1="15" y1="6" x2="15" y2="6.01"></line>
                                <line x1="12" y1="6" x2="12" y2="6.01"></line>
                            </svg>
                        </div>
                        <h3>About Cabinet</h3>
                        <p>View and manage your medical cabinet information</p>
                    </a>
                    <a href="cabinet_profile.php" class="feature-card dashboard-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <h3>Cabinet Profile</h3>
                        <p>Manage your cabinet profile and settings</p>
                    </a>
                </div>
            </div>
        </section>

        <section class="trust-section dashboard-stats">
            <p>Your Practice Overview</p>
            <div class="trust-stats">
                <div class="stat">
                    <span class="stat-number">24</span>
                    <span class="stat-label">Appointments Today</span>
                </div>
                <div class="stat">
                    <span class="stat-number">156</span>
                    <span class="stat-label">Active Patients</span>
                </div>
                <div class="stat">
                    <span class="stat-number">8</span>
                    <span class="stat-label">Pending Records</span>
                </div>
            </div>
        </section>
    </main>
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
