console.log('Superadmin Cabinets JS loaded');

window.cabinetManager = null;

class CabinetManager {
    constructor() {
        this.tableBody = document.querySelector('#cabinetsTable');
        this.statsCards = {
            total: document.querySelector('[data-stat=total]'),
            active: document.querySelector('[data-stat=active]'),
            suspended: document.querySelector('[data-stat=suspended]'),
            utilization: document.querySelector('[data-stat=utilization]')
        };
        this.searchInput = document.getElementById('cabinetSearch');
        this.statusFilter = document.getElementById('statusFilter');
        this.addModal = document.getElementById('addCabinetModal');
        this.editModal = document.getElementById('editCabinetModal');
        this.viewModal = document.getElementById('viewCabinetModal');
        
        console.log('CabinetManager constructor - elements found:', {
            tableBody: !!this.tableBody,
            searchInput: !!this.searchInput,
            statusFilter: !!this.statusFilter
        });
        
        this.init();
    }

    init() {
        console.log('Initializing CabinetManager...');
        this.bindEvents();
        this.loadCabinets();
    }

    bindEvents() {
        console.log('Binding events...');
        
        document.addEventListener('click', (e) => {
            if (e.target.closest('.view-btn')) {
                e.preventDefault();
                const cabinetId = e.target.closest('tr').dataset.cabinetId;
                this.viewCabinet(cabinetId);
            }
            if (e.target.closest('.edit-btn')) {
                e.preventDefault();
                const cabinetId = e.target.closest('tr').dataset.cabinetId;
                this.editCabinet(cabinetId);
            }
            if (e.target.closest('.archive-btn')) {
                e.preventDefault();
                const cabinetId = e.target.closest('tr').dataset.cabinetId;
                this.archiveCabinet(cabinetId);
            }
        });

        if (this.searchInput) {
            this.searchInput.addEventListener('input', debounce(this.searchCabinets.bind(this), 300));
            console.log('Search event bound');
        } else {
            console.warn('Search input not found');
        }
        
        if (this.statusFilter) {
            this.statusFilter.addEventListener('change', this.filterByStatus.bind(this));
            console.log('Filter event bound');
        } else {
            console.warn('Status filter not found');
        }
    }

    async loadCabinets(status = 'all', search = '') {
        try {
            console.log('Loading cabinets...', status, search);
            this.showLoading();
            
            const params = new URLSearchParams({ status, search });
            const url = `../api/superadmin-cabinets-list.php?${params}`;
            console.log('Fetching from', url);
            
            const res = await fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            
            if (!res.ok) throw new Error(`HTTP ${res.status}`);
            
            const json = await res.json();
            console.log('API Response', json);
            
            if (json.success) {
                this.renderTable(json.data.cabinets);
                this.updateStats(json.data);
            } else {
                this.showError(json.errors?.[0] || 'Failed to load cabinets');
            }
        } catch (err) {
            console.error('Load cabinets error', err);
            this.showError(`Network error: ${err.message}`);
        }
    }

