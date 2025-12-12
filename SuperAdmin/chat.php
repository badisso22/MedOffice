<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - Admin Dashboard</title>
    <link rel="stylesheet" href="../CSS/superadmin.css">
    <link rel="stylesheet" href="../CSS/superadmin_chat.css">
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
        <div class="chat-page">
            <div class="chat-header-section">
                <button class="back-btn" onclick="goBack()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                </button>
                <div class="chat-user-avatar online" id="chatAvatar">JE</div>
                <div class="chat-user-info">
                    <h2 class="chat-user-name" id="chatUserName">John Edwards</h2>
                    <div class="chat-user-status">
                        <span class="status-dot online" id="statusDot"></span>
                        <span id="statusText">Online</span>
                    </div>
                </div>
                <div class="chat-actions">
                    <button class="chat-action-btn" title="User Info">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                    </button>
                    <button class="chat-action-btn" title="More Options">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="12" cy="5" r="1"></circle>
                            <circle cx="12" cy="19" r="1"></circle>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="chat-messages-container">
                <div class="chat-messages" id="chatMessages">
                </div>
                <div class="chat-input-container">
                    <div class="chat-input-wrapper">
                        <textarea 
                            class="chat-input" 
                            id="messageInput" 
                            placeholder="Type your message..."
                            rows="1"
                            onkeypress="handleKeyPress(event)"
                        ></textarea>
                    </div>
                    <button class="send-btn" onclick="sendMessage()">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </main>

    <script>
        const chatData = {
            'user-1': {
                name: 'John Edwards',
                avatar: 'JE',
                online: true,
                messages: [
                    { type: 'received', text: 'Hey, I need help with accessing my cabinet.', time: '10:30 AM', date: 'Today' },
                    { type: 'received', text: 'Can you assist me?', time: '10:31 AM', date: 'Today' },
                    { type: 'sent', text: 'Hi John! Of course, I\'d be happy to help. What seems to be the issue?', time: '10:32 AM', date: 'Today' },
                    { type: 'received', text: 'I can\'t seem to login to my cabinet dashboard. It keeps showing an error.', time: '10:33 AM', date: 'Today' },
                    { type: 'sent', text: 'Let me check your account status. One moment please.', time: '10:34 AM', date: 'Today' }
                ]
            },
            'user-2': {
                name: 'Sarah Miller',
                avatar: 'SM',
                online: true,
                messages: [
                    { type: 'received', text: 'I had an issue with my payment but it\'s resolved now.', time: '9:45 AM', date: 'Today' },
                    { type: 'sent', text: 'I\'m glad to hear everything is working!', time: '9:46 AM', date: 'Today' },
                    { type: 'received', text: 'Thank you for the quick response! Everything is working now.', time: '9:47 AM', date: 'Today' },
                    { type: 'sent', text: 'You\'re welcome! Feel free to reach out if you need anything else.', time: '9:48 AM', date: 'Today' }
                ]
            },
            'user-3': {
                name: 'Michael Chen',
                avatar: 'MC',
                online: false,
                messages: [
                    { type: 'received', text: 'Is there a way to upgrade my subscription plan?', time: '8:20 AM', date: 'Today' },
                    { type: 'sent', text: 'Yes! I can help you with that. What plan are you interested in?', time: '8:22 AM', date: 'Today' },
                    { type: 'received', text: 'I\'d like to move to the Pro plan.', time: '8:25 AM', date: 'Today' }
                ]
            },
            'user-4': {
                name: 'Emma Wilson',
                avatar: 'EW',
                online: false,
                messages: [
                    { type: 'received', text: 'I had a billing question earlier.', time: '7:10 AM', date: 'Today' },
                    { type: 'sent', text: 'I see it was resolved. Is there anything else I can help with?', time: '7:12 AM', date: 'Today' },
                    { type: 'received', text: 'I really appreciate your help with the billing issue.', time: '7:15 AM', date: 'Today' }
                ]
            },
            'user-5': {
                name: 'David Brown',
                avatar: 'DB',
                online: true,
                messages: [
                    { type: 'received', text: 'Could you send me the documentation for the API integration?', time: '6:30 AM', date: 'Today' },
                    { type: 'sent', text: 'I\'ll send you the link right away.', time: '6:32 AM', date: 'Today' },
                    { type: 'received', text: 'Perfect, thank you!', time: '6:35 AM', date: 'Today' }
                ]
            }
        };

        function loadChat() {
            const urlParams = new URLSearchParams(window.location.search);
            const userId = urlParams.get('user');
            
            if (!userId || !chatData[userId]) {
                window.location.href = 'messages.html';
                return;
            }

            const chat = chatData[userId];
            
            document.getElementById('chatUserName').textContent = chat.name;
            document.getElementById('chatAvatar').textContent = chat.avatar;
            document.getElementById('statusText').textContent = chat.online ? 'Online' : 'Offline';
            
            if (chat.online) {
                document.getElementById('chatAvatar').classList.add('online');
                document.getElementById('statusDot').classList.add('online');
            }

            const messagesContainer = document.getElementById('chatMessages');
            let lastDate = '';
            
            messagesContainer.innerHTML = chat.messages.map(msg => {
                let dateDiv = '';
                if (msg.date !== lastDate) {
                    dateDiv = `<div class="date-divider"><span>${msg.date}</span></div>`;
                    lastDate = msg.date;
                }
                
                return `
                    ${dateDiv}
                    <div class="chat-message ${msg.type}">
                        <div class="message-avatar">${msg.type === 'received' ? chat.avatar : 'AD'}</div>
                        <div>
                            <div class="message-bubble">${msg.text}</div>
                            <div class="message-time">${msg.time}</div>
                        </div>
                    </div>
                `;
            }).join('');
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        function sendMessage() {
            const input = document.getElementById('messageInput');
            const text = input.value.trim();
            
            if (!text) return;

            const messagesContainer = document.getElementById('chatMessages');
            const now = new Date();
            const time = now.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
            
            messagesContainer.innerHTML += `
                <div class="chat-message sent">
                    <div class="message-avatar">AD</div>
                    <div>
                        <div class="message-bubble">${text}</div>
                        <div class="message-time">${time}</div>
                    </div>
                </div>
            `;
            
            input.value = '';
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        function handleKeyPress(event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault();
                sendMessage();
            }
        }

        function goBack() {
            window.location.href = 'messages.php';
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.style.transform = sidebar.style.transform === 'translateX(-100%)' 
                ? 'translateX(0)' 
                : 'translateX(-100%)';
        }
        const textarea = document.getElementById('messageInput');
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 120) + 'px';
        });

        loadChat();
    </script>
</body>
</html>
