console.log('about-cabinet.js loaded');

document.addEventListener('DOMContentLoaded', async function() {
    await loadCabinetInfo();
});

async function loadCabinetInfo() {
    try {
        const res = await fetch('../api/get-cabinet-info.php', {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        if (!res.ok) throw new Error('HTTP ' + res.status);

        const json = await res.json();
        if (!json.success || !json.data) {
            throw new Error(json.message || 'Failed to load cabinet info');
        }

        const d = json.data;

        // Cabinet info
        document.getElementById('cabinet-name').textContent = d.cabinet.name || 'Cabinet';
        document.getElementById('cabinet-specialty').textContent = d.cabinet.specialty || 'General Practice';
        document.getElementById('cabinet-location').textContent = d.cabinet.location || '—';
        document.getElementById('cabinet-phone').textContent = d.cabinet.phone || '—';
        document.getElementById('cabinet-email').textContent = d.cabinet.email || '—';
        document.getElementById('cabinet-hours').textContent = d.cabinet.hours || '—';

        // Stats
        document.getElementById('stat-patients').textContent = d.stats.patients || 0;
        document.getElementById('stat-doctors').textContent = d.stats.doctors || 0;
        document.getElementById('stat-assistants').textContent = d.stats.assistants || 0;
        document.getElementById('stat-appointments').textContent = d.stats.appointments || 0;

    } catch (err) {
        console.error('Error loading cabinet info:', err);
        alert('Error loading cabinet info: ' + err.message);
    }
}
