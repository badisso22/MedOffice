console.log('admin_archive_assistant.js loaded');

let assistantToUnarchive = null;
let assistantName = '';
let assistantAge = '';

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('archived-assistant-search-form');
    const nameInput = document.getElementById('searchName');
    const tbody = document.getElementById('archived-assistants-tbody');

    async function loadArchivedAssistants(searchName = '') {
        if (!tbody) return;

        const params = new URLSearchParams();
        if (searchName) {
            params.append('searchName', searchName);
        }

        try {
            const res = await fetch('../api/admin-search-archived-assistant.php?' + params.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            if (!res.ok) {
                throw new Error('HTTP ' + res.status);
            }

            const data = await res.json();
            if (!data.success) {
                console.error(data.errors || data.message);
                tbody.innerHTML = `
                    <tr><td colspan="5">No archived assistants found.</td></tr>
                `;
                return;
            }

            const assistants = data.assistants || [];
            if (assistants.length === 0) {
                tbody.innerHTML = `
                    <tr><td colspan="5">No archived assistants found.</td></tr>
                `;
                return;
            }

            tbody.innerHTML = assistants.map(a => `
                <tr data-assistant-id="${a.assistantID}">
                  <td>${escapeHtml(a.fullName || '')}</td>
                  <td>${a.age !== null ? a.age : '-'}</td>
                  <td>${escapeHtml(a.email || '')}</td>
                  <td>${escapeHtml(a.phone || '')}</td>
                  <td>
                    <div class="action-buttons">
                      <a href="view_assistant.php?assistantID=${a.assistantID}" class="action-btn view-btn" title="View">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                          <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                          ircle cx="12" cy="12" r="3"></circle>
                        </svg>
                      </a>
                      <a href="javascript:void(0)" class="action-btn unarchive-btn"
                         data-assistant-id="${a.assistantID}"
                         data-assistant-name="${escapeHtml(a.fullName || '')}"
                         data-assistant-age="${a.age !== null ? a.age : ''}"
                         onclick="openUnarchiveModalWithData(this)">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                          <polyline points="3 8 3 21 21 21 21 8"></polyline>
                          <rect x="1" y="3" width="22" height="5"></rect>
                          <line x1="10" y1="12" x2="14" y2="12"></line>
                          <polyline points="12 12 12 16"></polyline>
                        </svg>
                      </a>
                    </div>
                  </td>
                </tr>
            `).join('');

        } catch (err) {
            console.error(err);
            tbody.innerHTML = `
                <tr><td colspan="5">Network or server error: ${escapeHtml(err.message)}</td></tr>
            `;
        }
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

    if (form && nameInput) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            loadArchivedAssistants(nameInput.value.trim());
        });

        form.addEventListener('reset', function () {
            loadArchivedAssistants('');
        });
    }

    loadArchivedAssistants();
});

function openUnarchiveModalWithData(btn) {
    assistantToUnarchive = btn.getAttribute('data-assistant-id');
    assistantName = btn.getAttribute('data-assistant-name');
    assistantAge = btn.getAttribute('data-assistant-age');

    const modal = document.getElementById('unarchiveModal');
    const idEl = document.getElementById('unarchive-assistant-id');
    const nameEl = document.getElementById('unarchive-assistant-name');
    const ageEl = document.getElementById('unarchive-assistant-age');

    if (idEl) idEl.textContent = String(assistantToUnarchive).padStart(3, '0');
    if (nameEl) nameEl.textContent = assistantName;
    if (ageEl) ageEl.textContent = assistantAge || 'N/A';

    if (modal) modal.classList.add('active');
}

function closeUnarchiveModal() {
    const modal = document.getElementById('unarchiveModal');
    if (modal) modal.classList.remove('active');
    assistantToUnarchive = null;
    assistantName = '';
    assistantAge = '';
}

function openUnarchiveSuccessModal() {
    const modal = document.getElementById('unarchiveSuccessModal');
    const idEl = document.getElementById('success-unarchive-id');
    const nameEl = document.getElementById('success-unarchive-name');
    const ageEl = document.getElementById('success-unarchive-age');
    const statusEl = document.getElementById('unarchive-success-status');
    
    if (idEl) idEl.textContent = String(assistantToUnarchive).padStart(3, '0');
    if (nameEl) nameEl.textContent = assistantName;
    if (ageEl) ageEl.textContent = assistantAge || 'N/A';
    if (statusEl) statusEl.textContent = 'Active';
    if (modal) modal.classList.add('active');
}

function closeUnarchiveSuccessModal() {
    const modal = document.getElementById('unarchiveSuccessModal');
    if (modal) modal.classList.remove('active');
}

async function confirmUnarchive() {
    if (!assistantToUnarchive) {
        closeUnarchiveModal();
        return;
    }

    try {
        const formData = new FormData();
        formData.append('assistantID', assistantToUnarchive);

        const res = await fetch('../api/admin-unarchive-assistant.php', {
            method: 'POST',
            body: formData
        });

        const raw = await res.text();
        console.log('RAW UNARCHIVE RESPONSE:', raw);

        let json;
        try {
            json = JSON.parse(raw);
        } catch (e) {
            console.error('JSON parse error in unarchive', e);
            alert('Server did not return valid JSON. Check console for RAW RESPONSE.');
            return;
        }

        if (!res.ok || !json.success) {
            console.error('Unarchive error', json);
            alert(json.message || 'Could not unarchive assistant');
            if (json.errors && json.errors.length) {
                alert(json.errors.join('\n'));
            }
            return;
        }

        closeUnarchiveModal();
        openUnarchiveSuccessModal();
    } catch (err) {
        console.error('Network/server error unarchiving assistant', err);
        alert('Network error while unarchiving assistant.');
    }
}

document.addEventListener('click', (event) => {
    const unarchiveModal = document.getElementById('unarchiveModal');
    const successModal = document.getElementById('unarchiveSuccessModal');

    if (event.target === unarchiveModal) {
        closeUnarchiveModal();
    }
    if (event.target === successModal) {
        closeUnarchiveSuccessModal();
    }
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        closeUnarchiveModal();
        closeUnarchiveSuccessModal();
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const confirmBtn = document.getElementById('unarchive-confirm-btn');
    const cancelBtn = document.getElementById('unarchive-cancel-btn');
    const successOkBtn = document.getElementById('unarchive-success-ok-btn');

    if (confirmBtn) confirmBtn.addEventListener('click', confirmUnarchive);
    if (cancelBtn) cancelBtn.addEventListener('click', closeUnarchiveModal);
    if (successOkBtn) {
        successOkBtn.addEventListener('click', () => {
            closeUnarchiveSuccessModal();
            window.location.href = 'archive_assistant.php';
        });
    }
});
