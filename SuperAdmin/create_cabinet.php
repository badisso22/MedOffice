<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create New Cabinet - Super Admin</title>
  <link rel="stylesheet" href="../CSS/form_validation.css" />
  <link rel="stylesheet" href="../CSS/superadmin.css" />
</head>
<body>
  <div class="main-content" style="margin-left:0; padding:0; display:flex; align-items:center; justify-content:center; min-height:100vh;">
    <div id="step1" class="wizard-step active">
      <div class="modal-content" style="position:relative; max-width:600px; margin:2rem;">
        <div class="modal-header">
          <h2>Create New Cabinet</h2>
          <p style="color:var(--text-tertiary); font-size:0.9rem; margin-top:0.5rem;">
            Step 1 of 2: Cabinet Information
          </p>
        </div>

        <div class="modal-body">
          <form id="cabinetInfoForm" novalidate>
            <div class="form-group">
              <label for="cabinetName">Cabinet Name *</label>
              <input type="text" id="cabinetName" name="cabinetName" placeholder="e.g., MedCare Clinic" required />
            </div>

            <div class="form-group">
              <label for="cabinetLocation">Location *</label>
              <input type="text" id="cabinetLocation" name="cabinetLocation" placeholder="Full address" required />
            </div>

            <div class="form-group">
              <label for="cabinetPhone">Phone Number *</label>
              <input type="tel" id="cabinetPhone" name="cabinetPhone" placeholder="1234567890" required pattern="[0-9]{10}" />
              <small style="color:var(--text-tertiary); font-size:0.85rem;">10 digits.</small>
            </div>

            <div class="form-group">
              <label for="cabinetEmail">Email *</label>
              <input type="email" id="cabinetEmail" name="cabinetEmail" placeholder="contact@cabinet.com" required />
            </div>

            <div class="form-group">
              <label for="cabinetSpecialties">Specialties *</label>
              <input type="text" id="cabinetSpecialties" name="cabinetSpecialties" placeholder="e.g., Cardiology, Pediatrics" required />
              <small style="color:var(--text-tertiary); font-size:0.85rem;">Separate multiple specialties with commas.</small>
            </div>

            <div class="form-group">
              <label for="cabinetCapacity">Maximum Capacity *</label>
              <input type="number" id="cabinetCapacity" name="cabinetCapacity" min="1" placeholder="e.g., 50" required />
            </div>

            <div class="form-group">
              <label for="cabinetDescription">Description</label>
              <textarea id="cabinetDescription" name="cabinetDescription" rows="3" placeholder="Brief description of the cabinet"></textarea>
            </div>

            <div class="modal-actions">
              <button type="button" class="btn-secondary" onclick="window.location.href='cabinets.php'">Cancel</button>
              <button type="submit" class="btn-primary">Continue to Admin Setup</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div id="loading1" class="wizard-step">
      <div class="loading-container">
        <div class="loading-spinner"></div>
        <h2 style="margin-top:2rem; font-size:1.5rem;">Building Your Cabinet</h2>
        <p style="color:var(--text-tertiary); margin-top:0.5rem;">Please wait while we set up your medical cabinet...</p>
      </div>
    </div>

    <div id="step2" class="wizard-step">
      <div class="modal-content" style="position:relative; max-width:600px; margin:2rem;">
        <div class="modal-header">
          <h2>Create Admin Account</h2>
          <p style="color:var(--text-tertiary); font-size:0.9rem; margin-top:0.5rem;">
            Step 2 of 2: Administrator Setup
          </p>
        </div>

        <div class="modal-body">
          <form id="adminAccountForm" novalidate>
            <div class="form-group">
              <label for="adminUsername">Username *</label>
              <input type="text" id="adminUsername" name="adminUsername" placeholder="Admin username" required />
            </div>

            <div class="form-group">
              <label for="adminEmail">Email *</label>
              <input type="email" id="adminEmail" name="adminEmail" placeholder="admin@cabinet.com" required />
            </div>

            <div class="form-group">
              <label for="adminFirstName">First Name *</label>
              <input type="text" id="adminFirstName" name="adminFirstName" placeholder="First name" required />
            </div>

            <div class="form-group">
              <label for="adminLastName">Last Name *</label>
              <input type="text" id="adminLastName" name="adminLastName" placeholder="Last name" required />
            </div>

            <div class="form-group">
              <label for="adminPhone">Phone Number *</label>
              <input type="tel" id="adminPhone" name="adminPhone" placeholder="1234567890" required pattern="[0-9]{10}" />
              <small style="color:var(--text-tertiary); font-size:0.85rem;">10 digits.</small>
            </div>

            <div class="form-group">
              <label for="adminPassword">Password *</label>
              <input type="password" id="adminPassword" name="adminPassword" placeholder="Create strong password" required minlength="8" />
            </div>

            <div class="form-group">
              <label for="adminConfirmPassword">Confirm Password *</label>
              <input type="password" id="adminConfirmPassword" name="adminConfirmPassword" placeholder="Confirm password" required minlength="8" />
            </div>

            <div class="modal-actions">
              <button type="button" class="btn-secondary" onclick="goBackToStep1()">Back</button>
              <button type="submit" class="btn-success">Create Cabinet</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div id="loading2" class="wizard-step">
      <div class="loading-container">
        <div class="loading-spinner"></div>
        <h2 style="margin-top:2rem; font-size:1.5rem;">Finalizing Setup</h2>
        <p style="color:var(--text-tertiary); margin-top:0.5rem;">Creating admin account and configuring permissions...</p>
      </div>
    </div>

    <div id="success" class="wizard-step">
      <div class="success-container">
        <div class="success-icon">
          <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
          </svg>
        </div>

        <h2 style="margin-top:2rem; font-size:2rem;">Cabinet Created Successfully!</h2>

        <p style="color:var(--text-tertiary); margin-top:1rem; font-size:1.1rem;">
          Your cabinet "<span id="successCabinetName" style="color:var(--primary); font-weight:600;"></span>" is now ready to configure.
        </p>

        <div style="margin-top:2rem; padding:1.5rem; background:var(--bg-card); border:1px solid var(--border); border-radius:12px; text-align:left;">
          <h3 style="font-size:1.1rem; margin-bottom:1rem; color:var(--text-primary);">Next Steps:</h3>
          <ul style="list-style:none; padding:0;">
            <li style="padding:0.5rem 0; color:var(--text-secondary); display:flex; align-items:center; gap:0.75rem;">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="20 6 9 17 4 12"></polyline>
              </svg>
              Configure cabinet settings and policies
            </li>
            <li style="padding:0.5rem 0; color:var(--text-secondary); display:flex; align-items:center; gap:0.75rem;">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="20 6 9 17 4 12"></polyline>
              </svg>
              Add doctors and medical staff
            </li>
            <li style="padding:0.5rem 0; color:var(--text-secondary); display:flex; align-items:center; gap:0.75rem;">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="20 6 9 17 4 12"></polyline>
              </svg>
              Set up appointment schedules
            </li>
            <li style="padding:0.5rem 0; color:var(--text-secondary); display:flex; align-items:center; gap:0.75rem;">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="20 6 9 17 4 12"></polyline>
              </svg>
              Start accepting patient registrations
            </li>
          </ul>
        </div>

        <div style="margin-top:2rem; display:flex; gap:1rem; justify-content:center;">
          <button class="btn-primary" onclick="window.location.href='cabinets.php'">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
              <line x1="9" y1="3" x2="9" y2="21"></line>
            </svg>
            View All Cabinets
          </button>
          <button class="btn-secondary" onclick="window.location.href='dashboard_superadmin.php'">
            Go to Dashboard
          </button>
        </div>
      </div>
    </div>
  </div>

  <script src="../JS/form_validation.js"></script>
  <script src="../ajax/superadmin_create_cabinet.js"></script>
</body>
</html>
