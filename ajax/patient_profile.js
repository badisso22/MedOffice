console.log('patient_profile.js loaded');

function escapeHtml(str) {
  if (!str) return '';
  return String(str)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');
}

function formatDateShort(dateStr) {
  if (!dateStr) return '-';
  const d = new Date(dateStr);
  if (Number.isNaN(d.getTime())) return dateStr;
  return d.toLocaleDateString('en-US', {
    month: 'short',
    day: 'numeric',
    year: 'numeric'
  });
}

async function loadPatientProfile() {
  try {
    const res = await fetch('../api/patient-get-profile.php', {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    });
    const json = await res.json();

    if (!json.success || !json.data) {
      console.error('Profile load failed', json);
      return;
    }

    const p = json.data;
    const fullName = p.fullName || 'Patient';
    const avatarUrl =
      'https://ui-avatars.com/api/?name=' +
      encodeURIComponent(fullName) +
      '&background=0891b2&color=fff&size=140';

    document.getElementById('profileAvatar').src = avatarUrl;
    document.getElementById('profileAvatar').alt = fullName;

    document.getElementById('pfPatientId').textContent = p.userID ?? '-';
    document.getElementById('pfFullName').textContent = escapeHtml(p.fullName || '-');
    document.getElementById('pfEmail').textContent = escapeHtml(p.email || '-');
    document.getElementById('pfPhone').textContent = escapeHtml(p.phone || '-');
    document.getElementById('pfAddress').textContent = escapeHtml(p.address || '-');
    document.getElementById('pfUsername').textContent = escapeHtml(p.username || '-');
    document.getElementById('pfRegDate').textContent = formatDateShort(p.createdAt);

  } catch (err) {
    console.error('Error loading profile', err);
  }
}

document.addEventListener('DOMContentLoaded', loadPatientProfile);
