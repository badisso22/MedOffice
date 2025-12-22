console.log('edit_doctor.js loaded');

document.addEventListener('DOMContentLoaded', async function () {
    const form = document.getElementById('doctorEditForm');
    if (!form) return;

    const urlParams = new URLSearchParams(window.location.search);
    const doctorID = urlParams.get('doctorID');
    
    if (!doctorID || isNaN(doctorID)) {
        alert('Missing or invalid doctor ID.');
        window.location.href = 'searchD.php';
        return;
    }

    try {
        const res = await fetch(`../api/edit_doctor.php?doctorID=${encodeURIComponent(doctorID)}`, {
            method: 'GET',
            headers: { 'Accept': 'application/json' }
        });

        const json = await res.json();

        if (!res.ok || !json.success) {
            console.error('Load error', json);
            alert(json.message || 'Could not load doctor data');
            return;
        }

        const d = json.data;
        form.firstName.value = d.firstName || '';
        form.lastName.value = d.lastName || '';
        form.email.value = d.email || '';
        form.phone.value = d.phone || '';
        form.speciality.value = d.speciality || '';
        form.yearsExp.value = d.yearsExp || '';
        form.licenseNumber.value = d.licenseNumber || '';
        form.bio.value = d.bio || '';

        if (Array.isArray(d.availability) && d.availability.length > 0) {
            d.availability.forEach(avail => {
                const day = avail.dayOfWeek.toLowerCase();
                const checkbox = document.getElementById(day);
                const startInput = document.querySelector(`input[name="${day}_start"]`);
                const endInput = document.querySelector(`input[name="${day}_end"]`);

                if (checkbox && parseInt(avail.isAvailable, 10) === 1) {
                    checkbox.checked = true;
                    if (startInput && avail.startTime) startInput.value = avail.startTime.substring(0, 5);
                    if (endInput && avail.endTime) endInput.value = avail.endTime.substring(0, 5);
                }
            });
        }

    } catch (err) {
        console.error('Network/server error loading doctor', err);
        alert('Network error while loading doctor.');
    }

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Saving...';
        }

        const formData = new FormData(form);
        formData.append('doctorID', doctorID);

        try {
            const res = await fetch('../api/edit_doctor.php', {
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
                alert(json.message || 'Could not update doctor');
                if (json.errors && json.errors.length) {
                    alert(json.errors.join('\n'));
                }
                return;
            }

            alert('Doctor updated successfully.');
            window.location.href = 'searchD.php';
        } catch (err) {
            console.error('Network/server error', err);
            alert('Network error while saving doctor.');
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Save Changes';
            }
        }
    });
});
