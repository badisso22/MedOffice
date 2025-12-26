console.log("calendarPatient.js loaded")

let currentDate = new Date()
let appointments = {}
let selectedCabinet = null
let selectedDoctor = null 
let selectedSlotTime = null
let allCabinets = []
let currentStep = 0

const icons = {
  clock: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>`,
  warning: `<svg width="20" height="20" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
              <line x1="12" y1="9" x2="12" y2="13"></line>
              <line x1="12" y1="17" x2="12.01" y2="17"></line>
            </svg>`,
  plus: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
           <line x1="12" y1="5" x2="12" y2="19"></line>
           <line x1="5" y1="12" x2="19" y2="12"></line>
         </svg>`,
  location: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
              <circle cx="12" cy="10" r="3"></circle>
            </svg>`,
  phone: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
          </svg>`,
  check: `<svg width="18" height="18" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>`,
}

function escapeHtml(str) {
  if (!str) return ""
  return String(str)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#39;")
}

function isDateInPast(dateString) {
  const selectedDate = new Date(dateString + "T00:00:00")
  const today = new Date()
  today.setHours(0, 0, 0, 0)
  return selectedDate < today
}

function getTodayDateString() {
  const today = new Date()
  return (
    today.getFullYear() +
    "-" +
    String(today.getMonth() + 1).padStart(2, "0") +
    "-" +
    String(today.getDate()).padStart(2, "0")
  )
}

function formatDateShort(dateStr) {
  const date = new Date(dateStr + "T00:00:00")
  return date.toLocaleDateString("en-US", {
    month: "short",
    day: "numeric",
    year: "numeric",
  })
}

function formatTime12Hour(hour, minute) {
  const period = hour >= 12 ? "PM" : "AM"
  let displayHour = hour % 12
  if (displayHour === 0) displayHour = 12
  return displayHour + ":" + String(minute).padStart(2, "0") + " " + period
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


async function loadAppointments() {
  const month = currentDate.getMonth() + 1
  const year = currentDate.getFullYear()
  appointments = {}

  try {
    const res = await fetch(`../api/patient-get-calendar-appointments.php?month=${month}&year=${year}`, {
      headers: { "X-Requested-With": "XMLHttpRequest" },
    })
    const json = await res.json()

    if (json.success && Array.isArray(json.appointments)) {
      json.appointments.forEach((apt) => {
        if (!appointments[apt.date]) appointments[apt.date] = []
        appointments[apt.date].push(apt)
      })
    }
    renderCalendar()
  } catch (err) {
    console.error("Error loading appointments", err)
  }
}


function renderCalendar() {
  const year = currentDate.getFullYear()
  const month = currentDate.getMonth()

  const header = document.getElementById("monthYear")
  if (header) {
    header.textContent = currentDate.toLocaleDateString("en-US", {
      month: "long",
      year: "numeric",
    })
  }

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
    html += `<div class="cal-day-cell empty"></div>`
  }

  for (let day = 1; day <= totalDays; day++) {
    const dateKey = year + "-" + String(month + 1).padStart(2, "0") + "-" + String(day).padStart(2, "0")
    const cellDate = new Date(year, month, day)
    const isPast = cellDate < today
    const isToday = isCurrentMonth && day === todayDate
    const dayApts = appointments[dateKey] || []

    const classes = ["cal-day-cell"]
    if (isToday) classes.push("today")
    if (dayApts.length > 0) classes.push("has-appointments")
    if (isPast) classes.push("past-date")

    html += `<div class="${classes.join(" ")}" data-date="${dateKey}" onclick="handleDayClick(event, '${dateKey}')">`
    html += `<div class="cal-day-number">${day}</div>`

    if (dayApts.length > 0) {
      html += `<div class="cal-appointments">`
      html += dayApts
        .map((apt) => {
          const color = getColor(apt.type)
          return `<div class="cal-apt-item" style="background-color:${color};">
                  <div class="cal-apt-content">
                    <div class="cal-apt-time">${icons.clock} ${escapeHtml(apt.time)}</div>
                    <div class="cal-apt-type">${escapeHtml(apt.type || "")}</div>
                  </div>
                </div>`
        })
        .join("")
      html += `</div>`
    } else if (!isPast) {
      html += `<div class="cal-add-hint">${icons.plus} Add</div>`
    }

    html += `</div>`
  }

  const daysContainer = document.getElementById("calendarDays")
  if (daysContainer) daysContainer.innerHTML = html
}


