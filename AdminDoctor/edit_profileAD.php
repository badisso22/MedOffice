<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Admin Doctor Profile</title>
  <link rel="stylesheet" href="../CSS/profile.css" />
  <link rel="stylesheet" href="../CSS/form_validation.css" />
</head>
<body>
  <div class="profile-wrapper">
    <div class="profile-header">
      <h1 class="profile-title">Edit Admin Doctor Profile</h1>
    </div>
    <div class="profile-card">
      <div class="avatar-container">
        <img src="https://ui-avatars.com/api/?name=Dr.+Sarah+Johnson&background=dc2626&color=fff&size=140" class="profile-avatar" alt="Dr. Sarah Johnson" />
        <div class="status-badge" style="background: #dc2626;">Admin</div>
      </div>
      
      <form id="editProfileForm" method="POST" action="#">
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
              <input type="text" id="fullname" name="fullname" class="form-input" value="Dr. Sarah Johnson" required />
            </div>
            <div class="info-row" style="flex-direction: column; align-items: stretch;">
              <label class="info-label" for="email">Email:</label>
              <input type="email" id="email" name="email" class="form-input" value="sarah.johnson@medic-office.com" required />
            </div>
            <div class="info-row" style="flex-direction: column; align-items: stretch;">
              <label class="info-label" for="phone">Phone:</label>
              <input type="tel" id="phone" name="phone" class="form-input" value="5551234567" required pattern="[0-9]{10}" />
            </div>
            <div class="info-row" style="flex-direction: column; align-items: stretch;">
              <label class="info-label" for="address">Address:</label>
              <input type="text" id="address" name="address" class="form-input" value="Algiers Medical Center, Cheraga" required />
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
            <div class="info-row" style="flex-direction: column; align-items: stretch;">
              <label class="info-label" for="specialization">Specialization:</label>
              <input type="text" id="specialization" name="specialization" class="form-input" value="Cardiology" required />
            </div>
            <div class="info-row" style="flex-direction: column; align-items: stretch;">
              <label class="info-label" for="license">License Number:</label>
              <input type="text" id="license" name="license" class="form-input" value="MED-2020-789456" required />
            </div>
          </div>
        </div>

        <div class="profile-section">
          <div class="section-header">
            <svg class="section-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
              <path d="M2 17l10 5 10-5"></path>
              <path d="M2 12l10 5 10-5"></path>
            </svg>
            <h2 class="section-title">Administrator Privileges</h2>
          </div>
          <div class="section-content">
            <div class="info-row">
              <span class="info-label">Role:</span>
              <span class="info-value" style="color: #dc2626; font-weight: 700;">System Administrator</span>
            </div>
            <div class="info-row">
              <span class="info-label">Access Level:</span>
              <span class="info-value" style="color: #dc2626; font-weight: 700;">Full Access</span>
            </div>
          </div>
        </div>

        <div class="profile-actions">
          <a href="profileAD.php" class="btn btn-secondary">
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
  <script src="../JS/form_validation.js"></script>
</body>
</html>
