console.log('admin_searchA.js loaded');

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('assistant-search-form');
    const nameInput = document.getElementById('searchName');
    const tbody = document.getElementById('assistants-tbody');

    async function loadAssistants(searchName = '') {
        if (!tbody) return;

        const params = new URLSearchParams();
        if (searchName) {
            params.append('searchName', searchName);
        }

        try {
            const res = await fetch('../api/admin-search-assistant.php?' + params.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            if (!res.ok) {
                throw new Error('HTTP ' + res.status);
            }

            const data = await res.json();
            if (!data.success) {
                console.error(data.errors || data.message);
                tbody.innerHTML = `
                    <tr><td colspan="5">No assistants found.</td></tr>
                `;
                return;
            }

            const assistants = data.assistants || [];
            if (assistants.length === 0) {
                tbody.innerHTML = `
                    <tr><td colspan="5">No assistants found.</td></tr>
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
                          <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                      </a>
                      <a href="edit_assistant.php?assistantID=${a.assistantID}" class="action-btn edit-btn" title="Edit">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                          <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                          <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                      </a>
                      <a href="javascript:void(0)" class="action-btn archive-btn" 
                         data-assistant-id="${a.assistantID}"
                         data-assistant-name="${escapeHtml(a.fullName || '')}"
                         data-assistant-age="${a.age !== null ? a.age : ''}"
                         onclick="openArchiveModal(this)">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                          <polyline points="21 8 21 21 3 21 3 8"></polyline>
                          <rect x="1" y="3" width="22" height="5"></rect>
                          <line x1="10" y1="12" x2="14" y2="12"></line>
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
            loadAssistants(nameInput.value.trim());
        });

        form.addEventListener('reset', function () {
            loadAssistants('');
        });
    }

    loadAssistants();
});

function openArchiveModal(btn) {
    const modal = document.getElementById('archiveModal');
    if (!modal || !btn) return;

    const id   = btn.getAttribute('data-assistant-id');
    const name = btn.getAttribute('data-assistant-name');
    const age  = btn.getAttribute('data-assistant-age');

    window.currentAssistantToArchive = id;

    const idSpan   = document.getElementById('archive-assistant-id');
    const nameSpan = document.getElementById('archive-assistant-name');
    const ageSpan  = document.getElementById('archive-assistant-age');

    if (idSpan)   idSpan.textContent = id || '—';
    if (nameSpan) nameSpan.textContent = name || '—';
    if (ageSpan)  ageSpan.textContent = age || '—';

    modal.classList.add('active');
}

function closeArchiveModal() {
    const modal = document.getElementById('archiveModal');
    if (modal) modal.classList.remove('active');
}

async function confirmArchive() {
    const id = window.currentAssistantToArchive;
    if (!id) {
        closeArchiveModal();
        return;
    }

    try {
        const res = await fetch('../api/admin_archive_assistant.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ assistantID: id })
        });

        const json = await res.json();
        if (!res.ok || !json.success) {
            console.error(json.errors || json.message);
            alert('Failed to archive assistant.');
            return;
        }

        const row = document.querySelector(`tr[data-assistant-id="${id}"]`);
        if (row && row.parentNode) {
            row.parentNode.removeChild(row);
        }

        const successModal = document.getElementById('successModal');
        const sId   = document.getElementById('success-assistant-id');
        const sName = document.getElementById('success-assistant-name');
        const sAge  = document.getElementById('success-assistant-age');

        if (sId)   sId.textContent = id;
        if (sName) sName.textContent = document.getElementById('archive-assistant-name')?.textContent || '—';
        if (sAge)  sAge.textContent = document.getElementById('archive-assistant-age')?.textContent || '—';

        closeArchiveModal();
        if (successModal) successModal.classList.add('active');

    } catch (err) {
        console.error(err);
        alert('Network or server error: ' + err.message);
    }
}

function closeSuccessModal() {
    const modal = document.getElementById('successModal');
    if (modal) modal.classList.remove('active');
}

document.addEventListener('click', (event) => {
    const archiveModal = document.getElementById('archiveModal');
    const successModal = document.getElementById('successModal');

    if (event.target === archiveModal) {
        closeArchiveModal();
    }
    if (event.target === successModal) {
        closeSuccessModal();
    }
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        closeArchiveModal();
        closeSuccessModal();
    }
});
