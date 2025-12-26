document.addEventListener('DOMContentLoaded', () => {
  const grid = document.getElementById('appointmentsGrid');
  const filterButtons = document.querySelectorAll('.filter-btn');

  let allAppointments = [];

  function mapStatus(status) {
    switch (status) {
      case 'pending': return { label: 'Upcoming', css: 'status-upcoming' };
      case 'accepted': return { label: 'Upcoming', css: 'status-upcoming' };
      case 'completed': return { label: 'Completed', css: 'status-completed' };
      case 'cancelled': return { label: 'Cancelled', css: 'status-cancelled' };
      default: return { label: status, css: 'status-upcoming' };
    }
  }

  function formatDate(dateStr) {
    if (!dateStr) return '';
    const d = new Date(dateStr + 'T00:00:00');
    return d.toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' });
  }

  function formatTime(timeStr) {
    if (!timeStr) return '';
    const [h, m] = timeStr.split(':');
    const d = new Date();
    d.setHours(parseInt(h, 10), parseInt(m, 10), 0, 0);
    return d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
  }

  function buildAvatarInitials(firstName, lastName) {
    const f = firstName ? firstName[0].toUpperCase() : '';
    const l = lastName ? lastName[0].toUpperCase() : '';
    return (f + l) || 'DR';
  }

  function renderAppointments(filter) {
    grid.innerHTML = '';

    const now = new Date();
    const items = allAppointments.filter(a => {
      const status = a.status;
      const dateObj = new Date(a.date + 'T' + (a.appointmentTime || '00:00:00'));

      if (filter === 'upcoming') {
        return (status === 'pending' || status === 'accepted') && dateObj >= now;
      }
      if (filter === 'completed') {
        return status === 'completed';
      }
      if (filter === 'cancelled') {
        return status === 'cancelled';
      }
      return true; 
    });

    if (!items.length) {
      grid.innerHTML = '<p class="empty-state">No appointments to display.</p>';
      return;
    }

    items.forEach(appt => {
      const statusInfo = mapStatus(appt.status);
      const doctorName = appt.doctorFirstName || appt.doctorLastName
        ? `Dr. ${appt.doctorFirstName || ''} ${appt.doctorLastName || ''}`.trim()
        : 'Doctor not assigned';

      const initials = buildAvatarInitials(appt.doctorFirstName, appt.doctorLastName);

      const card = document.createElement('div');
      card.className = 'appointment-card';
      card.innerHTML = `
        <div class="card-header">
          <div class="doctor-header">
            <div class="doctor-info">
              <div class="doctor-avatar">${initials}</div>
              <div class="doctor-details">
                <h3>${doctorName}</h3>
                <p class="doctor-specialty">${appt.specialty || ''}</p>
              </div>
            </div>
            <span class="status-badge ${statusInfo.css}">${statusInfo.label}</span>
          </div>
        </div>
        <div class="card-body">
          <div class="appointment-info">
            <div class="info-row">
              <svg class="info-icon" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
              <span class="info-label">Date:</span>
              <span class="info-value">${formatDate(appt.date)}</span>
            </div>
            <div class="info-row">
              <svg class="info-icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              <span class="info-label">Time:</span>
              <span class="info-value">${formatTime(appt.appointmentTime)}</span>
            </div>
            <div class="info-row">
              <svg class="info-icon" viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/></svg>
              <span class="info-label">Reason:</span>
              <span class="info-value">${appt.purpose}</span>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn-small btn-details" onclick="window.location.href='appointment_details.php?id=${appt.appointmentID}'">View Details</button>
          ${
            (appt.status === 'pending' || appt.status === 'accepted')
              ? `<button class="btn-small btn-cancel" onclick="window.location.href='cancel_appointment.php?id=${appt.appointmentID}'">Cancel</button>`
              : ''
          }
        </div>
      `;
      grid.appendChild(card);
    });
  }

  async function loadAppointments() {
    try {
      const res = await fetch('../api/get-patient-appointments.php', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });
      const json = await res.json();
      if (!res.ok || !json.success) {
        console.error(json.errors || 'Failed to load appointments');
        grid.innerHTML = '<p class="empty-state">Unable to load appointments.</p>';
        return;
      }

      allAppointments = json.data.appointments || [];
      renderAppointments('all');
    } catch (err) {
      console.error('Appointments error:', err);
      grid.innerHTML = '<p class="empty-state">Unable to load appointments.</p>';
    }
  }

  filterButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      filterButtons.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const status = btn.textContent.trim().toLowerCase();
      const key = status === 'all' ? 'all' : status;
      renderAppointments(key);
    });
  });

  loadAppointments();
});
