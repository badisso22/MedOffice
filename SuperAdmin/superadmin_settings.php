<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Admin Dashboard</title>
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
            <li><a href="superadmin_settings.php" class="menu-item active">
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
            <h1>Settings</h1>
            <p>Manage your account and preferences</p>
        </div>
        <div class="settings-grid">
            <div class="settings-card">
                <h3>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Account Settings
                </h3>
                
                <div class="settings-item">
                    <div class="settings-item-info">
                        <h4>Profile Information</h4>
                        <p>Update your name, email, and profile picture</p>
                    </div>
                    <button class="btn btn-secondary" onclick="openModal('profileModal')">Edit</button>
                </div>

                <div class="settings-item">
                    <div class="settings-item-info">
                        <h4>Change Password</h4>
                        <p>Update your password to keep your account secure</p>
                    </div>
                    <button class="btn btn-secondary" onclick="openModal('passwordModal')">Change</button>
                </div>

                <div class="settings-item">
                    <div class="settings-item-info">
                        <h4>Email Address</h4>
                        <p>admin@superadmin.com</p>
                    </div>
                    <button class="btn btn-secondary" onclick="openModal('emailModal')">Update</button>
                </div>
            </div>
            <div class="settings-card">
                <h3>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    Privacy & Security
                </h3>

                <div class="settings-item">
                    <div class="settings-item-info">
                        <h4>Two-Factor Authentication</h4>
                        <p>Add an extra layer of security to your account</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="settings-item">
                    <div class="settings-item-info">
                        <h4>Login Alerts</h4>
                        <p>Get notified of new login attempts</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="settings-item">
                    <div class="settings-item-info">
                        <h4>Active Sessions</h4>
                        <p>Manage devices where you're currently logged in</p>
                    </div>
                    <button class="btn btn-secondary">View Sessions</button>
                </div>
            </div>
            <div class="settings-card">
                <h3>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                    Notifications
                </h3>

                <div class="settings-item">
                    <div class="settings-item-info">
                        <h4>Email Notifications</h4>
                        <p>Receive updates and alerts via email</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="settings-item">
                    <div class="settings-item-info">
                        <h4>Push Notifications</h4>
                        <p>Get real-time notifications on your device</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox">
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="settings-item">
                    <div class="settings-item-info">
                        <h4>System Alerts</h4>
                        <p>Receive critical system status updates</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>
            <div class="settings-card">
                <h3>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="5"></circle>
                        <line x1="12" y1="1" x2="12" y2="3"></line>
                        <line x1="12" y1="21" x2="12" y2="23"></line>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                        <line x1="1" y1="12" x2="3" y2="12"></line>
                        <line x1="21" y1="12" x2="23" y2="12"></line>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                    </svg>
                    Appearance
                </h3>

                <div class="settings-item">
                    <div class="settings-item-info">
                        <h4>Dark Mode</h4>
                        <p>Use dark theme across the dashboard</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="settings-item">
                    <div class="settings-item-info">
                        <h4>Compact Mode</h4>
                        <p>Display more content on screen</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox">
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="settings-item">
                    <div class="settings-item-info">
                        <h4>Language</h4>
                        <p>English (US)</p>
                    </div>
                    <button class="btn btn-secondary">Change</button>
                </div>
            </div>
            <div class="settings-card">
                <h3>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                        <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                        <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                    </svg>
                    Data & Storage
                </h3>

                <div class="settings-item">
                    <div class="settings-item-info">
                        <h4>Download Your Data</h4>
                        <p>Export all your account information</p>
                    </div>
                    <button class="btn btn-secondary">Download</button>
                </div>

                <div class="settings-item">
                    <div class="settings-item-info">
                        <h4>Clear Cache</h4>
                        <p>Free up space by clearing cached data</p>
                    </div>
                    <button class="btn btn-secondary">Clear</button>
                </div>

                <div class="settings-item">
                    <div class="settings-item-info">
                        <h4>Storage Usage</h4>
                        <p>2.4 GB of 10 GB used</p>
                    </div>
                    <button class="btn btn-secondary">Manage</button>
                </div>
            </div>
            <div class="settings-card">
                <h3>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                    Danger Zone
                </h3>

                <div class="settings-item">
                    <div class="settings-item-info">
                        <h4>Deactivate Account</h4>
                        <p>Temporarily disable your account</p>
                    </div>
                    <button class="btn btn-secondary">Deactivate</button>
                </div>

                <div class="settings-item">
                    <div class="settings-item-info">
                        <h4>Delete Account</h4>
                        <p style="color: var(--danger);">Permanently delete your account and all data</p>
                    </div>
                    <button class="btn btn-secondary" style="border-color: var(--danger); color: var(--danger);">Delete</button>
                </div>
            </div>
        </div>
    </main>
    <div id="profileModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Profile</h3>
                <button class="close-modal" onclick="closeModal('profileModal')">&times;</button>
            </div>
            <div class="modal-body">
                <form onsubmit="event.preventDefault(); alert('Profile updated!'); closeModal('profileModal');">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" value="Admin User" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" value="admin" required>
                    </div>
                    <div class="form-group">
                        <label>Bio</label>
                        <textarea rows="3">System Administrator</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeModal('profileModal')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="passwordModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Change Password</h3>
                <button class="close-modal" onclick="closeModal('passwordModal')">&times;</button>
            </div>
            <div class="modal-body">
                <form onsubmit="event.preventDefault(); alert('Password changed successfully!'); closeModal('passwordModal');">
                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" required>
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeModal('passwordModal')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="emailModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Update Email</h3>
                <button class="close-modal" onclick="closeModal('emailModal')">&times;</button>
            </div>
            <div class="modal-body">
                <form onsubmit="event.preventDefault(); alert('Email updated! Please verify your new email.'); closeModal('emailModal');">
                    <div class="form-group">
                        <label>New Email Address</label>
                        <input type="email" value="admin@superadmin.com" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeModal('emailModal')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Email</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="JS/superadmin.js"></script>
</body>
</html>
