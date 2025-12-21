document.addEventListener('DOMContentLoaded', async function () {
    const form = document.getElementById('patient-edit-form');
    if (!form) return;

    const patientID = parseInt(form.patientID.value, 10);
    if (!patientID || isNaN(patientID)) {
        alert('Missing or invalid patient ID.');
        return;
    }
    try {
        const res = await fetch(`../api/edit_patient.php?patientID=${encodeURIComponent(patientID)}`, {
            method: 'GET',
            headers: { 'Accept': 'application/json' }
        });
        const json = await res.json();

        if (!res.ok || !json.success) {
            console.error('Load error', json);
            alert(json.message || 'Could not load patient data');
            return;
        }

        const p = json.data;
        form.firstName.value = p.firstname || '';
        form.lastName.value  = p.lastname || '';
        form.dob.value       = p.dateofbirth || '';
        form.gender.value    = p.gender || '';
        form.addr.value      = p.address || '';
        form.phone.value     = p.phonenumber || '';
    } catch (err) {
        console.error('Network/server error loading patient', err);
        alert('Network error while loading patient.');
    }

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Saving...';
        }

        const formData = new FormData(form);

        try {
            const res = await fetch('../api/edit_patient.php', {
                method: 'POST',
                body: formData
            });

            const raw = await res.text();
            console.log('RAW RESPONSE:', raw);

            let json;
            try {
                json = JSON.parse(raw);
            } catch (e) {
                console.error('JSON parse error', e);
                alert('Server did not return valid JSON. Check console for RAW RESPONSE.');
                return;
            }

            if (!res.ok || !json.success) {
                console.error('Save error', json);
                alert(json.message || 'Could not update patient');
                if (json.errors && json.errors.length) {
                    alert(json.errors.join('\n'));
                }
                return;
            }

            alert('Patient updated successfully.');
            window.location.href = `searchP.php`;
        } catch (err) {
            console.error('Network/server error', err);
            alert('Network error while saving patient.');
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Save Changes';
            }
        }
    });
});
