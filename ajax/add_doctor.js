console.log('add_doctor.js loaded');

let step1Data = {};

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

function resetForm() {
    document.getElementById('form1').reset();
}

function proceedToStep2() {
    const form1 = document.getElementById('form1');
    
    if (!form1.checkValidity()) {
        form1.reportValidity();
        return;
    }

    step1Data = {
        firstName: form1.firstName.value,
        lastName: form1.lastName.value,
        dob: form1.dob.value,
        gender: form1.gender.value,
        addr: form1.addr.value,
        phone: form1.phone.value,
        specialty: form1.specialty.value,
        yearsExp: form1.yearsExp.value,
        licenseNo: form1.licenseNo.value,
        bio: form1.bio.value,
        username: form1.username.value,
        email: form1.email.value,
        pass: form1.pass.value
    };

    document.getElementById('step1').classList.remove('active');
    document.getElementById('step1').classList.add('hidden');
    document.getElementById('step2').classList.remove('hidden');
    document.getElementById('step2').classList.add('active');
    window.scrollTo(0, 0);
}

function backToStep1() {
    document.getElementById('step2').classList.remove('active');
    document.getElementById('step2').classList.add('hidden');
    document.getElementById('step1').classList.remove('hidden');
    document.getElementById('step1').classList.add('active');
    window.scrollTo(0, 0);
}

function toggleDay(checkbox, timesId) {
    const timesDiv = document.getElementById(timesId);
    if (checkbox.checked) {
        timesDiv.style.display = 'block';
    } else {
        timesDiv.style.display = 'none';
        timesDiv.querySelectorAll('input[type="time"]').forEach(input => input.value = '');
    }
}

async function submitForm(event) {
    event.preventDefault();

    const form2 = document.getElementById('form2');
    const loadingScreen = document.getElementById('loadingScreen');
    
    const days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    const availability = {};

    days.forEach(day => {
        const checkbox = document.getElementById(day);
        const timesDiv = document.getElementById(day + 'Times');
        
        if (checkbox && checkbox.checked && timesDiv) {
            const startInput = timesDiv.querySelector('.start-time');
            const endInput = timesDiv.querySelector('.end-time');
            
            if (startInput && endInput && startInput.value && endInput.value) {
                availability[day] = {
                    start: startInput.value,
                    end: endInput.value
                };
            }
        }
    });

    const fullData = {
        ...step1Data,
        availability: availability
    };

    loadingScreen.classList.remove('hidden');

    try {
        const res = await fetch('../api/add-doctor.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(fullData)
        });

        const raw = await res.text();
        console.log('RAW RESPONSE:', raw);

        let json;
        try {
            json = JSON.parse(raw);
        } catch (e) {
            console.error('JSON parse error', e);
            loadingScreen.classList.add('hidden');
            alert('Server did not return valid JSON. Check console.');
            return;
        }

        if (!res.ok || !json.success) {
            console.error('Add error', json);
            loadingScreen.classList.add('hidden');
            alert(json.message || 'Could not add doctor');
            if (json.errors && json.errors.length) {
                alert(json.errors.join('\n'));
            }
            return;
        }

        loadingScreen.classList.add('hidden');
        alert(`Doctor "${json.data.fullName}" added successfully!`);
        window.location.href = 'searchD.php';

    } catch (err) {
        console.error('Network/server error', err);
        loadingScreen.classList.add('hidden');
        alert('Network error while adding doctor.');
    }
}
