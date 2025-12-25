<?php
session_start();
if (empty($_SESSION['loggedIn']) || !isset($_SESSION['userID']) || $_SESSION['roleID'] != 4) {
  header('Location: ../login-forms/login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Assistant Profile</title>
  <link rel="stylesheet" href="../CSS/profile.css" />
  <link rel="stylesheet" href="../CSS/profile_d.css" />
  <link rel="stylesheet" href="../CSS/doctor_edit.css" />
</head>
<body>
  <div class="edit-wrapper">
    <div class="edit-header">
      <h1 class="edit-title">Edit Assistant Profile</h1>
      <p class="edit-subtitle">Update your personal information, skills and availability</p>
    </div>

    <form class="edit-form" id="assistantProfileForm" method="POST" enctype="multipart/form-data">
      <div class="form-section">
        <h2 class="form-section-title">Profile Photo</h2>
        <div class="photo-upload-container">
          <div class="photo-preview">
            <img 
              src="" 
              alt="Profile Photo" 
              id="photoPreview" />
          </div>
          <div class="photo-upload-controls">
            <label for="photoUpload" class="upload-btn">
              <svg class="upload-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                <polyline points="17 8 12 3 7 8"></polyline>
                <line x1="12" y1="3" x2="12" y2="15"></line>
              </svg>
              Choose Photo
            </label>
            <input type="file" id="photoUpload" name="photo" accept="image/*" style="display: none;" />
            <p class="upload-hint">JPG, PNG or GIF (Max 5MB)</p>
          </div>
        </div>
      </div>

      <div class="form-section">
        <h2 class="form-section-title">Personal Information</h2>
        <div class="form-grid">
          <div class="form-group">
            <label for="firstName" class="form-label">First Name <span class="required">*</span></label>
            <input type="text" id="firstName" name="firstName" class="form-input" required />
          </div>
          
          <div class="form-group">
            <label for="lastName" class="form-label">Last Name <span class="required">*</span></label>
            <input type="text" id="lastName" name="lastName" class="form-input" required />
          </div>

          <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-input" disabled />
          </div>

          <div class="form-group">
            <label for="phoneNumber" class="form-label">Phone Number <span class="required">*</span></label>
            <input type="tel" id="phoneNumber" name="phoneNumber" class="form-input" required />
          </div>

          <div class="form-group full-width">
            <label for="address" class="form-label">Address</label>
            <input type="text" id="address" name="address" class="form-input" />
          </div>
        </div>
      </div>

      <div class="form-section">
        <h2 class="form-section-title">Professional Information</h2>
        <div class="form-grid">
          <div class="form-group">
            <label for="yearsExperience" class="form-label">Years of Experience</label>
            <input type="number" id="yearsExperience" name="yearsExperience" class="form-input" min="0" />
          </div>

          <div class="form-group">
            <label for="employeeCode" class="form-label">Employee Code</label>
            <input type="text" id="employeeCode" name="employeeCode" class="form-input" />
          </div>

          <div class="form-group">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-input">
              <option value="available">Available</option>
              <option value="busy">Busy</option>
              <option value="off_duty">Off duty</option>
            </select>
          </div>
        </div>
      </div>

      <div class="form-section">
        <h2 class="form-section-title">Skills</h2>
        <div class="form-group">
          <label class="form-label">Skills (comma separated)</label>
          <input
            type="text"
            id="skillsInput"
            name="skillsInput"
            class="form-input"
            placeholder="e.g., Patient care, Communication, EHR Management"
          />
        </div>
      </div>

      <div class="form-section">
        <h2 class="form-section-title">Availability</h2>
        <div class="availability-grid" id="availabilityGrid">
          <?php
            $days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
            foreach ($days as $day) {
          ?>
          <div class="availability-row" data-day="<?php echo $day; ?>">
            <div class="availability-day"><?php echo $day; ?></div>
            <div class="availability-controls">
              <label class="availability-checkbox">
                <input type="checkbox" class="day-available" />
                <span>Available</span>
              </label>
              <div class="time-range">
                <input type="time" class="form-input day-start" />
                <span class="time-separator">–</span>
                <input type="time" class="form-input day-end" />
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>

      <div class="form-actions">
        <a href="profileA.php" class="btn btn-secondary">
          <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 6L6 18M6 6l12 12"></path>
          </svg>
          Cancel
        </a>
        <button type="submit" class="btn btn-primary">
          <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
            <polyline points="17 21 17 13 7 13 7 21"></polyline>
            <polyline points="7 3 7 8 15 8"></polyline>
          </svg>
          Save Changes
        </button>
      </div>
    </form>
  </div>

  <script src="../ajax/assistant-edit-profile.js"></script>
</body>
</html>
