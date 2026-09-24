# Deploying Efarmer on Render (Docker)

This repo ships with everything Render needs:

| File | Purpose |
|------|---------|
| `Dockerfile` | PHP 8.2-FPM + nginx + supervisor image (multi-stage Composer build) |
| `docker/entrypoint.sh` | Runs migrations, caches config/views, starts the stack on `$PORT` |
| `docker/nginx-site.conf.template` | nginx site (only `${PORT}` is substituted at startup) |
| `docker/supervisord.conf` | Keeps php-fpm + nginx running in one container |
| `render.yaml` | Render Blueprint: web service + managed Postgres + env vars |

## 1. Prerequisites

- A [Render](https://render.com) account
- This repo pushed to GitHub (Render connects to the repo)
- PHP + Composer locally (to generate `APP_KEY`)

## 2. Deploy

1. Push this branch to GitHub:
   ```bash
   git push origin frontend
   ```
2. In the Render Dashboard: **New → Blueprint** → connect the repo.
3. Render detects `render.yaml`. It will **prompt for the secrets** marked
   `sync: false`:
   - `APP_KEY` – generate with `php artisan key:generate --show`
   - `KCB_BUNI_CONSUMER_KEY`, `KCB_BUNI_CONSUMER_SECRET`,
     `KCB_ACCOUNT_REFERENCE`, `KCB_BUNI_ORG_PASSKEY`
   - `MAIL_USERNAME`, `MAIL_PASSWORD` (can be dummy values while testing)
4. Click **Apply**. Render builds the Docker image, provisions the Postgres
   database, and starts the service. The entrypoint runs
   `php artisan migrate --force` automatically on every deploy.

Your app is live at `https://<service-name>.onrender.com`.
Verify with `https://<service-name>.onrender.com/health` → `{"status":"ok"}`.

## 3. After the first deploy

1. **M-Pesa callback (replaces ngrok):** set
   `KCB_BUNI_CALLBACK_URL=https://<service-name>.onrender.com/api/mpesa/callback`
   in the service env vars (and in the KCB Buni portal), then redeploy.
   Also set `APP_URL` to the same URL. When going live, set
   `KCB_BUNI_BASE_URL` to the production Buni URL (defaults to the UAT
   sandbox) and `KCB_ACCOUNT_REFERENCE`.
2. **Seed data** (optional): the database is open to the internet by default
   (`ipAllowList` in `render.yaml`), so you can import your local data:
   ```bash
   mysqldump -u root efarmer > efarmer.sql   # export from local MySQL
   # convert/import into Render Postgres, e.g. with pgLoader, or use
   # php artisan db:seed against the Render DB credentials.
   ```
   Restrict `ipAllowList` afterwards.

## 4. Plans & limits (important)

| Item | Free plan | Paid plan (`0.1c-512mb` web / `0.1c-256mb` db) |
|------|-----------|------------------|
| Cost | $0 | from ~$7 + ~$7 / month |
| Web service | Spins down when idle; restarts any time | Always on |
| E-mail (SMTP 465/587) | **Blocked** – keep `MAIL_MAILER=log` | Works – set `MAIL_MAILER=smtp` + SMTP host/login |
| Goat photo uploads | **Lost on redeploy** (ephemeral disk) | Attach a **Disk** (see below) to persist |
| Postgres | **Expires after 30 days** (1 GB) | Persistent, backed up |

### Persisting uploaded goat photos

On a paid plan, add a **Disk** to the web service:

- Mount path: `/var/www/html/storage/app/public`
- Size: 1 GB+ (disks are not available on the free plan)

Laravel's `public/storage` symlink is recreated on every boot by the
entrypoint, so uploads stored there survive redeploys.

## 5. Testing the Docker image locally

```bash
docker build -t efarmer .
# Boots without a DB (migrations are skipped when DB_HOST is unset):
docker run --rm -p 8000:10000 -e PORT=10000 \
  -e APP_KEY="$(php artisan key:generate --show)" efarmer
# then open http://localhost:8000/health
```

## 6. Database notes

- Production runs on **Render Postgres** (`DB_CONNECTION=pgsql`). The raw SQL
  in `DashboardController` uses portable syntax (`EXTRACT(MONTH FROM ...)`,
  single-quoted strings), so it works on both MySQL and Postgres.
- To use MySQL instead, deploy a MySQL private service (see
  render.com/docs/deploy-mysql) with a disk and set `DB_CONNECTION=mysql`
  plus the usual `DB_*` env vars — no code changes required.

## 7. Troubleshooting

| Symptom | Fix |
|---------|-----|
| 502 from nginx | Container didn't bind `$PORT` – check Logs for entrypoint errors |
| "No application encryption key" | Set `APP_KEY` (`php artisan key:generate --show`) and redeploy |
| Migration failures on deploy | Check Logs; DB credentials come from `fromDatabase` in `render.yaml` |
| Config changes not picked up | Env var edits require a **Manual Deploy → Clear build cache & deploy** (config is cached by the entrypoint) |
| Emails not sending | Free plan blocks SMTP ports; use a paid plan or `MAIL_MAILER=log` |
