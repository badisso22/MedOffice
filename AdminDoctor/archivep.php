<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Archive Patient - MedOffice</title>
  <link rel="stylesheet" href="../CSS/general.css" />
  <link rel="stylesheet" href="../CSS/searchP.css" />
  <link rel="stylesheet" href="../CSS/confirm_archive.css" />
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
        <span class="user-name">Dr. John Doe</span>
        <a href="logout.php" class="btn btn-secondary">Logout</a>
      </div>
    </div>
  </nav>
  <div class="confirmation-container">
    <div class="warning-icon">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
        <line x1="12" y1="9" x2="12" y2="13"></line>
        <line x1="12" y1="17" x2="12.01" y2="17"></line>
      </svg>
    </div>

    <h1>Archive Patient</h1>
    
    <p class="confirmation-message">
      Are you sure you want to archive this patient? This action will move the patient record to the archive section.
    </p>

    <div class="patient-info">
      <p><strong>Patient ID:</strong> 001</p>
      <p><strong>Name:</strong> Samia Boulkrinat</p>
      <p><strong>Age:</strong> 29</p>
    </div>

    <div class="action-buttons-confirm">
      <a href="confirm_archive.php" class="btn btn-danger btn-large">Yes, Archive Patient</a>
      <a href="searchP.php" class="btn btn-cancel btn-large">Cancel</a>
    </div>
  </div>
</body>
</html>