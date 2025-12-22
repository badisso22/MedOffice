console.log('add-assistant.js loaded');

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('assistantForm');
    const submitBtn = document.getElementById('submitBtn');

    if (!form) return;

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Adding Assistant...';
        }

        const formData = new FormData(form);

        try {
            const res = await fetch('../api/process-add-assistant.php', {
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
                console.error('Add error', json);
                alert(json.message || 'Could not add assistant');
                if (json.errors && json.errors.length) {
                    alert(json.errors.join('\n'));
                }
                return;
            }

            const modal = document.getElementById('successModal');
            const message = document.getElementById('modalMessage');
            if (modal && message) {
                message.textContent = `Assistant "${json.data.firstName} ${json.data.lastName}" has been successfully added to the system.`;
                modal.classList.add('active');
            }

            form.reset();

        } catch (err) {
            console.error('Network/server error', err);
            alert('Network error while adding assistant.');
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Add Assistant';
            }
        }
    });
});

function toggleDrawer() {
    const drawer = document.getElementById('drawer');
    const overlay = document.getElementById('drawerOverlay');
    drawer.classList.toggle('open');
    overlay.classList.toggle('active');
}

function togglePassword() {
    const passInput = document.getElementById('pass');
    if (passInput.type === 'password') {
        passInput.type = 'text';
    } else {
        passInput.type = 'password';
    }
}

function closeSuccessModal() {
    const modal = document.getElementById('successModal');
    if (modal) {
        modal.classList.remove('active');
    }
    window.location.href = 'searchA.php';
}
