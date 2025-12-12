<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Details - MedOffice</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <style>
        .details-container {
            max-width: 1500px;
            margin: 0 auto;
            padding: 2rem 5%;
        }

        .details-header {
            margin-bottom: 3rem;
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 1.5rem;
            transition: all 0.3s;
        }

        .back-link:hover {
            gap: 1rem;
        }

        .back-link svg {
            width: 20px;
            height: 20px;
            stroke: currentColor;
        }

        .header-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: linear-gradient(135deg, #ecfeff, #cffafe);
            color: var(--primary-dark);
        }

        .details-header h1 {
            font-size: 2.5rem;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            font-weight: 800;
        }

        .details-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .details-card {
            background: var(--bg-white);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
        }

        .card-title {
            font-size: 1.25rem;
            color: var(--text-dark);
            font-weight: 700;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border);
        }

        .doctor-card {
            text-align: center;
        }

        .doctor-avatar-large {
            width: 120px;
            height: 120px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 2.5rem;
            margin: 0 auto 1.5rem;
        }

        .doctor-card h2 {
            font-size: 1.5rem;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .doctor-specialty-detail {
            color: var(--text-light);
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        .doctor-bio {
            color: var(--text-medium);
            font-size: 0.95rem;
            line-height: 1.7;
            padding: 1.5rem 0;
            border-top: 1px solid var(--border);
        }

        .contact-section {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border);
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .contact-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, #ecfeff, #cffafe);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .contact-icon svg {
            width: 20px;
            height: 20px;
            stroke: var(--primary);
            fill: none;
            stroke-width: 2;
        }

        .contact-text {
            display: flex;
            flex-direction: column;
        }

        .contact-label {
            font-size: 0.8rem;
            color: var(--text-light);
            font-weight: 600;
            text-transform: uppercase;
        }

        .contact-value {
            color: var(--text-dark);
            font-weight: 600;
        }

        .appointment-details {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .detail-item {
            display: flex;
            align-items: flex-start;
            gap: 1.25rem;
            padding: 1.25rem;
            background: var(--bg-light);
            border-radius: 12px;
            border: 1px solid var(--border);
        }

        .detail-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, #ecfeff, #cffafe);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .detail-icon svg {
            width: 24px;
            height: 24px;
            stroke: var(--primary);
            fill: none;
            stroke-width: 2;
        }

        .detail-content {
            flex: 1;
        }

        .detail-label {
            font-size: 0.8rem;
            color: var(--text-light);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .detail-value {
            font-size: 1.1rem;
            color: var(--text-dark);
            font-weight: 600;
        }

        .notes-section {
            margin-top: 1.5rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, rgba(8, 145, 178, 0.05), rgba(6, 182, 212, 0.05));
            border-radius: 12px;
            border: 1px solid rgba(8, 145, 178, 0.2);
        }

        .notes-title {
            font-size: 0.9rem;
            color: var(--text-light);
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 0.75rem;
        }

        .notes-text {
            color: var(--text-dark);
            line-height: 1.7;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-large {
            flex: 1;
            padding: 1rem 2rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .btn-reschedule {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 4px 12px rgba(8, 145, 178, 0.2);
        }

        .btn-reschedule:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(8, 145, 178, 0.3);
        }

        .btn-cancel-appt {
            background: var(--bg-light);
            color: var(--text-dark);
            border: 1.5px solid var(--border);
        }

        .btn-cancel-appt:hover {
            background: #fee2e2;
            border-color: #ef4444;
            color: #991b1b;
        }

        @media (max-width: 768px) {
            .details-layout {
                grid-template-columns: 1fr;
            }

            .details-header h1 {
                font-size: 1.75rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .back-link {
                margin-bottom: 2rem;
            }
        }
    </style>
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
            <li><a href="my-appointments.html">
                <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Appointments
            </a></li>
            <li><a href="settings.php">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06A2 2 0 1 1 6.92 4.58l.06.06c.37.37.86.54 1.34.41a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09c0 .49.19.97.54 1.34a1.65 1.65 0 0 0 1.82.33h.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82c.1.63.52 1.15 1.15 1.25z"></path></svg>
                Settings
            </a></li>
            <button class="drawer-logout" onclick="logout()">Logout</button>
        </ul>
    </div>

    <div class="drawer-overlay" id="drawerOverlay" onclick="toggleDrawer()"></div>

    <div class="details-container">
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
                <span class="header-badge">Upcoming</span>
            </div>
        </div>

        <div class="details-layout">
            <div class="details-card doctor-card">
                <div class="card-title">Healthcare Provider</div>
                <div class="doctor-avatar-large">DR</div>
                <h2>Dr. Sarah Johnson</h2>
                <p class="doctor-specialty-detail">Cardiologist</p>
                
                <p class="doctor-bio">
                    Dr. Sarah Johnson is a board-certified cardiologist with over 12 years of experience in treating heart and vascular diseases. She specializes in preventive cardiology and patient education.
                </p>

                <div class="contact-section">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </div>
                        <div class="contact-text">
                            <span class="contact-label">Phone</span>
                            <span class="contact-value">+1 (555) 123-4567</span>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M7 11l5 4 5-4"/></svg>
                        </div>
                        <div class="contact-text">
                            <span class="contact-label">Email</span>
                            <span class="contact-value">sarah.johnson@medoffice.com</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="details-card">
                <div class="card-title">Appointment Information</div>
                
                <div class="appointment-details">
                    <div class="detail-item">
                        <div class="detail-icon">
                            <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                        </div>
                        <div class="detail-content">
                            <div class="detail-label">Date</div>
                            <div class="detail-value">November 10, 2025</div>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon">
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <div class="detail-content">
                            <div class="detail-label">Time</div>
                            <div class="detail-value">10:30 AM</div>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon">
                            <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        </div>
                        <div class="detail-content">
                            <div class="detail-label">Location</div>
                            <div class="detail-value">Room 305, Cardiology Wing</div>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon">
                            <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                        </div>
                        <div class="detail-content">
                            <div class="detail-label">Duration</div>
                            <div class="detail-value">45 minutes</div>
                        </div>
                    </div>
                </div>

                <div class="notes-section">
                    <div class="notes-title">Special Instructions</div>
                    <div class="notes-text">
                        Please arrive 15 minutes early. Bring your insurance card and a list of current medications. Wear comfortable, loose-fitting clothing that allows easy access to your arms for blood pressure checks.
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="#" class="btn-large btn-reschedule">Reschedule</a>
                    <a href="cancel_appointment.php" class="btn-large btn-cancel-appt">Cancel Appointment</a>
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

        function logout() {
            window.location.href = '../index.html';
        }
    </script>
</body>
</html>
