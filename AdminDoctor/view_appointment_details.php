<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Details - MedOffice</title>
    <link rel="stylesheet" href="../CSS/view_appointment_details.css">
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
            <li><a href="myPrescriptions.php">
                <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                Consultations
            </a></li>
            <li><a href="cabinet_info.php">
                <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                Cabinet Info
            </a></li>
            <li><a href="cabinet_info.php">
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

    <div class="main-container">
        <a href="appointments.php" class="back-link">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to Appointments
        </a>

        <span class="status-badge status-current">In Progress</span>
        <div class="header-card">
            <div class="appointment-header">
                <div class="patient-info-header">
                    <div class="patient-avatar-xl">SM</div>
                    <div>
                        <h1>Sarah Mitchell</h1>
                        <p>Patient ID: #P-2847 • Age: 34</p>
                    </div>
                </div>
                <div class="appointment-time-display">
                    <div class="time">10:30 AM</div>
                    <div class="date">Thursday, January 9, 2025</div>
                    <div class="appointment-duration">30 minutes</div>
                </div>
            </div>
        </div>
        <div class="details-grid">
            <div class="detail-card">
                <div class="detail-label">Appointment Type</div>
                <div class="detail-value">Regular Checkup</div>
                <div class="detail-subtext">Routine health examination</div>
            </div>

            <div class="detail-card">
                <div class="detail-label">Location</div>
                <div class="detail-value">Room 204</div>
                <div class="detail-subtext">Building A, 2nd Floor</div>
            </div>

            <div class="detail-card">
                <div class="detail-label">Provider</div>
                <div class="detail-value">Dr. John Doe</div>
                <div class="detail-subtext">General Practitioner</div>
            </div>

            <div class="detail-card">
                <div class="detail-label">Status</div>
                <div class="detail-value" style="color: var(--accent-orange);">In Progress</div>
                <div class="detail-subtext">Started 5 minutes ago</div>
            </div>
        </div>
        <div class="section">
            <h2>Appointment Information</h2>
            
            <h3>Chief Complaint</h3>
            <p>Patient presents for routine annual physical examination and health maintenance.</p>

            <h3 style="margin-top: 1.5rem;">Medical History Relevant to Visit</h3>
            <ul style="margin-left: 1.5rem; color: var(--text-light);">
                <li>Seasonal allergies (managed with antihistamines)</li>
                <li>No chronic conditions</li>
                <li>Previous surgeries: None</li>
                <li>Current medications: Cetirizine 10mg as needed</li>
            </ul>

            <h3 style="margin-top: 1.5rem;">Vital Signs</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem; margin-top: 1rem;">
                <div style="background: var(--bg-secondary); padding: 1rem; border-radius: 8px;">
                    <div style="font-size: 0.8rem; color: var(--text-light); text-transform: uppercase; font-weight: 600; margin-bottom: 0.5rem;">Blood Pressure</div>
                    <div style="font-size: 1.25rem; font-weight: 700; color: var(--text);">120/80 mmHg</div>
                </div>
                <div style="background: var(--bg-secondary); padding: 1rem; border-radius: 8px;">
                    <div style="font-size: 0.8rem; color: var(--text-light); text-transform: uppercase; font-weight: 600; margin-bottom: 0.5rem;">Heart Rate</div>
                    <div style="font-size: 1.25rem; font-weight: 700; color: var(--text);">72 bpm</div>
                </div>
                <div style="background: var(--bg-secondary); padding: 1rem; border-radius: 8px;">
                    <div style="font-size: 0.8rem; color: var(--text-light); text-transform: uppercase; font-weight: 600; margin-bottom: 0.5rem;">Temperature</div>
                    <div style="font-size: 1.25rem; font-weight: 700; color: var(--text);">98.6°F</div>
                </div>
                <div style="background: var(--bg-secondary); padding: 1rem; border-radius: 8px;">
                    <div style="font-size: 0.8rem; color: var(--text-light); text-transform: uppercase; font-weight: 600; margin-bottom: 0.5rem;">Weight</div>
                    <div style="font-size: 1.25rem; font-weight: 700; color: var(--text);">65 kg</div>
                </div>
            </div>
        </div>
        <div class="section">
            <h2>Clinical Notes</h2>
            
            <div class="notes-box">
                <p><strong>Examination Findings:</strong> Patient appears well and in no acute distress. Physical examination reveals normal findings. Lungs clear to auscultation bilaterally. Heart regular rate and rhythm. Abdomen soft and non-tender.</p>
            </div>

            <h3>Assessment & Plan</h3>
            <p>34-year-old female presenting for routine annual physical. Patient is in good health with well-controlled seasonal allergies. Continue current allergy management. Recommend continued healthy lifestyle with regular exercise and balanced diet.</p>

            <h3 style="margin-top: 1.5rem;">Recommendations</h3>
            <div class="checklist">
                <div class="checklist-item">
                    <input type="checkbox" id="rec1" checked>
                    <label for="rec1">Continue current allergy medication as needed</label>
                </div>
                <div class="checklist-item">
                    <input type="checkbox" id="rec2" checked>
                    <label for="rec2">Maintain regular exercise routine (30 min, 5 days/week)</label>
                </div>
                <div class="checklist-item">
                    <input type="checkbox" id="rec3">
                    <label for="rec3">Schedule follow-up appointment in 12 months</label>
                </div>
                <div class="checklist-item">
                    <input type="checkbox" id="rec4">
                    <label for="rec4">Lab work: Annual physical labs (CBC, CMP, lipid panel)</label>
                </div>
            </div>
        </div>
        <div class="section">
            <h2>Prescriptions & Orders</h2>
            
            <div style="background: var(--bg-secondary); padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                <h3 style="margin-bottom: 0.5rem;">Cetirizine 10mg</h3>
                <p style="margin: 0; color: var(--text-light); font-size: 0.9rem;">
                    <strong>Dosage:</strong> 1 tablet daily as needed for allergies<br>
                    <strong>Quantity:</strong> 30 tablets<br>
                    <strong>Refills:</strong> 5<br>
                    <strong>Status:</strong> <span style="color: var(--success); font-weight: 600;">Active</span>
                </p>
            </div>
        </div>
        <div class="action-buttons">
            <button class="btn btn-secondary btn-outline">Download Summary</button>
            <button class="btn btn-secondary btn-outline">Print Details</button>
            <button class="btn btn-primary">Complete Appointment</button>
        </div>
    </div>

    <footer>
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
