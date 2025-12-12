function openUnarchiveModal(assistantId, assistantName, assistantAge) {
  document.getElementById("modalAssistantId").textContent = assistantId
  document.getElementById("modalAssistantName").textContent = assistantName
  document.getElementById("modalAssistantAge").textContent = assistantAge
  document.getElementById("unarchiveModal").classList.add("active")
}

function closeUnarchiveModal() {
  document.getElementById("unarchiveModal").classList.remove("active")
}

function confirmUnarchive() {
  const assistantId = document.getElementById("modalAssistantId").textContent
  const assistantName = document.getElementById("modalAssistantName").textContent
  const assistantAge = document.getElementById("modalAssistantAge").textContent
  closeUnarchiveModal()

  document.getElementById("successAssistantId").textContent = assistantId
  document.getElementById("successAssistantName").textContent = assistantName
  document.getElementById("successAssistantAge").textContent = assistantAge
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