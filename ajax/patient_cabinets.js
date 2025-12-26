let data = [];
let filteredData = [];

const list = document.getElementById('cab-list');
const emptyState = document.getElementById('emptyState');

document.addEventListener('DOMContentLoaded', () => {
  loadCabinets();
});

async function loadCabinets() {
  if (!list) return;
  list.innerHTML = '<p style="color:#6b7280;">Loading cabinets...</p>';

  try {
    const res = await fetch('../api/patient-get-cabinets.php', {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    });
    const json = await res.json();

    if (!res.ok || !json.success) {
      const msg = (json && json.errors && json.errors[0]) || 'Failed to load cabinets.';
      list.innerHTML = `<p style="color:#ef4444;">${escapeHtml(msg)}</p>`;
      return;
    }

    data = json.data || [];
    filteredData = [...data];

    render(filteredData);
  } catch (err) {
    list.innerHTML = `<p style="color:#ef4444;">${escapeHtml(err.message)}</p>`;
  }
}

function render(items) {
  list.innerHTML = '';

  if (!items || items.length === 0) {
    if (emptyState) emptyState.style.display = 'block';
    return;
  }
  if (emptyState) emptyState.style.display = 'none';

  items.forEach(c => {
    const card = document.createElement('a');
    card.className = 'cabinet-card';
    card.href = 'cabinet_profile.php?id=' + encodeURIComponent(c.id);

    const locationText = c.location || '';
    const phoneText = c.phone || '';
    const specialityText = c.speciality || '';

    card.innerHTML = `
      <div class="cabinet-image">
        ⚕
      </div>
      <div class="cabinet-content">
        <div class="cabinet-header-row">
          <h3>${escapeHtml(c.name)}</h3>
          <div class="cabinet-rating">
            <!-- no rating yet -->
          </div>
        </div>

        <div class="cabinet-location">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
            <circle cx="12" cy="10" r="3"></circle>
          </svg>
          ${escapeHtml(locationText)}
        </div>

        <div class="cabinet-info-row">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
          </svg>
          ${escapeHtml(phoneText)}
        </div>

        <div class="cabinet-info-row">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
          </svg>
          ${escapeHtml(specialityText)}
        </div>

        <div class="cabinet-footer">
          <div class="doctors-count">
            <!-- you can later compute doctors count -->
          </div>
          <button class="view-profile-btn"
            onclick="event.preventDefault(); window.location.href='cabinet_profile.php?id=${encodeURIComponent(c.id)}'">
            View Profile
          </button>
        </div>
      </div>
    `;

    list.appendChild(card);
  });
}

function filterCabinets() {
  if (!data || data.length === 0) return;

  const searchTerm = document.getElementById('searchInput').value.toLowerCase();
  const cityFilter = document.getElementById('cityFilter').value;
  const ratingFilter = parseInt(document.getElementById('ratingFilter').value) || 0;

  filteredData = data.filter(cabinet => {
    const name = (cabinet.name || '').toLowerCase();
    const location = (cabinet.location || '').toLowerCase();

    const matchesSearch =
      name.includes(searchTerm) ||
      location.includes(searchTerm);

    const matchesCity =
      !cityFilter ||
      location.includes(cityFilter.toLowerCase());

    const matchesRating = !ratingFilter; 

    return matchesSearch && matchesCity && matchesRating;
  });

  render(filteredData);
}

function escapeHtml(str) {
  if (!str) return '';
  return String(str)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');
}
