let currentDate = new Date()
let appointments = {}
let editingId = null
let allPatients = []

const icons = {
  clock: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <circle cx="12" cy="12" r="10"></circle>
    <polyline points="12 6 12 12 16 14"></polyline>
  </svg>`,
  user: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
    <circle cx="12" cy="7" r="4"></circle>
  </svg>`,
  phone: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
  </svg>`,
  trash: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <polyline points="3 6 5 6 21 6"></polyline>
    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 0 2-2h4a2 2 0 0 0 2 2v2"></path>
    <line x1="10" y1="11" x2="10" y2="17"></line>
    <line x1="14" y1="11" x2="14" y2="17"></line>
  </svg>`,
  plus: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <line x1="12" y1="5" x2="12" y2="19"></line>
    <line x1="5" y1="12" x2="19" y2="12"></line>
  </svg>`,
  warning: `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
    <line x1="12" y1="9" x2="12" y2="13"></line>
    <line x1="12" y1="17" x2="12.01" y2="17"></line>
  </svg>`,
  check: `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <polyline points="20 6 9 17 4 12"></polyline>
  </svg>`,
  lock: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
  </svg>`,
  cross: `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <line x1="18" y1="6" x2="6" y2="18"></line>
    <line x1="6" y1="6" x2="18" y2="18"></line>
  </svg>`,
}

function isDateInPast(dateString) {
  const selectedDate = new Date(dateString + "T00:00:00")
  const today = new Date()
  today.setHours(0, 0, 0, 0)
  return selectedDate < today
}

function getTodayDateString() {
  const today = new Date()
  return `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, "0")}-${String(today.getDate()).padStart(2, "0")}`
}

async function loadPatientsList() {
  try {
    const res = await fetch("../api/admin-search-patient.php")
    const json = await res.json()
    if (json.success && json.data && json.data.patients) {
      allPatients = json.data.patients
      populatePatientDropdown()
    }
  } catch (err) {
    console.error("Error loading patients:", err)
  }
}

function populatePatientDropdown() {
  const select = document.getElementById("patientSelect")
  select.innerHTML = '<option value="">-- Search and Select Patient --</option>'

  allPatients.forEach((p) => {
    const opt = document.createElement("option")
    opt.value = p.patientID
    opt.textContent = `${p.name} (ID: ${String(p.patientID).padStart(3, "0")})`
    opt.setAttribute("data-phone", p.phone)
    select.appendChild(opt)
  })
}

async function loadAppointments() {
  const month = currentDate.getMonth() + 1
  const year = currentDate.getFullYear()

  try {
    const res = await fetch(`../api/get-calendar-appointments.php?month=${month}&year=${year}`)
    const json = await res.json()
    if (json.success && Array.isArray(json.appointments)) {
      appointments = {}
      json.appointments.forEach((apt) => {
        if (!appointments[apt.date]) appointments[apt.date] = []
        appointments[apt.date].push(apt)
      })
      renderCalendar()
    }
  } catch (err) {
    console.error("Error loading appointments:", err)
  }
}

function renderCalendar() {
  const year = currentDate.getFullYear()
  const month = currentDate.getMonth()

  document.getElementById("monthYear").textContent = currentDate.toLocaleDateString("en-US", {
    month: "long",
    year: "numeric",
  })

  const firstDay = new Date(year, month, 1)
  const lastDay = new Date(year, month + 1, 0)
  const startDay = (firstDay.getDay() + 6) % 7
  const totalDays = lastDay.getDate()

  const today = new Date()
  today.setHours(0, 0, 0, 0)
  const isCurrentMonth = today.getMonth() === month && today.getFullYear() === year
  const todayDate = today.getDate()

  let html = ""

  for (let i = 0; i < startDay; i++) {
    html += '<div class="cal-day-cell empty"></div>'
  }

  for (let day = 1; day <= totalDays; day++) {
    const dateKey = `${year}-${String(month + 1).padStart(2, "0")}-${String(day).padStart(2, "0")}`
    const cellDate = new Date(year, month, day)
    const isPast = cellDate < today
    const isToday = isCurrentMonth && day === todayDate
    const dayApts = appointments[dateKey] || []

    html += `
      <div class="cal-day-cell ${isToday ? "today" : ""} ${dayApts.length > 0 ? "has-appointments" : ""} ${isPast ? "past-date" : ""}" 
           data-date="${dateKey}"
           onclick="${isPast ? "" : `handleDayClick(event, '${dateKey}')`}">
        <div class="cal-day-number">${day}</div>
        ${isPast ? `<div class="past-indicator">${icons.lock}</div>` : ""}
        <div class="cal-appointments">
          ${dayApts
            .map(
              (apt) => `
            <div class="cal-apt-item" 
                 style="background-color: ${getColor(apt.type)};"
                 onclick="event.stopPropagation(); editAppointment('${dateKey}', ${apt.id})">
              <div class="cal-apt-content">
                <div class="cal-apt-time">${icons.user} ${escapeHtml(apt.patientName)}</div>
                <div class="cal-apt-cabinet">${icons.clock} ${apt.time}</div>
                <div class="cal-apt-type">${escapeHtml(apt.type)}</div>
              </div>
              <button class="cal-apt-delete" onclick="event.stopPropagation(); confirmDelete('${dateKey}', ${apt.id})">${icons.trash}</button>
            </div>
          `,
            )
            .join("")}
        </div>
        ${dayApts.length === 0 && !isPast ? `<div class="cal-add-hint">${icons.plus} Add</div>` : ""}
      </div>
    `
  }

  document.getElementById("calendarDays").innerHTML = html
}

