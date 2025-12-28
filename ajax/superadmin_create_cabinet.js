console.log('=== WIZARD JS INIT ===');

let cabinetData = {};

const cabinetForm = document.getElementById('cabinetInfoForm');
const adminForm = document.getElementById('adminAccountForm');

console.log('Form elements found:', { cabinetForm: !!cabinetForm, adminForm: !!adminForm });

if (cabinetForm) {
  cabinetForm.addEventListener('submit', function(e) {
    console.log('🔴 CABINET FORM SUBMIT - INTERCEPTING');
    e.preventDefault();
    e.stopPropagation();
    
    if (!this.checkValidity()) {
      this.reportValidity();
      return;
    }

    cabinetData = {
      cabinetName: document.getElementById('cabinetName').value.trim(),
      cabinetLocation: document.getElementById('cabinetLocation').value.trim(),
      cabinetPhone: document.getElementById('cabinetPhone').value.trim(),
      cabinetEmail: document.getElementById('cabinetEmail').value.trim(),
      cabinetSpecialties: document.getElementById('cabinetSpecialties').value.trim(),
      cabinetCapacity: document.getElementById('cabinetCapacity').value.trim(),
      cabinetDescription: document.getElementById('cabinetDescription').value.trim()
    };

    console.log('✅ Cabinet data collected:', cabinetData);
    showStep('loading1');
    setTimeout(() => showStep('step2'), 500);
  }, true); 
}

if (adminForm) {
  adminForm.addEventListener('submit', async function(e) {
    console.log('🔴 ADMIN FORM SUBMIT - INTERCEPTING');
    e.preventDefault();
    e.stopPropagation();

    if (!this.checkValidity()) {
      this.reportValidity();
      return;
    }

    const password = document.getElementById('adminPassword').value;
    const confirmPassword = document.getElementById('adminConfirmPassword').value;

    if (password !== confirmPassword) {
      alert('Passwords do not match!');
      return;
    }

    const adminData = {
      username: document.getElementById('adminUsername').value.trim(),
      email: document.getElementById('adminEmail').value.trim(),
      firstName: document.getElementById('adminFirstName').value.trim(),
      lastName: document.getElementById('adminLastName').value.trim(),
      phone: document.getElementById('adminPhone').value.trim(),
      password
    };

    console.log('✅ Admin data collected:', adminData);
    showStep('loading2');

    try {
      const res = await fetch('../api/superadmin-cabinet-create.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ cabinet: cabinetData, admin: adminData })
      });

      const json = await res.json();
      console.log('API Response:', json);

      if (!res.ok || !json.success) {
        throw new Error(json.errors?.[0] || 'Creation failed');
      }

      document.getElementById('successCabinetName').textContent = cabinetData.cabinetName;
      showStep('success');

    } catch (err) {
      console.error('❌ Error:', err);
      alert('Error: ' + err.message);
      showStep('step2');
    }
  }, true); 
}

function showStep(stepId) {
  console.log('📍 Showing step:', stepId);
  document.querySelectorAll('.wizard-step').forEach(step => {
    step.classList.remove('active');
  });
  const el = document.getElementById(stepId);
  if (el) {
    el.classList.add('active');
  }
}

function goBackToStep1() {
  console.log('⬅️ Back to Step 1');
  showStep('step1');
}

window.goBackToStep1 = goBackToStep1;

console.log('=== WIZARD JS READY ===');
