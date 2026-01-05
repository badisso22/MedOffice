<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Doctor Search - MedOffice</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="../CSS/search_doctor.css">
    <link rel="stylesheet" href="../CSS/search_wizard.css">
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
            <h1>Find Your Perfect Doctor</h1>
            <p>Our intelligent recommendation system helps you find the best match based on your priorities</p>
        </section>

        <div class="wizard-container">
            <div class="wizard-progress">
                <div class="progress-bar" id="progressBar" style="width: 20%"></div>
            </div>

            <div class="wizard-steps">
                <div class="wizard-step active" id="step1" data-step="1">
                    <h2>Step 1: Choose Your Specialty</h2>
                    <p>What type of doctor are you looking for?</p>
                    
                    <div class="specialty-grid" id="specialtyGrid">
                        <div class="loading-spinner"></div>
                    </div>
                    
                    <div class="step-actions">
                        <button class="btn btn-secondary" onclick="resetWizard()">Cancel</button>
                        <button class="btn btn-primary" id="step1Next" onclick="goToStep(2)" disabled>
                            Continue →
                        </button>
                    </div>
                </div>

                <div class="wizard-step" id="step2" data-step="2">
                    <h2>Step 2: Select Your Criteria</h2>
                    <p>Which factors are important to you? (Optional)</p>
                    
                    <div class="criteria-checklist" id="criteriaChecklist">
                        <label class="criteria-checkbox">
                            <input type="checkbox" name="criteria" value="price" onchange="onCriteriaChange()">
                            <div class="criteria-card">
                                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="M12 6v12M9 9h6a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2H9"></path>
                                </svg>
                                <span class="label">Price</span>
                                <span class="description">Budget-friendly options</span>
                            </div>
                        </label>

                        <label class="criteria-checkbox">
                            <input type="checkbox" name="criteria" value="availability" onchange="onCriteriaChange()">
                            <div class="criteria-card">
                                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span class="label">Availability</span>
                                <span class="description">Next 7 days</span>
                            </div>
                        </label>

                        <label class="criteria-checkbox">
                            <input type="checkbox" name="criteria" value="facilities" onchange="onCriteriaChange()">
                            <div class="criteria-card">
                                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M3 10h18M3 10l1-6h16l1 6M3 10v9a1 1 0 001 1h16a1 1 0 001-1v-9"></path>
                                    <circle cx="9" cy="18" r="1"></circle>
                                    <circle cx="15" cy="18" r="1"></circle>
                                </svg>
                                <span class="label">Facilities</span>
                                <span class="description">Parking, wheelchair access</span>
                            </div>
                        </label>

                        <label class="criteria-checkbox">
                            <input type="checkbox" name="criteria" value="location" onchange="onCriteriaChange()">
                            <div class="criteria-card">
                                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span class="label">Location</span>
                                <span class="description">Your preferred area</span>
                            </div>
                        </label>

                        <label class="criteria-checkbox">
                            <input type="checkbox" name="criteria" value="feedback" onchange="onCriteriaChange()">
                            <div class="criteria-card">
                                <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                                    <polygon points="12 2 15.09 10.26 23.77 11.25 17.77 17.76 19.04 26.45 12 22.77 4.96 26.45 6.23 17.76 0.23 11.25 8.91 10.26"></polygon>
                                </svg>
                                <span class="label">Patient Feedback</span>
                                <span class="description">Reviews & ratings</span>
                            </div>
                        </label>
                    </div>

                    <div id="facilitiesSelector" class="sub-selector" style="display: none;">
                        <h4>Which facilities matter to you?</h4>
                        <div id="facilitiesOptions" class="checkbox-group"></div>
                    </div>

                    <div id="locationSelector" class="sub-selector" style="display: none;">
                        <h4>Preferred location (Wilaya)</h4>
                        <select id="locationSelect" class="form-select">
                            <option value="">Select location</option>
                        </select>
                    </div>
                    
                    <div class="step-actions">
                        <button class="btn btn-secondary" onclick="goToStep(1)">← Back</button>
                        <button class="btn btn-primary" id="step2Next" onclick="goToStep(3)">
                            Continue →
                        </button>
                    </div>
                </div>
                <div class="wizard-step" id="step3" data-step="3">
                    <h2>Step 3: Choose Calculation Method</h2>
                    <p>Select how you'd like doctors to be ranked</p>
                    
                    <div class="method-selection-grid">
                        <label class="method-card">
                            <input type="radio" name="method" value="wsm" checked onchange="selectMethod('wsm')">
                            <div class="method-content">
                                <div class="method-icon">⚖️</div>
                                <h3>Weighted Sum Method (WSM)</h3>
                                <p class="method-description">Simple and straightforward weighting approach</p>
                                <ul class="method-features">
                                    <li>✓ Easy to understand</li>
                                    <li>✓ Direct weighted scoring</li>
                                    <li>✓ Faster calculation</li>
                                </ul>
                            </div>
                        </label>

                        <label class="method-card">
                            <input type="radio" name="method" value="topsis" onchange="selectMethod('topsis')">
                            <div class="method-content">
                                <div class="method-icon">📊</div>
                                <h3>TOPSIS Method</h3>
                                <p class="method-description">Advanced technique for complex decision-making</p>
                                <ul class="method-features">
                                    <li>✓ Considers ideal & anti-ideal solutions</li>
                                    <li>✓ Better for complex criteria</li>
                                    <li>✓ More sophisticated ranking</li>
                                </ul>
                            </div>
                        </label>
                    </div>

                    <div class="method-info" id="methodInfo">
                        <p><strong>WSM</strong> (Weighted Sum Method) is a simpler approach that multiplies each criterion score by its weight and sums them up. It's intuitive and works well for most decision scenarios.</p>
                    </div>
                    
                    <div class="step-actions">
                        <button class="btn btn-secondary" onclick="goToStep(2)">← Back</button>
                        <button class="btn btn-primary" onclick="goToStep(4)">
                            Continue →
                        </button>
                    </div>
                </div>
                <div class="wizard-step" id="step4" data-step="4">
                    <h2>Step 4: Rank Your Priorities</h2>
                    <p>Drag to reorder: what matters most to you?</p>
                    
                    <ul class="ranking-list" id="rankingList">
                    </ul>

                    <div class="step-actions">
                        <button class="btn btn-secondary" onclick="goToStep(3)">← Back</button>
                        <button class="btn btn-primary" id="step4Next" onclick="goToStep(5)">
                            Find My Doctor →
                        </button>
                    </div>
                </div>
                <div class="wizard-step" id="step5" data-step="5">
                    <h2>Your Doctor Recommendations</h2>
                    <p>Based on your priorities and selected method</p>

                    <div id="loadingResults" class="loading-state" style="display: none;">
                        <div class="loading-card doctor-themed">
                            <div class="spinner"></div>
                            <p>Finding your perfect match...</p>
                        </div>
                    </div>

                    <div id="emptyState" class="empty-state" style="display: none;">
                        <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <h3>No doctors found</h3>
                        <p id="emptyMessage">No doctors are available for the selected specialty.</p>
                        <button class="btn btn-secondary" onclick="resetWizard()">Try Another Specialty</button>
                    </div>

                    <div id="resultsContainer" class="results-container">
                    </div>

                    <div class="step-actions">
                        <button class="btn btn-secondary" onclick="resetWizard()">New Search</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="stepLoadingScreen" class="step-loading-overlay" style="display: none;">
            <div class="step-loading-card">
                <div class="loading-spinner"></div>
                <p id="loadingMessage">Processing...</p>
                <div class="progress-dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
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
    <script src="../ajax/patient_search_doctor.js"></script>
</body>
</html>