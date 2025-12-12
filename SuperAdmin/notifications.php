<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Admin Dashboard</title>
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
                <h1>Notifications</h1>
                <p>Stay updated with system alerts and updates</p>
            </div>
            <button class="btn btn-secondary" onclick="markAllAsRead()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                Mark All as Read
            </button>
        </div>

        <div class="notifications-container">
            <div class="notification-item unread" data-notification-id="1" onclick="markAsRead(1)">
                <div class="notification-icon success">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <div class="notification-content">
                    <h4>System Backup Completed</h4>
                    <p>Automatic system backup completed successfully. All data has been secured.</p>
                    <span class="notification-time">2 minutes ago</span>
                </div>
            </div>

            <div class="notification-item unread" data-notification-id="2" onclick="markAsRead(2)">
                <div class="notification-icon warning">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>
                <div class="notification-content">
                    <h4>High Memory Usage Detected</h4>
                    <p>Server memory usage has reached 85%. Consider optimization or resource upgrade.</p>
                    <span class="notification-time">1 hour ago</span>
                </div>
            </div>

            <div class="notification-item unread" data-notification-id="3" onclick="markAsRead(3)">
                <div class="notification-icon info">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                </div>
                <div class="notification-content">
                    <h4>New User Registration</h4>
                    <p>A new admin user "jane_admin" has been registered and is pending approval.</p>
                    <span class="notification-time">3 hours ago</span>
                </div>
            </div>

            <div class="notification-item" data-notification-id="4">
                <div class="notification-icon success">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <div class="notification-content">
                    <h4>Security Update Applied</h4>
                    <p>Latest security patches have been applied to the system successfully.</p>
                    <span class="notification-time">Yesterday</span>
                </div>
            </div>

            <div class="notification-item" data-notification-id="5">
                <div class="notification-icon info">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                </div>
                <div class="notification-content">
                    <h4>Monthly Report Generated</h4>
                    <p>Your monthly system performance report is now available for download.</p>
                    <span class="notification-time">2 days ago</span>
                </div>
            </div>

            <div class="notification-item" data-notification-id="6">
                <div class="notification-icon error">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                </div>
                <div class="notification-content">
                    <h4>Failed Login Attempt</h4>
                    <p>Multiple failed login attempts detected from IP address 192.168.1.105.</p>
                    <span class="notification-time">3 days ago</span>
                </div>
            </div>

            <div class="notification-item" data-notification-id="7">
                <div class="notification-icon success">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <div class="notification-content">
                    <h4>Cabinet CAB-015 Added</h4>
                    <p>New cabinet has been successfully added to Building D - Floor 2.</p>
                    <span class="notification-time">1 week ago</span>
                </div>
            </div>
        </div>
    </main>

    <script src="JS/superadmin.js"></script>
    <script>
        function markAsRead(notificationId) {
            const notification = document.querySelector(`[data-notification-id="${notificationId}"]`);
            if (notification && notification.classList.contains('unread')) {
                notification.classList.remove('unread');
                updateBadgeCount();
                console.log('[v0] Mark notification as read:', notificationId);
            }
        }

        function markAllAsRead() {
            const notifications = document.querySelectorAll('.notification-item.unread');
            notifications.forEach(notification => {
                notification.classList.remove('unread');
            });
            updateBadgeCount();
            console.log('[v0] Mark all notifications as read');
            alert('All notifications marked as read!');
        }

        function updateBadgeCount() {
            const unreadCount = document.querySelectorAll('.notification-item.unread').length;
            const badge = document.querySelector('.notification-badge');
            if (badge) {
                badge.textContent = unreadCount;
                if (unreadCount === 0) {
                    badge.style.display = 'none';
                } else {
                    badge.style.display = 'flex';
                }
            }
        }
        document.addEventListener('DOMContentLoaded', updateBadgeCount);
    </script>
</body>
</html>
