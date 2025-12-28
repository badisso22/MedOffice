<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabinet Management - Superadmin</title>
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
                <div class="user-menu">
                    <span class="user-name">Super Admin</span>
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
            <li><a href="settings.php" class="menu-item">
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
                <p>Manage all medical cabinets and their status</p>
            </div>
            <button class="btn btn-primary" onclick="openCreateModal()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Add Cabinet
            </button>
        </div>

        <div class="filters-container" style="margin-bottom: 2rem; display: flex; gap: 1rem; align-items: center;">
            <input type="text" id="cabinetSearch" placeholder="Search by name or location..." style="flex: 1; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.5rem;">
            <select id="statusFilter" style="padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.5rem;">
                <option value="all">All Status</option>
                <option value="active">Active</option>
                <option value="suspended">Suspended</option>
                <option value="archived">Archived</option>
            </select>
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
                    <h3>Total Cabinets</h3>
                    <p class="metric-value" data-stat="total">0</p>
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
                    <h3>Active</h3>
                    <p class="metric-value" data-stat="active">0</p>
                    <span class="metric-status">Online & Running</span>
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
                    <h3>Suspended</h3>
                    <p class="metric-value" data-stat="suspended">0</p>
                    <span class="metric-status">Temporarily Offline</span>
                </div>
            </div>
        </div>

        <div class="data-table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Cabinet ID</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="cabinetsTable">
                    <tr><td colspan="8" style="text-align: center; padding: 2rem; color: #9ca3af;">Loading...</td></tr>
                </tbody>
            </table>
        </div>
    </main>

    <dialog id="addCabinetModal" class="modal">
        <div class="modal-content">
            <div id="step1" class="wizard-step active">
                <div class="modal-header">
                    <h2>Create New Cabinet</h2>
                    <button class="modal-close" onclick="closeModal('addCabinetModal')">&times;</button>
                </div>
                <form id="cabinetInfoForm" onsubmit="handleCabinetInfo(event)">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="cabinetName">Cabinet Name *</label>
                            <input type="text" id="cabinetName" name="cabinetname" placeholder="e.g., ESST Medical Cabinet" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="cabinetLocation">Location *</label>
                            <input type="text" id="cabinetLocation" name="cabinetlocation" placeholder="Full address" required>
                        </div>

                        <div class="form-group">
                            <label for="cabinetPhone">Phone Number *</label>
                            <input type="tel" id="cabinetPhone" name="cabinetphonenumber" placeholder="e.g., +213555443321" required>
                        </div>

                        <div class="form-group">
                            <label for="cabinetEmail">Email *</label>
                            <input type="email" id="cabinetEmail" name="contact_email" placeholder="contact@cabinet.com" required>
                        </div>

                        <div class="form-group">
                            <label for="cabinetSpecialty">Specialty</label>
                            <input type="text" id="cabinetSpecialty" name="cabinetspeciality" placeholder="e.g., Cardiology, General Medicine">
                        </div>

                        <div class="form-group">
                            <label for="subscriptionPlan">Subscription Plan *</label>
                            <select id="subscriptionPlan" name="subscription_plan" required>
                                <option value="">Select a plan</option>
                                <option value="basic">Basic</option>
                                <option value="standard">Standard</option>
                                <option value="premium">Premium</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-actions">
                        <button type="button" class="btn btn-secondary" onclick="closeModal('addCabinetModal')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Cabinet</button>
                    </div>
                </form>
            </div>

            <div id="creatingStep" class="wizard-step" style="display: none; text-align: center; padding: 3rem;">
                <div style="display: inline-block; animation: spin 1s linear infinite;">⏳</div>
                <h3 style="margin-top: 1.5rem;">Creating Cabinet...</h3>
                <p style="color: #9ca3af;">Setting up your medical cabinet...</p>
            </div>
        </div>
    </dialog>

    <dialog id="viewCabinetModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Cabinet Details</h2>
                <button class="modal-close" onclick="closeModal('viewCabinetModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Cabinet ID</label>
                    <p id="viewCabinetId" style="font-weight: 600; color: var(--text-primary); background: #f3f4f6; padding: 0.75rem; border-radius: 0.5rem;"></p>
                </div>
                <div class="form-group">
                    <label>Cabinet Name</label>
                    <p id="viewCabinetName" style="color: var(--text-primary);"></p>
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <p id="viewCabinetLocation" style="color: var(--text-primary);"></p>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <p id="viewContactEmail" style="color: var(--text-primary);"></p>
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <p id="viewPhone" style="color: var(--text-primary);"></p>
                </div>
                <div class="form-group">
                    <label>Specialty</label>
                    <p id="viewSpeciality" style="color: var(--text-primary);"></p>
                </div>
                <div class="form-group">
                    <label>Subscription Plan</label>
                    <p id="viewPlan" style="color: var(--text-primary);"></p>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <p id="viewStatus" style="color: var(--text-primary);"></p>
                </div>
                <div class="form-group">
                    <label>Created Date</label>
                    <p id="viewCreatedAt" style="color: var(--text-primary);"></p>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-primary" onclick="closeModal('viewCabinetModal')">Close</button>
                </div>
            </div>
        </div>
    </dialog>

    <dialog id="editCabinetModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Cabinet</h2>
                <button class="modal-close" onclick="closeModal('editCabinetModal')">&times;</button>
            </div>
            <form id="editCabinetForm" onsubmit="handleEditSubmit(event)">
                <input type="hidden" id="editCabinetId">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editCabinetName">Cabinet Name *</label>
                        <input type="text" id="editCabinetName" name="cabinetname" required>
                    </div>
                    <div class="form-group">
                        <label for="editCabinetLocation">Location *</label>
                        <input type="text" id="editCabinetLocation" name="cabinetlocation" required>
                    </div>
                   <div class="info-item">
                    <span class="info-label">Email</span>
                    <span class="info-value" id="cabinetEmail">N/A</span>
                    </div>

                    <div class="info-item">
                    <span class="info-label">Phone</span>
                    <span class="info-value" id="cabinetPhone">N/A</span>
                    </div>

                    <div class="info-item">
                    <span class="info-label">Created At</span>
                    <span class="info-value" id="createdAt">N/A</span>
                    </div>
                    <div class="form-group">
                        <label for="editStatus">Status</label>
                        <select id="editStatus" name="status">
                            <option value="active">Active</option>
                            <option value="suspended">Suspended</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editCabinetModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </dialog>

    <script src="../ajax/superadmin_cabinets.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('open');
        }

        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = '/logout.php';
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) modal.close();
            if (modalId === 'addCabinetModal') {
                document.getElementById('step1').style.display = 'block';
                document.getElementById('creatingStep').style.display = 'none';
                document.getElementById('cabinetInfoForm').reset();
            }
        }

        function openCreateModal() {
            document.getElementById('addCabinetModal').showModal();
        }

        async function handleCabinetInfo(e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);
            const data = Object.fromEntries(formData);

            document.getElementById('step1').style.display = 'none';
            document.getElementById('creatingStep').style.display = 'block';

            const result = await cabinetManager.createCabinet(data);
            if (result.success) {
                form.reset();
                closeModal('addCabinetModal');
                cabinetManager.loadCabinets();
                showNotification('Cabinet created successfully', 'success');
            } else {
                document.getElementById('step1').style.display = 'block';
                document.getElementById('creatingStep').style.display = 'none';
                showNotification(result.errors?.[0] || 'Creation failed', 'error');
            }
        }

        async function handleEditSubmit(e) {
            e.preventDefault();
            const cabinetId = document.getElementById('editCabinetId').value;
            const form = e.target;
            const formData = new FormData(form);
            const data = Object.fromEntries(formData);

            const result = await cabinetManager.updateCabinet(cabinetId, data);
            if (result.success) {
                form.reset();
                closeModal('editCabinetModal');
                cabinetManager.loadCabinets();
                showNotification('Cabinet updated successfully', 'success');
            } else {
                showNotification(result.errors?.[0] || 'Update failed', 'error');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            cabinetManager.loadCabinets();
        });
    </script>
</body>
</html>