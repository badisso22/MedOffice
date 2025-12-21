<?php
session_start();
if (empty($_SESSION['loggedIn']) || !isset($_SESSION['userID']) || $_SESSION['roleID'] != 2) {
  header('Location: ../Auth/login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Doctor Profile</title>
  <link rel="stylesheet" href="../CSS/profile.css" />
  <link rel="stylesheet" href="../CSS/profile_d.css" />
  <link rel="stylesheet" href="../CSS/doctor_edit.css" />
</head>
<body>
  <div class="edit-wrapper">
    <div class="edit-header">
      <h1 class="edit-title">Edit Doctor Profile</h1>
      <p class="edit-subtitle">Update your professional information</p>
    </div>

    <form class="edit-form" id="doctorEditForm" method="POST" enctype="multipart/form-data">
      
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
            <label for="email" class="form-label">Email <span class="required">*</span></label>
            <input type="email" id="email" name="email" class="form-input" required />
          </div>

          <div class="form-group">
            <label for="phone" class="form-label">Phone Number <span class="required">*</span></label>
            <input type="tel" id="phone" name="phone" class="form-input" required />
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
            <label for="specialty" class="form-label">Specialty <span class="required">*</span></label>
            <select id="specialty" name="specialty" class="form-input" required>
              <option value="">Select Specialty</option>
              <option value="Pediatrician">Pediatrician</option>
              <option value="Cardiology">Cardiologist</option>
              <option value="Dermatology">Dermatologist</option>
              <option value="Neurology">Neurologist</option>
              <option value="Orthopedic">Orthopedic Surgeon</option>
              <option value="General">General Practitioner</option>
            </select>
          </div>

          <div class="form-group">
            <label for="licenseNumber" class="form-label">License Number <span class="required">*</span></label>
            <input type="text" id="licenseNumber" name="licenseNumber" class="form-input" required />
          </div>

          <div class="form-group">
            <label for="experience" class="form-label">Years of Experience <span class="required">*</span></label>
            <input type="number" id="experience" name="experience" class="form-input" min="0" required />
          </div>

          <div class="form-group">
            <label for="consultationFee" class="form-label">Consultation Fee (DZD)</label>
            <input type="number" id="consultationFee" name="consultationFee" class="form-input" min="0" />
          </div>
        </div>
      </div>

      <div class="form-section">
        <h2 class="form-section-title">About</h2>
        <div class="form-group">
          <label for="about" class="form-label">Professional Summary</label>
          <textarea id="about" name="about" class="form-textarea" rows="4"></textarea>
        </div>
      </div>

      <div class="form-section">
        <h2 class="form-section-title">Education</h2>
        <div id="educationContainer">
        </div>
        <button type="button" class="btn-add" onclick="addEducation()">
          <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
          </svg>
          Add Education
        </button>
      </div>

      <div class="form-section">
        <h2 class="form-section-title">Certifications</h2>
        <div id="certificationContainer">
        </div>
        <button type="button" class="btn-add" onclick="addCertification()">
          <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
          </svg>
          Add Certification
        </button>
      </div>

      <div class="form-section">
        <h2 class="form-section-title">Languages</h2>
        <div class="form-group">
          <label class="form-label">Languages Spoken (comma separated)</label>
          <input type="text" id="languages" name="languages" class="form-input"
                 placeholder="e.g., Arabic, French, English" />
        </div>
      </div>

      <div class="form-section">
        <h2 class="form-section-title">Availability</h2>
        <div class="availability-grid" id="availabilityGrid">
        </div>
      </div>

      <div class="form-actions">
        <a href="profileAD.php" class="btn btn-secondary">
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

  <script src="../ajax/admin-edit-profile.js"></script>
</body>
</html>