function escapeHtml(str) {
  if (!str) return ""
  return String(str).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;")
}

function handleDayClick(event, date) {
  if (event.target.closest(".cal-apt-item") || event.target.closest(".cal-apt-delete")) {
    return
  }

  if (isDateInPast(date)) {
    showNotification(`${icons.warning} Cannot create appointments for past dates`, "error")
    return
  }

  const dayApts = appointments[date] || []
  if (dayApts.length > 0) {
    showDayAppointmentsModal(date, dayApts)
  } else {
    openNewAppointment(date)
  }
}

function showDayAppointmentsModal(date, dayApts) {
  const formattedDate = formatDate(date)

  const modalHtml = `
    <div class="modal-overlay active" id="dayApptsOverlay" onclick="if(event.target === this) closeDayApptsModal()">
      <div class="modal modal-large">
        <div class="modal-header">
          <h3>${icons.clock} Appointments for ${formattedDate}</h3>
          <button class="modal-close" onclick="closeDayApptsModal()">${icons.cross}</button>
        </div>
        <div class="modal-body">
          <div class="day-appointments-list">
            ${dayApts
              .map(
                (apt) => `
              <div class="day-apt-card" style="border-left: 4px solid ${getColor(apt.type)};">
                <div class="day-apt-header">
                  <div class="day-apt-patient">
                    <div class="day-apt-patient-icon">${icons.user}</div>
                    <div>
                      <div class="day-apt-name">${escapeHtml(apt.patientName)}</div>
                      <div class="day-apt-time">${icons.clock} ${apt.time}</div>
                    </div>
                  </div>
                  <div class="day-apt-actions">
                    <button class="day-apt-btn-edit" onclick="editAppointment('${date}', ${apt.id}); closeDayApptsModal();">
                      Edit
                    </button>
                    <button class="day-apt-btn-delete" onclick="confirmDelete('${date}', ${apt.id})">
                      ${icons.trash}
                    </button>
                  </div>
                </div>
                <div class="day-apt-details">
                  <div class="day-apt-detail-item">
                    <strong>Type:</strong> ${escapeHtml(apt.type)}
                  </div>
                  ${
                    apt.notes
                      ? `
                    <div class="day-apt-detail-item">
                      <strong>Notes:</strong> ${escapeHtml(apt.notes)}
                    </div>
                  `
                      : ""
                  }
                </div>
              </div>
            `,
              )
              .join("")}
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn-modal btn-modal-secondary" onclick="closeDayApptsModal()">Close</button>
          <button class="btn-modal btn-modal-primary" onclick="openNewAppointment('${date}'); closeDayApptsModal();">
            ${icons.plus} Add Another Appointment
          </button>
        </div>
      </div>
    </div>
  `

  document.body.insertAdjacentHTML("beforeend", modalHtml)
}

function closeDayApptsModal() {
  const overlay = document.getElementById("dayApptsOverlay")
  if (overlay) overlay.remove()
}

function getColor(type) {
  const colors = {
    "General Consultation": "#3b82f6",
    "Medical Follow-up": "#10b981",
    Emergency: "#ef4444",
    Vaccination: "#8b5cf6",
    "Test Results": "#f59e0b",
  }
  return colors[type] || "#6b7280"
}

