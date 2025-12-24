console.log('doctor_reports.js loaded');

document.addEventListener('DOMContentLoaded', async () => {
  try {
    const res = await fetch('../api/doctor-analytics.php');
    const json = await res.json();
    if (!res.ok || !json.success) return;

    const { summary, daily, completionRate } = json.data;

    const cards = document.querySelectorAll('.analytics-card');
    const totalHours = ((summary.total_patients || 0) * 15) / 60;
    cards[0].querySelector('.analytics-value').textContent = totalHours.toFixed(1);
    cards[1].querySelector('.analytics-value').textContent = summary.total_patients || 0;
    cards[2].querySelector('.analytics-value').textContent = '15.0m';
    cards[3].querySelector('.analytics-value').textContent = completionRate.toFixed(0) + '%';

    const breakdownContainer = document.querySelectorAll('.report-section')[0];
    const oldItems = breakdownContainer.querySelectorAll('.breakdown-item');
    oldItems.forEach(el => el.remove());
    daily.forEach(d => {
      const div = document.createElement('div');
      div.className = 'breakdown-item';
      div.innerHTML = `
        <span class="breakdown-label">${d.day_name}</span>
        <span class="breakdown-time">~${(d.consultations * 15)}m</span>
        <span class="breakdown-patients">${d.consultations} consultations</span>
      `;
      breakdownContainer.insertBefore(div, breakdownContainer.querySelector('.summary-grid'));
    });

    const summaryValues = breakdownContainer.querySelectorAll('.summary-value');
    summaryValues[0].textContent = totalHours.toFixed(1) + 'h';
    summaryValues[1].textContent = summary.total_patients || 0;
    summaryValues[2].textContent = summary.days_worked > 0
      ? (totalHours / summary.days_worked).toFixed(1) + 'h'
      : '0h';
  } catch (e) {
    console.error('Error loading doctor analytics', e);
  }
});
