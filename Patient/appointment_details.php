<?php
session_start();
if (empty($_SESSION['loggedIn']) || !isset($_SESSION['userID']) || $_SESSION['roleID'] != 5) {
    header('Location: ../login-forms/login.php');
    exit;
}

$appointmentID = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($appointmentID <= 0) {
    header('Location: myAppointments.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Details - MedOffice</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="../CSS/appointment_details.css">
</head>
<body>
    <nav>
        <div class="nav-container">
            <button class="drawer-toggle" onclick="toggleDrawer()">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <a href="dashboard_p.php" class="logo">
                <div class="logo-icon">⚕</div>
                MedOffice
            </a>
            <div class="nav-cta">
                <span class="user-name">Appointment Details</span>
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
    <div class="details-container" data-appointment-id="<?php echo $appointmentID; ?>">
        <a href="myAppointments.php" class="back-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to Appointments
        </a>

        <div class="details-header">
            <div>
                <h1>Appointment Details</h1>
                <span class="header-badge" id="appointmentStatusBadge">Upcoming</span>
            </div>
        </div>

        <div class="details-layout">
            <div class="details-card doctor-card">
                <div class="card-title">Healthcare Provider</div>
                <div class="doctor-avatar-large" id="doctorAvatarLarge">DR</div>
                <h2 id="doctorName">Doctor</h2>
                <p class="doctor-specialty-detail" id="doctorSpecialty"></p>

                <p class="doctor-bio" id="doctorBio">
                </p>

                <div class="contact-section">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <span class="contact-label">Phone</span>
                            <span class="contact-value" id="doctorPhone">—</span>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg viewBox="0 0 24 24">
                                <rect x="2" y="4" width="20" height="16" rx="2"/>
                                <path d="M7 11l5 4 5-4"/>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <span class="contact-label">Email</span>
                            <span class="contact-value" id="doctorEmail">—</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="details-card">
                <div class="card-title">Appointment Information</div>

                <div class="appointment-details">
                    <div class="detail-item">
                        <div class="detail-icon">
                            <svg viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="18" rx="2"/>
                                <path d="M16 2v4M8 2v4M3 10h18"/>
                            </svg>
                        </div>
                        <div class="detail-content">
                            <div class="detail-label">Date</div>
                            <div class="detail-value" id="appointmentDate"></div>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                        </div>
                        <div class="detail-content">
                            <div class="detail-label">Time</div>
                            <div class="detail-value" id="appointmentTime"></div>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                <polyline points="9 22 9 12 15 12 15 22"/>
                            </svg>
                        </div>
                        <div class="detail-content">
                            <div class="detail-label">Location</div>
                            <div class="detail-value" id="appointmentLocation">Cabinet</div>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                            </svg>
                        </div>
                        <div class="detail-content">
                            <div class="detail-label">Purpose</div>
                            <div class="detail-value" id="appointmentPurpose"></div>
                        </div>
                    </div>
                </div>

                <div class="notes-section">
                    <div class="notes-title">Special Instructions</div>
                    <div class="notes-text" id="appointmentNotes">
                        —
                    </div>
                </div>

                <div class="action-buttons" id="appointmentActions">
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
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 MedOffice. All rights reserved.</p>
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
    <script src="../ajax/appointment_details.js"></script>
</body>
</html>