function openNewAppointment(date) {
  if (isDateInPast(date)) {
    showNotification(`${icons.warning} Cannot create appointments for past dates`, "error")
    return
  }

  editingId = null

    document.getElementById("appointmentDate").value = date
  document.getElementById("appointmentDate").min = getTodayDateString()
  document.getElementById("patientSelect").value = ""
  document.getElementById("patientPhone").value = ""
  document.getElementById("appointmentTime").value = ""
  document.getElementById("appointmentType").value = ""
  document.getElementById("notes").value = ""

  document.getElementById("patientSearch").value = ""
  populatePatientDropdown()

  document.querySelectorAll(".time-slot").forEach((slot) => {
    slot.classList.remove("selected")
  })

  goToStep(1)
  document.getElementById("modalOverlay").classList.add("active")
}

async function editAppointment(date, id) {
  const apt = appointments[date]?.find((a) => a.id === id)
  if (!apt) {
    showNotification(`${icons.warning} Appointment not found`, "error")
    return
  }

  editingId = { date: date, id: id }

  document.getElementById("appointmentDate").value = date
  document.getElementById("appointmentDate").min = getTodayDateString()
  document.getElementById("patientSelect").value = apt.patientId
  document.getElementById("patientPhone").value = apt.patientPhone || ""
  document.getElementById("appointmentTime").value = apt.time
  document.getElementById("appointmentType").value = apt.type
  document.getElementById("notes").value = apt.notes || ""

  document.getElementById("patientSearch").value = ""
  populatePatientDropdown()

  document.getElementById("modalTitle").textContent = "Edit Appointment"

  goToStep(1)
  document.getElementById("modalOverlay").classList.add("active")
}

let currentStep = 1

function goToStep(step) {
  currentStep = step

  for (let i = 1; i <= 4; i++) {
    document.getElementById(`step${i}`).classList.remove("active")
  }
  document.getElementById("resultStep").classList.remove("active")

  document.getElementById(`step${step}`).classList.add("active")

  updateProgressBar(step)

  const titles = {
    1: "Step 1: Select Patient",
    2: "Step 2: Choose Time",
    3: "Step 3: Appointment Details",
    4: "Booking Appointment...",
  }

  const selectedDate = document.getElementById("appointmentDate").value
  if (selectedDate) {
    const formattedDate = formatDateShort(selectedDate)
    document.getElementById("modalTitle").textContent = `${titles[step]} - ${formattedDate}`
  } else {
    document.getElementById("modalTitle").textContent = titles[step]
  }

  const wizardFooter = document.getElementById("wizardFooter")
  const prevBtn = document.getElementById("prevBtn")
  const nextBtn = document.getElementById("nextBtn")

  if (step === 1) {
    wizardFooter.style.display = "flex"
    prevBtn.style.display = "none"
    nextBtn.style.display = "inline-block"
    nextBtn.textContent = "Next →"
  } else if (step === 2 || step === 3) {
    wizardFooter.style.display = "flex"
    prevBtn.style.display = "inline-block"
    nextBtn.style.display = "inline-block"
    nextBtn.textContent = step === 3 ? "Book Appointment" : "Next →"
  } else if (step === 4) {
    wizardFooter.style.display = "none"
  }
}

function formatDateShort(dateStr) {
  const date = new Date(dateStr + "T00:00:00")
  return date.toLocaleDateString("en-US", { month: "short", day: "numeric", year: "numeric" })
}

function nextStep() {
  if (currentStep === 1) {
    const patientId = document.getElementById("patientSelect").value
    if (!patientId) {
      showNotification(`${icons.warning} Please select a patient`, "error")
      return
    }
    generateTimeSlots()
    goToStep(2)
  } else if (currentStep === 2) {
    const selectedSlot = document.querySelector(".time-slot.selected")
    if (!selectedSlot) {
      showNotification(`${icons.warning} Please select a time slot`, "error")
      return
    }
    document.getElementById("appointmentTime").value = selectedSlot.dataset.time
    goToStep(3)
  } else if (currentStep === 3) {
    const type = document.getElementById("appointmentType").value
    if (!type) {
      showNotification(`${icons.warning} Please select appointment type`, "error")
      return
    }
    saveAppointment()
  }
}

function prevStep() {
  if (currentStep > 1) {
    goToStep(currentStep - 1)
  }
}

