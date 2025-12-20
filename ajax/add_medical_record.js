document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('add-record-form');
    if (!form) {
        console.error('add_medical_record.js: form with id="add-record-form" not found');
        return;
    }

    console.log('add_medical_record.js: submit handler attached');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        console.log('add_medical_record.js: submit handler running');

        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Saving...';
        }

        const formData = new FormData(form);

        try {
            const res = await fetch('../api/save_medical_record.php', {
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
                alert(json.message || 'Could not save medical record');
                if (json.errors && json.errors.length) {
                    alert(json.errors.join('\n'));
                }
                return;
            }

            alert('Medical record saved successfully.');

            const params = new URLSearchParams(window.location.search);
            const patientID = params.get('patientID');

            if (patientID) {
                window.location.href = `view_records.php?patientID=${encodeURIComponent(patientID)}`;
            } else {
                window.location.href = 'view_records.php';
            }
        } catch (err) {
            console.error('Network/server error', err);
            alert('Network error while saving record.');
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Save Medical Record';
            }
        }
    });
});
