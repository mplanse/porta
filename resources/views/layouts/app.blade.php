<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Marc Plans Escolar | Portfolio')</title>
  <meta name="description" content="@yield('meta_description', 'Portfolio of Marc Plans Escolar — Systems Administration, Cloud Infrastructure, IT Support & Helpdesk')" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <style>
    /* Palette: #c9daf8 (light), #4498f2 (strong), white, black */
    :root{
      --bg:#ffffff; --bg2:#ffffff; --header:#c9daf8;
      --txt:#000000; --muted:rgba(0,0,0,.65);
      --acc:#4498f2; --card:#ffffff; --chip:#c9daf8; --border:#c9daf8;
      --title:#5893f4;  /* Titles color */
    }

    *{box-sizing:border-box}
    html,body{ margin:0;padding:0; background:linear-gradient(180deg,var(--bg),var(--bg2)); color:var(--txt);
      font-family:ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,Cantarell,"Helvetica Neue",Arial; }

    a{color:var(--acc);text-decoration:none}
    a:hover{text-decoration:underline}

    header{ position:sticky;top:0; background:var(--header); border-bottom:1px solid var(--border); z-index:50; }
    .container{max-width:1100px;margin:0 auto;padding:0 20px}
    .nav{display:flex;align-items:center;justify-content:space-between;height:64px}
    .nav a{margin-left:16px;color:var(--txt);font-weight:600}

    /* HERO: flat white background */
    .hero{
      padding:72px 0 40px;
      background:#ffffff;              /* antes: gradient */
      border-bottom:1px solid var(--border);
    }
    .hero h1{font-size:42px;line-height:1.1;margin:0 0 12px;color:var(--title)} /* antes: #3b55fb */
    .hero p{margin:0 0 24px;color:var(--muted);font-size:18px}
    .cta{display:inline-block;background:var(--acc);color:#fff;padding:12px 18px;border-radius:10px;font-weight:700}

    .grid{display:grid;gap:18px}
    @media(min-width:768px){.grid-3{grid-template-columns:repeat(3,1fr)}.grid-2{grid-template-columns:repeat(2,1fr)}}
    section{padding:48px 0;border-bottom:1px solid var(--border)}
    h2{font-size:26px;margin:0 0 18px;color:var(--title)}
    .card{background:var(--card);border:1px solid var(--border);border-radius:14px;padding:18px}
    .chips{display:flex;flex-wrap:wrap;gap:10px}
    .chip{background:var(--chip);border:1px solid var(--border);padding:8px 10px;border-radius:999px;font-size:14px;color:var(--txt);font-weight:600}

    /* AI Search */
    .ai-area{padding:28px 0;border-bottom:1px solid var(--border)}
    .ai-box{background:#fff;border:1px solid var(--border);border-radius:14px;padding:16px}
    .ai-row{display:flex;gap:10px;flex-wrap:wrap}
    .ai-input{flex:1;min-width:240px;background:#fff;border:1px solid var(--border);color:var(--txt);padding:12px 14px;border-radius:10px;outline:none}
    .ai-btn{background:var(--acc);color:#fff;padding:12px 16px;border-radius:10px;font-weight:700;border:0;cursor:pointer}
    .ai-results{margin-top:14px;display:grid;gap:12px}
    .muted-sm{color:var(--muted);font-size:12px}
    .brand{font-weight:800;letter-spacing:.4px;color:var(--title)}
  </style>
  @stack('head')
</head>
<body>
  <header>
    <nav class="container nav">
      <div class="brand">Marc Plans Escolar</div>
      <div class="row">
        <a href="#skills">Skills</a>
        <a href="#experience">Experience</a>
        <a href="#certifications">Certifications</a>
        <a href="#contact">Contact</a>
      </div>
    </nav>
  </header>

  <main>
    @yield('content')
  </main>

  @stack('scripts')
</body>
</html>