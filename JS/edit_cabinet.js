let currentEditField = {}

function openEditModal(fieldId, fieldTitle, fieldValue, fieldType) {
  currentEditField = {
    id: fieldId,
    title: fieldTitle,
    value: fieldValue,
    type: fieldType,
  }

  document.getElementById("modalTitle").textContent = `Edit ${fieldTitle}`
  const inputContainer = document.getElementById("inputContainer")
  inputContainer.innerHTML = ""
  if (fieldType === "textarea") {
    const textarea = document.createElement("textarea")
    textarea.id = "editInput"
    textarea.value = fieldValue
    textarea.className = "modal-input"
    textarea.rows = 4
    textarea.placeholder = `Enter ${fieldTitle}`
    inputContainer.appendChild(textarea)
  } else if (fieldType === "select") {
    const select = document.createElement("select")
    select.id = "editInput"
    select.className = "modal-input"

    const options = [
      { value: "active", label: "Active" },
      { value: "inactive", label: "Inactive" },
      { value: "maintenance", label: "Maintenance" },
    ]

    options.forEach((opt) => {
      const option = document.createElement("option")
      option.value = opt.value
      option.textContent = opt.label
      option.selected = opt.value === fieldValue
      select.appendChild(option)
    })

    inputContainer.appendChild(select)
  } else {
    const input = document.createElement("input")
    input.id = "editInput"
    input.type = fieldType
    input.value = fieldValue
    input.className = "modal-input"
    input.placeholder = `Enter ${fieldTitle}`
    inputContainer.appendChild(input)
  }

  document.getElementById("editModal").classList.add("active")
}

function closeEditModal() {
  document.getElementById("editModal").classList.remove("active")
  currentEditField = {}
}

function saveEdit() {
  const inputElement = document.getElementById("editInput")
  const newValue = inputElement.value

  if (!newValue.trim()) {
    alert("Please enter a value")
    return
  }
  closeEditModal()

  document.getElementById("successMessage").textContent = `${currentEditField.title} updated successfully`
  document.getElementById("successModal").classList.add("active")

  console.log(`[v0] Field ${currentEditField.id} updated to:`, newValue)
}

function closeSuccessModal() {
  document.getElementById("successModal").classList.remove("active")
  currentEditField = {}
}

document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") {
    closeEditModal()
    closeSuccessModal()
  }
})

document.getElementById("editModal").addEventListener("click", function (e) {
  if (e.target === this) {
    closeEditModal()
  }
})

document.getElementById("successModal").addEventListener("click", function (e) {
  if (e.target === this) {
    closeSuccessModal()
  }
})
