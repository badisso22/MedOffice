<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Doctor - MedOffice</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="../CSS/search_doctor.css">
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
                <span class="user-name">Patient Samia</span>
                <div class="top-icons">
                    <a href="patient_messages.php" class="icon-btn" title="Chat">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                    </a>
                    <a href="notifications.php" class="icon-btn" title="Notifications">
                        <svg viewBox="0 0 24 24">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span class="notification-badge">3</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <div class="drawer" id="drawer">
        <div class="drawer-header">
            <div class="logo">
                <div class="logo-icon">⚕</div>
                MedOffice
            </div>
            <button class="drawer-close" onclick="toggleDrawer()">&times;</button>
        </div>
        <ul class="drawer-menu">
            <li><a href="dashboard_p.php" class="active">
                <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                Dashboard
            </a></li>
            <li><a href="profileP.php">
                <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                My Profile
            </a></li>
            <li><a href="calendarP.php">
                <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Calendar
            </a></li>
            <li><a href="calendarP.php">
                <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Appointments
            </a></li>
            <li><a href="myRecords.php">
                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                Medical Records
            </a></li>
            <li><a href="myPrescriptions.php">
                <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                Prescriptions
            </a></li>
          <!--  <li><a href="myPrescriptions.php">
                <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                Consultations
            </a></li>-->
            <li><a href="about_cabinet.php">
                <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                Cabinet Info
            </a></li>
            <li><a href="medAi.php">
                <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                    <circle cx="8" cy="10" r="1.5" fill="white"/>
                    <circle cx="12" cy="7" r="1.5" fill="white"/>
                    <circle cx="16" cy="10" r="1.5" fill="white"/>
                    <circle cx="10" cy="14" r="1.5" fill="white"/>
                    <circle cx="14" cy="14" r="1.5" fill="white"/>
                    <circle cx="12" cy="17" r="1.5" fill="white"/>
                    <line x1="8" y1="10" x2="12" y2="7" stroke="white" stroke-width="1"/>
                    <line x1="12" y1="7" x2="16" y2="10" stroke="white" stroke-width="1"/>
                    <line x1="8" y1="10" x2="10" y2="14" stroke="white" stroke-width="1"/>
                    <line x1="16" y1="10" x2="14" y2="14" stroke="white" stroke-width="1"/>
                    <line x1="10" y1="14" x2="12" y2="17" stroke="white" stroke-width="1"/>
                    <line x1="14" y1="14" x2="12" y2="17" stroke="white" stroke-width="1"/>
                </svg>                Med Ai
            </a></li>
            <li><a href="settings.php">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06A2 2 0 1 1 6.92 4.58l.06.06c.37.37.86.54 1.34.41a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09c0 .49.19.97.54 1.34a1.65 1.65 0 0 0 1.82.33h.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82c.1.63.52 1.15 1.15 1.25z"/>
                </svg>
                Settings
            </a></li>
            <button class="drawer-logout" onclick="logout()">Logout</button>
        </ul>
    </div>

    <div class="drawer-overlay" id="drawerOverlay" onclick="toggleDrawer()"></div>

    <main class="search-main">
        <div class="breadcrumb">
            <a href="dashboard_p.php" class="btn btn-secondary">← Home</a>
        </div>

        <section class="search-hero">
            <h1>Search a doctor</h1>
            <p>Find and book appointments with qualified doctors in your area</p>
        </section>

        <div class="search-container">
            <aside class="filter-panel">
                <div class="filter-header">
                    <h2>Filters</h2>
                    <button class="reset-btn" onclick="resetFilters()">Reset filters</button>
                </div>

                <form id="searchForm" class="filter-form">
                  <!--  <div class="form-group">
                        <label for="searchText">Search</label>
                        <input type="text" id="searchText" placeholder="Search by doctor name or clinic" class="form-input">
                    </div>-->

                    <div class="form-group">
                        <label for="speciality">Speciality <span class="required">*</span></label>
                        <select id="speciality" class="form-select" required>
                            <option value="">Select speciality</option>
                            <option value="cardiology">Cardiology</option>
                            <option value="dermatology">Dermatology</option>
                            <option value="general">General Medicine</option>
                            <option value="pediatrics">Pediatrics</option>
                            <option value="neurology">Neurology</option>
                            <option value="orthopedics">Orthopedics</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="location">Location</label>
                        <select id="location" class="form-select">
                            <option value="">Any location</option>
                            <option value="algiers">Algiers</option>
                            <option value="blida">Blida</option>
                            <option value="oran">Oran</option>
                            <option value="constantine">Constantine</option>
                            <option value="tiziouzou">Tizi ouzou</option>
                            <option value="setif">Setif</option>
                            <option value="batna">Batna</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="appointmentDate">Preferred Date</label>
                        <input type="date" id="appointmentDate" class="form-input">
                    </div>

                    <div class="form-group">
                        <label>Time Range</label>
                        <div class="time-chips">
                            <label class="chip">
                                <input type="checkbox" name="timeRange" value="morning">
                                <span>Morning</span>
                            </label>
                            <label class="chip">
                                <input type="checkbox" name="timeRange" value="afternoon">
                                <span>Afternoon</span>
                            </label>
                            <label class="chip">
                                <input type="checkbox" name="timeRange" value="evening">
                                <span>Evening</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Price Range</label>
                        <div class="price-inputs">
                            <input type="number" id="priceMin" placeholder="Min" class="form-input">
                            <span>-</span>
                            <input type="number" id="priceMax" placeholder="Max" class="form-input">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Appointment Type</label>
                        <div class="checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="appointmentType" value="checkup">
                                <span>Regular Check up</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="appointmentType" value="emergency">
                                <span>Emergency</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="appointmentType" value="consultation">
                                <span>Consultation</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="appointmentType" value="followup">
                                <span>Follow-up</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="appointmentType" value="diagnostic">
                                <span>Diagnostic Test</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="appointmentType" value="vaccination">
                                <span>Vaccination</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-large">Search doctors</button>
                </form>
            </aside>

            <section class="results-section">
                <div id="loadingState" class="loading-state" style="display: none;">
                    <div class="loading-card">
                        <div class="spinner"></div>
                        <p>Searching for doctors...</p>
                    </div>
                </div>

                <div id="emptyState" class="empty-state" style="display: none;">
                    <svg viewBox="0 0 24 24" width="80" height="80">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <h3>No doctors found</h3>
                    <p>Try adjusting your filters to find more results</p>
                    <button class="btn btn-secondary" onclick="resetFilters()">Adjust filters</button>
                </div>

                <div id="resultsGrid" class="results-grid">
                    <div class="doctor-card">
                        <div class="doctor-photo">
                            <img src="/placeholder.svg?height=80&width=80" alt="Doctor">
                        </div>
                        <div class="doctor-info">
                            <h3>Dr. Sarah Ahmed</h3>
                            <p class="doctor-speciality">Cardiologist</p>
                            <div class="doctor-rating">
                                <span class="stars">★★★★★</span>
                                <span class="rating-text">4.9 (127 reviews)</span>
                            </div>
                            <div class="doctor-tags">
                                <span class="tag">Heart failure</span>
                                <span class="tag">Hypertension</span>
                            </div>
                            <div class="doctor-meta">
                                <div class="meta-item">
                                    <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                    <span>ESST Medical Office</span>
                                </div>
                                <div class="meta-item">
                                    <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                    <span>From 1000 DZD</span>
                                </div>
                                <div class="meta-item">
                                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                    <span>Next: Tomorrow, 15:30</span>
                                </div>
                            </div>
                        </div>
                        <div class="doctor-actions">
                            <a href="doctor_profile.php" class="btn btn-primary">View profile</a>
                            <button class="btn btn-secondary">Book now</button>
                        </div>
                    </div>

                    <div class="doctor-card">
                        <div class="doctor-photo">
                            <img src="/placeholder.svg?height=80&width=80" alt="Doctor">
                        </div>
                        <div class="doctor-info">
                            <h3>Dr. Mohamed Benjelloun</h3>
                            <p class="doctor-speciality">General Medicine</p>
                            <div class="doctor-rating">
                                <span class="stars">★★★★★</span>
                                <span class="rating-text">4.8 (89 reviews)</span>
                            </div>
                            <div class="doctor-tags">
                                <span class="tag">Checkups</span>
                                <span class="tag">Preventive care</span>
                            </div>
                            <div class="doctor-meta">
                                <div class="meta-item">
                                    <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                    <span>North Health Clinic</span>
                                </div>
                                <div class="meta-item">
                                    <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                    <span>From 500 DZD</span>
                                </div>
                                <div class="meta-item">
                                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                    <span>Next: Today, 18:00</span>
                                </div>
                            </div>
                        </div>
                        <div class="doctor-actions">
                            <a href="doctor_profile.php" class="btn btn-primary">View profile</a>
                            <button class="btn btn-secondary">Book now</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>MedOffice</h3>
                <p>Your trusted healthcare management platform</p>
            </div>
            <div class="footer-section">
                <h3>Support</h3>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Contact Support</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 MedOffice. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function toggleDrawer() {
            const drawer = document.getElementById('drawer');
            const overlay = document.getElementById('drawerOverlay');
            drawer.classList.toggle('open');
            overlay.classList.toggle('active');
        }

        function logout() {
            window.location.href = '../index.html';
        }

        function resetFilters() {
            document.getElementById('searchForm').reset();
        }

        document.getElementById('searchForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const loading = document.getElementById('loadingState');
            const results = document.getElementById('resultsGrid');
            
            results.style.display = 'none';
            loading.style.display = 'flex';
            
            setTimeout(() => {
                loading.style.display = 'none';
                results.style.display = 'grid';
            }, 1500);
        });
    </script>
</body>
</html>