<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Appointment - MedOffice</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <style>
        .cancel-container {
            max-width: 1500px;
            margin: 0 auto;
            padding: 2rem 5%;
        }

        .cancel-header {
            margin-bottom: 2rem;
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

        .cancel-header h1 {
            font-size: 2rem;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            font-weight: 800;
        }

        .cancel-header p {
            color: var(--text-light);
            font-size: 1rem;
        }

        .warning-box {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            border: 2px solid #fca5a5;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            gap: 1rem;
            align-items: flex-start;
        }

        .warning-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: rgba(239, 68, 68, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .warning-icon svg {
            width: 24px;
            height: 24px;
            stroke: #991b1b;
            fill: none;
            stroke-width: 2;
        }

        .warning-text {
            color: #991b1b;
            line-height: 1.6;
        }

        .warning-text strong {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .appointment-summary {
            background: var(--bg-white);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            margin-bottom: 2rem;
        }

        .summary-title {
            font-size: 0.9rem;
            color: var(--text-light);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 1rem;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border);
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .summary-label {
            color: var(--text-light);
            font-weight: 500;
        }

        .summary-value {
            color: var(--text-dark);
            font-weight: 600;
        }

        .form-card {
            background: var(--bg-white);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
        }

        .form-title {
            font-size: 1.15rem;
            color: var(--text-dark);
            font-weight: 700;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group:last-of-type {
            margin-bottom: 2rem;
        }

        .form-label {
            display: block;
            font-size: 0.95rem;
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .form-label .required {
            color: #ef4444;
        }

        .reason-options {
            display: grid;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border: 2px solid var(--border);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .radio-option:hover {
            border-color: var(--primary);
            background: rgba(8, 145, 178, 0.05);
        }

        .radio-option input[type="radio"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: var(--primary);
        }

        .radio-label {
            flex: 1;
            cursor: pointer;
            color: var(--text-dark);
            font-weight: 500;
        }

        .reason-description {
            font-size: 0.85rem;
            color: var(--text-light);
        }

        textarea {
            width: 100%;
            padding: 1rem;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-family: inherit;
            font-size: 0.95rem;
            color: var(--text-dark);
            resize: vertical;
            min-height: 150px;
            transition: all 0.3s;
        }

        textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(8, 145, 178, 0.1);
        }

        textarea::placeholder {
            color: var(--text-light);
        }

        .char-count {
            display: block;
            font-size: 0.85rem;
            color: var(--text-light);
            margin-top: 0.5rem;
            text-align: right;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-submit {
            flex: 1;
            padding: 1rem;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(239, 68, 68, 0.3);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-keep {
            flex: 1;
            padding: 1rem;
            background: var(--bg-light);
            color: var(--text-dark);
            border: 2px solid var(--border);
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-keep:hover {
            border-color: var(--primary);
            background: rgba(8, 145, 178, 0.05);
            color: var(--primary);
        }

        .confirmation-message {
            display: none;
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
            border: 2px solid #86efac;
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 2rem;
            text-align: center;
            color: #166534;
        }

        .confirmation-message svg {
            width: 40px;
            height: 40px;
            margin: 0 auto 1rem;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
        }

        .confirmation-message h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        @media (max-width: 768px) {
            .cancel-header h1 {
                font-size: 1.5rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .form-card {
                padding: 1.5rem;
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
            <li><a href="my-appointments.html" class="active">
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

    <div class="cancel-container">
        <a href="myAppointments.php" class="back-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to Appointments
        </a>

        <div class="cancel-header">
            <h1>Cancel Appointment</h1>
            <p>Please let us know why you're cancelling this appointment</p>
        </div>
        <div class="warning-box">
            <div class="warning-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3.05h16.94a2 2 0 0 0 1.71-3.05L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                    <line x1="12" y1="9" x2="12" y2="13"></line>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
            </div>
            <div class="warning-text">
                <strong>Important Notice</strong>
                Cancelling this appointment may affect your treatment plan. Your doctor may not be able to reschedule immediately. Please consider rescheduling instead if possible.
            </div>
        </div>
        <div class="appointment-summary">
            <div class="summary-title">Appointment to Cancel</div>
            <div class="summary-item">
                <span class="summary-label">Doctor</span>
                <span class="summary-value">Dr. Sarah Johnson</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Specialty</span>
                <span class="summary-value">Cardiologist</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Date & Time</span>
                <span class="summary-value">Nov 10, 2025 at 10:30 AM</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Location</span>
                <span class="summary-value">Room 305, Cardiology Wing</span>
            </div>
        </div>
        <form class="form-card" onsubmit="handleSubmit(event)">
            <div class="form-title">Cancellation Reason</div>
            <div class="form-group">
                <label class="form-label">Select a reason <span class="required">*</span></label>
                <div class="reason-options">
                    <div class="radio-option">
                        <input type="radio" id="reason1" name="reason" value="scheduling" required>
                        <label for="reason1" class="radio-label">
                            <div>Scheduling Conflict</div>
                            <div class="reason-description">I have a conflict with my schedule</div>
                        </label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="reason2" name="reason" value="illness">
                        <label for="reason2" class="radio-label">
                            <div>Currently Ill or Unwell</div>
                            <div class="reason-description">I'm not feeling well to attend</div>
                        </label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="reason3" name="reason" value="transportation">
                        <label for="reason3" class="radio-label">
                            <div>Transportation Issue</div>
                            <div class="reason-description">I cannot get to the appointment</div>
                        </label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="reason4" name="reason" value="other">
                        <label for="reason4" class="radio-label">
                            <div>Other Reason</div>
                            <div class="reason-description">Please specify in the comments below</div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="comments" class="form-label">Additional Comments</label>
                <textarea 
                    id="comments" 
                    name="comments" 
                    placeholder="Please provide any additional information about your cancellation. This helps us better understand your needs and improve our service. (Optional)"
                    onkeyup="updateCharCount(this)"
                ></textarea>
                <span class="char-count"><span id="charCount">0</span>/500</span>
            </div>
            <div class="action-buttons">
                <button type="button" class="btn-keep" onclick="goBack()">Keep Appointment</button>
                <button type="submit" class="btn-submit">Confirm Cancellation</button>
            </div>
            <div class="confirmation-message" id="confirmationMessage">
                <svg viewBox="0 0 24 24">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <h3>Appointment Cancelled</h3>
                <p>Your appointment has been successfully cancelled. We've sent a confirmation email to your registered email address.</p>
                <p style="margin-top: 1rem; font-size: 0.9rem;">Redirecting to appointments in 3 seconds...</p>
            </div>
        </form>
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

        function goBack() {
            window.location.href = 'myAppointments.php';
        }

        function updateCharCount(textarea) {
            const charCount = textarea.value.length;
            document.getElementById('charCount').textContent = Math.min(charCount, 500);
                        if (charCount > 500) {
                textarea.value = textarea.value.substring(0, 500);
            }
        }

        function handleSubmit(event) {
            event.preventDefault();
                        const reason = document.querySelector('input[name="reason"]:checked').value;
            const comments = document.getElementById('comments').value;
                        document.querySelector('form').style.display = 'none';
            document.getElementById('confirmationMessage').style.display = 'block';
                setTimeout(() => {
                window.location.href = 'myAppointments.php';
            }, 3000);
        }
    </script>
</body>
</html>
