<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Cabinet - Admin</title>
    <link rel="stylesheet" href="../CSS/about-cabinet.css">
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="stylesheet" href="../CSS/edit_cabinet.css">
</head>
<body>
    <nav>
        <div class="nav-container">
            <button class="drawer-toggle" onclick="toggleDrawer()">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <a href="dashboard_admin.php" class="logo">
                <div class="logo-icon">⚕</div>
                MedOffice Admin
            </a>
            <div class="nav-cta">
                <span class="user-name">Admin Manager</span>
                <a href="../index.html" class="btn btn-secondary">Logout</a>
            </div>
        </div>
    </nav>

    <div class="drawer" id="drawer">
        <div class="drawer-header">
            <div class="logo">
                <div class="logo-icon">⚕</div>
                MedOffice Admin
            </div>
            <button class="drawer-close" onclick="toggleDrawer()">&times;</button>
        </div>
        <ul class="drawer-menu">
            <li><a href="dashboard_admin.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                Dashboard
            </a></li>
            <li><a href="cabinet_management.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                Cabinets
            </a></li>
            <li><a href="searchP.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.35-4.35"></path></svg>
                Search Patients
            </a></li>
        </ul>
    </div>

    <div class="drawer-overlay" id="drawerOverlay" onclick="toggleDrawer()"></div>

    <div class="futuristic-bg">
        <div class="grid-overlay"></div>
        <div class="glow-orb glow-orb-1"></div>
        <div class="glow-orb glow-orb-2"></div>
        <div class="glow-orb glow-orb-3"></div>
    </div>

    <header class="cabinet-header-main">
        <div class="header-content">
            <div class="header-icon">
                <svg viewBox="0 0 24 24" width="40" height="40">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
            </div>
            <div>
                <h1>Edit Cabinet Information</h1>
                <p>Update Cabinet Details</p>
            </div>
        </div>
    </header>

    <div class="cabinet-dashboard">
        <div class="glass-card edit-container">
            <div class="edit-grid">
                <div class="edit-field-card">
                    <div class="field-header">
                        <h3>Cabinet Name</h3>
                        <button class="edit-btn" onclick="openEditModal('name', 'Cabinet Name', 'General Clinic', 'text')">
                            <svg viewBox="0 0 24 24" width="18" height="18">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </button>
                    </div>
                    <p class="field-value">General Clinic</p>
                </div>
                <div class="edit-field-card">
                    <div class="field-header">
                        <h3>Speciality</h3>
                        <button class="edit-btn" onclick="openEditModal('speciality', 'Cabinet Speciality', 'General Medicine', 'text')">
                            <svg viewBox="0 0 24 24" width="18" height="18">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </button>
                    </div>
                    <p class="field-value">General Medicine</p>
                </div>
                <div class="edit-field-card">
                    <div class="field-header">
                        <h3>Location</h3>
                        <button class="edit-btn" onclick="openEditModal('location', 'Cabinet Location', '123 Medical Street', 'textarea')">
                            <svg viewBox="0 0 24 24" width="18" height="18">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </button>
                    </div>
                    <p class="field-value">123 Medical Street, City Center</p>
                </div>
                <div class="edit-field-card">
                    <div class="field-header">
                        <h3>Phone Number</h3>
                        <button class="edit-btn" onclick="openEditModal('phone', 'Phone Number', '+1 (555) 123-4567', 'tel')">
                            <svg viewBox="0 0 24 24" width="18" height="18">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </button>
                    </div>
                    <p class="field-value">+1 (555) 123-4567</p>
                </div>
                <div class="edit-field-card">
                    <div class="field-header">
                        <h3>Working Hours</h3>
                        <button class="edit-btn" onclick="openEditModal('hours', 'Working Hours', 'Monday-Friday: 9AM-6PM', 'textarea')">
                            <svg viewBox="0 0 24 24" width="18" height="18">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </button>
                    </div>
                    <p class="field-value">Monday-Friday: 9AM-6PM<br>Saturday: 10AM-4PM</p>
                </div>
                <div class="edit-field-card">
                    <div class="field-header">
                        <h3>Status</h3>
                        <button class="edit-btn" onclick="openEditModal('status', 'Cabinet Status', 'active', 'select')">
                            <svg viewBox="0 0 24 24" width="18" height="18">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </button>
                    </div>
                    <p class="field-value"><span class="status-badge active">Active</span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-overlay" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Edit Field</h2>
                <button class="modal-close" onclick="closeEditModal()">&times;</button>
            </div>
            
            <div class="modal-body">
                <div id="inputContainer"></div>
            </div>
            
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeEditModal()">Cancel</button>
                <button class="btn-save" onclick="saveEdit()">Save Changes</button>
            </div>
        </div>
    </div>
    <div class="modal-overlay" id="successModal">
        <div class="modal-content modal-success">
            <div class="modal-icon">
                <svg viewBox="0 0 24 24" width="48" height="48">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>
            <h2>Success!</h2>
            <p id="successMessage">Cabinet information has been updated</p>
            <button class="btn-close-success" onclick="closeSuccessModal()">Close</button>
        </div>
    </div>

    <a href="about-cabinet.php" class="btn btn-white btn-large">←Back to Cabinet View</a>

    <footer class="cabinet-footer">
        <p>&copy; 2025 Medical Office | Cabinet Edit Management | All Rights Reserved</p>
    </footer>

    <script src="../JS/edit_cabinet.js"></script>
    <script>
        function toggleDrawer() {
            const drawer = document.getElementById('drawer');
            drawer.classList.toggle('open');
        }
    </script>
</body>
</html>
