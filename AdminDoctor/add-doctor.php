<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Doctor - MedOffice</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="../CSS/add_doctor.css">
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
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>ircle cx="12" cy="7" r="4"></circle></svg>
                Profile
            </a></li>
            <li><a href="searchP.php">
                <svg viewBox="0 0 24 24" width="20" height="20">ircle cx="11" cy="11" r="8"></circle><path d="m21 21-4.35-4.35"></path></svg>
                Search Patients
            </a></li>
            <li><a href="searchA.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>ircle cx="8.5" cy="7" r="4"></circle><path d="M17 11h6m-3-3v6"></path></svg>
                Search Assistant
            </a></li>
            <li><a href="calendarAD.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Calendar
            </a></li>
            <li><a href="add-patient.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>ircle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                Add Patient
            </a></li>
            <li><a href="add-assistant.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>ircle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
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
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06A2 2 0 1 1 6.92 4.58l.06.06c.37.37.86.54 1.34.41a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09c0 .49.19.97.54 1.34a1.65 1.65 0 0 0 1.82.33h.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82c.1.63.52 1.15 1.15 1.25z"/>
                </svg>
                Settings
            </a></li>
        </ul>
    </div>
    <div class="drawer-overlay" id="drawerOverlay" onclick="toggleDrawer()"></div>

    <main class="dashboard-main">
        <div id="step1" class="form-step active">
            <section class="form-hero">
                <div class="hero-badge">Doctor Registration</div>
                <h1>Add New <span class="highlight">Doctor</span></h1>
                <p>Register a new doctor and create their profile (Step 1 of 2)</p>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 50%"></div>
                </div>
            </section>

            <section class="form-container">
                <form id="form1" class="modern-form">
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
                                <label for="firstName">First Name <span class="required">*</span></label>
                                <input type="text" id="firstName" name="firstName" placeholder="Enter first name" required>
                            </div>

                            <div class="form-group">
                                <label for="lastName">Last Name <span class="required">*</span></label>
                                <input type="text" id="lastName" name="lastName" placeholder="Enter last name" required>
                            </div>

                            <div class="form-group">
                                <label for="dob">Date of Birth <span class="required">*</span></label>
                                <input type="date" id="dob" name="dob" required>
                            </div>

                            <div class="form-group">
                                <label for="gender">Gender <span class="required">*</span></label>
                                <select id="gender" name="gender" required>
                                    <option value="">Select gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>

                            <div class="form-group full-width">
                                <label for="addr">Address <span class="required">*</span></label>
                                <input type="text" id="addr" name="addr" placeholder="Enter full address" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number <span class="required">*</span></label>
                                <input type="tel" id="phone" name="phone" placeholder="(555) 123-4567" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-section">
                        <div class="form-section-header">
                            <div class="section-icon">
                                <svg viewBox="0 0 24 24" width="24" height="24">
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                </svg>
                            </div>
                            <h2>Professional Information</h2>
                        </div>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="specialty">Medical Specialty <span class="required">*</span></label>
                                <input type="text" id="specialty" name="specialty" placeholder="e.g., Cardiology" required>
                            </div>

                            <div class="form-group">
                                <label for="yearsExp">Years of Experience <span class="required">*</span></label>
                                <input type="number" id="yearsExp" name="yearsExp" placeholder="e.g., 5" min="0" max="60" required>
                            </div>

                            <div class="form-group">
                                <label for="licenseNo">Medical License Number <span class="required">*</span></label>
                                <input type="text" id="licenseNo" name="licenseNo" placeholder="e.g., LICENSE123456" required>
                            </div>

                            <div class="form-group full-width">
                                <label for="bio">Professional Bio (Optional)</label>
                                <textarea id="bio" name="bio" placeholder="Brief professional biography..." rows="4"></textarea>
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
                                <label for="username">Username <span class="required">*</span></label>
                                <input type="text" id="username" name="username" placeholder="Choose a username" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address <span class="required">*</span></label>
                                <input type="email" id="email" name="email" placeholder="doctor@example.com" required>
                            </div>

                            <div class="form-group full-width">
                                <label for="pass">Password <span class="required">*</span></label>
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
                        <button type="button" class="btn btn-secondary btn-large" onclick="resetForm()">Reset Form</button>
                        <button type="button" class="btn btn-primary btn-large" onclick="proceedToStep2()">
                            Next: Set Availability
                            <svg viewBox="0 0 24 24" width="20" height="20" style="margin-left: 8px;">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </button>
                    </div>
                </form>
            </section>
        </div>
        <div id="loadingScreen" class="loading-screen hidden">
            <div class="loading-content">
                <div class="spinner"></div>
                <h2>Processing Doctor Information</h2>
                <p>Setting up availability schedule...</p>
            </div>
        </div>
        <div id="step2" class="form-step hidden">
        <section class="form-hero">
            <div class="hero-badge">Doctor Availability</div>
            <h1>Set Doctor <span class="highlight">Availability</span></h1>
            <p>Configure working hours and time slots (Step 2 of 2)</p>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 100%"></div>
            </div>
        </section>
        <section class="form-container">
            <form id="form2" class="modern-form">
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
                        <h2>Weekly Schedule</h2>
                    </div>

                    <div class="schedule-grid">
                        <div class="day-schedule">
                            <div class="day-header">
                                <input type="checkbox" id="monday2" class="day-toggle" onchange="toggleDay(this, 'mondayTimes')">
                                <label for="monday2">Monday</label>
                            </div>
                            <div id="mondayTimes" class="day-times" style="display: none;">
                                <div class="time-slot">
                                    <input type="time" class="start-time" name="monday_start" placeholder="Start time">
                                    <span>to</span>
                                    <input type="time" class="end-time" name="monday_end" placeholder="End time">
                                </div>
                            </div>
                        </div>

                        <div class="day-schedule">
                            <div class="day-header">
                                <input type="checkbox" id="tuesday2" class="day-toggle" onchange="toggleDay(this, 'tuesdayTimes')">
                                <label for="tuesday2">Tuesday</label>
                            </div>
                            <div id="tuesdayTimes" class="day-times" style="display: none;">
                                <div class="time-slot">
                                    <input type="time" class="start-time" name="tuesday_start" placeholder="Start time">
                                    <span>to</span>
                                    <input type="time" class="end-time" name="tuesday_end" placeholder="End time">
                                </div>
                            </div>
                        </div>

                        <div class="day-schedule">
                            <div class="day-header">
                                <input type="checkbox" id="wednesday2" class="day-toggle" onchange="toggleDay(this, 'wednesdayTimes')">
                                <label for="wednesday2">Wednesday</label>
                            </div>
                            <div id="wednesdayTimes" class="day-times" style="display: none;">
                                <div class="time-slot">
                                    <input type="time" class="start-time" name="wednesday_start" placeholder="Start time">
                                    <span>to</span>
                                    <input type="time" class="end-time" name="wednesday_end" placeholder="End time">
                                </div>
                            </div>
                        </div>

                        <div class="day-schedule">
                            <div class="day-header">
                                <input type="checkbox" id="thursday2" class="day-toggle" onchange="toggleDay(this, 'thursdayTimes')">
                                <label for="thursday2">Thursday</label>
                            </div>
                            <div id="thursdayTimes" class="day-times" style="display: none;">
                                <div class="time-slot">
                                    <input type="time" class="start-time" name="thursday_start" placeholder="Start time">
                                    <span>to</span>
                                    <input type="time" class="end-time" name="thursday_end" placeholder="End time">
                                </div>
                            </div>
                        </div>

                        <div class="day-schedule">
                            <div class="day-header">
                                <input type="checkbox" id="friday2" class="day-toggle" onchange="toggleDay(this, 'fridayTimes')">
                                <label for="friday2">Friday</label>
                            </div>
                            <div id="fridayTimes" class="day-times" style="display: none;">
                                <div class="time-slot">
                                    <input type="time" class="start-time" name="friday_start" placeholder="Start time">
                                    <span>to</span>
                                    <input type="time" class="end-time" name="friday_end" placeholder="End time">
                                </div>
                            </div>
                        </div>

                        <div class="day-schedule">
                            <div class="day-header">
                                <input type="checkbox" id="saturday2" class="day-toggle" onchange="toggleDay(this, 'saturdayTimes')">
                                <label for="saturday2">Saturday</label>
                            </div>
                            <div id="saturdayTimes" class="day-times" style="display: none;">
                                <div class="time-slot">
                                    <input type="time" class="start-time" name="saturday_start" placeholder="Start time">
                                    <span>to</span>
                                    <input type="time" class="end-time" name="saturday_end" placeholder="End time">
                                </div>
                            </div>
                        </div>

                        <div class="day-schedule">
                            <div class="day-header">
                                <input type="checkbox" id="sunday2" class="day-toggle" onchange="toggleDay(this, 'sundayTimes')">
                                <label for="sunday2">Sunday</label>
                            </div>
                            <div id="sundayTimes" class="day-times" style="display: none;">
                                <div class="time-slot">
                                    <input type="time" class="start-time" name="sunday_start" placeholder="Start time">
                                    <span>to</span>
                                    <input type="time" class="end-time" name="sunday_end" placeholder="End time">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary btn-large" onclick="backToStep1()">
                        <svg viewBox="0 0 24 24" width="20" height="20" style="margin-right: 8px;">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                        Back
                    </button>
                    <button type="submit" class="btn btn-primary btn-large" onclick="submitForm(event)">
                        <svg viewBox="0 0 24 24" width="20" height="20" style="margin-right: 8px;">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        Complete Registration
                    </button>
                </div>
            </form>
        </section>
    </div>
</main>

<footer>
<div class="footer-content">
    <div class="footer-section">
        <h3>MedOffice</h3>
        <p>Professional Medical Practice Management System</p>
    </div>
    <div class="footer-section">
        <h3>Support</h3>
        <ul>
            <li><a href="#help">Help Center</a></li>
            <li><a href="#contact">Contact Support</a></li>
            <li><a href="#privacy">Privacy Policy</a></li>
        </ul>
    </div>
</div>
<div class="footer-bottom">
    <p>&copy; 2025 MedOffice. All rights reserved. HIPAA-compliant medical practice management.</p>
</div>
</footer>

<script src="../ajax/add_doctor.js"></script>
</body>
</html>