<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Patient Profile</title>
  <link rel="stylesheet" href="../CSS/profile.css" />
  <link rel="stylesheet" href="../CSS/form_validation.css" />
</head>
<body>
  <div class="profile-wrapper">
    <div class="profile-header">
      <h1 class="profile-title">Edit Patient Profile</h1>
    </div>
    <div class="profile-card">
      <div class="avatar-container">
        <img id="editProfileAvatar" class="profile-avatar" src="" alt="Patient Avatar" />
        <div class="status-badge">Active</div>
      </div>
      
      <form id="editProfileForm">
        <div class="profile-section">
          <div class="section-header">
            <svg class="section-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
            <h2 class="section-title">Personal Information</h2>
          </div>
          <div class="section-content">
            <div class="info-row" style="flex-direction: column; align-items: stretch;">
              <label class="info-label" for="fullname">Full Name:</label>
              <input type="text" id="fullname" name="fullname" class="form-input" required />
            </div>
            <div class="info-row" style="flex-direction: column; align-items: stretch;">
              <label class="info-label" for="email">Email:</label>
              <input type="email" id="email" name="email" class="form-input" required />
            </div>
            <div class="info-row" style="flex-direction: column; align-items: stretch;">
              <label class="info-label" for="phone">Phone:</label>
              <input type="tel" id="phone" name="phone" class="form-input" required />
            </div>
            <div class="info-row" style="flex-direction: column; align-items: stretch;">
              <label class="info-label" for="address">Address:</label>
              <input type="text" id="address" name="address" class="form-input" required />
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
            <div class="info-row" style="flex-direction: column; align-items: stretch;">
              <label class="info-label" for="username">Username:</label>
              <input type="text" id="username" name="username" class="form-input" required minlength="3" />
            </div>
          </div>
        </div>

        <div class="profile-actions">
          <a href="profileP.php" class="btn btn-secondary">
            <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            Cancel
          </a>
          <button type="submit" class="btn btn-primary">
            <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M5 13l4 4L19 7"></path>
            </svg>
            Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>

  <script src="../ajax/patient_edit_profile.js"></script>
  <script src="../JS/form_validation.js"></script>
</body>
</html>
