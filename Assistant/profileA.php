<?php
session_start();

if (empty($_SESSION['loggedIn']) || !isset($_SESSION['userID'])) {
    header('Location: ../login-forms/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Assistant Profile</title>
  <link rel="stylesheet" href="../CSS/profile.css" />
  <link rel="stylesheet" href="../CSS/profile_d.css" />
</head>
<body>
  <div class="doctor-profile-wrapper">
    <div class="profile-top-bar">
      <a href="dashboard_a.php" class="back-button">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M19 12H5M12 19l-7-7 7-7"></path>
        </svg>
        Back to Dashboard
      </a>
    </div>

    <div class="doctor-profile-card">
      <div class="doctor-header">
        <div class="doctor-avatar-section">
          <img
            id="assistantAvatar"
            class="doctor-avatar"
            src=""
            alt="Assistant avatar"
          />
          <span class="doctor-badge" id="assistantBadge">Assistant</span>
        </div>
        <div class="doctor-title-section">
          <h1 class="doctor-name" id="assistantName"></h1>
          <p class="doctor-specialty" id="assistantRole">Medical Assistant</p>
          <div class="doctor-rating">
            <span class="rating-score" id="assistantStatusText"></span>
            <span class="rating-count" id="assistantExperience"></span>
          </div>
        </div>
        <button class="close-button" onclick="window.location.href='dashboard_a.php'">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 6L6 18M6 6l12 12"></path>
          </svg>
        </button>
      </div>
      <div class="doctor-content">
        <section class="doctor-section">
          <h2 class="section-heading">About</h2>
          <p class="section-text" id="assistantAbout">
          </p>
        </section>

        <section class="doctor-section">
          <h2 class="section-heading">Experience</h2>
          <p class="section-text" id="experienceSummary">
            <span id="assistantExperienceSummary"></span>
          </p>
          <div class="experience-list" id="experienceList">
          </div>
        </section>

        <section class="doctor-section">
          <h2 class="section-heading">Skills</h2>
          <ul class="languages-list" id="assistantSkills">
          </ul>
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
                <p class="contact-value" id="assistantEmail"></p>
              </div>
            </div>
            <div class="contact-item">
              <svg class="contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
              </svg>
              <div>
                <p class="contact-label">Phone</p>
                <p class="contact-value" id="assistantPhone"></p>
              </div>
            </div>
            <div class="contact-item">
              <svg class="contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
              <div>
                <p class="contact-label">Location</p>
                <p class="contact-value" id="assistantAddress"></p>
              </div>
            </div>
          </div>
        </section>

        <section class="doctor-section">
          <h2 class="section-heading">Availability</h2>
          <div class="availability-list" id="assistantAvailability">
          </div>
        </section>
      </div>

      <div class="doctor-actions">
        <a href="edit_profileA.php" class="btn btn-primary">
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

  <script src="../ajax/assistant-profile.js"></script>
</body>
</html>
