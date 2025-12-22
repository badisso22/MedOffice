console.log('view_assistant.js loaded');

document.addEventListener('DOMContentLoaded', function () {
    const nameEl        = document.getElementById('assistant-name');
    const statusEl      = document.getElementById('assistant-status');
    const yearsEl       = document.getElementById('assistant-years-exp');
    const emailEl       = document.getElementById('assistant-email');
    const phoneEl       = document.getElementById('assistant-phone');
    const employeeEl    = document.getElementById('assistant-employee-id');
    const skillsWrap    = document.getElementById('assistant-skills');
    const skillsSection = document.getElementById('skills-section');
    const availWrap     = document.getElementById('assistant-availability');
    const availSection  = document.getElementById('availability-section');

    const urlParams   = new URLSearchParams(window.location.search);
    const assistantID = urlParams.get('assistantID');

    if (!assistantID) {
        nameEl.textContent = 'Assistant not found';
        return;
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

    function formatTimeRange(item) {
        if (!item) return 'Off';
        if (parseInt(item.isAvailable, 10) === 0 || !item.startTime || !item.endTime) {
            return 'Off';
        }
        const start = new Date('1970-01-01T' + item.startTime);
        const end   = new Date('1970-01-01T' + item.endTime);

        const opts = { hour: 'numeric', minute: '2-digit' };
        return start.toLocaleTimeString([], opts) + ' - ' + end.toLocaleTimeString([], opts);
    }

    async function loadAssistant() {
        try {
            const res = await fetch('../api/admin-view-assistant.php?assistantID=' + encodeURIComponent(assistantID), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            if (!res.ok) {
                throw new Error('HTTP ' + res.status);
            }

            const json = await res.json();
            if (!json.success || !json.data) {
                throw new Error(json.message || 'Failed to load assistant');
            }

            const d = json.data;

            nameEl.textContent   = d.fullName || 'Assistant';
            emailEl.textContent  = d.email || '—';
            phoneEl.textContent  = d.phone || '—';
            employeeEl.textContent = d.employeeCode || '—';

            const status = (d.status || 'available').toLowerCase();
            statusEl.textContent = status.charAt(0).toUpperCase() + status.slice(1);
            statusEl.className = 'status-badge status-' + status;

            if (d.yearsExp !== null && d.yearsExp !== undefined) {
                let val = parseFloat(d.yearsExp);
                if (!isNaN(val)) {
                    yearsEl.textContent = ('' + val).replace(/\.0$/, '');
                } else {
                    yearsEl.textContent = '—';
                }
            } else {
                yearsEl.textContent = '—';
            }

            if (Array.isArray(d.skills) && d.skills.length > 0) {
                skillsWrap.innerHTML = d.skills.map(s => `
                    <span class="specialty-tag">${escapeHtml(s)}</span>
                `).join('');
            } else {
                skillsSection.style.display = 'none';
            }

            if (Array.isArray(d.availability) && d.availability.length > 0) {
                const dayOrder = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
                const map = {};
                d.availability.forEach(item => { map[item.dayOfWeek] = item; });

                availWrap.innerHTML = dayOrder.map(day => {
                    const item = map[day] || null;
                    return `
                        <div class="availability-item">
                            <div class="day">${day}</div>
                            <div class="time">${escapeHtml(formatTimeRange(item))}</div>
                        </div>
                    `;
                }).join('');
            } else {
                availSection.style.display = 'none';
            }

        } catch (err) {
            console.error(err);
            nameEl.textContent = 'Error loading assistant';
        }
    }

    loadAssistant();
});
