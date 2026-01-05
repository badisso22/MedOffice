const wizardState = {
    step: 1,
    specialty: '',
    selectedCriteria: [],
    ranking: [],
    preferences: {},
    results: []
};

const API_BASE = '../api/patient_doctor_search.php';


async function initWizard() {
    try {
        const response = await fetch(`${API_BASE}?action=specialties`);
        const data = await response.json();
        
        if (data.success && data.data && data.data.length > 0) {
            renderSpecialties(data.data);
        } else {
            document.getElementById('specialtyGrid').innerHTML = 
                '<p class="error-message">Error loading specialties. Please refresh the page.</p>';
        }
    } catch (err) {
        console.error('Error loading specialties:', err);
        document.getElementById('specialtyGrid').innerHTML = 
            '<p class="error-message">Network error. Please check your connection.</p>';
    }
}

function renderSpecialties(specialties) {
    const grid = document.getElementById('specialtyGrid');
    grid.innerHTML = '';
    
    if (!specialties || specialties.length === 0) {
        grid.innerHTML = '<p class="error-message">No medical specialties available.</p>';
        return;
    }
    
    specialties.forEach(spec => {
        const card = document.createElement('div');
        card.className = 'specialty-card';
        card.innerHTML = `
            <input type="radio" name="specialty" value="${spec.speciality}" 
                    onchange="selectSpecialty('${spec.speciality}')" 
                    id="spec_${spec.speciality}">
            <label for="spec_${spec.speciality}">
                <h3>${spec.speciality}</h3>
                <p>${spec.doctor_count} doctor${spec.doctor_count !== 1 ? 's' : ''}</p>
            </label>
        `;
        grid.appendChild(card);
    });
}

async function selectSpecialty(specialty) {
    wizardState.specialty = specialty;
    
    try {
        const response = await fetch(`${API_BASE}?action=verify_specialty`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `specialty=${encodeURIComponent(specialty)}`
        });
        
        const data = await response.json();
        document.getElementById('step1Next').disabled = !data.success;
        
    } catch (err) {
        console.error('Error verifying specialty:', err);
        document.getElementById('step1Next').disabled = true;
    }
}


async function onCriteriaChange() {
    const checkboxes = document.querySelectorAll('input[name="criteria"]:checked');
    wizardState.selectedCriteria = Array.from(checkboxes).map(cb => cb.value);
    
    if (wizardState.selectedCriteria.includes('facilities') || wizardState.selectedCriteria.includes('location')) {
        await loadCriteriaOptions();
    }
    
    document.getElementById('facilitiesSelector').style.display = 
        wizardState.selectedCriteria.includes('facilities') ? 'block' : 'none';
    
    document.getElementById('locationSelector').style.display = 
        wizardState.selectedCriteria.includes('location') ? 'block' : 'none';
}


async function loadCriteriaOptions() {
    try {
        const response = await fetch(`${API_BASE}?action=criteria_options`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `specialty=${encodeURIComponent(wizardState.specialty)}`
        });
        const data = await response.json();
        
        if (data.success) {
            const facilitiesDiv = document.getElementById('facilitiesOptions');
            facilitiesDiv.innerHTML = '';
            if (data.data.facilities && data.data.facilities.length > 0) {
                data.data.facilities.forEach(facility => {
                    const label = document.createElement('label');
                    label.className = 'checkbox-label';
                    label.innerHTML = `
                        <input type="checkbox" name="facility" value="${facility}" 
                                onchange="updatePreferences('facilities')">
                        <span>${facility}</span>
                    `;
                    facilitiesDiv.appendChild(label);
                });
            }
            
            const locationSelect = document.getElementById('locationSelect');
            locationSelect.innerHTML = '<option value="">Select location</option>';
            if (data.data.locations && data.data.locations.length > 0) {
                data.data.locations.forEach(location => {
                    const option = document.createElement('option');
                    option.value = location;
                    option.textContent = location;
                    locationSelect.appendChild(option);
                });
            }
            locationSelect.onchange = () => updatePreferences('location');
        }
    } catch (err) {
        console.error('Error loading criteria options:', err);
    }
}

function updatePreferences(type) {
    if (type === 'facilities') {
        const checked = Array.from(document.querySelectorAll('input[name="facility"]:checked'))
            .map(cb => cb.value);
        wizardState.preferences.selectedFacilities = checked;
    } else if (type === 'location') {
        wizardState.preferences.location = document.getElementById('locationSelect').value;
    }
}

function goToStep(step) {
    showLoadingScreen();
    
    setTimeout(() => {
        hideLoadingScreen();
        document.querySelectorAll('.wizard-step').forEach(s => s.classList.remove('active'));
        document.getElementById(`step${step}`).classList.add('active');
        const progress = (step / 4) * 100;
        document.getElementById('progressBar').style.width = progress + '%';
        
        if (step === 3) {
            populateRankingList();
        } else if (step === 4) {
            fetchResults();
        }
        
        wizardState.step = step;
    }, 800);
}

function populateRankingList() {
    const list = document.getElementById('rankingList');
    list.innerHTML = '';
    
    const criteriaNames = {
        price: '💰 Price',
        availability: '📅 Availability',
        facilities: '♿ Facilities',
        location: '📍 Location',
        feedback: '⭐ Patient Feedback'
    };
    
    wizardState.selectedCriteria.forEach((criterion, index) => {
        const li = document.createElement('li');
        li.className = 'ranking-item';
        li.draggable = true;
        li.dataset.criterion = criterion;
        li.innerHTML = `
            <span class="rank-number">${index + 1}</span>
            <span class="criterion-name">${criteriaNames[criterion]}</span>
            <span class="drag-handle">⋮⋮</span>
        `;
        
        li.addEventListener('dragstart', handleDragStart);
        li.addEventListener('dragover', handleDragOver);
        li.addEventListener('drop', handleDrop);
        li.addEventListener('dragend', handleDragEnd);
        
        list.appendChild(li);
    });
    
    updateRanking();
}

