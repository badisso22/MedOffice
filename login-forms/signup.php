<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../config/config.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $conn->real_escape_string($_POST['firstName'] ?? '');
    $lastName = $conn->real_escape_string($_POST['lastName'] ?? '');
    $email = $conn->real_escape_string($_POST['email'] ?? '');
    $phone = $conn->real_escape_string($_POST['phone'] ?? '');
    $dob = $conn->real_escape_string($_POST['dob'] ?? '');
    $gender = $conn->real_escape_string($_POST['gender'] ?? '');
    $address = $conn->real_escape_string($_POST['address'] ?? '');
    $password = $_POST['password'] ?? '';
    $username = $conn->real_escape_string($_POST['username'] ?? '');
    
    $errors = [];
    if (!preg_match('/^[A-Za-z\s\'-]+$/u', $firstName)) {
        $errors[] = "Invalid first name.";
    }
    
    if (!preg_match('/^[A-Za-z\s\'-]+$/u', $lastName)) {
        $errors[] = "Invalid last name.";
    }
    
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dob) || !strtotime($dob)) {
        $errors[] = "Invalid date of birth.";
    }
    
    if (!preg_match('/^[A-Za-z0-9\s,.\'-]{5,}$/', $address)) {
        $errors[] = "Invalid address.";
    }
    
    if (!preg_match('/^[0-9\s\-\+$$$$]{8,15}$/', $phone)) {
        $errors[] = "Invalid phone number.";
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
        $errors[] = "Weak password. Must contain at least 8 characters, 1 uppercase, 1 lowercase, and 1 number.";
    }
    
    if (strlen($username) < 3 || strlen($username) > 50) {
        $errors[] = "Username must be between 3 and 50 characters.";
    }
    
    if (!empty($errors)) {
        $error = implode('<br>', $errors);
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $checkEmail = $conn->prepare("SELECT userID FROM Users WHERE email = ?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $result = $checkEmail->get_result();
        
        if ($result->num_rows > 0) {
            $error = "Email already registered. Please use a different email.";
        } else {
            $checkUsername = $conn->prepare("SELECT userID FROM Users WHERE username = ?");
            $checkUsername->bind_param("s", $username);
            $checkUsername->execute();
            $result = $checkUsername->get_result();
            
            if ($result->num_rows > 0) {
                $error = "Username already taken. Please choose a different username.";
            } else {
                $roleID = 5; 
                $insertUser = $conn->prepare(
                    "INSERT INTO Users (roleID, username, email, password, account_status) 
                     VALUES (?, ?, ?, ?, 'active')"
                );
                $insertUser->bind_param("isss", $roleID, $username, $email, $hashedPassword);
                
                if ($insertUser->execute()) {
                    $userID = $conn->insert_id;
                    $insertProfile = $conn->prepare(
                        "INSERT INTO UserProfile (userID, firstName, lastName, dateOfBirth, gender, address, phoneNumber) 
                         VALUES (?, ?, ?, ?, ?, ?, ?)"
                    );
                    $insertProfile->bind_param(
                        "issssss", 
                        $userID, 
                        $firstName, 
                        $lastName, 
                        $dob, 
                        $gender, 
                        $address, 
                        $phone
                    );
                    
                    if ($insertProfile->execute()) {
                        $success = "Patient registered successfully! You can now log in.";
                    } else {
                        $deleteUser = $conn->prepare("DELETE FROM Users WHERE userID = ?");
                        $deleteUser->bind_param("i", $userID);
                        $deleteUser->execute();
                        $deleteUser->close();
                        
                        $error = "Failed to save profile information. " . $conn->error;
                    }
                    $insertProfile->close();
                } else {
                    $error = "Failed to create user account. " . $conn->error;
                } 
                $insertUser->close();
            } 
            $checkUsername->close();
        }
        $checkEmail->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - MedOffice SaaS</title>
    <link rel="stylesheet" href="../CSS/formvalidation.css">
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="stylesheet" href="../CSS/login_modals.css">
</head>
<body>
    <div class="modal-overlay" id="successModal">
        <div class="success-modal">
            <div class="success-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>
            <h2>Account Created!</h2>
            <p>Your account has been successfully created. You can now log in and start using MedOffice.</p>
            <button class="modal-button" onclick="window.location.href='login.php'">Go to Login</button>
        </div>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo">
                    <div class="logo-icon">⚕</div>
                    <span>MedOffice</span>
                </div>
                <h2>Create Your Account</h2>
                <p>Join MedOffice to streamline your medical practice</p>
            </div>
            <?php if ($success): ?>
            <?php elseif ($error): ?>
                <div class="alert alert-danger">
                    <strong>Error!</strong> <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form class="login-form" method="POST" action="signup.php">
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" placeholder="John" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName" placeholder="Doe" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob" required>
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="">Select your gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" placeholder="123 Main Street, City, State, ZIP" required></textarea>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="1234567890" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="doctor@clinic.com" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="johndoe123" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-container">
                        <input type="password" id="password" name="password" placeholder="Create a strong password" required>
                        <button type="button" class="password-toggle" onclick="togglePassword()" aria-label="Toggle password visibility">
                            <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <svg class="eye-slash-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                <line x1="1" y1="1" x2="23" y2="23"></line>
                            </svg>
                        </button>
                    </div>
                    <small style="color: #666;">Must contain at least 8 characters, 1 uppercase, 1 lowercase, and 1 number</small>
                </div>

                <div class="form-options">
                    <label class="checkbox-label">
                        <input type="checkbox" name="terms" required>
                        <span>I agree to the Terms & Conditions</span>
                    </label>
                </div>

                <button type="submit" class="btn-primary">Create Account</button>
            </form>

            <div class="login-footer">
                <p class="signup-prompt">Already have an account? <a href="login.php">Log In</a></p>
                <p class="back-home"><a href="../index.html">← Back to Home</a></p>
            </div>
        </div>
    </div>
    <script>
        <?php if ($success): ?>
            setTimeout(function() {
                document.getElementById('successModal').classList.add('active');
            }, 100);
        <?php endif; ?>

        const successModal = document.getElementById('successModal');
        successModal.addEventListener('click', function(e) {
            if (e.target === successModal) {
                successModal.classList.remove('active');
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                successModal.classList.remove('active');
            }
        });

        function togglePassword() {
            const pass = document.getElementById('password');
            const eyeIcon = document.querySelector('.eye-icon');
            const eyeSlashIcon = document.querySelector('.eye-slash-icon');
            
            if (pass.type === 'password') {
                pass.type = 'text';
                eyeIcon.style.display = 'none';
                eyeSlashIcon.style.display = 'block';
            } else {
                pass.type = 'password';
                eyeIcon.style.display = 'block';
                eyeSlashIcon.style.display = 'none';
            }
        }
    </script>
</body>
</html>
