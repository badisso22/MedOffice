<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patient Notes - Medical Cabinet</title>
  <link rel="stylesheet" href="../CSS/notes.css">
</head>
<body>
  <header class="header">
    <div class="header-container">
      <div class="header-left">
        <h1 class="page-title">Patient Notes</h1>
        <p class="page-subtitle">Secure patient records</p>
      </div>
      <div class="header-actions">
        <button class="icon-btn search-btn" title="Search">
          <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.35-4.35"></path>
          </svg>
        </button>
        <button class="icon-btn add-btn" title="Add Note">
          <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
          </svg>
        </button>
      </div>
    </div>
  </header>

  <div class="notes-container">
    <aside class="sidebar">
      <div class="sidebar-section">
        <h3 class="sidebar-title">Categories</h3>
        <div class="category-list">
          <button class="category-btn active">
            <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M6 3h12a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"></path>
              <path d="M9 7h6"></path>
              <path d="M9 11h6"></path>
              <path d="M9 15h3"></path>
            </svg>
            <span>All Notes</span>
          </button>
          <button class="category-btn">
            <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
              <path d="M12 6v6l4 2"></path>
            </svg>
            <span>Clinical</span>
          </button>
          <button class="category-btn">
            <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"></path>
              <path d="M9 7h6"></path>
              <path d="M9 11h6"></path>
              <path d="M9 15h3"></path>
            </svg>
            <span>Treatment</span>
          </button>
          <button class="category-btn">
            <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M9 12l2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"></path>
            </svg>
            <span>Follow-up</span>
          </button>
          <button class="category-btn">
            <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
              <path d="M12 6v6h4"></path>
            </svg>
            <span>Lab Results</span>
          </button>
        </div>
      </div>

      <div class="sidebar-section">
        <h3 class="sidebar-title">Recent Patients</h3>
        <div class="patient-list">
          <button class="patient-item active">
            <div class="patient-avatar">JD</div>
            <div class="patient-info">
              <p class="patient-name">John Doe</p>
              <p class="patient-time">Today</p>
            </div>
          </button>
          <button class="patient-item">
            <div class="patient-avatar">SM</div>
            <div class="patient-info">
              <p class="patient-name">Sarah Miller</p>
              <p class="patient-time">Yesterday</p>
            </div>
          </button>
          <button class="patient-item">
            <div class="patient-avatar">RC</div>
            <div class="patient-info">
              <p class="patient-name">Robert Chen</p>
              <p class="patient-time">2 days ago</p>
            </div>
          </button>
          <button class="patient-item">
            <div class="patient-avatar">EP</div>
            <div class="patient-info">
              <p class="patient-name">Emily Parker</p>
              <p class="patient-time">3 days ago</p>
            </div>
          </button>
        </div>
      </div>
      <div class="btn-edit">
        <a href="dashboard_a.php" class="btn btn-primary sidebar-back" aria-label="Back to Dashboard">← Back to Dashboard</a>
      </div>
    </aside>

    <main class="notes-content">
      <div class="patient-card">
        <div class="patient-header">
          <div class="patient-card-avatar">JD</div>
          <div class="patient-details">
            <h2>John Doe</h2>
            <p class="patient-id">Patient ID: P-000123</p>
            <p class="patient-meta">Age: 45 | Last Visit: Oct 28, 2024</p>
          </div>
          <button class="btn-edit">
            <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
              <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
            </svg>
            Edit Info
          </button>
        </div>
      </div>

      <div class="notes-list">
        <div class="notes-header">
          <h3>Patient Notes</h3>
          <span class="note-count">3 notes</span>
        </div>

        <div class="note-item">
          <div class="note-header">
            <div class="note-title-section">
              <h4 class="note-title">Initial Consultation</h4>
              <span class="note-category clinical">Clinical</span>
            </div>
            <p class="note-date">Oct 28, 2024</p>
          </div>
          <p class="note-content">Patient came in with complaints of persistent headaches for the past two weeks. Vitals are stable. BP: 120/80, HR: 72. Performed neurological exam - all reflexes normal. Prescribed migraine medication and recommended lifestyle changes.</p>
          <div class="note-actions">
            <button class="action-btn">
              <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
              </svg>
              Edit
            </button>
            <button class="action-btn delete">
              <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                <line x1="10" y1="11" x2="10" y2="17"></line>
                <line x1="14" y1="11" x2="14" y2="17"></line>
              </svg>
              Delete
            </button>
          </div>
        </div>
        <div class="note-item">
          <div class="note-header">
            <div class="note-title-section">
              <h4 class="note-title">Lab Results Review</h4>
              <span class="note-category lab">Lab Results</span>
            </div>
            <p class="note-date">Oct 25, 2024</p>
          </div>
          <p class="note-content">Lab work completed. Blood glucose: 95 mg/dL (normal), Cholesterol: 195 mg/dL (normal). Liver function tests all within normal limits. Patient advised to maintain current diet and exercise routine. Follow-up tests recommended in 6 months.</p>
          <div class="note-actions">
            <button class="action-btn">
              <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
              </svg>
              Edit
            </button>
            <button class="action-btn delete">
              <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                <line x1="10" y1="11" x2="10" y2="17"></line>
                <line x1="14" y1="11" x2="14" y2="17"></line>
              </svg>
              Delete
            </button>
          </div>
        </div>
        <div class="note-item">
          <div class="note-header">
            <div class="note-title-section">
              <h4 class="note-title">Treatment Plan Update</h4>
              <span class="note-category treatment">Treatment</span>
            </div>
            <p class="note-date">Oct 20, 2024</p>
          </div>
          <p class="note-content">Patient responding well to current migraine medication. Frequency reduced from 4x/week to 1-2x/week. Continuing current prescription. Patient to return for follow-up in 2 weeks to assess progress and adjust treatment if needed.</p>
          <div class="note-actions">
            <button class="action-btn">
              <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
              </svg>
              Edit
            </button>
            <button class="action-btn delete">
              <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                <line x1="10" y1="11" x2="10" y2="17"></line>
                <line x1="14" y1="11" x2="14" y2="17"></line>
              </svg>
              Delete
            </button>
          </div>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
