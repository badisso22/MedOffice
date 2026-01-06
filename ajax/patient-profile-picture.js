console.log("[v0] patient-profile-picture.js loaded");

document.addEventListener("DOMContentLoaded", () => {
  const editAvatarBtn = document.getElementById("editAvatarBtn");
  const profilePictureInput = document.getElementById("profilePictureInput");

  if (editAvatarBtn && profilePictureInput) {
    editAvatarBtn.addEventListener("click", () => {
      profilePictureInput.click();
    });

    profilePictureInput.addEventListener("change", handleProfilePictureSelect);
  }
});

async function handleProfilePictureSelect(event) {
  const file = event.target.files[0];
  if (!file) return;

  console.log("File selected:", file.name, file.size);

  const maxSize = 5 * 1024 * 1024; 
  if (file.size > maxSize) {
    alert("File too large. Maximum size is 5MB");
    return;
  }

  const allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];
  if (!allowedTypes.includes(file.type)) {
    alert("Invalid file type. Only JPEG, PNG, GIF, and WebP are allowed");
    return;
  }

  const formData = new FormData();
  formData.append("profilePicture", file);

  try {
    console.log("Uploading profile picture...");
    const res = await fetch("../api/patient-upload-profile-picture.php", {
      method: "POST",
      body: formData,
    });

    console.log("[v0] Upload response status:", res.status);
    const json = await res.json();
    console.log("[v0] Upload response:", json);

    if (json.success) {
      const profileAvatar = document.getElementById("profileAvatar");

      profileAvatar.src ="/MedOffice/" + json.data.picturePath + "?t=" + Date.now();

      const loadPatientProfile = window.loadPatientProfile || (() => {});
      if (typeof loadPatientProfile === "function") {
        loadPatientProfile();
      }

      alert("Profile picture updated successfully!");
    } else {
      alert("Error uploading picture: " + (json.message || "Unknown error"));
    }
  } catch (err) {
    console.error("Upload error:", err);
    alert("Error uploading picture: " + err.message);
  }

  event.target.value = "";
}
