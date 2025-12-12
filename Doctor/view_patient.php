<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Patient Details - MedOffice</title>
  <link rel="stylesheet" href="../CSS/view_patient.css" />
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
    <div class="patient-top-row">
      <div class="header-section">
        <div class="patient-header">
          <div class="patient-avatar">SB</div>
          <div class="patient-info">
            <h1 class="patient-name">Samia Boulkrinat</h1>
            <p class="patient-id">Patient ID: <strong>001</strong></p>
            <span class="status-badge">Active Patient</span>
          </div>
        </div>

        <div class="info-grid">
          <div class="info-card">
            <div class="info-label">Age</div>
            <div class="info-value">29 years</div>
          </div>
          <div class="info-card">
            <div class="info-label">Gender</div>
            <div class="info-value">Female</div>
          </div>
          <div class="info-card">
            <div class="info-label">Blood Type</div>
            <div class="info-value">O+</div>
          </div>
          <div class="info-card">
            <div class="info-label">Phone</div>
            <div class="info-value">+213 555 123 456</div>
          </div>
        </div>
      </div>

      <div class="section contact-info-box">
        <h2 class="section-title">Contact Information</h2>
        <div class="detail-row">
          <span class="detail-label">Email</span>
          <span class="detail-value">samia.boulkrinat@email.com</span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Phone</span>
          <span class="detail-value">+213 555 123 456</span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Address</span>
          <span class="detail-value">123 Medical Street, Algiers, Algeria</span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Emergency Contact</span>
          <span class="detail-value">Ahmed Boulkrinat - +213 555 789 012</span>
        </div>
      </div>
    </div>

    <div class="info-sections-row">
      <div class="section section-half">
        <h2 class="section-title">Medical History</h2>
        <ul class="medical-history-list">
          <li><strong>Hypertension</strong> - Diagnosed 2020, Currently managed with medication</li>
          <li><strong>Allergies</strong> - Penicillin (severe), Shellfish (mild)</li>
          <li><strong>Previous Surgeries</strong> - Appendectomy (2018)</li>
          <li><strong>Current Medications</strong> - Lisinopril 10mg daily, Vitamin D supplements</li>
        </ul>
      </div>

      <div class="section section-half">
        <h2 class="section-title">Recent Visits</h2>
        <div class="detail-row">
          <span class="detail-label">Last Visit</span>
          <span class="detail-value">October 15, 2025</span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Reason</span>
          <span class="detail-value">Regular Checkup</span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Next Appointment</span>
          <span class="detail-value">November 12, 2025</span>
        </div>
      </div>
    </div>

    <div class="section">
      <div class="section-header">
        <h2 class="section-title">Medical Records & Prescriptions</h2>
      </div>
      <div class="tabs-container">
        <div class="tabs">
          <button class="tab-btn active" data-tab="records">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
              <polyline points="14 2 14 8 20 8"></polyline>
            </svg>
            Medical Records
          </button>
          <button class="tab-btn" data-tab="prescriptions">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
              <line x1="8" y1="21" x2="16" y2="21"></line>
              <line x1="12" y1="17" x2="12" y2="21"></line>
            </svg>
            Prescriptions
          </button>
        </div>
      </div>
      <div class="tab-content active" id="records">
        <div class="records-list">
          <div class="record-item">
            <div class="record-header">
              <div class="record-info">
                <span class="record-date">2025-01-08</span>
                <h3 class="record-title">Blood Test Results</h3>
                <span class="record-type badge badge-lab">Lab Results</span>
              </div>
              <div class="record-actions">
                <a href="view_record_details.php" class="btn-icon" title="View" aria-label="View Record">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                  </svg>
                </a>
                <button class="btn-icon" title="Download">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                  </svg>
                </button>
              </div>
            </div>
            <p class="record-summary">All values normal. Hemoglobin: 13.5 g/dL, WBC: 7.2 K/uL, Platelets: 245 K/uL</p>
            <p class="record-doctor">Dr. Sarah Johnson</p>
          </div>

          <div class="record-item">
            <div class="record-header">
              <div class="record-info">
                <span class="record-date">2025-01-05</span>
                <h3 class="record-title">Chest X-Ray</h3>
                <span class="record-type badge badge-imaging">Imaging</span>
              </div>
              <div class="record-actions">
                <a href="view_record_details.php" class="btn-icon" title="View" aria-label="View Record">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                  </svg>
                </a>
                <button class="btn-icon" title="Download">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                  </svg>
                </button>
              </div>
            </div>
            <p class="record-summary">No abnormalities detected. Clear lungs, normal cardiac silhouette.</p>
            <p class="record-doctor">Dr. James Lee</p>
          </div>

          <div class="record-item">
            <div class="record-header">
              <div class="record-info">
                <span class="record-date">2025-01-02</span>
                <h3 class="record-title">Consultation Notes</h3>
                <span class="record-type badge badge-consultation">Consultation</span>
              </div>
              <div class="record-actions">
                <a href="view_record_details.php" class="btn-icon" title="View" aria-label="View Record">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                  </svg>
                </a>
                <button class="btn-icon" title="Download">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                  </svg>
                </button>
              </div>
            </div>
            <p class="record-summary">Annual physical examination. Patient in good health. Continue current medications.</p>
            <p class="record-doctor">Dr. Michael Chen</p>
          </div>
        </div>
        <div class="view-more-container">
          <a href="view_records.php" class="btn btn-primary">View All Medical Records</a>
        </div>
      </div>
      <div class="tab-content" id="prescriptions">
        <div class="prescriptions-list">
          <div class="prescription-item">
            <div class="prescription-header">
              <div class="prescription-info">
                <h3 class="prescription-name">Prescription #RX001</h3>
                <p class="prescription-details">Date: October 15, 2025</p>
                <span class="prescription-status badge badge-success">Active</span>
              </div>
              <div class="prescription-actions">
                <a href="view_medications.php" class="btn-icon" title="View Medications" aria-label="View Medications">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                  </svg>
                </a>
                <button class="btn-icon" title="Download">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                  </svg>
                </button>
              </div>
            </div>
            <p class="prescription-indication">Prescribed by Dr. Sarah Johnson</p>
            <p class="prescription-doctor">Contains: 2 medications</p>
          </div>

          <div class="prescription-item">
            <div class="prescription-header">
              <div class="prescription-info">
                <h3 class="prescription-name">Prescription #RX002</h3>
                <p class="prescription-details">Date: January 1, 2025</p>
                <span class="prescription-status badge badge-secondary">Completed</span>
              </div>
              <div class="prescription-actions">
                <a href="view_medications.php" class="btn-icon" title="View Medications" aria-label="View Medications">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                  </svg>
                </a>
                <button class="btn-icon" title="Download">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                  </svg>
                </button>
              </div>
            </div>
            <p class="prescription-indication">Prescribed by Dr. Sarah Johnson</p>
            <p class="prescription-doctor">Contains: 1 medication</p>
          </div>

          <div class="prescription-item">
            <div class="prescription-header">
              <div class="prescription-info">
                <h3 class="prescription-name">Prescription #RX003</h3>
                <p class="prescription-details">Date: November 20, 2024</p>
                <span class="prescription-status badge badge-success">Active</span>
              </div>
              <div class="prescription-actions">
                <a href="view_medications.php" class="btn-icon" title="View Medications" aria-label="View Medications">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                  </svg>
                </a>
                <button class="btn-icon" title="Download">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                  </svg>
                </button>
              </div>
            </div>
            <p class="prescription-indication">Prescribed by Dr. Michael Chen</p>
            <p class="prescription-doctor">Contains: 1 medication</p>
          </div>
        </div>
        <div class="view-more-container">
          <a href="view_prescription.php" class="btn btn-primary">View All Prescriptions</a>
        </div>
      </div>
    </div>
    <div class="action-bar">
      <a href="searchP.php" class="btn btn-white">← Back to Search</a>
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

  <script>
    document.querySelectorAll('.tab-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const tabName = this.getAttribute('data-tab');
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        this.classList.add('active');
        document.getElementById(tabName).classList.add('active');
      });
    });
  </script>
</body>
</html>
