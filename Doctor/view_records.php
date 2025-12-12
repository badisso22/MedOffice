<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Records - MedOffice</title>
    <link rel="stylesheet" href="../CSS/view_records.css" />
</head>
<body>
    <div class="records-container">
        <a href="view_patient.php" class="back-button">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Back to Patient
        </a>

        <div class="records-header">
            <h1>Medical Records</h1>
            <a href="add_medical_records.php" class="add-record-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Add Record
            </a>
        </div>
        <div class="patient-info-card">
            <div class="patient-avatar">SM</div>
            <div class="patient-details">
                <h2>Sarah Mitchell</h2>
                <p><strong>Patient ID:</strong> #P-2847</p>
                <p><strong>Age:</strong> 34 years old</p>
                <p><strong>Last Visit:</strong> October 25, 2025</p>
            </div>
        </div>
        <div class="records-grid">
            <a href="view_record_details.php" class="record-card" aria-label="View Blood Work Analysis">
                <span class="record-type-badge lab">Lab Results</span>
                <h3>Blood Work Analysis</h3>
                <p>Complete blood count and metabolic panel</p>
                <div class="record-doctor">Dr. John Doe</div>
                <div class="record-date">October 20, 2025</div>
            </a>

            <div class="record-card">
                <span class="record-type-badge imaging">Imaging</span>
                <h3>Chest X-Ray</h3>
                <p>Routine chest imaging - Normal findings</p>
                <div class="record-doctor">Dr. John Doe</div>
                <div class="record-date">October 18, 2025</div>
            </div>

            <div class="record-card">
                <span class="record-type-badge diagnosis">Diagnosis</span>
                <h3>Hypertension</h3>
                <p>Essential hypertension - Stage 1</p>
                <div class="record-doctor">Dr. John Doe</div>
                <div class="record-date">October 15, 2025</div>
            </div>

            <div class="record-card">
                <span class="record-type-badge prescription">Prescription</span>
                <h3>Lipid Panel</h3>
                <p>Cholesterol and triglyceride levels</p>
                <div class="record-doctor">Dr. John Doe</div>
                <div class="record-date">October 10, 2025</div>
            </div>

            <div class="record-card">
                <span class="record-type-badge imaging">Imaging</span>
                <h3>ECG Report</h3>
                <p>Electrocardiogram - Normal sinus rhythm</p>
                <div class="record-doctor">Dr. John Doe</div>
                <div class="record-date">October 8, 2025</div>
            </div>

            <div class="record-card">
                <span class="record-type-badge consultation">Consultation</span>
                <h3>Type 2 Diabetes</h3>
                <p>Controlled with current medication</p>
                <div class="record-doctor">Dr. John Doe</div>
                <div class="record-date">September 30, 2025</div>
            </div>
        </div>
        <div class="records-timeline">
            <h2>Medical History Timeline</h2>
            
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <h3>Blood Work Analysis</h3>
                    <p>Complete blood count and metabolic panel</p>
                    <p style="font-size: 0.85rem; margin-top: 0.75rem; color: var(--text-light);">October 20, 2025 • Dr. John Doe</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <h3>Chest X-Ray</h3>
                    <p>Routine chest imaging - Normal findings</p>
                    <p style="font-size: 0.85rem; margin-top: 0.75rem; color: var(--text-light);">October 18, 2025 • Dr. John Doe</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <h3>Hypertension Diagnosis</h3>
                    <p>Essential hypertension - Stage 1</p>
                    <p style="font-size: 0.85rem; margin-top: 0.75rem; color: var(--text-light);">October 15, 2025 • Dr. John Doe</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <h3>Lipid Panel</h3>
                    <p>Cholesterol and triglyceride levels</p>
                    <p style="font-size: 0.85rem; margin-top: 0.75rem; color: var(--text-light);">October 10, 2025 • Dr. John Doe</p>
                </div>
            </div>
        </div>
    </div>
    <footer>
    <div class="footer-content">
      <div class="footer-section">
        <h3>MedOffice</h3>
        <p>Professional medical practice management system</p>
      </div>
      <div class="footer-section">
        <h3>Support</h3>
        <ul>
          <li><a href="#help">Help Center</a></li>
          <li><a href="#contact">Contact Support</a></li>
          <li><a href="#privacy">Privacy Policy</a></li>
          <li><a href="#terms">Terms of Service</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2025 MedOffice. All rights reserved. HIPAA-compliant medical practice management.</p>
    </div>
  </footer>
</body>
</html>
