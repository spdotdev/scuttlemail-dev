# CLAUDE.md: scuttlemail-dev

## What this is
A Laravel **library package** (not an app) serving the scuttlemail.dev page inside a
host app (sd-admin) via host-based routing. scuttlemail.dev is the cold-outreach
sending domain; the page exists so recipients and spam filters see a real company
site. Same pattern as `scuttle-dev` and `splotnikov-dev`.

## Constraints
- Distribution is GitHub VCS + git tags only. No Packagist.
- Versioned: change behaviour, bump tag (`vX.Y.Z`), bump `spdotdev/scuttlemail-dev` in the
  host app's own `composer.lock`, commit and push. Never run a bare `composer update` on the
  production server.
- No published assets: the page inlines its CSS and JS, so there is no `vendor:publish` asset step.
  Only `robots.txt` and `sitemap.xml` ship in `public/` and are routed by the controller.
  Do not add global static files to the host's `public/` (see sd-admin's CLAUDE.md).

## Layout
- `src/ScuttlemailDevServiceProvider.php`: auto-discovered; loads routes + views, publishes config.
- `routes/web.php`: `Route::domain(config('scuttlemail-dev.domain'))` group: `/`, `/robots.txt`, `/sitemap.xml`.
- `resources/views/site.blade.php`: the whole page (centered name, one sentence, contact link,
  privacy link to scuttle.dev/privacy, light and dark theme with a toggle).
- `config/scuttlemail-dev.php`: `domain` via `SCUTTLEMAIL_DOMAIN`.
- `docs/DNS-AND-MAIL-SETUP.md`: the mailbox and DNS plan for the domain.

## Content rules (Stas, 2026-10-12)
No KvK number on the page. No opt-out or "why you got this email" line. Keep it minimal.

## Commands
`composer install`, `./vendor/bin/pint`, `./vendor/bin/phpstan analyse`, `./vendor/bin/phpunit`.

## Status
Built and tested locally, not deployed. Deploy steps: tag v0.1.0, add `spdotdev/scuttlemail-dev`
to sd-admin `composer.json` (repositories + require) and bump the lock, add `scuttlemail.dev`
(and a `www` redirect) to `caddy_sites` in d0-admin and the live Caddyfile on d051, set
`SCUTTLEMAIL_DOMAIN` if it differs. DNS A record already points at d051. Deploying to production
needs Stas's explicit go.
