<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile - MedOffice</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="../CSS/doctor_profile.css">
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
            <li><a href="about_cabinet.php">
                <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                Cabinet Info
            </a></li>
            <li><a href="medAi.php">
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
    <main class="profile-main">
        <div class="breadcrumb">
            <a href="search_doctor.php" class="btn btn-secondary">← Search Doctor</a>
        </div>

        <section class="doctor-profile-section">
            <div class="profile-card">
                <div class="profile-header">
                    <div class="profile-left">
                        <div class="profile-photo">
                            <img src="/placeholder.svg?height=120&width=120" alt="Doctor">
                        </div>
                        <div class="profile-main-info">
                            <h1>Dr. Sarah Ahmed</h1>
                            <p class="profile-title">Cardiologist</p>
                            <div class="profile-rating">
                                <span class="stars">★★★★★</span>
                                <span class="rating-text">4.9 (127 reviews)</span>
                                <div class="badges">
                                    <span class="badge badge-primary">Top rated</span>
                                    <span class="badge badge-secondary">Highly recommended</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-right">
                        <div class="profile-facts">
                            <div class="fact">
                                <svg viewBox="0 0 24 24"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                <div>
                                    <span class="fact-label">Experience</span>
                                    <span class="fact-value">15 years</span>
                                </div>
                            </div>
                            <div class="fact">
                                <svg viewBox="0 0 24 24"><path d="M2 12h20M2 12l7-7m-7 7l7 7"></path></svg>
                                <div>
                                    <span class="fact-label">Languages</span>
                                    <span class="fact-value">Arabic, French, English</span>
                                </div>
                            </div>
                            <div class="fact">
                                <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                <div>
                                    <span class="fact-label">Location</span>
                                    <span class="fact-value">Algiers</span>
                                </div>
                            </div>
                            <div class="fact">
                                <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                                <div>
                                    <span class="fact-label">Consultation</span>
                                    <span class="fact-value">In-clinic / Online</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="profile-tabs">
                    <button class="tab-btn active" onclick="showTab('overview')">Overview</button>
                    <button class="tab-btn" onclick="showTab('reviews')">Reviews</button>
                    <button class="tab-btn" onclick="showTab('services')">Services & Pricing</button>
                </div>

                <div class="tab-content">
                    <div id="overview" class="tab-pane active">
                        <h2>About Dr. Sarah Ahmed</h2>
                        <p>Dr. Sarah Ahmed is a board-certified cardiologist with over 15 years of experience in treating cardiovascular diseases. She specializes in preventive cardiology, heart failure management, and hypertension treatment.</p>
                        
                        <h3>Education & Certifications</h3>
                        <ul class="education-list">
                            <li>
                                <strong>MD, Cardiology</strong> - Ziania - alger (2008)
                            </li>
                            <li>
                                <strong>Fellowship in Interventional Cardiology</strong> - Paris Descartes University (2012)
                            </li>
                            <li>
                                <strong>Board Certified</strong> - Algerian Board of Cardiology
                            </li>
                        </ul>

                        <h3>Areas of Expertise</h3>
                        <div class="expertise-tags">
                            <span class="tag">Heart Failure Management</span>
                            <span class="tag">Hypertension Treatment</span>
                            <span class="tag">Preventive Cardiology</span>
                            <span class="tag">ECG Interpretation</span>
                            <span class="tag">Echocardiography</span>
                            <span class="tag">Cardiac Rehabilitation</span>
                        </div>
                    </div>

                    <div id="reviews" class="tab-pane">
                        <h2>Patient Reviews</h2>
                        <div class="reviews-list">
                            <div class="review-card">
                                <div class="review-header">
                                    <div>
                                        <strong>Ahmed K.</strong>
                                        <span class="stars">★★★★★</span>
                                    </div>
                                    <span class="review-date">2 weeks ago</span>
                                </div>
                                <p>Excellent doctor! Very thorough examination and took time to explain everything clearly. Highly recommended.</p>
                            </div>
                            <div class="review-card">
                                <div class="review-header">
                                    <div>
                                        <strong>Fatima M.</strong>
                                        <span class="stars">★★★★★</span>
                                    </div>
                                    <span class="review-date">1 month ago</span>
                                </div>
                                <p>Professional and caring. Dr. Ahmed helped me manage my blood pressure effectively. Very satisfied with the treatment.</p>
                            </div>
                        </div>
                    </div>

                    <div id="services" class="tab-pane">
                        <h2>Services & Pricing</h2>
                        <div class="services-list">
                            <div class="service-item">
                                <div>
                                    <strong>Initial Consultation</strong>
                                    <p>Comprehensive cardiovascular assessment</p>
                                </div>
                                <span class="price">1200 DZD</span>
                            </div>
                            <div class="service-item">
                                <div>
                                    <strong>Follow-up Visit</strong>
                                    <p>Regular checkup and medication review</p>
                                </div>
                                <span class="price">800 DZD</span>
                            </div>
                            <div class="service-item">
                                <div>
                                    <strong>ECG Examination</strong>
                                    <p>Electrocardiogram with interpretation</p>
                                </div>
                                <span class="price">500 DZD</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="booking-section">
            <div class="cabinet-card">
                <h2>Cabinet Information</h2>
                <div class="cabinet-info">
                    <div class="cabinet-logo">
                        <img src="/placeholder.svg?height=60&width=60" alt="Clinic">
                    </div>
                    <div>
                        <h3>ESST Medical Office</h3>
                        <p class="cabinet-address">El Achour ,Oued el Romane , alger. 16500</p>
                        <p class="cabinet-contact">Tel: +213 522 123 456</p>
                    </div>
                </div>
                <div class="opening-hours">
                    <h4>Opening Hours</h4>
                    <ul>
                        <li><span>Monday - Friday:</span> <strong>8:00 - 18:00</strong></li>
                        <li><span>Saturday:</span> <strong>9:00 - 14:00</strong></li>
                        <li><span>Sunday:</span> <strong>Closed</strong></li>
                    </ul>
                </div>
            </div>

            <div class="appointment-card">
                <h2>Book an appointment</h2>
                <form id="bookingForm" class="booking-form">
                    <div class="form-group">
                        <label>Appointment Type</label>
                        <div class="type-selector">
                            <label class="type-option">
                                <input type="radio" name="appointmentType" value="clinic" checked>
                                <span>
                                    <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
                                    In-clinic
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Select Date</label>
                        <input type="date" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label>Available Time Slots</label>
                        <div class="time-slots">
                            <button type="button" class="time-slot">09:00</button>
                            <button type="button" class="time-slot">10:30</button>
                            <button type="button" class="time-slot disabled" disabled>12:00</button>
                            <button type="button" class="time-slot">14:00</button>
                            <button type="button" class="time-slot">15:30</button>
                            <button type="button" class="time-slot">17:00</button>
                        </div>
                    </div>

                    <div class="booking-summary">
                        <div class="summary-row">
                            <span>Date & Time:</span>
                            <strong id="selectedDateTime">Not selected</strong>
                        </div>
                        <div class="summary-row">
                            <span>Type:</span>
                            <strong>In-clinic visit</strong>
                        </div>
                        <div class="summary-row">
                            <span>Price:</span>
                            <strong>500 DZD</strong>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-large">Confirm appointment</button>
                </form>

                <div id="successMessage" class="success-banner" style="display: none;">
                    <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <div>
                        <strong>Appointment confirmed!</strong>
                        <p>You will receive a confirmation email shortly.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
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

        function showTab(tabName) {
            const tabs = document.querySelectorAll('.tab-pane');
            const btns = document.querySelectorAll('.tab-btn');
            
            tabs.forEach(tab => tab.classList.remove('active'));
            btns.forEach(btn => btn.classList.remove('active'));
            
            document.getElementById(tabName).classList.add('active');
            event.target.classList.add('active');
        }

        const timeSlots = document.querySelectorAll('.time-slot:not(.disabled)');
        timeSlots.forEach(slot => {
            slot.addEventListener('click', function() {
                timeSlots.forEach(s => s.classList.remove('selected'));
                this.classList.add('selected');
                document.getElementById('selectedDateTime').textContent = 'Tomorrow at ' + this.textContent;
            });
        });

        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('successMessage').style.display = 'flex';
            setTimeout(() => {
                document.getElementById('successMessage').style.display = 'none';
            }, 5000);
        });
    </script>
</body>
</html>