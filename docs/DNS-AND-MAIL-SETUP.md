# scuttlemail.dev: DNS and mailbox setup plan

Goal: scuttlemail.dev becomes the cold-outreach sending domain, so scuttle.dev
and stas@scuttle.dev stay clean. Status as checked on 2026-10-12.

Decisions (Stas, 2026-10-12):
- scuttlemail.dev gets its **own Google Workspace account**, separate from the
  scuttle.dev one, so a suspension over there can never touch real business mail.
- Start with **2 mailboxes**. A third is added only if the domain looks healthy.
- Warm-up ramp per mailbox: 15, 25, 35, 50 sends a day, one step **every 3 days**, set per
  email account in sd-crm (field "Warm-up step (days)"), not as a global setting.
- Mailboxes (changed 2026-10-13): `sp.dev@scuttlemail.dev` (the sign-up user) and
  `sp.mail@scuttlemail.dev`. The names hint at the initials SP without being a real name,
  are longer than four letters and have no numbers; no generic `info@` or `hello@`.
- Contact and recovery address of the new account: scuttledev@gmail.com.
- The website is this package, served from d051 behind Caddy.

## Where DNS lives

Nameservers are `ns1/ns2/ns3.domaindiscount24.net` (the registrar). All records
below are added there.

## Current state (checked 2026-10-12)

| Record | State |
| --- | --- |
| A `scuttlemail.dev` | done, 164.90.203.137 (d051) |
| A `www.scuttlemail.dev` | missing (NXDOMAIN) |
| MX, TXT (SPF, DKIM, DMARC) | none yet |

## Records to add

Do these in order. Values marked "from Google" are shown to you during the
Workspace setup, copy them exactly.

| # | Type | Host | Value | Notes |
| --- | --- | --- | --- | --- |
| 1 | A | `www` | `164.90.203.137` | Caddy redirects www to the apex. Logged in RMMBR. |
| 2 | TXT | `@` | `google-site-verification=...` (from Google) | Workspace domain verification. |
| 3 | MX | `@` | priority 1, `smtp.google.com.` | Same single MX scuttle.dev uses today. Check what the Workspace setup shows and match it. |
| 4 | TXT | `@` | `v=spf1 include:_spf.google.com ~all` | One SPF record only. Never add a second TXT starting with v=spf1. |
| 5 | TXT | `google._domainkey` | from Google (2048-bit key) | Admin console, Apps, Google Workspace, Gmail, Authenticate email, Generate new record, then press Start authentication after the DNS record is live. Long keys may need splitting into two quoted strings; the registrar form usually handles it. |
| 6 | TXT | `_dmarc` | `v=DMARC1; p=none; rua=mailto:sp.dev@scuttlemail.dev` | Start at `p=none`. Move to `quarantine` after about 3 weeks of clean reports. |
| 7 | TXT | `@` | Postmaster Tools verification (from Google) | Only if you set up Postmaster Tools, see below. |

Do not publish the MX record before the mailboxes exist, or mail to the domain
bounces. Do not add `p=reject` early.

## Steps

1. Sign up for a **new** Google Workspace account (Business Starter is enough)
   with domain scuttlemail.dev. Use a different admin from the scuttle.dev account.
2. Add record 2, verify the domain in the Admin console.
3. Create the two mailboxes: `sp.dev@scuttlemail.dev` (sign-up user) and `sp.mail@scuttlemail.dev`.
4. Add records 3 and 4, wait until `host -t MX scuttlemail.dev` shows Google.
5. Generate the DKIM key, add record 5, press Start authentication.
6. Add record 6.
7. Add record 1 (www).
8. After DNS has had time to settle, send a test mail from each mailbox to a
   Gmail address and look at "Show original": SPF, DKIM and DMARC must all say PASS.
   Also check the records with the Google Admin Toolbox (toolbox.googleapps.com, Check MX).
9. Connect each mailbox to sd-crm as a Gmail OAuth email account, with the daily
   cap starting at 15 and **Warm-up step (days) = 3** in the account form. (The step length
   is a per-account database field now; the old `CRM_WARMUP_STEP_DAYS` variable is gone.)

Limits and prices are documented in sd-crm: `docs/GOOGLE-WORKSPACE-SENDING.md`. In short:
Google allows 2,000 messages a day per mailbox (500 on a trial), so 50 a day is our own
reputation choice. Business Starter was EUR 6.80 per user per month excluding tax on
2026-10-12.

## Reading the results

Google Postmaster Tools only reports mail sent to personal @gmail.com and
@googlemail.com addresses, and hides low-volume days. For B2B outreach to company
domains it will often be empty. Domain and IP reputation dashboards are being
retired by Google. sd-crm now polls it daily and checks DNS blocklists daily (see
sd-crm `docs/DELIVERABILITY-MONITORING.md`); once the domain is in Postmaster Tools, run
`php artisan crm:postmaster:authorize scuttlemail.dev` there. Use the CRM's own bounce
rate and reply rate as the main health signals.

## Not done yet

- Workspace account, mailboxes, all DNS records above (needs your login and DNS access).
- Deploy of this site: package tagged v0.1.0, still to do is the sd-admin composer bump
  (push to sd-admin main triggers the production deploy) and the Caddy entry in d0-admin.
