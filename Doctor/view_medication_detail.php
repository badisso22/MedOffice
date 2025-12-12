<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Prescription Medications - MedOffice</title>
  <link rel="stylesheet" href="../CSS/view_medications.css" />
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

  <div class="container">
    <div class="back-header">
      <a href="view_patient.php" class="back-button">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Back to Patient
      </a>
      <h1 class="page-title">Prescription #RX001</h1>
    </div>

    <div class="prescription-info">
      <div class="prescription-details">
        <div class="detail-item">
          <div class="detail-label">Prescription ID</div>
          <div class="detail-value">RX001</div>
        </div>
        <div class="detail-item">
          <div class="detail-label">Date Prescribed</div>
          <div class="detail-value">October 15, 2025</div>
        </div>
        <div class="detail-item">
          <div class="detail-label">Prescribed By</div>
          <div class="detail-value">Dr. Sarah Johnson</div>
        </div>
        <div class="detail-item">
          <div class="detail-label">Status</div>
          <div class="detail-value">Active</div>
        </div>
      </div>
    </div>

    <div class="medications-section">
      <h2 class="section-title">Medications in this Prescription</h2>
      <div class="medications-list">
        <div class="medication-card">
          <div class="medication-header">
            <h3 class="medication-name">Lisinopril</h3>
            <span class="medication-status">Active</span>
          </div>
          <div class="medication-details">
            <div class="detail-row">
              <span class="detail-row-label">Dosage</span>
              <span class="detail-row-value">10 mg</span>
            </div>
            <div class="detail-row">
              <span class="detail-row-label">Frequency</span>
              <span class="detail-row-value">Once daily</span>
            </div>
            <div class="detail-row">
              <span class="detail-row-label">Quantity</span>
              <span class="detail-row-value">30 tablets</span>
            </div>
            <div class="detail-row">
              <span class="detail-row-label">Refills</span>
              <span class="detail-row-value">3 remaining</span>
            </div>
          </div>
          <div class="medication-footer">
            <div>
              <span>For: Hypertension management</span>
            </div>
            <div class="medication-actions">
              <button class="btn-icon" title="Download">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                  <polyline points="7 10 12 15 17 10"></polyline>
                  <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
              </button>
            </div>
          </div>
        </div>

        <div class="medication-card">
          <div class="medication-header">
            <h3 class="medication-name">Vitamin D Supplement</h3>
            <span class="medication-status">Active</span>
          </div>
          <div class="medication-details">
            <div class="detail-row">
              <span class="detail-row-label">Dosage</span>
              <span class="detail-row-value">1000 IU</span>
            </div>
            <div class="detail-row">
              <span class="detail-row-label">Frequency</span>
              <span class="detail-row-value">Once daily</span>
            </div>
            <div class="detail-row">
              <span class="detail-row-label">Quantity</span>
              <span class="detail-row-value">30 capsules</span>
            </div>
            <div class="detail-row">
              <span class="detail-row-label">Refills</span>
              <span class="detail-row-value">5 remaining</span>
            </div>
          </div>
          <div class="medication-footer">
            <div>
              <span>For: Vitamin D deficiency prevention</span>
            </div>
            <div class="medication-actions">
              <button class="btn-icon" title="Download">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                  <polyline points="7 10 12 15 17 10"></polyline>
                  <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="action-bar">
      <a href="view_patient.php" class="btn btn-white">← Back to Patient</a>
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
