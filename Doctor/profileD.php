<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Doctor Profile</title>
  <link rel="stylesheet" href="../CSS/profile.css" />
</head>
<body>
  <div class="profile-wrapper">
    <div class="profile-header">
      <h1 class="profile-title">Doctor Profile</h1>
    </div>
    <div class="profile-card">
      <div class="avatar-container">
        <img src="https://ui-avatars.com/api/?name=Dr.+Sarah+Johnson&background=06b6d4&color=fff&size=140" class="profile-avatar" alt="Dr. Sarah Johnson" />
        <div class="status-badge doctor-badge">Available</div>
      </div>
      <div class="profile-section">
        <div class="section-header">
          <svg class="section-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
          </svg>
          <h2 class="section-title">Personal Information</h2>
        </div>
        <div class="section-content">
          <div class="info-row">
            <span class="info-label">Doctor ID:</span>
            <span class="info-value">DOC-2025-001</span>
          </div>
          <div class="info-row">
            <span class="info-label">Full Name:</span>
            <span class="info-value">Dr. Sarah Johnson</span>
          </div>
          <div class="info-row">
            <span class="info-label">Email:</span>
            <span class="info-value">sarah.johnson@medic-office.com</span>
          </div>
          <div class="info-row">
            <span class="info-label">Phone:</span>
            <span class="info-value">+1 (555) 123-4567</span>
          </div>
          <div class="info-row">
            <span class="info-label">Address:</span>
            <span class="info-value">Algiers Medical Center, Cheraga</span>
          </div>
        </div>
      </div>
      <div class="profile-section">
        <div class="section-header">
          <svg class="section-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M4 7h16"></path>
            <path d="M9 11h0"></path>
            <path d="M15 11h0"></path>
            <path d="M9 15h0"></path>
            <path d="M15 15h0"></path>
            <rect x="2" y="5" width="20" height="14" rx="2"></rect>
          </svg>
          <h2 class="section-title">Professional Information</h2>
        </div>
        <div class="section-content">
          <div class="info-row">
            <span class="info-label">Specialization:</span>
            <span class="info-value">Cardiology</span>
          </div>
          <div class="info-row">
            <span class="info-label">License Number:</span>
            <span class="info-value">MED-2020-789456</span>
          </div>
        </div>
      </div>
      <div class="profile-actions">
        <a href="dashboard_d.php" class="btn btn-secondary">
          <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7"></path>
          </svg>
          Back to Home
        </a>
        <a href="edit_profileD.php" class="btn btn-primary">
          <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
          </svg>
          Edit Profile
        </a>
      </div>
    </div>
  </div>
</body>
</html>
