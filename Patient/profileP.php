<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Patient Profile</title>
  <link rel="stylesheet" href="../CSS/profile.css" />
</head>
<body>
  <div class="profile-wrapper">
    <div class="profile-header">
      <h1 class="profile-title">Patient Profile</h1>
    </div>
    <div class="profile-card">
      <div class="avatar-container">
        <img src="https://ui-avatars.com/api/?name=Kim+Park&background=0891b2&color=fff&size=140" class="profile-avatar" alt="Kim Park" />
        <div class="status-badge">Active</div>
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
            <span class="info-label">Patient ID:</span>
            <span class="info-value">1</span>
          </div>
          <div class="info-row">
            <span class="info-label">Full Name:</span>
            <span class="info-value">Samia Boulekrinate</span>
          </div>
          <div class="info-row">
            <span class="info-label">Email:</span>
            <span class="info-value">samia.bk@medic-office.com</span>
          </div>
          <div class="info-row">
            <span class="info-label">Phone:</span>
            <span class="info-value">+2130000000</span>
          </div>
          <div class="info-row">
            <span class="info-label">Address:</span>
            <span class="info-value">Algiers, el achour</span>
          </div>
        </div>
      </div>
      <div class="profile-section">
        <div class="section-header">
          <svg class="section-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="1"></circle>
            <path d="M12 1v6m0 6v6"></path>
            <path d="M4.22 4.22l4.24 4.24m2.12 2.12l4.24 4.24"></path>
            <path d="M1 12h6m6 0h6"></path>
            <path d="M4.22 19.78l4.24-4.24m2.12-2.12l4.24-4.24"></path>
            <circle cx="12" cy="12" r="9"></circle>
          </svg>
          <h2 class="section-title">Account Settings</h2>
        </div>
        <div class="section-content">
          <div class="info-row">
            <span class="info-label">Username:</span>
            <span class="info-value">SamiaB</span>
          </div>
          <div class="info-row">
            <span class="info-label">Registration Date:</span>
            <span class="info-value">Nov 1, 2025</span>
          </div>
        </div>
      </div>
      <div class="profile-actions">
        <a href="dashboard_p.php" class="btn btn-secondary">
          <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7"></path>
          </svg>
          Back to Home
        </a>
        <a href="edit_profileP.php" class="btn btn-primary">
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
