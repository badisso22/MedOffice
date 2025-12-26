document.addEventListener('DOMContentLoaded', () => {
    const grid = document.getElementById('prescriptionsGrid');
    if (!grid) return;
    loadPrescriptions(grid);
});

async function loadPrescriptions(grid) {
    grid.innerHTML = '<p style="color:#6b7280;">Loading prescriptions...</p>';

    try {
        const res = await fetch('../api/patient-get-prescriptions.php', {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        const json = await res.json();

        if (!res.ok || !json.success) {
            const msg = (json && json.errors && json.errors[0]) || 'Failed to load prescriptions.';
            grid.innerHTML = `<p style="color:#ef4444;">${escapeHtml(msg)}</p>`;
            return;
        }

        const items = json.data;
        if (!items || items.length === 0) {
            grid.innerHTML = '<p style="color:#6b7280;">No prescriptions found.</p>';
            return;
        }

        grid.innerHTML = '';
        items.forEach(p => {
            const card = document.createElement('div');
            card.className = 'prescription-card';
            card.dataset.status = p.status; 
            card.onclick = () => viewDetails(p.id);

            const statusClass = p.status === 'expired'
                ? 'badge-expired'
                : p.status === 'expiring'
                ? 'badge-expiring'
                : 'badge-active';

            const statusLabel = p.status === 'expired'
                ? 'Expired'
                : p.status === 'expiring'
                ? 'Expiring Soon'
                : 'Active';

            const subtitle = p.duration ? p.duration : p.instructions ? p.instructions : '';

            card.innerHTML = `
                <div class="card-header">
                    <div class="medicine-info">
                        <h3>${escapeHtml(p.medication)}</h3>
                        <p>${escapeHtml(subtitle)}</p>
                    </div>
                    <span class="status-badge ${statusClass}">${escapeHtml(statusLabel)}</span>
                </div>

                <div class="refills-info">
                    <!-- you can wire real refills later -->
                    <strong>-</strong> <small>refills</small>
                </div>

                <div class="card-details">
                    <div class="detail-item">
                        <span class="detail-label">Dosage</span>
                        <span class="detail-value">${escapeHtml(p.dosage || '—')}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Frequency</span>
                        <span class="detail-value">${escapeHtml(p.frequency || '—')}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Prescribed</span>
                        <span class="detail-value">${escapeHtml(p.prescribed || '—')}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">${p.expiry ? 'Expires' : 'Doctor'}</span>
                        <span class="detail-value">${escapeHtml(p.expiry || p.doctor || '—')}</span>
                    </div>
                </div>

                <div class="card-actions">
                    <button class="btn-action btn-primary" onclick="event.stopPropagation(); requestRefill(${p.id});">
                        ${p.status === 'expired' ? 'Request Renewal' : 'Request Refill'}
                    </button>
                    <button class="btn-action btn-secondary" onclick="event.stopPropagation(); viewDetails(${p.id});">
                        Details
                    </button>
                </div>
            `;

            grid.appendChild(card);
        });

        filterPrescriptions('all');

    } catch (err) {
        grid.innerHTML = `<p style="color:#ef4444;">${escapeHtml(err.message)}</p>`;
    }
}

function requestRefill(id) {
    alert('Refill request for prescription #' + id + ' not implemented yet.');
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
