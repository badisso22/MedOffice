console.log('patient_edit_profile.js loaded');

function escapeHtml(str) {
  if (!str) return '';
  return String(str)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');
}

async function loadProfileForEdit() {
  try {
    const res = await fetch('../api/patient-get-profile.php', {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    });
    const json = await res.json();

    if (!json.success || !json.data) {
      console.error('Failed to load profile for edit', json);
      return;
    }

    const p = json.data;
    const fullName = p.fullName || 'Patient';

    const avatarUrl =
      'https://ui-avatars.com/api/?name=' +
      encodeURIComponent(fullName) +
      '&background=0891b2&color=fff&size=140';

    document.getElementById('editProfileAvatar').src = avatarUrl;
    document.getElementById('editProfileAvatar').alt = fullName;

    document.getElementById('fullname').value = fullName;
    document.getElementById('email').value = p.email || '';
    document.getElementById('phone').value = p.phone || '';
    document.getElementById('address').value = p.address || '';
    document.getElementById('username').value = p.username || '';
  } catch (err) {
    console.error('Error loading profile for edit', err);
  }
}

async function submitEditProfile(e) {
  e.preventDefault();

  const payload = {
    fullname: document.getElementById('fullname').value.trim(),
    email: document.getElementById('email').value.trim(),
    phone: document.getElementById('phone').value.trim(),
    address: document.getElementById('address').value.trim(),
    username: document.getElementById('username').value.trim()
  };

  try {
    const res = await fetch('../api/patient-update-profile.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: JSON.stringify(payload)
    });

    const json = await res.json();
    console.log('Update response', json);

    if (json.success) {
      // redirect back or show small success then redirect
      window.location.href = 'profileP.php';
    } else {
      alert(json.errors && json.errors[0] ? json.errors[0] : 'Update failed');
    }
  } catch (err) {
    console.error('Error updating profile', err);
    alert('Network error while updating profile');
  }
}

document.addEventListener('DOMContentLoaded', () => {
  loadProfileForEdit();

  const form = document.getElementById('editProfileForm');
  if (form) {
    form.addEventListener('submit', submitEditProfile);
  }
});
