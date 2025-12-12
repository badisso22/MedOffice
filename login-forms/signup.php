<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - MedOffice SaaS</title>
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
                <h2>Create Your Account</h2>
                <p>Join MedOffice to streamline your medical practice</p>
            </div>

            <form class="login-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input 
                            type="text" 
                            id="firstName" 
                            name="firstName" 
                            placeholder="John" 
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input 
                            type="text" 
                            id="lastName" 
                            name="lastName" 
                            placeholder="Doe" 
                            required
                        >
                    </div>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input 
                        type="date" 
                        id="dob" 
                        name="dob" 
                        required
                    >
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
                    <textarea 
                        id="address" 
                        name="address" 
                        placeholder="123 Main Street, City, State, ZIP" 
                        required
                    ></textarea>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input 
                        type="tel" 
                        id="phone" 
                        name="phone" 
                        placeholder="1234567890" 
                        required
                        maxlength="10"
                    >
                </div>

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
                    <label for="username">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        placeholder="johndoe123" 
                        required
                    >
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Create a strong password" 
                        required
                    >
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
        <script src="../JS/form_validation.js"></script>
</body>
</html>
