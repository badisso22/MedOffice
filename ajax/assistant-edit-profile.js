document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('assistantProfileForm');

  const firstNameInput = document.getElementById('firstName');
  const lastNameInput = document.getElementById('lastName');
  const phoneInput = document.getElementById('phoneNumber');
  const addressInput = document.getElementById('address');
  const yearsInput = document.getElementById('yearsExperience');
  const employeeCodeInput = document.getElementById('employeeCode');
  const statusSelect = document.getElementById('status');
  const skillsInput = document.getElementById('skillsInput');

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

      if (firstNameInput && user?.firstName) firstNameInput.value = user.firstName;
      if (lastNameInput && user?.lastName) lastNameInput.value = user.lastName;
      if (phoneInput && user?.phoneNumber) phoneInput.value = user.phoneNumber;
      if (addressInput && user?.address) addressInput.value = user.address;

      if (yearsInput && assistant?.yearsExperience != null) {
        yearsInput.value = assistant.yearsExperience;
      }
      if (employeeCodeInput && assistant?.employeeCode) {
        employeeCodeInput.value = assistant.employeeCode;
      }
      if (statusSelect && assistant?.status) {
        statusSelect.value = assistant.status;
      }

      if (skillsInput && skills && skills.length) {
        skillsInput.value = skills.join(', ');
      }

      if (availability && availability.length) {
        availability.forEach(slot => {
          const row = document.querySelector(
            `.availability-row[data-day="${slot.dayOfWeek}"]`
          );
          if (!row) return;
          const chk = row.querySelector('.day-available');
          const start = row.querySelector('.day-start');
          const end = row.querySelector('.day-end');

          if (chk) chk.checked = !!slot.isAvailable;
          if (start && slot.startTime) start.value = slot.startTime.substring(0,5);
          if (end && slot.endTime) end.value = slot.endTime.substring(0,5);
        });
      }
    } catch (err) {
      console.error('Load assistant profile error:', err);
    }
  }

  function collectAvailability() {
    const rows = document.querySelectorAll('.availability-row[data-day]');
    const arr = [];
    rows.forEach(row => {
      const day = row.getAttribute('data-day');
      const chk = row.querySelector('.day-available');
      const start = row.querySelector('.day-start');
      const end = row.querySelector('.day-end');
      arr.push({
        dayOfWeek: day,
        isAvailable: chk && chk.checked ? 1 : 0,
        startTime: start && start.value ? `${start.value}:00` : null,
        endTime: end && end.value ? `${end.value}:00` : null
      });
    });
    return arr;
  }

  form?.addEventListener('submit', async (e) => {
    e.preventDefault();

    const skills = skillsInput?.value
      ? skillsInput.value.split(',').map(s => s.trim()).filter(Boolean)
      : [];

    const payload = {
      firstName: firstNameInput?.value || '',
      lastName: lastNameInput?.value || '',
      phoneNumber: phoneInput?.value || '',
      address: addressInput?.value || '',
      yearsExperience: yearsInput?.value || 0,
      employeeCode: employeeCodeInput?.value || '',
      status: statusSelect?.value || 'available',
      skills,
      availability: collectAvailability()
    };

    try {
      const res = await fetch('../api/update-assistant-profile.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify(payload)
      });
      const json = await res.json();
      if (!res.ok || !json.success) {
        console.error(json.errors || 'Failed to update assistant profile');
        alert('Error saving profile.');
        return;
      }
      alert('Profile updated successfully.');
      window.location.href = 'profileA.php';
    } catch (err) {
      console.error('Save assistant profile error:', err);
      alert('Error saving profile.');
    }
  });

  loadProfile();
});
