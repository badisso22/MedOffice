document.addEventListener('DOMContentLoaded', async function () {
    const params = new URLSearchParams(window.location.search);
    const patientID = parseInt(params.get('patientID'), 10);

    if (!patientID || isNaN(patientID)) {
        console.error('Missing patientID in URL');
        return;
    }

    const grid = document.getElementById('prescriptions-grid');
    const avatarEl = document.getElementById('patient-avatar');
    const nameEl = document.getElementById('patient-name');
    const metaEl = document.getElementById('patient-meta');
    const backLink = document.getElementById('back-to-patient');
    const addLink = document.getElementById('add-prescription-link');

    if (backLink) {
        backLink.href = `view_patient.php?id=${patientID}`;
    }
    if (addLink) {
        addLink.href = `add_prescription.php?patientID=${patientID}`;
    }

    if (grid) {
        grid.innerHTML = '<p>Loading prescriptions...</p>';
    }

    try {
        const res = await fetch(`../api/prescriptions.php?patientID=${encodeURIComponent(patientID)}`, {
            method: 'GET',
            headers: { 'Accept': 'application/json' }
        });
        const json = await res.json();

        if (!res.ok || !json.success) {
            console.error('Error loading prescriptions', json);
            if (grid) grid.innerHTML = '<p>Could not load prescriptions.</p>';
            return;
        }

        const { patient, prescriptions } = json.data;

        if (avatarEl) avatarEl.textContent = patient.avatar || '';
        if (nameEl) nameEl.textContent = patient.fullName || '';

        if (metaEl) {
            const ageText = patient.age != null ? `${patient.age} years old` : 'N/A';
            const lastVisit = patient.last_visit
                ? new Date(patient.last_visit).toLocaleDateString()
                : 'No visits yet';
            metaEl.textContent =
                `Patient ID: ${patient.code} • Age: ${ageText} • Last Visit: ${lastVisit}`;
        }

        if (!grid) return;

        if (!prescriptions || !prescriptions.length) {
            grid.innerHTML = '<p>No prescriptions found for this patient.</p>';
            return;
        }

        grid.innerHTML = prescriptions.map(p => {
            const status = (p.status || 'Active').toLowerCase();
            const badgeClass = (status === 'completed' || status === 'inactive') ? 'inactive' : 'active';
            const dateText = p.date ? new Date(p.date).toLocaleDateString() : 'N/A';
            const doctorName = p.doctorName || 'Unknown Doctor';
            const countText = `${p.medicationCount} medication${p.medicationCount === 1 ? '' : 's'}`;
            const rxCode = 'RX' + String(p.prescriptionID).padStart(3, '0');

            return `
                <a href="view_medication_detail.php?prescriptionID=${p.prescriptionID}&patientID=${patientID}" class="prescription-card">
                    <div class="prescription-header">
                        <h3 class="prescription-name">Prescription #${rxCode}</h3>
                        <span class="status-badge ${badgeClass}">
                            ${escapeHtml(status.charAt(0).toUpperCase() + status.slice(1))}
                        </span>
                    </div>
                    <div class="prescription-details">
                        <div class="detail-row">
                            <span class="detail-label">Date</span>
                            <span class="detail-value">${escapeHtml(dateText)}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Prescribed by</span>
                            <span class="detail-value">${escapeHtml(doctorName)}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Contains</span>
                            <span class="detail-value">${escapeHtml(countText)}</span>
                        </div>
                    </div>
                    <div class="prescription-footer">
                        <span>View Details →</span>
                    </div>
                </a>
            `;
        }).join('');

    } catch (err) {
        console.error('Network/server error', err);
        if (grid) grid.innerHTML = '<p>Could not load prescriptions (network error).</p>';
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
