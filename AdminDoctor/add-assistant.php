<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Assistant - MedOffice</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="stylesheet" href="../CSS/forms.css">
    <link rel="stylesheet" href="../CSS/form_validation.css">
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
            <svg viewBox="0 0 24 24" width="20" height="20"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><path d="M20 8h6m-3-3v6"></path></svg>
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
        <li><a href="reports_analytics.php">
            <svg viewBox="0 0 24 24" width="20" height="20"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
            Reports
        </a></li>
        <li><a href="settings.php">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="3"></circle>
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33h.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82c.1.63.52 1.15 1.15 1.25z"/>
            </svg>
            Settings
        </a></li>
    </ul>
</div>
<div class="drawer-overlay" id="drawerOverlay" onclick="toggleDrawer()"></div>

<main class="dashboard-main">
    <section class="form-hero">
        <div class="hero-badge">Staff Registration</div>
        <h1>Add New <span class="highlight">Assistant</span></h1>
        <p>Register a new medical assistant and create their staff profile</p>
    </section>

    <section class="form-container">
        <form id="assistantForm" class="modern-form">
            <div class="form-section">
                <div class="form-section-header">
                    <div class="section-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <h2>Personal Information</h2>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="employeeId">Employee ID</label>
                        <input type="text" id="employeeId" name="employeeId" placeholder="e.g., EMP001" required>
                    </div>
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" placeholder="Enter first name" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName" placeholder="Enter last name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="assistant@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="555-123-4567" required>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-header">
                    <div class="section-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                        </svg>
                    </div>
                    <h2>Professional Information</h2>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="experience">Years of Experience</label>
                        <input type="number" id="experience" name="experience" min="0" placeholder="e.g., 5" required>
                    </div>
                    <div class="form-group full-width">
                        <label for="skills">Specialties & Skills</label>
                        <textarea id="skills" name="skills" rows="3" placeholder="Enter skills separated by commas (e.g., Patient Care, Medical Records, Phlebotomy)"></textarea>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-header">
                    <div class="section-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <h2>Weekly Availability</h2>
                </div>
                <div class="availability-grid">
                    <div class="availability-row">
                        <label class="day-checkbox">
                            <input type="checkbox" name="monday" id="monday">
                            <span>Monday</span>
                        </label>
                        <input type="time" name="monday_start" placeholder="Start">
                        <span class="time-separator">to</span>
                        <input type="time" name="monday_end" placeholder="End">
                    </div>
                    <div class="availability-row">
                        <label class="day-checkbox">
                            <input type="checkbox" name="tuesday" id="tuesday">
                            <span>Tuesday</span>
                        </label>
                        <input type="time" name="tuesday_start" placeholder="Start">
                        <span class="time-separator">to</span>
                        <input type="time" name="tuesday_end" placeholder="End">
                    </div>
                    <div class="availability-row">
                        <label class="day-checkbox">
                            <input type="checkbox" name="wednesday" id="wednesday">
                            <span>Wednesday</span>
                        </label>
                        <input type="time" name="wednesday_start" placeholder="Start">
                        <span class="time-separator">to</span>
                        <input type="time" name="wednesday_end" placeholder="End">
                    </div>
                    <div class="availability-row">
                        <label class="day-checkbox">
                            <input type="checkbox" name="thursday" id="thursday">
                            <span>Thursday</span>
                        </label>
                        <input type="time" name="thursday_start" placeholder="Start">
                        <span class="time-separator">to</span>
                        <input type="time" name="thursday_end" placeholder="End">
                    </div>
                    <div class="availability-row">
                        <label class="day-checkbox">
                            <input type="checkbox" name="friday" id="friday">
                            <span>Friday</span>
                        </label>
                        <input type="time" name="friday_start" placeholder="Start">
                        <span class="time-separator">to</span>
                        <input type="time" name="friday_end" placeholder="End">
                    </div>
                    <div class="availability-row">
                        <label class="day-checkbox">
                            <input type="checkbox" name="saturday" id="saturday">
                            <span>Saturday</span>
                        </label>
                        <input type="time" name="saturday_start" placeholder="Start">
                        <span class="time-separator">to</span>
                        <input type="time" name="saturday_end" placeholder="End">
                    </div>
                    <div class="availability-row">
                        <label class="day-checkbox">
                            <input type="checkbox" name="sunday" id="sunday">
                            <span>Sunday</span>
                        </label>
                        <input type="time" name="sunday_start" placeholder="Start">
                        <span class="time-separator">to</span>
                        <input type="time" name="sunday_end" placeholder="End">
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-header">
                    <div class="section-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </div>
                    <h2>Login Credentials</h2>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Choose a username" required>
                    </div>
                    <div class="form-group full-width">
                        <label for="pass">Password</label>
                        <div class="password-input">
                            <input type="password" id="pass" name="pass" placeholder="Create a secure password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <svg viewBox="0 0 24 24" width="20" height="20">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary btn-large" id="submitBtn">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    Add Assistant
                </button>
                <button type="reset" class="btn btn-secondary btn-large">Reset Form</button>
                <a href="dashboard_ad.php" class="btn btn-white btn-large">Cancel</a>
            </div>
        </form>
    </section>
</main>
<div id="successModal" class="success-modal">
    <div class="success-modal-content">
        <div class="success-icon">
            <svg viewBox="0 0 24 24" width="60" height="60">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
        </div>
        <h2 id="modalTitle">Assistant Successfully Added</h2>
        <p id="modalMessage"></p>
        <button onclick="closeSuccessModal()" style="margin-top: 20px; padding: 10px 30px; background: #17a2b8; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold;">
            Continue
        </button>
    </div>
</div>

<footer>
    <div class="footer-content">
        <div class="footer-section">
            <h3>MedOffice</h3>
            <p>Professional medical practice management</p>
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

<script src="../JS/form_validation.js"></script>
<script src="../ajax/add-assistant.js"></script>
</body>
</html>
