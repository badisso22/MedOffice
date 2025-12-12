<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Cabinet - MedOffice SaaS</title>
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
                <h2>Welcome to our provided service</h2>
                <p>Please note that to ensure a safe and professional environment for all of us, you need to create a cabinet after making sure with our team that it's genuine</p>
            </div>

            <form class="login-form">
                <div class="form-group">
                    <label for="first-name">First name:</label>
                    <input 
                        type="text" 
                        id="first-name" 
                        name="first-name" 
                        placeholder="John" 
                        required
                    >
                </div>
                <div class="form-group">
                    <label for="last-name">Last name:</label>
                    <input 
                        type="text" 
                        id="last-name" 
                        name="last-name" 
                        placeholder="Doe" 
                        required
                    >
                </div>
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="doctor@clinic.com" 
                        required
                    >
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="6" placeholder="Type your message here..." required></textarea>
                </div>

                <button type="submit" class="btn-primary">Request your cabinet</button>
            </form>

            <div class="login-footer">
                <p class="back-home"><a href="../index.html">← Back to Home</a></p>
            </div>
        </div>
    </div>
        <script src="../JS/form_validation.js"></script>
</body>
</html>
