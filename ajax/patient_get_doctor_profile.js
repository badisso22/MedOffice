function toggleDrawer() {
    const drawer = document.getElementById('drawer');
    const overlay = document.getElementById('drawerOverlay');
    drawer.classList.toggle('open');
    overlay.classList.toggle('active');
}

function showTab(tabName) {
    const tabs = document.querySelectorAll('.tab-pane');
    const btns = document.querySelectorAll('.tab-btn');
    
    tabs.forEach(tab => tab.classList.remove('active'));
    btns.forEach(btn => btn.classList.remove('active'));
    
    document.getElementById(tabName).classList.add('active');
    event.target.classList.add('active');
}

function renderStars(rating) {
    const full = Math.round(rating);
    let stars = '';
    for (let i = 1; i <= 5; i++) {
        stars += i <= full ? '★' : '☆';
    }
    return stars;
}

function loadDoctorProfile() {
    const urlParams = new URLSearchParams(window.location.search);
    const doctorId = urlParams.get('doctor_id');
    if (!doctorId) return;

    fetch('../api/patient_get_doctor_profile.php?doctor_id=' + encodeURIComponent(doctorId), {
        method: 'GET',
        credentials: 'include'
    })
    .then(res => res.json())
    .then(data => {
        if (!data.success) {
            console.error(data.message || 'Failed to load doctor');
            return;
        }

        const d = data.data;

        document.getElementById('doctorName').textContent = d.doctor_name;
        document.getElementById('doctorNameInline').textContent = d.doctor_name;
        document.getElementById('doctorSpeciality').textContent = d.speciality || '';
        document.getElementById('doctorExperience').textContent = (d.experience_years || 0) + ' years';
        document.getElementById('doctorLanguages').textContent = d.languages || '';
        document.getElementById('doctorLocation').textContent = d.location || '';

        if (d.photo_url) {
            document.getElementById('doctorPhoto').src = d.photo_url;
        }

        const rating = parseFloat(d.avg_rating || 0);
        const reviewCount = d.review_count || 0;
        document.getElementById('doctorStars').textContent = renderStars(rating);
        document.getElementById('doctorRatingText').textContent = 
            (rating ? rating.toFixed(1) : 'No rating') + 
            (reviewCount ? ' (' + reviewCount + ' reviews)' : '');

        document.getElementById('doctorBio').textContent = d.bio || '';

        const eduList = document.getElementById('educationList');
        eduList.innerHTML = '';
        if (Array.isArray(d.education) && d.education.length) {
            d.education.forEach(item => {
                const li = document.createElement('li');
                li.innerHTML = `<strong>${item.title}</strong> - ${item.place} (${item.year})`;
                eduList.appendChild(li);
            });
        }

        const expList = document.getElementById('expertiseList');
        expList.innerHTML = '';
        if (Array.isArray(d.expertise) && d.expertise.length) {
            d.expertise.forEach(tag => {
                const span = document.createElement('span');
                span.className = 'tag';
                span.textContent = tag;
                expList.appendChild(span);
            });
        }
    })
    .catch(err => {
        console.error('Error loading doctor profile', err);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    loadDoctorProfile();
});
