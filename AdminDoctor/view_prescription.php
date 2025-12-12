<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescriptions - MedOffice</title>
    <link rel="stylesheet" href="../CSS/view_medication_detail.css" />
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
        <div class="back-header">
            <a href="view_patient.php" class="back-button">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Back to Patient
            </a>
            <h1 class="page-title">Prescriptions</h1>
            <a href="add_prescription.php" class="btn btn-add-prescription" style="margin-left: auto;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 0.5rem;">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Add Prescription
            </a>
        </div>
        <div class="patient-info-card">
            <div class="patient-avatar">SM</div>
            <div class="patient-details">
                <h2>Sarah Mitchell</h2>
                <p><strong>Patient ID:</strong> #P-2847 • <strong>Age:</strong> 34 years old • <strong>Last Visit:</strong> October 25, 2025</p>
            </div>
        </div>
        <h2 class="section-title">Active Prescriptions</h2>
        <div class="prescriptions-grid">
            <a href="view_medication_detail.php" class="prescription-card">
                <div class="prescription-header">
                    <h3 class="prescription-name">Prescription #RX001</h3>
                    <span class="status-badge active">Active</span>
                </div>
                <div class="prescription-details">
                    <div class="detail-row">
                        <span class="detail-label">Date</span>
                        <span class="detail-value">October 15, 2025</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Prescribed by</span>
                        <span class="detail-value">Dr. Sarah Johnson</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Contains</span>
                        <span class="detail-value">2 medications</span>
                    </div>
                </div>
                <div class="prescription-footer">
                    <span>View Details →</span>
                </div>
            </a>

            <a href="view_medication_detail.php" class="prescription-card">
                <div class="prescription-header">
                    <h3 class="prescription-name">Prescription #RX002</h3>
                    <span class="status-badge inactive">Completed</span>
                </div>
                <div class="prescription-details">
                    <div class="detail-row">
                        <span class="detail-label">Date</span>
                        <span class="detail-value">January 1, 2025</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Prescribed by</span>
                        <span class="detail-value">Dr. Sarah Johnson</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Contains</span>
                        <span class="detail-value">1 medication</span>
                    </div>
                </div>
                <div class="prescription-footer">
                    <span>View Details →</span>
                </div>
            </a>

            <a href="view_medication_detail.php" class="prescription-card">
                <div class="prescription-header">
                    <h3 class="prescription-name">Prescription #RX003</h3>
                    <span class="status-badge active">Active</span>
                </div>
                <div class="prescription-details">
                    <div class="detail-row">
                        <span class="detail-label">Date</span>
                        <span class="detail-value">November 20, 2024</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Prescribed by</span>
                        <span class="detail-value">Dr. Michael Chen</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Contains</span>
                        <span class="detail-value">1 medication</span>
                    </div>
                </div>
                <div class="prescription-footer">
                    <span>View Details →</span>
                </div>
            </a>
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
