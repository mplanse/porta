@extends('layouts.app')

@section('title', 'Marc Plans Escolar | Portfolio')
@section('meta_description', 'Portfolio of Marc Plans Escolar — Systems, Cloud (AWS), IT Support, and Web Development')

@section('content')
<br>
  <div class="container">
    <!-- Assistant intro -->
    <div class="card" style="margin-bottom:16px">
      <h3 style="margin:0 0 8px">About this assistant</h3>
      <p class="muted" style="margin:0 0 8px">
        This AI answers using my private dossier only and won’t invent facts.
      </p>
      <ul style="margin:0 0 0 18px; padding:0">
        <li>Ask about contact, experience (e.g., AWS, IT support), education, key skills, or whatever you need to know.</li>
        <li>It replies in the language you are using.</li>
      </ul>
    </div>

    <!-- AI Assistant -->
    <section class="ai-area" id="ai-search">
      <div class="ai-box">
        <div class="ai-row">
          <input id="q" class="ai-input" type="text" placeholder="Ask about contact, experience, education, or skills…" />
          <button id="go" class="ai-btn">Ask</button>
        </div>
        <div class="chips" id="ai-suggest" style="margin-top:8px">
          <span class="chip" data-q="Contact">Contact</span>
          <span class="chip" data-q="AWS experience">AWS experience</span>
          <span class="chip" data-q="Key skills">Key skills</span>
          <span class="chip" data-q="Education">Education</span>
          <span class="chip" data-q="IT support experience">IT support experience</span>
        </div>
        <div id="status" class="muted-sm" style="margin-top:8px"></div>
        <div id="results" class="ai-results" style="white-space:pre-wrap; margin-top:8px;"></div>
      </div>
    </section>
<br>
<br>
    <!-- Hero -->
    <section class="hero">
      <h1>Systems Administration · Cloud (AWS) · Web Development · IT Support</h1>
      <p>IT professional with a Linux/Windows foundation, experience in technical support, networking, and automation. Focused on cloud and web development.</p>
      <a href="https://docs.google.com/presentation/d/1_q4oezJ4ojQYRDs50Ep4O00KZB5bzQujrQniXSrnpSU/edit?usp=sharing" target="_blank" rel="noopener" class="cta">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:6px; vertical-align:text-bottom;">
          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
          <polyline points="7 10 12 15 17 10"></polyline>
          <line x1="12" y1="15" x2="12" y2="3"></line>
        </svg>
        Download CV
      </a>
    </section>

    <!-- Skills (from dossier) -->
    <section id="skills">
      <h2>Skills</h2>
      <div class="chips">
        <span class="chip">AWS</span>
        <span class="chip">Docker</span>
        <span class="chip">Jenkins</span>
        <span class="chip">Apache</span>
        <span class="chip">Linux</span>
        <span class="chip">Windows Server</span>
        <span class="chip">Active Directory</span>
        <span class="chip">Networking</span>
        <span class="chip">VPN</span>
        <span class="chip">DHCP</span>
        <span class="chip">Grafana</span>
        <span class="chip">Prometheus</span>
        <span class="chip">Office 365</span>
        <span class="chip">Help Desk</span>
        <span class="chip">Hardware/Peripherals</span>
        <span class="chip">HTML/CSS</span>
        <span class="chip">PHP</span>
        <span class="chip">React.js</span>
      </div>
    </section>

    <!-- Experience -->
    <section id="experience">
      <h2>Experience</h2>
      <div class="grid grid-2">
        <div class="card">
          <strong>Systems Administrator — Webedia</strong>
          <p class="muted">Apr 2025 – Jun 2025 · Barcelona (Hybrid) · Part-time</p>
          <p>Server-side, Apache, Jenkins, AWS, Docker, Varnish, networking. Monitoring with Grafana/Prometheus and incident management.</p>
        </div>
        <div class="card">
          <strong>IT Technician — Entravision</strong>
          <p class="muted">Dec 2023 – Feb 2025 · Barcelona (On-site) · Freelance</p>
          <p>Technical support, Office 365, Windows/Microsoft Office, Google Workspace, networking, VPN, email, peripherals, and device maintenance.</p>
        </div>
        <div class="card">
          <strong>IT Specialist — Trobalit</strong>
          <p class="muted">Dec 2023 – Feb 2025 · Barcelona (On-site) · Freelance</p>
          <p>Systems administration, Windows Server/AD, VMware, networking, and user support.</p>
        </div>
        <div class="card">
          <strong>IT Technician — BALNES EUROPE SL</strong>
          <p class="muted">Dec 2023 – Aug 2024 · Barcelona (Hybrid) · Freelance</p>
          <p>Hardware support and repair, Office 365, networking, and user assistance.</p>
        </div>
        <div class="card">
          <strong>IT Technician — Adsmurai</strong>
          <p class="muted">Dec 2023 – Mar 2024 · Barcelona (On-site) · Freelance</p>
          <p>Help desk, HW/SW maintenance, networking, and incident management.</p>
        </div>
        <div class="card">
          <strong>IT Technician — Colegio John Talabot</strong>
          <p class="muted">Jan 2023 – May 2023 · On-site · Part-time</p>
          <p>User support, networking, and peripherals.</p>
        </div>
      </div>
    </section>

    <!-- Education -->
    <section id="education">
      <h2>Education</h2>
      <div class="grid grid-2">
        <div class="card">
          <strong>CFGS Web Application Development</strong>
          <p class="muted">Centre d'Estudis Politècnics · Sep 2023 – May 2025</p>
        </div>
        <div class="card">
          <strong>CFGM Networked Computer Systems Administration</strong>
          <p class="muted">Centre d'Estudis Politècnics · Sep 2021 – May 2023</p>
        </div>
      </div>
    </section>

    <!-- Certifications -->
    <section id="certifications">
      <h2>Certifications</h2>
      <div class="grid grid-2">
        <div class="card">
          <strong>Amazon Web Services for IT Professionals</strong>
          <p class="muted">LinkedIn · September 2025</p>
          <div class="chips">
            <span class="chip">AWS</span>
            <span class="chip">Cloud</span>
          </div>
        </div>
        <div class="card">
          <strong>React Essential Training</strong>
          <p class="muted">LinkedIn · September 2025</p>
          <div class="chips">
            <span class="chip">React.js</span>
            <span class="chip">Front-end</span>
            <span class="chip">Web Development</span>
          </div>
        </div>
        <div class="card">
          <strong>Learning Jira Software</strong>
          <p class="muted">LinkedIn · September 2025</p>
          <div class="chips">
            <span class="chip">Jira</span>
            <span class="chip">Project Management</span>
            <span class="chip">Agile</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact -->
    <section id="contact">
      <h2>Contact</h2>
      <div class="card">
        <ul>
          <li>Email: <a href="mailto:mplanse4@gmail.com">mplanse4@gmail.com</a></li>
          <li>LinkedIn: <a href="https://linkedin.com/in/marc-plans-escolar-952472275" target="_blank" rel="noreferrer">linkedin.com/in/marc-plans-escolar-952472275</a></li>
          <li>Location: Sant Joan Despí, Barcelona, Spain</li>
        </ul>
      </div>
    </section>
  </div>
