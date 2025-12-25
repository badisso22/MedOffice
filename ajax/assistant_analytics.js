document.addEventListener('DOMContentLoaded', () => {
  const hoursEl = document.getElementById('hoursWorkedValue');
  const apptsWeekEl = document.getElementById('appointmentsWeekValue');
  const avgDailyHoursEl = document.getElementById('avgDailyHoursValue');
  const dailyContainer = document.getElementById('dailyBreakdownContainer');

  function formatMinutesToHM(m) {
    const h = Math.floor(m / 60);
    const min = m % 60;
    return `${h}h ${String(min).padStart(2, '0')}m`;
  }

  function renderDaily(daily) {
    dailyContainer.innerHTML = '';
    daily.forEach(d => {
      const row = document.createElement('div');
      row.className = 'breakdown-item';
      row.innerHTML = `
        <span class="breakdown-label">${d.dayName}</span>
        <span class="breakdown-time">${formatMinutesToHM(d.minutesWorked)}</span>
        <span class="breakdown-patients">${d.appointments} appointments</span>
      `;
      dailyContainer.appendChild(row);
    });
  }

  async function loadAnalytics() {
    try {
      const res = await fetch('../api/assistant-activity-analytics.php', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });
      const json = await res.json();
      if (!res.ok || !json.success) {
        console.error(json.errors || 'Failed to load analytics');
        return;
      }

      const d = json.data;
      hoursEl.textContent = formatMinutesToHM(d.totalMinutesWeek || 0);
      apptsWeekEl.textContent = d.totalAppointments || 0;
      avgDailyHoursEl.textContent = formatMinutesToHM(d.avgDailyMinutes || 0);

      renderDaily(d.daily || []);
    } catch (err) {
      console.error('Assistant analytics error:', err);
    }
  }

  loadAnalytics();
});
