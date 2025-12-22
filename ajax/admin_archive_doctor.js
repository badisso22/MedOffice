console.log('admin_archive_doctor.js loaded');

let doctorToUnarchive = null;
let doctorName = '';
let doctorSpeciality = '';

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('archived-doctor-search-form');
    const nameInput = document.getElementById('searchName');
    const tbody = document.getElementById('archived-doctors-tbody');

    async function loadArchivedDoctors(searchName = '') {
        if (!tbody) return;

        const params = new URLSearchParams();
        if (searchName) {
            params.append('searchName', searchName);
        }

        try {
            const res = await fetch('../api/admin-search-archived-doctor.php?' + params.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            if (!res.ok) {
                throw new Error('HTTP ' + res.status);
            }

            const data = await res.json();
            if (!data.success) {
                console.error(data.errors || data.message);
                tbody.innerHTML = `
                    <tr><td colspan="5">No archived doctors found.</td></tr>
                `;
                return;
            }

            const doctors = data.doctors || [];
            if (doctors.length === 0) {
                tbody.innerHTML = `
                    <tr><td colspan="5">No archived doctors found.</td></tr>
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
                      <a href="javascript:void(0)" class="action-btn unarchive-btn"
                         data-doctor-id="${d.doctorID}"
                         data-doctor-name="${escapeHtml(d.fullName || '')}"
                         data-doctor-speciality="${escapeHtml(d.speciality || '')}"
                         onclick="openUnarchiveModalWithData('${d.doctorID}', '${escapeHtml(d.fullName || '')}', '${escapeHtml(d.speciality || '')}')">
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
            loadArchivedDoctors(nameInput.value.trim());
        });

        form.addEventListener('reset', function () {
            loadArchivedDoctors('');
        });
    }

    loadArchivedDoctors();
});

function openUnarchiveModalWithData(doctorID, name, speciality) {
    doctorToUnarchive = doctorID;
    doctorName = name;
    doctorSpeciality = speciality;

    const modal = document.getElementById('unarchiveModal');
    const idEl = document.getElementById('unarchive-doctor-id');
    const nameEl = document.getElementById('unarchive-doctor-name');
    const specialityEl = document.getElementById('unarchive-doctor-speciality');

    if (idEl) idEl.textContent = String(doctorID).padStart(3, '0');
    if (nameEl) nameEl.textContent = name;
    if (specialityEl) specialityEl.textContent = speciality;

    if (modal) modal.classList.add('active');
}

function closeUnarchiveModal() {
    const modal = document.getElementById('unarchiveModal');
    if (modal) modal.classList.remove('active');
    doctorToUnarchive = null;
    doctorName = '';
    doctorSpeciality = '';
}

function openUnarchiveSuccessModal() {
    const modal = document.getElementById('unarchiveSuccessModal');
    const idEl = document.getElementById('unarchive-success-id');
    const nameEl = document.getElementById('unarchive-success-name');
    const specialityEl = document.getElementById('unarchive-success-speciality');
    const statusEl = document.getElementById('unarchive-success-status');

    if (idEl) idEl.textContent = String(doctorToUnarchive).padStart(3, '0');
    if (nameEl) nameEl.textContent = doctorName;
    if (specialityEl) specialityEl.textContent = doctorSpeciality;
    if (statusEl) statusEl.textContent = 'Active';

    if (modal) modal.classList.add('active');
}

function closeUnarchiveSuccessModal() {
    const modal = document.getElementById('unarchiveSuccessModal');
    if (modal) modal.classList.remove('active');
}

async function confirmUnarchive() {
    if (!doctorToUnarchive) {
        closeUnarchiveModal();
        return;
    }

    try {
        const formData = new FormData();
        formData.append('doctorID', doctorToUnarchive);

        const res = await fetch('../api/admin-unarchive-doctor.php', {
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
            alert(json.message || 'Could not unarchive doctor');
            if (json.errors && json.errors.length) {
                alert(json.errors.join('\n'));
            }
            return;
        }

        closeUnarchiveModal();
        openUnarchiveSuccessModal();
    } catch (err) {
        console.error('Network/server error unarchiving doctor', err);
        alert('Network error while unarchiving doctor.');
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
            window.location.href = 'archive_doctor.php';
        });
    }
});
