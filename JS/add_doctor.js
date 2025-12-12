// Toggle drawer menu
function toggleDrawer() {
  const drawer = document.getElementById("drawer")
  const overlay = document.getElementById("drawerOverlay")
  drawer.classList.toggle("open")
  overlay.classList.toggle("active")
}

// Toggle password visibility
function togglePassword() {
  const passwordInput = document.getElementById("pass")
  const type = passwordInput.getAttribute("type") === "password" ? "text" : "password"
  passwordInput.setAttribute("type", type)
}

// Handle file input
document.addEventListener("DOMContentLoaded", () => {
  const fileInput = document.getElementById("credentials")
  const fileInputLabel = document.querySelector(".file-input-label")
  const fileName = document.getElementById("fileName")

  if (fileInputLabel) {
    fileInputLabel.addEventListener("click", () => {
      fileInput.click()
    })

    // Drag and drop
    fileInputLabel.addEventListener("dragover", (e) => {
      e.preventDefault()
      fileInputLabel.style.borderColor = "var(--primary)"
      fileInputLabel.style.background = "rgba(8, 145, 178, 0.1)"
    })

    fileInputLabel.addEventListener("dragleave", () => {
      fileInputLabel.style.borderColor = "var(--border)"
      fileInputLabel.style.background = "var(--bg-light)"
    })

    fileInputLabel.addEventListener("drop", (e) => {
      e.preventDefault()
      fileInputLabel.style.borderColor = "var(--border)"
      fileInputLabel.style.background = "var(--bg-light)"
      fileInput.files = e.dataTransfer.files
      updateFileName()
    })
  }

  if (fileInput) {
    fileInput.addEventListener("change", updateFileName)
  }
})

function updateFileName() {
  const fileInput = document.getElementById("credentials")
  const fileName = document.getElementById("fileName")
  if (fileInput && fileInput.files && fileInput.files[0]) {
    fileName.textContent = "✓ " + fileInput.files[0].name + " (" + formatFileSize(fileInput.files[0].size) + ")"
    fileName.style.color = "var(--accent)"
  }
}

function formatFileSize(bytes) {
  if (bytes === 0) return "0 Bytes"
  const k = 1024
  const sizes = ["Bytes", "KB", "MB"]
  const i = Math.floor(Math.log(bytes) / Math.log(k))
  return Math.round((bytes / Math.pow(k, i)) * 100) / 100 + " " + sizes[i]
}

// Toggle day schedule
function toggleDay(checkbox, dayId) {
  const dayTimes = document.getElementById(dayId)
  if (checkbox.checked) {
    dayTimes.style.display = "flex"
  } else {
    dayTimes.style.display = "none"
  }
}

// Reset form
function resetForm() {
  document.getElementById("form1").reset()
  document.getElementById("fileName").textContent = ""
}

// Validate form step 1
function validateStep1() {
  const form = document.getElementById("form1")
  const formData = new FormData(form)

  // Check required fields
  const requiredFields = [
    "firstName",
    "lastName",
    "dob",
    "gender",
    "addr",
    "phone",
    "specialty",
    "joinDate",
    "yearsExp",
    "licenseNo",
    "username",
    "email",
    "pass",
  ]

  for (const field of requiredFields) {
    const input = form.elements[field]
    if (!input || !input.value.trim()) {
      alert(`Please fill in the ${field} field`)
      input?.focus()
      return false
    }
  }

  // Check if file is uploaded
  const fileInput = document.getElementById("credentials")
  if (!fileInput.files || fileInput.files.length === 0) {
    alert("Please upload your credentials/degrees file")
    return false
  }

  return true
}

// Proceed to step 2 with loading screen
function proceedToStep2() {
  if (!validateStep1()) {
    return
  }

  const step1 = document.getElementById("step1")
  const loadingScreen = document.getElementById("loadingScreen")
  const step2 = document.getElementById("step2")

  // Hide step 1 and show loading screen
  step1.classList.remove("active")
  step1.classList.add("hidden")
  loadingScreen.classList.remove("hidden")

  // Simulate processing time (2 seconds)
  setTimeout(() => {
    loadingScreen.classList.add("hidden")
    step2.classList.remove("hidden")
    step2.classList.add("active")

    // Scroll to top
    window.scrollTo({ top: 0, behavior: "smooth" })
  }, 2000)
}

// Back to step 1
function backToStep1() {
  const step2 = document.getElementById("step2")
  const loadingScreen = document.getElementById("loadingScreen")
  const step1 = document.getElementById("step1")

  step2.classList.remove("active")
  step2.classList.add("hidden")
  loadingScreen.classList.remove("hidden")

  setTimeout(() => {
    loadingScreen.classList.add("hidden")
    step1.classList.remove("hidden")
    step1.classList.add("active")

    window.scrollTo({ top: 0, behavior: "smooth" })
  }, 1500)
}

// Validate step 2
function validateStep2() {
  const form = document.getElementById("form2")

  // Check if at least one day is selected
  const dayCheckboxes = form.querySelectorAll(".day-toggle")
  let atLeastOneDay = false

  for (const checkbox of dayCheckboxes) {
    if (checkbox.checked) {
      atLeastOneDay = true
      const dayId = checkbox.id + "Times"
      const dayTimes = document.getElementById(dayId)
      const startTime = dayTimes.querySelector(".start-time").value
      const endTime = dayTimes.querySelector(".end-time").value

      if (!startTime || !endTime) {
        alert(`Please set start and end time for ${checkbox.id}`)
        return false
      }
    }
  }

  if (!atLeastOneDay) {
    alert("Please select at least one working day")
    return false
  }

  // Check consultation duration
  const duration = form.elements["consultationDuration"].value
  if (!duration) {
    alert("Please select consultation duration")
    return false
  }

  // Check max appointments
  const maxAppt = form.elements["maxAppointments"].value
  if (!maxAppt || maxAppt < 1) {
    alert("Please enter maximum appointments per day")
    return false
  }

  return true
}

// Submit form
function submitForm(event) {
  event.preventDefault()

  if (!validateStep2()) {
    return
  }

  // Collect all form data
  const form1Data = new FormData(document.getElementById("form1"))
  const form2Data = new FormData(document.getElementById("form2"))

  // Log the combined data (in a real app, this would be sent to a server)
  console.log("[v0] Doctor Registration Complete")
  console.log("Step 1 Data:", Object.fromEntries(form1Data))
  console.log("Step 2 Data:", Object.fromEntries(form2Data))

  // Show success message and redirect to doctor's list
  alert("Doctor registration completed successfully! Doctor profile has been created.")
  window.location.href = 'searchD.php'
}
