function openUnarchiveModal(patientId, patientName, patientAge) {
  document.getElementById("modalPatientId").textContent = patientId
  document.getElementById("modalPatientName").textContent = patientName
  document.getElementById("modalPatientAge").textContent = patientAge
  document.getElementById("unarchiveModal").classList.add("active")
}

function closeUnarchiveModal() {
  document.getElementById("unarchiveModal").classList.remove("active")
}

function confirmUnarchive() {
  const patientId = document.getElementById("modalPatientId").textContent
  const patientName = document.getElementById("modalPatientName").textContent
  const patientAge = document.getElementById("modalPatientAge").textContent
  closeUnarchiveModal()

  document.getElementById("successPatientId").textContent = patientId
  document.getElementById("successPatientName").textContent = patientName
  document.getElementById("successPatientAge").textContent = patientAge
  document.getElementById("unarchiveSuccessModal").classList.add("active")
}

function closeSuccessModal() {
  document.getElementById("unarchiveSuccessModal").classList.remove("active")
}

document.getElementById("unarchiveModal").addEventListener("click", function (e) {
  if (e.target === this) {
    closeUnarchiveModal()
  }
})

document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") {
    closeUnarchiveModal()
    closeSuccessModal()
  }
})

document.getElementById("unarchiveSuccessModal").addEventListener("click", function (e) {
  if (e.target === this) {
    closeSuccessModal()
  }
})