function searchPatients() {
  const searchTerm = document.getElementById("patientSearch").value.toLowerCase()
  const select = document.getElementById("patientSelect")

  select.innerHTML = '<option value="">-- Select Patient --</option>'

  const filtered = allPatients.filter(
    (p) =>
      p.name.toLowerCase().includes(searchTerm) ||
      String(p.patientID).includes(searchTerm) ||
      (p.phone && p.phone.includes(searchTerm)),
  )

  filtered.forEach((p) => {
    const opt = document.createElement("option")
    opt.value = p.patientID
    opt.textContent = `${p.name} (ID: ${String(p.patientID).padStart(3, "0")})`
    opt.setAttribute("data-phone", p.phone)
    select.appendChild(opt)
  })

  if (filtered.length === 0) {
    const opt = document.createElement("option")
    opt.value = ""
    opt.textContent = "No patients found"
    opt.disabled = true
    select.appendChild(opt)
  }
}

function generateTimeSlots() {
  const container = document.getElementById("timeSlotsContainer")
  container.innerHTML = ""

  const selectedDate = document.getElementById("appointmentDate").value
  
  let bookedTimes = []
  if (selectedDate && appointments[selectedDate]) {
    bookedTimes = appointments[selectedDate].map(apt => apt.time)
  }

  const startHour = 9
  const endHour = 24

  for (let hour = startHour; hour < endHour; hour++) {
    for (const minute of [0, 30]) {
      const timeString = `${String(hour).padStart(2, "0")}:${String(minute).padStart(2, "0")}`
      const displayTime = formatTime12Hour(hour, minute)
      const isBooked = bookedTimes.includes(timeString)

      const slot = document.createElement("div")
      slot.className = `time-slot ${isBooked ? 'booked' : ''}`
      slot.dataset.time = timeString
      slot.innerHTML = `
        <div class="time-slot-icon">${icons.clock}</div>
        <div class="time-slot-time">${displayTime}</div>
        ${isBooked ? '<div class="booked-label">Booked</div>' : ''}
      `
      
      if (!isBooked) {
        slot.onclick = () => selectTimeSlot(slot)
      }

      container.appendChild(slot)
    }
  }
}

function formatTime12Hour(hour, minute) {
  const period = hour >= 12 ? "PM" : "AM"
  const displayHour = hour > 12 ? hour - 12 : hour === 0 ? 12 : hour
  return `${displayHour}:${String(minute).padStart(2, "0")} ${period}`
}

function selectTimeSlot(slot) {
  document.querySelectorAll(".time-slot").forEach((s) => s.classList.remove("selected"))
  slot.classList.add("selected")
}

async function saveAppointment() {
  const patientSelect = document.getElementById("patientSelect")
  const patientId = patientSelect.value
  const date = document.getElementById("appointmentDate").value
  const time = document.getElementById("appointmentTime").value
  const type = document.getElementById("appointmentType").value
  const notes = document.getElementById("notes").value

  if (!patientId || !date || !time || !type) {
    showNotification(`${icons.warning} Please fill in all required fields`, "error")
    return
  }

  if (isDateInPast(date)) {
    showNotification(`${icons.warning} Cannot create appointments for past dates`, "error")
    return
  }

  goToStep(4)

  const payload = {
    patientId: Number.parseInt(patientId),
    date: date,
    time: time,
    type: type,
    notes: notes,
  }

  if (editingId) {
    payload.id = editingId.id
  }

  try {
    await new Promise((resolve) => setTimeout(resolve, 2000))

    const res = await fetch("../api/admin-book-appointment.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest",
      },
      body: JSON.stringify(payload),
    })

    const json = await res.json()

    if (!res.ok || !json.success) {
      showResultScreen(false, json.errors ? json.errors.join(", ") : "Failed to save appointment")
    } else {
      showResultScreen(true, json.message || "Appointment booked successfully!")
      await loadAppointments()
    }
  } catch (err) {
    console.error("Error saving appointment:", err)
    showResultScreen(false, err.message)
  }
}

function showResultScreen(success, message) {
  const resultContainer = document.getElementById("resultContainer")
  resultContainer.innerHTML = `
    <div class="result-animation">
      ${
        success
          ? `
        <div class="success-icon">
          <svg viewBox="0 0 24 24" width="80" height="80" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="9 12 11 14 15 10"></polyline>
          </svg>
        </div>
        <h3 class="result-title success">Success!</h3>
        <p class="result-message">${escapeHtml(message)}</p>
      `
          : `
        <div class="error-icon">
          <svg viewBox="0 0 24 24" width="80" height="80" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="15" y1="9" x2="9" y2="15"></line>
            <line x1="9" y1="9" x2="15" y2="15"></line>
          </svg>
        </div>
        <h3 class="result-title error">Failed</h3>
        <p class="result-message">${escapeHtml(message)}</p>
      `
      }
      <button class="btn-modal btn-modal-primary" onclick="closeModal()">Close</button>
    </div>
  `

  document.getElementById("step4").classList.remove("active")
  document.getElementById("resultStep").classList.add("active")

  document.getElementById("wizardFooter").style.display = "none"

  if (success) {
    editingId = null
  }
}

