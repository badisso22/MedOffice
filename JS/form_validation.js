;(() => {
  const patterns = {
    email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
    phone: /^\d{10}$/, 
    name: /^[a-zA-Z\s\-']+$/,
    username: /^[a-zA-Z0-9_]+$/,
    password: /.{6,}/, 
  }

  const messages = {
    required: "This field is required",
    email: "Please enter a valid email address",
    phone: "Please enter a valid phone number", 
    name: "Please enter a valid name",
    username: "Username can only contain letters, numbers, and underscores",
    password: "Password must be at least 6 characters",
    match: "Fields do not match",
  }
  function initFormValidation(formSelector = "form") {
    const forms = document.querySelectorAll(formSelector)

    forms.forEach((form) => {
      form.setAttribute("novalidate", "true")
      const inputs = form.querySelectorAll("input, select, textarea")
      inputs.forEach((input) => {
        input.addEventListener("input", function () {
          validateField(this)
        })
        input.addEventListener("blur", function () {
          validateField(this)
        })
        protectRequiredAttribute(input)
      })
      form.addEventListener("submit", function (e) {
        e.preventDefault()

        if (validateForm(form)) {
          showSuccessMessage(form)
          this.submit()
        } else {
          showErrorMessage(form)
          const firstError = form.querySelector(".error")
          if (firstError) {
            firstError.focus()
          }
        }
      })
    })
  }
  function validateField(field) {
    if (field.disabled) return true
    const value = field.value.trim()
    const type = field.type
    const isRequired = field.hasAttribute("required") || field.required
    removeError(field)
    if (isRequired && !value) {
      addError(field, messages.required)
      return false
    }
    if (!value && !isRequired) {
      removeError(field)
      return true
    }
    let isValid = true
    let errorMessage = ""

    switch (type) {
      case "email":
        isValid = patterns.email.test(value)
        errorMessage = messages.email
        break

      case "tel":
        const digitsOnly = value.replace(/\D/g, "")
        isValid = patterns.phone.test(digitsOnly)
        errorMessage = messages.phone
        break

      case "password":
        isValid = patterns.password.test(value)
        errorMessage = messages.password
        break

      case "text":
        const fieldName = (field.name || field.id || "").toLowerCase()
        if (fieldName.includes("name") || fieldName.includes("firstname") || fieldName.includes("lastname")) {
          isValid = patterns.name.test(value)
          errorMessage = messages.name
        } else if (fieldName.includes("username")) {
          isValid = patterns.username.test(value)
          errorMessage = messages.username
        }
        break
    }
    if (isValid) {
      addSuccess(field)
    } else {
      addError(field, errorMessage)
    }

    return isValid
  }
  function validateForm(form) {
    const inputs = form.querySelectorAll("input, select, textarea")
    let isValid = true

    inputs.forEach((input) => {
      if (!validateField(input)) {
        isValid = false
      }
    })

    return isValid
  }
  function addError(field, message) {
    field.classList.remove("success")
    field.classList.add("error")
    let errorMsg = field.parentElement.querySelector(".error-message")
    if (!errorMsg) {
      errorMsg = document.createElement("span")
      errorMsg.className = "error-message"
      field.parentElement.appendChild(errorMsg)
    }
    errorMsg.textContent = message
  }
  function addSuccess(field) {
    field.classList.remove("error")
    const errorMsg = field.parentElement.querySelector(".error-message")
    if (errorMsg) {
      errorMsg.remove()
    }
  }
  function removeError(field) {
    field.classList.remove("error")
    const errorMsg = field.parentElement.querySelector(".error-message")
    if (errorMsg) {
      errorMsg.remove()
    }
  }
  function protectRequiredAttribute(field) {
    const originalRequired = field.hasAttribute("required")

    if (originalRequired) {
      field.dataset.originalRequired = "true"
      const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
          if (mutation.type === "attributes" && mutation.attributeName === "required") {
            if (field.dataset.originalRequired === "true" && !field.hasAttribute("required")) {
              field.setAttribute("required", "true")
            }
          }
        })
      })

      observer.observe(field, { attributes: true })
    }
  }
  function showSuccessMessage(form) {
    const existingMsg = form.querySelector(".validation-message")
    if (existingMsg) existingMsg.remove()

    const message = document.createElement("div")
    message.className = "validation-message validation-success"
    message.innerHTML =
      '<svg viewBox="0 0 24 24" width="20" height="20"><polyline points="20 6 9 17 4 12"></polyline></svg> Form validated successfully!'
    form.insertBefore(message, form.firstChild)
    setTimeout(() => message.remove(), 3000)
  }
  function showErrorMessage(form) {
    const existingMsg = form.querySelector(".validation-message")
    if (existingMsg) existingMsg.remove()

    const message = document.createElement("div")
    message.className = "validation-message validation-error"
    message.innerHTML =
      '<svg viewBox="0 0 24 24" width="20" height="20"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg> Please correct the errors below.'

    form.insertBefore(message, form.firstChild)
  }
  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", () => {
      initFormValidation()
    })
  } else {
    initFormValidation()
  }
  window.MedOfficeValidation = {
    init: initFormValidation,
    validateField: validateField,
    validateForm: validateForm,
  }
})()
