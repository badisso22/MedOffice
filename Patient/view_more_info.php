<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cabinet — More Info | MedOffice</title>
  <link rel="stylesheet" href="../CSS/general.css">
  <link rel="stylesheet" href="../CSS/patient.css">
  <style>
        .profile-header {
      display:flex;
      gap:20px;
      align-items:center;
      margin-bottom:24px;
    }

    .profile-avatar{
      width:84px;height:84px;border-radius:12px;background:linear-gradient(135deg,#ecfeff,#cffafe);display:flex;align-items:center;justify-content:center;font-weight:800;color:var(--primary);
      font-size:1.5rem;border:1px solid rgba(8,145,178,0.12);
      box-shadow: var(--shadow-sm);
    }

    .profile-title h1{font-size:1.6rem;margin-bottom:6px}
    .profile-title p{color:var(--text-medium);margin:0}

    .doctors-list{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:12px;margin-top:16px}
    .doctor-card{background:var(--bg-white);padding:12px;border-radius:10px;border:1px solid var(--border);display:flex;gap:12px;align-items:center;transition:transform 0.15s}
    .doctor-card:hover{transform:translateY(-4px);box-shadow:var(--shadow-sm)}
    .doc-avatar{width:48px;height:48px;background:#f1f5f9;border-radius:8px;display:flex;align-items:center;justify-content:center;font-weight:700}

    .feedbacks {margin-top:24px}
    .feedback {background:var(--bg-white);padding:14px;border-radius:10px;border:1px solid var(--border);margin-bottom:12px}
    .feedback .meta{display:flex;justify-content:space-between;align-items:center;margin-bottom:8px}
    .stars{color:#f59e0b;font-weight:700}

    .rating-summary{display:flex;align-items:center;gap:12px;margin-bottom:12px}
    .rating-summary .big-stars{font-size:1.25rem;color:#f59e0b}
    .rating-value{font-weight:700;color:var(--text-dark)}

    .feedback-form{background:var(--bg-white);padding:16px;border-radius:10px;border:1px solid var(--border);margin-top:12px}
    .feedback-form textarea{width:100%;min-height:80px;padding:8px;border-radius:6px;border:1px solid var(--border);resize:vertical}
    .feedback-form .row{display:flex;gap:8px;align-items:center}
    .feedback-form input[type="text"]{flex:1;padding:8px;border-radius:6px;border:1px solid var(--border)}
    .empty-msg{color:var(--text-medium);padding:18px;background:linear-gradient(90deg,#f8fafc, #fff);border-radius:8px;border:1px dashed var(--border)}    .btn-sm{padding:0.45rem 0.9rem;font-size:0.95rem;border-radius:8px}
    .action-buttons .btn-icon{padding:0.45rem 0.9rem}

    @media (max-width:600px){.profile-header{flex-direction:column;align-items:flex-start}.profile-avatar{width:72px;height:72px}}
  </style>
</head>
<body>
<nav>
  <div class="nav-container">
    <button class="drawer-toggle" onclick="toggleDrawer()"><span></span><span></span><span></span></button>
    <a href="#" class="logo"><div class="logo-icon">⚕</div>MedOffice</a>
    <div class="nav-cta">
      <span class="user-name">John Smith</span>
      <a href="logout.php" class="btn btn-secondary">Logout</a>
    </div>
  </div>
</nav>

<div class="drawer" id="drawer">
  <div class="drawer-header">
    <div class="logo"><div class="logo-icon">⚕</div>MedOffice</div>
    <button class="drawer-close" onclick="toggleDrawer()">&times;</button>
  </div>
  <ul class="drawer-menu">
    <li><a href="dashboard_p.php">Dashboard</a></li>
    <li><a href="about_cabinet.php">Clinics</a></li>
    <li><a href="myAppointment.php">My Appointments</a></li>
    <li><a href="settings.php">Settings</a></li>
    <button class="drawer-logout" onclick="logout()">Logout</button>
  </ul>
</div>

<main class="layout">
  <section class="page-title"><h1>Cabinet Details</h1><p style="color: #6c757d; margin-top:8px">Complete profile, doctors and patient feedback</p></section>

  <div class="info-grid">
    <div class="info-card" style="grid-column:span 2;">
      <div class="profile-header">
        <div class="profile-avatar">CM</div>
        <div class="profile-title">
          <h1 id="cab-name">Central Medical Cabinet</h1>
          <p id="cab-address">12 Rue de la Santé, Algiers</p>
        </div>
      </div>
    </div>

    <div class="info-card">
      <div style="margin-top:16px" class="action-buttons">
        <a href="calendarP.php" class="btn btn-primary btn-icon btn-sm">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px;height:18px;margin-right:8px;vertical-align:middle"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line></svg>
          Book Appointment
        </a>
        <a href="about_cabinet.php" class="btn btn-secondary btn-icon">← Back to Clinics</a>
      </div>
    </div>

    <div class="info-card" style="grid-column:span 2;">
      <h3>Patient Feedback</h3>
      <div class="rating-summary">
        <div class="big-stars" id="avg-stars">★★★★★</div>
        <div class="rating-value" id="avg-value">4.0</div>
        <div style="color:var(--text-medium);margin-left:8px">(based on <span id="fb-count">3</span> reviews)</div>
      </div>

      <div id="feedbacks" class="feedbacks">
      </div>

      <div class="feedback-form">
        <h4>Leave feedback</h4>
        <div style="margin-bottom:8px" class="row">
          <input type="text" id="fb-name" placeholder="Your name">
          <select id="fb-rating" style="padding:8px;border-radius:6px;border:1px solid var(--border)">
            <option value="5">★★★★★</option>
            <option value="4">★★★★</option>
            <option value="3">★★★</option>
            <option value="2">★★</option>
            <option value="1">★</option>
          </select>
        </div>
        <textarea id="fb-comment" placeholder="Write your feedback (experience, waiting time, staff, etc.)"></textarea>
        <div style="margin-top:8px;display:flex;gap:8px;justify-content:flex-end">
          <button class="btn btn-secondary" id="fb-clear">Clear</button>
          <button class="btn btn-primary" id="fb-submit">Submit Feedback</button>
        </div>
      </div>

    </div>

  </div>


</main>

<footer>
  <div class="footer-content"><div class="footer-section"><h3>MedOffice</h3><p>Your trusted healthcare management platform</p></div></div>
</footer>

<script>
  function toggleDrawer(){const d=document.getElementById('drawer');d.classList.toggle('open')}
  function logout(){window.location.href='../index.html'}

  const cabinet = {
    id: 1,
    name: 'Central Medical Cabinet',
    address: '12 Rue de la Santé, Algiers',
    phone: '+213 21 00 00 00',
    email: 'contact@cabinet.example.dz',
    site: '#',
    budget: '$$$$$',
    doctors: [
      {id:1,name:'Dr. Aymen Haddad',spec:'General Practitioner'},
      {id:2,name:'Dr. Leila Benali',spec:'Pediatrics'},
      {id:3,name:'Dr. Karim Toumi',spec:'Cardiology'}
    ],
    feedbacks: [
      {id:1,name:'Amir',rating:5,comment:'Excellent care and friendly staff.',date:'2025-08-12'},
      {id:2,name:'Nora',rating:4,comment:'Short waiting time, clean clinic.',date:'2025-09-02'},
      {id:3,name:'Sami',rating:3,comment:'Good doctors but parking is limited.',date:'2025-10-01'}
    ]
  };

  document.getElementById('cab-name').textContent = cabinet.name;
  document.getElementById('cab-address').textContent = cabinet.address;
  document.getElementById('cab-phone').textContent = cabinet.phone;
  document.getElementById('cab-email').textContent = cabinet.email;
  document.getElementById('cab-site').href = cabinet.site;
  document.getElementById('cab-budget').textContent = cabinet.budget;

  const docsRoot = document.getElementById('doctors-list');
  cabinet.doctors.forEach(d=>{
    const el = document.createElement('div'); el.className='doctor-card';
    el.innerHTML = `<div class="doc-avatar">${d.name.split(' ').map(x=>x[0]).slice(0,2).join('')}</div><div><strong>${d.name}</strong><div style="color:var(--text-medium)">${d.spec}</div></div>`;
    docsRoot.appendChild(el);
  });

  const fbRoot = document.getElementById('feedbacks');
  function renderFeedbacks(){
    fbRoot.innerHTML='';
    if(!cabinet.feedbacks.length){
      fbRoot.innerHTML = '<div class="empty-msg">No feedback yet — be the first to share your experience.</div>';
      document.getElementById('avg-stars').textContent = '';
      document.getElementById('avg-value').textContent = '0.0';
      document.getElementById('fb-count').textContent = '0';
      return;
    }

    const avg = (cabinet.feedbacks.reduce((s,x)=>s+x.rating,0)/cabinet.feedbacks.length);
    document.getElementById('avg-stars').textContent = '★'.repeat(Math.round(avg)) + '☆'.repeat(5-Math.round(avg));
    document.getElementById('avg-value').textContent = avg.toFixed(1);
    document.getElementById('fb-count').textContent = cabinet.feedbacks.length;

    cabinet.feedbacks.slice().reverse().forEach(f=>{
      const el = document.createElement('div'); el.className='feedback';
      el.innerHTML = `<div class="meta"><div><strong>${f.name}</strong> <span style="color:var(--text-light);font-size:0.9rem;margin-left:8px">${f.date}</span></div><div class="stars">${'★'.repeat(f.rating)}</div></div><div class="comment">${f.comment}</div>`;
      fbRoot.appendChild(el);
    });
  }
  renderFeedbacks();

  document.getElementById('fb-clear').addEventListener('click', e=>{e.preventDefault();document.getElementById('fb-name').value='';document.getElementById('fb-comment').value='';document.getElementById('fb-rating').value='5'});
  document.getElementById('fb-submit').addEventListener('click', e=>{
    e.preventDefault();
    const name = document.getElementById('fb-name').value.trim() || 'Anonymous';
    const rating = parseInt(document.getElementById('fb-rating').value,10)||5;
    const comment = document.getElementById('fb-comment').value.trim();
    if(!comment){alert('Please write a short comment.');return}
    const id = cabinet.feedbacks.length ? Math.max(...cabinet.feedbacks.map(x=>x.id))+1 : 1;
    const date = new Date().toISOString().slice(0,10);
    cabinet.feedbacks.push({id,name,rating,comment,date});
    renderFeedbacks();
    document.getElementById('fb-name').value='';document.getElementById('fb-comment').value='';document.getElementById('fb-rating').value='5';
  });

</script>
</body>
</html>
