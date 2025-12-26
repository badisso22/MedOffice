document.addEventListener("DOMContentLoaded", () => {
  const isArchivedPage = window.location.pathname.indexOf("archived_users.php") !== -1
  fetchAdmins(isArchivedPage ? 1 : 0)

  if (!isArchivedPage) {
    loadCabinets()
  }
})

function fetchAdmins(archived) {
  const tbody = document.getElementById("usersTableBody")
  tbody.innerHTML = `
        <tr><td colspan="7" style="text-align:center;">Loading admins...</td></tr>
    `

  const xhr = new XMLHttpRequest()
  xhr.open("GET", "../api/superadmin-get-admins.php?archived=" + encodeURIComponent(archived), true)
  xhr.onreadystatechange = () => {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        try {
          const res = JSON.parse(xhr.responseText)
          renderAdmins(res.data || [], archived)
        } catch (e) {
          tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;color:red;">Error parsing response</td></tr>`
        }
      } else {
        tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;color:red;">Failed to load admins</td></tr>`
      }
    }
  }
  xhr.send()
}

function renderAdmins(admins, archived) {
  const tbody = document.getElementById("usersTableBody")
  if (!admins.length) {
    tbody.innerHTML = `
            <tr>
                <td colspan="7" style="text-align:center; padding: 1.5rem; color: #666;">
                    ${
                      archived
                        ? "There are currently no archived admin users. Active admins will appear here once archived."
                        : "No active admin users found."
                    }
                </td>
            </tr>
        `
    return
  }

  tbody.innerHTML = ""

  admins.forEach((admin) => {
    const tr = document.createElement("tr")

    const statusClass =
      admin.status === "active" ? "badge active" : admin.status === "suspended" ? "badge inactive" : "badge inactive"

    const lastLoginText = admin.last_login ? admin.last_login : "Never"

    const userCode = "USR-" + String(admin.userID).padStart(3, "0")

    let actionsHtml
    if (!archived) {
      actionsHtml = `
                <div class="action-buttons-large">
                    <a href="view_user.php?id=${encodeURIComponent(admin.userID)}" class="action-btn-large">View</a>
                    <button class="action-btn-large"
                        onclick="openEditUserModal('${admin.userID}', '${escapeForAttr(admin.fullName)}', '${escapeForAttr(admin.email)}', '${escapeForAttr(admin.cabinet || "")}')">
                        Edit
                    </button>
                    <button class="action-btn-large danger"
                        onclick="openArchiveUserModal('${admin.userID}', '${escapeForAttr(admin.fullName)}')">
                        Archive
                    </button>
                </div>
            `
    } else {
      actionsHtml = `
                <div class="action-buttons-large">
                    <a href="view_user.php?id=${encodeURIComponent(admin.userID)}" class="action-btn-large">View</a>
                    <button class="action-btn-large success"
                        onclick="openRestoreUserModal('${admin.userID}', '${escapeForAttr(admin.fullName)}')">
                        Restore
                    </button>
                </div>
            `
    }

    tr.innerHTML = `
            <td>${userCode}</td>
            <td>${escapeHtml(admin.fullName)}</td>
            <td>${escapeHtml(admin.email)}</td>
            <td>${escapeHtml(admin.cabinet || "—")}</td>
            <td><span class="${statusClass}">${escapeHtml(admin.status)}</span></td>
            <td>${escapeHtml(lastLoginText)}</td>
            <td>${actionsHtml}</td>
        `

    tbody.appendChild(tr)
  })
}

function loadCabinets() {
  const select = document.getElementById("addCabinet")
  if (!select) return

  const xhr = new XMLHttpRequest()
  xhr.open("GET", "../api/superadmin-get-cabinets.php", true)
  xhr.onreadystatechange = () => {
    if (xhr.readyState === 4 && xhr.status === 200) {
      try {
        const res = JSON.parse(xhr.responseText)
        const cabinets = res.data || []

        select.innerHTML = '<option value="">Select Cabinet</option>'
        cabinets.forEach((cabinet) => {
          const option = document.createElement("option")
          option.value = cabinet.cabinetID
          option.textContent = cabinet.cabinetname
          select.appendChild(option)
        })
      } catch (e) {
        console.error("Error loading cabinets:", e)
      }
    }
  }
  xhr.send()
}

function handleArchiveUser() {
  const userId = document.getElementById("archiveUserId").value

  if (!userId) {
    showToast("error", "Invalid user ID")
    return
  }

  const formData = new FormData()
  formData.append("userId", userId)

  const xhr = new XMLHttpRequest()
  xhr.open("POST", "../api/superadmin-archive-user.php", true)
  xhr.onreadystatechange = () => {
    if (xhr.readyState === 4) {
      try {
        const res = JSON.parse(xhr.responseText)
        if (xhr.status === 200 && res.status === "success") {
          showToast("success", res.message || "User archived successfully")
          closeArchiveUserModal()
          fetchAdmins(0)
        } else {
          showToast("error", res.message || "Failed to archive user")
        }
      } catch (e) {
        showToast("error", "Error processing response")
      }
    }
  }
  xhr.send(formData)
}

