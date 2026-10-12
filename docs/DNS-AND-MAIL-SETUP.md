# scuttlemail.dev: DNS and mailbox setup plan

Goal: scuttlemail.dev becomes the cold-outreach sending domain, so scuttle.dev
and stas@scuttle.dev stay clean. Status as checked on 2026-10-12.

Decisions (Stas, 2026-10-12):
- scuttlemail.dev gets its **own Google Workspace account**, separate from the
  scuttle.dev one, so a suspension over there can never touch real business mail.
- Start with **2 mailboxes**. A third is added only if the domain looks healthy.
- Warm-up ramp per mailbox: 15, 25, 35, 50 sends a day, one step **every 3 days**.
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
| 6 | TXT | `_dmarc` | `v=DMARC1; p=none; rua=mailto:<first mailbox>@scuttlemail.dev` | Start at `p=none`. Move to `quarantine` after about 3 weeks of clean reports. |
| 7 | TXT | `@` | Postmaster Tools verification (from Google) | Only if you set up Postmaster Tools, see below. |

Do not publish the MX record before the mailboxes exist, or mail to the domain
bounces. Do not add `p=reject` early.

## Steps

1. Sign up for a **new** Google Workspace account (Business Starter is enough)
   with domain scuttlemail.dev. Use a different admin from the scuttle.dev account.
2. Add record 2, verify the domain in the Admin console.
3. Create the two mailboxes (names are your choice).
4. Add records 3 and 4, wait until `host -t MX scuttlemail.dev` shows Google.
5. Generate the DKIM key, add record 5, press Start authentication.
6. Add record 6.
7. Add record 1 (www).
8. After DNS has had time to settle, send a test mail from each mailbox to a
   Gmail address and look at "Show original": SPF, DKIM and DMARC must all say PASS.
   Also check the records with the Google Admin Toolbox (toolbox.googleapps.com, Check MX).
9. Connect each mailbox to sd-crm as a Gmail OAuth email account, with the daily
   cap starting at 15.
10. Set `CRM_WARMUP_STEP_DAYS=3` in sd-admin's production `.env` (default is 7).
    This is global, so it also speeds up any other account still in warm-up.

Free-trial Workspace accounts have lower sending limits than paid ones (500 a
day, per Google's sending-limits page), which is far above the 50 a day cap.

## Reading the results

Google Postmaster Tools only reports mail sent to personal @gmail.com and
@googlemail.com addresses, and hides low-volume days. For B2B outreach to company
domains it will often be empty. Domain and IP reputation dashboards are being
retired by Google. See the sd-crm issue for the automated check, and use the
CRM's own bounce rate, replies and reply-rate as the main health signals.

## Not done yet

- Workspace account, mailboxes, all DNS records above (needs your login and DNS access).
- Deploy of this site (package tag, sd-admin composer bump, Caddy entry in d0-admin).
