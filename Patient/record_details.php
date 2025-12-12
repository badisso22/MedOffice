<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Details - MedOffice</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <style>
        .detail-container {
            min-height: 100vh;
            background: var(--bg-light);
            padding: 2rem 1rem;
        }

        .detail-wrapper {
            max-width: 900px;
            margin: 0 auto;
        }

        .back-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            margin-bottom: 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            gap: 1rem;
        }

        .back-button svg {
            width: 20px;
            height: 20px;
            stroke: currentColor;
        }

        .detail-header {
            background: var(--bg-white);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid var(--border);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .record-status-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-transform: uppercase;
            background: #dcfce7;
            color: #166534;
        }

        .detail-title {
            font-size: 2rem;
            color: var(--text-dark);
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .detail-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .info-item {
            padding: 1rem;
            background: var(--bg-light);
            border-radius: 8px;
            border: 1px solid var(--border);
        }

        .info-label {
            font-size: 0.85rem;
            color: var(--text-light);
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 0.5rem;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 1.1rem;
            color: var(--text-dark);
            font-weight: 600;
        }

        .detail-section {
            background: var(--bg-white);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid var(--border);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            font-size: 1.3rem;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-title svg {
            width: 24px;
            height: 24px;
            stroke: var(--primary);
        }

        .content-text {
            color: var(--text-dark);
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .findings-list {
            list-style: none;
            padding: 0;
        }

        .findings-list li {
            padding: 0.75rem 0;
            padding-left: 1.5rem;
            color: var(--text-dark);
            position: relative;
        }

        .findings-list li:before {
            content: "•";
            position: absolute;
            left: 0;
            color: var(--primary);
            font-weight: bold;
        }

        .recommendations {
            background: linear-gradient(135deg, #ecfeff 0%, #cffafe 100%);
            padding: 1.5rem;
            border-radius: 12px;
            border-left: 4px solid var(--primary);
            margin-top: 1.5rem;
        }

        .recommendations h4 {
            color: var(--text-dark);
            margin: 0 0 0.75rem 0;
            font-weight: 700;
        }

        .recommendations p {
            color: var(--text-dark);
            margin: 0.5rem 0;
            line-height: 1.5;
        }

        .doctor-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: var(--bg-light);
            border-radius: 12px;
            border: 1px solid var(--border);
            margin-top: 1.5rem;
        }

        .doctor-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .doctor-details h4 {
            margin: 0 0 0.25rem 0;
            color: var(--text-dark);
            font-weight: 700;
        }

        .doctor-details p {
            margin: 0.25rem 0;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-primary {
            padding: 0.75rem 1.5rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            background: #0284c7;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
        }

        .btn-secondary {
            padding: 0.75rem 1.5rem;
            background: var(--bg-light);
            color: var(--text-dark);
            border: 1px solid var(--border);
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-secondary:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .btn-primary svg,
        .btn-secondary svg {
            width: 18px;
            height: 18px;
            stroke: currentColor;
        }

        @media (max-width: 768px) {
            .detail-header {
                padding: 1.5rem;
            }

            .detail-title {
                font-size: 1.5rem;
            }

            .detail-section {
                padding: 1.5rem;
            }

            .detail-info-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-primary,
            .btn-secondary {
                width: 100%;
                justify-content: center;
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
            <li><a href="dashboard_p.php">
                <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                Dashboard
            </a></li>
            <li><a href="profileP.php">
                <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                My Profile
            </a></li>
            <li><a href="medical-records.html">
                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                Medical Records
            </a></li>
            <li><a href="myPrescriptions.php">
                <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                Prescriptions
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

    <div class="detail-container">
        <div class="detail-wrapper">
            <button class="back-button" onclick="goBack()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Back to Records
            </button>
            <div class="detail-header">
                <span class="record-status-badge">Active</span>
                <h1 class="detail-title">Hypertension Diagnosis</h1>
                
                <div class="detail-info-grid">
                    <div class="info-item">
                        <div class="info-label">Diagnosed Date</div>
                        <div class="info-value">September 15, 2024</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Doctor</div>
                        <div class="info-value">Dr. Sarah Johnson</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Specialty</div>
                        <div class="info-value">Cardiology</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Severity</div>
                        <div class="info-value">Moderate</div>
                    </div>
                </div>
            </div>
            <div class="detail-section">
                <h2 class="section-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                    </svg>
                    Clinical Information
                </h2>
                <p class="content-text">
                    Hypertension (high blood pressure) is a chronic condition where blood pressure remains elevated. It is often called a "silent killer" because many people do not know they have it. The condition significantly increases the risk of heart disease and stroke.
                </p>
                <p class="content-text">
                    In your case, the diagnosis was made after consistent elevated readings during multiple clinic visits. Your current blood pressure readings have been averaging around 150/95 mmHg, which is classified as Stage 2 hypertension.
                </p>
            </div>
            <div class="detail-section">
                <h2 class="section-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
                        <line x1="12" y1="7" x2="12" y2="13"></line>
                        <line x1="9" y1="16" x2="15" y2="16"></line>
                    </svg>
                    Symptoms & Findings
                </h2>
                <ul class="findings-list">
                    <li>Occasional headaches and dizziness</li>
                    <li>Mild shortness of breath during exertion</li>
                    <li>No chest pain reported</li>
                    <li>Normal kidney function tests</li>
                    <li>Left ventricular hypertrophy noted on ECG</li>
                </ul>
            </div>
            <div class="detail-section">
                <h2 class="section-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
                        <polyline points="9 12 12 15 15 9"></polyline>
                    </svg>
                    Current Treatment Plan
                </h2>
                <p class="content-text">
                    You have been prescribed Lisinopril 10mg daily to help manage your blood pressure. Additionally, lifestyle modifications are strongly recommended.
                </p>
                <div class="recommendations">
                    <h4>Recommended Actions:</h4>
                    <p><strong>Medications:</strong> Take Lisinopril 10mg once daily in the morning with food</p>
                    <p><strong>Diet:</strong> Follow a low-sodium diet (less than 2,300mg sodium per day)</p>
                    <p><strong>Exercise:</strong> Engage in 30 minutes of moderate exercise at least 5 days per week</p>
                    <p><strong>Stress Management:</strong> Practice meditation or yoga regularly</p>
                    <p><strong>Follow-up:</strong> Schedule a follow-up appointment in 4 weeks for blood pressure monitoring</p>
                </div>
            </div>
            <div class="detail-section">
                <h2 class="section-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Attending Physician
                </h2>
                <div class="doctor-info">
                    <div class="doctor-avatar">SJ</div>
                    <div class="doctor-details">
                        <h4>Dr. Sarah Johnson</h4>
                        <p>Board-Certified Cardiologist</p>
                        <p>License: MD-987654 | Verified Healthcare Provider</p>
                    </div>
                </div>
            </div>

            <div class="action-buttons">
                <button class="btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    Download PDF
                </button>
                <button class="btn-secondary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                    Message Doctor
                </button>
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
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <script>
        function toggleDrawer() {
            const drawer = document.getElementById('drawer');
            const overlay = document.getElementById('drawerOverlay');
            drawer.classList.toggle('open');
            overlay.classList.toggle('active');
        }

        function goBack() {
            window.history.back();
        }

        function logout() {
            window.location.href = '../index.html';
        }
    </script>
</body>
</html>
