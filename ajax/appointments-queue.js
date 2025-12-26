document.addEventListener('DOMContentLoaded', () => {
  const doctorSelect = document.getElementById('doctorSelect');
  const currentContainer = document.getElementById('currentAppointmentContainer');
  const queueContainer = document.getElementById('queueItemsContainer');
  const inProgressCountEl = document.getElementById('inProgressCount');
  const waitingCountEl = document.getElementById('waitingCount');

  let currentDoctorFilter = 'all';
  let autoRefreshTimer = null;

  function buildQueueUrl() {
    const params = new URLSearchParams();
    if (currentDoctorFilter && currentDoctorFilter !== 'all') {
      params.set('doctorId', currentDoctorFilter);
    }
    return '../api/assistant-get-today-queue.php' + (params.toString() ? `?${params}` : '');
  }

  async function loadQueue() {
    try {
      const res = await fetch(buildQueueUrl(), {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });
      const json = await res.json();
      if (!res.ok || !json.success) {
        console.error(json.errors || 'Failed to load queue');
        return;
      }

      const { current, waiting, doctors } = json.data;

      if (doctorSelect && doctorSelect.options.length === 1 && Array.isArray(doctors)) {
        doctors.forEach(doc => {
          const opt = document.createElement('option');
          opt.value = doc.doctorID;
          opt.textContent = `Dr. ${doc.firstName} ${doc.lastName} (${doc.specialty || 'General'})`;
          doctorSelect.appendChild(opt);
        });
      }

      renderCurrent(current);
      renderWaiting(waiting || []);
    } catch (err) {
      console.error('Error loading queue:', err);
    }
  }

  function renderCurrent(current) {
    currentContainer.innerHTML = '';

    if (!current) {
      currentContainer.innerHTML = '<div class="empty-state">No active consultation at the moment.</div>';
      inProgressCountEl.textContent = '0';
      return;
    }

    inProgressCountEl.textContent = '1';

    const card = document.createElement('div');
    card.className = 'current-appointment-card';

    const time = (current.appointmentTime || '').slice(0, 5);
    const docName = current.doctorFirstName
      ? `Dr. ${current.doctorFirstName} ${current.doctorLastName}`
      : 'Unassigned';

    card.innerHTML = `
      <div class="current-main">
        <div class="current-patient">
          <div class="avatar-circle">
            ${current.patientName ? current.patientName.charAt(0).toUpperCase() : '?'}
          </div>
          <div>
            <h4>${current.patientName || 'Unknown patient'}</h4>
            <p class="current-meta">
              <span>ID: #${current.patientID}</span>
              <span>${docName}</span>
            </p>
          </div>
        </div>
        <div class="current-time">
          <span class="time-label">Time</span>
          <span class="time-value">${time}</span>
        </div>
      </div>
      <div class="current-purpose">
        <span class="purpose-label">Purpose</span>
        <span class="purpose-text">${current.purpose || '-'}</span>
      </div>
    `;

    currentContainer.appendChild(card);
  }

  function renderWaiting(list) {
    queueContainer.innerHTML = '';

    waitingCountEl.textContent = list.length.toString();

    if (!list.length) {
      queueContainer.innerHTML = '<div class="empty-state">No patients waiting in the queue.</div>';
      return;
    }

    list.forEach((apt, index) => {
      const item = document.createElement('div');
      item.className = 'queue-item';
      item.dataset.id = apt.appointmentID;

      const pos = apt.queue_order || (index + 1);
      const time = (apt.appointmentTime || '').slice(0, 5);
      const docName = apt.doctorFirstName
        ? `Dr. ${apt.doctorFirstName} ${apt.doctorLastName}`
        : 'Unassigned';

      item.innerHTML = `
        <div class="queue-position">
          <div class="position-badge waiting">${pos}</div>
          <div class="position-info">
            <h4>${apt.patientName || 'Unknown patient'}</h4>
            <div class="position-meta">
              <span>Patient ID: #${apt.patientID}</span>
              <span>${docName}</span>
              <span>${time}</span>
              <span>${apt.purpose || '-'}</span>
            </div>
          </div>
        </div>
      `;

      queueContainer.appendChild(item);
    });
  }

  window.filterQueueByDoctor = function () {
    const value = doctorSelect.value;
    currentDoctorFilter = value;
    loadQueue();
  };

  loadQueue();
  autoRefreshTimer = setInterval(loadQueue, 15000);
});
