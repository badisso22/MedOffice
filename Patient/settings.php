<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Settings - MediCare</title>
  <link rel="stylesheet" href="../CSS/general.css">
  <link rel="stylesheet" href="../CSS/settings.css" />
  <link rel="stylesheet" href="../CSS/form_validations.css" />

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
            <li><a href="patientProfile.php">
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
            <li><a href="myPrescriptions.php">
                <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                Consultations
            </a></li>
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

  <div class="settings-layout">
    <aside class="settings-sidebar">
      <div class="sidebar-header">
        <h2>Settings</h2>
        <p>Manage your account preferences</p>
      </div>
      <ul class="settings-menu">
        <li>
          <button class="active" onclick="showSection('profile')">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
            Profile
          </button>
        </li>
        <li>
          <button onclick="showSection('security')">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
            Security
          </button>
        </li>
        <li>
          <button onclick="showSection('appearance')">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
              <circle cx="8.5" cy="8.5" r="1.5"></circle>
              <polyline points="21 15 16 10 5 21"></polyline>
            </svg>
            Appearance
          </button>
        </li>
        <li>
          <button onclick="showSection('account')">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="3"></circle>
              <path d="M12 1v6m0 6v6m5.2-13.2l-4.2 4.2m0 6l4.2 4.2M23 12h-6m-6 0H1m18.2 5.2l-4.2-4.2m0-6l4.2-4.2"></path>
            </svg>
            Account
          </button>
        </li>
      </ul>
    </aside>

    <main class="settings-content">
      <section class="settings-section active" id="profile">
        <div class="section-header">
          <h2>Profile Settings</h2>
          <p>Update your personal information and preferences</p>
        </div>
        
        <div class="settings-card">
          <div class="card-header">
            <h3>Personal Information</h3>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" id="username" value="KimP" />
              <span class="form-hint">This is your public display name</span>
            </div>
            <div class="form-group">
              <label for="email">Email Address</label>
              <input type="email" id="email" value="kim.park@medic-office.com" />
              <span class="form-hint">We'll send notifications to this email</span>
            </div>
            <div class="form-group">
              <label for="phone">Phone Number</label>
              <input type="tel" id="phone" placeholder="+1 (555) 000-0000" />
            </div>
            <div class="form-group">
              <label for="language">Language</label>
              <select id="language">
                <option value="en">English</option>
                <option value="fr">French</option>
                <option value="es">Spanish</option>
                <option value="de">German</option>
              </select>
            </div>
          </div>
          <div class="card-footer">
            <button class="btn btn-primary">Save Changes</button>
            <button class="btn btn-secondary">Cancel</button>
          </div>
        </div>
      </section>
      <section class="settings-section" id="security">
        <div class="section-header">
          <h2>Security Settings</h2>
          <p>Manage your password and security preferences</p>
        </div>

        <div class="settings-card">
          <div class="card-header">
            <h3>Change Password</h3>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="oldpw">Current Password</label>
              <input type="password" id="oldpw" placeholder="Enter current password" />
            </div>
            <div class="form-group">
              <label for="newpw">New Password</label>
              <input type="password" id="newpw" placeholder="Enter new password" />
              <span class="form-hint">Must be at least 8 characters</span>
            </div>
            <div class="form-group">
              <label for="confirmpw">Confirm New Password</label>
              <input type="password" id="confirmpw" placeholder="Confirm new password" />
            </div>
          </div>
          <div class="card-footer">
            <button class="btn btn-primary">Update Password</button>
          </div>
        </div>

        <div class="settings-card">
          <div class="card-header">
            <h3>Two-Factor Authentication</h3>
          </div>
          <div class="card-body">
            <div class="toggle-group">
              <div class="toggle-info">
                <h4>Enable 2FA</h4>
                <p>Add an extra layer of security to your account</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" id="2fa" />
                <span class="toggle-slider"></span>
              </label>
            </div>
            <div class="form-group">
              <label for="security-question">Security Question</label>
              <select id="security-question">
                <option>What is your pet's name?</option>
                <option>Mother's maiden name?</option>
                <option>Your favorite city?</option>
                <option>First car model?</option>
              </select>
            </div>
            <div class="form-group">
              <label for="security-answer">Answer</label>
              <input type="text" id="security-answer" placeholder="Your answer" />
            </div>
          </div>
          <div class="card-footer">
            <button class="btn btn-primary">Save Security Settings</button>
          </div>
        </div>
      </section>
      <section class="settings-section" id="appearance">
        <div class="section-header">
          <h2>Appearance Settings</h2>
          <p>Customize how MediCare looks for you</p>
        </div>

        <div class="settings-card">
          <div class="card-header">
            <h3>Theme Preferences</h3>
          </div>
          <div class="card-body">
            <div class="toggle-group">
              <div class="toggle-info">
                <h4>Dark Mode</h4>
                <p>Switch to a darker color scheme</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" id="darkmode" />
                <span class="toggle-slider"></span>
              </label>
            </div>
            <div class="form-group">
              <label for="accent-color">Accent Color</label>
              <div class="color-picker-group">
                <input type="color" id="accent-color" value="#0891b2" />
                <span class="color-value">#0891b2</span>
              </div>
              <span class="form-hint">Choose your preferred accent color</span>
            </div>
          </div>
        </div>

        <div class="settings-card">
          <div class="card-header">
            <h3>Profile Picture</h3>
          </div>
          <div class="card-body">
            <div class="profile-picture-section">
              <div class="profile-picture-preview">
                <div class="avatar-placeholder">
                  <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                  </svg>
                </div>
              </div>
              <div class="profile-picture-actions">
                <label for="profile-upload" class="btn btn-primary">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="17 8 12 3 7 8"></polyline>
                    <line x1="12" y1="3" x2="12" y2="15"></line>
                  </svg>
                  Upload New Picture
                </label>
                <input type="file" id="profile-upload" accept="image/*" style="display: none;" />
                <button class="btn btn-secondary">Remove</button>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="settings-section" id="account">
        <div class="section-header">
          <h2>Account Management</h2>
          <p>Manage your account data and preferences</p>
        </div>

        <div class="settings-card">
          <div class="card-header">
            <h3>Data & Privacy</h3>
          </div>
          <div class="card-body">
            <div class="action-row">
              <div class="action-info">
                <h4>Export Your Data</h4>
                <p>Download a copy of all your account data</p>
              </div>
              <button class="btn btn-secondary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                  <polyline points="7 10 12 15 17 10"></polyline>
                  <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                Export Data
              </button>
            </div>
            <div class="action-row">
              <div class="action-info">
                <h4>Sign Out</h4>
                <p>Sign out from your account </p>
              </div>
              <a href="../config/logout.php" class="btn btn-secondary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                  <polyline points="16 17 21 12 16 7"></polyline>
                  <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                Sign Out
              </a>
            </div>
          </div>
        </div>

        <div class="settings-card danger-card">
          <div class="card-header">
            <h3>Danger Zone</h3>
          </div>
          <div class="card-body">
            <div class="action-row">
              <div class="action-info">
                <h4>Delete Account</h4>
                <p>Permanently delete your account and all associated data. This action cannot be undone.</p>
              </div>
              <button class="btn btn-danger">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <polyline points="3 6 5 6 21 6"></polyline>
                  <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                </svg>
                Delete Account
              </button>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</body>
<script src="../JS/form_validations.js"></script>
<script>
  function showSection(id) {
    document.querySelectorAll('.settings-menu button').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.settings-section').forEach(sec => sec.classList.remove('active'));
    document.querySelector('.settings-menu button[onclick*="' + id + '"]').classList.add('active');
    document.getElementById(id).classList.add('active');
  }
  document.getElementById('accent-color')?.addEventListener('input', (e) => {
    document.querySelector('.color-value').textContent = e.target.value;
  });

   function toggleDrawer() {
            const drawer = document.getElementById('drawer');
            const overlay = document.getElementById('drawerOverlay');
            drawer.classList.toggle('open');
            overlay.classList.toggle('active');
        }
        function logout() {
            window.location.href = '../index.html';
        }
</script>
</html>
