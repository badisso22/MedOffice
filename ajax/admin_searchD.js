console.log('admin_searchD.js loaded');

let doctorToArchive = null;
let doctorName = '';
let doctorSpeciality = '';

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('doctor-search-form');
    const nameInput = document.getElementById('searchName');
    const tbody = document.getElementById('doctors-tbody');

    async function loadDoctors(searchName = '') {
        if (!tbody) return;

        const params = new URLSearchParams();
        if (searchName) {
            params.append('searchName', searchName);
        }

        try {
            const res = await fetch('../api/admin-search-doctor.php?' + params.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            if (!res.ok) {
                throw new Error('HTTP ' + res.status);
            }

            const data = await res.json();
            if (!data.success) {
                console.error(data.errors || data.message);
                tbody.innerHTML = `
                    <tr><td colspan="5">No doctors found.</td></tr>
                `;
                return;
            }

            const doctors = data.doctors || [];
            if (doctors.length === 0) {
                tbody.innerHTML = `
                    <tr><td colspan="5">No doctors found.</td></tr>
                `;
                return;
            }

            tbody.innerHTML = doctors.map(d => `
                <tr data-doctor-id="${d.doctorID}">
                  <td>${escapeHtml(d.fullName || '')}</td>
                  <td>${escapeHtml(d.speciality || '')}</td>
                  <td>${escapeHtml(d.email || '')}</td>
                  <td>${escapeHtml(d.phone || '')}</td>
                  <td>
                    <div class="action-buttons">
                      <a href="view_doctor.php?doctorID=${d.doctorID}" class="action-btn view-btn" title="View">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                          <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                          ircle cx="12" cy="12" r="3"></circle>
                        </svg>
                      </a>
                      <a href="edit_doctor.php?doctorID=${d.doctorID}" class="action-btn edit-btn" title="Edit">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                          <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                          <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                      </a>
                      <a href="javascript:void(0)" class="action-btn archive-btn" 
                         data-doctor-id="${d.doctorID}"
                         data-doctor-name="${escapeHtml(d.fullName || '')}"
                         data-doctor-speciality="${escapeHtml(d.speciality || '')}"
                         onclick="openArchiveModalWithData(this)">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                          <polyline points="21 8 21 21 3 21 3 8"></polyline>
                          <rect x="1" y="3" width="22" height="5"></rect>
                          <line x1="12" y1="9" x2="12" y2="13"></line>
                          <line x1="12" y1="17" x2="12.01" y2="17"></line>
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
            loadDoctors(nameInput.value.trim());
        });

        form.addEventListener('reset', function () {
            loadDoctors('');
        });
    }

    loadDoctors();
});


function openArchiveModalWithData(btn) {
    doctorToArchive = btn.getAttribute('data-doctor-id');
    doctorName = btn.getAttribute('data-doctor-name');
    doctorSpeciality = btn.getAttribute('data-doctor-speciality');

    const modal = document.getElementById('archiveModal');
    const idEl = document.getElementById('archive-doctor-id');
    const nameEl = document.getElementById('archive-doctor-name');
    const specialityEl = document.getElementById('archive-doctor-speciality');

    if (idEl) idEl.textContent = String(doctorToArchive).padStart(3, '0');
    if (nameEl) nameEl.textContent = doctorName;
    if (specialityEl) specialityEl.textContent = doctorSpeciality;

    if (modal) modal.classList.add('active');
}

function closeArchiveModal() {
    const modal = document.getElementById('archiveModal');
    if (modal) modal.classList.remove('active');
    doctorToArchive = null;
    doctorName = '';
    doctorSpeciality = '';
}

function openSuccessModal() {
    const modal = document.getElementById('successModal');
    const idEl = document.getElementById('success-doctor-id');
    const nameEl = document.getElementById('success-doctor-name');
    const specialityEl = document.getElementById('success-doctor-speciality');

    if (idEl) idEl.textContent = String(doctorToArchive).padStart(3, '0');
    if (nameEl) nameEl.textContent = doctorName;
    if (specialityEl) specialityEl.textContent = doctorSpeciality;

    if (modal) modal.classList.add('active');
}

function closeSuccessModal() {
    const modal = document.getElementById('successModal');
    if (modal) modal.classList.remove('active');
}

async function confirmArchive() {
    if (!doctorToArchive) {
        closeArchiveModal();
        return;
    }

    try {
        const formData = new FormData();
        formData.append('doctorID', doctorToArchive);

        const res = await fetch('../api/admin-archive-doctor.php', {
            method: 'POST',
            body: formData
        });

        const raw = await res.text();
        console.log('RAW ARCHIVE RESPONSE:', raw);

        let json;
        try {
            json = JSON.parse(raw);
        } catch (e) {
            console.error('JSON parse error in archive', e);
            alert('Server did not return valid JSON. Check console for RAW RESPONSE.');
            return;
        }

        if (!res.ok || !json.success) {
            console.error('Archive error', json);
            alert(json.message || 'Could not archive doctor');
            if (json.errors && json.errors.length) {
                alert(json.errors.join('\n'));
            }
            return;
        }

        closeArchiveModal();
        openSuccessModal();
    } catch (err) {
        console.error('Network/server error archiving doctor', err);
        alert('Network error while archiving doctor.');
    }
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

document.addEventListener('DOMContentLoaded', () => {
    const confirmBtn = document.getElementById('archive-confirm-btn');
    const cancelBtn = document.getElementById('archive-cancel-btn');
    const successOkBtn = document.getElementById('success-ok-btn');

    if (confirmBtn) confirmBtn.addEventListener('click', confirmArchive);
    if (cancelBtn) cancelBtn.addEventListener('click', closeArchiveModal);
    if (successOkBtn) {
        successOkBtn.addEventListener('click', () => {
            closeSuccessModal();
            window.location.href = 'searchD.php';
        });
    }
});
