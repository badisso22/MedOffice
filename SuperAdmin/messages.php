<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages - Admin Dashboard</title>
    <link rel="stylesheet" href="../CSS/superadmin.css">
    <link rel="stylesheet" href="../CSS/superadmin_messages.css">   
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
                    <input type="text" placeholder="Search conversations..." id="searchInput" onkeyup="filterConversations()">
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
            <li><a href="messages.html" class="menu-item active">
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
                <h1>Messages</h1>
                <p>User conversations</p>
            </div>
        </div>

        <div class="messages-list-page">
            <div class="messages-header">
                <h2>Conversations</h2>
                <span class="messages-count" id="messageCount">5 chats</span>
            </div>
            <div class="conversation-list" id="conversationList">
            </div>
        </div>
    </main>

    <script>
        const conversations = [
            {
                id: 'user-1',
                name: 'John Edwards',
                avatar: 'JE',
                online: true,
                time: '2 mins ago',
                preview: 'Hey, I need help with accessing my cabinet. Can you assist me?',
                unreadCount: 3,
                isUnread: true
            },
            {
                id: 'user-2',
                name: 'Sarah Miller',
                avatar: 'SM',
                online: true,
                time: '15 mins ago',
                preview: 'Thank you for the quick response! Everything is working now.',
                unreadCount: 0,
                isUnread: false
            },
            {
                id: 'user-3',
                name: 'Michael Chen',
                avatar: 'MC',
                online: false,
                time: '1 hour ago',
                preview: 'Is there a way to upgrade my subscription plan?',
                unreadCount: 1,
                isUnread: true
            },
            {
                id: 'user-4',
                name: 'Emma Wilson',
                avatar: 'EW',
                online: false,
                time: '3 hours ago',
                preview: 'I really appreciate your help with the billing issue.',
                unreadCount: 0,
                isUnread: false
            },
            {
                id: 'user-5',
                name: 'David Brown',
                avatar: 'DB',
                online: true,
                time: '5 hours ago',
                preview: 'Could you send me the documentation for the API integration?',
                unreadCount: 2,
                isUnread: true
            }
        ];

        function renderConversations() {
            const list = document.getElementById('conversationList');
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            
            let filtered = conversations;
            if (searchTerm) {
                filtered = conversations.filter(conv => 
                    conv.name.toLowerCase().includes(searchTerm) ||
                    conv.preview.toLowerCase().includes(searchTerm)
                );
            }
            document.getElementById('messageCount').textContent = `${filtered.length} chat${filtered.length !== 1 ? 's' : ''}`;

            if (filtered.length === 0) {
                list.innerHTML = `
                    <div class="empty-messages">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                        <h3>No conversations found</h3>
                        <p>Try a different search term</p>
                    </div>
                `;
                return;
            }

            list.innerHTML = filtered.map(conv => `
                <div class="conversation-card ${conv.isUnread ? 'unread' : ''}" onclick="openChat('${conv.id}')">
                    <div class="conversation-avatar ${conv.online ? 'online' : ''}">
                        ${conv.avatar}
                    </div>
                    <div class="conversation-info">
                        <div class="conversation-header">
                            <h3 class="conversation-name">${conv.name}</h3>
                            <span class="conversation-time">${conv.time}</span>
                        </div>
                        <p class="conversation-preview">${conv.preview}</p>
                        <div class="conversation-meta">
                            ${conv.unreadCount > 0 ? `<span class="unread-badge">${conv.unreadCount}</span>` : ''}
                            <span class="message-type-tag">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                User
                            </span>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function filterConversations() {
            renderConversations();
        }

        function openChat(userId) {
            const conversation = conversations.find(c => c.id === userId);
            if (conversation) {
                sessionStorage.setItem('selectedConversation', JSON.stringify(conversation));
                window.location.href = 'chat.php?user=' + userId;
            }
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.style.transform = sidebar.style.transform === 'translateX(-100%)' 
                ? 'translateX(0)' 
                : 'translateX(-100%)';
        }
        renderConversations();
    </script>
</body>
</html>
