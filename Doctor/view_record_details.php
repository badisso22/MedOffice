<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Details - MedOffice</title>
    <link rel="stylesheet" href="../CSS/view_details.css" />
</head>
<body>
    <div class="page-container">
        <a href="view_records.php" class="back-button">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Back to Records
        </a>
        <div class="record-header">
            <div class="record-header-top">
                <div class="record-title">
                    <h1>Blood Work Analysis</h1>
                    <span class="badge badge-lab">Lab Results</span>
                    <div class="record-meta">
                        <div class="meta-item">
                            <span class="meta-label">Date</span>
                            <span class="meta-value">October 20, 2025</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Doctor</span>
                            <span class="meta-value">Dr. John Doe</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Patient</span>
                            <span class="meta-value">Sarah Mitchell (#P-2847)</span>
                        </div>
                    </div>
                </div>
                <div class="action-buttons">
                    <button class="btn btn-primary">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="7 10 12 15 17 10"/>
                            <line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                        Download
                    </button>
                    <button class="btn btn-secondary">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                        Edit
                    </button>
                </div>
            </div>
        </div>
        <div class="content-section">
            <h2 class="section-title">Test Results</h2>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">White Blood Cells (WBC)</span>
                    <span class="info-value">7.2 K/uL</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Red Blood Cells (RBC)</span>
                    <span class="info-value">4.8 M/uL</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Hemoglobin</span>
                    <span class="info-value">14.5 g/dL</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Hematocrit</span>
                    <span class="info-value">43.2%</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Platelets</span>
                    <span class="info-value">245 K/uL</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Glucose</span>
                    <span class="info-value">95 mg/dL</span>
                </div>
            </div>
        </div>
        <div class="content-section">
            <h2 class="section-title">Clinical Notes</h2>
            <div class="description-text">
                <strong>Summary:</strong> Complete blood count and metabolic panel performed. All values within normal range. Patient shows good overall health status. No abnormalities detected in blood work. Recommend routine follow-up in 6 months.
            </div>
            <div class="notes-section">
                <p><strong>Additional Notes:</strong> Patient reported feeling well with no complaints. Vital signs stable. Continue current medications as prescribed. Lifestyle modifications recommended including regular exercise and balanced diet.</p>
            </div>
        </div>
        <div class="content-section">
            <h2 class="section-title">Recommendations</h2>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Follow-up Required</span>
                    <span class="info-value">Yes - 6 months</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Referral Needed</span>
                    <span class="info-value">No</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Medication Changes</span>
                    <span class="info-value">None</span>
                </div>
            </div>
            <div class="description-text" style="margin-top: 1.5rem;">
                Continue current treatment plan. Maintain healthy lifestyle with regular exercise and balanced nutrition. Schedule follow-up appointment in 6 months for routine check-up and repeat blood work if needed.
            </div>
        </div>
    </div>
</body>
</html>