    renderTable(cabinets) {
        console.log('Rendering table with', cabinets.length, 'cabinets');
        
        if (!this.tableBody) {
            console.error('Table body element #cabinetsTable not found!');
            return;
        }
        
        if (cabinets.length === 0) {
            this.tableBody.innerHTML = `
                <tr class="no-data-row">
                    <td colspan="8" style="text-align: center; padding: 2rem; color: #9ca3af;">
                        No cabinets found
                    </td>
                </tr>
            `;
            return;
        }

        this.tableBody.innerHTML = cabinets.map(cabinet => {
            const statusClass = cabinet.status === 'active' ? 'status-active' : 
                               cabinet.status === 'suspended' ? 'status-suspended' : 'status-archived';
            const createdDate = new Date(cabinet.created_at).toLocaleDateString();
            
            return `
                <tr data-cabinet-id="${cabinet.cabinetID}">
                    <td>${cabinet.cabinetID}</td>
                    <td>${this.escapeHtml(cabinet.cabinetname)}</td>
                    <td>${this.escapeHtml(cabinet.cabinetlocation)}</td>
                    <td>${this.escapeHtml(cabinet.contactemail || 'N/A')}</td>
                    <td>${this.escapeHtml(cabinet.cabinetphonenumber || 'N/A')}</td>
                    <td><span class="status-badge ${statusClass}">${this.escapeHtml(cabinet.status)}</span></td>
                    <td>${createdDate}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="action-btn view-btn" title="View Details">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                            <button class="action-btn edit-btn" title="Edit Cabinet">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                            </button>
                            ${cabinet.status !== 'archived' ? `
                                <button class="action-btn archive-btn" title="Archive Cabinet">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18">
                                        <rect x="2" y="4" width="20" height="5" rx="1"></rect>
                                        <path d="M4 9v10a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V9"></path>
                                    </svg>
                                </button>
                            ` : ''}
                        </div>
                    </td>
                </tr>
            `;
        }).join('');
        
        console.log('Table rendered successfully');
    }

    updateStats(data) {
        console.log('Updating stats', data);
        if (this.statsCards.total) this.statsCards.total.textContent = data.count || 0;
        
        const cabinets = data.cabinets || [];
        const activeCabinets = cabinets.filter(c => c.status === 'active').length;
        const suspendedCabinets = cabinets.filter(c => c.status === 'suspended').length;
        
        if (this.statsCards.active) this.statsCards.active.textContent = activeCabinets;
        if (this.statsCards.suspended) this.statsCards.suspended.textContent = suspendedCabinets;
    }

    async searchCabinets() {
        const search = this.searchInput?.value;
        console.log('Searching for', search);
        await this.loadCabinets('all', search);
    }

    async filterByStatus() {
        const status = this.statusFilter?.value || 'all';
        console.log('Filtering by status', status);
        await this.loadCabinets(status);
    }

    showLoading() {
        if (this.tableBody) {
            this.tableBody.innerHTML = `
                <tr>
                    <td colspan="8" style="text-align: center; padding: 2rem; color: #9ca3af;">
                        <div style="display: inline-block; animation: spin 1s linear infinite;"></div>
                        <p>Loading cabinets...</p>
                    </td>
                </tr>
            `;
        }
    }

    showError(message) {
        if (this.tableBody) {
            this.tableBody.innerHTML = `
                <tr class="error-row">
                    <td colspan="8" style="text-align: center; padding: 2rem; color: #ef4444;">
                        ${this.escapeHtml(message)}
                    </td>
                </tr>
            `;
        }
    }

    escapeHtml(str) {
        if (!str) return '';
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }

