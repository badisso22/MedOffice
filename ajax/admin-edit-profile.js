document.addEventListener('DOMContentLoaded', () => {
  loadEditProfile();

  const form = document.getElementById('doctorEditForm');
  form.addEventListener('submit', handleProfileSubmit);
});

async function loadEditProfile() {
  try {
    const res = await fetch('../api/admin-get-profile.php', {
      method: 'GET',
      headers: { 'Accept': 'application/json' }
    });
    const data = await res.json();
    if (!data.success) {
      console.error('Load profile error:', data.message || data.error);
      return;
    }

    const { profile, education, languages, availability } = data.data;

    const fullName = `Dr. ${profile.firstName} ${profile.lastName}`;
    const avatarUrl =
      `https://ui-avatars.com/api/?name=${encodeURIComponent(fullName)}&background=06b6d4&color=fff&size=200`;
    const avatar = document.getElementById('photoPreview');
    avatar.src = avatarUrl;
    avatar.alt = fullName;

    document.getElementById('firstName').value = profile.firstName || '';
    document.getElementById('lastName').value = profile.lastName || '';
    document.getElementById('email').value = profile.email || '';
    document.getElementById('phone').value =
    profile.cabinetphonenumber || profile.phoneNumber || '';
    document.getElementById('address').value =
    profile.address || profile.cabinetlocation || '';

    document.getElementById('specialty').value = profile.speciality || '';
    document.getElementById('licenseNumber').value = profile.licenseNumber || '';
    document.getElementById('experience').value =
    profile.yearsOfExperience || '';
    document.getElementById('consultationFee').value = '';

    document.getElementById('about').value = profile.bio || '';

    const eduContainer = document.getElementById('educationContainer');
    eduContainer.innerHTML = '';
    if (education.length === 0) {
      eduContainer.appendChild(createEducationItem());
    } else {
      education.forEach(e => {
        eduContainer.appendChild(createEducationItem(e.degree, e.institution, e.year));
      });
    }

    const langs = languages.map(l => l.language).join(', ');
    document.getElementById('languages').value = langs;

    populateAvailability(availability);
  } catch (err) {
    console.error('Load edit profile failed', err);
  }
}

function createEducationItem(degree = '', institution = '', year = '') {
  const wrapper = document.createElement('div');
  wrapper.className = 'education-item';
  wrapper.innerHTML = `
    <div class="form-grid">
      <div class="form-group">
        <label class="form-label">Degree <span class="required">*</span></label>
        <input type="text" name="education_degree[]" class="form-input" value="${escapeAttr(degree)}" required />
      </div>
      <div class="form-group">
        <label class="form-label">Institution <span class="required">*</span></label>
        <input type="text" name="education_institution[]" class="form-input" value="${escapeAttr(institution)}" required />
      </div>
      <div class="form-group">
        <label class="form-label">Year</label>
        <input type="number" name="education_year[]" class="form-input" value="${escapeAttr(year)}" min="1950" max="2100" />
      </div>
      <div class="form-group">
        <button type="button" class="btn-remove" onclick="removeEducation(this)">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
          </svg>
        </button>
      </div>
    </div>
  `;
  return wrapper;
}

function addEducation() {
  const container = document.getElementById('educationContainer');
  container.appendChild(createEducationItem());
}

function removeEducation(btn) {
  const item = btn.closest('.education-item');
  if (item) {
    item.remove();
  }
}

function populateAvailability(avList) {
  const grid = document.getElementById('availabilityGrid');
  grid.innerHTML = '';

  const days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
  const byDay = {};
  avList.forEach(a => { byDay[a.dayOfWeek] = a; });

  days.forEach(day => {
    const slot = byDay[day] || null;
    const checked = slot && parseInt(slot.isAvailable) ? 'checked' : '';
    const startVal = slot && slot.startTime ? slot.startTime.substring(0,5) : '';
    const endVal   = slot && slot.endTime   ? slot.endTime.substring(0,5)   : '';

    const div = document.createElement('div');
    div.className = 'availability-item';
    div.innerHTML = `
      <label class="availability-label">
        <input type="checkbox" name="days[]" value="${day}" ${checked} />
        <span>${day}</span>
      </label>
      <div class="time-inputs">
        <input type="time" name="${day.toLowerCase()}_start" class="time-input" value="${startVal}" />
        <span>to</span>
        <input type="time" name="${day.toLowerCase()}_end" class="time-input" value="${endVal}" />
      </div>
    `;
    grid.appendChild(div);
  });
}

function escapeAttr(str) {
  if (!str) return '';
  return String(str)
    .replace(/&/g,'&amp;')
    .replace(/"/g,'&quot;')
    .replace(/</g,'&lt;')
    .replace(/>/g,'&gt;');
}

async function handleProfileSubmit(e) {
  e.preventDefault();

  const form = document.getElementById('doctorEditForm');
  const formData = new FormData(form);

  try {
    const res = await fetch('../api/admin-update-profile.php', {
      method: 'POST',
      body: formData
    });
    const data = await res.json();
    if (!data.success) {
      alert(data.message || 'Failed to update profile');
      console.error(data);
      return;
    }
    alert('Profile updated successfully');
    window.location.href = 'profileAD.php';
  } catch (err) {
    console.error('Update failed', err);
    alert('An error occurred while saving');
  }
}

window.addEducation = addEducation;
window.removeEducation = removeEducation;
