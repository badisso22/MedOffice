console.log('consultation.js loaded');

document.addEventListener('DOMContentLoaded', async function() {
    const urlParams = new URLSearchParams(window.location.search);
    const appointmentID = urlParams.get('appointmentID');
    const patientID = urlParams.get('patientID');

    if (!appointmentID || !patientID) {
        alert('Missing appointment or patient ID');
        window.location.href = 'appointments.php';
        return;
    }

    document.getElementById('consultationDate').value = new Date().toISOString().split('T')[0];
    await loadConsultationData(appointmentID, patientID);

    const form = document.getElementById('consultationForm');
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        await saveConsultation(appointmentID, patientID);
    });
});

async function loadConsultationData(appointmentID, patientID) {
    try {
        const res = await fetch(`../api/get-consultation-data.php?appointmentID=${appointmentID}&patientID=${patientID}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        if (!res.ok) throw new Error('HTTP ' + res.status);

        const json = await res.json();
        if (!json.success || !json.data) {
            throw new Error(json.message || 'Failed to load data');
        }

        const d = json.data;

        const initials = d.patient.name.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
        document.getElementById('patient-avatar').textContent = initials;
        document.getElementById('patient-name').textContent = d.patient.name;
        
        const age = d.patient.age || '—';
        const gender = d.patient.gender || '—';
        document.getElementById('patient-meta').textContent = `Patient ID: #P-${String(patientID).padStart(4, '0')} • Age: ${age} • Gender: ${gender}`;
        
        document.getElementById('patient-phone').textContent = d.patient.phone || '—';
        document.getElementById('patient-address').textContent = d.patient.address || '—';
        document.getElementById('patient-email').textContent = d.patient.email || '—';

        document.getElementById('appointment-date').textContent = formatDate(d.appointment.date);
        document.getElementById('appointment-time').textContent = formatTime(d.appointment.time);
        document.getElementById('appointment-purpose').textContent = d.appointment.purpose;

    } catch (err) {
        console.error(err);
        alert('Error loading consultation data: ' + err.message);
    }
}

async function saveConsultation(appointmentID, patientID) {
    const formData = {
        appointmentID: appointmentID,
        patientID: patientID,
        consultationType: document.getElementById('consultationType').value,
        consultationDate: document.getElementById('consultationDate').value,
        symptoms: document.getElementById('symptoms').value,
        diagnosis: document.getElementById('diagnosis').value,
        treatmentPlan: document.getElementById('treatmentPlan').value,
        additionalNotes: document.getElementById('additionalNotes').value,
        medicalFees: document.getElementById('medicalFees').value || 0
    };

    try {
        const res = await fetch('../api/save-consultation.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(formData)
        });

        const json = await res.json();
        if (!res.ok || !json.success) {
            alert(json.message || 'Failed to save consultation');
            return;
        }

        const modal = document.getElementById('successConsultationModal');
        if (modal) {
            modal.classList.add('active');
        }

    } catch (err) {
        console.error(err);
        alert('Network error: ' + err.message);
    }
}

function formatDate(dateStr) {
    if (!dateStr) return '—';
    const date = new Date(dateStr);
    return date.toLocaleDateString('en-US', { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric' });
}

function formatTime(timeStr) {
    if (!timeStr) return '—';
    const time = new Date('1970-01-01T' + timeStr);
    return time.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
}
