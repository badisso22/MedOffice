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
        <img
          id="profileAvatar"
          class="profile-avatar"
          src="/MedOffice/<?php echo htmlspecialchars($user['profilePicture'] ?? 'placeholder.svg', ENT_QUOTES); ?>"
          alt="Patient Avatar"
        />
        <div class="status-badge">Active</div>
        <button id="editAvatarBtn" class="edit-avatar-btn" title="Change profile picture">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
          </svg>
        </button>
        <input type="file" id="profilePictureInput" style="display: none;" accept="image/*" />
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
            <span class="info-value" id="pfPatientId">-</span>
          </div>
          <div class="info-row">
            <span class="info-label">Full Name:</span>
            <span class="info-value" id="pfFullName">-</span>
          </div>
          <div class="info-row">
            <span class="info-label">Email:</span>
            <span class="info-value" id="pfEmail">-</span>
          </div>
          <div class="info-row">
            <span class="info-label">Phone:</span>
            <span class="info-value" id="pfPhone">-</span>
          </div>
          <div class="info-row">
            <span class="info-label">Address:</span>
            <span class="info-value" id="pfAddress">-</span>
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
            <span class="info-value" id="pfUsername">-</span>
          </div>
          <div class="info-row">
            <span class="info-label">Registration Date:</span>
            <span class="info-value" id="pfRegDate">-</span>
          </div>
        </div>
      </div>

      <div class="profile-section">
        <div class="section-header">
          <svg class="section-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
            <polyline points="17 8 12 3 7 8"></polyline>
            <line x1="12" y1="3" x2="12" y2="15"></line>
          </svg>
          <h2 class="section-title">Profile Picture</h2>
        </div>
        <div class="section-content">
          <p style="color: #64748b; margin-bottom: 1rem;">Click the edit icon on your profile picture above to change it.</p>
          <div style="display: flex; gap: 1rem;">
            <button id="uploadProfilePictureBtn" class="btn btn-primary" style="display: none;">
              <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                <polyline points="17 8 12 3 7 8"></polyline>
                <line x1="12" y1="3" x2="12" y2="15"></line>
              </svg>
              Save Picture
            </button>
            <button id="deleteProfilePictureBtn" class="btn btn-danger">
              <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                <line x1="10" y1="11" x2="10" y2="17"></line>
                <line x1="14" y1="11" x2="14" y2="17"></line>
              </svg>
              Delete Picture
            </button>
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

  <script src="../ajax/patient_profile.js"></script>
  <script src="../ajax/patient-profile-picture.js"></script>
</body>
</html>