    async createCabinet(formData) {
        try {
            console.log('Creating cabinet', formData);
            const res = await fetch('../api/superadmin-cabinet-create.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(formData)
            });
            const json = await res.json();
            console.log('Create response', json);
            return json;
        } catch (err) {
            console.error('Create error', err);
            return { success: false, errors: ['Network error'] };
        }
    }

    async updateCabinet(cabinetId, formData) {
        try {
            console.log('Updating cabinet', cabinetId, formData);
            formData.cabinetID = cabinetId;
            const res = await fetch('../api/superadmin-cabinet-update.php', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(formData)
            });
            const json = await res.json();
            console.log('Update response', json);
            return json;
        } catch (err) {
            console.error('Update error', err);
            return { success: false, errors: ['Network error'] };
        }
    }

    async archiveCabinet(cabinetId) {
        if (!confirm('Archive this cabinet? It will be moved to archived status.')) return;
        
        try {
            console.log('Archiving cabinet', cabinetId);
            const res = await fetch('./api/superadmin-cabinet-update.php', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ cabinetID: cabinetId, status: 'archived' })
            });
            const json = await res.json();
            console.log('Archive response', json);
            
            if (json.success) {
                this.loadCabinets();
                showNotification('Cabinet archived successfully!', 'success');
            } else {
                showNotification(json.errors?.[0] || 'Archive failed', 'error');
            }
        } catch (err) {
            console.error('Archive error', err);
            showNotification('Network error archiving cabinet', 'error');
        }
    }

    async viewCabinet(cabinetId) {
    window.open(`view_cabinet.php?id=${cabinetId}`, '_blank');
    console.log('Opening cabinet view:', cabinetId);
}


    populateViewModal(cabinet) {
        console.log('Populating view modal with', cabinet);
        document.getElementById('viewCabinetId').textContent = cabinet.cabinetID;
        document.getElementById('viewCabinetName').textContent = cabinet.cabinetname || 'N/A';
        document.getElementById('viewCabinetLocation').textContent = cabinet.cabinetlocation || 'N/A';
        document.getElementById('viewContactEmail').textContent = cabinet.contactemail || 'N/A';
        document.getElementById('viewPhone').textContent = cabinet.cabinetphonenumber || 'N/A';
        document.getElementById('viewSpeciality').textContent = cabinet.cabinetspeciality || 'N/A';
        document.getElementById('viewPlan').textContent = cabinet.subscriptionplan || 'N/A';
        document.getElementById('viewStatus').textContent = cabinet.status || 'N/A';
        document.getElementById('viewCreatedAt').textContent = new Date(cabinet.created_at).toLocaleDateString();
    }

    async editCabinet(cabinetId) {
        try {
            console.log('Loading cabinet for edit', cabinetId);
            const params = new URLSearchParams({ id: cabinetId });
            const res = await fetch(`../api/superadmin-cabinets-list.php?${params}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const json = await res.json();
            
            if (json.success && json.data.cabinets && json.data.cabinets.length > 0) {
                this.populateEditForm(json.data.cabinets[0]);
                this.editModal.showModal();
            } else {
                showNotification('Cabinet not found', 'error');
            }
        } catch (err) {
            console.error('Edit load error', err);
            showNotification('Failed to load cabinet details', 'error');
        }
    }

    populateEditForm(cabinet) {
        console.log('Populating edit form with', cabinet);
        document.getElementById('editCabinetId').value = cabinet.cabinetID;
        document.getElementById('editCabinetName').value = cabinet.cabinetname || '';
        document.getElementById('editCabinetLocation').value = cabinet.cabinetlocation || '';
        document.getElementById('editContactEmail').value = cabinet.contactemail || '';
        document.getElementById('editPhone').value = cabinet.cabinetphonenumber || '';
        document.getElementById('editStatus').value = cabinet.status || 'active';
    }
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed; top: 20px; right: 20px; padding: 1rem 1.5rem;
        background: ${type === 'success' ? '#10b981' : '#ef4444'}; color: white;
        border-radius: 0.5rem; z-index: 9999; box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        font-weight: 500;
    `;
    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 3000);
}

const style = document.createElement('style');
style.textContent = `
    .action-buttons {
        display: flex; gap: 0.5rem; align-items: center; justify-content: flex-end;
    }
    .action-btn {
        display: inline-flex; align-items: center; justify-content: center;
        width: 36px; height: 36px; padding: 0; border: 1px solid #374151;
        border-radius: 0.375rem; background: transparent; color: #d1d5db;
        cursor: pointer; transition: all 0.2s ease; font-size: 0;
    }
    .action-btn:hover { border-color: #4b5563; background: rgba(75,85,99,0.1); color: #e5e7eb; }
    .action-btn:active { background: rgba(75,85,99,0.2); }
    .action-btn svg { display: block; stroke-linecap: round; stroke-linejoin: round; }
    .view-btn:hover { border-color: #3b82f6; color: #3b82f6; }
    .edit-btn:hover { border-color: #60a5fa; color: #60a5fa; }
    .archive-btn:hover { border-color: #f59e0b; color: #f59e0b; }
`;
document.head.appendChild(style);

document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM loaded - initializing CabinetManager');
    window.cabinetManager = new CabinetManager();
});
