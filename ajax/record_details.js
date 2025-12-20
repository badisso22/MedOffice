document.addEventListener('DOMContentLoaded', async function () {
    const params = new URLSearchParams(window.location.search);
    const consultationID = parseInt(params.get('consultationID'), 10);

    if (!consultationID || isNaN(consultationID)) {
        alert('Missing or invalid record ID.');
        return;
    }
    const titleEl= document.getElementById('record-title');
    const badgeEl= document.getElementById('record-badge');
    const dateEl= document.getElementById('record-date');
    const doctorEl= document.getElementById('record-doctor');
    const patientEl= document.getElementById('record-patient');
    const backLink= document.getElementById('back-to-records');
    const testGrid= document.getElementById('test-results-grid');
    const summaryEl= document.getElementById('clinical-summary');
    const notesEl= document.getElementById('clinical-notes');
    const recGrid= document.getElementById('recommendations-grid');
    const recText= document.getElementById('recommendations-text');

    try {
        const res = await fetch(`../api/get_record_details.php?consultationID=${encodeURIComponent(consultationID)}`, {
            method: 'GET',
            headers: { 'Accept': 'application/json' }
        });

        const json = await res.json();
        if (!res.ok || !json.success) {
            console.error('Error loading record', json);
            alert(json.message || 'Could not load record details.');
            return;
        }

        const r = json.data;

        const patientFullName = `${r.firstname} ${r.lastname}`;
        const patientCode = `#P-${String(r.patientID).padStart(4, '0')}`;

        if (backLink) {
            backLink.href = `view_records.php?patientID=${encodeURIComponent(r.patientID)}`;
        }

        if (titleEl)  titleEl.textContent  = r.consultationtype + ' Consultation';
        if (badgeEl)  badgeEl.textContent  = 'Consultation';
        if (dateEl)   dateEl.textContent   = r.consultationdate;
        if (doctorEl) doctorEl.textContent = 'Dr. ' + (r.doctorName || 'User');
        if (patientEl) patientEl.textContent = `${patientFullName} (${patientCode})`;

        if (testGrid) {
            testGrid.innerHTML = `
                <div class="info-item">
                    <span class="info-label">Symptoms</span>
                    <span class="info-value">${escapeHtml(r.symptoms || '')}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Treatment Plan</span>
                    <span class="info-value">${escapeHtml(r.treatmentplan || '')}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Medical Fees</span>
                    <span class="info-value">
                        ${r.medicalfees !== null ? Number(r.medicalfees).toFixed(2) + ' DZD' : 'N/A'}
                    </span>
                </div>
            `;
        }

        if (summaryEl) {
            summaryEl.innerHTML = `<strong>Summary:</strong> ${escapeHtml(r.diagnosis || '')}`;
        }

        if (notesEl) {
            notesEl.innerHTML = `<p><strong>Additional Notes:</strong> ${escapeHtml(r.additionalnotes || '')}</p>`;
        }

        if (recGrid) {
            recGrid.innerHTML = `
                <div class="info-item">
                    <span class="info-label">Follow-up Required</span>
                    <span class="info-value">${r.nextappointment ? 'Yes - ' + r.nextappointment : 'As needed'}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Medication Changes</span>
                    <span class="info-value">As per treatment plan</span>
                </div>
            `;
        }

        if (recText) {
            recText.textContent = 'Continue current treatment plan and lifestyle recommendations as discussed during the consultation.';
        }
    } catch (err) {
        console.error('Network/server error loading record details', err);
        alert('Network error while loading record details.');
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
