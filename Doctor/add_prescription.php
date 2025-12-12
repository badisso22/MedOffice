<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Prescription - MedOffice</title>
    <link rel="stylesheet" href="../CSS/prescriptions.css">
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="../CSS/add_prescription.css">
</head>
<body>
    <nav>
        <div class="nav-container">
            <a href="dashboard_d.php" class="logo">
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
        <div class="back-header-enhanced">
            <a href="view_prescription.php" class="back-button-enhanced">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Back to Prescriptions
            </a>
            <div class="header-title-section">
                <h1 class="page-title-enhanced">Add New Prescription</h1>
                <p class="page-subtitle">Complete the form below to create a new prescription for your patient</p>
            </div>
        </div>
        <div class="alert alert-warning">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="alert-icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <strong>Check Drug Interactions</strong>
                <p>Always verify medication compatibility before prescribing. Review patient allergies and current medications.</p>
            </div>
        </div>

        <div class="form-container">
            <form class="search-form">
                <div class="form-section">
                    <div class="form-section-title">Patient Information</div>
                    <div class="form-row">
                        <div class="form-group" style="flex: 2;">
                            <label for="patient">Select Patient <span class="required-indicator">*</span></label>
                            <input type="text" id="patient" placeholder="Search patient by name or ID..." required>
                        </div>
                        <div class="form-group">
                            <label for="patient-id">Patient ID</label>
                            <input type="text" id="patient-id" placeholder="Auto-filled" disabled>
                        </div>
                    </div>
                </div>

                <div class="form-divider"></div>
                <div class="form-section">
                    <div class="form-section-title">Medication Details</div>
                    <div class="form-row">
                        <div class="form-group" style="flex: 2;">
                            <label for="medication">Medication Name <span class="required-indicator">*</span></label>
                            <input type="text" id="medication" placeholder="Enter medication name..." required>
                        </div>
                        <div class="form-group">
                            <label for="form-type">Form Type <span class="required-indicator">*</span></label>
                            <select id="form-type" required>
                                <option value="">Select form type</option>
                                <option value="tablet">Tablet</option>
                                <option value="capsule">Capsule</option>
                                <option value="liquid">Liquid</option>
                                <option value="injection">Injection</option>
                                <option value="cream">Cream</option>
                                <option value="inhaler">Inhaler</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Dosage <span class="required-indicator">*</span></label>
                            <div class="dosage-options">
                                <button type="button" class="dosage-option">250mg</button>
                                <button type="button" class="dosage-option">500mg</button>
                                <button type="button" class="dosage-option">750mg</button>
                                <button type="button" class="dosage-option">1000mg</button>
                                <button type="button" class="dosage-option">Custom</button>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="custom-dosage">Custom Dosage</label>
                            <input type="text" id="custom-dosage" placeholder="e.g., 250mg">
                        </div>
                    </div>
                </div>

                <div class="form-divider"></div>
                <div class="form-section">
                    <div class="form-section-title">Frequency & Duration</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Frequency <span class="required-indicator">*</span></label>
                            <div class="frequency-buttons">
                                <button type="button" class="frequency-btn">Once daily</button>
                                <button type="button" class="frequency-btn">Twice daily</button>
                                <button type="button" class="frequency-btn">3x daily</button>
                                <button type="button" class="frequency-btn">4x daily</button>
                                <button type="button" class="frequency-btn">As needed</button>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="start-date">Start Date <span class="required-indicator">*</span></label>
                            <input type="date" id="start-date" required>
                        </div>
                        <div class="form-group">
                            <label for="end-date">End Date <span class="required-indicator">*</span></label>
                            <input type="date" id="end-date" required>
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration (days)</label>
                            <input type="number" id="duration" placeholder="Auto-calculated" disabled>
                        </div>
                    </div>
                </div>

                <div class="form-divider"></div>
                <div class="form-section">
                    <div class="form-section-title">Instructions & Notes</div>
                    <div class="form-row">
                        <div class="form-group textarea-group" style="flex: 1;">
                            <label for="instructions">Patient Instructions</label>
                            <textarea id="instructions" placeholder="e.g., Take with food, avoid dairy products, do not drive..."></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group textarea-group" style="flex: 1;">
                            <label for="clinical-notes">Clinical Notes</label>
                            <textarea id="clinical-notes" placeholder="e.g., Monitor for side effects, follow-up in 2 weeks..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        Add Prescription
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        Clear Form
                    </button>
                    <a href="view_prescription.php" class="btn btn-secondary" style="text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">
                        Cancel
                    </a>
                </div>
            </form>
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