@endsection

@push('scripts')
<script>
const endpoint = 'ai-search';

function setAnswer(text) {
  const res = document.getElementById('results');
  res.innerHTML = '';
  const p = document.createElement('div');
  p.className = 'card';
  p.style.padding = '12px';
  p.textContent = text || '';
  res.appendChild(p);
}

async function search() {
  const qEl = document.getElementById('q');
  const q = qEl.value.trim();
  if (!q) return;
  const token = document.querySelector('meta[name="csrf-token"]').content;
  const btn = document.getElementById('go');
  const status = document.getElementById('status');
  btn.disabled = true;
  const old = btn.textContent;
  btn.textContent = 'Processing…';
  status.textContent = '';
  setAnswer('');
  try {
    const r = await fetch(endpoint, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
      body: JSON.stringify({ q })
    });
    const text = await r.text();
    let data;
    try { data = JSON.parse(text); } catch { data = { ok:false, error:'Non-JSON response', raw:text }; }
    if (!data.ok) {
      status.textContent = data.error || ('Error '+r.status);
      console.error(data);
      return;
    }
    status.textContent = 'Ready';
    setAnswer(data.answer);
  } catch(e) {
    status.textContent = 'Network error';
    console.error(e);
  } finally {
    btn.disabled = false;
    btn.textContent = old;
  }
}

document.getElementById('go').addEventListener('click', search);
document.getElementById('q').addEventListener('keydown', e => { if (e.key==='Enter') search(); });

// Suggestions
document.getElementById('ai-suggest')?.addEventListener('click', (e) => {
  const chip = e.target.closest('.chip');
  if (!chip) return;
  const q = chip.getAttribute('data-q');
  if (!q) return;
  const qEl = document.getElementById('q');
  qEl.value = q;
  search();
});
</script>
@endpush