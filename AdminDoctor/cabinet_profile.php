<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabinet Management - Admin</title>
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
                <span class="user-name">Dr. John Doe</span>
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
            <li><a href="dashboard_ad.php" class="active">
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
            <!--<li><a href="medical_records.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                Medical Records
            </a></li>
            <li><a href="prescriptions.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                Prescriptions
            </a></li>-->
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
            <button class="drawer-logout" onclick="logout()">Logout</button>
        </ul>
    </div>

    <div class="drawer-overlay" id="drawerOverlay" onclick="toggleDrawer()"></div>
    <div class="back-button-container">
        <a href="dashboard_ad.php" class="back-button">
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
                <h1>Cabinet Name</h1>
                <div class="cabinet-rating">
                    <span class="rating-stars">★★★★★</span>
                    <span class="rating-value">4.8</span>
                    <span class="review-count">(145 reviews)</span>
                </div>
                <div class="cabinet-location">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <span>ESST, Algiers</span>
                    <a href="https://maps.app.goo.gl/6zoLACDA4jriLqzN8" target="_blank" class="gps-link">View on Map</a>
                </div>
            </div>
        </div>
        <div class="cabinet-bio">
            <p>Welcome to our professional medical cabinet! We offer a wide range of healthcare services with a dedicated team of doctors and staff. Our mission is to provide quality care and a welcoming environment for all patients.</p>
        </div>
        <div class="ratings-section">
            <h2>Ratings & Reviews</h2>
            <div class="ratings-overview">
                <div class="rating-score">
                    <div class="big-rating">4.8</div>
                    <div class="star-display">★★★★★</div>
                    <div class="total-reviews">145 total reviews</div>
                </div>
                <div class="rating-breakdown">
                    <div class="rating-bar-item">
                        <span class="star-label">5★</span>
                        <div class="bar-container">
                            <div class="bar-fill" style="width: 75%"></div>
                        </div>
                        <span class="count">109</span>
                    </div>
                    <div class="rating-bar-item">
                        <span class="star-label">4★</span>
                        <div class="bar-container">
                            <div class="bar-fill" style="width: 15%"></div>
                        </div>
                        <span class="count">22</span>
                    </div>
                    <div class="rating-bar-item">
                        <span class="star-label">3★</span>
                        <div class="bar-container">
                            <div class="bar-fill" style="width: 7%"></div>
                        </div>
                        <span class="count">10</span>
                    </div>
                    <div class="rating-bar-item">
                        <span class="star-label">2★</span>
                        <div class="bar-container">
                            <div class="bar-fill" style="width: 2%"></div>
                        </div>
                        <span class="count">3</span>
                    </div>
                    <div class="rating-bar-item">
                        <span class="star-label">1★</span>
                        <div class="bar-container">
                            <div class="bar-fill" style="width: 1%"></div>
                        </div>
                        <span class="count">1</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="doctors-section">
            <h2>Our Doctors</h2>
            <div class="doctors-grid">
                <div class="doctor-card" onclick="showDoctorProfile(1)">
                    <img src="https://placeholder.svg?height=100&width=100&query=male+doctor+portrait" alt="Doctor" class="doctor-image">
                    <div class="doctor-info">
                        <h3>Dr. Ahmed Benali</h3>
                        <p class="doctor-specialty">Cardiologist</p>
                        <div class="doctor-rating">
                            <span class="stars">★★★★★</span>
                            <span class="rating">4.9</span>
                        </div>
                        <p class="doctor-experience">15 years experience</p>
                    </div>
                </div>

                <div class="doctor-card" onclick="showDoctorProfile(2)">
                    <img src="https://placeholder.svg?height=100&width=100&query=female+doctor+portrait" alt="Doctor" class="doctor-image">
                    <div class="doctor-info">
                        <h3>Dr. Fatima Khelifi</h3>
                        <p class="doctor-specialty">Pediatrician</p>
                        <div class="doctor-rating">
                            <span class="stars">★★★★★</span>
                            <span class="rating">4.8</span>
                        </div>
                        <p class="doctor-experience">12 years experience</p>
                    </div>
                </div>

                <div class="doctor-card" onclick="showDoctorProfile(3)">
                    <img src="https://placeholder.svg?height=100&width=100&query=male+doctor+dermatology" alt="Doctor" class="doctor-image">
                    <div class="doctor-info">
                        <h3>Dr. Karim Meziane</h3>
                        <p class="doctor-specialty">Dermatologist</p>
                        <div class="doctor-rating">
                            <span class="stars">★★★★☆</span>
                            <span class="rating">4.6</span>
                        </div>
                        <p class="doctor-experience">10 years experience</p>
                    </div>
                </div>

                <div class="doctor-card" onclick="showDoctorProfile(4)">
                    <img src="https://placeholder.svg?height=100&width=100&query=female+doctor+neurologist" alt="Doctor" class="doctor-image">
                    <div class="doctor-info">
                        <h3>Dr. Samira Touati</h3>
                        <p class="doctor-specialty">Neurologist</p>
                        <div class="doctor-rating">
                            <span class="stars">★★★★★</span>
                            <span class="rating">4.9</span>
                        </div>
                        <p class="doctor-experience">18 years experience</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="reviews-section">
            <div class="reviews-header">
                <h2>Patient Reviews</h2>
                <button class="btn-show-all" onclick="toggleAllReviews()">Show All Reviews</button>
            </div>
            
            <div class="reviews-list" id="reviewsList">
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <img src="https://placeholder.svg?height=50&width=50&query=patient+avatar" alt="Patient" class="reviewer-avatar">
                            <div>
                                <h4 class="reviewer-name">Sarah M.</h4>
                                <div class="review-meta">
                                    <span class="review-stars">★★★★★</span>
                                    <span class="review-date">2 weeks ago</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="review-text">Excellent service! Dr. Benali was very thorough and took time to explain everything. The staff was friendly and professional. Highly recommend this cabinet!</p>
                </div>

                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <img src="https://placeholder.svg?height=50&width=50&query=male+patient+avatar" alt="Patient" class="reviewer-avatar">
                            <div>
                                <h4 class="reviewer-name">Karim B.</h4>
                                <div class="review-meta">
                                    <span class="review-stars">★★★★★</span>
                                    <span class="review-date">1 month ago</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="review-text">Dr. Khelifi is amazing with children. My daughter felt comfortable the entire visit. Clean facility and easy appointment scheduling.</p>
                </div>

                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <img src="https://placeholder.svg?height=50&width=50&query=female+patient+avatar" alt="Patient" class="reviewer-avatar">
                            <div>
                                <h4 class="reviewer-name">Amina L.</h4>
                                <div class="review-meta">
                                    <span class="review-stars">★★★★☆</span>
                                    <span class="review-date">1 month ago</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="review-text">Very professional and the treatment was effective. The only issue was waiting time was a bit long, but overall great experience.</p>
                </div>

                <div class="review-card hidden-review">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <img src="https://placeholder.svg?height=50&width=50&query=male+patient" alt="Patient" class="reviewer-avatar">
                            <div>
                                <h4 class="reviewer-name">Mohamed A.</h4>
                                <div class="review-meta">
                                    <span class="review-stars">★★★★★</span>
                                    <span class="review-date">2 months ago</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="review-text">Outstanding care from Dr. Touati. She accurately diagnosed my condition and the treatment plan worked perfectly. Thank you!</p>
                </div>

                <div class="review-card hidden-review">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <img src="https://placeholder.svg?height=50&width=50&query=woman+patient" alt="Patient" class="reviewer-avatar">
                            <div>
                                <h4 class="reviewer-name">Nadia K.</h4>
                                <div class="review-meta">
                                    <span class="review-stars">★★★★★</span>
                                    <span class="review-date">2 months ago</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="review-text">I've been coming here for years. The doctors are knowledgeable and caring. The facility is always clean and well-maintained.</p>
                </div>

                <div class="review-card hidden-review">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <img src="https://placeholder.svg?height=50&width=50&query=senior+patient" alt="Patient" class="reviewer-avatar">
                            <div>
                                <h4 class="reviewer-name">Hassan D.</h4>
                                <div class="review-meta">
                                    <span class="review-stars">★★★★☆</span>
                                    <span class="review-date">3 months ago</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="review-text">Good medical care and reasonable prices. The receptionist was helpful in scheduling my appointments around my availability.</p>
                </div>
            </div>
        </div>

        <div class="cabinet-details-grid">
            <div class="cabinet-detail-box">
                <h3>Appointment Pricing</h3>
                <ul>
                    <li>General Consultation: <strong>2000 DA</strong></li>
                    <li>Specialist Visit: <strong>3500 DA</strong></li>
                    <li>Follow-up: <strong>1500 DA</strong></li>
                </ul>
            </div>
            <div class="cabinet-detail-box">
                <h3>Specializations</h3>
                <ul>
                    <li>Cardiology</li>
                    <li>Pediatrics</li>
                    <li>Dermatology</li>
                    <li>Neurology</li>
                </ul>
            </div>
            <div class="cabinet-detail-box">
                <h3>Contact</h3>
                <ul>
                    <li>Phone: +213 555 123 456</li>
                    <li>Email: info@med-office.com</li>
                </ul>
            </div>
        </div>

        <div class="cabinet-social-footer">
            <span>Share this cabinet:</span>
            <a href="#" class="social-icon">FB</a>
            <a href="#" class="social-icon">TW</a>
            <a href="#" class="social-icon">IG</a>
        </div>
    </div>
    <div class="doctor-modal" id="doctorModal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeDoctorProfile()">&times;</span>
            <div class="modal-header">
                <img id="modalDoctorImage" src="/placeholder.svg" alt="Doctor" class="modal-doctor-image">
                <div class="modal-doctor-main">
                    <h2 id="modalDoctorName">Doctor Name</h2>
                    <p id="modalDoctorSpecialty" class="modal-specialty">Specialty</p>
                    <div class="modal-rating">
                        <span class="stars" id="modalDoctorStars">★★★★★</span>
                        <span class="rating" id="modalDoctorRating">4.9</span>
                        <span class="review-count" id="modalDoctorReviews">(120 reviews)</span>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="modal-section">
                    <h3>About</h3>
                    <p id="modalDoctorBio">Experienced medical professional dedicated to providing quality healthcare.</p>
                </div>
                <div class="modal-section">
                    <h3>Experience</h3>
                    <p id="modalDoctorExperience">15 years of medical practice</p>
                </div>
                <div class="modal-section">
                    <h3>Education</h3>
                    <ul id="modalDoctorEducation">
                        <li>Medical Degree - University of Algiers</li>
                        <li>Specialization in Cardiology - Paris Medical School</li>
                    </ul>
                </div>
                <div class="modal-section">
                    <h3>Languages</h3>
                    <p id="modalDoctorLanguages">Arabic, French, English</p>
                </div>
                <div class="modal-section">
                    <h3>Availability</h3>
                    <p id="modalDoctorAvailability">Monday - Friday: 9:00 AM - 5:00 PM</p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-book-appointment">Book Appointment</button>
            </div>
        </div>
    </div>

    <script>
    const doctors = {
        1: {
            name: "Dr. Ahmed Benali",
            specialty: "Cardiologist",
            image: "https://placeholder.svg?height=150&width=150&query=male+doctor+portrait",
            rating: 4.9,
            reviews: 120,
            stars: "★★★★★",
            bio: "Dr. Benali is a highly experienced cardiologist with over 15 years of practice. He specializes in interventional cardiology and has helped thousands of patients with heart-related conditions.",
            experience: "15 years of medical practice specializing in Cardiology",
            education: ["Medical Degree - University of Algiers (2008)", "Cardiology Specialization - Paris Medical School (2012)", "Fellowship in Interventional Cardiology - Lyon Hospital (2014)"],
            languages: "Arabic, French, English",
            availability: "Monday, Wednesday, Friday: 9:00 AM - 4:00 PM"
        },
        2: {
            name: "Dr. Fatima Khelifi",
            specialty: "Pediatrician",
            image: "https://placeholder.svg?height=150&width=150&query=female+doctor+portrait",
            rating: 4.8,
            reviews: 98,
            stars: "★★★★★",
            bio: "Dr. Khelifi is dedicated to providing compassionate care to children of all ages. She has extensive experience in pediatric care and child development.",
            experience: "12 years of medical practice specializing in Pediatrics",
            education: ["Medical Degree - University of Constantine (2011)", "Pediatrics Specialization - CHU Algiers (2015)"],
            languages: "Arabic, French",
            availability: "Tuesday, Thursday: 10:00 AM - 6:00 PM, Saturday: 9:00 AM - 2:00 PM"
        },
        3: {
            name: "Dr. Karim Meziane",
            specialty: "Dermatologist",
            image: "https://placeholder.svg?height=150&width=150&query=male+doctor+dermatology",
            rating: 4.6,
            reviews: 85,
            stars: "★★★★☆",
            bio: "Dr. Meziane specializes in both medical and cosmetic dermatology, helping patients achieve healthy skin and confidence.",
            experience: "10 years of medical practice specializing in Dermatology",
            education: ["Medical Degree - University of Oran (2013)", "Dermatology Specialization - Nice University Hospital (2017)"],
            languages: "Arabic, French, English",
            availability: "Monday - Thursday: 2:00 PM - 7:00 PM"
        },
        4: {
            name: "Dr. Samira Touati",
            specialty: "Neurologist",
            image: "https://placeholder.svg?height=150&width=150&query=female+doctor+neurologist",
            rating: 4.9,
            reviews: 142,
            stars: "★★★★★",
            bio: "Dr. Touati is a renowned neurologist with expertise in treating complex neurological disorders. She is known for her patient-centered approach and diagnostic accuracy.",
            experience: "18 years of medical practice specializing in Neurology",
            education: ["Medical Degree - University of Algiers (2005)", "Neurology Specialization - Marseille Medical School (2009)", "Fellowship in Movement Disorders - Geneva Hospital (2011)"],
            languages: "Arabic, French, English, Spanish",
            availability: "Monday, Wednesday, Friday: 8:00 AM - 3:00 PM"
        }
    };

    function showDoctorProfile(doctorId) {
        const doctor = doctors[doctorId];
        if (!doctor) return;

        document.getElementById('modalDoctorImage').src = doctor.image;
        document.getElementById('modalDoctorName').textContent = doctor.name;
        document.getElementById('modalDoctorSpecialty').textContent = doctor.specialty;
        document.getElementById('modalDoctorStars').textContent = doctor.stars;
        document.getElementById('modalDoctorRating').textContent = doctor.rating;
        document.getElementById('modalDoctorReviews').textContent = `(${doctor.reviews} reviews)`;
        document.getElementById('modalDoctorBio').textContent = doctor.bio;
        document.getElementById('modalDoctorExperience').textContent = doctor.experience;
        document.getElementById('modalDoctorLanguages').textContent = doctor.languages;
        document.getElementById('modalDoctorAvailability').textContent = doctor.availability;

        const educationList = document.getElementById('modalDoctorEducation');
        educationList.innerHTML = '';
        doctor.education.forEach(edu => {
            const li = document.createElement('li');
            li.textContent = edu;
            educationList.appendChild(li);
        });

        document.getElementById('doctorModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeDoctorProfile() {
        document.getElementById('doctorModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('doctorModal');
        if (event.target === modal) {
            closeDoctorProfile();
        }
    }

    function toggleDrawer() {
        const drawer = document.getElementById('drawer');
        const overlay = document.getElementById('drawerOverlay');
        drawer.classList.toggle('active');
        overlay.classList.toggle('active');
    }

    function logout() {
        window.location.href = '../index.php';
    }

    function toggleAllReviews() {
        const hiddenReviews = document.querySelectorAll('.hidden-review');
        const btn = document.querySelector('.btn-show-all');
        
        hiddenReviews.forEach(review => {
            if (review.style.display === 'block') {
                review.style.display = 'none';
                btn.textContent = 'Show All Reviews';
            } else {
                review.style.display = 'block';
                btn.textContent = 'Show Less';
            }
        });
    }
    </script>
</body>
</html>
