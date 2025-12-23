<?php
session_start();

$appointmentID = isset($_GET['appointmentID']) ? (int)$_GET['appointmentID'] : 0;
$patientID = isset($_GET['patientID']) ? (int)$_GET['patientID'] : 0;

if ($appointmentID <= 0 || $patientID <= 0) {
    die('Invalid appointment or patient ID');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation - MedOffice</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="../CSS/consultation.css">
    <link rel="stylesheet" href="../CSS/admin_modals.css">
</head>
<body>
    <nav>
        <div class="nav-container">
            <a href="appointments.php" class="back-btn">
                <svg viewBox="0 0 24 24" width="20" height="20">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Back to Appointments
            </a>
            <a href="#" class="logo">
                <div class="logo-icon">⚕</div>
                MedOffice
            </a>
            <div class="nav-cta">
                <span class="user-name">Dr. John Doe</span>
            </div>
        </div>
    </nav>

    <main class="consultation-main">
        <section class="consultation-header">
            <h1>Active Consultation</h1>
            <div class="consultation-badge">In Progress</div>
        </section>

        <div class="patient-info-card">
            <div class="patient-header">
                <div class="patient-avatar" id="patient-avatar">—</div>
                <div class="patient-details">
                    <h2 id="patient-name">Loading...</h2>
                    <p id="patient-meta">Patient ID: — • Age: — • Gender: —</p>
                </div>
            </div>
            <div class="patient-vitals">
                <div class="vital-item">
                    <span class="vital-label">Phone:</span>
                    <span class="vital-value" id="patient-phone">—</span>
                </div>
                <div class="vital-item">
                    <span class="vital-label">Address:</span>
                    <span class="vital-value" id="patient-address">—</span>
                </div>
                <div class="vital-item">
                    <span class="vital-label">Email:</span>
                    <span class="vital-value" id="patient-email">—</span>
                </div>
            </div>
        </div>

        <div class="appointment-info-card">
            <h3>Appointment Details</h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Date:</span>
                    <span class="info-value" id="appointment-date">—</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Time:</span>
                    <span class="info-value" id="appointment-time">—</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Purpose:</span>
                    <span class="info-value" id="appointment-purpose">—</span>
                </div>
            </div>
        </div>

        <div class="consultation-form-card">
            <h3>Generate Consultation Record</h3>
            <form id="consultationForm">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="consultationType">Consultation Type <span class="required">*</span></label>
                        <select id="consultationType" name="consultationType" required>
                            <option value="">Select type</option>
                            <option value="Check-up">Check-up</option>
                            <option value="Follow-up">Follow-up</option>
                            <option value="Emergency">Emergency</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="consultationDate">Consultation Date <span class="required">*</span></label>
                        <input type="date" id="consultationDate" name="consultationDate" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="symptoms">Symptoms <span class="required">*</span></label>
                    <textarea id="symptoms" name="symptoms" rows="3" placeholder="Describe the patient's symptoms..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="diagnosis">Diagnosis <span class="required">*</span></label>
                    <textarea id="diagnosis" name="diagnosis" rows="3" placeholder="Enter diagnosis..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="treatmentPlan">Treatment Plan <span class="required">*</span></label>
                    <textarea id="treatmentPlan" name="treatmentPlan" rows="3" placeholder="Describe treatment plan..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="additionalNotes">Additional Notes <span class="required">*</span></label>
                    <textarea id="additionalNotes" name="additionalNotes" rows="3" placeholder="Any additional observations..." required></textarea>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="nextAppointment">Next Appointment Date <span class="required">*</span></label>
                        <input type="date" id="nextAppointment" name="nextAppointment" required>
                    </div>

                    <div class="form-group">
                        <label for="medicalFees">Consultation Fees (DZD)</label>
                        <input type="number" id="medicalFees" name="medicalFees" placeholder="0.00" step="0.01" min="0">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='appointments.php'">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save & End Consultation</button>
                </div>
            </form>
        </div>
    </main>

    <div id="successConsultationModal" class="modal">
        <div class="modal-content">
            <div class="modal-icon success">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>
            <div class="modal-header">
                <h2>Consultation Completed</h2>
            </div>
            <div class="modal-body">
                <p>The consultation record has been saved and the appointment marked as completed.</p>
            </div>
            <div class="modal-actions">
                <button onclick="window.location.href='appointments.php'" class="btn btn-primary">Back to Appointments</button>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-bottom">
            <p>&copy; 2025 MedOffice. All rights reserved.</p>
        </div>
    </footer>

    <script src="../ajax/consultation.js"></script>
</body>
</html>
