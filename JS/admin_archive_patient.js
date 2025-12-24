console.log('admin_archive_patient.js loaded');

let patientToUnarchive = null;
let patientName = '';
let patientAge = '';

function isDoctorPage() {
  return (document.body.dataset.role || '').toLowerCase() === 'doctor';
}

function openUnarchiveModalWithData(patientID, name, age) {
  if (isDoctorPage()) return; 

  patientToUnarchive = patientID;
  patientName = name;
  patientAge = age;

  const modal  = document.getElementById('unarchiveModal');
  const idEl   = document.getElementById('unarchive-patient-id');
  const nameEl = document.getElementById('unarchive-patient-name');
  const ageEl  = document.getElementById('unarchive-patient-age');

  if (idEl)   idEl.textContent   = String(patientID).padStart(3, '0');
  if (nameEl) nameEl.textContent = name;
  if (ageEl)  ageEl.textContent  = age || 'N/A';

  if (modal) modal.classList.add('active');
}

function closeUnarchiveModal() {
  const modal = document.getElementById('unarchiveModal');
  if (modal) modal.classList.remove('active');
  patientToUnarchive = null;
  patientName = '';
  patientAge = '';
}

function openUnarchiveSuccessModal() {
  if (isDoctorPage()) return; 

  const modal    = document.getElementById('unarchiveSuccessModal');
  const idEl     = document.getElementById('unarchive-success-id');
  const nameEl   = document.getElementById('unarchive-success-name');
  const ageEl    = document.getElementById('unarchive-success-age');
  const statusEl = document.getElementById('unarchive-success-status');

  if (idEl)     idEl.textContent     = String(patientToUnarchive).padStart(3, '0');
  if (nameEl)   nameEl.textContent   = patientName;
  if (ageEl)    ageEl.textContent    = patientAge || 'N/A';
  if (statusEl) statusEl.textContent = 'Active';

  if (modal) modal.classList.add('active');
}

function closeUnarchiveSuccessModal() {
  const modal = document.getElementById('unarchiveSuccessModal');
  if (modal) modal.classList.remove('active');
}

async function confirmUnarchive() {
  if (isDoctorPage()) return; 

  if (!patientToUnarchive) {
    closeUnarchiveModal();
    return;
  }

  try {
    const formData = new FormData();
    formData.append('patientID', patientToUnarchive);

    const res = await fetch('../api/admin-unarchive-patient.php', {
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
      alert(json.message || 'Could not unarchive patient');
      if (json.errors && json.errors.length) {
        alert(json.errors.join('\n'));
      }
      return;
    }

    closeUnarchiveModal();
    openUnarchiveSuccessModal();
  } catch (err) {
    console.error('Network/server error unarchiving patient', err);
    alert('Network error while unarchiving patient.');
  }
}

document.addEventListener('click', (event) => {
  if (isDoctorPage()) return;

  const unarchiveModal = document.getElementById('unarchiveModal');
  const successModal   = document.getElementById('unarchiveSuccessModal');

  if (event.target === unarchiveModal) {
    closeUnarchiveModal();
  }
  if (event.target === successModal) {
    closeUnarchiveSuccessModal();
  }
});

document.addEventListener('keydown', (event) => {
  if (isDoctorPage()) return; 

  if (event.key === 'Escape') {
    closeUnarchiveModal();
    closeUnarchiveSuccessModal();
  }
});

document.addEventListener('DOMContentLoaded', () => {
  if (isDoctorPage()) {
    return;
  }

  const confirmBtn   = document.getElementById('unarchive-confirm-btn');
  const cancelBtn    = document.getElementById('unarchive-cancel-btn');
  const successOkBtn = document.getElementById('unarchive-success-ok-btn');

  if (confirmBtn)   confirmBtn.addEventListener('click', confirmUnarchive);
  if (cancelBtn)    cancelBtn.addEventListener('click', closeUnarchiveModal);
  if (successOkBtn) {
    successOkBtn.addEventListener('click', () => {
      closeUnarchiveSuccessModal();
      window.location.href = 'archive_patient.php';
    });
  }
});
