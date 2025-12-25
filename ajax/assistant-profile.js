document.addEventListener('DOMContentLoaded', () => {
  async function loadProfile() {
    try {
      const res = await fetch('../api/get-assistant-profile.php', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });
      const json = await res.json();
      if (!res.ok || !json.success) {
        console.error(json.errors || 'Failed to load assistant profile');
        return;
      }

      const { assistant, user, skills, availability } = json.data;

      const nameEl = document.getElementById('assistantName');
      const emailEl = document.getElementById('assistantEmail');
      const phoneEl = document.getElementById('assistantPhone');
      const addressEl = document.getElementById('assistantAddress');
      const statusEl = document.getElementById('assistantStatus');
      const experienceEl = document.getElementById('assistantExperience');
      const employeeCodeEl = document.getElementById('assistantEmployeeCode');
      const skillsEl = document.getElementById('assistantSkills');
      const availabilityEl = document.getElementById('assistantAvailability');

      if (nameEl) {
        const fn = user?.firstName || '';
        const ln = user?.lastName || '';
        nameEl.textContent = (fn || ln) ? `${fn} ${ln}`.trim() : (user?.username || 'Assistant');
      }
      if (emailEl && user?.email) emailEl.textContent = user.email;
      if (phoneEl && user?.phoneNumber) phoneEl.textContent = user.phoneNumber;
      if (addressEl && user?.address) addressEl.textContent = user.address;
      if (statusEl && assistant?.status) statusEl.textContent = assistant.status;
      if (experienceEl && assistant?.yearsExperience != null) {
        experienceEl.textContent = `${assistant.yearsExperience} years`;
      }
      if (employeeCodeEl && assistant?.employeeCode) {
        employeeCodeEl.textContent = assistant.employeeCode;
      }

      if (skillsEl) {
        skillsEl.innerHTML = '';
        if (skills && skills.length) {
          skills.forEach(s => {
            const li = document.createElement('li');
            li.textContent = s;
            skillsEl.appendChild(li);
          });
        } else {
          skillsEl.innerHTML = '<li>No skills recorded</li>';
        }
      }

      if (availabilityEl) {
        availabilityEl.innerHTML = '';
        if (availability && availability.length) {
          availability.forEach(slot => {
            const row = document.createElement('div');
            row.className = 'availability-row';
            const status = slot.isAvailable ? 'Available' : 'Off';
            const timeRange = slot.isAvailable && slot.startTime && slot.endTime
              ? `${slot.startTime.substring(0,5)} – ${slot.endTime.substring(0,5)}`
              : '—';
            row.innerHTML = `
              <span class="availability-day">${slot.dayOfWeek}</span>
              <span class="availability-time">${timeRange}</span>
              <span class="availability-status">${status}</span>
            `;
            availabilityEl.appendChild(row);
          });
        } else {
          availabilityEl.innerHTML = '<p>No availability configured.</p>';
        }
      }
    } catch (err) {
      console.error('Assistant profile error:', err);
    }
  }

  loadProfile();
});
