document.addEventListener('DOMContentLoaded', () => {
  loadAdminProfile();
});

async function loadAdminProfile() {
  try {
    const res = await fetch('../api/admin-get-profile.php', {
      method: 'GET',
      headers: { 'Accept': 'application/json' }
    });

    const data = await res.json();
    if (!data.success) {
      console.error('Profile error:', data.message || data.error);
      return;
    }

    const { profile, education, experience, languages, availability } = data.data;

    const fullName = `Dr. ${profile.firstName} ${profile.lastName}`;

    const titleEl = document.querySelector('title');
    if (titleEl) {
      titleEl.textContent = `Doctor Profile - ${fullName}`;
    }

    document.getElementById('doctorName').textContent = fullName;
    document.getElementById('doctorSpeciality').textContent = profile.speciality || '';

    document.getElementById('doctorBadge').textContent =
      profile.speciality || 'Doctor';

    const avatarUrl =
      `https://ui-avatars.com/api/?name=${encodeURIComponent(fullName)}&background=0891b2&color=fff&size=200`;
    const avatarImg = document.getElementById('doctorAvatar');
    avatarImg.src = avatarUrl;
    avatarImg.alt = fullName;

    document.getElementById('doctorBio').textContent =
      profile.bio && profile.bio.trim() !== '' ? profile.bio : '';

    const expSummary = [];
    if (profile.yearsOfExperience) {
      expSummary.push(`${profile.yearsOfExperience} years of medical practice`);
    }
    if (profile.speciality) {
      expSummary.push(`specializing in ${profile.speciality}`);
    }
    document.getElementById('experienceSummary').textContent = expSummary.join(' ');

    const expList = document.getElementById('experienceList');
    expList.innerHTML = '';
    experience.forEach(item => {
      const start = item.startDate ? item.startDate.substring(0, 4) : '';
      const end = item.endDate ? item.endDate.substring(0, 4) : 'Present';

      const wrapper = document.createElement('div');
      wrapper.className = 'experience-item';
      wrapper.innerHTML = `
        <div class="experience-marker"></div>
        <div class="experience-details">
          <h3 class="experience-title">${escapeHtml(item.title)}</h3>
          <p class="experience-location">${escapeHtml(item.location || '')}</p>
          <p class="experience-period">${escapeHtml(start)} - ${escapeHtml(end)}</p>
        </div>
      `;
      expList.appendChild(wrapper);
    });

    const eduList = document.getElementById('educationList');
    eduList.innerHTML = '';
    education.forEach(item => {
      const year = item.year || '';
      const text = `${item.degree} - ${item.institution}${year ? ` (${year})` : ''}`;

      const div = document.createElement('div');
      div.className = 'education-item';
      div.innerHTML = `
        <svg class="education-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
          <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
        </svg>
        <div>
          <p class="education-degree">${escapeHtml(text)}</p>
        </div>
      `;
      eduList.appendChild(div);
    });

    const langList = document.getElementById('languagesList');
    langList.innerHTML = '';
    languages.forEach(item => {
      const span = document.createElement('span');
      span.className = 'language-tag';
      span.textContent = item.language;
      langList.appendChild(span);
    });

    document.getElementById('contactEmail').textContent = profile.email || '';
    document.getElementById('contactPhone').textContent =
      profile.cabinetphonenumber || profile.phoneNumber || '';
    document.getElementById('contactLocation').textContent =
      profile.cabinetlocation || profile.address || '';

    const availList = document.getElementById('availabilityList');
    availList.innerHTML = '';
    availability.forEach(slot => {
      const el = document.createElement('div');
      el.className = 'availability-item' + (parseInt(slot.isAvailable) ? '' : ' unavailable');

      let label = `${slot.dayOfWeek}:`;
      let value = 'Closed';
      if (parseInt(slot.isAvailable)) {
        value =
          slot.startTime.substring(0, 5) + ' - ' +
          slot.endTime.substring(0, 5);
      }

      el.innerHTML = `
        <span class="day-label">${escapeHtml(label)}</span>
        <span class="time-value">${escapeHtml(value)}</span>
      `;
      availList.appendChild(el);
    });

  } catch (err) {
    console.error('Profile fetch failed', err);
  }
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