function confirmDelete(date, id) {
  const apt = appointments[date].find((a) => a.id === id)
  if (!apt) return

  const confirmHtml = `
    <div class="modal-overlay active" id="deleteConfirmOverlay" style="z-index: 3000;">
      <div class="modal" style="max-width: 400px;">
        <div class="modal-header" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
          <h3>${icons.warning} Confirm Delete</h3>
          <button class="modal-close" onclick="closeDeleteConfirm()">${icons.cross}</button>
        </div>
        <div class="modal-body">
          <p style="margin-bottom: 1rem; color: #374151;">Are you sure you want to delete this appointment?</p>
          <div style="background: #f9fafb; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
            <p style="margin: 0.25rem 0;"><strong>Patient:</strong> ${escapeHtml(apt.patientName)}</p>
            <p style="margin: 0.25rem 0;"><strong>Date:</strong> ${formatDate(date)}</p>
            <p style="margin: 0.25rem 0;"><strong>Time:</strong> ${apt.time}</p>
            <p style="margin: 0.25rem 0;"><strong>Type:</strong> ${escapeHtml(apt.type)}</p>
          </div>
          <p style="color: #ef4444; font-size: 0.9rem;">This action cannot be undone.</p>
        </div>
        <div class="modal-footer">
          <button class="btn-modal btn-modal-secondary" onclick="closeDeleteConfirm()">Cancel</button>
          <button class="btn-modal" style="background: #ef4444; color: white;" onclick="deleteAppointment(${id})">Delete Appointment</button>
        </div>
      </div>
    </div>
  `

  document.body.insertAdjacentHTML("beforeend", confirmHtml)
}

function closeDeleteConfirm() {
  const overlay = document.getElementById("deleteConfirmOverlay")
  if (overlay) overlay.remove()
}

async function deleteAppointment(id) {
  try {
    const res = await fetch("../api/admin-delete-appointment.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest",
      },
      body: JSON.stringify({ id: id }),
    })

    const json = await res.json()
    if (!res.ok || !json.success) {
      throw new Error(json.errors ? json.errors.join(", ") : "Failed to delete")
    }

    closeDeleteConfirm()
    showNotification(`${icons.check} Appointment deleted successfully`, "success")
    await loadAppointments()
  } catch (err) {
    console.error("Error deleting appointment:", err)
    showNotification(`${icons.warning} ${err.message}`, "error")
  }
}

function formatDate(dateStr) {
  const date = new Date(dateStr + "T00:00:00")
  return date.toLocaleDateString("en-US", { weekday: "long", year: "numeric", month: "long", day: "numeric" })
}

function closeModal() {
  document.getElementById("modalOverlay").classList.remove("active")
  editingId = null
  currentStep = 1
}

function prevMonth() {
  currentDate.setMonth(currentDate.getMonth() - 1)
  loadAppointments()
}

function nextMonth() {
  currentDate.setMonth(currentDate.getMonth() + 1)
  loadAppointments()
}

function goToToday() {
  currentDate = new Date()
  loadAppointments()
}
function showNotification(message, type) {
  const notification = document.createElement("div")
  notification.className = `notification notification-${type} show`
  notification.innerHTML = message
  document.body.appendChild(notification)
  setTimeout(() => {
    notification.classList.remove("show")
    setTimeout(() => notification.remove(), 300)
  }, 3000)
}
function loadPatientInfo() {
  const select = document.getElementById("patientSelect")
  const selectedOption = select.options[select.selectedIndex]
  const phone = selectedOption.getAttribute("data-phone")
  if (phone) {
    document.getElementById("patientPhone").value = phone
  } else {
    document.getElementById("patientPhone").value = ""
  }
}

function updateProgressBar(step) {
  const steps = document.querySelectorAll('.progress-step')
  steps.forEach((stepEl, index) => {
    if (index < step) {
      stepEl.classList.add('active')
    } else {
      stepEl.classList.remove('active')
    }
  })
}

document.addEventListener("DOMContentLoaded", async () => {
  await loadPatientsList()
  await loadAppointments()
})
