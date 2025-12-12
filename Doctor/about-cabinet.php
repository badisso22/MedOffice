<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Cabinet</title>
    <link rel="stylesheet" href="../CSS/about_cabinet.css">
</head>
<body>
    <div class="cabinet-container">
        <header class="cabinet-header">
            <a href="dashboard_d.php" class="back-button" aria-label="Back to Dashboard">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Back
            </a>
        </header>
        <main class="cabinet-main">
            <div class="logo-section">
                <div class="logo-placeholder">
                    <svg width="100" height="100" viewBox="0 0 100 100" fill="none">
                        <rect width="100" height="100" rx="20" fill="url(#gradient)"/>
                        <circle cx="50" cy="35" r="12" fill="white"/>
                        <path d="M 30 65 Q 50 55 70 65" stroke="white" stroke-width="3" fill="none" stroke-linecap="round"/>
                        <defs>
                            <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#0891b2;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#06b6d4;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
                <h1 class="cabinet-name">MedOffice</h1>
                <p class="cabinet-tagline">Professional Healthcare Services</p>
            </div>
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </div>
                    <h3>Location</h3>
                    <p class="info-text">123 Medical Street<br>Healthcare District<br>New York, NY 10001</p>
                </div>
                <div class="info-card">
                    <div class="info-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                    </div>
                    <h3>Phone</h3>
                    <p class="info-text">+1 (555) 123-4567<br><span class="availability">Available 24/7</span></p>
                </div>
                <div class="info-card">
                    <div class="info-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="4" width="20" height="16" rx="2"/>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                        </svg>
                    </div>
                    <h3>Email</h3>
                    <p class="info-text"><a href="mailto:info@medicareplus.com">info@medicareplus.com</a></p>
                </div>
                <div class="info-card">
                    <div class="info-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <h3>Hours</h3>
                    <p class="info-text">Mon - Fri: 8:00 AM - 6:00 PM<br>Sat: 9:00 AM - 2:00 PM<br>Sun: Closed</p>
                </div>
            </div>
            <div class="about-section">
                <h2>About Our Cabinet</h2>
                <p>MedOffice has been serving the community for over 15 years with a commitment to excellent healthcare services. Our team of highly qualified healthcare professionals is dedicated to providing compassionate care and innovative medical solutions.</p>
                <div class="services-list">
                    <h3>Our Services</h3>
                    <ul>
                        <li>General Consultation</li>
                        <li>Preventive Care</li>
                        <li>Diagnostic Testing</li>
                        <li>Vaccination Services</li>
                        <li>Chronic Disease Management</li>
                    </ul>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
