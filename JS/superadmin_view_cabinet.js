const cabinetData = {
  id: "CAB-001",
  name: "Elite Medical Cabinet",
  logo: "/medical-cabinet-logo.jpg",
  status: "active",
  createdDate: "2023-06-15",
  location: {
    address: "esst medoffice, el achour, alger",
    latitude: 33.5731,
    longitude: -7.5898,
    city: "el achour",
  },
  schedule: {
    monday: "09:00 - 18:00",
    tuesday: "09:00 - 18:00",
    wednesday: "09:00 - 18:00",
    thursday: "09:00 - 18:00",
    friday: "09:00 - 18:00",
    saturday: "10:00 - 14:00",
    sunday: "Closed",
  },
  specialties: {
    primary: "General Medicine",
    secondary: ["Cardiology", "Pediatrics"],
    services: ["Consultation", "Diagnostic", "Emergency Care", "Vaccination"],
  },
  priceRange: {
    min: 200,
    max: 800,
    currency: "MAD",
  },
  admin: {
    name: "Dr. John Pork",
    email: "jhon.pork@medoffice.com",
    phone: "0549873283",
    joinDate: "2023-06-15",
  },
}

document.addEventListener("DOMContentLoaded", () => {
  loadCabinetData()
  updateMapLocation()
})

function loadCabinetData() {
  document.getElementById("cabinetName").textContent = cabinetData.name
  document.getElementById("cabinetId").textContent = cabinetData.id
  document.getElementById("cabinetStatus").textContent =
    cabinetData.status.charAt(0).toUpperCase() + cabinetData.status.slice(1)
  document.getElementById("cabinetCreatedDate").textContent = new Date(cabinetData.createdDate).toLocaleDateString(
    "en-US",
    { year: "numeric", month: "long", day: "numeric" },
  )
  document.getElementById("cabinetLogo").src = cabinetData.logo

  document.getElementById("cabinetAddress").textContent = cabinetData.location.address

  const scheduleContainer = document.querySelector(".schedule-grid")
  scheduleContainer.innerHTML = ""
  Object.entries(cabinetData.schedule).forEach(([day, hours]) => {
    const scheduleItem = document.createElement("div")
    scheduleItem.className = "schedule-item"
    scheduleItem.innerHTML = `
            <span class="schedule-day">${day.charAt(0).toUpperCase() + day.slice(1)}</span>
            <span class="schedule-hours ${hours === "Closed" ? "closed" : ""}">${hours}</span>
        `
    scheduleContainer.appendChild(scheduleItem)
  })

  document.getElementById("priceMin").textContent = `${cabinetData.priceRange.min} ${cabinetData.priceRange.currency}`
  document.getElementById("priceMax").textContent = `${cabinetData.priceRange.max} ${cabinetData.priceRange.currency}`
  document.getElementById("priceAverage").textContent =
    `${Math.round((cabinetData.priceRange.min + cabinetData.priceRange.max) / 2)} ${cabinetData.priceRange.currency}`

  document.getElementById("primarySpecialty").textContent = cabinetData.specialties.primary
  document.getElementById("secondarySpecialties").textContent = cabinetData.specialties.secondary.join(", ")

  const servicesContainer = document.querySelector(".services-tags")
  servicesContainer.innerHTML = ""
  cabinetData.specialties.services.forEach((service) => {
    const tag = document.createElement("span")
    tag.className = "service-tag"
    tag.textContent = service
    servicesContainer.appendChild(tag)
  })

  document.getElementById("adminName").textContent = cabinetData.admin.name
  document.getElementById("adminEmail").textContent = cabinetData.admin.email
  document.getElementById("adminPhone").textContent = cabinetData.admin.phone
  document.getElementById("adminJoinDate").textContent = new Date(cabinetData.admin.joinDate).toLocaleDateString(
    "en-US",
    { year: "numeric", month: "long", day: "numeric" },
  )
}

function updateMapLocation() {
  const mapFrame = document.getElementById("cabinetMap")
  const lat = cabinetData.location.latitude
  const lng = cabinetData.location.longitude

  // For now, we'll use OpenStreetMap as it doesn't require API key
  mapFrame.src = `https://www.openstreetmap.org/export/embed.html?bbox=${lng - 0.01},${lat - 0.01},${lng + 0.01},${lat + 0.01}&layer=mapnik&marker=${lat},${lng}`
}

function openInMaps() {
  const lat = cabinetData.location.latitude
  const lng = cabinetData.location.longitude
  window.open(`https://www.google.com/maps/search/?api=1&query=${lat},${lng}`, "_blank")
}

function copyCoordinates() {
  const lat = cabinetData.location.latitude
  const lng = cabinetData.location.longitude
  const coords = `${lat}, ${lng}`

  navigator.clipboard.writeText(coords).then(() => {
    const btn = event.target.closest("button")
    const originalText = btn.innerHTML
    btn.innerHTML = `
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 6px;">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            Copied!
        `
    btn.style.background = "var(--success)"

    setTimeout(() => {
      btn.innerHTML = originalText
      btn.style.background = ""
    }, 2000)
  })
}

function goBack() {
  window.history.back()
}
