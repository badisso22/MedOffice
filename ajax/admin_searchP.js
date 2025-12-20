console.log('admin_searchP.js loaded');

document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM fully loaded, starting loadPatients');

    const form = document.getElementById('patient-search-form');
    const nameInput = document.getElementById('searchName');
    const tbody = document.getElementById('patients-tbody');
    const resultDiv = document.getElementById('patients-result');

    async function loadPatients(name = '') {
        console.log('loadPatients called with', name);

        if (tbody) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="5" class="text-center">Loading...</td>
                </tr>
            `;
        }
        if (resultDiv) {
            resultDiv.innerHTML = '';
        }

        const params = new URLSearchParams();
        if (name) params.append('searchName', name);

        try {
            const res = await fetch(`../api/admin-search-patient.php?${params.toString()}`, {
                method: 'GET',
                headers: { 'Accept': 'application/json' }
            });
            console.log('Fetch status', res.status);

            const data = await res.json();
            console.log('Data received', data);

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
                            <td colspan="5" class="text-center">No patients found</td>
                        </tr>
                    `;
                }
                return;
            }

            const patients = (data.data && data.data.patients) ? data.data.patients : [];
            console.log('Patients array', patients);

            if (!patients.length) {
                if (tbody) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="5" class="text-center">No patients found</td>
                        </tr>
                    `;
                }
                return;
            }

            if (tbody) {
                tbody.innerHTML = patients.map(p => {
                    const age = (p.age !== null && p.age !== undefined) ? p.age : 'N/A';
                    return `
                        <tr data-patient-id="${p.patientID}">
                          <td>${escapeHtml(p.name)}</td>
                          <td>${age}</td>
                          <td>${escapeHtml(p.email || '')}</td>
                          <td>${escapeHtml(p.phone != null ? p.phone : '')}</td>
                          <td>
                            <div class="action-buttons">
                              <a href="view_patient.php?id=${p.patientID}" class="action-btn view-btn" title="View">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                  <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                              </a>
                              <a href="edit_patient.php?id=${p.patientID}" class="action-btn edit-btn" title="Edit">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                                  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                              </a>
                              <a href="javascript:void(0)" class="action-btn archive-btn" data-action="archive" title="Archive">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                                  <polyline points="21 8 21 21 3 21 3 8"></polyline>
                                  <rect x="1" y="3" width="22" height="5"></rect>
                                  <line x1="10" y1="12" x2="14" y2="12"></line>
                                </svg>
                              </a>
                            </div>
                          </td>
                        </tr>
                    `;
                }).join('');
            }

        } catch (err) {
            console.error('Error in loadPatients:', err);
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
                        <td colspan="5" class="text-center">Could not load patients</td>
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
            loadPatients(nameInput.value.trim());
        });

        form.addEventListener('reset', function () {
            loadPatients('');
        });
    }

    loadPatients();
});
