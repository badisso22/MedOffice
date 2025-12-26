
document.addEventListener('DOMContentLoaded', function () {
    // Detect if this page is archived list or active list
    const isArchivedPage = window.location.pathname.indexOf('archived_users.php') !== -1;
    fetchAdmins(isArchivedPage ? 1 : 0);
});

function fetchAdmins(archived) {
    const tbody = document.getElementById('usersTableBody');
    tbody.innerHTML = `
        <tr><td colspan="7" style="text-align:center;">Loading admins...</td></tr>
    `;

    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../api/superadmin-get-admins.php?archived=' + encodeURIComponent(archived), true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                try {
                    const res = JSON.parse(xhr.responseText);
                    renderAdmins(res.data || [], archived);
                } catch (e) {
                    tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;color:red;">Error parsing response</td></tr>`;
                }
            } else {
                tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;color:red;">Failed to load admins</td></tr>`;
            }
        }
    };
    xhr.send();
}

function renderAdmins(admins, archived) {
    const tbody = document.getElementById('usersTableBody');
    if (!admins.length) {
        tbody.innerHTML = `
            <tr>
                <td colspan="7" style="text-align:center; padding: 1.5rem; color: #666;">
                    ${archived
                        ? 'There are currently no archived admin users. Active admins will appear here once archived.'
                        : 'No active admin users found.'}
                </td>
            </tr>
        `;
        return;
    }

    tbody.innerHTML = '';

    admins.forEach(function (admin) {
        const tr = document.createElement('tr');

        const statusClass =
            admin.status === 'active' ? 'badge active' :
            admin.status === 'suspended' ? 'badge inactive' :
            'badge inactive';

        const lastLoginText = admin.last_login ? admin.last_login : 'Never';

        const userCode = 'USR-' + String(admin.userID).padStart(3, '0');

        // For active list, show Archive button; for archived list, show maybe "Restore" or nothing
        let actionsHtml;
        if (!archived) {
            actionsHtml = `
                <div class="action-buttons-large">
                    <a href="view_user.php?id=${encodeURIComponent(admin.userID)}" class="action-btn-large">View</a>
                    <button class="action-btn-large"
                        onclick="openEditUserModal('${admin.userID}', '${escapeForAttr(admin.fullName)}', '${escapeForAttr(admin.email)}', '${escapeForAttr(admin.cabinet || '')}')">
                        Edit
                    </button>
                    <button class="action-btn-large danger"
                        onclick="openArchiveUserModal('${admin.userID}', '${escapeForAttr(admin.fullName)}')">
                        Archive
                    </button>
                </div>
            `;
        } else {
            actionsHtml = `
                <div class="action-buttons-large">
                    <a href="view_user.php?id=${encodeURIComponent(admin.userID)}" class="action-btn-large">View</a>
                    <button class="action-btn-large"
                        onclick="openRestoreUserModal('${admin.userID}', '${escapeForAttr(admin.fullName)}')">
                        Restore
                    </button>
                </div>
            `;
        }

        tr.innerHTML = `
            <td>${userCode}</td>
            <td>${escapeHtml(admin.fullName)}</td>
            <td>${escapeHtml(admin.email)}</td>
            <td>${escapeHtml(admin.cabinet || '—')}</td>
            <td><span class="${statusClass}">${escapeHtml(admin.status)}</span></td>
            <td>${escapeHtml(lastLoginText)}</td>
            <td>${actionsHtml}</td>
        `;

        tbody.appendChild(tr);
    });
}

// Helpers
function escapeHtml(str) {
    if (!str) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function escapeForAttr(str) {
    if (!str) return '';
    return String(str)
        .replace(/\\/g, '\\\\')
        .replace(/'/g, "\\'")
        .replace(/"/g, '&quot;')
        .replace(/\n/g, ' ');
}

// Existing modal functions (you already referenced them in HTML)
function openAddUserModal() {
    document.getElementById('addUserModal').style.display = 'block';
}
function closeAddUserModal() {
    document.getElementById('addUserModal').style.display = 'none';
}
function openEditUserModal(userId, fullName, email, cabinet) {
    document.getElementById('editUserId').value = userId;
    document.getElementById('editFullName').value = fullName;
    document.getElementById('editEmail').value = email;
    document.getElementById('editCabinet').value = cabinet;
    document.getElementById('editUserModal').style.display = 'block';
}
function closeEditUserModal() {
    document.getElementById('editUserModal').style.display = 'none';
}
function openArchiveUserModal(userId, fullName) {
    document.getElementById('archiveUserId').value = userId;
    document.getElementById('archiveUserName').textContent = fullName;
    document.getElementById('archiveUserModal').style.display = 'block';
}
function closeArchiveUserModal() {
    document.getElementById('archiveUserModal').style.display = 'none';
}
// Optional restore modal if you add it in archived_users.php
function openRestoreUserModal(userId, fullName) {
    // Implement similar to archive modal if you want
    alert('Restore user ' + fullName + ' (ID: ' + userId + ') – implement restore logic.');
}