function handleDayClick(event, date) {
  if (isDateInPast(date)) {
    showNotification(icons.warning + " Cannot book for past dates", "error")
    return
  }
  openNewAppointment(date)
}


function openNewAppointment(date) {
  selectedCabinet = null
  selectedDoctor = null
  selectedSlotTime = null

  const dateInput = document.getElementById("appointmentDate")
  if (dateInput) {
    dateInput.value = date
    dateInput.min = getTodayDateString()
  }

  const timeInput = document.getElementById("appointmentTime")
  const typeSelect = document.getElementById("appointmentType")
  const doctorInput = document.getElementById("appointmentDoctor")
  const cabinetInput = document.getElementById("appointmentCabinet")
  const notesInput = document.getElementById("notes")

  if (timeInput) timeInput.value = ""
  if (typeSelect) typeSelect.value = ""
  if (doctorInput) doctorInput.value = ""
  if (cabinetInput) cabinetInput.value = ""
  if (notesInput) notesInput.value = ""

  const cabInfo = document.getElementById("cabinetSelectedInfo")
  const docInfo = document.getElementById("doctorSelectedInfo")
  const cabSearch = document.getElementById("cabinetSearch")
  const cabList = document.getElementById("cabinetList")
  const docsContainer = document.getElementById("doctorsContainer")
  const slotsContainer = document.getElementById("timeSlotsContainer")

  if (cabInfo) cabInfo.style.display = "none"
  if (docInfo) docInfo.style.display = "none"
  if (cabSearch) cabSearch.value = ""
  if (cabList) cabList.innerHTML = ""
  if (docsContainer) docsContainer.innerHTML = ""
  if (slotsContainer) slotsContainer.innerHTML = ""

  goToStep(0)

  const overlay = document.getElementById("modalOverlay")
  if (overlay) overlay.classList.add("active")

  loadCabinets()
}

function closeModal() {
  const overlay = document.getElementById("modalOverlay")
  if (overlay) overlay.classList.remove("active")
  currentStep = 0
}


function goToStep(step) {
  console.log("goToStep", step)
  currentStep = step

  for (let i = 0; i <= 5; i++) {
    const s = document.getElementById("step" + i)
    if (s) s.classList.remove("active")
  }
  const resultStep = document.getElementById("resultStep")
  if (resultStep) resultStep.classList.remove("active")

  if (step >= 0 && step <= 5) {
    const active = document.getElementById("step" + step)
    if (active) active.classList.add("active")
  } else if (step === 6 && resultStep) {
    resultStep.classList.add("active")
  }

  const titles = [
    "Step 1: Select Cabinet", 
    "Step 2: Select Doctor", 
    "Step 3: Choose Time", 
    "Step 4: Appointment Details", 
    "Step 5: Confirm", 
    "Booking...", 
    "Result", 
  ]
  const modalTitle = document.getElementById("modalTitle")
  if (modalTitle) modalTitle.textContent = titles[step] || "Appointment"

  const wizardFooter = document.getElementById("wizardFooter")
  const prevBtn = document.getElementById("prevBtn")
  const nextBtn = document.getElementById("nextBtn")
  if (!wizardFooter || !prevBtn || !nextBtn) return

  if (step === 0) {
    wizardFooter.style.display = "flex"
    prevBtn.style.display = "none"
    nextBtn.style.display = "inline-block"
    nextBtn.textContent = "Next →"
  } else if (step >= 1 && step <= 3) {
    wizardFooter.style.display = "flex"
    prevBtn.style.display = "inline-block"
    nextBtn.style.display = "inline-block"
    nextBtn.textContent = "Next →"
  } else if (step === 4) {
    wizardFooter.style.display = "flex"
    prevBtn.style.display = "inline-block"
    nextBtn.style.display = "inline-block"
    nextBtn.textContent = "Confirm & Book"
  } else if (step === 5 || step === 6) {
    wizardFooter.style.display = "none"
  }
}

