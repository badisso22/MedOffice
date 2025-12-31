<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Getting Started – MedOffice</title>
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="stylesheet" href="CSS/form_validation.css">
    <link rel="stylesheet" href="CSS/onboarding.css">

</head>
<body>
<div class="wizard-container">
    <aside class="wizard-visual">
        <h1>Welcome to MedOffice</h1>
        <p>Three quick steps to launch your cabinet and first admin account.</p>

        <div class="wizard-steps">
            <div class="wizard-step-pill active" id="pill-step-1">
                <span class="number">1</span>
                <span>Cabinet details</span>
            </div>
            <div class="wizard-step-pill" id="pill-step-2">
                <span class="number">2</span>
                <span>Admin account</span>
            </div>
            <div class="wizard-step-pill" id="pill-step-3">
                <span class="number">3</span>
                <span>All set</span>
            </div>
        </div>

        <div class="wizard-visual-svg">
            <svg viewBox="0 0 260 200" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="cardGrad" x1="0" x2="1" y1="0" y2="1">
                        <stop offset="0" stop-color="#bfdbfe"/>
                        <stop offset="1" stop-color="#93c5fd"/>
                    </linearGradient>
                </defs>
                <rect x="10" y="20" width="140" height="90" rx="16" fill="url(#cardGrad)" opacity="0.95"/>
                <rect x="24" y="36" width="36" height="36" rx="10" fill="#1d4ed8" opacity="0.96"/>
                <path d="M35 62 l7-14 5 8 4-6 7 12" stroke="#f9fafb" stroke-width="2.4" fill="none" stroke-linecap="round"/>
                <rect x="68" y="38" width="68" height="8" rx="4" fill="#eff6ff"/>
                <rect x="68" y="52" width="48" height="6" rx="3" fill="#dbeafe"/>
                <rect x="68" y="64" width="40" height="6" rx="3" fill="#dbeafe"/>
                <rect x="68" y="76" width="32" height="6" rx="3" fill="#bfdbfe"/>

                <rect x="110" y="110" width="120" height="70" rx="18" fill="#ffffff" opacity="0.95"/>
                <rect x="124" y="122" width="40" height="8" rx="4" fill="#e5e7eb"/>
                <rect x="124" y="136" width="70" height="6" rx="3" fill="#d1d5db"/>
                <rect x="124" y="148" width="56" height="6" rx="3" fill="#d1d5db"/>
                <rect x="124" y="160" width="44" height="6" rx="3" fill="#d1d5db"/>
                <circle cx="206" cy="140" r="16" fill="#dcfce7"/>
                <path d="M200 140 l5 5 9-10" stroke="#16a34a" stroke-width="2.4" fill="none" stroke-linecap="round"/>
            </svg>
        </div>
    </aside>

    <main class="wizard-main">
        <div class="wizard-main-header">
            <h2 id="step-title">Step 1 · Cabinet details</h2>
            <p id="step-subtitle">Tell us about your cabinet so MedOffice can configure it for you.</p>
        </div>

        <div class="wizard-card">
            <div class="wizard-step active" id="step-1">
                <form id="cabinetForm">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="cabinet-name">Cabinet name</label>
                            <input type="text" id="cabinet-name" name="cabinet-name" placeholder="ESST Medical Cabinet" required>
                        </div>
                        <div class="form-group">
                            <label for="speciality">Main speciality</label>
                            <input type="text" id="speciality" name="speciality" placeholder="Pediatrics, General Medicine..." required>
                        </div>
                        <div class="form-group">
                            <label for="cabinet-location">Cabinet location</label>
                            <input type="text" id="cabinet-location" name="cabinet-location"
                                   placeholder="Address, city, country" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Cabinet phone</label>
                            <input type="text" id="phone" name="phone" placeholder="+213 555 000 000" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-email">Contact email</label>
                            <input type="email" id="contact-email" name="contact-email"
                                   placeholder="esst.cabinet@medoffice.com" required>
                        </div>
                        <div class="form-group">
                            <label for="worktime">Work time (display)</label>
                            <input type="text" id="worktime" name="worktime" placeholder="08:00-21:00">
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label for="facilities">Facilities (optional)</label>
                        <input type="hidden" id="facilities" name="facilities">
                        <div class="facility-chips" id="facility-chips">
                            <div class="facility-chip" data-value="Wheelchair">Wheelchair access</div>
                            <div class="facility-chip" data-value="Parking">Parking</div>
                            <div class="facility-chip" data-value="Lab">On-site lab</div>
                            <div class="facility-chip" data-value="Imaging">Imaging</div>
                            <div class="facility-chip" data-value="Pharmacy">Pharmacy</div>
                        </div>
                    </div>

                    <div class="wizard-footer">
                        <span class="status-text">
                            Step <strong>1</strong> of <strong>3</strong>
                        </span>
                        <button type="submit" class="btn-primary" id="btn-step-1">
                            Continue
                            <span>›</span>
                        </button>
                    </div>
                </form>
            </div>

            <div class="wizard-step" id="step-2">
                <div class="loading-state" id="step-2-loading">
                    <div class="loading-spinner"></div>
                    <p>Creating your cabinet workspace…</p>
                    <p style="font-size: 0.8rem; color:#9ca3af;">This usually takes just a moment.</p>
                </div>

                <form id="adminForm" style="display:none;">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="admin-name">Admin full name</label>
                            <input type="text" id="admin-name" name="admin-name" placeholder="Dr. Sarah Johnson" required>
                        </div>
                        <div class="form-group">
                            <label for="admin-username">Username</label>
                            <input type="text" id="admin-username" name="admin-username" placeholder="sarah.johnson" required>
                        </div>
                        <div class="form-group">
                            <label for="admin-email">Admin email</label>
                            <input type="email" id="admin-email" name="admin-email" placeholder="admin@yourcabinet.com" required>
                        </div>
                        <div class="form-group">
                            <label for="admin-phone">Admin phone</label>
                            <input type="text" id="admin-phone" name="admin-phone" placeholder="+213 ..." required>
                        </div>
                        <div class="form-group">
                            <label for="admin-password">Password</label>
                            <input type="password" id="admin-password" name="admin-password" placeholder="••••••••" required>
                        </div>
                        <div class="form-group">
                            <label for="admin-password-confirm">Confirm password</label>
                            <input type="password" id="admin-password-confirm" name="admin-password-confirm" placeholder="Repeat password" required>
                        </div>
                    </div>
                    <div class="wizard-footer">
                        <button type="button" class="btn-secondary" id="back-to-step-1">‹ Back</button>
                        <button type="submit" class="btn-primary" id="btn-step-2">
                            Create admin
                            <span>›</span>
                        </button>
                    </div>
                </form>
            </div>

            <div class="wizard-step" id="step-3">
                <div class="loading-state" id="step-3-loading">
                    <div class="loading-spinner"></div>
                    <p>Finalizing your setup…</p>
                    <p style="font-size: 0.8rem; color:#9ca3af;">Connecting your cabinet and admin account.</p>
                </div>

                <div class="success-state" id="step-3-success" style="display:none;">
                    <div class="success-icon">
                        <svg viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="10" fill="currentColor" opacity="0.1"></circle>
                            <path d="M8 12.5l2.5 2.5L16 9" stroke="currentColor" stroke-width="1.8"
                                  stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </div>
                    <h3>Your cabinet is live</h3>
                    <p>Nice work! MedOffice has created your cabinet and first admin account.</p>
                    <p>You can now sign in and start configuring doctors, patients, and schedules.</p>

                    <div class="success-actions">
                        <button class="btn-primary" id="go-to-login">
                            Start using MedOffice
                        </button>
                    </div>
                </div>
            </div>

            <div id="wizard_result" class="form-result"></div>
        </div>
    </main>
</div>
<script src="ajax/onboarding.js"></script>
</body>
</html>
