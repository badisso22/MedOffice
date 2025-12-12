function toggleActionMenu(button) {
  const menu = button.nextElementSibling
  const allMenus = document.querySelectorAll(".action-menu")

  allMenus.forEach((m) => {
    if (m !== menu) {
      m.classList.remove("active")
    }
  })

  menu.classList.toggle("active")
}

document.addEventListener("click", (e) => {
  if (!e.target.closest(".action-dropdown")) {
    document.querySelectorAll(".action-menu").forEach((menu) => {
      menu.classList.remove("active")
    })
  }
})

function openUnarchiveUserModal(id, fullName) {
  document.getElementById("unarchiveUserId").value = id
  document.getElementById("unarchiveUserName").textContent = fullName
  openModal("unarchiveUserModal")
}

function closeUnarchiveUserModal() {
  closeModal("unarchiveUserModal")
}

function handleUnarchiveUser() {
  const userId = document.getElementById("unarchiveUserId").value
  console.log("Unarchive user:", userId)
  showToast("User unarchived successfully!", "success")
  closeUnarchiveUserModal()
}

function showToast(message, type = "success", duration = 3000) {
  const container = document.getElementById("toastContainer")

  const toast = document.createElement("div")
  toast.className = `toast ${type}`

  const icons = {
    success: "✓",
    error: "✕",
    info: "ℹ",
  }

  toast.innerHTML = `
        <div class="toast-icon">${icons[type]}</div>
        <div class="toast-content">${message}</div>
        <button class="toast-close" onclick="this.parentElement.remove()">×</button>
    `

  container.appendChild(toast)

  if (duration) {
    setTimeout(() => {
      toast.classList.add("removing")
      setTimeout(() => toast.remove(), 300)
    }, duration)
  }
}

function openModal(modalId) {
  document.getElementById(modalId).classList.add("active")
}

function closeModal(modalId) {
  document.getElementById(modalId).classList.remove("active")
}
