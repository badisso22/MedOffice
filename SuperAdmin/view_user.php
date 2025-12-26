<?php
session_start();
require '../config/config.php';

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true || $_SESSION['roleID'] != 1) {
    header("Location: ../login-forms/login.php");
    exit();
}

$firstName = $_SESSION['firstName'] ?? 'Super';
$lastName  = $_SESSION['lastName'] ?? 'Admin';
$fullName  = trim($firstName . ' ' . $lastName);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User - Admin Dashboard</title>
    <link rel="stylesheet" href="../CSS/superadmin.css">
    <link rel="stylesheet" href="../CSS/superadmin_view_user.css">
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
                    <span class="user-name"><?= htmlspecialchars($fullName) ?></span>
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
            <li><a href="users.php" class="menu-item active">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <span>User Management</span>
            </a></li>
            <li><a href="cabinets.php" class="menu-item">
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
        <div class="view-header">
            <button class="back-btn" onclick="window.location.href='users.php'">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Back to Users
            </button>
            <h1>User Details</h1>
        </div>

        <div class="user-profile-header">
            <div class="profile-avatar">
                <img id="vuAvatar" src="/placeholder.svg?height=120&width=120" alt="User Avatar">
                <span class="status-indicator active" id="vuStatusIndicator"></span>
            </div>
            <div class="profile-info">
                <h2 id="vuFullName">Loading...</h2>
                <p class="user-id" id="vuUserCode"></p>
                <div class="profile-badges">
                    <span class="badge active" id="vuStatusBadge">Active</span>
                    <span class="badge" id="vuRoleBadge">Admin</span>
                </div>
            </div>
            <div class="profile-actions">
                <button class="btn-secondary" id="vuEditBtn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    Edit User
                </button>
            </div>
        </div>

        <div class="details-grid">
            <div class="detail-card">
                <div class="card-header">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <h3>Personal Information</h3>
                </div>
                <div class="card-content">
                    <div class="info-row">
                        <span class="info-label">Full Name</span>
                        <span class="info-value" id="vuPIFullName">—</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <span class="info-value" id="vuPIEmail">—</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Phone</span>
                        <span class="info-value" id="vuPIPhone">—</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">License Number</span>
                        <span class="info-value" id="vuPILicense">—</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Specialization</span>
                        <span class="info-value" id="vuPISpeciality">—</span>
                    </div>
                </div>
            </div>

            <div class="detail-card">
                <div class="card-header">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="9" y1="3" x2="9" y2="21"></line>
                    </svg>
                    <h3>Cabinet Information</h3>
                </div>
                <div class="card-content">
                    <div class="info-row">
                        <span class="info-label">Cabinet Name</span>
                        <span class="info-value" id="vuCabinetName">—</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Cabinet ID</span>
                        <span class="info-value" id="vuCabinetID">—</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Role</span>
                        <span class="info-value" id="vuCabinetRole">Primary Admin</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Joined Date</span>
                        <span class="info-value" id="vuCabinetJoined">—</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Address</span>
                        <span class="info-value" id="vuCabinetAddress">—</span>
                    </div>
                </div>
            </div>

            <div class="detail-card">
                <div class="card-header">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    <h3>Account Status</h3>
                </div>
                <div class="card-content">
                    <div class="info-row">
                        <span class="info-label">Status</span>
                        <span class="info-value" id="vuAccStatus">
                            <span class="badge active">Active</span>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Last Login</span>
                        <span class="info-value" id="vuAccLastLogin">—</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Created Date</span>
                        <span class="info-value" id="vuAccCreated">—</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Last Modified</span>
                        <span class="info-value" id="vuAccModified">—</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Total Sessions</span>
                        <span class="info-value" id="vuAccSessions">—</span>
                    </div>
                </div>
            </div>

            <div class="detail-card">
                <div class="card-header">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <h3>Permissions & Access</h3>
                </div>
                <div class="card-content">
                    <div class="info-row">
                        <span class="info-label">User Management</span>
                        <span class="info-value">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Appointment Management</span>
                        <span class="info-value">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Billing Access</span>
                        <span class="info-value">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Reports Access</span>
                        <span class="info-value">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Settings Management</span>
                        <span class="info-value">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="detail-card" style="margin-top: 2rem;">
            <div class="card-header">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                </svg>
                <h3>Recent Activity</h3>
            </div>
            <div class="card-content">
                <div class="activity-timeline" id="vuActivityTimeline">
                    <div class="activity-item">
                        <div class="activity-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                        </div>
                        <div class="activity-details">
                            <p class="activity-title">Activity will be loaded or configured here.</p>
                            <p class="activity-time">—</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="../JS/superadmin.js"></script>
    <script src="../ajax/superadmin_view_user.js"></script>
</body>
</html>
