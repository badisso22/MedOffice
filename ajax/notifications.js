function toggleDrawer() {
    const drawer = document.getElementById('drawer');
    const overlay = document.getElementById('drawerOverlay');
    drawer.classList.toggle('open');
    overlay.classList.toggle('active');
}

function createNotificationElement(notif) {
    const item = document.createElement('div');

    let typeClass = 'system-notif';
    if (notif.type === 'appointment' || notif.type === 'appointment_reminder') {
        typeClass = 'appointment-notif';
    } else if (notif.type === 'patient_update' || notif.type === 'patient_feedback') {
        typeClass = 'patient-notif';
    }

    item.className = 'notification-item ' + typeClass;
    item.dataset.notificationId = notif.id;

    const timeText = notif.createdAt || '';

    item.innerHTML = `
        <div class="notification-icon">
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="3"></circle>
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06A2 2 0 1 1 6.92 4.58l.06.06c.37.37.86.54 1.34.41a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09c0 .49.19.97.54 1.34a1.65 1.65 0 0 0 1.82.33h.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82c.1.63.52 1.15 1.15 1.25z"></path>
            </svg>
        </div>
        <div class="notification-content">
            <h3>${notif.title || 'Notification'}</h3>
            <p>${notif.message || ''}</p>
            <span class="notification-time">${timeText}</span>
            ${notif.link ? `<a href="${notif.link}" class="notification-link">View</a>` : ''}
        </div>
        <button class="notification-close" type="button">×</button>
    `;

    const closeBtn = item.querySelector('.notification-close');
    closeBtn.addEventListener('click', () => {
        const id = item.dataset.notificationId;
        item.style.display = 'none';
        markNotificationRead(id);
        updateBadge();
    });

    return item;
}

function filterNotifications(type) {
    const buttons = document.querySelectorAll('.filter-btn');
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');

    const items = document.querySelectorAll('.notification-item');
    items.forEach(item => {
        if (type === 'all') {
            item.style.display = 'flex';
        } else {
            const notifClass = item.className;
            if (type === 'appointments' && notifClass.includes('appointment')) {
                item.style.display = 'flex';
            } else if (type === 'patients' && notifClass.includes('patient')) {
                item.style.display = 'flex';
            } else if (type === 'system' && notifClass.includes('system')) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        }
    });
}

async function loadNotifications() {
    const container = document.querySelector('.notifications-container');
    if (!container) return;

    container.innerHTML = '<p class="loading-text">Loading notifications...</p>';

    try {
        const res = await fetch('../api/notifications_list.php');
        const json = await res.json();

        if (!res.ok || !json.success) {
            container.innerHTML = '<p class="error-text">Failed to load notifications.</p>';
            console.error('Notifications error', json);
            return;
        }

        container.innerHTML = '';

        if (!json.notifications.length) {
            container.innerHTML = '<p class="empty-text">No notifications yet.</p>';
            updateBadge(0);
            return;
        }

        json.notifications.forEach(notif => {
            const el = createNotificationElement(notif);
            container.appendChild(el);
        });

        updateBadge();

    } catch (err) {
        console.error('Notifications fetch error', err);
        container.innerHTML = '<p class="error-text">Error loading notifications.</p>';
    }
}

async function markNotificationRead(notificationID) {
    if (!notificationID) return;
    try {
        await fetch('../api/notifications_mark_read.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ notificationID: Number(notificationID) }),
        });
    } catch (err) {
        console.error('Mark read error', err);
    }
}

function updateBadge(countOverride) {
    const badge = document.querySelector('.notification-badge');
    if (!badge) return;

    let count = typeof countOverride === 'number'
        ? countOverride
        : document.querySelectorAll('.notification-item').length;

    if (count <= 0) {
        badge.style.display = 'none';
    } else {
        badge.style.display = 'inline-flex';
        badge.textContent = count;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    loadNotifications();
});
