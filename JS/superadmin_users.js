function toggleActionMenu(button) {
  const menu = button.nextElementSibling;
  const allMenus = document.querySelectorAll(".action-menu");

  allMenus.forEach((m) => {
    if (m !== menu) {
      m.classList.remove("active");
    }
  });

  menu.classList.toggle("active");
}

document.addEventListener("click", (e) => {
  if (!e.target.closest(".action-dropdown")) {
    document.querySelectorAll(".action-menu").forEach((menu) => {
      menu.classList.remove("active");
    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const isArchivedPage = window.location.pathname.indexOf("archived_users.php") !== -1;
  fetchAdmins(isArchivedPage ? 1 : 0);
});

function fetchAdmins(archived) {
  const tbody = document.getElementById("usersTableBody");
  if (!tbody) return;

  tbody.innerHTML = `
    <tr>
      <td colspan="7" style="text-align:center; padding: 1.5rem;">Loading admins...</td>
    </tr>
  `;

  const xhr = new XMLHttpRequest();
  xhr.open("GET", "../api/superadmin-get-admins.php?archived=" + encodeURIComponent(archived), true);

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        try {
          const res = JSON.parse(xhr.responseText);
          renderAdmins(res.data || [], archived);
        } catch (e) {
          tbody.innerHTML = `
            <tr>
              <td colspan="7" style="text-align:center; padding: 1.5rem; color:red;">
                Error parsing server response.
              </td>
            </tr>
          `;
        }
      } else {
        tbody.innerHTML = `
          <tr>
            <td colspan="7" style="text-align:center; padding: 1.5rem; color:red;">
              Failed to load admins (HTTP ${xhr.status}).
            </td>
          </tr>
        `;
      }
    }
  };

  xhr.send();
}

function renderAdmins(admins, archived) {
  const tbody = document.getElementById("usersTableBody");
  if (!tbody) return;

  if (!admins.length) {
    tbody.innerHTML = `
      <tr>
        <td colspan="7" style="text-align:center; padding: 1.5rem; color:#666;">
          ${
            archived
              ? "There are currently no archived admin users. Active admins will appear here once archived."
              : "No active admin users found."
          }
        </td>
      </tr>
    `;
    return;
  }

  tbody.innerHTML = "";

  admins.forEach((admin) => {
    const tr = document.createElement("tr");

    const userCode = "USR-" + String(admin.userID).padStart(3, "0");
    const lastLoginText = admin.last_login || "Never";
    const statusClass =
      admin.status === "active"
        ? "badge active"
        : admin.status === "suspended"
        ? "badge inactive"
        : "badge inactive";

    let actionsHtml;
    if (!archived) {
      actionsHtml = `
        <div class="action-buttons-large">
          <a href="view_user.php?id=${encodeURIComponent(admin.userID)}" class="action-btn-large">View</a>
          <button class="action-btn-large"
            onclick="openEditUserModal(
              '${admin.userID}',
              '${escapeForAttr(admin.fullName)}',
              '${escapeForAttr(admin.email)}',
              '${escapeForAttr(admin.cabinet || "")}'
            )">
            Edit
          </button>
          <button class="action-btn-large danger"
            onclick="openArchiveUserModal(
              '${admin.userID}',
              '${escapeForAttr(admin.fullName)}'
            )">
            Archive
          </button>
        </div>
      `;
    } else {
      actionsHtml = `
        <div class="action-buttons-large">
          <a href="view_user.php?id=${encodeURIComponent(admin.userID)}" class="action-btn-large">View</a>
          <button class="action-btn-large"
            onclick="openRestoreUserModal(
              '${admin.userID}',
              '${escapeForAttr(admin.fullName)}'
            )">
            Restore
          </button>
        </div>
      `;
    }

    tr.innerHTML = `
      <td>${userCode}</td>
      <td>${escapeHtml(admin.fullName)}</td>
      <td>${escapeHtml(admin.email)}</td>
      <td>${escapeHtml(admin.cabinet || "—")}</td>
      <td><span class="${statusClass}">${escapeHtml(admin.status)}</span></td>
      <td>${escapeHtml(lastLoginText)}</td>
      <td>${actionsHtml}</td>
    `;

    tbody.appendChild(tr);
  });
}

