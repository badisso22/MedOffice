<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - MedOffice</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="stylesheet" href="../CSS/notifications.css">
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
                <span class="user-name">Dr.John Doe</span>
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
            <li><a href="dashboard_d.html">
                <svg viewBox="0 0 24 24" width="20" height="20"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                Dashboard
            </a></li>
            <li><a href="profileD.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Profile
            </a></li>
            <li><a href="notifications.php" class="active">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                Notifications
            </a></li>
            <li><a href="messages.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                Messages
            </a></li>
            <li><a href="settings.php">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06A2 2 0 1 1 6.92 4.58l.06.06c.37.37.86.54 1.34.41a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09c0 .49.19.97.54 1.34a1.65 1.65 0 0 0 1.82.33h.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82c.1.63.52 1.15 1.15 1.25z"/>
                </svg>
                Settings
            </a></li>
            <li style="margin-top: auto; border-top: 1px solid var(--border); padding-top: 1rem;">
                <a href="../index.html" style="color: #ef4444; background: rgba(239, 68, 68, 0.1); border-left-color: #ef4444;">
                    <svg viewBox="0 0 24 24" width="20" height="20"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    Logout
                </a>
            </li>
        </ul>
    </div>

    <div class="drawer-overlay" id="drawerOverlay" onclick="toggleDrawer()"></div>

    <main class="dashboard-main">
        <section class="dashboard-hero">
            <div class="hero-badge">Notifications</div>
            <h1>Your <span class="highlight">Notifications</span></h1>
            <p>Stay updated with appointment reminders, patient updates, and system alerts</p>
        </section>
        <div class="notification-filters">
            <button class="filter-btn active" onclick="filterNotifications('all')">All</button>
            <button class="filter-btn" onclick="filterNotifications('appointments')">Appointments</button>
            <button class="filter-btn" onclick="filterNotifications('patients')">Patients</button>
            <button class="filter-btn" onclick="filterNotifications('system')">System</button>
        </div>
        <section class="notifications-container">
            <div class="notification-item appointment-notif">
                <div class="notification-icon">
                    <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                </div>
                <div class="notification-content">
                    <h3>Appointment Reminder</h3>
                    <p>Patient John Smith has an appointment tomorrow at 10:00 AM</p>
                    <span class="notification-time">2 minutes ago</span>
                </div>
                <button class="notification-close" onclick="this.parentElement.style.display='none';">×</button>
            </div>
            <div class="notification-item patient-notif">
                <div class="notification-icon">
                    <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </div>
                <div class="notification-content">
                    <h3>Patient Record Updated</h3>
                    <p>Medical records for Sarah Johnson have been updated by assistant</p>
                    <span class="notification-time">1 hour ago</span>
                </div>
                <button class="notification-close" onclick="this.parentElement.style.display='none';">×</button>
            </div>
            <div class="notification-item system-notif">
                <div class="notification-icon">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06A2 2 0 1 1 6.92 4.58l.06.06c.37.37.86.54 1.34.41a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09c0 .49.19.97.54 1.34a1.65 1.65 0 0 0 1.82.33h.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82c.1.63.52 1.15 1.15 1.25z"/></svg>
                </div>
                <div class="notification-content">
                    <h3>System Update</h3>
                    <p>MedOffice has been updated with new security patches</p>
                    <span class="notification-time">3 hours ago</span>
                </div>
                <button class="notification-close" onclick="this.parentElement.style.display='none';">×</button>
            </div>
            <div class="notification-item appointment-notif">
                <div class="notification-icon">
                    <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                </div>
                <div class="notification-content">
                    <h3>Appointment Confirmed</h3>
                    <p>Patient Michael Brown confirmed appointment for Nov 5, 2025</p>
                    <span class="notification-time">5 hours ago</span>
                </div>
                <button class="notification-close" onclick="this.parentElement.style.display='none';">×</button>
            </div>
            <div class="notification-item patient-notif">
                <div class="notification-icon">
                    <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </div>
                <div class="notification-content">
                    <h3>Lab Results Available</h3>
                    <p>Lab results for patient Emma Wilson are now available</p>
                    <span class="notification-time">8 hours ago</span>
                </div>
                <button class="notification-close" onclick="this.parentElement.style.display='none';">×</button>
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

    <style>

    </style>

    <script>
        function toggleDrawer() {
            const drawer = document.getElementById('drawer');
            const overlay = document.getElementById('drawerOverlay');
            drawer.classList.toggle('open');
            overlay.classList.toggle('active');
        }

        function filterNotifications(type) {
            const buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            const items = document.querySelectorAll('.notification-item');
            items.forEach(item => {
                if (type === 'all') {
                    item.style.display = 'flex';
                } else {
                    const notifClass = item.className;
                    if (type === 'appointments' && notifClass.includes('appointment')) {
                        item.style.display = 'flex';
                    } else if (type === 'patients' && notifClass.includes('patient')) {
                        item.style.display = 'flex';
                    } else if (type === 'system' && notifClass.includes('system')) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                }
            });
        }
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - MedOffice</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="stylesheet" href="../CSS/notifications.css">
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
                <span class="user-name">Dr.John Doe</span>
                <div class="top-icons">
                    <a href="assistant_messages.php" class="icon-btn" title="Chat">
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
            <li><a href="dashboard_d.html">
                <svg viewBox="0 0 24 24" width="20" height="20"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                Dashboard
            </a></li>
            <li><a href="profileD.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Profile
            </a></li>
            <li><a href="notifications.php" class="active">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                Notifications
            </a></li>
            <li><a href="messages.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                Messages
            </a></li>
            <li><a href="settings.php">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06A2 2 0 1 1 6.92 4.58l.06.06c.37.37.86.54 1.34.41a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09c0 .49.19.97.54 1.34a1.65 1.65 0 0 0 1.82.33h.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82c.1.63.52 1.15 1.15 1.25z"/>
                </svg>
                Settings
            </a></li>
            <li style="margin-top: auto; border-top: 1px solid var(--border); padding-top: 1rem;">
                <a href="../index.html" style="color: #ef4444; background: rgba(239, 68, 68, 0.1); border-left-color: #ef4444;">
                    <svg viewBox="0 0 24 24" width="20" height="20"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    Logout
                </a>
            </li>
        </ul>
    </div>

    <div class="drawer-overlay" id="drawerOverlay" onclick="toggleDrawer()"></div>

    <main class="dashboard-main">
        <section class="dashboard-hero">
            <div class="hero-badge">Notifications</div>
            <h1>Your <span class="highlight">Notifications</span></h1>
            <p>Stay updated with appointment reminders, patient updates, and system alerts</p>
        </section>
        <div class="notification-filters">
            <button class="filter-btn active" onclick="filterNotifications('all')">All</button>
            <button class="filter-btn" onclick="filterNotifications('appointments')">Appointments</button>
            <button class="filter-btn" onclick="filterNotifications('patients')">Patients</button>
            <button class="filter-btn" onclick="filterNotifications('system')">System</button>
        </div>
        <section class="notifications-container">
            <div class="notification-item appointment-notif">
                <div class="notification-icon">
                    <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                </div>
                <div class="notification-content">
                    <h3>Appointment Reminder</h3>
                    <p>Patient John Smith has an appointment tomorrow at 10:00 AM</p>
                    <span class="notification-time">2 minutes ago</span>
                </div>
                <button class="notification-close" onclick="this.parentElement.style.display='none';">×</button>
            </div>
            <div class="notification-item patient-notif">
                <div class="notification-icon">
                    <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </div>
                <div class="notification-content">
                    <h3>Patient Record Updated</h3>
                    <p>Medical records for Sarah Johnson have been updated by assistant</p>
                    <span class="notification-time">1 hour ago</span>
                </div>
                <button class="notification-close" onclick="this.parentElement.style.display='none';">×</button>
            </div>
            <div class="notification-item system-notif">
                <div class="notification-icon">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06A2 2 0 1 1 6.92 4.58l.06.06c.37.37.86.54 1.34.41a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09c0 .49.19.97.54 1.34a1.65 1.65 0 0 0 1.82.33h.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82c.1.63.52 1.15 1.15 1.25z"/></svg>
                </div>
                <div class="notification-content">
                    <h3>System Update</h3>
                    <p>MedOffice has been updated with new security patches</p>
                    <span class="notification-time">3 hours ago</span>
                </div>
                <button class="notification-close" onclick="this.parentElement.style.display='none';">×</button>
            </div>
            <div class="notification-item appointment-notif">
                <div class="notification-icon">
                    <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                </div>
                <div class="notification-content">
                    <h3>Appointment Confirmed</h3>
                    <p>Patient Michael Brown confirmed appointment for Nov 5, 2025</p>
                    <span class="notification-time">5 hours ago</span>
                </div>
                <button class="notification-close" onclick="this.parentElement.style.display='none';">×</button>
            </div>
            <div class="notification-item patient-notif">
                <div class="notification-icon">
                    <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </div>
                <div class="notification-content">
                    <h3>Lab Results Available</h3>
                    <p>Lab results for patient Emma Wilson are now available</p>
                    <span class="notification-time">8 hours ago</span>
                </div>
                <button class="notification-close" onclick="this.parentElement.style.display='none';">×</button>
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

    <style>

    </style>

    <script>
        function toggleDrawer() {
            const drawer = document.getElementById('drawer');
            const overlay = document.getElementById('drawerOverlay');
            drawer.classList.toggle('open');
            overlay.classList.toggle('active');
        }

        function filterNotifications(type) {
            const buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            const items = document.querySelectorAll('.notification-item');
            items.forEach(item => {
                if (type === 'all') {
                    item.style.display = 'flex';
                } else {
                    const notifClass = item.className;
                    if (type === 'appointments' && notifClass.includes('appointment')) {
                        item.style.display = 'flex';
                    } else if (type === 'patients' && notifClass.includes('patient')) {
                        item.style.display = 'flex';
                    } else if (type === 'system' && notifClass.includes('system')) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                }
            });
        }
    </script>
</body>
</html>
