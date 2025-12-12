function openUnarchiveModal() {
  const modal = document.getElementById("unarchiveModal")
  modal.classList.add("active")
}
function closeUnarchiveModal() {
  const modal = document.getElementById("unarchiveModal")
  modal.classList.remove("active")
}
function confirmUnarchive() {
  closeUnarchiveModal()
  const successModal = document.getElementById("unarchiveSuccessModal")
  successModal.classList.add("active")
}
function closeUnarchiveSuccessModal() {
  const modal = document.getElementById("unarchiveSuccessModal")
  modal.classList.remove("active")
}
document.addEventListener("click", (event) => {
  const unarchiveModal = document.getElementById("unarchiveModal")
  const successModal = document.getElementById("unarchiveSuccessModal")

  if (event.target === unarchiveModal) {
    closeUnarchiveModal()
  }
  if (event.target === successModal) {
    closeUnarchiveSuccessModal()
  }
})
document.addEventListener("keydown", (event) => {
  if (event.key === "Escape") {
    closeUnarchiveModal()
    closeUnarchiveSuccessModal()
  }
})
