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
      <p style="color: #6b7280; margin-top: 0.5rem; font-size: 1rem;">Browse through our network of trusted medical cabinets</p>
    </section>
    <div class="cabinets-container">
      <div class="search-filter-bar">
        <div class="search-box">
          <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.35-4.35"></path>
          </svg>
          <input type="text" id="searchInput" placeholder="Search by cabinet name or city..." onkeyup="filterCabinets()">
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

    const data = [
      {
        id: 1, 
        name: 'Central Medical Cabinet', 
        city: 'Algiers', 
        phone: '+213 21 00 00 00', 
        rating: 5,
        ratingDisplay: '★★★★★',
        ratingValue: '4.8',
        reviews: 145,
        doctors: 8,
        featured: true
      },
      {
        id: 2, 
        name: 'North Clinic', 
        city: 'Oran', 
        phone: '+213 41 00 00 00',
        rating: 4,
        ratingDisplay: '★★★★☆',
        ratingValue: '4.2',
        reviews: 89,
        doctors: 5,
        featured: false
      },
      {
        id: 3, 
        name: 'South Medical Center', 
        city: 'Tamanrasset', 
        phone: '+213 29 00 00 00',
        rating: 5,
        ratingDisplay: '★★★★★',
        ratingValue: '4.9',
        reviews: 67,
        doctors: 6,
        featured: true
      },
      {
        id: 4, 
        name: 'East Healthcare', 
        city: 'Algiers', 
        phone: '+213 21 11 22 33',
        rating: 4,
        ratingDisplay: '★★★★☆',
        ratingValue: '4.5',
        reviews: 112,
        doctors: 7,
        featured: false
      }
    ];

    const list = document.getElementById('cab-list');
    const emptyState = document.getElementById('emptyState');
    let filteredData = [...data];

    function render(items) {
      list.innerHTML = '';
      
      if (items.length === 0) {
        emptyState.style.display = 'block';
        return;
      }
      
      emptyState.style.display = 'none';
      
      items.forEach(c => {
        const card = document.createElement('a');
        card.className = 'cabinet-card';
        card.href = 'cabinet_profile.php?id=' + c.id;
        
        card.innerHTML = `
          <div class="cabinet-image">
            ⚕
            ${c.featured ? '<span class="featured-badge">Featured</span>' : ''}
          </div>
          <div class="cabinet-content">
            <div class="cabinet-header-row">
              <h3>${c.name}</h3>
              <div class="cabinet-rating">
                <span class="rating-stars">${c.ratingDisplay}</span>
                <span class="rating-value">${c.ratingValue}</span>
              </div>
            </div>
            
            <div class="cabinet-location">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
              ${c.city}
            </div>
            
            <div class="cabinet-info-row">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
              </svg>
              ${c.phone}
            </div>
            
            <div class="cabinet-info-row">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
              </svg>
              ${c.reviews} reviews
            </div>
            
            <div class="cabinet-footer">
              <div class="doctors-count">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                  <circle cx="8.5" cy="7" r="4"></circle>
                  <polyline points="17 11 19 13 23 9"></polyline>
                </svg>
                ${c.doctors} Doctors
              </div>
              <button class="view-profile-btn" onclick="event.preventDefault(); window.location.href='cabinet_profile.php?id=${c.id}'">View Profile</button>
            </div>
          </div>
        `;
        
        list.appendChild(card);
      });
    }

    function filterCabinets() {
      const searchTerm = document.getElementById('searchInput').value.toLowerCase();
      const cityFilter = document.getElementById('cityFilter').value;
      const ratingFilter = parseInt(document.getElementById('ratingFilter').value) || 0;
      
      filteredData = data.filter(cabinet => {
        const matchesSearch = cabinet.name.toLowerCase().includes(searchTerm) || 
                             cabinet.city.toLowerCase().includes(searchTerm);
        const matchesCity = !cityFilter || cabinet.city === cityFilter;
        const matchesRating = !ratingFilter || cabinet.rating >= ratingFilter;
        
        return matchesSearch && matchesCity && matchesRating;
      });
      
      render(filteredData);
    }

    render(data);
  </script>
</body>
</html>
