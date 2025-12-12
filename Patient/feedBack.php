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
                <div class="form-row">
                    <div class="form-group">
                        <label for="feedback-type">Feedback Type</label>
                        <select id="feedback-type" name="feedback-type" required>
                            <option value="">Select a category</option>
                            <option value="general">General Feedback</option>
                            <option value="appointment">Appointment Experience</option>
                            <option value="website">Website/Portal Experience</option>
                            <option value="staff">Staff Interaction</option>
                            <option value="medical-care">Medical Care</option>
                            <option value="suggestion">Suggestion</option>
                            <option value="complaint">Complaint</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="visit-date">Date of Visit <span class="optional-badge">Optional</span></label>
                        <input type="date" id="visit-date" name="visit-date">
                    </div>
                </div>               
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
                <div class="form-row">
                    <div class="form-group">
                        <label for="follow-up">Would you like us to follow up with you?</label>
                        <select id="follow-up" name="follow-up">
                            <option value="no">No, thank you</option>
                            <option value="yes">Yes, please contact me</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="recommend">Would you recommend us to others?</label>
                        <select id="recommend" name="recommend">
                            <option value="yes">Yes, definitely</option>
                            <option value="maybe">Maybe</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="submit-btn">Submit Feedback</button>
                <a href="dashboard_p.php" class="btn" >Cancel</a>

            </form>
        </section>
    </main>
    <script src="../JS/feedback.js"></script>
</body>
</html>
