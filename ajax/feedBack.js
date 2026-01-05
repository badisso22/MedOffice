document.addEventListener('DOMContentLoaded', () => {
  const form  = document.getElementById('feedbackForm');
  const modal = document.getElementById('customModal');

  if (!form) return;

  document.querySelectorAll('.star-rating').forEach(group => {
    group.addEventListener('click', e => {
      if (!e.target.classList.contains('star')) return;
      const value = parseInt(e.target.dataset.value, 10);
      group.querySelectorAll('.star').forEach(star => {
        star.classList.toggle('selected', parseInt(star.dataset.value, 10) <= value);
      });
    });
  });

  function getRating(id) {
    const container = document.getElementById(id);
    if (!container) return null;
    const activeStars = container.querySelectorAll('.star.selected');
    if (!activeStars.length) return null;
    return parseInt(activeStars[activeStars.length - 1].dataset.value, 10);
  }

  const params = new URLSearchParams(window.location.search);
  const appointmentID = parseInt(params.get('appointmentID') || '0', 10) || 0;

  form.addEventListener('submit', async e => {
    e.preventDefault();

    const submitBtn = form.querySelector('button[type="submit"]');
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.textContent = 'Submitting...';
    }

    const appointmentMethodEl = document.getElementById('appointment-method');
    const appointmentMethod = appointmentMethodEl ? appointmentMethodEl.value : '';

    const data = {
      appointmentID: appointmentID,
      medicalStaff: getRating('medical-assistant'),
      doctorCompetence: getRating('doctor-competence'),
      appointmentPunctuality: getRating('appointment-punctuality'),
      cleanliness: getRating('cleanliness'),
      equipmentQuality: getRating('equipment-quality'),
      parkingAvailability: getRating('parking-availability'),
      appointmentMethod: appointmentMethod,
      feedbackTitle: document.getElementById('feedback-title')?.value.trim() || '',
      feedbackMessage: document.getElementById('feedback-message')?.value.trim() || '',
    };

    try {
      const res = await fetch('../api/save_feedback.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
      });

      const raw = await res.text();
      let json;
      try {
        json = JSON.parse(raw);
      } catch (err) {
        console.error('Feedback JSON parse error', err, raw);
        alert('Unexpected server response. Please try again later.');
        return;
      }

      if (!res.ok || !json.success) {
        console.error('Feedback error', json);
        alert(json.message || 'Could not submit feedback');
        if (json.errors && json.errors.length) {
          alert(json.errors.join('\n'));
        }
        return;
      }

      if (modal) {
        modal.classList.remove('is-hidden');
      } else {
        alert('Thank you for your feedback!');
        window.location.href = '../Patient/dashboard_p.php';
      }
    } catch (err) {
      console.error('Network/server error', err);
      alert('Network error while submitting feedback.');
    } finally {
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Submit Feedback';
      }
    }
  });
});

function closeModal() {
  const modal = document.getElementById('customModal');
  if (modal) {
    modal.classList.add('is-hidden');
  }
  window.location.href = '../Patient/dashboard_p.php';
}