function updateProgressBar(step) {
  const steps = document.querySelectorAll(".progress-step")
  steps.forEach((el, index) => {
    if (index <= step) el.classList.add("active")
    else el.classList.remove("active")
  })
}

function nextStep() {
  if (currentStep === 0) {
    if (!selectedCabinet) {
      showNotification(icons.warning + " Please select a cabinet", "error")
      return
    }
    goToStep(1)
    populateDoctorsGrid()
  } else if (currentStep === 1) {
    if (!selectedDoctor) {
      showNotification(icons.warning + " Please select a doctor", "error")
      return
    }
    goToStep(2)
    generateTimeSlots()
  } else if (currentStep === 2) {
    if (!selectedSlotTime) {
      showNotification(icons.warning + " Please select a time slot", "error")
      return
    }
    const timeInput = document.getElementById("appointmentTime")
    if (timeInput) timeInput.value = selectedSlotTime
    goToStep(3)
  } else if (currentStep === 3) {
    const typeInput = document.getElementById("appointmentType")
    if (!typeInput || !typeInput.value) {
      showNotification(icons.warning + " Please select appointment type", "error")
      return
    }
    goToStep(4)
    buildConfirmationSummary()
  } else if (currentStep === 4) {
    saveAppointment()
  }
}

function prevStep() {
  if (currentStep > 0 && currentStep <= 4) {
    goToStep(currentStep - 1)
  }
}


async function loadCabinets() {
  try {
    const res = await fetch("../api/patient-get-cabinets.php", {
      headers: { "X-Requested-With": "XMLHttpRequest" },
    })
    const json = await res.json()
    if (json.success && Array.isArray(json.data)) {
      allCabinets = json.data
    } else {
      allCabinets = []
    }
    searchCabinets()
  } catch (err) {
    console.error("Error loading cabinets:", err)
    allCabinets = []
  }
}

function searchCabinets() {
  const input = document.getElementById("cabinetSearch")
  const list = document.getElementById("cabinetList")
  if (!input || !list) return

  const query = input.value.toLowerCase().trim()
  const filtered = allCabinets.filter((cab) => {
    const name = (cab.name || "").toLowerCase()
    const location = (cab.location || "").toLowerCase()
    return name.includes(query) || location.includes(query)
  })

  if (filtered.length === 0) {
    list.innerHTML = '<div class="empty-state">No cabinets found</div>'
    return
  }

  list.innerHTML = filtered
    .map(
      (cabinet) => `
    <button type="button" class="cabinet-card" data-id="${cabinet.id}">
      <div class="cabinet-card-header">
        <div class="cabinet-avatar">${escapeHtml(cabinet.name.charAt(0).toUpperCase())}</div>
        <div class="cabinet-main">
          <div class="cabinet-name">${escapeHtml(cabinet.name)}</div>
          <div class="cabinet-location">${icons.location} ${escapeHtml(cabinet.location || "")}</div>
        </div>
      </div>
      <div class="cabinet-meta">
        <span class="cabinet-tag">Available doctors</span>
      </div>
    </button>
  `,
    )
    .join("")

  list.querySelectorAll(".cabinet-card").forEach((card) => {
    card.addEventListener("click", () => {
      const id = card.getAttribute("data-id")
      selectCabinet(id, card)
    })
  })
}

function selectCabinet(cabinetId, cardEl) {
  selectedCabinet = allCabinets.find((c) => String(c.id) === String(cabinetId))
  if (!selectedCabinet) return

  const cards = document.querySelectorAll(".cabinet-card")
  cards.forEach((c) => c.classList.remove("selected"))
  if (cardEl) cardEl.classList.add("selected")

  const info = document.getElementById("cabinetSelectedInfo")
  const input = document.getElementById("appointmentCabinet")

  if (info) {
    info.innerHTML = `
      <div class="selected-info selected-info-cabinet">
        <div class="selected-title">Selected Cabinet</div>
        <div class="selected-name">${escapeHtml(selectedCabinet.name)}</div>
        <div class="selected-location">${icons.location} ${escapeHtml(selectedCabinet.location || "")}</div>
      </div>
    `
    info.style.display = "block"
  }

  if (input) input.value = selectedCabinet.id
}


