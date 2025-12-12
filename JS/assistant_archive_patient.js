function openArchiveModal(patientId, patientName, patientAge) {
  document.getElementById("modalPatientId").textContent = patientId
  document.getElementById("modalPatientName").textContent = patientName
  document.getElementById("modalPatientAge").textContent = patientAge
  document.getElementById("archiveModal").classList.add("active")
}

function closeArchiveModal() {
  document.getElementById("archiveModal").classList.remove("active")
}

function confirmArchive() {
  const patientId = document.getElementById("modalPatientId").textContent
  const patientName = document.getElementById("modalPatientName").textContent
  const patientAge = document.getElementById("modalPatientAge").textContent
  closeArchiveModal()

  document.getElementById("successPatientId").textContent = patientId
  document.getElementById("successPatientName").textContent = patientName
  document.getElementById("successPatientAge").textContent = patientAge
  document.getElementById("successModal").classList.add("active")
}
function closeSuccessModal() {
  document.getElementById("successModal").classList.remove("active")
}
document.getElementById("archiveModal").addEventListener("click", function (e) {
  if (e.target === this) {
    closeArchiveModal()
  }
})
document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") {
    closeArchiveModal()
    closeSuccessModal()
  }
})
document.getElementById("successModal").addEventListener("click", function (e) {
  if (e.target === this) {
    closeSuccessModal()
  }
})
