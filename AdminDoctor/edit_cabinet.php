<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Cabinet Information - Admin</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="stylesheet" href="../CSS/edit_cabinet.css">
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
            <li><a href="dashboard_ad.php">
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

    <div class="edit-cabinet-container">
        <header class="edit-header">
            <div class="edit-header-content">
                <h1>Edit Cabinet Information</h1>
                <p>Update your cabinet's essential details and settings</p>
            </div>
        </header>

        <div class="edit-main-content">
            <div class="form-wrapper">
                <form class="edit-form" onsubmit="handleSubmit(event)">
                    <div class="form-section">
                        <div class="section-title">
                            <h2>Basic Information</h2>
                            <p>Update your cabinet's name and operational status</p>
                        </div>
                        <div class="form-group">
                            <label for="cabinet-name" class="form-label">
                                Cabinet Name
                                <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="cabinet-name" 
                                name="cabinet-name" 
                                class="form-input"
                                placeholder="e.g., MedCare Clinic"
                                required
                            >
                            <p class="form-hint">The official name of your medical cabinet</p>
                        </div>

                        <div class="form-group">
                            <label for="status" class="form-label">
                                Operational Status
                                <span class="required">*</span>
                            </label>
                            <select id="status" name="status" class="form-input" required>
                                <option value="">Select Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="maintenance">Maintenance</option>
                            </select>
                            <p class="form-hint">Current operational status of your cabinet</p>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="section-title">
                            <h2>Contact Information</h2>
                            <p>Manage your cabinet's contact details</p>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">
                                Email Address
                                <span class="required">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                class="form-input"
                                placeholder="cabinet@medoffice.com"
                                required
                            >
                            <p class="form-hint">Primary contact email for your cabinet</p>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">
                                Phone Number
                                <span class="required">*</span>
                            </label>
                            <input 
                                type="tel" 
                                id="phone" 
                                name="phone" 
                                class="form-input"
                                placeholder="+1 (555) 123-4567"
                                required
                            >
                            <p class="form-hint">Primary phone number for patient inquiries</p>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="section-title">
                            <h2>Location</h2>
                            <p>Update your cabinet's physical address</p>
                        </div>
                        <div class="form-group">
                            <label for="location" class="form-label">
                                Street Address
                                <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="location" 
                                name="location" 
                                class="form-input"
                                placeholder="123 Medical Street, Healthcare District"
                                required
                            >
                            <p class="form-hint">Full street address of your cabinet facility</p>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="section-title">
                            <h2>Working Hours</h2>
                            <p>Define your cabinet's operational hours</p>
                        </div>
                        <div class="form-group">
                            <label for="working-hours" class="form-label">
                                Working Hours
                                <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="working-hours" 
                                name="working-hours" 
                                class="form-input"
                                placeholder="Mon-Fri: 9:00 AM - 6:00 PM, Sat: 10:00 AM - 2:00 PM"
                                required
                            >
                            <p class="form-hint">Specify your working schedule (e.g., Mon-Fri: 9:00 AM - 6:00 PM)</p>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <svg viewBox="0 0 24 24" width="18" height="18">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                            Save Changes
                        </button>
                        <a href="about-cabinet.php" class="btn btn-secondary">
                            <svg viewBox="0 0 24 24" width="18" height="18">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                            Cancel
                        </a>
                    </div>
                </form>
            </div>

            <div class="info-box">
                <div class="info-box-header">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                    <h3>Important Notes</h3>
                </div>
                <ul class="info-box-list">
                    <li>All fields marked with <span class="required">*</span> are required</li>
                    <li>Changes will be saved immediately upon submission</li>
                    <li>Email notifications will be sent to registered admins</li>
                    <li>Cabinet status changes may affect patient appointments</li>
                    <li>Ensure working hours are in a clear, readable format</li>
                </ul>
            </div>
        </div>
    </div>

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

    <script>
        function toggleDrawer() {
            const drawer = document.getElementById('drawer');
            drawer.classList.toggle('open');
        }
    </script>
</body>
</html>
