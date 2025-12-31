document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('requestCabForm');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        sendCabRequest();
    });
});

function sendCabRequest() {
    const first = document.getElementById('first-name').value.trim();
    const last  = document.getElementById('last-name').value.trim();
    const email = document.getElementById('email').value.trim();
    const msg   = document.getElementById('message').value.trim();
    const out   = document.getElementById('request_result');

    if (!first || !last || !email || !msg) {
        out.textContent = 'Please fill all fields.';
        out.style.color = 'red';
        return;
    }

    const name = first + ' ' + last;

    const formData = new FormData();
    formData.append('name', name);
    formData.append('email', email);
    formData.append('message', msg);

    fetch('../api/requestCreate.php', {
        method: 'POST',
        body: formData
    })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                out.textContent = data.message;
                out.style.color = 'green';
            } else {
                out.textContent = data.error || 'Something went wrong.';
                out.style.color = 'red';
            }
        })
        .catch(err => {
            console.error(err);
            out.textContent = 'Network error.';
            out.style.color = 'red';
        });
}