async function populateDoctorsGrid() {
  const container = document.getElementById("doctorsContainer")
  if (!selectedCabinet || !container) return

  container.innerHTML = '<div class="loading-small">Loading doctors...</div>'

  try {
    const res = await fetch(`../api/get-doctors.php?cabinet_id=${encodeURIComponent(selectedCabinet.id)}`, {
      headers: { "X-Requested-With": "XMLHttpRequest" },
    })
    const json = await res.json()

    if (!(json.success && Array.isArray(json.data) && json.data.length > 0)) {
      container.innerHTML = '<div class="empty-state">No doctors found for this cabinet</div>'
      return
    }

    const doctorMap = new Map()

    json.data.forEach((row) => {
      const id = row.doctorID
      if (!doctorMap.has(id)) {
        doctorMap.set(id, {
          id: id,
          name: `${row.firstName} ${row.lastName}`.trim(),
          specialty: row.specialty || "General",
          phone: row.phone || "",
          schedules: [],
        })
      }
      doctorMap.get(id).schedules.push({
        dayOfWeek: row.dayOfWeek,
        startTime: row.startTime,
        endTime: row.endTime,
      })
    })

    const doctors = Array.from(doctorMap.values())

    if (doctors.length === 0) {
      container.innerHTML = '<div class="empty-state">No doctors found for this cabinet</div>'
      return
    }

    container.innerHTML = doctors
      .map(
        (doc) => `
      <button class="doctor-card" type="button" data-id="${doc.id}">
        <div class="doctor-avatar">${escapeHtml(doc.name.charAt(0).toUpperCase())}</div>
        <div class="doctor-info">
          <div class="doctor-name">${escapeHtml(doc.name)}</div>
          <div class="doctor-specialty">${escapeHtml(doc.specialty)}</div>
          <div class="doctor-phone">${icons.phone} ${escapeHtml(doc.phone)}</div>
        </div>
      </button>
    `,
      )
      .join("")

    container.querySelectorAll(".doctor-card").forEach((card) => {
      card.addEventListener("click", () => {
        const id = card.getAttribute("data-id")
        selectDoctorFromList(id, card, doctors)
      })
    })
  } catch (err) {
    console.error("Error loading doctors:", err)
    container.innerHTML = '<div class="empty-state">Failed to load doctors</div>'
  }
}

function selectDoctorFromList(doctorId, cardEl, doctorsCache) {
  const cards = document.querySelectorAll(".doctor-card")
  cards.forEach((c) => c.classList.remove("selected"))
  if (cardEl) cardEl.classList.add("selected")

  const doc = doctorsCache.find((d) => String(d.id) === String(doctorId))
  if (!doc) return

  selectedDoctor = doc

  const info = document.getElementById("doctorSelectedInfo")
  const input = document.getElementById("appointmentDoctor")

  if (info) {
    info.innerHTML = `
      <div class="selected-info">
        <div class="selected-title">Selected Doctor</div>
        <div class="selected-name">${escapeHtml(doc.name)}</div>
        <div class="selected-specialty">${escapeHtml(doc.specialty)}</div>
        <div class="selected-phone">${icons.phone} ${escapeHtml(doc.phone)}</div>
      </div>
    `
    info.style.display = "block"
  }
  if (input) input.value = doc.id
}


