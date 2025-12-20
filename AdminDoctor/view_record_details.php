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
        <a href="#" id="back-to-records" class="back-button">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Back to Records
        </a>
        <div class="record-header">
            <div class="record-header-top">
                <div class="record-title">
                    <h1 id="record-title"></h1>
                    <span class="badge badge-lab" id="record-badge"></span>
                    <div class="record-meta">
                        <div class="meta-item">
                            <span class="meta-label">Date</span>
                            <span class="meta-value" id="record-date"></span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Doctor</span>
                            <span class="meta-value" id="record-doctor"></span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Patient</span>
                            <span class="meta-value" id="record-patient"></span>
                        </div>
                    </div>
                </div>
                <div class="action-buttons">
                    <button class="btn btn-primary" id="download-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="7 10 12 15 17 10"/>
                            <line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                        Download
                    </button>
                    <button class="btn btn-secondary" id="edit-btn">
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
            <div class="info-grid" id="test-results-grid">
            </div>
        </div>
        <div class="content-section">
            <h2 class="section-title">Clinical Notes</h2>
            <div class="description-text" id="clinical-summary"></div>
            <div class="notes-section" id="clinical-notes"></div>
        </div>
        <div class="content-section">
            <h2 class="section-title">Recommendations</h2>
            <div class="info-grid" id="recommendations-grid">
            </div>
            <div class="description-text" id="recommendations-text" style="margin-top: 1.5rem;"></div>
        </div>
    </div>
    <script src="../ajax/record_details.js"></script>
</body>
</html>
