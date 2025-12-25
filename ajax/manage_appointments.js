function toggleDrawer() {
  const drawer = document.getElementById('drawer');
  const overlay = document.getElementById('drawerOverlay');
  drawer.classList.toggle('open');
  overlay.classList.toggle('active');
}

function logout() {
  window.location.href = '../index.html';
}

document.addEventListener('DOMContentLoaded', () => {
  const requestsContainer = document.querySelector('.requests-container');
  const refreshBtn = document.querySelector('.section-header .btn-secondary');
  const totalPendingEl = document.querySelector('.stat-card:nth-child(1) .stat-number');

  async function fetchPending() {
    try {
      const res = await fetch('../api/assistant-get-pending-appointments.php', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });
      const json = await res.json();
      if (!res.ok || !json.success) {
        console.error(json.errors || 'Failed to load appointments');
        return;
      }
      renderRequests(json.data.appointments || []);
    } catch (err) {
      console.error('Error loading pending appointments:', err);
    }
  }

  function renderRequests(list) {
    requestsContainer.innerHTML = '';
    totalPendingEl.textContent = list.length;

    if (!list.length) {
      requestsContainer.innerHTML = '<p class="empty-state">No pending requests.</p>';
      return;
    }

    list.forEach(apt => {
      const card = document.createElement('div');
      card.className = 'request-card';
      card.dataset.id = apt.appointmentID;

      const patientInitials = (apt.patientName || '?')
        .split(' ')
        .map(p => p.charAt(0))
        .join('')
        .toUpperCase();

      const dateFormatted = new Date(apt.date + 'T00:00:00').toLocaleDateString('en-GB');
      const timeFormatted = apt.appointmentTime?.slice(0,5) || apt.time?.slice(0,5) || '';

      card.innerHTML = `
        <div class="card-header">
          <div class="patient-info">
            <div class="patient-avatar">${patientInitials}</div>
            <div>
              <h3 class="patient-name">${apt.patientName}</h3>
              <p class="patient-type">
                ${apt.doctorFirstName ? `Dr. ${apt.doctorFirstName} ${apt.doctorLastName}` : 'Patient Request'}
              </p>
            </div>
          </div>
          <span class="status-badge status-pending">Pending</span>
        </div>

        <div class="card-content">
          <div class="info-grid">
            <div class="info-item">
              <span class="info-label">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                  <path d="M16 2v4M8 2v4M3 10h18"></path>
                </svg>
                Date
              </span>
              <span class="info-value">${dateFormatted}</span>
            </div>
            <div class="info-item">
              <span class="info-label">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="10"></circle>
                  <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                Time
              </span>
              <span class="info-value">${timeFormatted}</span>
            </div>
            <div class="info-item">
              <span class="info-label">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
                Reason
              </span>
              <span class="info-value">${apt.purpose}</span>
            </div>
          </div>
        </div>

        <div class="card-actions">
          <button class="btn btn-accept" data-action="accept">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            Accept
          </button>
          <button class="btn btn-decline" data-action="decline">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
            Decline
          </button>
        </div>
      `;
      requestsContainer.appendChild(card);
    });
  }

  async function updateStatus(appointmentId, action, cardElem) {
    try {
      const res = await fetch('../api/assistant-update-appointment-status.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ appointmentId, action })
      });
      const json = await res.json();
      if (!res.ok || !json.success) {
        console.error(json.errors || 'Failed to update status');
        return;
      }

      if (cardElem && cardElem.parentNode) {
        cardElem.parentNode.removeChild(cardElem);
      }
      const remaining = document.querySelectorAll('.request-card').length;
      totalPendingEl.textContent = remaining;
    } catch (err) {
      console.error('Error updating appointment status:', err);
    }
  }

  requestsContainer.addEventListener('click', (e) => {
    const btn = e.target.closest('button[data-action]');
    if (!btn) return;

    const card = btn.closest('.request-card');
    const id = parseInt(card.dataset.id, 10);
    const action = btn.dataset.action;

    if (!id) return;

    updateStatus(id, action, card);
  });

  if (refreshBtn) {
    refreshBtn.addEventListener('click', (e) => {
      e.preventDefault();
      fetchPending();
    });
  }

  fetchPending();
});
