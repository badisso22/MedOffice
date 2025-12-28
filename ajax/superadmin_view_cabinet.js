document.addEventListener('DOMContentLoaded', () => {
  loadCabinetData().catch(err => {
    console.error('Load cabinet error:', err);
    showPageError('Failed to load cabinet details');
  });
});

function qs(name) {
  return new URLSearchParams(window.location.search).get(name);
}

function setText(id, value, fallback = 'N/A') {
  const el = document.getElementById(id);
  if (!el) return; 
  el.textContent = (value === null || value === undefined || value === '') ? fallback : value;
}

function showPageError(message) {
  const nameEl = document.getElementById('cabinetName');
  if (nameEl) nameEl.textContent = message;
}

function initials(text) {
  if (!text) return 'CA';
  const parts = String(text).trim().split(/\s+/);
  return (parts[0]?.[0] || 'C').toUpperCase() + (parts[1]?.[0] || 'A').toUpperCase();
}

async function loadCabinetData() {
  const id = qs('id');
  if (!id) {
    showPageError('Missing cabinet id in URL (?id=...)');
    return;
  }

  const res = await fetch(`../api/superadmin-cabinet-view.php?id=${encodeURIComponent(id)}`, {
    headers: { 'X-Requested-With': 'XMLHttpRequest' },
    credentials: 'same-origin'
  });

  const json = await res.json();
  if (!json.success) {
    throw new Error((json.errors && json.errors[0]) ? json.errors[0] : 'Failed to load cabinet details');
  }

  populateCabinetView(json.data);
}

function populateCabinetView(data) {
  const c = data?.cabinet || {};
  const a = data?.admin || {};

  setText('cabinetName', c.cabinetname);
  setText('cabinetLocation', c.cabinetlocation);
  setText('cabinetStatus', c.status);
  setText('cabinetType', c.subscription_plan);
  setText('cabinetLogo', initials(c.cabinetname));

  setText('cabinetId', c.cabinetID);
  setText('cabinetTypeInfo', c.subscription_plan);

  setText('cabinetEmail', c.contact_email);
  setText('cabinetPhone', c.cabinetphonenumber);
  setText('createdAt', c.created_at);

  setText('primarySpecialty', c.cabinetspeciality);

  const adminInfo = document.getElementById('adminInfo');
  if (adminInfo) {
    adminInfo.innerHTML = `
      <div class="admin-card">
        <div class="admin-avatar">${initials(a.name)}</div>
        <div class="admin-info">
          <h4>${escapeHtml(a.name || 'N/A')}</h4>
          <p>${escapeHtml(a.email || 'N/A')}</p>
        </div>
      </div>
    `;
  }

  const map = document.getElementById('cabinetMap');
  if (map && c.cabinetlocation) {
    const current = map.getAttribute('src') || '';
    const keyMatch = current.match(/key=([^&]+)/);
    const key = keyMatch ? keyMatch[1] : 'YOUR_API_KEY';
    map.setAttribute(
      'src',
      `https://www.google.com/maps/embed/v1/place?key=${key}&q=${encodeURIComponent(c.cabinetlocation)}&zoom=15`
    );
  }
  setText('cabinetAddress', c.cabinetlocation);
}

function escapeHtml(str) {
  const div = document.createElement('div');
  div.textContent = str ?? '';
  return div.innerHTML;
}
