console.log('admin_archive_assistant.js loaded');

let assistantToUnarchive = null;
let assistantName = '';
let assistantAge = '';

function openUnarchiveModalWithData(assistantID, name, age) {
  assistantToUnarchive = assistantID;
  assistantName = name;
  assistantAge = age;

  const modal = document.getElementById('unarchiveModal');
  const idEl = document.getElementById('unarchive-assistant-id');
  const nameEl = document.getElementById('unarchive-assistant-name');
  const ageEl = document.getElementById('unarchive-assistant-age');

  if (idEl) idEl.textContent = String(assistantID).padStart(3, '0');
  if (nameEl) nameEl.textContent = name;
  if (ageEl) ageEl.textContent = age || 'N/A';

  if (modal) modal.classList.add('active');
}
function closeUnarchiveModal() {
  const modal = document.getElementById('unarchiveModal');
  if (modal) modal.classList.remove('active');
  assistantToUnarchive = null;
  assistantName = '';
  assistantAge = '';
}

function openUnarchiveSuccessModal() {
  const modal = document.getElementById('unarchiveSuccessModal');
  const idEl = document.getElementById('unarchive-success-id');
  const nameEl = document.getElementById('unarchive-success-name');
  const ageEl = document.getElementById('unarchive-success-age');
  const statusEl = document.getElementById('unarchive-success-status');

  if (idEl) idEl.textContent = String(assistantToUnarchive).padStart(3, '0');
  if (nameEl) nameEl.textContent = assistantName;
  if (ageEl) ageEl.textContent = assistantAge || 'N/A';
  if (statusEl) statusEl.textContent = 'Active';

  if (modal) modal.classList.add('active');
}

function closeUnarchiveSuccessModal() {
  const modal = document.getElementById('unarchiveSuccessModal');
  if (modal) modal.classList.remove('active');
}

async function confirmUnarchive() {
  if (!assistantToUnarchive) {
    closeUnarchiveModal();
    return;
  }

  try {
    const formData = new FormData();
    formData.append('assistantID', assistantToUnarchive);

    const res = await fetch('../api/admin-unarchive-assistant.php', {
      method: 'POST',
      body: formData
    });

    const raw = await res.text();
    console.log('RAW UNARCHIVE RESPONSE:', raw);

    let json;
    try {
      json = JSON.parse(raw);
    } catch (e) {
      console.error('JSON parse error in unarchive', e);
      alert('Server did not return valid JSON. Check console for RAW RESPONSE.');
      return;
    }

    if (!res.ok || !json.success) {
      console.error('Unarchive error', json);
      alert(json.message || 'Could not unarchive assistant');
      if (json.errors && json.errors.length) {
        alert(json.errors.join('\n'));
      }
      return;
    }

    closeUnarchiveModal();
    openUnarchiveSuccessModal();
  } catch (err) {
    console.error('Network/server error unarchiving assistant', err);
    alert('Network error while unarchiving assistant.');
  }
}

document.addEventListener('click', (event) => {
  const unarchiveModal = document.getElementById('unarchiveModal');
  const successModal = document.getElementById('unarchiveSuccessModal');

  if (event.target === unarchiveModal) {
    closeUnarchiveModal();
  }
  if (event.target === successModal) {
    closeUnarchiveSuccessModal();
  }
});

document.addEventListener('keydown', (event) => {
  if (event.key === 'Escape') {
    closeUnarchiveModal();
    closeUnarchiveSuccessModal();
  }
});

document.addEventListener('DOMContentLoaded', () => {
  const confirmBtn = document.getElementById('unarchive-confirm-btn');
  const cancelBtn = document.getElementById('unarchive-cancel-btn');
  const successOkBtn = document.getElementById('unarchive-success-ok-btn');

  if (confirmBtn) confirmBtn.addEventListener('click', confirmUnarchive);
  if (cancelBtn)  cancelBtn.addEventListener('click', closeUnarchiveModal);
  if (successOkBtn) {
    successOkBtn.addEventListener('click', () => {
      closeUnarchiveSuccessModal();
      window.location.href = 'archive_assistant.php';
    });
  }
});
