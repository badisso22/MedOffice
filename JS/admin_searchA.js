console.log('admin_searchA archive helpers loaded');

let assistantToArchive = null;
let assistantName = '';
let assistantAge = '';

function openArchiveModalWithData(assistantID, name, age) {
  assistantToArchive = assistantID;
  assistantName = name;
  assistantAge = age;

  const modal  = document.getElementById('archiveModal');
  const idEl   = document.getElementById('archive-assistant-id');
  const nameEl = document.getElementById('archive-assistant-name');
  const ageEl  = document.getElementById('archive-assistant-age');

  if (idEl)   idEl.textContent = String(assistantID).padStart(3, '0');
  if (nameEl) nameEl.textContent = name;
  if (ageEl)  ageEl.textContent  = age || 'N/A';

  if (modal) modal.classList.add('active');
}

function closeArchiveModal() {
  const modal = document.getElementById('archiveModal');
  if (modal) modal.classList.remove('active');
  assistantToArchive = null;
  assistantName = '';
  assistantAge = '';
}

function openSuccessModal() {
  const modal  = document.getElementById('successModal');
  const idEl   = document.getElementById('success-assistant-id');
  const nameEl = document.getElementById('success-assistant-name');
  const ageEl  = document.getElementById('success-assistant-age');
  const statusEl = document.getElementById('success-assistant-status');

  if (idEl)   idEl.textContent = String(assistantToArchive).padStart(3, '0');
  if (nameEl) nameEl.textContent = assistantName;
  if (ageEl)  ageEl.textContent  = assistantAge || 'N/A';
  if (statusEl) statusEl.textContent = 'Archived';

  if (modal) modal.classList.add('active');
}

function closeSuccessModal() {
  const modal = document.getElementById('successModal');
  if (modal) modal.classList.remove('active');
}

async function confirmArchive() {
  if (!assistantToArchive) {
    closeArchiveModal();
    return;
  }

  try {
    const formData = new FormData();
    formData.append('assistantID', assistantToArchive);

    const res = await fetch('../api/admin-archive-assistant.php', {
      method: 'POST',
      body: formData
    });

    const raw = await res.text();
    console.log('RAW ASSISTANT ARCHIVE RESPONSE:', raw);

    let json;
    try {
      json = JSON.parse(raw);
    } catch (e) {
      console.error('JSON parse error in assistant archive', e);
      alert('Server did not return valid JSON. Check console for RAW RESPONSE.');
      return;
    }

    if (!res.ok || !json.success) {
      console.error('Archive error', json);
      alert(json.message || 'Could not archive assistant');
      if (json.errors && json.errors.length) {
        alert(json.errors.join('\n'));
      }
      return;
    }

    closeArchiveModal();
    openSuccessModal();
  } catch (err) {
    console.error('Network/server error archiving assistant', err);
    alert('Network error while archiving assistant.');
  }
}

document.addEventListener('click', (event) => {
  const archiveModal = document.getElementById('archiveModal');
  const successModal = document.getElementById('successModal');

  if (event.target === archiveModal) {
    closeArchiveModal();
  }
  if (event.target === successModal) {
    closeSuccessModal();
  }
});

document.addEventListener('keydown', (event) => {
  if (event.key === 'Escape') {
    closeArchiveModal();
    closeSuccessModal();
  }
});

document.addEventListener('DOMContentLoaded', () => {
  const confirmBtn   = document.getElementById('archive-confirm-btn');
  const cancelBtn    = document.getElementById('archive-cancel-btn');
  const successOkBtn = document.getElementById('success-ok-btn');

  if (confirmBtn) confirmBtn.addEventListener('click', confirmArchive);
  if (cancelBtn)  cancelBtn.addEventListener('click', closeArchiveModal);
  if (successOkBtn) {
    successOkBtn.addEventListener('click', () => {
      closeSuccessModal();
      window.location.href = 'searchA.php';
    });
  }
});