function handleAddUser(event) {
  event.preventDefault()

  const fullName = document.getElementById("addFullName").value.trim()
  const email = document.getElementById("addEmail").value.trim()
  const password = document.getElementById("addPassword").value
  const cabinetID = document.getElementById("addCabinet").value

  if (!fullName || !email || !password || !cabinetID) {
    showToast("error", "All fields are required")
    return
  }

  const formData = new FormData()
  formData.append("fullName", fullName)
  formData.append("email", email)
  formData.append("password", password)
  formData.append("cabinetID", cabinetID)

  const xhr = new XMLHttpRequest()
  xhr.open("POST", "../api/superadmin-add-admin.php", true)
  xhr.onreadystatechange = () => {
    if (xhr.readyState === 4) {
      try {
        const res = JSON.parse(xhr.responseText)
        if (xhr.status === 200 && res.status === "success") {
          showToast("success", res.message || "Admin user created successfully")
          closeAddUserModal()
          document.getElementById("addUserForm").reset()
          fetchAdmins(0)
        } else {
          showToast("error", res.message || "Failed to create admin user")
        }
      } catch (e) {
        showToast("error", "Error processing response")
      }
    }
  }
  xhr.send(formData)
}

function handleRestoreUser() {
  const userId = document.getElementById("restoreUserId").value

  if (!userId) {
    showToast("error", "Invalid user ID")
    return
  }

  const formData = new FormData()
  formData.append("userId", userId)

  const xhr = new XMLHttpRequest()
  xhr.open("POST", "../api/superadmin-restore-user.php", true)
  xhr.onreadystatechange = () => {
    if (xhr.readyState === 4) {
      try {
        const res = JSON.parse(xhr.responseText)
        if (xhr.status === 200 && res.status === "success") {
          showToast("success", res.message || "User restored successfully")
          closeRestoreUserModal()
          fetchAdmins(1)
        } else {
          showToast("error", res.message || "Failed to restore user")
        }
      } catch (e) {
        showToast("error", "Error processing response")
      }
    }
  }
  xhr.send(formData)
}

function openAddUserModal() {
  document.getElementById("addUserModal").style.display = "flex"
}

function closeAddUserModal() {
  document.getElementById("addUserModal").style.display = "none"
}

function openEditUserModal(userId, fullName, email, cabinet) {
  document.getElementById("editUserId").value = userId
  document.getElementById("editFullName").value = fullName
  document.getElementById("editEmail").value = email
  document.getElementById("editCabinet").value = cabinet
  document.getElementById("editUserModal").style.display = "flex"
}

function closeEditUserModal() {
  document.getElementById("editUserModal").style.display = "none"
}

function openArchiveUserModal(userId, fullName) {
  document.getElementById("archiveUserId").value = userId
  document.getElementById("archiveUserName").textContent = fullName
  document.getElementById("archiveUserModal").style.display = "flex"
}

function closeArchiveUserModal() {
  document.getElementById("archiveUserModal").style.display = "none"
}

function openRestoreUserModal(userId, fullName) {
  document.getElementById("restoreUserId").value = userId
  document.getElementById("restoreUserName").textContent = fullName
  document.getElementById("restoreUserModal").style.display = "flex"
}

function closeRestoreUserModal() {
  document.getElementById("restoreUserModal").style.display = "none"
}

function escapeHtml(str) {
  if (!str) return ""
  return String(str)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;")
}

function escapeForAttr(str) {
  if (!str) return ""
  return String(str).replace(/\\/g, "\\\\").replace(/'/g, "\\'").replace(/"/g, "&quot;").replace(/\n/g, " ")
}

function showToast(type, message) {
  const container = document.getElementById("toastContainer")
  if (!container) return

  const toast = document.createElement("div")
  toast.className = `toast toast-${type}`
  toast.textContent = message
  toast.style.cssText = `
        padding: 1rem 1.5rem;
        margin-bottom: 0.75rem;
        border-radius: 8px;
        font-weight: 500;
        animation: slideIn 0.3s ease-out;
    `

  if (type === "success") {
    toast.style.background = "#10b981"
    toast.style.color = "white"
  } else if (type === "error") {
    toast.style.background = "#ef4444"
    toast.style.color = "white"
  }

  container.appendChild(toast)

  setTimeout(() => {
    toast.style.animation = "slideOut 0.3s ease-out"
    setTimeout(() => toast.remove(), 300)
  }, 3000)
}
