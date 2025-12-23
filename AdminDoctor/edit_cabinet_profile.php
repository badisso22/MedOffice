<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Cabinet Profile - MedOffice</title>
    <link rel="stylesheet" href="../CSS/edit_cabinet_profile.css">
</head>
<body>
    <div class="edit-container">
        <div class="edit-header">
            <div class="header-content">
                <a href="cabinet_profile.php" class="back-link">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    Back to Profile
                </a>
                <h1>Edit Cabinet Profile</h1>
                <p class="subtitle">Update your medical cabinet information</p>
            </div>
        </div>

        <form class="edit-form" id="cabinetEditForm">
            <section class="form-section">
                <div class="section-header">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <h2>Basic Information</h2>
                </div>
                
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="cabinetName">Cabinet Name *</label>
                        <input type="text" id="cabinetName" name="cabinetName" placeholder="Enter cabinet name" required>
                        <span class="field-hint">The official name of your medical cabinet</span>
                    </div>

                    <div class="form-group full-width">
                        <label for="cabinetBio">About Cabinet *</label>
                        <textarea id="cabinetBio" name="cabinetBio" rows="4" placeholder="Describe your cabinet, services, and what makes you unique..." required></textarea>
                        <span class="field-hint">A brief description of your cabinet (max 500 characters)</span>
                    </div>

                    <div class="form-group">
                        <label for="cabinetLogo">Cabinet Logo</label>
                        <div class="file-upload-area">
                            <input type="file" id="cabinetLogo" name="cabinetLogo" accept="image/*">
                            <div class="upload-placeholder">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="17 8 12 3 7 8"></polyline>
                                    <line x1="12" y1="3" x2="12" y2="15"></line>
                                </svg>
                                <p>Click to upload or drag and drop</p>
                                <span>PNG, JPG up to 5MB</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="form-section">
                <div class="section-header">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <h2>Location & Contact</h2>
                </div>
                
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="address">Address *</label>
                        <input type="text" id="address" name="address" placeholder="Street address" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" placeholder="+213 XXX XXX XXX" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" placeholder="contact@cabinet.com" required>
                    </div>

                    <div class="form-group">
                        <label for="website">Website</label>
                        <input type="url" id="website" name="website" placeholder="https://www.yourcabinet.com">
                    </div>

                </div>
            </section>

            <section class="form-section">
                <div class="section-header">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                    </svg>
                    <h2>Specializations</h2>
                </div>
                
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label>Medical Specializations *</label>
                        <div class="checkbox-grid">
                            <label class="checkbox-label">
                                <input type="checkbox" name="specializations" value="General Medicine">
                                <span>General Medicine</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="specializations" value="Cardiology">
                                <span>Cardiology</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="specializations" value="Pediatrics">
                                <span>Pediatrics</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="specializations" value="Dermatology">
                                <span>Dermatology</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="specializations" value="Orthopedics">
                                <span>Orthopedics</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="specializations" value="Neurology">
                                <span>Neurology</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="specializations" value="Gynecology">
                                <span>Gynecology</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="specializations" value="Psychiatry">
                                <span>Psychiatry</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="specializations" value="ENT">
                                <span>ENT</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="specializations" value="Ophthalmology">
                                <span>Ophthalmology</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label for="otherSpecializations">Other Specializations</label>
                        <input type="text" id="otherSpecializations" name="otherSpecializations" placeholder="Add any other specializations, separated by commas">
                    </div>
                </div>
            </section>

            <section class="form-section">
                <div class="section-header">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                    <h2>Appointment Pricing</h2>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="priceGeneral">General Consultation (DZD) *</label>
                        <input type="number" id="priceGeneral" name="priceGeneral" placeholder="2000" min="0" step="100" required>
                    </div>

                    <div class="form-group">
                        <label for="priceSpecialist">Specialist Visit (DZD) *</label>
                        <input type="number" id="priceSpecialist" name="priceSpecialist" placeholder="3500" min="0" step="100" required>
                    </div>

                    <div class="form-group">
                        <label for="priceFollowup">Follow-up (DZD) *</label>
                        <input type="number" id="priceFollowup" name="priceFollowup" placeholder="1500" min="0" step="100" required>
                    </div>

                    <div class="form-group">
                        <label for="priceEmergency">Emergency Visit (DZD)</label>
                        <input type="number" id="priceEmergency" name="priceEmergency" placeholder="5000" min="0" step="100">
                    </div>
                </div>
            </section>

            <section class="form-section">
                <div class="section-header">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="18" cy="5" r="3"></circle>
                        <circle cx="6" cy="12" r="3"></circle>
                        <circle cx="18" cy="19" r="3"></circle>
                        <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                        <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                    </svg>
                    <h2>Social Media</h2>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="url" id="facebook" name="facebook" placeholder="https://facebook.com/yourcabinet">
                    </div>

                    <div class="form-group">
                        <label for="twitter">Twitter</label>
                        <input type="url" id="twitter" name="twitter" placeholder="https://twitter.com/yourcabinet">
                    </div>

                    <div class="form-group">
                        <label for="instagram">Instagram</label>
                        <input type="url" id="instagram" name="instagram" placeholder="https://instagram.com/yourcabinet">
                    </div>

                    <div class="form-group">
                        <label for="linkedin">LinkedIn</label>
                        <input type="url" id="linkedin" name="linkedin" placeholder="https://linkedin.com/company/yourcabinet">
                    </div>
                </div>
            </section>

            <section class="form-section">
                <div class="section-header">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <h2>Facilities & Services</h2>
                </div>
                
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label>Available Facilities</label>
                        <div class="checkbox-grid">
                            <label class="checkbox-label">
                                <input type="checkbox" name="facilities" value="Parking">
                                <span>🚗 Parking Available</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="facilities" value="Wheelchair">
                                <span>♿ Wheelchair Access</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="facilities" value="Lab">
                                <span>🔬 On-site Laboratory</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="facilities" value="Pharmacy">
                                <span>💊 Pharmacy</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="facilities" value="WiFi">
                                <span>📶 Free WiFi</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="facilities" value="Emergency">
                                <span>🚨 24/7 Emergency</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label for="additionalServices">Additional Services</label>
                        <textarea id="additionalServices" name="additionalServices" rows="3" placeholder="Describe any additional services offered..."></textarea>
                    </div>
                </div>
            </section>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>

    <div class="success-toast" id="successToast">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
        <span>Changes saved successfully!</span>
    </div>
    <script src="../ajax/edit-cabinet-profile.js"></script>
</body>
</html>
