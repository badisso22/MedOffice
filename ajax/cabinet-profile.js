console.log('cabinet-profile.js loaded');

let allDoctors = [];

document.addEventListener('DOMContentLoaded', async function() {
    await loadCabinetProfile();
});

async function loadCabinetProfile() {
    try {
        const res = await fetch('../api/get-cabinet-profile.php', {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        if (!res.ok) throw new Error('HTTP ' + res.status);

        const json = await res.json();
        if (!json.success || !json.data) {
            throw new Error(json.message || 'Failed to load cabinet profile');
        }

        const d = json.data;

        const cabinetNameEl = document.querySelector('.cabinet-main-info h1');
        if (cabinetNameEl) cabinetNameEl.textContent = d.cabinet.name || 'Cabinet';

        const locationEl = document.querySelector('.cabinet-location span');
        if (locationEl) {
            const location = d.cabinet.location || '—';
            locationEl.textContent = location.length > 50 ? location.substring(0, 47) + '...' : location;
            locationEl.title = location;
        }

        const mapsLink = document.querySelector('.gps-link');
        if (mapsLink && d.cabinet.location) {
            const encodedLocation = encodeURIComponent(d.cabinet.location);
            mapsLink.href = `https://www.google.com/maps/search/?api=1&query=${encodedLocation}`;
        }

        const specialtyBadge = document.querySelector('.specialty-badge span');
        if (specialtyBadge) specialtyBadge.textContent = d.cabinet.specialty || 'General Practice';

        const bioText = document.getElementById('cabinet-bio-text');
        if (bioText) bioText.textContent = d.cabinet.bio || 'Welcome to our medical cabinet.';

        const ratingValue = document.querySelector('.rating-value');
        const reviewCount = document.querySelector('.review-count');
        if (ratingValue) ratingValue.textContent = d.rating.average || '0';
        if (reviewCount) reviewCount.textContent = `(${d.rating.total || 0} reviews)`;

        renderRatingBreakdown(d.rating.breakdown, d.rating.total);
        allDoctors = d.doctors;
        renderDoctors(d.doctors);
        renderPricing(d.pricing);
        renderReviews(d.reviews);
        renderSpecializations(d.cabinet.specialty, d.doctors);

        const phoneEl = document.getElementById('contact-phone');
        const emailEl = document.getElementById('contact-email');
        if (phoneEl) phoneEl.textContent = d.cabinet.phone || '—';
        if (emailEl) emailEl.textContent = d.cabinet.email || '—';

        const websiteEl = document.getElementById('contact-website');
        if (websiteEl) {
            if (d.cabinet.websiteUrl) {
                websiteEl.textContent = d.cabinet.websiteUrl;
                websiteEl.href = d.cabinet.websiteUrl;
            } else {
                websiteEl.textContent = '—';
                websiteEl.removeAttribute('href');
            }
        }

        renderFacilities(d.facilities || []);

        setSocialLink('social-facebook', d.cabinet.facebookUrl);
        setSocialLink('social-twitter', d.cabinet.twitterUrl);
        setSocialLink('social-instagram', d.cabinet.instagramUrl);
        setSocialLink('social-linkedin', d.cabinet.linkedinUrl);

    } catch (err) {
        console.error('Error loading cabinet profile:', err);
        alert('Error loading cabinet profile: ' + err.message);
    }
}

function renderRatingBreakdown(breakdown, total) {
    const container = document.querySelector('.rating-breakdown');
    if (!container) return;

    let html = '';
    for (let star = 5; star >= 1; star--) {
        const count = breakdown[star] || 0;
        const percent = total > 0 ? Math.round((count / total) * 100) : 0;
        html += `
            <div class="rating-bar-item">
                <span class="star-label">${star}★</span>
                <div class="bar-container">
                    <div class="bar-fill" style="width: ${percent}%"></div>
                </div>
                <span class="count">${count}</span>
            </div>
        `;
    }
    container.innerHTML = html;

    const bigRating = document.querySelector('.big-rating');
    const totalReviews = document.querySelector('.total-reviews');

    if (bigRating && total > 0) {
        const sum = Object.keys(breakdown).reduce(
            (acc, key) => acc + (parseInt(key) * breakdown[key]),
            0
        );
        const avg = (sum / total).toFixed(1);
        bigRating.textContent = avg;
    }
    if (totalReviews) totalReviews.textContent = `${total} total reviews`;
}

function renderDoctors(doctors) {
    const grid = document.querySelector('.doctors-grid');
    if (!grid) return;

    if (doctors.length === 0) {
        grid.innerHTML = '<p style="text-align: center; color: #6b7280;">No doctors available</p>';
        return;
    }

    let html = '';
    doctors.forEach(doc => {
        const initials = doc.name
            .split(' ')
            .slice(1)
            .map(n => n[0])
            .join('')
            .substring(0, 2)
            .toUpperCase();

        html += `
            <div class="doctor-card" onclick="showDoctorProfile(${doc.id})">
                <div class="doctor-image" style="background: linear-gradient(135deg, #0891b2, #06b6d4); display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem; font-weight: bold; width: 100px; height: 100px; border-radius: 50%;">${initials}</div>
                <div class="doctor-info">
                    <h3>${escapeHtml(doc.name)}</h3>
                    <p class="doctor-specialty">${escapeHtml(doc.specialty)}</p>
                    <div class="doctor-rating">
                        <span class="stars">★★★★★</span>
                    </div>
                    <p class="doctor-experience">${doc.experience || 0} years experience</p>
                </div>
            </div>
        `;
    });

    grid.innerHTML = html;
}

function renderReviews(reviews) {
    const list = document.getElementById('reviewsList');
    if (!list) return;

    if (reviews.length === 0) {
        list.innerHTML = '<p style="text-align: center; color: #6b7280;">No reviews yet</p>';
        return;
    }

    let html = '';
    reviews.forEach((rev, i) => {
        const stars = '★'.repeat(rev.rating || 0) + '☆'.repeat(5 - (rev.rating || 0));
        const hideClass = i >= 3 ? 'hidden-review' : '';

        html += `
            <div class="review-card ${hideClass}">
                <div class="review-header">
                    <div class="reviewer-info">
                        <div class="reviewer-avatar" style="background: #0891b2; color: white; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                            ${escapeHtml(rev.username.substring(0, 2).toUpperCase())}
                        </div>
                        <div>
                            <h4 class="reviewer-name">${escapeHtml(rev.username)}</h4>
                            <div class="review-meta">
                                <span class="review-stars">${stars}</span>
                                <span class="review-date">${formatDate(rev.date)}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="review-text">${escapeHtml(rev.message)}</p>
            </div>
        `;
    });

    list.innerHTML = html;
}

function renderSpecializations(cabinetSpecialty, doctors) {
    const list = document.getElementById('specializations-list');
    if (!list) return;

    const specialties = new Set();
    if (cabinetSpecialty) specialties.add(cabinetSpecialty);

    doctors.forEach(doc => {
        if (doc.specialty) specialties.add(doc.specialty);
    });

    if (specialties.size === 0) {
        list.innerHTML = '<li>General Practice</li>';
        return;
    }

    list.innerHTML = Array.from(specialties)
        .map(s => `<li>${escapeHtml(s)}</li>`)
        .join('');
}

function renderPricing(pricing) {
    const pricingBox = document.getElementById('pricing-list');
    if (!pricingBox) return;

    if (!pricing || pricing.length === 0) {
        pricingBox.innerHTML = '<li>No pricing information available</li>';
        return;
    }

    pricingBox.innerHTML = pricing
        .map(p => `<li>${escapeHtml(p.service)}: <strong>${p.price.toFixed(2)} DZD</strong></li>`)
        .join('');
}

function renderFacilities(facilities) {
    const list = document.getElementById('facilities-list');
    if (!list) return;

    if (!facilities || facilities.length === 0) {
        list.innerHTML = '<li>No facilities information available</li>';
        return;
    }

    list.innerHTML = facilities
        .map(f => `<li>${escapeHtml(f)}</li>`)
        .join('');
}

function setSocialLink(id, url) {
    const el = document.getElementById(id);
    if (!el) return;

    if (url) {
        el.href = url;
        el.classList.remove('disabled');
    } else {
        el.href = '#';
        el.classList.add('disabled');
    }
}

function showDoctorProfile(doctorId) {
    const doctor = allDoctors.find(d => d.id === doctorId);
    if (!doctor) return;

    const initials = doctor.name
        .split(' ')
        .slice(1)
        .map(n => n[0])
        .join('')
        .substring(0, 2)
        .toUpperCase();

    document.getElementById('modalDoctorName').textContent = doctor.name;
    document.getElementById('modalDoctorSpecialty').textContent = doctor.specialty;
    document.getElementById('modalDoctorStars').textContent = '★★★★★';
    document.getElementById('modalDoctorRating').textContent = '4.8';
    document.getElementById('modalDoctorReviews').textContent = '(Reviews coming soon)';
    document.getElementById('modalDoctorBio').textContent = doctor.bio || 'Experienced medical professional.';
    document.getElementById('modalDoctorExperience').textContent = `${doctor.experience || 0} years of medical practice`;
    document.getElementById('modalDoctorEducation').innerHTML = '<li>Education details coming soon</li>';
    document.getElementById('modalDoctorLanguages').textContent = 'Arabic, French';
    document.getElementById('modalDoctorAvailability').textContent = 'See calendar for availability';

    const modalImage = document.getElementById('modalDoctorImage');
    const existingAvatar = document.querySelector('.modal-doctor-avatar');
    if (existingAvatar) existingAvatar.remove();

    modalImage.style.display = 'none';
    modalImage.insertAdjacentHTML(
        'afterend',
        `<div class="modal-doctor-avatar" style="width: 150px; height: 150px; background: linear-gradient(135deg, #0891b2, #06b6d4); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem; font-weight: bold; margin-bottom: 1rem;">${initials}</div>`
    );

    document.getElementById('doctorModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeDoctorProfile() {
    const avatar = document.querySelector('.modal-doctor-avatar');
    if (avatar) avatar.remove();

    const modalImage = document.getElementById('modalDoctorImage');
    if (modalImage) modalImage.style.display = 'block';

    document.getElementById('doctorModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function formatDate(dateStr) {
    if (!dateStr) return 'Recently';
    const date = new Date(dateStr);
    const now = new Date();
    const diff = Math.floor((now - date) / (1000 * 60 * 60 * 24));

    if (diff < 7) return `${diff} days ago`;
    if (diff < 30) return `${Math.floor(diff / 7)} weeks ago`;
    return `${Math.floor(diff / 30)} months ago`;
}

function escapeHtml(str) {
    if (!str) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');
}

function toggleAllReviews() {
    const hiddenReviews = document.querySelectorAll('.hidden-review');
    const btn = document.querySelector('.btn-show-all');

    hiddenReviews.forEach(review => {
        if (review.style.display === 'block') {
            review.style.display = 'none';
            btn.textContent = 'Show All Reviews';
        } else {
            review.style.display = 'block';
            btn.textContent = 'Show Less';
        }
    });
}

window.onclick = function(event) {
    const modal = document.getElementById('doctorModal');
    if (event.target === modal) {
        closeDoctorProfile();
    }
};
