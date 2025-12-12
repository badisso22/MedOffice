<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Cabinets - Admin Dashboard</title>
    <link rel="stylesheet" href="../CSS/superadmin.css">
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
                    <path d="M12 1v6m0 6v6M4.22 4.22l4.24 4.24m3.08 3.08l4.24 4.24M1 12h6m6 0h6m-17.78 7.78l4.24-4.24m3.08-3.08l4.24-4.24"></path>
                </svg>
                <span>Settings</span>
            </a></li>
        </ul>
    </aside>

    <main class="main-content">
        <div class="section-header">
            <div>
                <h1>Cabinet Management</h1>
                <p>Manage all available cabinets and their status</p>
            </div>
            <a href="create_cabinet.php" class="btn btn-primary">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Add Cabinet
            </a>
        </div>

        <div class="tabs-container" style="margin-bottom: 2rem;">
            <div class="tabs">
                <a href="cabinets.php" class="tab active">Active Cabinets</a>
                <a href="suspended_cabinets.php" class="tab">Suspended Cabinets</a>
                <a href="archived_cabinets.php" class="tab">Archived Cabinets</a>
            </div>
        </div>

        <div class="metrics-grid" style="margin-bottom: 2rem;">
            <div class="metric-card">
                <div class="metric-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="9" y1="3" x2="9" y2="21"></line>
                    </svg>
                </div>
                <div class="metric-content">
                    <h3>Total Active</h3>
                    <p class="metric-value">34</p>
                    <span class="metric-status positive">Operational</span>
                </div>
            </div>
            <div class="metric-card">
                <div class="metric-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <div class="metric-content">
                    <h3>Occupied</h3>
                    <p class="metric-value">28</p>
                    <span class="metric-status">82% utilization</span>
                </div>
            </div>
            <div class="metric-card">
                <div class="metric-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                </div>
                <div class="metric-content">
                    <h3>Available</h3>
                    <p class="metric-value">6</p>
                    <span class="metric-status">Ready for use</span>
                </div>
            </div>
        </div>

        <div class="data-table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Cabinet ID</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th>Last Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>CAB-001</td>
                        <td>Building A - Floor 1</td>
                        <td>Standard</td>
                        <td>25/30</td>
                        <td><span class="badge active">Active</span></td>
                        <td>1 hour ago</td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn" onclick="window.location.href='view_cabinet.php?id=1'">View</button>
                                <button class="action-btn edit" onclick="editCabinet(1, 'CAB-001', 'Building A - Floor 1', 'Standard', '30')">Edit</button>
                                <button class="action-btn archive" onclick="archiveCabinet(1, 'CAB-001')">Archive</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>CAB-002</td>
                        <td>Building A - Floor 2</td>
                        <td>Premium</td>
                        <td>18/20</td>
                        <td><span class="badge active">Active</span></td>
                        <td>2 hours ago</td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn" onclick="window.location.href='view_cabinet.php?id=2'">View</button>
                                <button class="action-btn edit" onclick="editCabinet(2, 'CAB-002', 'Building A - Floor 2', 'Premium', '20')">Edit</button>
                                <button class="action-btn archive" onclick="archiveCabinet(2, 'CAB-002')">Archive</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>CAB-003</td>
                        <td>Building B - Floor 1</td>
                        <td>Standard</td>
                        <td>12/30</td>
                        <td><span class="badge active">Active</span></td>
                        <td>3 hours ago</td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn" onclick="window.location.href='view_cabinet.php?id=3'">View</button>
                                <button class="action-btn edit" onclick="editCabinet(3, 'CAB-003', 'Building B - Floor 1', 'Standard', '30')">Edit</button>
                                <button class="action-btn archive" onclick="archiveCabinet(3, 'CAB-003')">Archive</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    <div id="viewCabinetModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Cabinet Details</h2>
                <button class="modal-close" onclick="closeModal('viewCabinetModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Cabinet ID</label>
                    <p id="viewCabinetId" style="font-weight: 600; color: var(--text-primary);"></p>
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <p id="viewLocation" style="color: var(--text-primary);"></p>
                </div>
                <div class="form-group">
                    <label>Type</label>
                    <p id="viewType" style="color: var(--text-primary);"></p>
                </div>
                <div class="form-group">
                    <label>Capacity</label>
                    <p id="viewCapacity" style="color: var(--text-primary);"></p>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <p id="viewStatus" style="color: var(--text-primary);"></p>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-secondary" onclick="closeModal('viewCabinetModal')">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="editCabinetModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Cabinet</h2>
                <button class="modal-close" onclick="closeModal('editCabinetModal')">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editCabinetForm" onsubmit="handleEditCabinet(event)">
                    <input type="hidden" id="editCabinetDbId">
                    <div class="form-group">
                        <label for="editCabinetId">Cabinet ID</label>
                        <input type="text" id="editCabinetId" name="cabinetId" required>
                    </div>
                    <div class="form-group">
                        <label for="editLocation">Location</label>
                        <input type="text" id="editLocation" name="location" required>
                    </div>
                    <div class="form-group">
                        <label for="editType">Type</label>
                        <select id="editType" name="type" required>
                            <option value="Standard">Standard</option>
                            <option value="Premium">Premium</option>
                            <option value="Compact">Compact</option>
                            <option value="Large">Large</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editCapacity">Capacity</label>
                        <input type="number" id="editCapacity" name="capacity" min="1" required>
                    </div>
                    <div class="modal-actions">
                        <button type="button" class="btn-secondary" onclick="closeModal('editCabinetModal')">Cancel</button>
                        <button type="submit" class="btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="archiveCabinetModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Archive Cabinet</h2>
                <button class="modal-close" onclick="closeModal('archiveCabinetModal')">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to archive cabinet <strong id="archiveCabinetId"></strong>?</p>
                <p style="color: var(--text-tertiary); font-size: 0.9rem; margin-top: 0.5rem;">Archived cabinets will be moved to historical records.</p>
                <input type="hidden" id="archiveCabinetDbId">
                <div class="modal-actions">
                    <button type="button" class="btn-secondary" onclick="closeModal('archiveCabinetModal')">Cancel</button>
                    <button type="button" class="btn-danger" onclick="handleArchiveCabinet()">Archive Cabinet</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../JS/superadmin.js"></script>
    <script src="../JS/superadmin_cabinets.js"></script>
</body>
</html>
