document.addEventListener('DOMContentLoaded', function () {
    const userId = getUserIdFromUrl();
    if (!userId) {
        showError('Invalid user ID in URL.');
        return;
    }
    fetchUserDetails(userId);
});

function getUserIdFromUrl() {
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');
    return id && /^\d+$/.test(id) ? id : null;
}

function fetchUserDetails(userId) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../api/superadmin-get-user-details.php?id=' + encodeURIComponent(userId), true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                try {
                    const data = JSON.parse(xhr.responseText);
                    if (data.error) {
                        showError(data.error);
                    } else {
                        fillUserDetails(data);
                    }
                } catch (e) {
                    showError('Failed to parse server response.');
                }
            } else if (xhr.status === 404) {
                showError('Admin user not found.');
            } else {
                showError('Failed to load user details.');
            }
        }
    };
    xhr.send();
}

function fillUserDetails(d) {
    setText('vuFullName', d.fullName);
    setText('vuUserCode', d.userCode);

    const statusBadge = document.getElementById('vuStatusBadge');
    if (statusBadge) {
        statusBadge.textContent = capitalize(d.status || 'unknown');
        statusBadge.classList.remove('active', 'inactive');
        if (d.status === 'active') statusBadge.classList.add('active');
        else statusBadge.classList.add('inactive');
    }

    setText('vuRoleBadge', d.roleName || 'Admin');

    setText('vuPIFullName', d.fullName);
    setText('vuPIEmail', d.email);
    setText('vuPIPhone', d.phone || '—');
    setText('vuPILicense', d.licenseNumber || '—');
    setText('vuPISpeciality', d.speciality || '—');

    setText('vuCabinetName', d.cabinetName || '—');
    setText('vuCabinetID', d.cabinetID || '—');
    setText('vuCabinetRole', 'Primary Admin');
    setText('vuCabinetJoined', formatDate(d.createdAt));
    setText('vuCabinetAddress', d.cabinetAddress || '—');

    const accStatusSpan = document.getElementById('vuAccStatus');
    if (accStatusSpan) {
        const badgeClass = d.status === 'active' ? 'badge active' : 'badge inactive';
        accStatusSpan.innerHTML = `<span class="${badgeClass}">${escapeHtml(capitalize(d.status || 'unknown'))}</span>`;
    }

    setText('vuAccLastLogin', d.last_login ? formatDateTime(d.last_login) : 'Never');
    setText('vuAccCreated', formatDate(d.createdAt));
    setText('vuAccModified', '—'); 
    setText('vuAccSessions', '—'); 

}

function setText(id, text) {
    const el = document.getElementById(id);
    if (el) {
        el.textContent = text || '';
    }
}

function showError(msg) {
    alert(msg);
}

function formatDate(dateStr) {
    if (!dateStr) return '—';
    const d = new Date(dateStr);
    if (isNaN(d.getTime())) return dateStr;
    return d.toLocaleDateString('en-US', {
        year: 'numeric', month: 'short', day: 'numeric'
    });
}

function formatDateTime(dateStr) {
    if (!dateStr) return '—';
    const d = new Date(dateStr);
    if (isNaN(d.getTime())) return dateStr;
    return d.toLocaleString('en-US', {
        year: 'numeric', month: 'short', day: 'numeric',
        hour: '2-digit', minute: '2-digit'
    });
}

function capitalize(str) {
    if (!str) return '';
    return str.charAt(0).toUpperCase() + str.slice(1);
}

function escapeHtml(str) {
    if (!str) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}
