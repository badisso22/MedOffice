document.addEventListener('DOMContentLoaded', async function () {
    const form = document.getElementById('assistantEditForm');
    if (!form) return;

    const urlParams = new URLSearchParams(window.location.search);
    const assistantID = urlParams.get('assistantID');
    
    if (!assistantID || isNaN(assistantID)) {
        alert('Missing or invalid assistant ID.');
        window.location.href = 'searchA.php';
        return;
    }

    try {
        const res = await fetch(`../api/edit_assistant.php?assistantID=${encodeURIComponent(assistantID)}`, {
            method: 'GET',
            headers: { 'Accept': 'application/json' }
        });

        const json = await res.json();

        if (!res.ok || !json.success) {
            console.error('Load error', json);
            alert(json.message || 'Could not load assistant data');
            return;
        }

        const d = json.data;
        
        if (form.firstName) form.firstName.value = d.firstName || '';
        if (form.lastName) form.lastName.value = d.lastName || '';
        if (form.email) form.email.value = d.email || '';
        if (form.phone) form.phone.value = d.phone || '';
        if (form.employeeId) form.employeeId.value = d.employeeCode || '';
        if (form.experience) form.experience.value = d.yearsExp || '';
        if (form.status) form.status.value = d.status || '';
        if (form.skills) form.skills.value = Array.isArray(d.skills) ? d.skills.join(', ') : '';

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
        console.error('Network/server error loading assistant', err);
        alert('Network error while loading assistant.');
    }

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Saving...';
        }

        const formData = new FormData(form);
        formData.append('assistantID', assistantID);

        try {
            const res = await fetch('../api/edit_assistant.php', {
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
                alert(json.message || 'Could not update assistant');
                if (json.errors && json.errors.length) {
                    alert(json.errors.join('\n'));
                }
                return;
            }

            alert('Assistant updated successfully.');
            window.location.href = 'searchA.php';
        } catch (err) {
            console.error('Network/server error', err);
            alert('Network error while saving assistant.');
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Save Changes';
            }
        }
    });
});
