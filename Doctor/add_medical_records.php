<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Medical Record - MedOffice</title>
  <link rel="stylesheet" href="../CSS/general.css" />
  <link rel="stylesheet" href="../CSS/add_records.css" />
  <link rel="stylesheet" href="../CSS/form_validation.css"/>
</head>
<body>
  <nav>
    <div class="nav-container">
      <a href="medical_records.php" class="logo">
        <div class="logo-icon">⚕</div>
        MedOffice
      </a>
      <div class="nav-cta">
        <span class="user-name">Dr. John Doe</span>
        <a href="logout.php" class="btn btn-secondary">Logout</a>
      </div>
    </div>
  </nav>
  <div class="page-container">
    <div class="page-header">
      <h1>Add Medical Record</h1>
      <p>Create a new medical record for a patient. All fields marked with <strong>*</strong> are required.</p>
    </div>
    <div class="info-box">
      <div class="info-box-icon">ℹ</div>
      <div class="info-box-content">
        <p><strong>HIPAA Compliant:</strong> Ensure all patient information is accurate and complete. Medical records are securely stored and comply with all regulatory requirements.</p>
      </div>
    </div>
    <form class="form-card" action="save-medical-record.php" method="POST">
      <div class="form-section">
        <h2 class="section-title"> Patient Information</h2>
        
        <div class="form-row">
          <div class="form-group required">
            <label for="patient-id">Patient ID</label>
            <input type="text" id="patient-id" name="patient_id" placeholder="e.g., P-2025-001" required />
            <span class="form-help">Unique patient identifier</span>
          </div>
          <div class="form-group required">
            <label for="patient-name">Patient Name</label>
            <input type="text" id="patient-name" name="patient_name" placeholder="Full name" required />
          </div>
        </div>

        <div class="form-row">
          <div class="form-group required">
            <label for="dob">Date of Birth</label>
            <input type="date" id="dob" name="dob" required />
          </div>
          <div class="form-group required">
            <label for="gender">Gender</label>
            <select id="gender" name="gender" required>
              <option value="">Select gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" placeholder="+1 (555) 000-0000" />
          </div>
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="patient@example.com" />
          </div>
        </div>
      </div>
      <div class="form-section">
        <h2 class="section-title">Record Details</h2>
        
        <div class="form-row">
          <div class="form-group required">
            <label for="record-type">Record Type</label>
            <select id="record-type" name="record_type" required>
              <option value="">Select record type</option>
              <option value="lab">Lab Results</option>
              <option value="prescription">Prescription</option>
              <option value="diagnosis">Diagnosis</option>
              <option value="imaging">Imaging</option>
              <option value="consultation">Consultation</option>
              <option value="surgery">Surgery</option>
              <option value="vaccination">Vaccination</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div class="form-group required">
            <label for="record-date">Record Date</label>
            <input type="date" id="record-date" name="record_date" required />
          </div>
        </div>

        <div class="form-row">
          <div class="form-group required">
            <label for="provider">Doctor/Provider</label>
            <input type="text" id="provider" name="provider" placeholder="Dr. Name" required />
          </div>
          <div class="form-group">
            <label for="department">Department</label>
            <input type="text" id="department" name="department" placeholder="e.g., Cardiology" />
          </div>
        </div>
      </div>
      <div class="form-section">
        <h2 class="section-title"> Clinical Information</h2>
        
        <div class="form-row full">
          <div class="form-group required">
            <label for="summary">Summary</label>
            <textarea id="summary" name="summary" placeholder="Brief summary of the medical record..." required></textarea>
            <span class="form-help">Provide a concise overview of the record</span>
          </div>
        </div>

        <div class="form-row full">
          <div class="form-group">
            <label for="details">Detailed Notes</label>
            <textarea id="details" name="details" placeholder="Additional clinical details, observations, and findings..."></textarea>
            <span class="form-help">Optional detailed information</span>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="diagnosis">Diagnosis (if applicable)</label>
            <input type="text" id="diagnosis" name="diagnosis" placeholder="e.g., Type 2 Diabetes" />
          </div>
          <div class="form-group">
            <label for="treatment">Treatment/Recommendation</label>
            <input type="text" id="treatment" name="treatment" placeholder="e.g., Medication, Follow-up required" />
          </div>
        </div>
      </div>
      <div class="form-section">
        <h2 class="section-title"> Vital Signs (Optional)</h2>
        
        <div class="form-row">
          <div class="form-group">
            <label for="blood-pressure">Blood Pressure (mmHg)</label>
            <input type="text" id="blood-pressure" name="blood_pressure" placeholder="e.g., 120/80" />
          </div>
          <div class="form-group">
            <label for="heart-rate">Heart Rate (bpm)</label>
            <input type="number" id="heart-rate" name="heart_rate" placeholder="e.g., 72" min="0" />
          </div>
          <div class="form-group">
            <label for="temperature">Temperature (°F)</label>
            <input type="number" id="temperature" name="temperature" placeholder="e.g., 98.6" step="0.1" min="0" />
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="weight">Weight (lbs)</label>
            <input type="number" id="weight" name="weight" placeholder="e.g., 170" min="0" />
          </div>
          <div class="form-group">
            <label for="height">Height (inches)</label>
            <input type="number" id="height" name="height" placeholder="e.g., 70" min="0" />
          </div>
        </div>
      </div>
      <div class="form-section">
        <h2 class="section-title"> Attachments (Optional)</h2>
        
        <div class="form-row full">
          <div class="form-group">
            <label for="attachments">Upload Files</label>
            <input type="file" id="attachments" name="attachments" multiple accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" />
            <span class="form-help">Supported formats: PDF, JPG, PNG, DOC, DOCX (Max 10MB per file)</span>
          </div>
        </div>
      </div>
      <div class="form-section">
        <h2 class="section-title">✓ Confidentiality & Consent</h2>
        
        <div class="checkbox-group">
          <div class="checkbox-item">
            <input type="checkbox" id="hipaa-compliance" name="hipaa_compliance" required />
            <label for="hipaa-compliance">I confirm this record complies with HIPAA regulations</label>
          </div>
          <div class="checkbox-item">
            <input type="checkbox" id="patient-consent" name="patient_consent" required />
            <label for="patient-consent">Patient consent has been obtained for this record</label>
          </div>
          <div class="checkbox-item">
            <input type="checkbox" id="accuracy-confirm" name="accuracy_confirm" required />
            <label for="accuracy-confirm">I confirm the accuracy of all information provided</label>
          </div>
        </div>
      </div>
      <div class="form-actions">
        <a href="view_records.php" class="btn btn-secondary-outline">Cancel</a>
        <button type="reset" class="btn btn-secondary-outline">Clear Form</button>
        <button type="submit" class="btn btn-primary">Save Medical Record</button>
      </div>
    </form>
  </div>
  <footer>
    <p>&copy; 2025 MedOffice. All rights reserved. HIPAA-compliant medical practice management.</p>
  </footer>
  <script src="../JS/form_validation.js"></script>
</body>
</html>
