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
  document.getElementById("successModal").classList.add("active")
}

function closeSuccessModal() {
  document.getElementById("successModal").classList.remove("active")
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

document.getElementById("successModal").addEventListener("click", function (e) {
  if (e.target === this) {
    closeSuccessModal()
  }
})
