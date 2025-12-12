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

function openAddUserModal() {
  openModal("addUserModal")
}

function closeAddUserModal() {
  closeModal("addUserModal")
}

function openEditUserModal(id, fullName, email, cabinet) {
  document.getElementById("editUserId").value = id
  document.getElementById("editFullName").value = fullName
  document.getElementById("editEmail").value = email
  document.getElementById("editCabinet").value = cabinet
  openModal("editUserModal")
}

function closeEditUserModal() {
  closeModal("editUserModal")
}

function openArchiveUserModal(id, fullName) {
  document.getElementById("archiveUserId").value = id
  document.getElementById("archiveUserName").textContent = fullName
  openModal("archiveUserModal")
}

function closeArchiveUserModal() {
  closeModal("archiveUserModal")
}

function handleAddUser(event) {
  event.preventDefault()
  const formData = new FormData(event.target)
  const userData = Object.fromEntries(formData)

  console.log("Adding new admin user:", userData)
  showToast("Admin user added successfully!", "success")
  closeAddUserModal()
  event.target.reset()
}

function handleEditUser(event) {
  event.preventDefault()
  const formData = new FormData(event.target)
  console.log("Edit user:", Object.fromEntries(formData))
  showToast("User updated successfully!", "success")
  closeEditUserModal()
}

function handleArchiveUser() {
  const userId = document.getElementById("archiveUserId").value
  console.log("Archive user:", userId)
  showToast("User archived successfully!", "success")
  closeArchiveUserModal()
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
