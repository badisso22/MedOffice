console.log('edit-cabinet.js loaded');

document.addEventListener('DOMContentLoaded', async function() {
    await loadCabinetData();

    const form = document.getElementById('cabinetForm');
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        await saveCabinet();
    });
});

async function loadCabinetData() {
    try {
        const res = await fetch('../api/get-cabinet-info.php', {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        if (!res.ok) throw new Error('HTTP ' + res.status);

        const json = await res.json();
        if (!json.success || !json.data) {
            throw new Error(json.message || 'Failed to load cabinet info');
        }

        const d = json.data.cabinet;

        document.getElementById('cabinet-name').value = d.name || '';
        document.getElementById('email').value = d.email || '';
        document.getElementById('phone').value = d.phone || '';
        document.getElementById('location').value = d.location || '';
        document.getElementById('specialty').value = d.specialty || '';
        document.getElementById('work-start-time').value = d.workStartTime ? d.workStartTime.substring(0, 5) : '';
        document.getElementById('work-end-time').value = d.workEndTime ? d.workEndTime.substring(0, 5) : '';
        document.getElementById('working-hours-text').value = d.hours || '';

    } catch (err) {
        console.error('Error loading cabinet data:', err);
        showErrorModal('Error loading cabinet data: ' + err.message);
    }
}

async function saveCabinet() {
    const data = {
        cabinetName: document.getElementById('cabinet-name').value,
        email: document.getElementById('email').value,
        phone: document.getElementById('phone').value,
        location: document.getElementById('location').value,
        specialty: document.getElementById('specialty').value,
        workStartTime: document.getElementById('work-start-time').value,
        workEndTime: document.getElementById('work-end-time').value,
        workingHoursText: document.getElementById('working-hours-text').value
    };

    try {
        const res = await fetch('../api/update-cabinet.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(data)
        });

        const json = await res.json();
        if (!res.ok || !json.success) {
            showErrorModal(json.message || 'Failed to update cabinet');
            return;
        }

        showSuccessModal();

    } catch (err) {
        console.error('Error saving cabinet:', err);
        showErrorModal('Network error: ' + err.message);
    }
}

function showSuccessModal() {
    const modalHtml = `
        <div class="modal active" id="successModal">
            <div class="modal-content">
                <div class="modal-icon success">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <div class="modal-header">
                    <h2>Cabinet Updated Successfully</h2>
                </div>
                <div class="modal-body">
                    <p>Your cabinet information has been updated. The changes are now active.</p>
                </div>
                <div class="modal-actions">
                    <button onclick="window.location.href='about-cabinet.php'" class="btn btn-primary">Back to Cabinet Info</button>
                </div>
            </div>
        </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', modalHtml);
}

function showErrorModal(message) {
    const modalHtml = `
        <div class="modal active" id="errorModal">
            <div class="modal-content">
                <div class="modal-icon error">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        ircle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                </div>
                <div class="modal-header">
                    <h2>Update Failed</h2>
                </div>
                <div class="modal-body">
                    <p>${escapeHtml(message)}</p>
                </div>
                <div class="modal-actions">
                    <button onclick="closeErrorModal()" class="btn btn-primary">Try Again</button>
                </div>
            </div>
        </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', modalHtml);
}

function closeErrorModal() {
    const modal = document.getElementById('errorModal');
    if (modal) modal.remove();
}

function escapeHtml(str) {
    if (!str) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');
}
