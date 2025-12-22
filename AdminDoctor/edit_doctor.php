<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor - MedOffice</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="../CSS/forms.css">
    <link rel="stylesheet" href="../CSS/editp.css">
    <link rel="stylesheet" href="../CSS/profile.css" />
    <link rel="stylesheet" href="../CSS/profile_d.css" />
    <link rel="stylesheet" href="../CSS/doctor_edit.css" />
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

    <div class="edit-wrapper">
        <div class="edit-header">
            <h1 class="edit-title">Edit Doctor Profile</h1>
            <p class="edit-subtitle">Update doctor professional information</p>
        </div>

        <form class="edit-form" id="doctorEditForm">
            <div class="form-section">
                <h2 class="form-section-title">Personal Information</h2>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="firstName" class="form-label">First Name <span class="required">*</span></label>
                        <input type="text" id="firstName" name="firstName" class="form-input" required />
                    </div>
                    <div class="form-group">
                        <label for="lastName" class="form-label">Last Name <span class="required">*</span></label>
                        <input type="text" id="lastName" name="lastName" class="form-input" required />
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email <span class="required">*</span></label>
                        <input type="email" id="email" name="email" class="form-input" required />
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">Phone Number <span class="required">*</span></label>
                        <input type="tel" id="phone" name="phone" class="form-input" required />
                    </div>
                    <div class="form-group">
                        <label for="speciality" class="form-label">Specialization <span class="required">*</span></label>
                        <input type="text" id="speciality" name="speciality" class="form-input" required />
                    </div>

                    <div class="form-group">
                        <label for="yearsExp" class="form-label">Years of Experience</label>
                        <input type="number" id="yearsExp" name="yearsExp" class="form-input" min="0" />
                    </div>
                    <div class="form-group">
                        <label for="licenseNumber" class="form-label">License Number</label>
                        <input type="text" id="licenseNumber" name="licenseNumber" class="form-input" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="bio" class="form-label">Professional Bio</label>
                    <textarea id="bio" name="bio" class="form-textarea" rows="4" placeholder="Brief professional summary..."></textarea>
                </div>
            </div>
            <div class="form-section">
                <h2 class="form-section-title">Availability</h2>
                <div class="availability-grid" id="availabilityGrid">
                    <div class="availability-day">
                        <div class="day-header">
                            <input type="checkbox" id="monday" name="days[]" value="Monday" />
                            <label for="monday">Monday</label>
                        </div>
                        <div class="time-inputs">
                            <input type="time" name="monday_start" class="time-input" />
                            <span class="time-separator">to</span>
                            <input type="time" name="monday_end" class="time-input" />
                        </div>
                    </div>

                    <div class="availability-day">
                        <div class="day-header">
                            <input type="checkbox" id="tuesday" name="days[]" value="Tuesday" />
                            <label for="tuesday">Tuesday</label>
                        </div>
                        <div class="time-inputs">
                            <input type="time" name="tuesday_start" class="time-input" />
                            <span class="time-separator">to</span>
                            <input type="time" name="tuesday_end" class="time-input" />
                        </div>
                    </div>

                    <div class="availability-day">
                        <div class="day-header">
                            <input type="checkbox" id="wednesday" name="days[]" value="Wednesday" />
                            <label for="wednesday">Wednesday</label>
                        </div>
                        <div class="time-inputs">
                            <input type="time" name="wednesday_start" class="time-input" />
                            <span class="time-separator">to</span>
                            <input type="time" name="wednesday_end" class="time-input" />
                        </div>
                    </div>

                    <div class="availability-day">
                        <div class="day-header">
                            <input type="checkbox" id="thursday" name="days[]" value="Thursday" />
                            <label for="thursday">Thursday</label>
                        </div>
                        <div class="time-inputs">
                            <input type="time" name="thursday_start" class="time-input" />
                            <span class="time-separator">to</span>
                            <input type="time" name="thursday_end" class="time-input" />
                        </div>
                    </div>

                    <div class="availability-day">
                        <div class="day-header">
                            <input type="checkbox" id="friday" name="days[]" value="Friday" />
                            <label for="friday">Friday</label>
                        </div>
                        <div class="time-inputs">
                            <input type="time" name="friday_start" class="time-input" />
                            <span class="time-separator">to</span>
                            <input type="time" name="friday_end" class="time-input" />
                        </div>
                    </div>

                    <div class="availability-day">
                        <div class="day-header">
                            <input type="checkbox" id="saturday" name="days[]" value="Saturday" />
                            <label for="saturday">Saturday</label>
                        </div>
                        <div class="time-inputs">
                            <input type="time" name="saturday_start" class="time-input" />
                            <span class="time-separator">to</span>
                            <input type="time" name="saturday_end" class="time-input" />
                        </div>
                    </div>

                    <div class="availability-day">
                        <div class="day-header">
                            <input type="checkbox" id="sunday" name="days[]" value="Sunday" />
                            <label for="sunday">Sunday</label>
                        </div>
                        <div class="time-inputs">
                            <input type="time" name="sunday_start" class="time-input" />
                            <span class="time-separator">to</span>
                            <input type="time" name="sunday_end" class="time-input" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <a href="searchD.php" class="btn btn-secondary">
                    <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 6L6 18M6 6l12 12"></path>
                    </svg>
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17 21 17 13 7 13 7 21"></polyline>
                        <polyline points="7 3 7 8 15 8"></polyline>
                    </svg>
                    Save Changes
                </button>
            </div>
        </form>
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

    <script src="../ajax/edit_doctor.js"></script>
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