function generateTimeSlots() {
  const dateInput = document.getElementById("appointmentDate")
  const container = document.getElementById("timeSlotsContainer")
  const dateDisplay = document.getElementById("selectedDateDisplay")

  if (!dateInput || !container) return
  const date = dateInput.value

  if (!date) {
    container.innerHTML = '<div class="empty-state">No date selected</div>'
    return
  }
  if (!selectedDoctor) {
    container.innerHTML = '<div class="empty-state">No doctor selected</div>'
    return
  }

  if (dateDisplay) dateDisplay.textContent = formatDateShort(date)

  const selectedDate = new Date(date + "T00:00:00")
  const weekdayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
  const dayName = weekdayNames[selectedDate.getDay()]

  const daySchedules = (selectedDoctor.schedules || []).filter((s) => s.dayOfWeek === dayName)

  if (daySchedules.length === 0) {
    container.innerHTML = '<div class="empty-state">Doctor is not available on this day</div>'
    return
  }

  function isInAnySchedule(timeStr) {
    const [h, m] = timeStr.split(":").map(Number)
    const minutes = h * 60 + m
    return daySchedules.some((s) => {
      const [sh, sm] = s.startTime.substring(0, 5).split(":").map(Number)
      const [eh, em] = s.endTime.substring(0, 5).split(":").map(Number)
      const startMin = sh * 60 + sm
      const endMin = eh * 60 + em
      return minutes >= startMin && minutes < endMin
    })
  }

  function isTimeSlotBooked(date, time) {
    const dayApts = appointments[date] || []
    return dayApts.some((apt) => apt.time === time)
  }

  function isTimeInPast(date, time) {
    const now = new Date()
    const slotDateTime = new Date(date + "T" + time)
    return slotDateTime <= now
  }

  const slots = []
  for (let hour = 8; hour <= 18; hour++) {
    for (let minute = 0; minute < 60; minute += 30) {
      const timeStr = String(hour).padStart(2, "0") + ":" + String(minute).padStart(2, "0")
      if (isInAnySchedule(timeStr)) slots.push(timeStr)
    }
  }

  if (slots.length === 0) {
    container.innerHTML = '<div class="empty-state">No available slots for this day</div>'
    return
  }

  container.innerHTML = slots
    .map((slot) => {
      const [h, m] = slot.split(":").map((n) => Number.parseInt(n, 10))
      const isBooked = isTimeSlotBooked(date, slot)
      const isPastTime = isTimeInPast(date, slot)
      const classes = ["time-slot"]
      if (isBooked) classes.push("booked")
      if (isPastTime) classes.push("past-time-slot")

      return `
      <div class="${classes.join(" ")}" data-time="${slot}" ${isBooked || isPastTime ? "disabled" : ""}>
        ${formatTime12Hour(h, m)}
      </div>
    `
    })
    .join("")

  const items = container.querySelectorAll(".time-slot:not(.booked):not(.past-time-slot)")
  items.forEach((item) => {
    item.addEventListener("click", () => {
      items.forEach((i) => i.classList.remove("selected"))
      item.classList.add("selected")
      selectedSlotTime = item.getAttribute("data-time")
    })
  })
}


function buildConfirmationSummary() {
  const dateInput = document.getElementById("appointmentDate")
  const timeInput = document.getElementById("appointmentTime")
  const typeInput = document.getElementById("appointmentType")
  const notesInput = document.getElementById("notes")
  const summary = document.getElementById("confirmationSummary")

  if (!dateInput || !timeInput || !typeInput || !summary) return

  const date = dateInput.value
  const time = timeInput.value
  const type = typeInput.value
  const notes = notesInput ? notesInput.value : ""

  const [h, m] = time.split(":").map((n) => Number.parseInt(n, 10))

  summary.innerHTML = `
    <div class="confirmation-item">
      <span class="label">Date:</span>
      <span class="value">${formatDateShort(date)}</span>
    </div>
    <div class="confirmation-item">
      <span class="label">Time:</span>
      <span class="value">${formatTime12Hour(h, m)}</span>
    </div>
    <div class="confirmation-item">
      <span class="label">Cabinet:</span>
      <span class="value">${escapeHtml(selectedCabinet ? selectedCabinet.name : "")}</span>
    </div>
    <div class="confirmation-item">
      <span class="label">Doctor:</span>
      <span class="value">${escapeHtml(selectedDoctor ? selectedDoctor.name : "")}</span>
    </div>
    <div class="confirmation-item">
      <span class="label">Type:</span>
      <span class="value">${escapeHtml(type)}</span>
    </div>
    ${
      notes
        ? `
      <div class="confirmation-item">
        <span class="label">Notes:</span>
        <span class="value">${escapeHtml(notes)}</span>
      </div>
    `
        : ""
    }
  `
}


