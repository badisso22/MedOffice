function openArchiveModal() {
  const modal = document.getElementById("archiveModal")
  modal.classList.add("active")
}
function closeArchiveModal() {
  const modal = document.getElementById("archiveModal")
  modal.classList.remove("active")
}
function confirmArchive() {
  closeArchiveModal()
  const successModal = document.getElementById("successModal")
  successModal.classList.add("active")
}
function closeSuccessModal() {
  const modal = document.getElementById("successModal")
  modal.classList.remove("active")
}
document.addEventListener("click", (event) => {
  const archiveModal = document.getElementById("archiveModal")
  const successModal = document.getElementById("successModal")

  if (event.target === archiveModal) {
    closeArchiveModal()
  }
  if (event.target === successModal) {
    closeSuccessModal()
  }
})
document.addEventListener("keydown", (event) => {
  if (event.key === "Escape") {
    closeArchiveModal()
    closeSuccessModal()
  }
})
