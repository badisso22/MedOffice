<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedAI - Intelligent Healthcare Assistant</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="../CSS/medAi.css">
</head>
<body>
    <nav>
        <div class="nav-container">
            <button class="drawer-toggle" id="drawerToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <a href="#" class="logo">
                <div class="logo-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" width="24" height="24">
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
                    </svg>
                </div>
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
          <!--  <li><a href="myPrescriptions.php">
                <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                Consultations
            </a></li>-->
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
    <div class="medai-hero">
        <div class="medai-hero-content">
            <div class="medai-icon">
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
                </svg>
            </div>
            <h1>Meet <span style="color: #ffeb3b;">MedAI</span></h1>
            <p>Your Intelligent Healthcare Assistant Available 24/7</p>
        </div>
    </div>

    <div class="medai-features">
        <div class="medai-features-grid">
            <div class="medai-feature">
                <div class="medai-feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                </div>
                <h3>Instant Responses</h3>
                <p>Get immediate answers to your health questions anytime, anywhere.</p>
            </div>
            <div class="medai-feature">
                <div class="medai-feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <h3>Secure & Private</h3>
                <p>Your health information is protected with top-level encryption.</p>
            </div>
            <div class="medai-feature">
                <div class="medai-feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M12 16v-4"></path>
                        <path d="M12 8h.01"></path>
                    </svg>
                </div>
                <h3>Expert Guidance</h3>
                <p>Powered by medical expertise to provide accurate health information.</p>
            </div>
        </div>
    </div>

    <div class="medai-section">
        <h2>What Can MedAI Help You With?</h2>
        <p>MedAI is your personal healthcare companion, providing intelligent assistance with a wide range of medical and wellness concerns.</p>
        
        <ul class="capabilities-list">
            <li>
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="var(--accent)" stroke-width="3">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <div>
                    <span>Symptom Analysis</span>
                    <p>Describe your symptoms and receive preliminary guidance on possible conditions.</p>
                </div>
            </li>
            <li>
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="var(--accent)" stroke-width="3">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <div>
                    <span>Medication Information</span>
                    <p>Learn about your medications, potential side effects, and interactions.</p>
                </div>
            </li>
            <li>
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="var(--accent)" stroke-width="3">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <div>
                    <span>Health Tips & Prevention</span>
                    <p>Get personalized wellness advice and disease prevention strategies.</p>
                </div>
            </li>
            <li>
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="var(--accent)" stroke-width="3">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <div>
                    <span>Appointment Support</span>
                    <p>Get help preparing for your doctor's visits or understanding medical results.</p>
                </div>
            </li>
            <li>
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="var(--accent)" stroke-width="3">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <div>
                    <span>General Health Questions</span>
                    <p>Ask anything related to health, wellness, and medical topics.</p>
                </div>
            </li>
        </ul>

        <p style="margin-top: 3rem; color: var(--text-medium); font-style: italic;">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; margin-right: 0.5rem; vertical-align: middle;">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
            Note: MedAI provides informational support only and is not a substitute for professional medical advice. Always consult with a qualified healthcare provider for diagnosis and treatment.
        </p>
    </div>

    <div class="medai-section" style="text-align: center; padding: 4rem 5% 6rem;">
        <h2 style="margin-bottom: 1rem;">Ready to Chat with MedAI?</h2>
        <p style="margin-bottom: 2rem; font-size: 1.1rem;">Start a conversation now and get instant healthcare insights.</p>
        <a href="medAi_chat.php" class="start-chat-btn">Chat with MedAI</a>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>MedOffice</h3>
                <p>Your trusted healthcare management platform for patients and practitioners.</p>
            </div>
            <div class="footer-section">
                <h3>Support</h3>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Accessibility</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 MedOffice. All rights reserved. Healthcare at your fingertips.</p>
        </div>
    </footer>

    <script>
        const drawerToggle = document.getElementById('drawerToggle');
        const drawerClose = document.getElementById('drawerClose');
        const drawer = document.getElementById('drawer');
        const drawerOverlay = document.getElementById('drawerOverlay');

        drawerToggle.addEventListener('click', () => {
            drawer.classList.add('open');
            drawerOverlay.classList.add('active');
        });

        drawerClose.addEventListener('click', () => {
            drawer.classList.remove('open');
            drawerOverlay.classList.remove('active');
        });

        drawerOverlay.addEventListener('click', () => {
            drawer.classList.remove('open');
            drawerOverlay.classList.remove('active');
        });

        function logout() {
            window.location.href = '../index.html';
        }
    </script>
</body>
</html>
