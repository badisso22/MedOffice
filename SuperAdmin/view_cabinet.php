<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabinet Details - Admin Dashboard</title>
    <link rel="stylesheet" href="../CSS/superadmin.css">
    <link rel="stylesheet" href="../CSS/superadmin_view_cabinet.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <button class="menu-toggle" onclick="toggleSidebar()">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
            <div class="logo">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="1"></circle>
                    <circle cx="19" cy="12" r="1"></circle>
                    <circle cx="5" cy="12" r="1"></circle>
                    <path d="M12 5v14"></path>
                    <path d="M5 12h14"></path>
                </svg>
                <span class="logo-text">Super Admin Hub</span>
            </div>
            <div class="nav-right">
                <div class="search-bar">
                    <input type="text" placeholder="Search...">
                </div>
                <div class="notification-bell">
                    <a href="notifications.php" class="bell-btn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                    </a>
                    <span class="notification-badge">3</span>
                </div>
                <div class="user-menu">
                    <span class="user-name">Admin</span>
                    <button class="logout-btn" onclick="logout()">Logout</button>
                </div>
            </div>
        </div>
    </nav>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3>Navigation</h3>
            <button class="close-btn" onclick="toggleSidebar()">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <ul class="sidebar-menu">
            <li><a href="dashboard_superadmin.php" class="menu-item">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3"></polyline>
                </svg>
                <span>Overview</span>
            </a></li>

            <li><a href="users.php" class="menu-item">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <span>User Management</span>
            </a></li>

            <li><a href="cabinets.php" class="menu-item active">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="9" y1="3" x2="9" y2="21"></line>
                </svg>
                <span>Cabinet Management</span>
            </a></li>

            <li><a href="messages.php" class="menu-item">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
                <span>Messages</span>
            </a></li>

            <li><a href="billing.php" class="menu-item">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                    <line x1="1" y1="10" x2="23" y2="10"></line>
                </svg>
                <span>Billing & Revenue</span>
            </a></li>

            <li><a href="security.php" class="menu-item">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                </svg>
                <span>Security</span>
            </a></li>

            <li><a href="superadmin_settings.php" class="menu-item">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                </svg>
                <span>Settings</span>
            </a></li>
        </ul>
    </aside>

    <main class="main-content">
        <div class="cabinet-view-container">
            <a href="cabinets.php" class="back-button">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                Back to Cabinets
            </a>

            <div class="cabinet-header">
                <div class="cabinet-logo" id="cabinetLogo">CA</div>

                <div class="cabinet-header-info">
                    <h1 id="cabinetName">Loading...</h1>
                    <p style="color: var(--text-secondary); margin-bottom: 0.5rem;" id="cabinetLocation">Loading...</p>

                    <div class="cabinet-meta">
                        <div class="cabinet-meta-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                            </svg>
                            <span class="badge active" id="cabinetStatus">Loading...</span>
                        </div>

                        <div class="cabinet-meta-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            </svg>
                            <span id="cabinetType">Loading...</span>
                        </div>
                    </div>

                    <div class="action-buttons-view">
                        <button class="btn-primary" onclick="openEditCabinetModal()">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            Edit Cabinet
                        </button>

                        <button class="btn-danger" onclick="openArchiveCabinetModal()">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="21 8 21 21 3 21 3 8"></polyline>
                                <rect x="1" y="3" width="22" height="5"></rect>
                                <line x1="10" y1="12" x2="14" y2="12"></line>
                            </svg>
                            Archive
                        </button>
                    </div>
                </div>
            </div>

            <div class="info-grid">
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-card-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="9" y1="3" x2="9" y2="21"></line>
                            </svg>
                        </div>
                        <h3>Cabinet Information</h3>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Cabinet ID</span>
                        <span class="info-value" id="cabinetId">Loading...</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Type</span>
                        <span class="info-value" id="cabinetTypeInfo">Loading...</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Last Updated</span>
                        <span class="info-value" id="lastUpdated">Loading...</span>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-card-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                            </svg>
                        </div>
                        <h3>GPS Location</h3>
                    </div>

                    <div class="map-container">
                        <iframe
                            id="cabinetMap"
                            width="100%"
                            height="350"
                            frameborder="0"
                            style="border:0; border-radius: 8px;"
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps/embed/v1/place?key=YOUR_API_KEY&q=33.5731,-7.5898&zoom=15"
                            allowfullscreen>
                        </iframe>
                    </div>

                    <div class="info-item" style="margin-top: 16px;">
                        <span class="info-label">Address</span>
                        <span class="info-value" id="cabinetAddress">Loading...</span>
                    </div>

                    <div class="location-actions" style="margin-top: 12px; display: flex; gap: 8px;">
                        <button class="btn-secondary" onclick="openInMaps()" style="flex: 1;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 6px;">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            Open in Maps
                        </button>

                        <button class="btn-secondary" onclick="copyCoordinates()" style="flex: 1;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 6px;">
                                <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                            </svg>
                            Copy Coordinates
                        </button>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-card-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <h3>Operating Hours</h3>
                    </div>

                    <table class="schedule-table">
                        <tbody>
                            <tr>
                                <td>Monday - Friday</td>
                                <td style="text-align: right;">8:00 AM - 6:00 PM</td>
                            </tr>
                            <tr>
                                <td>Saturday</td>
                                <td style="text-align: right;">9:00 AM - 2:00 PM</td>
                            </tr>
                            <tr>
                                <td>Sunday</td>
                                <td style="text-align: right;">Closed</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-card-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                            </svg>
                        </div>
                        <h3>Cabinet Specialties</h3>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Primary</span>
                        <span class="info-value" id="primarySpecialty">Loading...</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Secondary</span>
                        <span class="info-value" id="secondarySpecialty">General Medicine</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Services</span>
                        <span class="info-value" id="specialtyServices">Diagnostics, Consultations, Emergency Care</span>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="10" r="4"></circle>
                        </svg>
                    </div>
                    <h3>Cabinet Administrator</h3>
                </div>

                <div id="adminInfo">
                    <div class="admin-card">
                        <div class="admin-avatar">JD</div>
                        <div class="admin-info">
                            <h4>Dr. John Doe</h4>
                            <p>john.doe@cabinet.com • Administrator</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script src="../JS/superadmin.js"></script>
    <script src="../ajax/superadmin_view_cabinet.js"></script>
    <script>
        function openEditCabinetModal() {
            alert('Edit cabinet functionality - will open modal');
        }

        function openArchiveCabinetModal() {
            if (confirm('Are you sure you want to archive this cabinet?')) {
                alert('Cabinet archived successfully!');
                window.location.href = 'cabinets.php';
            }
        }

        function openInMaps() {
            window.open('https://maps.app.goo.gl/KChWbENnaBpKaWTP6', '_blank');
        }

        function copyCoordinates() {
            const coordinates = '33.5731° N, -7.5898° W';
            navigator.clipboard.writeText(coordinates).then(() => {
                alert('Coordinates copied to clipboard!');
            }).catch(err => {
                console.error('Failed to copy coordinates: ', err);
            });
        }
    </script>
</body>
</html>
