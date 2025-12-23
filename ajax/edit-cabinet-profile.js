console.log('edit_cabinet_profile.js loaded');

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('cabinetEditForm');
    if (!form) return;

    loadCabinetInfo();

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        await saveCabinetInfo();
    });
});

async function loadCabinetInfo() {
    try {
        const res = await fetch('../api/get-cabinet-info.php', {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        if (!res.ok) throw new Error('HTTP ' + res.status);

        const json = await res.json();
        if (!json.success || !json.data) {
            throw new Error(json.message || 'Failed to load cabinet info');
        }

        const d = json.data;

        document.getElementById('cabinetName').value = d.cabinet.name || '';
        document.getElementById('cabinetBio').value = d.cabinet.bio || '';
        document.getElementById('address').value = d.cabinet.location || '';
        document.getElementById('phone').value = d.cabinet.phone || '';
        document.getElementById('email').value = d.cabinet.email || '';
        document.getElementById('website').value = d.cabinet.websiteUrl || '';

        if (d.cabinet.specialty) {
            const specs = d.cabinet.specialty.split(',').map(s => s.trim().toLowerCase());
            document.querySelectorAll('input[name="specializations"]').forEach(chk => {
                if (specs.includes(chk.value.toLowerCase())) {
                    chk.checked = true;
                }
            });
        }

        document.getElementById('facebook').value = d.cabinet.facebookUrl || '';
        document.getElementById('twitter').value = d.cabinet.twitterUrl || '';
        document.getElementById('instagram').value = d.cabinet.instagramUrl || '';
        document.getElementById('linkedin').value = d.cabinet.linkedinUrl || '';

        if (Array.isArray(d.facilities)) {
            const lowerFacilities = d.facilities.map(f => f.toLowerCase());
            document.querySelectorAll('input[name="facilities"]').forEach(chk => {
                if (lowerFacilities.includes(chk.value.toLowerCase())) {
                    chk.checked = true;
                }
            });
        }

        if (d.cabinet.additionalServices) {
            document.getElementById('additionalServices').value = d.cabinet.additionalServices;
        }

        if (Array.isArray(d.pricing)) {
            const findPrice = name =>
                d.pricing.find(p => p.service.toLowerCase() === name.toLowerCase());

            const g = findPrice('General Consultation');
            const s = findPrice('Specialist Visit');
            const f = findPrice('Follow-up');
            const e = findPrice('Emergency Visit');

            if (g) document.getElementById('priceGeneral').value = g.price;
            if (s) document.getElementById('priceSpecialist').value = s.price;
            if (f) document.getElementById('priceFollowup').value = f.price;
            if (e) document.getElementById('priceEmergency').value = e.price;
        }
    } catch (err) {
        console.error('Error loading cabinet info:', err);
        showToast('Failed to load cabinet info', true);
    }
}

async function saveCabinetInfo() {
    const selectedSpecs = Array.from(
        document.querySelectorAll('input[name="specializations"]:checked')
    ).map(chk => chk.value);

    const selectedFacilities = Array.from(
        document.querySelectorAll('input[name="facilities"]:checked')
    ).map(chk => chk.value);

    const payload = {
        cabinetName: document.getElementById('cabinetName').value.trim(),
        cabinetBio: document.getElementById('cabinetBio').value.trim(),
        address: document.getElementById('address').value.trim(),
        phone: document.getElementById('phone').value.trim(),
        email: document.getElementById('email').value.trim(),
        website: document.getElementById('website').value.trim(),

        specializations: selectedSpecs,
        otherSpecializations: document.getElementById('otherSpecializations').value.trim(),

        facebook: document.getElementById('facebook').value.trim(),
        twitter: document.getElementById('twitter').value.trim(),
        instagram: document.getElementById('instagram').value.trim(),
        linkedin: document.getElementById('linkedin').value.trim(),

        facilities: selectedFacilities,
        additionalServices: document.getElementById('additionalServices').value.trim(),

        priceGeneral: Number(document.getElementById('priceGeneral').value || 0),
        priceSpecialist: Number(document.getElementById('priceSpecialist').value || 0),
        priceFollowup: Number(document.getElementById('priceFollowup').value || 0),
        priceEmergency: Number(document.getElementById('priceEmergency').value || 0)
    };

    try {
        const res = await fetch('../api/update-cabinet.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(payload)
        });

        const json = await res.json();
        if (!res.ok || !json.success) {
            throw new Error(json.message || 'Failed to update cabinet');
        }

        showToast('Changes saved successfully!');
    } catch (err) {
        console.error('Error saving cabinet info:', err);
        showToast('Error saving changes: ' + err.message, true);
    }
}

function showToast(message, isError = false) {
    const toast = document.getElementById('successToast');
    if (!toast) return;
    toast.querySelector('span').textContent = message;
    toast.classList.toggle('error', !!isError);
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 3000);
}
