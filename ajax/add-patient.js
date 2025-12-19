document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('patient-form');
    const resultDiv = document.getElementById('patient-result');

    if (!form) return;

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

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

        resultDiv.innerHTML = '<div class="alert alert-info">Saving...</div>';

        try {
            const res = await fetch('../api/add-patient.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            const data = await res.json();

            if (!res.ok || !data.success) {
                const errs = (data.errors || []).join('<br>');
                resultDiv.innerHTML = `
                    <div class="alert alert-danger">
                        ${data.message || 'Error'}<br>${errs}
                    </div>
                `;
                return;
            }

            resultDiv.innerHTML = `
                <div class="alert alert-success">
                    ${data.message}<br>
                    New patient: ${data.data.firstName} ${data.data.lastName} (username: ${data.data.username})
                </div>
            `;
            form.reset();
        } catch (err) {
            resultDiv.innerHTML = `
                <div class="alert alert-danger">
                    Network or server error: ${err.message}
                </div>
            `;
        }
    });
});
