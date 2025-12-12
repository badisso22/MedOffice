<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cabinet Profile - MedOffice</title>
  <link rel="stylesheet" href="../CSS/general.css">
  <link rel="stylesheet" href="../CSS/dashboard.css">
  <link rel="stylesheet" href="../CSS/cabinet_profile.css">
</head>
<body>

<main class="layout">
    <div class="back-button-container">
        <a href="about_cabinet.php" class="back-button">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to All Clinics
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

        <!-- Added Book Appointment button -->
        <div style="margin: 1.5rem 0; text-align: center;">
            <a href="calendarP.php" style="display: inline-block; background: #0891b2; color: #fff; padding: 0.75rem 2rem; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 1.05rem; transition: all 0.3s;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 0.5rem;">
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
                <button class="btn-show-all" onclick="toggleReviews()">Show All Reviews</button>
            </div>
            <div class="reviews-list">
                <div class="review-card">
                    <div class="reviewer-info">
                        <img src="https://placeholder.svg?height=50&width=50&query=patient+avatar" alt="Patient" class="reviewer-avatar">
                        <div>
                            <h4 class="reviewer-name">Sarah Ahmed</h4>
                            <div class="review-meta">
                                <span class="review-stars">★★★★★</span>
                                <span class="review-date">2 weeks ago</span>
                            </div>
                        </div>
                    </div>
                    <p class="review-text">Excellent care and professional staff. Dr. Benali took the time to explain everything clearly. The clinic is very clean and well-organized. Highly recommend!</p>
                </div>

                <div class="review-card">
                    <div class="reviewer-info">
                        <img src="https://placeholder.svg?height=50&width=50&query=male+patient" alt="Patient" class="reviewer-avatar">
                        <div>
                            <h4 class="reviewer-name">Mohamed Khelil</h4>
                            <div class="review-meta">
                                <span class="review-stars">★★★★★</span>
                                <span class="review-date">1 month ago</span>
                            </div>
                        </div>
                    </div>
                    <p class="review-text">Great experience with Dr. Khelifi for my daughter's checkup. She was very patient and caring. The waiting time was minimal. Will definitely come back.</p>
                </div>

                <div class="review-card">
                    <div class="reviewer-info">
                        <img src="https://placeholder.svg?height=50&width=50&query=female+patient" alt="Patient" class="reviewer-avatar">
                        <div>
                            <h4 class="reviewer-name">Amina Bouazza</h4>
                            <div class="review-meta">
                                <span class="review-stars">★★★★☆</span>
                                <span class="review-date">1 month ago</span>
                            </div>
                        </div>
                    </div>
                    <p class="review-text">Good service overall. The doctors are knowledgeable and friendly. Only minor issue was parking can be difficult during peak hours.</p>
                </div>

                <div class="review-card hidden-review">
                    <div class="reviewer-info">
                        <img src="https://placeholder.svg?height=50&width=50&query=patient" alt="Patient" class="reviewer-avatar">
                        <div>
                            <h4 class="reviewer-name">Karim Mansouri</h4>
                            <div class="review-meta">
                                <span class="review-stars">★★★★★</span>
                                <span class="review-date">2 months ago</span>
                            </div>
                        </div>
                    </div>
                    <p class="review-text">Dr. Meziane is fantastic! He diagnosed my skin condition quickly and the treatment worked perfectly. Very professional cabinet.</p>
                </div>

                <div class="review-card hidden-review">
                    <div class="reviewer-info">
                        <img src="https://placeholder.svg?height=50&width=50&query=elderly+patient" alt="Patient" class="reviewer-avatar">
                        <div>
                            <h4 class="reviewer-name">Fatima Benali</h4>
                            <div class="review-meta">
                                <span class="review-stars">★★★★★</span>
                                <span class="review-date">3 months ago</span>
                            </div>
                        </div>
                    </div>
                    <p class="review-text">I've been coming here for years. The entire team is wonderful and they really care about their patients. Couldn't ask for better healthcare.</p>
                </div>

                <div class="review-card hidden-review">
                    <div class="reviewer-info">
                        <img src="https://placeholder.svg?height=50&width=50&query=young+patient" alt="Patient" class="reviewer-avatar">
                        <div>
                            <h4 class="reviewer-name">Yacine Taleb</h4>
                            <div class="review-meta">
                                <span class="review-stars">★★★★☆</span>
                                <span class="review-date">3 months ago</span>
                            </div>
                        </div>
                    </div>
                    <p class="review-text">Modern facilities and good doctors. Appointment scheduling could be improved but overall a solid choice for medical care.</p>
                </div>
            </div>
        </div>
    </div>
</main>


<script>
    function toggleDrawer() {
        const d = document.getElementById('drawer');
        d.classList.toggle('open');
    }

    function toggleReviews() {
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
    }

    function closeDoctorModal() {
        document.getElementById('doctorModal').style.display = 'none';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('doctorModal');
        if (event.target === modal) {
            closeDoctorModal();
        }
    }
</script>
<div id="doctorModal" class="doctor-modal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeDoctorModal()">&times;</span>
        <div class="modal-header">
            <img id="modalDoctorImage" src="/placeholder.svg" alt="Doctor" class="modal-doctor-image">
            <div class="modal-doctor-main">
                <h2 id="modalDoctorName"></h2>
                <p class="modal-specialty" id="modalDoctorSpecialty"></p>
                <div class="modal-rating">
                    <span class="stars" id="modalDoctorStars"></span>
                    <span class="rating" id="modalDoctorRating"></span>
                    <span class="review-count" id="modalDoctorReviews"></span>
                </div>
            </div>
        </div>
        <div class="modal-body">
            <div class="modal-section">
                <h3>About</h3>
                <p id="modalDoctorBio"></p>
            </div>
            <div class="modal-section">
                <h3>Experience</h3>
                <p id="modalDoctorExperience"></p>
            </div>
            <div class="modal-section">
                <h3>Education</h3>
                <ul id="modalDoctorEducation"></ul>
            </div>
            <div class="modal-section">
                <h3>Languages</h3>
                <p id="modalDoctorLanguages"></p>
            </div>
            <div class="modal-section">
                <h3>Availability</h3>
                <p id="modalDoctorAvailability"></p>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-book-appointment" onclick="window.location.href='calendarP.php'">Book Appointment</button>
        </div>
    </div>
</div>

</body>
</html>
