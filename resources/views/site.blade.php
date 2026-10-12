<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Scuttle Development</title>
  <meta name="description"
    content="Scuttle Development builds and secures software for businesses: full-stack development, legacy modernization, hosting and security, from Eindhoven, the Netherlands." />
  <meta name="author" content="Scuttle Development" />
  <meta name="robots" content="index, follow" />
  <link rel="canonical" href="https://scuttlemail.dev/" />
  <meta name="theme-color" content="#5454D4" />
  <link rel="icon"
    href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='7' fill='%235454D4'/%3E%3Ctext x='16' y='23' font-family='Arial,sans-serif' font-size='20' font-weight='700' text-anchor='middle' fill='white'%3ES%3C/text%3E%3C/svg%3E" />

  <script>
    // Apply a saved theme before first paint so there is no flash.
    try {
      var saved = localStorage.getItem('theme');
      if (saved === 'light' || saved === 'dark') {
        document.documentElement.setAttribute('data-theme', saved);
      }
    } catch (e) { }
  </script>

  <style>
    :root {
      --bg: #ffffff;
      --text: #333333;
      --headline: #11111d;
      --muted: #64748b;
      --primary: #5454D4;
      --border: #e2e8f0;
      --link: #5454D4;
    }

    @media (prefers-color-scheme: dark) {
      :root:not([data-theme='light']) {
        --bg: #111118;
        --text: #b6b6b6;
        --headline: #ffffff;
        --muted: #8b8b99;
        --border: #2f2f3a;
        --link: #8c8cff;
      }
    }

    :root[data-theme='dark'] {
      --bg: #111118;
      --text: #b6b6b6;
      --headline: #ffffff;
      --muted: #8b8b99;
      --border: #2f2f3a;
      --link: #8c8cff;
    }

    * {
      box-sizing: border-box;
    }

    html,
    body {
      height: 100%;
      margin: 0;
    }

    body {
      display: flex;
      flex-direction: column;
      background: var(--bg);
      color: var(--text);
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
      line-height: 1.6;
      -webkit-font-smoothing: antialiased;
    }

    a {
      color: var(--link);
      text-decoration: none;
    }

    a:hover,
    a:focus-visible {
      text-decoration: underline;
    }

    .top {
      display: flex;
      justify-content: flex-end;
      padding: 16px;
    }

    .theme-toggle {
      background: none;
      border: 1px solid var(--border);
      border-radius: 8px;
      color: var(--muted);
      cursor: pointer;
      font: inherit;
      font-size: 0.85rem;
      padding: 6px 12px;
    }

    .theme-toggle:hover,
    .theme-toggle:focus-visible {
      color: var(--headline);
      border-color: var(--primary);
    }

    main {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 0 16px;
      text-align: center;
    }

    h1 {
      margin: 0;
      color: var(--headline);
      font-size: clamp(2rem, 7vw, 3.5rem);
      font-weight: 700;
      letter-spacing: -0.02em;
    }

    h1 span {
      color: var(--primary);
    }

    .about {
      max-width: 34rem;
      margin: 1rem 0 0;
      color: var(--muted);
      font-size: 1.05rem;
    }

    .links {
      margin-top: 1.5rem;
      font-size: 0.95rem;
    }

    footer {
      padding: 24px 16px;
      text-align: center;
      color: var(--muted);
      font-size: 0.85rem;
    }

    footer a {
      margin: 0 0.5rem;
    }
  </style>
</head>

<body>
  <div class="top">
    <button type="button" class="theme-toggle" id="theme-toggle" aria-label="Switch between light and dark theme">Theme</button>
  </div>

  <main>
    <h1>Scuttle <span>Development</span></h1>
    <p class="about">Scuttle Development builds and secures software for businesses: full-stack development, legacy
      modernization, hosting and security, from Eindhoven, the Netherlands.</p>
    <p class="links"><a href="https://scuttle.dev/#contact">Contact</a></p>
  </main>

  <footer>
    <a href="mailto:info@scuttle.dev">info@scuttle.dev</a>
    <a href="https://scuttle.dev/privacy">Privacy</a>
  </footer>

  <script>
    (function () {
      var root = document.documentElement;
      var btn = document.getElementById('theme-toggle');
      btn.addEventListener('click', function () {
        var current = root.getAttribute('data-theme');
        if (!current) {
          current = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }
        var next = current === 'dark' ? 'light' : 'dark';
        root.setAttribute('data-theme', next);
        try { localStorage.setItem('theme', next); } catch (e) { }
      });
    })();
  </script>
</body>

</html>
