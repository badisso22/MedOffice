console.log('reports.js loaded');

async function loadReports() {
    const period = document.getElementById('timePeriod')?.value || 'month';

    try {
        const res = await fetch(`../api/get-reports-data.php?period=${period}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        if (!res.ok) throw new Error('HTTP ' + res.status);

        const json = await res.json();
        if (!json.success || !json.data) {
            throw new Error(json.message || 'Failed to load reports');
        }

        const d = json.data;

        document.getElementById('total-patients').textContent = d.totalPatients || 0;
        document.getElementById('total-appointments').textContent = d.totalAppointments || 0;
        document.getElementById('total-revenue').textContent = (d.totalRevenue || 0).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}) + ' DZD';
        document.getElementById('completed-consultations').textContent = d.completedConsultations || 0;

        const patientsChange = document.getElementById('patients-change');
        const appointmentsChange = document.getElementById('appointments-change');
        const revenueChange = document.getElementById('revenue-change');
        const consultationsChange = document.getElementById('consultations-change');

        if (patientsChange) patientsChange.style.display = 'none';
        if (appointmentsChange) appointmentsChange.style.display = 'none';
        if (revenueChange) revenueChange.style.display = 'none';
        if (consultationsChange) consultationsChange.style.display = 'none';

        renderAgeDistribution(d.ageDistribution, d.totalPatientsForAge);
        renderAppointmentTypes(d.appointmentTypes, d.totalApptsForTypes);
        renderRecentConsultations(d.recentConsultations);

    } catch (err) {
        console.error('Error loading reports:', err);
        alert('Error loading reports: ' + err.message);
    }
}

function renderAgeDistribution(dist, total) {
    const container = document.getElementById('age-distribution');
    if (!container) return;

    const groups = [
        { label: '0-18 years', key: '0-18', color: '#0891b2' },
        { label: '19-35 years', key: '19-35', color: '#06b6d4' },
        { label: '36-55 years', key: '36-55', color: '#10b981' },
        { label: '56+ years', key: '56+', color: '#f59e0b' }
    ];

    let html = '';
    groups.forEach(g => {
        const count = dist[g.key] || 0;
        const percent = total > 0 ? Math.round((count / total) * 100) : 0;
        html += `
            <div class="demographics-item">
                <div class="demographics-label">${g.label}</div>
                <div class="demographics-bar">
                    <div class="demographics-fill" style="width: ${percent}%; background: ${g.color};"></div>
                </div>
                <div class="demographics-value">${percent}%</div>
            </div>
        `;
    });

    container.innerHTML = html;
}

function renderAppointmentTypes(types, total) {
    const container = document.getElementById('appointment-types');
    if (!container) return;

    const colors = ['#0891b2', '#06b6d4', '#10b981', '#f59e0b', '#ef4444'];

    if (types.length === 0) {
        container.innerHTML = '<p style="text-align: center; color: #6b7280;">No appointments yet</p>';
        return;
    }

    let html = '';
    types.slice(0, 5).forEach((t, i) => {
        const percent = total > 0 ? Math.round((t.count / total) * 100) : 0;
        html += `
            <div class="demographics-item">
                <div class="demographics-label">${escapeHtml(t.type)}</div>
                <div class="demographics-bar">
                    <div class="demographics-fill" style="width: ${percent}%; background: ${colors[i % colors.length]};"></div>
                </div>
                <div class="demographics-value">${percent}%</div>
            </div>
        `;
    });

    container.innerHTML = html;
}

function renderRecentConsultations(consultations) {
    const tbody = document.getElementById('recent-consultations');
    if (!tbody) return;

    if (consultations.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" style="text-align: center;">No consultations found</td></tr>';
        return;
    }

    let html = '';
    consultations.forEach(c => {
        const fees = c.fees ? parseFloat(c.fees) : 0;
        html += `
            <tr>
                <td>${formatDate(c.date)}</td>
                <td><strong>${escapeHtml(c.patient)}</strong></td>
                <td><span class="badge">${escapeHtml(c.type)}</span></td>
                <td>${escapeHtml(c.diagnosis)}</td>
                <td><strong>${fees.toFixed(2)} DZD</strong></td>
            </tr>
        `;
    });

    tbody.innerHTML = html;
}

function formatDate(dateStr) {
    if (!dateStr) return '—';
    const date = new Date(dateStr);
    return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
}

function escapeHtml(str) {
    if (!str) return '—';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');
}

document.addEventListener('DOMContentLoaded', function() {
    loadReports();
});
