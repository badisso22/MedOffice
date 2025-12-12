<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - MedOffice SaaS</title>
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
                <h2>Reset Your Password</h2>
                <p>Enter your email address and we'll send you a link to reset your password</p>
            </div>

            <form class="login-form" action="reset-password-handler.php" method="POST">
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

                <button type="submit" class="btn-primary">Send Reset Link</button>
            </form>

            <div class="login-footer">
                <p class="signup-prompt">Remember your password? <a href="login.php">Log In</a></p>
                <p class="back-home"><a href="../index.html">← Back to Home</a></p>
            </div>
        </div>
    </div>
    
    <script src="../JS/form_validation.js"></script>
</body>
</html>
