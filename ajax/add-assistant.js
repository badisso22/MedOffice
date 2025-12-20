function toggleDrawer() {
    const drawer = document.getElementById('drawer');
    const overlay = document.getElementById('drawerOverlay');
    drawer.classList.toggle('open');
    overlay.classList.toggle('active');
}

function togglePassword() {
    const passwordInput = document.getElementById('pass');
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
}

function closeSuccessModal() {
    const modal = document.getElementById('successModal');
    modal.classList.remove('show');
    setTimeout(() => window.location.href = '../AdminDoctor/dashboard_ad.php', 5000);
}

function showSuccessModal(title, message) {
    const modal = document.getElementById('successModal');
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalMessage').textContent = message;
    modal.classList.add('show');
    console.log('SUCCESS MODAL DISPLAYED');
}

document.getElementById('assistantForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const submitBtn = document.getElementById('submitBtn');
    const originalBtnHTML = submitBtn.innerHTML;
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner"></span> Processing...';
    
    const formData = {
        firstName: document.getElementById('firstName').value,
        lastName: document.getElementById('lastName').value,
        dob: document.getElementById('dob').value,
        gender: document.getElementById('gender').value,
        addr: document.getElementById('addr').value,
        phone: document.getElementById('phone').value,
        username: document.getElementById('username').value,
        email: document.getElementById('email').value,
        pass: document.getElementById('pass').value
    };
    
    try {
        const response = await fetch('../api/process-add-assistant.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(formData)
        });
        
        const data = await response.json();
        
        if (data.success) {
            showSuccessModal('Assistant Successfully Added', `${data.data.firstName} ${data.data.lastName} has been registered as a medical assistant.`);
            document.getElementById('assistantForm').reset();
        } else {
            let errorMsg = data.message;
            if (data.errors && data.errors.length > 0) {
                errorMsg = data.errors.join('\n');
            }
            alert('Error: ' + errorMsg);
        }
    } catch (error) {
        console.error('Network error:', error);
        alert('Network Error: ' + error.message);
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnHTML;
    }
});
