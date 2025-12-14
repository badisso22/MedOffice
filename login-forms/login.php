<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../config/config.php';
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);
    if (empty($email) || empty($password)) {
        $error = "Email and password are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $query = $conn->prepare(
            "SELECT u.userID, u.password, u.roleID, r.roleName 
             FROM Users u 
             LEFT JOIN Roles r ON u.roleID = r.roleID 
             WHERE u.email = ?"
        );
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['userID'] = $user['userID'];
                $_SESSION['email'] = $email;
                $_SESSION['roleID'] = $user['roleID'];
                $_SESSION['roleName'] = $user['roleName'];
                $_SESSION['loggedIn'] = true;
                $updateLogin = $conn->prepare("UPDATE Users SET last_login = NOW() WHERE userID = ?");
                $updateLogin->bind_param("i", $user['userID']);
                $updateLogin->execute();
                $updateLogin->close();
                if ($remember) {
                    setcookie('userEmail', $email, time() + (30 * 24 * 60 * 60), '/');
                    setcookie('remember', '1', time() + (30 * 24 * 60 * 60), '/');
                }
                switch ($user['roleID']) {
                    case 1: 
                        header("Location: ../SuperAdmin/dashboard_superadmin.php");
                        break;
                    case 2: 
                        header("Location: ../AdminDoctor/dashboard_ad.php");
                        break;
                    case 3: 
                        header("Location: ../Doctor/dashboard_d.php");
                        break;
                    case 4: 
                        header("Location: ../Assistant/dashboard_a.php");
                        break;
                    case 5: 
                        header("Location: ../Patient/dashboard_p.php");
                        break;
                    default:
                        header("Location: ../index.html");
                }
                exit();
            } else {
                $error = "Invalid email or password.";
            }
        } else {
            $error = "Invalid email or password.";
        }
        
        $query->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MedOffice SaaS</title>
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="stylesheet" href="../CSS/login_modals.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo">
                    <div class="logo-icon">⚕</div>
                    <span>MedOffice</span>
                </div>
                <h2>Welcome Back</h2>
                <p>Please log in to access your MedOffice account</p>
            </div>

            <?php if ($error): ?>
                <div id="errorData" style="display: none;" data-error="<?php echo htmlspecialchars($error); ?>"></div>
            <?php endif; ?>

            <form class="login-form" method="POST" action="login.php">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="doctor@clinic.com" 
                        value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-container">
                        <input type="password" id="password" name="password" class="login-password" placeholder="Create a strong password" required>
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
                </div>

                <div class="form-options">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" value="1">
                        <span>Remember me</span>
                    </label>
                    <a href="forgot_password.php" class="forgot-password">Forgot Password?</a>
                </div>

                <button type="submit" class="btn-primary">Log In</button>
            </form>

            <div class="login-footer">
                <p class="signup-prompt">Don't have an account? <a href="signup.php">Sign Up</a></p>
                <p class="back-home"><a href="../index.html">← Back to Home</a></p>
            </div>
        </div>
    </div>
    <div id="errorModal" class="modal-overlay">
        <div class="modal-content error-modal">
            <div class="modal-icon error-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="15" y1="9" x2="9" y2="15"></line>
                    <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
            </div>
            <h3>Login Failed</h3>
            <p id="errorMessage"></p>
            <button class="modal-btn" onclick="closeErrorModal()">Try Again</button>
        </div>
    </div>

    <script src="../JS/form_validation.js"></script>
    <script>
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

        window.addEventListener('DOMContentLoaded', function() {
            const errorData = document.getElementById('errorData');
            if (errorData) {
                const errorMessage = errorData.getAttribute('data-error');
                if (errorMessage) {
                    showErrorModal(errorMessage);
                }
            }
        });

        function showErrorModal(message) {
            const modal = document.getElementById('errorModal');
            const messageEl = document.getElementById('errorMessage');
            messageEl.textContent = message;
            setTimeout(() => {
                modal.classList.add('active');
            }, 100);
        }

        function closeErrorModal() {
            const modal = document.getElementById('errorModal');
            modal.classList.remove('active');
        }

        document.getElementById('errorModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeErrorModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeErrorModal();
            }
        });
    </script>
</body>
</html>
