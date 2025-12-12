<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Doctor Details - MedOffice</title>
  <link rel="stylesheet" href="../CSS/view_patient.css" />
  <style>
    .doctor-specialty-badge {
      display: inline-block;
      background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
      color: #4338ca;
      padding: 0.5rem 1rem;
      border-radius: 50px;
      font-size: 0.85rem;
      font-weight: 600;
      border: 1px solid rgba(67, 56, 202, 0.2);
      margin-bottom: 1rem;
    }

    .qualifications-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1rem;
      margin-top: 1rem;
    }

    .qualification-card {
      background: var(--bg-light);
      padding: 1rem;
      border-radius: 8px;
      border-left: 3px solid var(--primary);
    }

    .qualification-card h4 {
      font-size: 0.9rem;
      font-weight: 600;
      color: var(--text-dark);
      margin-bottom: 0.25rem;
    }

    .qualification-card p {
      font-size: 0.85rem;
      color: var(--text-light);
    }

    .availability-schedule {
      margin-top: 1rem;
    }

    .schedule-row {
      display: flex;
      justify-content: space-between;
      padding: 0.75rem;
      background: var(--bg-light);
      border-radius: 8px;
      margin-bottom: 0.5rem;
      align-items: center;
    }

    .day-name {
      font-weight: 600;
      color: var(--text-dark);
      min-width: 100px;
    }

    .time-slots {
      color: var(--text-medium);
      font-size: 0.9rem;
    }

    .availability-status {
      padding: 0.25rem 0.75rem;
      border-radius: 50px;
      font-size: 0.8rem;
      font-weight: 600;
      background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
      color: #15803d;
    }

    .patients-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
    }

    .patients-table th {
      background: var(--bg-light);
      padding: 1rem;
      text-align: left;
      font-weight: 600;
      color: var(--text-dark);
      border-bottom: 2px solid var(--border);
    }

    .patients-table td {
      padding: 1rem;
      border-bottom: 1px solid var(--border);
      color: var(--text-medium);
    }

    .patients-table tr:hover {
      background: var(--bg-light);
    }

    .rating-display {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-weight: 600;
      color: var(--text-dark);
    }

    .stars {
      color: #fbbf24;
      font-size: 1.1rem;
    }
  </style>
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
          <div class="patient-avatar">SJ</div>
          <div class="patient-info">
            <h1 class="patient-name">Dr. Sarah Johnson</h1>
            <p class="patient-id">Doctor ID: <strong>DOC-0042</strong></p>
            <span class="status-badge">Active</span>
          </div>
        </div>

        <div class="info-grid">
          <div class="info-card">
            <div class="info-label">Specialization</div>
            <div class="info-value">Cardiologist</div>
          </div>
          <div class="info-card">
            <div class="info-label">Experience</div>
            <div class="info-value">12 Years</div>
          </div>
          <div class="info-card">
            <div class="info-label">Patients</div>
            <div class="info-value">234</div>
          </div>
          <div class="info-card">
            <div class="info-label">Rating</div>
            <div class="info-value">
              <div class="rating-display">
                <span class="stars">★★★★★</span>
                <span>4.8/5</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="section contact-info-box">
        <h2 class="section-title">Contact Information</h2>
        <div class="detail-row">
          <span class="detail-label">Email</span>
          <span class="detail-value">sarah.johnson@medoffice.com</span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Phone</span>
          <span class="detail-value">+213 555 123 456</span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Office Location</span>
          <span class="detail-value">Clinic B, Building 3</span>
        </div>
        <div class="detail-row">
          <span class="detail-label">License Number</span>
          <span class="detail-value">LIC-2012-845762</span>
        </div>
      </div>
    </div>

    <div class="info-sections-row">
      <div class="section section-half">
        <h2 class="section-title">Professional Qualifications</h2>
        <div class="qualifications-grid">
          <div class="qualification-card">
            <h4>MD</h4>
            <p>Harvard Medical School, 2012</p>
          </div>
          <div class="qualification-card">
            <h4>Board Certified</h4>
            <p>American College of Cardiology</p>
          </div>
          <div class="qualification-card">
            <h4>Fellowship</h4>
            <p>Stanford University, Cardiology</p>
          </div>
          <div class="qualification-card">
            <h4>License</h4>
            <p>Medical License #845762 (Active)</p>
          </div>
        </div>
      </div>

      <div class="section section-half">
        <h2 class="section-title">Work Schedule</h2>
        <div class="availability-schedule">
          <div class="schedule-row">
            <span class="day-name">Monday</span>
            <span class="time-slots">09:00 AM - 05:00 PM</span>
            <span class="availability-status">Available</span>
          </div>
          <div class="schedule-row">
            <span class="day-name">Tuesday</span>
            <span class="time-slots">09:00 AM - 05:00 PM</span>
            <span class="availability-status">Available</span>
          </div>
          <div class="schedule-row">
            <span class="day-name">Wednesday</span>
            <span class="time-slots">10:00 AM - 06:00 PM</span>
            <span class="availability-status">Available</span>
          </div>
          <div class="schedule-row">
            <span class="day-name">Thursday</span>
            <span class="time-slots">09:00 AM - 05:00 PM</span>
            <span class="availability-status">Available</span>
          </div>
          <div class="schedule-row">
            <span class="day-name">Friday</span>
            <span class="time-slots">09:00 AM - 03:00 PM</span>
            <span class="availability-status">Available</span>
          </div>
          <div class="schedule-row">
            <span class="day-name">Saturday</span>
            <span class="time-slots">10:00 AM - 01:00 PM</span>
            <span class="availability-status">Available</span>
          </div>
        </div>
      </div>
    </div>

    <div class="section">
      <div class="section-header">
        <h2 class="section-title">Upcoming Appointments</h2>
      </div>
      <table class="patients-table">
        <thead>
          <tr>
            <th>Patient Name</th>
            <th>Date & Time</th>
            <th>Type</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Samia Boulkrinat</td>
            <td>Nov 5, 2025 - 10:30 AM</td>
            <td>Regular Checkup</td>
            <td><span class="badge badge-success">Confirmed</span></td>
            <td>
              <button class="btn-icon" title="View">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                  <circle cx="12" cy="12" r="3"></circle>
                </svg>
              </button>
            </td>
          </tr>
          <tr>
            <td>Ahmed Mohamed</td>
            <td>Nov 6, 2025 - 02:00 PM</td>
            <td>Consultation</td>
            <td><span class="badge badge-success">Confirmed</span></td>
            <td>
              <button class="btn-icon" title="View">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                  <circle cx="12" cy="12" r="3"></circle>
                </svg>
              </button>
            </td>
          </tr>
          <tr>
            <td>Lisa Martinez</td>
            <td>Nov 8, 2025 - 03:30 PM</td>
            <td>Follow-up</td>
            <td><span class="badge badge-secondary">Pending</span></td>
            <td>
              <button class="btn-icon" title="View">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                  <circle cx="12" cy="12" r="3"></circle>
                </svg>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="section">
      <h2 class="section-title">Professional Summary</h2>
      <p style="color: var(--text-medium); line-height: 1.8; margin-bottom: 1rem;">
        Dr. Sarah Johnson is a highly experienced cardiologist with over 12 years of clinical practice. She specializes in interventional cardiology and has successfully treated over 1,000 patients. Her expertise includes coronary interventions, cardiac imaging, and preventive cardiology. Dr. Johnson is committed to providing comprehensive cardiac care and maintaining the highest standards of patient safety.
      </p>
      <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
        <span class="doctor-specialty-badge">Interventional Cardiology</span>
        <span class="doctor-specialty-badge">Cardiac Imaging</span>
        <span class="doctor-specialty-badge">Preventive Medicine</span>
      </div>
    </div>

    <div class="action-bar">
      <a href="searchD.php" class="btn btn-white">← Back to Doctors List</a>
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
