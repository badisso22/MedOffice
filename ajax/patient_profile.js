console.log("[v0] patient_profile.js loaded")

function escapeHtml(str) {
  if (!str) return ""
  return String(str)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#39;")
}

function formatDateShort(dateStr) {
  if (!dateStr) return "-"
  const d = new Date(dateStr)
  if (Number.isNaN(d.getTime())) return dateStr
  return d.toLocaleDateString("en-US", {
    month: "short",
    day: "numeric",
    year: "numeric",
  })
}

async function loadPatientProfile() {
  try {
    const res = await fetch("../api/patient-get-profile.php", {
      headers: { "X-Requested-With": "XMLHttpRequest" },
    })
    console.log("Profile response status:", res.status)

    const json = await res.json()
    console.log(" Profile response data:", json)

    if (!json.success || !json.data) {
      console.error("Profile load failed", json)
      return
    }

    const p = json.data
    const fullName = p.fullName || "Patient"

    let avatarUrl = ""
    if (p.profilePicture) {
      avatarUrl = "../uploads/profile-pictures/" + encodeURIComponent(p.profilePicture)
    } else {
      avatarUrl =
        "https://ui-avatars.com/api/?name=" + encodeURIComponent(fullName) + "&background=0891b2&color=fff&size=140"
    }

    document.getElementById("profileAvatar").src = avatarUrl
    document.getElementById("profileAvatar").alt = fullName

    document.getElementById("pfPatientId").textContent = p.userID ?? "-"
    document.getElementById("pfFullName").textContent = escapeHtml(p.fullName || "-")
    document.getElementById("pfEmail").textContent = escapeHtml(p.email || "-")
    document.getElementById("pfPhone").textContent = escapeHtml(p.phone || "-")
    document.getElementById("pfAddress").textContent = escapeHtml(p.address || "-")
    document.getElementById("pfUsername").textContent = escapeHtml(p.username || "-")
    document.getElementById("pfRegDate").textContent = formatDateShort(p.createdAt)

    setupProfilePictureUpload()
  } catch (err) {
    console.error("Error loading profile", err)
  }
}

function setupProfilePictureUpload() {
  const uploadBtn = document.getElementById("uploadProfilePictureBtn")
  const fileInput = document.getElementById("profilePictureInput")
  const deleteBtn = document.getElementById("deleteProfilePictureBtn")

  if (uploadBtn && fileInput) {
    uploadBtn.addEventListener("click", () => fileInput.click())
    fileInput.addEventListener("change", handleProfilePictureSelect)
  }

  if (deleteBtn) {
    deleteBtn.addEventListener("click", deleteProfilePicture)
  }
}

async function handleProfilePictureSelect(event) {
  const file = event.target.files[0]
  if (!file) return

  console.log("File selected:", file.name, file.size)

  const formData = new FormData()
  formData.append("profilePicture", file)

  try {
    const res = await fetch("../api/patient-upload-profile-picture.php", {
      method: "POST",
      body: formData,
    })

    const json = await res.json()
    console.log(" Upload response:", json)

    if (json.success) {
      loadPatientProfile()
    } else {
      alert("Error uploading picture: " + json.message)
    }
  } catch (err) {
    console.error("Upload error:", err)
    alert("Error uploading picture")
  }
}

async function deleteProfilePicture() {
  if (!confirm("Are you sure you want to delete your profile picture?")) return

  try {
    const res = await fetch("../api/patient-delete-profile-picture.php", {
      method: "POST",
    })

    const json = await res.json()
    console.log("Delete response:", json)

    if (json.success) {
      loadPatientProfile()
    } else {
      alert("Error deleting picture: " + json.message)
    }
  } catch (err) {
    console.error("Delete error:", err)
    alert("Error deleting picture")
  }
}

document.addEventListener("DOMContentLoaded", loadPatientProfile)
