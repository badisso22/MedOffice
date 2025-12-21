<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Doctor Profile - Dr. Sarah Johnson</title>
  <link rel="stylesheet" href="../CSS/profile.css" />
  <link rel="stylesheet" href="../CSS/profile_d.css" />
</head>
<body>
  <div class="doctor-profile-wrapper">
    <div class="profile-top-bar">
      <a href="dashboard_ad.php" class="back-button">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M19 12H5M12 19l-7-7 7-7"></path>
        </svg>
        Back to Dashboard
      </a>
    </div>

    <div class="doctor-profile-card">
      <div class="doctor-header">
        <div class="doctor-avatar-section">
          <img src="https://ui-avatars.com/api/?name=Dr.+Sarah+Johnson&background=0891b2&color=fff&size=200" 
               class="doctor-avatar" 
               alt="Dr. Sarah Johnson" />
          <span class="doctor-badge">Doctor</span>
        </div>
        <div class="doctor-title-section">
          <h1 class="doctor-name">Dr. Sarah Johnson</h1>
          <p class="doctor-specialty">Cardiology</p>
          <div class="doctor-rating">
            <div class="stars">
              <svg class="star-icon filled" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
              </svg>
              <svg class="star-icon filled" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
              </svg>
              <svg class="star-icon filled" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
              </svg>
              <svg class="star-icon filled" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
              </svg>
              <svg class="star-icon half-filled" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
              </svg>
            </div>
            <span class="rating-score">4.8</span>
            <span class="rating-count">(142 reviews)</span>
          </div>
        </div>
        <button class="close-button" onclick="window.location.href='dashboard_ad.php'">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 6L6 18M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <div class="doctor-content">
        <section class="doctor-section">
          <h2 class="section-heading">About</h2>
          <p class="section-text">
            Dr. Sarah Johnson is dedicated to providing comprehensive cardiovascular care to patients of all ages. 
            She has extensive experience in cardiology, interventional procedures, and preventive heart health. 
            With a patient-centered approach, Dr. Johnson ensures each individual receives personalized treatment plans 
            tailored to their specific needs.
          </p>
        </section>

        <section class="doctor-section">
          <h2 class="section-heading">Experience</h2>
          <p class="section-text">15 years of medical practice specializing in Cardiology</p>
          <div class="experience-list">
            <div class="experience-item">
              <div class="experience-marker"></div>
              <div class="experience-details">
                <h3 class="experience-title">Senior Cardiologist</h3>
                <p class="experience-location">Algiers Medical Center, Cheraga</p>
                <p class="experience-period">2018 - Present</p>
              </div>
            </div>
            <div class="experience-item">
              <div class="experience-marker"></div>
              <div class="experience-details">
                <h3 class="experience-title">Cardiologist</h3>
                <p class="experience-location">Central Hospital, Algiers</p>
                <p class="experience-period">2010 - 2018</p>
              </div>
            </div>
          </div>
        </section>

        <section class="doctor-section">
          <h2 class="section-heading">Education</h2>
          <div class="education-list">
            <div class="education-item">
              <svg class="education-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
              </svg>
              <div>
                <p class="education-degree">Medical Degree - University of Algiers (2005)</p>
              </div>
            </div>
            <div class="education-item">
              <svg class="education-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
              </svg>
              <div>
                <p class="education-degree">Cardiology Specialization - CHU Mustapha (2010)</p>
              </div>
            </div>
            <div class="education-item">
              <svg class="education-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
              </svg>
              <div>
                <p class="education-degree">Fellowship in Interventional Cardiology - Paris (2012)</p>
              </div>
            </div>
          </div>
        </section>

        <section class="doctor-section">
          <h2 class="section-heading">Certifications & Licenses</h2>
          <div class="certification-grid">
            <div class="certification-badge">
              <svg class="cert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                <path d="M9 12l2 2 4-4"></path>
              </svg>
              <span>Board Certified</span>
            </div>
            <div class="certification-badge">
              <svg class="cert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <path d="M14 2v6h6M16 13H8M16 17H8M10 9H8"></path>
              </svg>
              <span>License: MED-2020-789456</span>
            </div>
            <div class="certification-badge">
              <svg class="cert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M12 6v6l4 2"></path>
              </svg>
              <span>15+ Years Experience</span>
            </div>
          </div>
        </section>

        <section class="doctor-section">
          <h2 class="section-heading">Languages</h2>
          <div class="languages-list">
            <span class="language-tag">Arabic</span>
            <span class="language-tag">French</span>
            <span class="language-tag">English</span>
          </div>
        </section>

        <section class="doctor-section">
          <h2 class="section-heading">Contact Information</h2>
          <div class="contact-grid">
            <div class="contact-item">
              <svg class="contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <path d="M22 6l-10 7L2 6"></path>
              </svg>
              <div>
                <p class="contact-label">Email</p>
                <p class="contact-value">sarah.johnson@medic-office.com</p>
              </div>
            </div>
            <div class="contact-item">
              <svg class="contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
              </svg>
              <div>
                <p class="contact-label">Phone</p>
                <p class="contact-value">+1 (555) 123-4567</p>
              </div>
            </div>
            <div class="contact-item">
              <svg class="contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
              <div>
                <p class="contact-label">Location</p>
                <p class="contact-value">Algiers Medical Center, Cheraga</p>
              </div>
            </div>
          </div>
        </section>

        <section class="doctor-section">
          <h2 class="section-heading">Availability</h2>
          <div class="availability-list">
            <div class="availability-item">
              <span class="day-label">Monday - Wednesday:</span>
              <span class="time-value">9:00 AM - 5:00 PM</span>
            </div>
            <div class="availability-item">
              <span class="day-label">Thursday - Friday:</span>
              <span class="time-value">10:00 AM - 6:00 PM</span>
            </div>
            <div class="availability-item">
              <span class="day-label">Saturday:</span>
              <span class="time-value">9:00 AM - 2:00 PM</span>
            </div>
            <div class="availability-item unavailable">
              <span class="day-label">Sunday:</span>
              <span class="time-value">Closed</span>
            </div>
          </div>
        </section>
      </div>

      <div class="doctor-actions">
        <a href="edit_profileAD.php" class="btn btn-primary">
          <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
          </svg>
          Edit Profile
        </a>
        <button class="btn btn-secondary" onclick="window.print()">
          <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
            <rect x="6" y="14" width="12" height="8"></rect>
          </svg>
          Print Profile
        </button>
      </div>
    </div>
  </div>
</body>
</html>
