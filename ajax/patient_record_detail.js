document.addEventListener('DOMContentLoaded', () => {
    const content = document.getElementById('recordContent');
    const actions = document.getElementById('recordActions');
    if (!content) return;

    const params = new URLSearchParams(window.location.search);
    const id = parseInt(params.get('id'), 10);
    if (!id) {
        content.innerHTML = '<p style="color:#ef4444;">Invalid record ID.</p>';
        return;
    }

    loadRecordDetail(id, content, actions);
});

async function loadRecordDetail(id, content, actions) {
    content.innerHTML = '<p style="color:#6b7280;">Loading record details...</p>';

    try {
        const res = await fetch('../api/patient-get-record-detail.php?id=' + encodeURIComponent(id), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        const json = await res.json();

        if (!res.ok || !json.success) {
            const msg = (json && json.errors && json.errors[0]) || 'Failed to load record.';
            content.innerHTML = `<p style="color:#ef4444;">${escapeHtml(msg)}</p>`;
            return;
        }

        const r = json.data;
        const title = r.diagnosis || r.type || 'Medical record';
        const status = 'Recorded';
        const typeLabel = r.type || '';
        const date = r.date || '';
        const nextDate = r.nextappointment || '';
        const fees = r.medicalfees != null ? r.medicalfees + ' DZD' : '—';

        const symptoms = r.symptoms || '';
        const treatment = r.treatmentplan || '';
        const notes = r.additionalnotes || '';

        content.innerHTML = `
            <div class="detail-header">
                <span class="record-status-badge">${escapeHtml(status)}</span>
                <h1 class="detail-title">${escapeHtml(title)}</h1>
                
                <div class="detail-info-grid">
                    <div class="info-item">
                        <div class="info-label">Consultation Date</div>
                        <div class="info-value">${escapeHtml(date)}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Type</div>
                        <div class="info-value">${escapeHtml(typeLabel)}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Next Appointment</div>
                        <div class="info-value">${escapeHtml(nextDate)}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Medical Fees</div>
                        <div class="info-value">${escapeHtml(fees)}</div>
                    </div>
                </div>
            </div>

            <div class="detail-section">
                <h2 class="section-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                    </svg>
                    Symptoms
                </h2>
                <p class="content-text">${nl2br(escapeHtml(symptoms))}</p>
            </div>

            <div class="detail-section">
                <h2 class="section-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
                        <line x1="12" y1="7" x2="12" y2="13"></line>
                        <line x1="9" y1="16" x2="15" y2="16"></line>
                    </svg>
                    Diagnosis
                </h2>
                <p class="content-text">${nl2br(escapeHtml(r.diagnosis || ''))}</p>
            </div>

            <div class="detail-section">
                <h2 class="section-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
                        <polyline points="9 12 12 15 15 9"></polyline>
                    </svg>
                    Treatment Plan
                </h2>
                <p class="content-text">${nl2br(escapeHtml(treatment))}</p>
            </div>

            <div class="detail-section">
                <h2 class="section-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Additional Notes
                </h2>
                <p class="content-text">${nl2br(escapeHtml(notes))}</p>
            </div>
        `;

        if (actions) {
            actions.style.display = 'flex';
            const downloadBtn = document.getElementById('downloadBtn');
            const messageBtn = document.getElementById('messageDoctorBtn');

            if (downloadBtn) {
                downloadBtn.onclick = () => {
                    window.location.href = '../api/patient-download-record.php?id=' + encodeURIComponent(id);
                };
            }

            if (messageBtn) {
                messageBtn.onclick = () => {
                    window.location.href = 'patient_messages.php?context=consultation&id=' + encodeURIComponent(id);
                };
            }
        }

    } catch (err) {
        content.innerHTML = `<p style="color:#ef4444;">${escapeHtml(err.message)}</p>`;
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

function nl2br(str) {
    return str.replace(/\n/g, '<br>');
}
