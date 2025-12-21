console.log('admin_archive_patient AJAX loaded');

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('archived-patient-search-form');
    const nameInput = document.getElementById('searchName');
    const tbody = document.getElementById('archived-patients-tbody');
    const resultDiv = document.getElementById('archived-patients-result');

    async function loadArchivedPatients(name = '') {
        if (tbody) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="5" class="text-center">Loading archived patients...</td>
                </tr>
            `;
        }
        if (resultDiv) {
            resultDiv.innerHTML = '';
        }

        const params = new URLSearchParams();
        if (name) params.append('searchName', name);

        try {
            const res = await fetch(`../api/admin-search-archived-patient.php?${params.toString()}`, {
                method: 'GET',
                headers: { 'Accept': 'application/json' }
            });

            const data = await res.json();
            console.log('Archived patients data', data);

            if (!res.ok || !data.success) {
                const errs = (data.errors || []).join('<br>');
                if (resultDiv) {
                    resultDiv.innerHTML = `
                        <div class="alert alert-danger">
                            ${data.message || 'Error'}<br>${errs}
                        </div>
                    `;
                }
                if (tbody) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="5" class="text-center">No archived patients found</td>
                        </tr>
                    `;
                }
                return;
            }

            const patients = (data.data && data.data.patients) ? data.data.patients : [];

            if (!patients.length) {
                if (tbody) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="5" class="text-center">No archived patients found</td>
                        </tr>
                    `;
                }
                return;
            }

            if (tbody) {
                tbody.innerHTML = patients.map(p => {
                    const age = (p.age !== null && p.age !== undefined) ? p.age : 'N/A';
                    const archivedDate = p.archivedDate || '';
                    const nameFull = escapeHtml(p.name);
                    return `
                        <tr data-patient-id="${p.patientID}">
                          <td>${p.patientID}</td>
                          <td>${nameFull}</td>
                          <td>${age}</td>
                          <td>${archivedDate}</td>
                          <td>
                            <div class="action-buttons">
                              <a href="view_patient.php?id=${p.patientID}" class="action-btn view-btn" title="View">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                  <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                              </a>
                              <a href="javascript:void(0)" class="action-btn unarchive-btn" title="Unarchive">
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
                    `;
                }).join('');
            }

            if (tbody && !tbody._unarchiveHandlerAttached) {
                tbody.addEventListener('click', function (e) {
                    const btn = e.target.closest('.unarchive-btn');
                    if (!btn) return;

                    const row = btn.closest('tr');
                    if (!row) return;

                    const patientID = row.getAttribute('data-patient-id');
                    const nameCell  = row.querySelector('td:nth-child(2)');
                    const ageCell   = row.querySelector('td:nth-child(3)');

                    const name = nameCell ? nameCell.textContent.trim() : '';
                    const age  = ageCell ? ageCell.textContent.trim() : 'N/A';

                    openUnarchiveModalWithData(patientID, name, age);
                });
                tbody._unarchiveHandlerAttached = true;
            }

        } catch (err) {
            console.error('Error loading archived patients:', err);
            if (resultDiv) {
                resultDiv.innerHTML = `
                    <div class="alert alert-danger">
                        Network or server error: ${escapeHtml(err.message)}
                    </div>
                `;
            }
            if (tbody) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center">Could not load archived patients</td>
                    </tr>
                `;
            }
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
            loadArchivedPatients(nameInput.value.trim());
        });

        form.addEventListener('reset', function () {
            loadArchivedPatients('');
        });
    }

    loadArchivedPatients();
});
