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
  <meta name="theme-color" content="#D97757" />
  <link rel="icon"
    href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='7' fill='%23D97757'/%3E%3Ctext x='16' y='23' font-family='Arial,sans-serif' font-size='20' font-weight='700' text-anchor='middle' fill='white'%3ES%3C/text%3E%3C/svg%3E" />

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
      --accent: #C6613F;
      --link: #B5532F;
      --border: #e2e8f0;
    }

    @media (prefers-color-scheme: dark) {
      :root:not([data-theme='light']) {
        --bg: #111118;
        --text: #b6b6b6;
        --headline: #ffffff;
        --muted: #8b8b99;
        --accent: #D97757;
        --link: #E8956F;
        --border: #2f2f3a;
      }

      :root:not([data-theme='light']) .icon-moon {
        display: none;
      }

      :root:not([data-theme='light']) .icon-sun {
        display: block;
      }
    }

    :root[data-theme='dark'] {
      --bg: #111118;
      --text: #b6b6b6;
      --headline: #ffffff;
      --muted: #8b8b99;
      --accent: #D97757;
      --link: #E8956F;
      --border: #2f2f3a;
    }

    :root[data-theme='dark'] .icon-moon {
      display: none;
    }

    :root[data-theme='dark'] .icon-sun {
      display: block;
    }

    * {
      box-sizing: border-box;
    }

    html,
    body {
      min-height: 100%;
      margin: 0;
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      min-height: 100dvh;
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
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 44px;
      height: 44px;
      background: none;
      border: 1px solid var(--border);
      border-radius: 10px;
      color: var(--muted);
      cursor: pointer;
      padding: 0;
    }

    .theme-toggle:hover,
    .theme-toggle:focus-visible {
      color: var(--accent);
      border-color: var(--accent);
    }

    .theme-toggle svg {
      width: 20px;
      height: 20px;
      fill: none;
      stroke: currentColor;
      stroke-width: 2;
      stroke-linecap: round;
      stroke-linejoin: round;
    }

    .icon-sun {
      display: none;
    }

    main {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 0 20px;
      text-align: center;
    }

    h1 {
      margin: 0;
      color: var(--headline);
      font-size: clamp(2.1rem, 8vw, 3.75rem);
      font-weight: 700;
      letter-spacing: -0.02em;
      line-height: 1.15;
      overflow-wrap: anywhere;
    }

    h1 span {
      color: var(--accent);
    }

    .about {
      max-width: 34rem;
      margin: 1rem 0 0;
      color: var(--muted);
      font-size: clamp(1rem, 2.6vw, 1.1rem);
    }

    .links {
      margin: 1.5rem 0 0;
      font-size: 1rem;
    }

    footer {
      padding: 24px 16px;
      text-align: center;
      font-size: 0.875rem;
    }

    footer a {
      color: var(--muted);
    }

    footer a:hover,
    footer a:focus-visible {
      color: var(--link);
    }
  </style>
</head>

<body>
  <div class="top">
    <button type="button" class="theme-toggle" id="theme-toggle" aria-label="Toggle light and dark theme"
      title="Toggle theme">
      <svg class="icon-moon" viewBox="0 0 24 24" aria-hidden="true">
        <path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z" />
      </svg>
      <svg class="icon-sun" viewBox="0 0 24 24" aria-hidden="true">
        <circle cx="12" cy="12" r="4" />
        <path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4" />
      </svg>
    </button>
  </div>

  <main>
    <h1>Scuttle <span>Development</span></h1>
    <p class="about">Scuttle Development builds and secures software for businesses: full-stack development, legacy
      modernization, hosting and security, from Eindhoven, the Netherlands.</p>
    <p class="links"><a href="https://scuttle.dev/#contact">Contact</a></p>
  </main>

  <footer>
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
