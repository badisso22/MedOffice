document.addEventListener('DOMContentLoaded', () => {
  const startBtn = document.getElementById('btnStartShift');
  const endBtn = document.getElementById('btnEndShift');
  const statusDot = document.getElementById('shiftStatusDot');
  const statusText = document.getElementById('shiftStatusText');
  const startDisplay = document.getElementById('shiftStartDisplay');
  const durationDisplay = document.getElementById('shiftDurationDisplay');

  let currentStartedAt = null;
  let durationTimer = null;
  let baseMinutes = 0;

  function formatMinutes(m) {
    const h = Math.floor(m / 60);
    const min = m % 60;
    return `${h}h ${String(min).padStart(2, '0')}m`;
  }

  function updateDurationDisplay() {
    if (!currentStartedAt) {
      durationDisplay.textContent = formatMinutes(baseMinutes);
      return;
    }
    const now = new Date();
    const diffMinutes = Math.floor((now - currentStartedAt) / 60000);
    durationDisplay.textContent = formatMinutes(baseMinutes + diffMinutes);
  }

  function startTimer() {
    stopTimer();
    updateDurationDisplay();
    durationTimer = setInterval(updateDurationDisplay, 60000);
  }

  function stopTimer() {
    if (durationTimer) {
      clearInterval(durationTimer);
      durationTimer = null;
    }
  }

  function setOnShift(startedAtStr, workedMinutes) {
    baseMinutes = workedMinutes || 0;
    currentStartedAt = startedAtStr ? new Date(startedAtStr.replace(' ', 'T')) : null;

    statusDot.classList.add('on');
    statusText.textContent = 'On shift';
    startBtn.disabled = true;
    endBtn.disabled = false;

    startDisplay.textContent = currentStartedAt
      ? currentStartedAt.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
      : '—';

    startTimer();
  }

  function setOffShift(workedMinutes) {
    baseMinutes = workedMinutes || 0;
    currentStartedAt = null;

    statusDot.classList.remove('on');
    statusText.textContent = 'Off shift';
    startBtn.disabled = false;
    endBtn.disabled = true;

    startDisplay.textContent = '—';
    stopTimer();
    durationDisplay.textContent = formatMinutes(baseMinutes);
  }

  async function fetchStatus() {
    try {
      const res = await fetch('../api/assistant-shift-status.php', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });
      const json = await res.json();
      if (!res.ok || !json.success) return;

      const { active, started_at, worked_minutes_today } = json.data;
      if (active) {
        setOnShift(started_at, worked_minutes_today);
      } else {
        setOffShift(worked_minutes_today);
      }
    } catch (err) {
      console.error('Shift status error:', err);
    }
  }

  startBtn?.addEventListener('click', async () => {
    try {
      const res = await fetch('../api/assistant-shift-start.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({})
      });
      const json = await res.json();
      if (!res.ok || !json.success) return;

      const startedAt = json.data.started_at;
      setOnShift(startedAt, baseMinutes);
    } catch (err) {
      console.error('Start shift error:', err);
    }
  });

  endBtn?.addEventListener('click', async () => {
    try {
      const res = await fetch('../api/assistant-shift-end.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({})
      });
      const json = await res.json();
      if (!res.ok || !json.success) return;

      fetchStatus();
    } catch (err) {
      console.error('End shift error:', err);
    }
  });

  fetchStatus();
});
