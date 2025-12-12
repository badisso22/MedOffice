<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with MedAI</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="../CSS/medAi_chat.css">
</head>
<body>
    <nav>
        <div class="nav-container">
            <button class="drawer-toggle" id="drawerToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <a href="dashboard_p.php" class="logo">
                <div class="logo-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" width="24" height="24">
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
                    </svg>
                </div>
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
            <li><a href="cabinet_info.php">
                <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                Cabinet Info
            </a></li>
            <li><a href="cabinet_info.php">
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
    <div class="chat-container">
        <div class="chat-header">
            <div class="chat-header-content">
                <div class="chat-header-icon">
                    <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="white" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                    </svg>
                </div>
                <div class="chat-header-info">
                    <h1>MedAI Assistant</h1>
                    <p>Online • Ready to help</p>
                </div>
            </div>
        </div>

        <div class="chat-messages" id="chatMessages">
            <div class="welcome-message">
                <h2>Welcome to MedAI</h2>
                <p>Hello! I'm your AI healthcare assistant. I'm here to help answer your health questions, provide information about symptoms, medications, and general wellness tips. How can I assist you today?</p>
            </div>

            <div class="message ai">
                <div class="message-avatar">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                    </svg>
                </div>
                <div class="message-content">
                    <div class="message-bubble">
                        Hi! I'm MedAI, your intelligent healthcare assistant. I can help you with symptom analysis, medication information, health tips, and answer general health questions. Remember, I'm here for informational support and not a substitute for professional medical advice.
                    </div>
                    <div class="message-time">Just now</div>
                </div>
            </div>
        </div>

        <div class="chat-input-area">
            <div class="chat-input-container">
                <div class="chat-input-wrapper">
                    <textarea 
                        id="messageInput" 
                        class="chat-input" 
                        placeholder="Type your health question or message here..." 
                        rows="1"
                    ></textarea>
                    <div class="char-count"><span id="charCount">0</span>/500</div>
                </div>
                <button class="send-btn" id="sendBtn" title="Send message">
                    <svg viewBox="0 0 24 24">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <script>
        const drawerToggle = document.getElementById('drawerToggle');
        const drawerClose = document.getElementById('drawerClose');
        const drawer = document.getElementById('drawer');
        const drawerOverlay = document.getElementById('drawerOverlay');

        drawerToggle.addEventListener('click', () => {
            drawer.classList.add('open');
            drawerOverlay.classList.add('active');
        });

        drawerClose.addEventListener('click', () => {
            drawer.classList.remove('open');
            drawerOverlay.classList.remove('active');
        });

        drawerOverlay.addEventListener('click', () => {
            drawer.classList.remove('open');
            drawerOverlay.classList.remove('active');
        });

        // Chat functionality
        const messageInput = document.getElementById('messageInput');
        const sendBtn = document.getElementById('sendBtn');
        const chatMessages = document.getElementById('chatMessages');
        const charCount = document.getElementById('charCount');

        // Auto-resize textarea
        messageInput.addEventListener('input', () => {
            messageInput.style.height = 'auto';
            messageInput.style.height = Math.min(messageInput.scrollHeight, 120) + 'px';
            charCount.textContent = messageInput.value.length;
            sendBtn.disabled = messageInput.value.trim().length === 0;
        });

        // Send message
        const sendMessage = () => {
            const message = messageInput.value.trim();
            if (message.length === 0) return;

            // Add user message
            const userMessageDiv = document.createElement('div');
            userMessageDiv.className = 'message user';
            userMessageDiv.innerHTML = `
                <div class="message-avatar">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <div class="message-content">
                    <div class="message-bubble">${escapeHtml(message)}</div>
                    <div class="message-time">Now</div>
                </div>
            `;
            chatMessages.appendChild(userMessageDiv);

            // Clear input
            messageInput.value = '';
            messageInput.style.height = 'auto';
            charCount.textContent = '0';
            sendBtn.disabled = true;

            // Scroll to bottom
            chatMessages.scrollTop = chatMessages.scrollHeight;

            // Simulate AI typing
            setTimeout(() => {
                const typingDiv = document.createElement('div');
                typingDiv.className = 'message ai';
                typingDiv.innerHTML = `
                    <div class="message-avatar">
                        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                        </svg>
                    </div>
                    <div class="message-content">
                        <div class="message-bubble">
                            <div class="typing-indicator">
                                <div class="typing-dot"></div>
                                <div class="typing-dot"></div>
                                <div class="typing-dot"></div>
                            </div>
                        </div>
                    </div>
                `;
                chatMessages.appendChild(typingDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;

                // Simulate AI response after 2 seconds
                setTimeout(() => {
                    typingDiv.remove();
                    const aiMessageDiv = document.createElement('div');
                    aiMessageDiv.className = 'message ai';
                    aiMessageDiv.innerHTML = `
                        <div class="message-avatar">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                            </svg>
                        </div>
                        <div class="message-content">
                            <div class="message-bubble">
                                I appreciate your question! This is a demo chat interface, so I can't provide actual medical responses. In a real implementation, this would be connected to an AI backend to give you accurate health information. For now, feel free to explore the chat interface and see how it works!
                            </div>
                            <div class="message-time">Now</div>
                        </div>
                    `;
                    chatMessages.appendChild(aiMessageDiv);
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }, 2000);
            }, 500);
        };

        sendBtn.addEventListener('click', sendMessage);
        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        // Disable send button initially
        sendBtn.disabled = true;

        // Escape HTML to prevent XSS
        function escapeHtml(text) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, m => map[m]);
        }

        // Logout function
        function logout() {
            // Implement logout logic here
            alert('Logging out...');
        }
    </script>
</body>
</html>
