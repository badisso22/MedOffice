console.log('admin_searchP.js loaded');

let patientToArchive = null;
let patientName = '';
let patientAge = '';

function openArchiveModalWithData(patientID, name, age) {
  patientToArchive = patientID;
  patientName = name;
  patientAge = age;

  const modal = document.getElementById('archiveModal');
  const idEl = document.getElementById('archive-patient-id');
  const nameEl = document.getElementById('archive-patient-name');
  const ageEl = document.getElementById('archive-patient-age');

  if (idEl) idEl.textContent = String(patientID).padStart(3, '0');
  if (nameEl) nameEl.textContent = name;
  if (ageEl) ageEl.textContent = age || 'N/A';

  if (modal) modal.classList.add('active');
}

function closeArchiveModal() {
  const modal = document.getElementById('archiveModal');
  if (modal) modal.classList.remove('active');
  patientToArchive = null;
  patientName = '';
  patientAge = '';
}

function openSuccessModal() {
  const modal = document.getElementById('successModal');
  const idEl = document.getElementById('success-patient-id');
  const nameEl = document.getElementById('success-patient-name');
  const ageEl = document.getElementById('success-patient-age');
  const statusEl = document.getElementById('success-patient-status');

  if (idEl) idEl.textContent = String(patientToArchive).padStart(3, '0');
  if (nameEl) nameEl.textContent = patientName;
  if (ageEl) ageEl.textContent = patientAge || 'N/A';
  if (statusEl) statusEl.textContent = 'Archived';

  if (modal) modal.classList.add('active');
}

function closeSuccessModal() {
  const modal = document.getElementById('successModal');
  if (modal) modal.classList.remove('active');
}

async function confirmArchive() {
  if (!patientToArchive) {
    closeArchiveModal();
    return;
  }

  try {
    const formData = new FormData();
    formData.append('patientID', patientToArchive);

    const res = await fetch('../api/admin-archive-patient.php', {
      method: 'POST',
      body: formData
    });

    const raw = await res.text();
    console.log('RAW ARCHIVE RESPONSE:', raw);

    let json;
    try {
      json = JSON.parse(raw);
    } catch (e) {
      console.error('JSON parse error in archive', e);
      alert('Server did not return valid JSON. Check console for RAW RESPONSE.');
      return;
    }

    if (!res.ok || !json.success) {
      console.error('Archive error', json);
      alert(json.message || 'Could not archive patient');
      if (json.errors && json.errors.length) {
        alert(json.errors.join('\n'));
      }
      return;
    }

    closeArchiveModal();
    openSuccessModal();
  } catch (err) {
    console.error('Network/server error archiving patient', err);
    alert('Network error while archiving patient.');
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
  const confirmBtn = document.getElementById('archive-confirm-btn');
  const cancelBtn = document.getElementById('archive-cancel-btn');
  const successOkBtn = document.getElementById('success-ok-btn');

  if (confirmBtn) confirmBtn.addEventListener('click', confirmArchive);
  if (cancelBtn) cancelBtn.addEventListener('click', closeArchiveModal);
  if (successOkBtn) {
    successOkBtn.addEventListener('click', () => {
      closeSuccessModal();
      window.location.href = 'searchP.php';
    });
  }
});
