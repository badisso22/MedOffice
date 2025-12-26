document.addEventListener('DOMContentLoaded', () => {
  const container = document.querySelector('.details-container');
  if (!container) return;

  const appointmentID = container.getAttribute('data-appointment-id');
  if (!appointmentID) return;

  const statusBadge = document.getElementById('appointmentStatusBadge');
  const doctorAvatar = document.getElementById('doctorAvatarLarge');
  const doctorNameEl = document.getElementById('doctorName');
  const doctorSpecialtyEl = document.getElementById('doctorSpecialty');
  const doctorBioEl = document.getElementById('doctorBio');
  const doctorPhoneEl = document.getElementById('doctorPhone');
  const doctorEmailEl = document.getElementById('doctorEmail');
  const dateEl = document.getElementById('appointmentDate');
  const timeEl = document.getElementById('appointmentTime');
  const purposeEl = document.getElementById('appointmentPurpose');
  const notesEl = document.getElementById('appointmentNotes');
  const cancelLink = document.getElementById('cancelLink');
  const actionsWrapper = document.getElementById('appointmentActions');

  function mapStatus(status) {
    switch (status) {
      case 'pending':
      case 'accepted':
        return { label: 'Upcoming', css: 'status-upcoming' };
      case 'completed':
        return { label: 'Completed', css: 'status-completed' };
      case 'cancelled':
        return { label: 'Cancelled', css: 'status-cancelled' };
      default:
        return { label: status || 'Unknown', css: 'status-upcoming' };
    }
  }

  function formatDate(dateStr) {
    if (!dateStr) return '';
    const d = new Date(dateStr + 'T00:00:00');
    return d.toLocaleDateString(undefined, { year: 'numeric', month: 'long', day: 'numeric' });
  }

  function formatTime(timeStr) {
    if (!timeStr) return '';
    const [h, m] = timeStr.split(':');
    const d = new Date();
    d.setHours(parseInt(h, 10), parseInt(m, 10), 0, 0);
    return d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
  }

  function initials(first, last) {
    const f = first ? first[0].toUpperCase() : '';
    const l = last ? last[0].toUpperCase() : '';
    return (f + l) || 'DR';
  }

  async function loadDetails() {
    try {
      const res = await fetch(`../api/get-appointment-details.php?id=${encodeURIComponent(appointmentID)}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });
      const json = await res.json();
      if (!res.ok || !json.success) {
        console.error(json.errors || 'Failed to load appointment');
        container.querySelector('.details-header h1').textContent = 'Appointment not found';
        if (statusBadge) {
          statusBadge.textContent = 'Error';
          statusBadge.classList.add('status-cancelled');
        }
        if (actionsWrapper) actionsWrapper.style.display = 'none';
        return;
      }

      const appt = json.data.appointment;

      const statusInfo = mapStatus(appt.status);
      if (statusBadge) {
        statusBadge.textContent = statusInfo.label;
        statusBadge.className = 'header-badge ' + statusInfo.css;
      }

      const firstName = appt.doctorFirstName || '';
      const lastName = appt.doctorLastName || '';
      const fullName = (firstName || lastName)
        ? `Dr. ${firstName} ${lastName}`.trim()
        : 'Doctor not assigned';

      if (doctorAvatar) doctorAvatar.textContent = initials(firstName, lastName);
      if (doctorNameEl) doctorNameEl.textContent = fullName;
      if (doctorSpecialtyEl) doctorSpecialtyEl.textContent = appt.specialty || '';
      if (doctorBioEl) doctorBioEl.textContent = ''; 
      if (doctorPhoneEl) doctorPhoneEl.textContent = appt.doctorPhone || '—';
      if (doctorEmailEl) doctorEmailEl.textContent = appt.doctorEmail || '—';

      if (dateEl) dateEl.textContent = formatDate(appt.date);
      if (timeEl) timeEl.textContent = formatTime(appt.appointmentTime);
      if (purposeEl) purposeEl.textContent = appt.purpose || '';
      if (notesEl) notesEl.textContent = '—';

      if (appt.status === 'completed' || appt.status === 'cancelled') {
        if (cancelLink) cancelLink.style.display = 'none';
      } else if (cancelLink) {
        cancelLink.href = `cancel_appointment.php?id=${appt.appointmentID}`;
      }

    } catch (err) {
      console.error('Error loading appointment details:', err);
      container.querySelector('.details-header h1').textContent = 'Error loading appointment';
      if (statusBadge) {
        statusBadge.textContent = 'Error';
        statusBadge.classList.add('status-cancelled');
      }
      if (actionsWrapper) actionsWrapper.style.display = 'none';
    }
  }

  loadDetails();
});
