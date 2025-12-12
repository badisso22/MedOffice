let currentDate = new Date()
const appointments = {}
let editingId = null

const CABINET_NAME = "Central Medical Cabinet"

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
    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
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

function toggleDrawer() {
  document.getElementById("drawer").classList.toggle("open")
}

function logout() {
  if (confirm("Are you sure you want to logout?")) {
    window.location.href = "logout.php"
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
                 onclick="event.stopPropagation(); editAppointment('${dateKey}', '${apt.id}')">
              <div class="cal-apt-content">
                <div class="cal-apt-time">${icons.user} ${apt.patientName}</div>
                <div class="cal-apt-cabinet">${icons.clock} ${apt.time}</div>
                <div class="cal-apt-type">${apt.type}</div>
              </div>
              <button class="cal-apt-delete" onclick="event.stopPropagation(); confirmDelete('${dateKey}', '${apt.id}')">${icons.trash}</button>
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

function handleDayClick(event, date) {
  if (event.target.closest(".cal-apt-item") || event.target.closest(".cal-apt-delete")) {
    return
  }

  if (isDateInPast(date)) {
    showNotification(`${icons.warning} Cannot create appointments for past dates`, "error")
    return
  }

  openNewAppointment(date)
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

  document.getElementById("modalTitle").textContent = "New System Appointment"
  document.getElementById("patientSelect").value = ""
  document.getElementById("patientPhone").value = ""
  document.getElementById("appointmentDate").value = date
  document.getElementById("appointmentDate").min = getTodayDateString()
  document.getElementById("appointmentTime").value = ""
  document.getElementById("appointmentType").value = ""
  document.getElementById("notes").value = ""

  document.getElementById("modalOverlay").classList.add("active")
}

function editAppointment(date, id) {
  const apt = appointments[date].find((a) => a.id === id)
  if (!apt) return

  editingId = { date, id }

  document.getElementById("modalTitle").textContent = "Edit Appointment"
  document.getElementById("patientSelect").value = apt.patientId || ""
  document.getElementById("patientPhone").value = apt.patientPhone
  document.getElementById("appointmentDate").value = date
  document.getElementById("appointmentDate").min = getTodayDateString()
  document.getElementById("appointmentTime").value = apt.time
  document.getElementById("appointmentType").value = apt.type
  document.getElementById("notes").value = apt.notes || ""

  document.getElementById("modalOverlay").classList.add("active")
}

function saveAppointment() {
  const patientSelect = document.getElementById("patientSelect")
  const patientId = patientSelect.value
  const patientName = patientSelect.options[patientSelect.selectedIndex].text.split(" (ID:")[0]
  const patientPhone = document.getElementById("patientPhone").value
  const date = document.getElementById("appointmentDate").value
  const time = document.getElementById("appointmentTime").value
  const type = document.getElementById("appointmentType").value
  const notes = document.getElementById("notes").value

  if (!patientId || !patientPhone || !date || !time || !type) {
    showNotification(`${icons.warning} Please fill in all required fields`, "error")
    return
  }

  if (isDateInPast(date)) {
    showNotification(`${icons.warning} Cannot create appointments for past dates`, "error")
    return
  }

  if (editingId) {
    const { date: oldDate, id } = editingId
    const apt = appointments[oldDate].find((a) => a.id === id)

    if (apt) {
      appointments[oldDate] = appointments[oldDate].filter((a) => a.id !== id)
      if (appointments[oldDate].length === 0) delete appointments[oldDate]

      if (!appointments[date]) appointments[date] = []
      appointments[date].push({
        id: apt.id,
        patientId,
        patientName,
        patientPhone,
        time,
        cabinet: CABINET_NAME,
        type,
        notes,
      })

      appointments[date].sort((a, b) => a.time.localeCompare(b.time))
      showNotification(`${icons.check} Appointment updated successfully!`, "success")
    }
  } else {
    if (!appointments[date]) appointments[date] = []

    appointments[date].push({
      id: Date.now().toString() + Math.random().toString(36).substr(2, 9),
      patientId,
      patientName,
      patientPhone,
      time,
      cabinet: CABINET_NAME,
      type,
      notes,
    })

    appointments[date].sort((a, b) => a.time.localeCompare(b.time))
    showNotification(`${icons.check} Appointment booked successfully for ${patientName}!`, "success")
  }

  closeModal()
  renderCalendar()
  editingId = null
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
            <p style="margin: 0.25rem 0;"><strong>Patient:</strong> ${apt.patientName}</p>
            <p style="margin: 0.25rem 0;"><strong>Date:</strong> ${formatDate(date)}</p>
            <p style="margin: 0.25rem 0;"><strong>Time:</strong> ${apt.time}</p>
            <p style="margin: 0.25rem 0;"><strong>Type:</strong> ${apt.type}</p>
          </div>
          <p style="color: #ef4444; font-size: 0.9rem;">This action cannot be undone.</p>
        </div>
        <div class="modal-footer">
          <button class="btn-modal btn-modal-secondary" onclick="closeDeleteConfirm()">Cancel</button>
          <button class="btn-modal" style="background: #ef4444; color: white;" onclick="deleteAppointment('${date}', '${id}')">Delete Appointment</button>
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

function deleteAppointment(date, id) {
  appointments[date] = appointments[date].filter((a) => a.id !== id)
  if (appointments[date].length === 0) delete appointments[date]

  closeDeleteConfirm()
  renderCalendar()
  showNotification(`${icons.check} Appointment deleted successfully`, "success")
}

function formatDate(dateStr) {
  const date = new Date(dateStr + "T00:00:00")
  return date.toLocaleDateString("en-US", { weekday: "long", year: "numeric", month: "long", day: "numeric" })
}

function closeModal() {
  document.getElementById("modalOverlay").classList.remove("active")
  editingId = null
}

function prevMonth() {
  currentDate.setMonth(currentDate.getMonth() - 1)
  renderCalendar()
}

function nextMonth() {
  currentDate.setMonth(currentDate.getMonth() + 1)
  renderCalendar()
}

function goToToday() {
  currentDate = new Date()
  renderCalendar()
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
renderCalendar()
