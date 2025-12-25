console.log('add-patient.js loaded');

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('patient-form');
    const resultDiv = document.getElementById('patient-result');

    const modal = document.getElementById('patient-success-modal');
    const modalText = document.getElementById('patient-success-text');
    const modalSubtitle = document.getElementById('patient-success-subtitle');
    const modalOk = document.getElementById('patient-modal-ok');

    if (!form) {
        console.warn('patient-form not found');
        return;
    }

    if (modalOk && modal) {
        modalOk.addEventListener('click', () => {
            modal.style.display = 'none';
            window.location.reload(); 
        });
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
                window.location.reload(); 
            }
        });
    }

    form.addEventListener('submit', async function (e) {
        e.preventDefault(); 
        console.log('submit intercepted');

        const formData = new FormData(form);

        const payload = {
            firstName: formData.get('firstName'),
            lastName: formData.get('lastName'),
            dob: formData.get('dob'),
            gender: formData.get('gender'),
            addr: formData.get('addr'),
            phone: formData.get('phone'),
            username: formData.get('username'),
            email: formData.get('email'),
            pass: formData.get('pass')
        };

        if (resultDiv) resultDiv.innerHTML = '';

        try {
            const response = await fetch('../api/process-add-patient.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            const data = await response.json();
            console.log('API status', response.status, data);

            if (!response.ok || !data.success) {
                let html = '<div class="alert alert-danger"><strong>';
                html += (data.message || 'Error') + '</strong>';
                if (Array.isArray(data.errors) && data.errors.length) {
                    html += '<ul>';
                    for (const err of data.errors) {
                        html += `<li>${err}</li>`;
                    }
                    html += '</ul>';
                }
                html += '</div>';
                if (resultDiv) resultDiv.innerHTML = html;
                return;
            }

            if (modal && modalText && modalSubtitle) {
                modalText.textContent = data.message || 'Patient Successfully Added';
                modalSubtitle.textContent = 'The patient has been created.';
                modal.style.display = 'flex';
            } else if (resultDiv) {
                resultDiv.innerHTML = `<div class="alert alert-success">${data.message || 'Patient added successfully.'}</div>`;
            }

            form.reset();
        } catch (err) {
            console.error('fetch error', err);
            if (resultDiv) {
                resultDiv.innerHTML = `<div class="alert alert-danger">Request failed: ${err.message}</div>`;
            }
        }
    });
});
