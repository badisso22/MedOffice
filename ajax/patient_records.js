document.addEventListener('DOMContentLoaded', () => {
    const list = document.getElementById('recordsList');
    if (!list) return;

    loadRecords(list);
});

async function loadRecords(list) {
    list.innerHTML = '<p style="color:#6b7280;">Loading records...</p>';

    try {
        const res = await fetch('../api/patient-get-records.php', {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        const json = await res.json();

        if (!res.ok || !json.success) {
            const msg = (json && json.errors && json.errors[0]) || 'Failed to load records';
            list.innerHTML = `<p style="color:#ef4444;">${escapeHtml(msg)}</p>`;
            return;
        }

        const records = json.data;
        if (!records || records.length === 0) {
            list.innerHTML = '<p style="color:#6b7280;">No medical records yet.</p>';
            return;
        }

        list.innerHTML = '';
        records.forEach(rec => {
            const item = document.createElement('div');
            item.className = 'record-item';
            item.onclick = () => viewRecord(rec.id);

            item.innerHTML = `
                <div class="record-info">
                    <div class="record-title">${escapeHtml(rec.title)}</div>
                    <div class="record-meta">
                        <span>Date: ${escapeHtml(rec.date)}</span>
                        <span>Type: ${escapeHtml(rec.type)}</span>
                        <span>Status: Recorded</span>
                    </div>
                </div>
                <div class="record-actions">
                    <button class="btn-action btn-view" onclick="event.stopPropagation(); viewRecord(${rec.id})">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        View Details
                    </button>
                    <button class="btn-action btn-download" onclick="event.stopPropagation(); /* TODO: download */">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                        Download
                    </button>
                </div>
            `;
            list.appendChild(item);
        });

    } catch (err) {
        list.innerHTML = `<p style="color:#ef4444;">${escapeHtml(err.message)}</p>`;
    }
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
