console.log('appointments.js loaded');

document.addEventListener('DOMContentLoaded', function () {
    const todayDateEl = document.getElementById('today-date');
    const nextWrapper = document.getElementById('next-appointment-wrapper');
    const listContent = document.getElementById('appointments-list-content');
    const totalCountEl = document.getElementById('total-count');
    const completedCountEl = document.getElementById('completed-count');
    const currentCountEl = document.getElementById('current-count');
    const remainingCountEl = document.getElementById('remaining-count');

    const today = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    if (todayDateEl) {
        todayDateEl.textContent = today.toLocaleDateString('en-US', options);
    }

    async function loadAppointments() {
        try {
            const res = await fetch('../api/get-today-appointments.php', {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            if (!res.ok) throw new Error('HTTP ' + res.status);

            const json = await res.json();
            if (!json.success || !json.data) {
                throw new Error(json.message || 'Failed to load appointments');
            }

            const d = json.data;

            if (totalCountEl) totalCountEl.textContent = d.total || 0;
            if (completedCountEl) completedCountEl.textContent = d.completedCount || 0;
            if (currentCountEl) currentCountEl.textContent = d.currentCount || 0;
            if (remainingCountEl) remainingCountEl.textContent = d.remainingCount || 0;

            if (d.current && nextWrapper) {
                nextWrapper.innerHTML = renderNextAppointment(d.current);
            } else if (nextWrapper) {
                nextWrapper.innerHTML = `
                    <div class="no-appointments">
                        <svg viewBox="0 0 24 24" width="60" height="60" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <h3>No Appointments Scheduled</h3>
                        <p>You have no appointments for today. Enjoy your free time!</p>
                    </div>
                `;
            }

            if (listContent) {
                if (d.total === 0) {
                    listContent.innerHTML = `
                        <div class="empty-state">
                            <p>No appointments scheduled for today.</p>
                        </div>
                    `;
                } else {
                    let html = '';
                    
                    d.completed.forEach(apt => {
                        html += renderAppointmentCard(apt, 'completed');
                    });

                    if (d.current) {
                        html += renderAppointmentCard(d.current, 'in-progress');
                    }

                    d.upcoming.forEach(apt => {
                        html += renderAppointmentCard(apt, 'upcoming');
                    });

                    listContent.innerHTML = html;
                }
            }

        } catch (err) {
            console.error(err);
            if (listContent) {
                listContent.innerHTML = `
                    <div class="error-state">
                        <p>Error loading appointments: ${escapeHtml(err.message)}</p>
                    </div>
                `;
            }
        }
    }

    function renderNextAppointment(apt) {
        const initials = getInitials(apt.patientName);
        return `
            <div class="next-appointment-card">
                <div class="next-badge">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        ircle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    Next Appointment
                </div>
                <div class="next-content">
                    <div class="patient-info">
                        <div class="patient-avatar">${escapeHtml(initials)}</div>
                        <div class="patient-details">
                            <h2>${escapeHtml(apt.patientName)}</h2>
                            <p class="patient-meta">Patient ID: #P-${String(apt.patientID).padStart(4, '0')} • ${escapeHtml(apt.purpose)}</p>
                        </div>
                    </div>
                    <div class="appointment-time">
                        <div class="time-display">${formatTime(apt.time)}</div>
                    </div>
                </div>
                <div class="quick-actions">
                    <button class="action-btn btn-primary" onclick="viewRecords(${apt.patientID})">View Records</button>
                    <button class="action-btn btn-secondary" onclick="endAppointment(${apt.appointmentID})">End Consultation</button>
                </div>
            </div>
        `;
    }

    function renderAppointmentCard(apt, type) {
        const initials = getInitials(apt.patientName);
        let statusBadge = '';
        let cardClass = type;

        if (type === 'completed') {
            statusBadge = '<span class="status-badge status-completed">Completed</span>';
        } else if (type === 'in-progress') {
            statusBadge = '<span class="status-badge status-current">Current</span>';
        } else {
            statusBadge = '<span class="status-badge status-upcoming">Upcoming</span>';
        }

        return `
            <div class="appointment-card ${cardClass}">
                <div class="appointment-status">
                    ${statusBadge}
                </div>
                <div class="appointment-content">
                    <div class="time-slot">
                        <div class="time">${formatTime(apt.time)}</div>
                    </div>
                    <div class="patient-info-compact">
                        <div class="patient-avatar-small">${escapeHtml(initials)}</div>
                        <div>
                            <h4>${escapeHtml(apt.patientName)}</h4>
                            <p>${escapeHtml(apt.purpose)}</p>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    function getInitials(name) {
        if (!name) return '?';
        return name.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
    }

    function formatTime(timeStr) {
        if (!timeStr) return '';
        const time = new Date('1970-01-01T' + timeStr);
        return time.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
    }

    function escapeHtml(str) {
        if (str === null || str === undefined) return '';
        str = String(str);
        return str
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    loadAppointments();
});

function viewRecords(patientID) {
    window.location.href = `view_patient.php?patientID=${patientID}`;
}

function endAppointment(appointmentID) {
    showConfirmEndModal(appointmentID);
}

function showConfirmEndModal(appointmentID) {
    const confirmHtml = `
        <div class="modal active" id="confirmEndModal">
            <div class="modal-content">
                <div class="modal-icon warning">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                </div>
                <div class="modal-header">
                    <h2>End Consultation</h2>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to mark this appointment as completed?</p>
                </div>
                <div class="modal-actions">
                    <button onclick="closeConfirmEndModal()" class="btn btn-secondary">Cancel</button>
                    <button onclick="confirmEndAppointment(${appointmentID})" class="btn btn-primary">Yes, Complete</button>
                </div>
            </div>
        </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', confirmHtml);
}

function closeConfirmEndModal() {
    const modal = document.getElementById('confirmEndModal');
    if (modal) modal.remove();
}

async function confirmEndAppointment(appointmentID) {
    closeConfirmEndModal();

    try {
        const res = await fetch('../api/end-appointment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ appointmentID: appointmentID })
        });

        const json = await res.json();
        if (!res.ok || !json.success) {
            alert(json.message || 'Could not end appointment');
            return;
        }

        showEndSuccessModal();

    } catch (err) {
        console.error(err);
        alert('Network error');
    }
}

function showEndSuccessModal() {
    const modal = document.getElementById('successEndModal');
    if (modal) {
        modal.classList.add('active');
    }
}

function closeEndSuccessModal() {
    const modal = document.getElementById('successEndModal');
    if (modal) {
        modal.classList.remove('active');
    }
    location.reload();
}
