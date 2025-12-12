<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard - MedOffice</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="stylesheet" href="../CSS/feedback.css">
</head>

<body>    
    <div class="custom-modal-overlay" id="customModal">
        <div class="custom-modal">
            <div class="modal-header">
                <div class="modal-icon">
                    <svg viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <h2 class="modal-title">Feedback Successfully Submitted</h2>
            </div>
            <div class="modal-body">
                <p class="modal-description">Thank you for your detailed feedback! We appreciate you taking the time to help us improve our services.</p>
            </div>
            <div class="modal-footer">
                <button class="modal-btn modal-btn-primary" onclick="closeModal()">OK</button>
            </div>
        </div>
    </div>

    <main class="dashboard-main">        
        <section class="feedback-section">
            <h2>Share Your Feedback</h2>
            <p>We value your experience with MedOffice. Your detailed feedback helps us improve our services and provide better care.</p>

            <form class="feedback-form" id="feedbackForm">
                <div class="rating-section">
                    <h3>
                        <svg viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                        Medical Staff
                    </h3>     

                    <div class="rating-item">
                        <label>How would you rate the quality of the welcome you received?</label>
                        <div class="star-rating" id="medical-assistant">
                            <span class="star" data-value="1">★</span>
                            <span class="star" data-value="2">★</span>
                            <span class="star" data-value="3">★</span>
                            <span class="star" data-value="4">★</span>
                            <span class="star" data-value="5">★</span>
                        </div>
                    </div>
                </div>
                <div class="rating-section">
                    <h3>
                        <svg viewBox="0 0 24 24">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                        </svg>
                        Doctor Competence
                    </h3>
                    <div class="rating-grid">
                        <div class="rating-item">
                            <label>How would you rate the doctor's professionalism and expertise?</label>
                            <div class="star-rating" id="doctor-competence">
                                <span class="star" data-value="1">★</span>
                                <span class="star" data-value="2">★</span>
                                <span class="star" data-value="3">★</span>
                                <span class="star" data-value="4">★</span>
                                <span class="star" data-value="5">★</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rating-section">
                    <h3>
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                        Punctuality & Waiting Time
                    </h3>
                    <div class="rating-grid">
                        <div class="rating-item">
                            <label>How would you rate the punctuality of your appointment?</label>
                            <div class="star-rating" id="appointment-punctuality">
                                <span class="star" data-value="1">★</span>
                                <span class="star" data-value="2">★</span>
                                <span class="star" data-value="3">★</span>
                                <span class="star" data-value="4">★</span>
                                <span class="star" data-value="5">★</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rating-section">
                    <h3>
                        <svg viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                            <polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                        Cabinet & Environment
                    </h3>
                    <div class="rating-grid">
                        <div class="rating-item">
                            <label>How would you rate the cleanliness and hygiene of the cabinet?</label>
                            <div class="star-rating" id="cleanliness">
                                <span class="star" data-value="1">★</span>
                                <span class="star" data-value="2">★</span>
                                <span class="star" data-value="3">★</span>
                                <span class="star" data-value="4">★</span>
                                <span class="star" data-value="5">★</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rating-section">
                    <h3>
                        <svg viewBox="0 0 24 24">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                            <line x1="8" y1="21" x2="16" y2="21"/>
                            <line x1="12" y1="17" x2="12" y2="21"/>
                        </svg>
                        Medical Equipment & Services
                    </h3>

                    <div class="rating-grid">
                        <div class="rating-item">
                            <label>How would you rate the quality and condition of the medical equipment?</label>
                            <div class="star-rating" id="equipment-quality">
                                <span class="star" data-value="1">★</span>
                                <span class="star" data-value="2">★</span>
                                <span class="star" data-value="3">★</span>
                                <span class="star" data-value="4">★</span>
                                <span class="star" data-value="5">★</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rating-section">
                    <h3>
                        <svg viewBox="0 0 24 24">
                            <rect x="5" y="11" width="14" height="10" rx="2"/>
                            <circle cx="12" cy="16" r="2"/>
                            <path d="M9 11V7a3 3 0 0 1 6 0v4"/>
                        </svg>
                        Parking & Security
                    </h3>
                    <div class="rating-grid">
                        <div class="rating-item">
                            <label>How would you rate the availability and ease of parking?</label>
                            <div class="star-rating" id="parking-availability">
                                <span class="star" data-value="1">★</span>
                                <span class="star" data-value="2">★</span>
                                <span class="star" data-value="3">★</span>
                                <span class="star" data-value="4">★</span>
                                <span class="star" data-value="5">★</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rating-section">
                    <h3>
                        <svg viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        Administrative Services
                    </h3>
                    <div class="rating-item">
                        <label for="appointment-method">How did you book your appointment?</label>
                        <select id="appointment-method" name="appointment-method" required>
                            <option value="">Select a method</option>
                            <option value="app">Through the MedOffice App</option>
                            <option value="phone-inperson">By Phone or In Person</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="rating-item" id="app-rating-container">
                        <label>How would you rate your experience using the app to book your appointment?</label>
                        <div class="star-rating" id="app-booking-experience">
                            <span class="star" data-value="1">★</span>
                            <span class="star" data-value="2">★</span>
                            <span class="star" data-value="3">★</span>
                            <span class="star" data-value="4">★</span>
                            <span class="star" data-value="5">★</span>
                        </div>
                    </div>
                    <div class="rating-item" id="phone-inperson-rating-container">
                        <label>How would you rate the ease and efficiency of scheduling your appointment by phone or in person?</label>
                        <div class="star-rating" id="phone-inperson-booking-experience">
                            <span class="star" data-value="1">★</span>
                            <span class="star" data-value="2">★</span>
                            <span class="star" data-value="3">★</span>
                            <span class="star" data-value="4">★</span>
                            <span class="star" data-value="5">★</span>
                        </div>
                    </div>
                </div>

                <div class="section-divider"></div>
                <div class="form-group">
                    <label for="feedback-title">Feedback Title <span class="optional-badge">Optional</span></label>
                    <input type="text" id="feedback-title" name="feedback-title" placeholder="Brief summary of your feedback">
                </div>
                
                <div class="form-group">
                    <label for="feedback-message">Detailed Feedback <span class="optional-badge">Optional</span></label>
                    <textarea id="feedback-message" name="feedback-message" placeholder="Please share your detailed feedback, suggestions, or concerns."></textarea>
                </div>
                <button type="submit" class="submit-btn">Submit Feedback</button>
                <a href="dashboard_p.php" class="btn" >Cancel</a>

            </form>
        </section>
    </main>
    <script src="../JS/feedback.js"></script>
</body>
</html>
