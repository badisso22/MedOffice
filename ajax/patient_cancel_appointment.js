function toggleDrawer() {
const drawer = document.getElementById('drawer');
const overlay = document.getElementById('drawerOverlay');
drawer.classList.toggle('open');
overlay.classList.toggle('active');
}

function logout() {
window.location.href = '../index.html';
}

function goBack() {
window.location.href = 'myAppointments.php';
}

function updateCharCount(textarea) {
const charCount = textarea.value.length;
document.getElementById('charCount').textContent = Math.min(charCount, 500);
if (charCount > 500) {
textarea.value = textarea.value.substring(0, 500);
}
}

async function handleSubmit(event) {
event.preventDefault();

const container = document.querySelector('.cancel-container');
const appointmentID = container.getAttribute('data-appointment-id');

const reasonInput = document.querySelector('input[name="reason"]:checked');
if (!reasonInput) {
alert('Please select a reason');
return;
}

const reason = reasonInput.value;
const comments = document.getElementById('comments').value;

try {
const res = await fetch('../api/patient-cancel-appointment.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    },
    body: JSON.stringify({
        appointmentID: appointmentID,
        reason: reason,
        comments: comments
    })
});

const json = await res.json();

if (!res.ok || !json.success) {
    const msg = (json && json.errors && json.errors[0]) ? json.errors[0] : 'Cancellation failed';
    alert(msg);
    return;
}

// success UI
document.querySelector('.form-card').style.display = 'none';
const message = document.getElementById('confirmationMessage');
message.style.display = 'block';

setTimeout(() => {
    window.location.href = 'myAppointments.php';
}, 3000);
} catch (err) {
console.error('Cancel error', err);
alert('An error occurred while cancelling the appointment.');
}
}
