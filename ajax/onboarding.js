let createdCabinetId = null;

function initFacilityChips() {
    const chips = document.querySelectorAll('.facility-chip');
    const hidden = document.getElementById('facilities');
    chips.forEach(chip => {
        chip.addEventListener('click', () => {
            chip.classList.toggle('selected');
            const selected = Array.from(document.querySelectorAll('.facility-chip.selected'))
                .map(c => c.getAttribute('data-value'));
            hidden.value = selected.join(',');
        });
    });
}

function setPills(step) {
    ['1','2','3'].forEach(n => {
        document.getElementById('pill-step-' + n).classList.toggle('active', n === String(step));
    });
}
function goToStep(step) {
    ['1','2','3'].forEach(n => {
        document.getElementById('step-' + n).classList.remove('active');
    });
    document.getElementById('step-' + step).classList.add('active');
    setPills(step);

    const title = document.getElementById('step-title');
    const subtitle = document.getElementById('step-subtitle');

    if (step === 1) {
        title.textContent = 'Step 1 · Cabinet details';
        subtitle.textContent = 'Tell us about your cabinet so MedOffice can configure it for you.';
    } else if (step === 2) {
        title.textContent = 'Step 2 · Admin account';
        subtitle.textContent = 'Create the first admin who will manage this cabinet.';
    } else if (step === 3) {
        title.textContent = 'Step 3 · You are ready';
        subtitle.textContent = 'We are finishing up the integration for you.';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    initFacilityChips();

    const urlParams = new URLSearchParams(window.location.search);
    const emailFromLink = urlParams.get('email');
    if (emailFromLink) {
        const emailInput = document.getElementById('contact-email');
        emailInput.value = emailFromLink;
    }

    document.getElementById('cabinetForm').addEventListener('submit', function (e) {
        e.preventDefault();
        submitCabinet();
    });

    document.getElementById('back-to-step-1').addEventListener('click', function () {
        goToStep(1);
    });

    document.getElementById('adminForm').addEventListener('submit', function (e) {
        e.preventDefault();
        submitAdmin();
    });

    document.getElementById('go-to-login').addEventListener('click', function () {
        window.location.href = 'login-forms/login.php'; // adjust to your login URL
    });
});

function submitCabinet() {
    const resultDiv = document.getElementById('wizard_result');
    resultDiv.textContent = '';
    const btn = document.getElementById('btn-step-1');
    btn.disabled = true;

    const data = new FormData();
    data.append('cabinet_name',      document.getElementById('cabinet-name').value.trim());
    data.append('cabinet_location',  document.getElementById('cabinet-location').value.trim());
    data.append('contact_email',     document.getElementById('contact-email').value.trim());
    data.append('phone',             document.getElementById('phone').value.trim());
    data.append('work_time',         document.getElementById('worktime').value.trim());
    data.append('speciality',        document.getElementById('speciality').value.trim());
    data.append('facilities',        document.getElementById('facilities').value.trim());

    fetch('api/cabinetCreate.php', {
        method: 'POST',
        body: data
    })
        .then(r => r.json())
        .then(res => {
            btn.disabled = false;
            if (!res.success) {
                resultDiv.textContent = res.error || 'Could not create cabinet.';
                resultDiv.style.color = 'red';
                return;
            }
            createdCabinetId = res.cabinet_id;

            goToStep(2);
            document.getElementById('step-2-loading').style.display = 'block';
            document.getElementById('adminForm').style.display = 'none';

            setTimeout(() => {
                document.getElementById('step-2-loading').style.display = 'none';
                document.getElementById('adminForm').style.display = 'block';
            }, 900);
        })
        .catch(err => {
            console.error(err);
            btn.disabled = false;
            resultDiv.textContent = 'Network error while creating cabinet.';
            resultDiv.style.color = 'red';
        });
}

function submitAdmin() {
    const resultDiv = document.getElementById('wizard_result');
    resultDiv.textContent = '';
    const btn = document.getElementById('btn-step-2');
    btn.disabled = true;

    if (!createdCabinetId) {
        resultDiv.textContent = 'Cabinet is not created yet.';
        resultDiv.style.color = 'red';
        btn.disabled = false;
        return;
    }

    const pass  = document.getElementById('admin-password').value;
    const pass2 = document.getElementById('admin-password-confirm').value;
    if (pass !== pass2) {
        resultDiv.textContent = 'Passwords do not match.';
        resultDiv.style.color = 'red';
        btn.disabled = false;
        return;
    }

    const data = new FormData();
    data.append('cabinet_id',        createdCabinetId);
    data.append('admin_name',        document.getElementById('admin-name').value.trim());
    data.append('admin_username',    document.getElementById('admin-username').value.trim());
    data.append('admin_email',       document.getElementById('admin-email').value.trim());
    data.append('admin_phone',       document.getElementById('admin-phone').value.trim());
    data.append('admin_password',    pass);

    fetch('api/cabinetAdminCreate.php', {
        method: 'POST',
        body: data
    })
        .then(r => r.json())
        .then(res => {
            btn.disabled = false;
            if (!res.success) {
                resultDiv.textContent = res.error || 'Could not create admin.';
                resultDiv.style.color = 'red';
                return;
            }
            goToStep(3);
            document.getElementById('step-3-loading').style.display = 'block';
            document.getElementById('step-3-success').style.display = 'none';

            setTimeout(() => {
                document.getElementById('step-3-loading').style.display = 'none';
                document.getElementById('step-3-success').style.display = 'block';
            }, 900);
        })
        .catch(err => {
            console.error(err);
            btn.disabled = false;
            resultDiv.textContent = 'Network error while creating admin.';
            resultDiv.style.color = 'red';
        });
}