let currentDate = new Date();
let appointments = {};
let editingId = null;
let tempData = null;
const icons = {
  clock: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <circle cx="12" cy="12" r="10"></circle>
    <polyline points="12 6 12 12 16 14"></polyline>
  </svg>`,

  hospital: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M12 2L2 7v10c0 5.5 3.84 7.66 10 9 6.16-1.34 10-3.5 10-9V7l-10-5z"></path>
    <line x1="12" y1="11" x2="12" y2="17"></line>
    <line x1="9" y1="14" x2="15" y2="14"></line>
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

  location: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
    <circle cx="12" cy="10" r="3"></circle>
  </svg>`,

  phone: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
  </svg>`,

  star: `<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
  </svg>`,

  arrowRight: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <line x1="5" y1="12" x2="19" y2="12"></line>
    <polyline points="12 5 19 12 12 19"></polyline>
  </svg>`,

  cross: `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <line x1="18" y1="6" x2="6" y2="18"></line>
    <line x1="6" y1="6" x2="18" y2="18"></line>
  </svg>`,

  lock: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
  </svg>`,
};
function isDateInPast(dateString) {
  const selectedDate = new Date(dateString + "T00:00:00");
  const today = new Date();
  today.setHours(0, 0, 0, 0);
  return selectedDate < today;
}

function getTodayDateString() {
  const today = new Date();
  return `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(
    2,
    "0"
  )}-${String(today.getDate()).padStart(2, "0")}`;
}
function toggleDrawer() {
  document.getElementById("drawer").classList.toggle("open");
}

function logout() {
  if (confirm("Are you sure you want to logout?")) {
    window.location.href = "logout.php";
  }
}
function renderCalendar() {
  const year = currentDate.getFullYear();
  const month = currentDate.getMonth();
  document.getElementById("monthYear").textContent =
    currentDate.toLocaleDateString("en-US", { month: "long", year: "numeric" });

  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  const startDay = (firstDay.getDay() + 6) % 7; // Monday = 0
  const totalDays = lastDay.getDate();

  const today = new Date();
  today.setHours(0, 0, 0, 0);
  const isCurrentMonth =
    today.getMonth() === month && today.getFullYear() === year;
  const todayDate = today.getDate();

  let html = "";
  for (let i = 0; i < startDay; i++) {
    html += '<div class="cal-day-cell empty"></div>';
  }
  for (let day = 1; day <= totalDays; day++) {
    const dateKey = `${year}-${String(month + 1).padStart(2, "0")}-${String(
      day
    ).padStart(2, "0")}`;
    const cellDate = new Date(year, month, day);
    const isPast = cellDate < today;
    const isToday = isCurrentMonth && day === todayDate;
    const dayApts = appointments[dateKey] || [];

    html += `
      <div class="cal-day-cell ${isToday ? "today" : ""} ${
      dayApts.length > 0 ? "has-appointments" : ""
    } ${isPast ? "past-date" : ""}" 
           data-date="${dateKey}"
           onclick="${isPast ? "" : `handleDayClick(event, '${dateKey}')`}">
        <div class="cal-day-number">${day}</div>
        ${isPast ? `<div class="past-indicator">${icons.lock}</div>` : ""}
        <div class="cal-appointments">
          ${dayApts
            .map((apt) => {
              const escapedCabinet = apt.cabinet.replace(/'/g, "\\'");
              return `
            <div class="cal-apt-item" 
                 style="background-color: ${getColor(apt.type)};"
                 onclick="event.stopPropagation(); editAppointment('${dateKey}', '${
                apt.id
              }')">
              <div class="cal-apt-content">
                <div class="cal-apt-time">${icons.clock} ${apt.time}</div>
                <div class="cal-apt-cabinet">${
                  icons.hospital
                } ${escapedCabinet}</div>
                <div class="cal-apt-type">${apt.type}</div>
              </div>
              <button class="cal-apt-delete" onclick="event.stopPropagation(); confirmDelete('${dateKey}', '${
                apt.id
              }')">${icons.trash}</button>
            </div>
          `;
            })
            .join("")}
        </div>
        ${
          dayApts.length === 0 && !isPast
            ? `<div class="cal-add-hint">${icons.plus} Add</div>`
            : ""
        }
      </div>
    `;
  }
  document.getElementById("calendarDays").innerHTML = html;
}

function handleDayClick(event, date) {
  if (
    event.target.closest(".cal-apt-item") ||
    event.target.closest(".cal-apt-delete")
  ) {
    return;
  }
  if (isDateInPast(date)) {
    showNotification(
      `${icons.warning} Cannot create appointments for past dates`,
      "error"
    );
    return;
  }

  openNewAppointment(date);
}

function getColor(type) {
  const colors = {
    "General Consultation": "#3b82f6",
    "Medical Follow-up": "#10b981",
    Emergency: "#ef4444",
    Vaccination: "#8b5cf6",
    "Test Results": "#f59e0b",
  };
  return colors[type] || "#6b7280";
}
function openNewAppointment(date) {
  if (isDateInPast(date)) {
    showNotification(
      `${icons.warning} Cannot create appointments for past dates`,
      "error"
    );
    return;
  }

  editingId = null;
  tempData = null;

  document.getElementById("modalTitle").textContent = "New Appointment";
  document.getElementById("appointmentDate").value = date;
  document.getElementById("appointmentDate").min = getTodayDateString();
  document.getElementById("appointmentTime").value = "";
  document.getElementById("appointmentType").value = "";
  document.getElementById("notes").value = "";

  document.getElementById("findCabinetsBtn").textContent =
    "Find Available Cabinets";
  document.getElementById("modalOverlay").classList.add("active");
}

function editAppointment(date, id) {
  const apt = appointments[date].find((a) => a.id === id);
  if (!apt) return;

  editingId = { date, id };

  document.getElementById("modalTitle").textContent = "Edit Appointment";
  document.getElementById("appointmentDate").value = date;
  document.getElementById("appointmentDate").min = getTodayDateString();
  document.getElementById("appointmentTime").value = apt.time;
  document.getElementById("appointmentType").value = apt.type;
  document.getElementById("notes").value = apt.notes || "";
  tempData = {
    cabinet: apt.cabinet,
    date: date,
    time: apt.time,
    type: apt.type,
    notes: apt.notes || "",
  };

  document.getElementById("findCabinetsBtn").textContent =
    "Update & Change Cabinet";
  document.getElementById("modalOverlay").classList.add("active");
}

function confirmDelete(date, id) {
  const apt = appointments[date].find((a) => a.id === id);
  if (!apt) return;
  const confirmHtml = `
    <div class="modal-overlay active" id="deleteConfirmOverlay" style="z-index: 3000;">
      <div class="modal" style="max-width: 400px;">
        <div class="modal-header" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
          <h3>${icons.warning} Confirm Delete</h3>
          <button class="modal-close" onclick="closeDeleteConfirm()">${
            icons.cross
          }</button>
        </div>
        <div class="modal-body">
          <p style="margin-bottom: 1rem; color: #374151;">Are you sure you want to delete this appointment?</p>
          <div style="background: #f9fafb; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
            <p style="margin: 0.25rem 0;"><strong>Date:</strong> ${formatDate(
              date
            )}</p>
            <p style="margin: 0.25rem 0;"><strong>Time:</strong> ${apt.time}</p>
            <p style="margin: 0.25rem 0;"><strong>Cabinet:</strong> ${
              apt.cabinet
            }</p>
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
  `;

  document.body.insertAdjacentHTML("beforeend", confirmHtml);
}

function closeDeleteConfirm() {
  const overlay = document.getElementById("deleteConfirmOverlay");
  if (overlay) {
    overlay.remove();
  }
}

function deleteAppointment(date, id) {
  appointments[date] = appointments[date].filter((a) => a.id !== id);
  if (appointments[date].length === 0) {
    delete appointments[date];
  }

  closeDeleteConfirm();
  renderCalendar();
  showNotification(
    `${icons.check} Appointment deleted successfully`,
    "success"
  );
}

function formatDate(dateStr) {
  const date = new Date(dateStr + "T00:00:00");
  return date.toLocaleDateString("en-US", {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  });
}

function closeModal() {
  document.getElementById("modalOverlay").classList.remove("active");
  editingId = null;
}

function closeCabinetModal() {
  document.getElementById("cabinetModalOverlay").classList.remove("active");
}

function backToAppointmentForm() {
  closeCabinetModal();
  document.getElementById("modalOverlay").classList.add("active");
  if (tempData) {
    document.getElementById("appointmentDate").value = tempData.date;
    document.getElementById("appointmentDate").min = getTodayDateString();
    document.getElementById("appointmentTime").value = tempData.time;
    document.getElementById("appointmentType").value = tempData.type;
    document.getElementById("notes").value = tempData.notes || "";
  }
}
function searchAvailableCabinets() {
  const date = document.getElementById("appointmentDate").value;
  const time = document.getElementById("appointmentTime").value;
  const type = document.getElementById("appointmentType").value;
  const notes = document.getElementById("notes").value;

  if (!date || !time || !type) {
    showNotification(
      `${icons.warning} Please fill in Date, Time, and Appointment Type`,
      "error"
    );
    return;
  }
  if (isDateInPast(date)) {
    showNotification(
      `${icons.warning} Cannot create appointments for past dates`,
      "error"
    );
    return;
  }
  tempData = { date, time, type, notes };
  if (editingId) {
    tempData.editingId = editingId;
  }

  console.log("Stored tempData:", tempData);
  closeModal();
  document.getElementById("cabinetModalOverlay").classList.add("active");
  document.getElementById("cabinetResults").innerHTML = `
    <div class="loading-state">
      <div class="spinner"></div>
      <p>Searching for available cabinets...</p>
    </div>
  `;
  setTimeout(() => {
    const cabinets = getCabinets(date, time, type);
    displayCabinets(cabinets);
  }, 1500);
}

function getCabinets(date, time, type) {
  return [
    {
      id: 1,
      name: "Central Medical Cabinet",
      address: "123 Main Street, Algiers",
      distance: "2.5 km",
      phone: "+213 21 12 34 56",
      rating: "4.8",
    },
    {
      id: 2,
      name: "North Health Center",
      address: "456 Avenue de la Liberté, Algiers",
      distance: "4.8 km",
      phone: "+213 21 98 76 54",
      rating: "4.6",
    },
    {
      id: 3,
      name: "East Medical Clinic",
      address: "789 Rue des Frères, Algiers",
      distance: "6.2 km",
      phone: "+213 21 55 66 77",
      rating: "4.7",
    },
    {
      id: 4,
      name: "West Family Practice",
      address: "321 Boulevard Mohamed V, Algiers",
      distance: "7.1 km",
      phone: "+213 21 44 33 22",
      rating: "4.5",
    },
  ];
}

function displayCabinets(cabinets) {
  if (cabinets.length === 0) {
    document.getElementById("cabinetResults").innerHTML = `
      <div class="no-results">
        <p style="font-size: 3rem; margin-bottom: 1rem;">${icons.cross}</p>
        <p style="font-size: 1.2rem; font-weight: 600; color: #1f2937;">No available cabinets found</p>
        <p>Please try a different date or time</p>
      </div>
    `;
    return;
  }

  const container = document.getElementById("cabinetResults");
  container.innerHTML = "";

  const grid = document.createElement("div");
  grid.className = "cabinet-grid";

  cabinets.forEach((cab) => {
    const card = document.createElement("div");
    card.className = "cabinet-card";

    card.innerHTML = `
      <div class="cabinet-header">
        <h4>${icons.hospital} ${cab.name}</h4>
        <span class="cabinet-distance">${icons.location} ${cab.distance}</span>
      </div>
      <div class="cabinet-info">
        <p class="cabinet-address">${icons.location} ${cab.address}</p>
        <p class="cabinet-phone">${icons.phone} ${cab.phone}</p>
        ${
          cab.rating
            ? `<p class="cabinet-rating">${icons.star} ${cab.rating}/5.0</p>`
            : ""
        }
      </div>
      <button class="btn-select-cabinet" type="button">
        Select This Cabinet ${icons.arrowRight}
      </button>
    `;
    const button = card.querySelector(".btn-select-cabinet");
    button.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      console.log("Button clicked for:", cab.name);
      selectCabinet(cab.name);
    });

    grid.appendChild(card);
  });

  container.appendChild(grid);
}

function selectCabinet(cabinetName) {
  console.log("selectCabinet called with:", cabinetName);
  console.log("tempData:", tempData);

  if (!tempData) {
    console.error("No tempData available!");
    showNotification(
      `${icons.warning} Error: Please select date and time first`,
      "error"
    );
    return;
  }

  const { date, time, type, notes, editingId: editInfo } = tempData;
  if (isDateInPast(date)) {
    showNotification(
      `${icons.warning} Cannot create appointments for past dates`,
      "error"
    );
    closeCabinetModal();
    return;
  }
  if (editInfo) {
    console.log("Updating appointment with new cabinet:", cabinetName);
    updateAppointmentWithCabinet(
      date,
      time,
      type,
      notes,
      cabinetName,
      editInfo
    );
    return;
  }
  console.log("Creating appointment:", {
    date,
    time,
    type,
    notes,
    cabinetName,
  });

  if (!appointments[date]) {
    appointments[date] = [];
  }

  const newAppointment = {
    id: Date.now().toString() + Math.random().toString(36).substr(2, 9),
    time,
    cabinet: cabinetName,
    type,
    notes,
  };

  appointments[date].push(newAppointment);
  console.log("Appointments after adding:", appointments);
  appointments[date].sort((a, b) => a.time.localeCompare(b.time));

  closeCabinetModal();
  renderCalendar();
  showNotification(
    `${icons.check} Appointment booked successfully at ${cabinetName}!`,
    "success"
  );
  setTimeout(() => {
    const dayCell = document.querySelector(`[data-date="${date}"]`);
    if (dayCell) {
      dayCell.scrollIntoView({ behavior: "smooth", block: "center" });
      dayCell.style.animation = "pulse 1s ease-in-out";
      setTimeout(() => {
        dayCell.style.animation = "";
      }, 1000);
    }
  }, 300);

  tempData = null;
  editingId = null;
}
function updateAppointmentWithCabinet(
  date,
  time,
  type,
  notes,
  cabinetName,
  editInfo
) {
  const { date: oldDate, id } = editInfo;
  const apt = appointments[oldDate].find((a) => a.id === id);

  if (!apt) return;
  if (isDateInPast(date)) {
    showNotification(
      `${icons.warning} Cannot move appointments to past dates`,
      "error"
    );
    closeCabinetModal();
    return;
  }
  appointments[oldDate] = appointments[oldDate].filter((a) => a.id !== id);
  if (appointments[oldDate].length === 0) {
    delete appointments[oldDate];
  }
  if (!appointments[date]) {
    appointments[date] = [];
  }

  appointments[date].push({
    id: apt.id,
    time,
    cabinet: cabinetName,
    type,
    notes,
  });
  appointments[date].sort((a, b) => a.time.localeCompare(b.time));

  closeCabinetModal();
  renderCalendar();
  showNotification(
    `${icons.check} Appointment updated successfully with new cabinet: ${cabinetName}!`,
    "success"
  );
  setTimeout(() => {
    const dayCell = document.querySelector(`[data-date="${date}"]`);
    if (dayCell) {
      dayCell.scrollIntoView({ behavior: "smooth", block: "center" });
      dayCell.style.animation = "pulse 1s ease-in-out";
    }
  }, 300);

  editingId = null;
  tempData = null;
}
function prevMonth() {
  currentDate.setMonth(currentDate.getMonth() - 1);
  renderCalendar();
}

function nextMonth() {
  currentDate.setMonth(currentDate.getMonth() + 1);
  renderCalendar();
}

function goToToday() {
  currentDate = new Date();
  renderCalendar();
  setTimeout(() => {
    const today = new Date();
    const dateKey = `${today.getFullYear()}-${String(
      today.getMonth() + 1
    ).padStart(2, "0")}-${String(today.getDate()).padStart(2, "0")}`;
    const todayCell = document.querySelector(`[data-date="${dateKey}"]`);
    if (todayCell) {
      todayCell.scrollIntoView({ behavior: "smooth", block: "center" });
    }
  }, 100);
}
function showNotification(message, type = "success") {
  const notif = document.createElement("div");
  notif.className = `notification notification-${type}`;
  notif.innerHTML = message;
  document.body.appendChild(notif);

  setTimeout(() => notif.classList.add("show"), 100);
  setTimeout(() => {
    notif.classList.remove("show");
    setTimeout(() => notif.remove(), 300);
  }, 3000);
}
document.addEventListener("DOMContentLoaded", function () {
  console.log("Calendar script loaded successfully");
  const dateInput = document.getElementById("appointmentDate");
  if (dateInput) {
    dateInput.min = getTodayDateString();
  }

  renderCalendar();
  document
    .getElementById("modalOverlay")
    .addEventListener("click", function (e) {
      if (e.target === this) closeModal();
    });

  document
    .getElementById("cabinetModalOverlay")
    .addEventListener("click", function (e) {
      if (e.target === this) closeCabinetModal();
    });
});
