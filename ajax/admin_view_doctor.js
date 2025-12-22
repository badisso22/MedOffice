console.log('admin_view_doctor.js loaded');

document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const doctorID = urlParams.get('doctorID');

    if (!doctorID) {
        alert('No doctor ID provided');
        window.location.href = 'searchD.php';
        return;
    }

    async function loadDoctor() {
        try {
            const res = await fetch('../api/admin-view-doctor.php?doctorID=' + encodeURIComponent(doctorID), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            if (!res.ok) throw new Error('HTTP ' + res.status);

            const json = await res.json();
            if (!json.success || !json.data) {
                throw new Error(json.message || 'Failed to load doctor');
            }

            const d = json.data;

            document.getElementById('doctor-name').textContent = d.fullName || 'Doctor';
            document.getElementById('doctor-id').textContent = 'DOC-' + String(d.doctorID).padStart(4, '0');
            document.getElementById('doctor-status').textContent = d.isActive ? 'Active' : 'Inactive';
            
            const initials = d.fullName.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
            document.getElementById('doctor-avatar').textContent = initials;

            document.getElementById('doctor-speciality').textContent = d.speciality || '—';
            document.getElementById('doctor-experience').textContent = d.yearsExp ? d.yearsExp + ' Years' : '—';
            document.getElementById('doctor-license').textContent = d.licenseNumber || '—';
            document.getElementById('doctor-email').textContent = d.email || '—';
            document.getElementById('doctor-phone').textContent = d.phone || '—';

            const bioEl = document.getElementById('doctor-bio');
            if (d.bio) {
                bioEl.textContent = d.bio;
            } else {
                document.getElementById('bio-section').style.display = 'none';
            }

            const eduWrap = document.getElementById('doctor-education');
            const eduSection = document.getElementById('education-section');
            if (Array.isArray(d.education) && d.education.length > 0) {
                eduWrap.innerHTML = d.education.map(e => `
                    <div class="qualification-card">
                        <h4>${escapeHtml(e.degree || '')}</h4>
                        <p>${escapeHtml(e.institution || '')}${e.year ? ', ' + e.year : ''}</p>
                    </div>
                `).join('');
            } else {
                eduSection.style.display = 'none';
            }

            const availWrap = document.getElementById('doctor-availability');
            const availSection = document.getElementById('availability-section');
            if (Array.isArray(d.availability) && d.availability.length > 0) {
                availWrap.innerHTML = d.availability.map(a => {
                    const timeSlot = formatTimeRange(a);
                    return `
                        <div class="schedule-row">
                            <span class="day-name">${a.dayOfWeek}</span>
                            <span class="time-slots">${escapeHtml(timeSlot)}</span>
                            <span class="availability-status">${parseInt(a.isAvailable) ? 'Available' : 'Off'}</span>
                        </div>
                    `;
                }).join('');
            } else {
                availSection.style.display = 'none';
            }

        } catch (err) {
            console.error(err);
            alert('Error loading doctor: ' + err.message);
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

    function formatTimeRange(item) {
        if (!item || parseInt(item.isAvailable, 10) === 0 || !item.startTime || !item.endTime) {
            return 'Off';
        }
        const start = new Date('1970-01-01T' + item.startTime);
        const end = new Date('1970-01-01T' + item.endTime);
        const opts = { hour: 'numeric', minute: '2-digit' };
        return start.toLocaleTimeString([], opts) + ' - ' + end.toLocaleTimeString([], opts);
    }

    loadDoctor();
});
