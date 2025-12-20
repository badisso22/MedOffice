document.addEventListener('DOMContentLoaded', async function () {
    const params = new URLSearchParams(window.location.search);
    const patientID = parseInt(params.get('patientID'), 10);

    if (!patientID || isNaN(patientID)) {
        console.error('Missing patientID in URL');
        return;
    }

    const backLink = document.getElementById('back-to-patient');
    const addLink = document.getElementById('add-record-link');
    const avatarEl = document.getElementById('patient-avatar');
    const nameEl = document.getElementById('patient-name');
    const codeEl = document.getElementById('patient-code');
    const ageEl = document.getElementById('patient-age');
    const lastVisitEl = document.getElementById('patient-last-visit');
    const grid = document.getElementById('records-grid');
    const timeline = document.getElementById('timeline-list');

    if (backLink) backLink.href = `view_patient.php?id=${patientID}`;
    if (addLink) addLink.href = `add_medical_records.php?patientID=${patientID}`;

    if (grid) grid.innerHTML = '<p>Loading records...</p>';

    try {
        const res = await fetch(`../api/records.php?patientID=${encodeURIComponent(patientID)}`, {
            method: 'GET',
            headers: { 'Accept': 'application/json' }
        });
        const json = await res.json();

        if (!res.ok || !json.success) {
            console.error('Error loading records', json);
            if (grid) grid.innerHTML = '<p>Could not load records.</p>';
            return;
        }

        const { patient, records } = json.data;

        if (avatarEl) avatarEl.textContent = patient.avatar || '';
        if (nameEl) nameEl.textContent = patient.fullName || '';
        if (codeEl) codeEl.textContent = `Patient ID: ${patient.code}`;
        if (ageEl) {
            ageEl.textContent = patient.age != null
                ? `Age: ${patient.age} years old`
                : 'Age: N/A';
        }
        if (lastVisitEl) {
            const lastVisit = patient.last_visit
                ? new Date(patient.last_visit).toLocaleDateString()
                : 'No visits yet';
            lastVisitEl.textContent = `Last Visit: ${lastVisit}`;
        }

        if (!grid || !timeline) return;

        if (!records || !records.length) {
            grid.innerHTML = '<p>No records found for this patient.</p>';
            timeline.innerHTML = '';
            return;
        }

        grid.innerHTML = records.map(r => {
            const dateText = r.date ? new Date(r.date).toLocaleDateString() : 'N/A';
            return `
                <a href="view_record_details.php?consultationID=${r.id}&patientID=${patientID}"
                   class="record-card" aria-label="View record">
                    <span class="record-type-badge ${escapeHtml(r.badgeClass)}">
                        ${escapeHtml(r.type)}
                    </span>
                    <h3>${escapeHtml(r.title)}</h3>
                    <p>${escapeHtml(r.summary)}</p>
                    <div class="record-doctor">${escapeHtml(r.doctorName)}</div>
                    <div class="record-date">${escapeHtml(dateText)}</div>
                </a>
            `;
        }).join('');

        timeline.innerHTML = records.map(r => {
            const dateText = r.date ? new Date(r.date).toLocaleDateString() : 'N/A';
            return `
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>${escapeHtml(r.title)}</h3>
                        <p>${escapeHtml(r.summary)}</p>
                        <p style="font-size: 0.85rem; margin-top: 0.75rem; color: var(--text-light);">
                            ${escapeHtml(dateText)} • ${escapeHtml(r.doctorName)}
                        </p>
                    </div>
                </div>
            `;
        }).join('');

    } catch (err) {
        console.error('Network/server error', err);
        if (grid) grid.innerHTML = '<p>Could not load records (network error).</p>';
    }
});

function escapeHtml(str) {
    if (!str) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}
