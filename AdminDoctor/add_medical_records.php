<?php
session_start();
require '../config/config.php';

$patientID = isset($_GET['patientID']) ? (int)$_GET['patientID'] : 0;
if ($patientID <= 0) {
    die('Invalid patient ID');
}

if (!$conn instanceof mysqli) {
    die('Database connection error');
}

$sql = "
    SELECT 
        p.patientID,
        p.firstname,
        p.lastname,
        p.dateofbirth,
        p.gender,
        p.phonenumber,
        u.email
    FROM PatientTable p
    LEFT JOIN Users u ON u.userID = p.userID
    WHERE p.patientID = ?
    LIMIT 1
";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $patientID);
$stmt->execute();
$res = $stmt->get_result();
$patient = $res->fetch_assoc();
$stmt->close();

if (!$patient) {
    die('Patient not found');
}

$fullName    = htmlspecialchars($patient['firstname'] . ' ' . $patient['lastname'], ENT_QUOTES, 'UTF-8');
$patientCode = '#P-' . str_pad($patient['patientID'], 4, '0', STR_PAD_LEFT);
$dobValue    = $patient['dateofbirth'];
$genderValue = $patient['gender'];
$phoneValue  = $patient['phonenumber'];
$emailValue  = $patient['email'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Medical Record - MedOffice</title>
  <link rel="stylesheet" href="../CSS/general.css" />
  <link rel="stylesheet" href="../CSS/add_records.css" />
  <link rel="stylesheet" href="../CSS/form_validation.css"/>
  <style>
    .page-shell {
      max-width: 1120px;
      margin: 0 auto;
      padding: 2rem 1.5rem 4rem;
    }
    .page-container {
      width: 100%;
    }
  </style>
</head>
<body>
  <nav>
        <div class="nav-container">
            <button class="drawer-toggle" onclick="toggleDrawer()">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <a href="#" class="logo">
                <div class="logo-icon">⚕</div>
                MedOffice
            </a>
            <div class="nav-cta">
                <span class="user-name">Dr. <?= htmlspecialchars($fullname ?? 'User') ?></span>
                <div class="top-icons">
                    <a href="messages.php" class="icon-btn" title="Chat">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                    </a>
                    <a href="notifications.php" class="icon-btn" title="Notifications">
                        <svg viewBox="0 0 24 24">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span class="notification-badge">3</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

  <main class="page-shell">
    <div class="page-container">
      <div class="page-header">
        <h1>Add Medical Record</h1>
        <p>Create a new medical record for <strong><?php echo $fullName; ?></strong>. All fields marked with <strong>*</strong> are required.</p>
      </div>

      <div class="info-box">
        <div class="info-box-icon">ℹ</div>
        <div class="info-box-content">
          <p><strong>HIPAA Compliant:</strong> Ensure all patient information is accurate and complete. Medical records are securely stored and comply with all regulatory requirements.</p>
        </div>
      </div>

      <form class="form-card" id="add-record-form" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="patient_id" value="<?php echo (int)$patientID; ?>">

        <div class="form-section">
          <h2 class="section-title"> Patient Information</h2>

          <div class="form-row">
            <div class="form-group required">
              <label for="patient-id">Patient ID</label>
              <input type="text" id="patient-id" value="<?php echo htmlspecialchars($patientCode, ENT_QUOTES, 'UTF-8'); ?>" disabled />
              <span class="form-help">Unique patient identifier</span>
            </div>
            <div class="form-group required">
              <label for="patient-name">Patient Name</label>
              <input type="text" id="patient-name" value="<?php echo $fullName; ?>" disabled />
            </div>
          </div>

          <div class="form-row">
            <div class="form-group required">
              <label for="dob">Date of Birth</label>
              <input type="date" id="dob" value="<?php echo htmlspecialchars($dobValue, ENT_QUOTES, 'UTF-8'); ?>" disabled />
            </div>
            <div class="form-group required">
              <label for="gender">Gender</label>
              <select id="gender" disabled>
                <option value="">Select gender</option>
                <option value="male"   <?php echo $genderValue === 'male'   ? 'selected' : ''; ?>>Male</option>
                <option value="female" <?php echo $genderValue === 'female' ? 'selected' : ''; ?>>Female</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="phone">Phone Number</label>
              <input type="tel" id="phone" value="<?php echo htmlspecialchars($phoneValue, ENT_QUOTES, 'UTF-8'); ?>" disabled />
            </div>
            <div class="form-group">
              <label for="email">Email Address</label>
              <input type="email" id="email" value="<?php echo htmlspecialchars($emailValue, ENT_QUOTES, 'UTF-8'); ?>" disabled />
            </div>
          </div>
        </div>

        <div class="form-section">
          <h2 class="section-title">Record Details</h2>

          <div class="form-row">
            <div class="form-group required">
              <label for="record-type">Record Type</label>
              <select id="record-type" name="consultationtype" required>
                <option value="">Select record type</option>
                <option value="Check-up">Check-up</option>
                <option value="Follow-up">Follow-up</option>
                <option value="Emergency">Emergency</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="form-group required">
              <label for="record-date">Record Date</label>
              <input type="date" id="record-date" name="consultationdate" required />
            </div>
          </div>
        </div>

        <div class="form-section">
          <h2 class="section-title"> Clinical Information</h2>

          <div class="form-row full">
            <div class="form-group required">
              <label for="summary">Summary (Symptoms)</label>
              <textarea id="summary" name="symptoms" placeholder="Brief summary of the visit and main complaints..." required></textarea>
              <span class="form-help">Provide a concise overview of the visit</span>
            </div>
          </div>

          <div class="form-row full">
            <div class="form-group required">
              <label for="diagnosis">Diagnosis</label>
              <textarea id="diagnosis" name="diagnosis" placeholder="e.g., Type 2 Diabetes, Hypertension Stage 1" required></textarea>
            </div>
          </div>

          <div class="form-row full">
            <div class="form-group required">
              <label for="treatment">Treatment Plan</label>
              <textarea id="treatment" name="treatmentplan" placeholder="Medications, lifestyle changes, follow-up instructions..." required></textarea>
            </div>
          </div>

          <div class="form-row full">
            <div class="form-group">
              <label for="details">Additional Notes</label>
              <textarea id="details" name="additionalnotes" placeholder="Optional detailed clinical notes..."></textarea>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="next-appointment">Next Appointment Date</label>
              <input type="date" id="next-appointment" name="nextappointment" />
            </div>
            <div class="form-group">
              <label for="fees">Medical Fees (optional)</label>
              <input type="number" id="fees" name="medicalfees" step="0.01" min="0" placeholder="e.g., 150.00" />
            </div>
          </div>
        </div>

        <div class="form-section">
          <h2 class="section-title"> Attachments (Optional)</h2>

          <div class="form-row full">
            <div class="form-group">
              <label for="attachments">Upload Files</label>
              <input type="file" id="attachments" name="summaryfile" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" />
              <span class="form-help">Supported formats: PDF, JPG, PNG, DOC, DOCX (Max 10MB per file)</span>
            </div>
          </div>
        </div>
        <div class="form-actions">
          <a href="view_records.php?patientID=<?php echo $patientID; ?>" class="btn btn-secondary-outline">Cancel</a>
          <button type="reset" class="btn btn-secondary-outline">Clear Form</button>
          <button type="submit" class="btn btn-primary">Save Medical Record</button>
        </div>
      </form>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 MedOffice. All rights reserved. HIPAA-compliant medical practice management.</p>
  </footer>
  <script src="../JS/form_validation.js"></script>
  <script src="../ajax/add_medical_record.js"></script>
</body>
</html>