function openAddUserModal() {
  openModal("addUserModal");
}

function closeAddUserModal() {
  closeModal("addUserModal");
}

function openEditUserModal(id, fullName, email, cabinet) {
  document.getElementById("editUserId").value = id;
  document.getElementById("editFullName").value = fullName;
  document.getElementById("editEmail").value = email;
  document.getElementById("editCabinet").value = cabinet;
  openModal("editUserModal");
}

function closeEditUserModal() {
  closeModal("editUserModal");
}

function openArchiveUserModal(id, fullName) {
  document.getElementById("archiveUserId").value = id;
  document.getElementById("archiveUserName").textContent = fullName;
  openModal("archiveUserModal");
}

function closeArchiveUserModal() {
  closeModal("archiveUserModal");
}

function openRestoreUserModal(id, fullName) {
  const modal = document.getElementById("restoreUserModal");
  if (!modal) {
    alert("Restore modal not implemented yet.");
    return;
  }
  document.getElementById("restoreUserId").value = id;
  document.getElementById("restoreUserName").textContent = fullName;
  openModal("restoreUserModal");
}

function closeRestoreUserModal() {
  closeModal("restoreUserModal");
}

function handleAddUser(event) {
  event.preventDefault();
  const formData = new FormData(event.target);
  const userData = Object.fromEntries(formData);

  console.log("Adding new admin user:", userData);
  showToast("Admin user added successfully!", "success");
  closeAddUserModal();
  event.target.reset();
}

function handleEditUser(event) {
  event.preventDefault();
  const formData = new FormData(event.target);
  console.log("Edit user:", Object.fromEntries(formData));
  showToast("User updated successfully!", "success");
  closeEditUserModal();
}

function handleArchiveUser() {
  const userId = document.getElementById("archiveUserId").value;
  if (!userId) {
    showToast("Invalid user ID.", "error");
    return;
  }

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../api/superadmin-archive-user.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        try {
          const res = JSON.parse(xhr.responseText);
          if (res.status === "success") {
            showToast(res.message || "User archived successfully!", "success");
            closeArchiveUserModal();
            fetchAdmins(0); 
          } else {
            showToast(res.message || "Failed to archive user.", "error");
          }
        } catch (e) {
          showToast("Error parsing server response.", "error");
        }
      } else {
        showToast("Server error while archiving user.", "error");
      }
    }
  };

  xhr.send("userId=" + encodeURIComponent(userId));
}

function showToast(message, type = "success", duration = 3000) {
  const container = document.getElementById("toastContainer");
  if (!container) return;

  const toast = document.createElement("div");
  toast.className = `toast ${type}`;

  const icons = {
    success: "✓",
    error: "✕",
    info: "ℹ",
  };

  toast.innerHTML = `
    <div class="toast-icon">${icons[type] || ""}</div>
    <div class="toast-content">${message}</div>
    <button class="toast-close" onclick="this.parentElement.remove()">×</button>
  `;

  container.appendChild(toast);

  if (duration) {
    setTimeout(() => {
      toast.classList.add("removing");
      setTimeout(() => toast.remove(), 300);
    }, duration);
  }
}

function openModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) modal.classList.add("active");
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) modal.classList.remove("active");
}

function escapeHtml(str) {
  if (!str) return "";
  return String(str)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;");
}

function escapeForAttr(str) {
  if (!str) return "";
  return String(str)
    .replace(/\\/g, "\\\\")
    .replace(/'/g, "\\'")
    .replace(/"/g, "&quot;")
    .replace(/\n/g, " ");
}
