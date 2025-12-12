<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MedOffice SaaS</title>
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="stylesheet" href="../CSS/form_validation.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo">
                    <div class="logo-icon">⚕</div>
                    MedOffice
                </div>
                <h2>Welcome Back</h2>
                <p>Please log in to access your MedOffice account</p>
            </div>

            <form class="login-form">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="doctor@clinic.com" 
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Enter your password" 
                        required
                    >
                </div>

                <div class="form-options">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember">
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
    <script src="../js/form_validation.js"></script>
</body>
</html>