async function saveAppointment() {
  console.log("saveAppointment called, currentStep =", currentStep)

  const date = document.getElementById("appointmentDate").value
  const time = document.getElementById("appointmentTime").value
  const type = document.getElementById("appointmentType").value
  const notes = document.getElementById("notes").value || ""

  const patientId = window.patientId || 0

  if (!patientId || !date || !time || !selectedCabinet || !selectedDoctor || !type) {
    console.log("validation failed", { patientId, date, time, selectedCabinet, selectedDoctor, type })
    showNotification(
      icons.warning + " Missing required information (patient, date, time, cabinet, doctor, type)",
      "error",
    )
    return
  }

  console.log("validation OK, going to step 5")
  goToStep(5)
  updateProgressBar(4)

  setTimeout(async () => {
    const payload = {
      patientId: patientId,
      date: date,
      time: time,
      type: type,
      doctorId: selectedDoctor.id,
      id: 0,
      notes: notes,
    }

    console.log("Booking payload:", payload)

    try {
      const res = await fetch("../api/admin-book-appointment.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-Requested-With": "XMLHttpRequest",
        },
        body: JSON.stringify(payload),
      })

      const json = await res.json()
      console.log("Booking response:", json)

      if (json.success) {
        goToStep(6)
        const msg = document.getElementById("resultMessage")
        const [h, m] = time.split(":").map((n) => Number.parseInt(n, 10))

        if (msg) {
          msg.innerHTML = `
            <div class="success-message">
              ${icons.check} Appointment booked successfully
            </div>
            <div class="result-details">
              <div>${formatDateShort(date)} at ${formatTime12Hour(h, m)}</div>
              <div>with Dr. ${escapeHtml(selectedDoctor.name || "")}</div>
              <div>at ${escapeHtml(selectedCabinet.name || "")}</div>
            </div>
          `
        }

        setTimeout(() => {
          loadAppointments()
          closeModal()
        }, 2500)
      } else {
        goToStep(4)
        const msg = json.errors && json.errors.length ? json.errors[0] : json.message || "Booking failed"
        showNotification(icons.warning + " " + msg, "error")
      }
    } catch (err) {
      console.error("Booking error:", err)
      goToStep(4)
      showNotification(icons.warning + " Network error. Please try again.", "error")
    }
  }, 3500)
}


function showNotification(message, type = "info") {
  const existing = document.querySelector(".notification")
  if (existing) existing.remove()

  const el = document.createElement("div")
  el.className = `notification ${type}`
  el.innerHTML = message
  document.body.appendChild(el)

  setTimeout(() => {
    el.classList.add("show")
  }, 50)

  setTimeout(() => {
    el.classList.remove("show")
    setTimeout(() => el.remove(), 300)
  }, 4000)
}


function prevMonth() {
  currentDate.setMonth(currentDate.getMonth() - 1)
  loadAppointments()
}

function nextMonth() {
  currentDate.setMonth(currentDate.getMonth() + 1)
  loadAppointments()
}

function today() {
  currentDate = new Date()
  loadAppointments()
}


document.addEventListener("DOMContentLoaded", () => {
  loadAppointments()

  const searchInput = document.getElementById("cabinetSearch")
  if (searchInput) {
    searchInput.addEventListener("input", searchCabinets)
  }

  const typeSelect = document.getElementById("appointmentType")
  if (typeSelect && typeSelect.options.length === 0) {
    const types = ["General Consultation", "Medical Follow-up", "Emergency", "Vaccination", "Test Results"]
    typeSelect.innerHTML =
      `<option value="">-- Select Type --</option>` +
      types.map((t) => `<option value="${escapeHtml(t)}">${escapeHtml(t)}</option>`).join("")
  }
})

document.addEventListener("click", (e) => {
  if (e.target.id === "nextBtn") nextStep()
  if (e.target.id === "prevBtn") prevStep()
  if (e.target.id === "closeModalBtn") closeModal()

  const overlay = document.getElementById("modalOverlay")
  if (overlay && e.target === overlay) {
    closeModal()
  }
})
