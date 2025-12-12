function openModal(modalId) {
  document.getElementById(modalId).style.display = "block"
}

function closeModal(modalId) {
  document.getElementById(modalId).style.display = "none"
}

function viewCabinet(id, cabinetId) {
  document.getElementById("viewCabinetId").textContent = cabinetId
  document.getElementById("viewLocation").textContent = "Building A - Floor 1"
  document.getElementById("viewType").textContent = "Standard"
  document.getElementById("viewCapacity").textContent = "25/30"
  document.getElementById("viewStatus").textContent = "Active"
  openModal("viewCabinetModal")
}

function editCabinet(id, cabinetId, location, type, capacity) {
  document.getElementById("editCabinetDbId").value = id
  document.getElementById("editCabinetId").value = cabinetId
  document.getElementById("editLocation").value = location
  document.getElementById("editType").value = type
  document.getElementById("editCapacity").value = capacity
  openModal("editCabinetModal")
}

function archiveCabinet(id, cabinetId) {
  document.getElementById("archiveCabinetId").textContent = cabinetId
  document.getElementById("archiveCabinetDbId").value = id
  openModal("archiveCabinetModal")
}

function handleEditCabinet(event) {
  event.preventDefault()
  const formData = new FormData(event.target)
  console.log("Edit cabinet:", Object.fromEntries(formData))
  closeModal("editCabinetModal")
  showToast("Cabinet updated successfully!", "success")
}

function handleArchiveCabinet() {
  const cabinetId = document.getElementById("archiveCabinetDbId").value
  console.log("Archive cabinet:", cabinetId)
  closeModal("archiveCabinetModal")
  showToast("Cabinet archived successfully!", "success")
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
