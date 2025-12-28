<?php
session_start();
$fullname = $_SESSION['full_name'] ?? 'User';
$cabinetID = $_GET['id'] ?? 0; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabinet Profile - MedOffice</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="../CSS/about-cabinet.css">
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="stylesheet" href="../CSS/cabinet_profile.css">
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
                <span class="user-name">Patient <?= htmlspecialchars($fullname ?? 'User') ?></span>
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
        </ul>
    </div>

    <div class="drawer-overlay" id="drawerOverlay" onclick="toggleDrawer()"></div>

    <div class="back-button-container">
        <a href="dashboard_p.php" class="back-button">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Back to Dashboard
        </a>
    </div>
    <div class="cabinet-profile-social">
        <div class="cabinet-header">
            <img src="https://placeholder.svg?height=110&width=110&query=medical+clinic+logo" alt="Cabinet Logo" class="cabinet-avatar">
            <div class="cabinet-main-info">
                <h1>Loading...</h1>
                <div class="cabinet-rating">
                    <span class="rating-stars">★★★★★</span>
                    <span class="rating-value">0</span>
                    <span class="review-count">(0 reviews)</span>
                </div>
                <div class="cabinet-location">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <span>Loading...</span>
                    <a href="#" target="_blank" class="gps-link">View on Map</a>
                </div>
            </div>
        </div>

        <div class="cabinet-bio">
            <p id="cabinet-bio-text">Loading...</p>
        </div>

        <div style="margin: 1.5rem 0; text-align: center;">
            <a href="calendarP.php?cabinetID=<?= htmlspecialchars($cabinetID) ?>"
               style="display: inline-block; background: #0891b2; color: #fff; padding: 0.75rem 2rem; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 1.05rem; transition: all 0.3s;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2"
                     style="vertical-align: middle; margin-right: 0.5rem;">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                Book an Appointment
            </a>
        </div>

        <div class="ratings-section">
            <h2>Ratings & Reviews</h2>
            <div class="ratings-overview">
                <div class="rating-score">
                    <div class="big-rating">0</div>
                    <div class="star-display">★★★★★</div>
                    <div class="total-reviews">0 total reviews</div>
                </div>
                <div class="rating-breakdown"></div>
            </div>
        </div>
        <div class="doctors-section">
            <h2>Our Doctors</h2>
            <div class="doctors-grid"></div>
        </div>

        <div class="reviews-section">
            <div class="reviews-header">
                <h2>Patient Reviews</h2>
                <button class="btn-show-all" onclick="toggleAllReviews()">Show All Reviews</button>
            </div>
            <div class="reviews-list" id="reviewsList"></div>
        </div>

        <div class="cabinet-details-grid">
            <div class="cabinet-detail-box">
                <h3>Appointment Pricing</h3>
                <ul id="pricing-list">
                    <li>Loading...</li>
                </ul>
            </div>
            <div class="cabinet-detail-box">
                <h3>Specializations</h3>
                <ul id="specializations-list">
                </ul>
            </div>
            <div class="cabinet-detail-box">
                <h3>Facilities</h3>
                <ul id="facilities-list">
                    <li>No facilities information available</li>
                </ul>
            </div>
            <div class="cabinet-detail-box">
                <h3>Contact</h3>
                <ul>
                    <li>Phone: <span id="contact-phone">—</span></li>
                    <li>Email: <span id="contact-email">—</span></li>
                    <li>Website: <a id="contact-website" href="#" target="_blank">—</a></li>
                </ul>
            </div>
        </div>

        <div class="cabinet-social-footer">
            <span>Share this cabinet:</span>
            <a href="#" id="social-facebook" class="social-icon" target="_blank">FB</a>
            <a href="#" id="social-twitter" class="social-icon" target="_blank">TW</a>
            <a href="#" id="social-instagram" class="social-icon" target="_blank">IG</a>
            <a href="#" id="social-linkedin" class="social-icon" target="_blank">IN</a>
        </div>
    </div>

    <div class="doctor-modal" id="doctorModal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeDoctorProfile()">&times;</span>
            <div class="modal-header">
                <img id="modalDoctorImage" src="/placeholder.svg" alt="Doctor" class="modal-doctor-image" style="display: none;">
                <div class="modal-doctor-main">
                    <h2 id="modalDoctorName">Doctor Name</h2>
                    <p id="modalDoctorSpecialty" class="modal-specialty">Specialty</p>
                    <div class="modal-rating">
                        <span class="stars" id="modalDoctorStars">★★★★★</span>
                        <span class="rating" id="modalDoctorRating">0</span>
                        <span class="review-count" id="modalDoctorReviews">(0 reviews)</span>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="modal-section">
                    <h3>About</h3>
                    <p id="modalDoctorBio">Experienced medical professional.</p>
                </div>
                <div class="modal-section">
                    <h3>Experience</h3>
                    <p id="modalDoctorExperience">—</p>
                </div>
                <div class="modal-section">
                    <h3>Education</h3>
                    <ul id="modalDoctorEducation">
                        <li>No education data available</li>
                    </ul>
                </div>
                <div class="modal-section">
                    <h3>Languages</h3>
                    <p id="modalDoctorLanguages">—</p>
                </div>
                <div class="modal-section">
                    <h3>Availability</h3>
                    <p id="modalDoctorAvailability">See calendar for availability</p>
                </div>
            </div>
        </div>
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
    <script src="../ajax/cabinet-profile.js"></script>
    <script>
        function toggleDrawer() {
            const drawer = document.getElementById('drawer');
            const overlay = document.getElementById('drawerOverlay');
            drawer.classList.toggle('open');
            overlay.classList.toggle('active');
        }
    </script>
</body>
</html>
