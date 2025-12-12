function viewCabinet(id, cabinetId) {
  document.getElementById("viewCabinetId").textContent = cabinetId
  document.getElementById("viewLocation").textContent = "Building C - Lobby"
  document.getElementById("viewType").textContent = "Premium"
  document.getElementById("viewCapacity").textContent = "0/25"
  openModal("viewCabinetModal")
}

function unarchiveCabinet(id, cabinetId) {
  document.getElementById("unarchiveCabinetId").textContent = cabinetId
  document.getElementById("unarchiveCabinetDbId").value = id
  openModal("unarchiveCabinetModal")
}

function handleUnarchiveCabinet() {
  const cabinetId = document.getElementById("unarchiveCabinetDbId").value
  const reason = document.getElementById("unarchiveReason").value
  console.log("[v0] Unarchive cabinet:", cabinetId, "Reason:", reason)
  closeModal("unarchiveCabinetModal")
  showToast("Cabinet unarchived successfully!", "success")
}

function showToast(message, type) {
  const toast = document.createElement("div")
  toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        background: ${type === "success" ? "var(--success)" : "var(--danger)"};
        color: white;
        border-radius: 8px;
        z-index: 9999;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        font-size: 0.9rem;
    `
  toast.textContent = message
  document.body.appendChild(toast)
  setTimeout(() => toast.remove(), 3000)
}

function openModal(modalId) {
  document.getElementById(modalId).style.display = "block"
}

function closeModal(modalId) {
  document.getElementById(modalId).style.display = "none"
}
