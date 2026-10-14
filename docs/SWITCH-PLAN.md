# Switching cold outreach from stas@scuttle.dev to scuttlemail.dev

Written 2026-10-14. Facts checked on prod (d051) the same day.

## Where things stand today

- The CRM has one email account: stas@scuttle.dev, Gmail login (OAuth), default, active, not paused.
- Its daily cap is 50 and its warm-up started 2026-07-06 (7 days per step).
- Nothing about the new domain is connected to the CRM yet.
- No change is needed on stas@scuttle.dev. It keeps sending as it does now until the switch.

## What the CRM does with accounts (read from the code, 2026-10-14)

- Cold outreach queues and sends for ONE account only: the default active one. Two mailboxes do not send in parallel today.
- The default account is also used for alert mails, the reply digest, DMARC report ingest and booking mails.
- Follow-ups keep the account they were first sent from, and only fall back to the default when that account is gone or inactive.
- The cap and warm-up (15, 25, 35, 50 a day) are stored per account.

## Plan

1. Finish the Workspace sign-up (Stas): working card, sp.dev@ and sp.mail@ created.
2. Add the DNS records at domaindiscount24 (Claude): verification TXT, MX, SPF, DKIM, DMARC with rua to sp.dev@, then Postmaster TXT.
3. Prove the domain passes (Claude): test mails from both mailboxes, SPF, DKIM and DMARC must say PASS.
4. Prepare the CRM side before touching the default (Claude): read the pitch template and signature for stas@scuttle.dev text, check reply polling per account, decide how sp.mail@ is used.
5. Connect sp.dev@ (and sp.mail@) as Gmail OAuth accounts, cap 15, warm-up step 3 days, NOT default yet (Stas logs in to Google once per mailbox, Claude does the rest).
6. Switch the default to sp.dev@ (Claude, one step). From that moment new cold outreach goes out from scuttlemail.dev, and alerts, digest and DMARC ingest move with it.
7. Keep stas@scuttle.dev active but unused for cold outreach so open follow-ups and replies keep working. Watch bounce rate and spam rate daily.
8. After about 3 weeks of clean DMARC reports, tighten p=none to quarantine. Raise the cap only through the warm-up steps.
