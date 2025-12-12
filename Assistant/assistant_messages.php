<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages - MedOffice</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="stylesheet" href="../CSS/chat.css">
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
                <span class="user-name">Assistant Kim</span>
                <div class="top-icons">
                    <a href="dashboard_a.php" class="icon-btn" title="Chat">
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
            <li><a href="dashboard_a.php" class="active">
                <svg viewBox="0 0 24 24" width="20" height="20"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                Dashboard
            </a></li>
            <li><a href="profileA.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Profile
            </a></li>
            <li><a href="search_paient.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.35-4.35"></path></svg>
                Patient's List
            </a></li>
            <li><a href="calendarA.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Calendar
            </a></li>
            <li><a href="add_patient.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                Add Patient
            </a></li>
            <li><a href="appointments.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Manage Appointments
            </a></li>
            <li><a href="appointments.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Waiting List
            </a></li>
            <li><a href="notes.php">
                <svg viewBox="0 0 24 24" width="20" height="20"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                Notes
            </a></li>
            <li><a href="settings.php">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06A2 2 0 1 1 6.92 4.58l.06.06c.37.37.86.54 1.34.41a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09c0 .49.19.97.54 1.34a1.65 1.65 0 0 0 1.82.33h.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82c.1.63.52 1.15 1.15 1.25z"/>
                </svg>
                Settings
            </a></li>
            <button class="drawer-logout" onclick="logout()">Logout</button>
        </ul>
    </div>

    <div class="drawer-overlay" id="drawerOverlay" onclick="toggleDrawer()"></div>

    <main class="dashboard-main messages-main">
        <div class="messages-container">
            <aside class="messages-sidebar">
                <div class="messages-header">
                    <h2>Messages</h2>
                    <button class="compose-btn" onclick="startNewMessage()">
                        <svg viewBox="0 0 24 24" width="20" height="20"><path d="M12 5v14M5 12h14"></path></svg>
                    </button>
                </div>

                <div class="messages-search">
                    <input type="text" placeholder="Search messages..." class="search-input">
                    <svg viewBox="0 0 24 24" width="18" height="18"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.35-4.35"></path></svg>
                </div>

                <ul class="messages-list">
                    <li class="message-item active" onclick="selectMessage(this, 'John Smith')">
                        <div class="message-avatar">JS</div>
                        <div class="message-preview">
                            <h4>John Smith</h4>
                            <p>Thanks for the prescription...</p>
                            <span class="message-time">2 min</span>
                        </div>
                        <span class="unread-badge">2</span>
                    </li>

                    <li class="message-item" onclick="selectMessage(this, 'Sarah Johnson')">
                        <div class="message-avatar">SJ</div>
                        <div class="message-preview">
                            <h4>Sarah Johnson</h4>
                            <p>Can I reschedule my appointment?</p>
                            <span class="message-time">5 min</span>
                        </div>
                    </li>

                    <li class="message-item" onclick="selectMessage(this, 'Michael Brown')">
                        <div class="message-avatar">MB</div>
                        <div class="message-preview">
                            <h4>Michael Brown</h4>
                            <p>Lab results look good</p>
                            <span class="message-time">1 hour</span>
                        </div>
                    </li>

                    <li class="message-item" onclick="selectMessage(this, 'Emma Wilson')">
                        <div class="message-avatar">EW</div>
                        <div class="message-preview">
                            <h4>Emma Wilson</h4>
                            <p>Please call me when you get a chance</p>
                            <span class="message-time">2 hours</span>
                        </div>
                    </li>

                    <li class="message-item" onclick="selectMessage(this, 'David Lee')">
                        <div class="message-avatar">DL</div>
                        <div class="message-preview">
                            <h4>David Lee</h4>
                            <p>Thank you for the consultation</p>
                            <span class="message-time">Yesterday</span>
                        </div>
                    </li>
                </ul>
            </aside>
            <div class="message-thread">
                <div class="thread-header">
                    <div class="thread-info">
                        <h3 id="thread-name">John Smith</h3>
                        <p>Active now</p>
                    </div>
                    <div class="thread-actions">
                        <button class="icon-btn" title="Call">
                            <svg viewBox="0 0 24 24" width="20" height="20"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </button>
                        <button class="icon-btn" title="Info">
                            <svg viewBox="0 0 24 24" width="20" height="20"><circle cx="12" cy="12" r="1"></circle><path d="M12 1a11 11 0 1 0 0 22 11 11 0 0 0 0-22z"></path></svg>
                        </button>
                    </div>
                </div>

                <div class="messages-content" id="messages-content">
                    <div class="message-group sender">
                        <div class="message">
                            <p>Hi John, how are you feeling today?</p>
                            <span class="message-timestamp">10:30 AM</span>
                        </div>
                    </div>

                    <div class="message-group receiver">
                        <div class="message">
                            <p>Much better, thanks for asking!</p>
                            <span class="message-timestamp">10:32 AM</span>
                        </div>
                        <div class="message">
                            <p>The medication you prescribed is working great</p>
                            <span class="message-timestamp">10:33 AM</span>
                        </div>
                    </div>

                    <div class="message-group sender">
                        <div class="message">
                            <p>That's wonderful to hear! Continue taking it as prescribed.</p>
                            <span class="message-timestamp">10:35 AM</span>
                        </div>
                    </div>

                    <div class="message-group receiver">
                        <div class="message">
                            <p>Thanks for the prescription and the follow-up. See you next week!</p>
                            <span class="message-timestamp">10:36 AM</span>
                        </div>
                    </div>
                </div>

                <div class="message-input-area">
                    <input type="text" id="message-input" placeholder="Type your message..." class="message-input">
                    <button class="send-btn" onclick="sendMessage()">
                        <svg viewBox="0 0 24 24" width="20" height="20"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                    </button>
                </div>
            </div>
        </div>
    </main>
    <script>
        function toggleDrawer() {
            const drawer = document.getElementById('drawer');
            const overlay = document.getElementById('drawerOverlay');
            drawer.classList.toggle('open');
            overlay.classList.toggle('active');
        }

        function selectMessage(element, name) {
            document.querySelectorAll('.message-item').forEach(item => {
                item.classList.remove('active');
            });
            element.classList.add('active');
            document.getElementById('thread-name').textContent = name;
            document.getElementById('messages-content').innerHTML = '<p style="text-align:center; color:var(--text-light);">Message history for ' + name + '</p>';
        }
    </script>
</body>
</html>