let draggedItem = null;

function handleDragStart(e) {
    draggedItem = this;
    this.classList.add('dragging');
}

function handleDragOver(e) {
    e.preventDefault();
    if (this !== draggedItem && this.classList.contains('ranking-item')) {
        const list = document.getElementById('rankingList');
        const afterElement = getDragAfterElement(list, e.clientY);
        
        if (afterElement == null) {
            list.appendChild(draggedItem);
        } else {
            list.insertBefore(draggedItem, afterElement);
        }
    }
}

function handleDrop(e) {
    e.preventDefault();
}

function handleDragEnd(e) {
    this.classList.remove('dragging');
    updateRanking();
}

function getDragAfterElement(list, y) {
    const draggableElements = [...list.querySelectorAll('.ranking-item:not(.dragging)')];
    
    return draggableElements.reduce((closest, child) => {
        const box = child.getBoundingClientRect();
        const offset = y - box.top - box.height / 2;
        
        if (offset < 0 && offset > closest.offset) {
            return { offset: offset, element: child };
        } else {
            return closest;
        }
    }, { offset: Number.NEGATIVE_INFINITY }).element;
}

function updateRanking() {
    const items = document.querySelectorAll('.ranking-item');
    wizardState.ranking = Array.from(items).map(item => item.dataset.criterion);
    
    items.forEach((item, index) => {
        item.querySelector('.rank-number').textContent = index + 1;
    });
}

async function fetchResults() {
    document.getElementById('resultsContainer').innerHTML = '';
    document.getElementById('emptyState').style.display = 'none';
    document.getElementById('loadingResults').style.display = 'flex';
    
    try {
        const response = await fetch(`${API_BASE}?action=recommendations`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                specialty: wizardState.specialty,
                criteria: JSON.stringify(
                    wizardState.selectedCriteria.reduce((obj, c) => {
                        obj[c] = true;
                        return obj;
                    }, {})
                ),
                ranking: JSON.stringify(wizardState.ranking),
                preferences: JSON.stringify(wizardState.preferences)
            })
        });
        
        const data = await response.json();
        
        document.getElementById('loadingResults').style.display = 'none';
        
        if (data.success) {
            if (!data.data || data.data.length === 0) {
                showEmptyState(data.message || 'No doctors found');
            } else {
                renderResults(data.data);
            }
        } else {
            showEmptyState(data.error || 'Error loading results');
        }
    } catch (err) {
        console.error('Error fetching results:', err);
        document.getElementById('loadingResults').style.display = 'none';
        showEmptyState('Network error. Please try again.');
    }
}


function showEmptyState(message) {
    document.getElementById('emptyMessage').textContent = message;
    document.getElementById('emptyState').style.display = 'block';
    document.getElementById('resultsContainer').innerHTML = '';
}


function renderResults(doctors) {
    const container = document.getElementById('resultsContainer');
    container.innerHTML = '';
    
    if (!doctors || doctors.length === 0) {
        showEmptyState('No doctors found matching your criteria');
        return;
    }
    
    doctors.forEach((item, rank) => {
        const doctor = item.doctor;
        const score = item.wsm_score;
        const explanation = item.rank_explanation;
        
        const card = document.createElement('div');
        card.className = 'result-doctor-card';
        card.innerHTML = `
            <div class="result-rank">
                <span class="rank-badge">#${rank + 1}</span>
                <span class="score">${score}/100</span>
            </div>
            
            <div class="result-doctor-info">
                <h3>${doctor.firstName} ${doctor.lastName}</h3>
                <p class="specialty">${doctor.speciality}</p>
                <p class="experience">${doctor.yearsOfExperience} years experience</p>
                <p class="cabinet">${doctor.cabinetname}</p>
            </div>
            
            <div class="result-explanation">
                <h4>Why this match?</h4>
                <ul>
                    ${explanation.map(e => `
                        <li>
                            <strong>${e.criterion}</strong> (${e.weight_percent}%): 
                            ${e.score}/100 → +${e.contribution_points} points
                        </li>
                    `).join('')}
                </ul>
            </div>
            
            <div class="result-actions">
                <a href="doctor_profile.php?id=${doctor.doctorID}" class="btn btn-primary">View Profile</a>
                <button class="btn btn-secondary" onclick="bookDoctor(${doctor.doctorID})">Book Now</button>
            </div>
        `;
        
        container.appendChild(card);
    });
}


function showLoadingScreen() {
    document.getElementById('stepLoadingScreen').style.display = 'flex';
}

function hideLoadingScreen() {
    document.getElementById('stepLoadingScreen').style.display = 'none';
}


function resetWizard() {
    wizardState.step = 1;
    wizardState.specialty = '';
    wizardState.selectedCriteria = [];
    wizardState.ranking = [];
    wizardState.preferences = {};
    
    document.querySelectorAll('.wizard-step').forEach(s => s.classList.remove('active'));
    document.getElementById('step1').classList.add('active');
    document.getElementById('progressBar').style.width = '25%';
}


function bookDoctor(doctorID) {
    window.location.href = `../Patient/CalendarP.php?doctorID=${doctorID}`;
}


function toggleDrawer() {
    const drawer = document.getElementById('drawer');
    const overlay = document.getElementById('drawerOverlay');
    drawer.classList.toggle('open');
    overlay.classList.toggle('active');
}
window.addEventListener('DOMContentLoaded', initWizard);