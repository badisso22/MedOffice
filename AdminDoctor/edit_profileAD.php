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
      
      <!-- Profile Photo Section -->
      <div class="form-section">
        <h2 class="form-section-title">Profile Photo</h2>
        <div class="photo-upload-container">
          <div class="photo-preview">
            <img src="https://ui-avatars.com/api/?name=Dr.+Fatima+Khelifi&background=06b6d4&color=fff&size=200" 
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

      <!-- Personal Information Section -->
      <div class="form-section">
        <h2 class="form-section-title">Personal Information</h2>
        <div class="form-grid">
          <div class="form-group">
            <label for="firstName" class="form-label">First Name <span class="required">*</span></label>
            <input type="text" id="firstName" name="firstName" class="form-input" value="Fatima" required />
          </div>
          
          <div class="form-group">
            <label for="lastName" class="form-label">Last Name <span class="required">*</span></label>
            <input type="text" id="lastName" name="lastName" class="form-input" value="Khelifi" required />
          </div>

          <div class="form-group">
            <label for="email" class="form-label">Email <span class="required">*</span></label>
            <input type="email" id="email" name="email" class="form-input" value="f.khelifi@hospital.dz" required />
          </div>

          <div class="form-group">
            <label for="phone" class="form-label">Phone Number <span class="required">*</span></label>
            <input type="tel" id="phone" name="phone" class="form-input" value="+213 555 123 456" required />
          </div>

          <div class="form-group full-width">
            <label for="address" class="form-label">Address</label>
            <input type="text" id="address" name="address" class="form-input" value="123 Medical Boulevard, Algiers" />
          </div>
        </div>
      </div>

      <!-- Professional Information Section -->
      <div class="form-section">
        <h2 class="form-section-title">Professional Information</h2>
        <div class="form-grid">
          <div class="form-group">
            <label for="specialty" class="form-label">Specialty <span class="required">*</span></label>
            <select id="specialty" name="specialty" class="form-input" required>
              <option value="">Select Specialty</option>
              <option value="Pediatrician" selected>Pediatrician</option>
              <option value="Cardiologist">Cardiologist</option>
              <option value="Dermatologist">Dermatologist</option>
              <option value="Neurologist">Neurologist</option>
              <option value="Orthopedic">Orthopedic Surgeon</option>
              <option value="General">General Practitioner</option>
            </select>
          </div>

          <div class="form-group">
            <label for="licenseNumber" class="form-label">License Number <span class="required">*</span></label>
            <input type="text" id="licenseNumber" name="licenseNumber" class="form-input" value="MED-DZ-2015-789" required />
          </div>

          <div class="form-group">
            <label for="experience" class="form-label">Years of Experience <span class="required">*</span></label>
            <input type="number" id="experience" name="experience" class="form-input" value="12" min="0" required />
          </div>

          <div class="form-group">
            <label for="consultationFee" class="form-label">Consultation Fee (DZD)</label>
            <input type="number" id="consultationFee" name="consultationFee" class="form-input" value="3000" min="0" />
          </div>
        </div>
      </div>

      <!-- About Section -->
      <div class="form-section">
        <h2 class="form-section-title">About</h2>
        <div class="form-group">
          <label for="about" class="form-label">Professional Summary</label>
          <textarea id="about" name="about" class="form-textarea" rows="4" 
            placeholder="Tell patients about yourself and your approach to care...">Dr. Khelifi is dedicated to providing compassionate care to children of all ages. She has extensive experience in pediatric care and child development.</textarea>
        </div>
      </div>

      <!-- Education Section -->
      <div class="form-section">
        <h2 class="form-section-title">Education</h2>
        <div id="educationContainer">
          <div class="education-item">
            <div class="form-grid">
              <div class="form-group">
                <label class="form-label">Degree <span class="required">*</span></label>
                <input type="text" name="education_degree[]" class="form-input" value="Medical Degree" required />
              </div>
              <div class="form-group">
                <label class="form-label">Institution <span class="required">*</span></label>
                <input type="text" name="education_institution[]" class="form-input" value="University of Constantine" required />
              </div>
              <div class="form-group">
                <label class="form-label">Year</label>
                <input type="number" name="education_year[]" class="form-input" value="2011" min="1950" max="2025" />
              </div>
              <div class="form-group">
                <button type="button" class="btn-remove" onclick="removeEducation(this)">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                  </svg>
                </button>
              </div>
            </div>
          </div>

          <div class="education-item">
            <div class="form-grid">
              <div class="form-group">
                <label class="form-label">Degree <span class="required">*</span></label>
                <input type="text" name="education_degree[]" class="form-input" value="Pediatrics Specialization" required />
              </div>
              <div class="form-group">
                <label class="form-label">Institution <span class="required">*</span></label>
                <input type="text" name="education_institution[]" class="form-input" value="CHU Algiers" required />
              </div>
              <div class="form-group">
                <label class="form-label">Year</label>
                <input type="number" name="education_year[]" class="form-input" value="2015" min="1950" max="2025" />
              </div>
              <div class="form-group">
                <button type="button" class="btn-remove" onclick="removeEducation(this)">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>
        <button type="button" class="btn-add" onclick="addEducation()">
          <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
          </svg>
          Add Education
        </button>
      </div>

      <!-- Certifications Section -->
      <div class="form-section">
        <h2 class="form-section-title">Certifications</h2>
        <div id="certificationContainer">
          <div class="certification-item">
            <div class="form-grid">
              <div class="form-group">
                <label class="form-label">Certification Name</label>
                <input type="text" name="certification_name[]" class="form-input" value="Board Certified Pediatrician" />
              </div>
              <div class="form-group">
                <label class="form-label">Issuing Organization</label>
                <input type="text" name="certification_org[]" class="form-input" value="Algerian Medical Board" />
              </div>
              <div class="form-group">
                <label class="form-label">Year</label>
                <input type="number" name="certification_year[]" class="form-input" value="2016" min="1950" max="2025" />
              </div>
              <div class="form-group">
                <button type="button" class="btn-remove" onclick="removeCertification(this)">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>
        <button type="button" class="btn-add" onclick="addCertification()">
          <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
          </svg>
          Add Certification
        </button>
      </div>

      <!-- Languages Section -->
      <div class="form-section">
        <h2 class="form-section-title">Languages</h2>
        <div class="form-group">
          <label class="form-label">Languages Spoken (comma separated)</label>
          <input type="text" name="languages" class="form-input" value="Arabic, French, English" 
                 placeholder="e.g., Arabic, French, English" />
        </div>
      </div>

      <!-- Availability Section -->
      <div class="form-section">
        <h2 class="form-section-title">Availability</h2>
        <div class="availability-grid">
          <div class="availability-item">
            <label class="availability-label">
              <input type="checkbox" name="days[]" value="Monday" />
              <span>Monday</span>
            </label>
            <div class="time-inputs">
              <input type="time" name="monday_start" class="time-input" />
              <span>to</span>
              <input type="time" name="monday_end" class="time-input" />
            </div>
          </div>

          <div class="availability-item">
            <label class="availability-label">
              <input type="checkbox" name="days[]" value="Tuesday" checked />
              <span>Tuesday</span>
            </label>
            <div class="time-inputs">
              <input type="time" name="tuesday_start" class="time-input" value="10:00" />
              <span>to</span>
              <input type="time" name="tuesday_end" class="time-input" value="18:00" />
            </div>
          </div>

          <div class="availability-item">
            <label class="availability-label">
              <input type="checkbox" name="days[]" value="Wednesday" />
              <span>Wednesday</span>
            </label>
            <div class="time-inputs">
              <input type="time" name="wednesday_start" class="time-input" />
              <span>to</span>
              <input type="time" name="wednesday_end" class="time-input" />
            </div>
          </div>

          <div class="availability-item">
            <label class="availability-label">
              <input type="checkbox" name="days[]" value="Thursday" checked />
              <span>Thursday</span>
            </label>
            <div class="time-inputs">
              <input type="time" name="thursday_start" class="time-input" value="10:00" />
              <span>to</span>
              <input type="time" name="thursday_end" class="time-input" value="18:00" />
            </div>
          </div>

          <div class="availability-item">
            <label class="availability-label">
              <input type="checkbox" name="days[]" value="Friday" />
              <span>Friday</span>
            </label>
            <div class="time-inputs">
              <input type="time" name="friday_start" class="time-input" />
              <span>to</span>
              <input type="time" name="friday_end" class="time-input" />
            </div>
          </div>

          <div class="availability-item">
            <label class="availability-label">
              <input type="checkbox" name="days[]" value="Saturday" checked />
              <span>Saturday</span>
            </label>
            <div class="time-inputs">
              <input type="time" name="saturday_start" class="time-input" value="09:00" />
              <span>to</span>
              <input type="time" name="saturday_end" class="time-input" value="14:00" />
            </div>
          </div>

          <div class="availability-item">
            <label class="availability-label">
              <input type="checkbox" name="days[]" value="Sunday" />
              <span>Sunday</span>
            </label>
            <div class="time-inputs">
              <input type="time" name="sunday_start" class="time-input" />
              <span>to</span>
              <input type="time" name="sunday_end" class="time-input" />
            </div>
          </div>
        </div>
      </div>

      <!-- Form Actions -->
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

</body>
</html>
