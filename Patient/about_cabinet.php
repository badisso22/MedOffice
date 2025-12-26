<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clinics - MedOffice</title>
  <link rel="stylesheet" href="../CSS/general.css">
  <link rel="stylesheet" href="../CSS/dashboard.css">
  <link rel="stylesheet" href="../CSS/patient.css">
  <link rel="stylesheet" href="../CSS/cabinet_list.css">
</head>
<body>
  <main class="layout">
    <section class="page-title">
      <h1>Find Your Healthcare Provider</h1>
      <p style="color: #6b7280; margin-top: 0.5rem; font-size: 1rem;">
        Browse through our network of trusted medical cabinets
      </p>
    </section>

    <div class="cabinets-container">
      <div class="search-filter-bar">
        <div class="search-box">
          <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.35-4.35"></path>
          </svg>
          <input
            type="text"
            id="searchInput"
            placeholder="Search by cabinet name or city..."
            onkeyup="filterCabinets()"
          >
        </div>
        <select class="filter-select" id="cityFilter" onchange="filterCabinets()">
          <option value="">All Cities</option>
          <option value="Algiers">Algiers</option>
          <option value="Oran">Oran</option>
          <option value="Tamanrasset">Tamanrasset</option>
        </select>
        <select class="filter-select" id="ratingFilter" onchange="filterCabinets()">
          <option value="">All Ratings</option>
          <option value="5">5 Stars</option>
          <option value="4">4+ Stars</option>
          <option value="3">3+ Stars</option>
        </select>
      </div>

      <div id="cab-list" class="cabinets-grid"></div>

      <div id="emptyState" class="empty-state" style="display: none;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="12" y1="8" x2="12" y2="12"></line>
          <line x1="12" y1="16" x2="12.01" y2="16"></line>
        </svg>
        <h3>No cabinets found</h3>
        <p>Try adjusting your search or filters</p>
      </div>
    </div>

    <br>
    <a href="dashboard_p.php" class="btn btn-secondary">← Dashboard</a>
  </main>

  <script>
    function toggleDrawer(){
      const d=document.getElementById('drawer');
      d.classList.toggle('open');
    }
  </script>

  <script src="../ajax/patient_cabinets.js"></script>
</body>
</html>
