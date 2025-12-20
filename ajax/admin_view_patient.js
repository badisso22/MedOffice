document.addEventListener('DOMContentLoaded', async function () {
    const params = new URLSearchParams(window.location.search);
    const id = parseInt(params.get('id'), 10);

    if (!id || isNaN(id)) {
        console.warn('No patient ID in URL');
        return;
    }

    try {
        const res = await fetch(`../api/admin-view-patient.php?id=${encodeURIComponent(id)}`, {
            method: 'GET',
            headers: { 'Accept': 'application/json' }
        });
        const data = await res.json();

        if (!res.ok || !data.success) {
            console.error('Error loading patient:', data);
            return;
        }

        const p = data.data;

        setText('patient-name', p.fullName);
        setText('patient-id', p.patientID);
        setText('patient-age', p.age !== null ? `${p.age} years` : 'N/A');
        setText('patient-gender', p.gender ? capitalize(p.gender) : 'N/A');
        setText('patient-phone', p.phone || 'N/A');
        setText('patient-phone-2', p.phone || 'N/A');
        setText('patient-email', p.email || 'N/A');
        setText('patient-address', p.address || 'N/A');

        const avatar = document.getElementById('patient-avatar');
        if (avatar && p.initials) {
            avatar.textContent = p.initials;
        }

        const statusEl = document.getElementById('patient-status');
        if (statusEl) {
            if (p.archived) {
                statusEl.textContent = 'Archived Patient';
                statusEl.classList.add('status-archived');
            } else {
                statusEl.textContent = 'Active Patient';
                statusEl.classList.remove('status-archived');
            }
        }

        if (p.emergency_contact) {
            const name = p.emergency_contact.name || '';
            const phone = p.emergency_contact.phone || '';
            const rel = p.emergency_contact.relationship || '';
            const text = name || phone || rel
                ? `${name}${rel ? ' (' + rel + ')' : ''}${phone ? ' - ' + phone : ''}`
                : 'Not specified';
            setText('patient-emergency', text);
        }

        if (p.recent_visits) {
            const last = p.recent_visits.last_visit_date
                ? new Date(p.recent_visits.last_visit_date).toLocaleDateString()
                : 'No visits yet';
            setText('patient-last-visit', last);
            setText('patient-last-reason', p.recent_visits.last_visit_reason || 'N/A');
            setText('patient-next-appointment', p.recent_visits.next_appointment || 'Not scheduled');
        }

        if (Array.isArray(p.medical_history)) {
            const list = document.getElementById('medical-history-list');
            if (list) {
                list.innerHTML = p.medical_history.map(item => `
                    <li><strong>${escapeHtml(item.label)}</strong> - ${escapeHtml(item.value)}</li>
                `).join('');
            }
        }

    } catch (err) {
        console.error('Network/server error loading patient:', err);
    }
});

function setText(id, value) {
    const el = document.getElementById(id);
    if (el) el.textContent = value;
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
