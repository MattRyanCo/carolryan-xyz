# Deployment (GitHub Pages)

Deployment is automatic: every push to `main` runs
`.github/workflows/deploy.yml`, which

1. checks out the repo,
2. installs PHP 8.4 (`shivammathur/setup-php`),
3. lint-checks every PHP file,
4. asks GitHub for the Pages URL (`actions/configure-pages`),
5. runs `php build.php` with `SITE_BASE_PATH` / `SITE_URL` set from step 4,
6. uploads `public/` and deploys it (`actions/deploy-pages`).

`public/` is not committed; CI always builds fresh.

## One-time setup

1. Create the repository `MattRyanCo/carolryan-xyz` (public) and push `main`:
   ```sh
   gh repo create MattRyanCo/carolryan-xyz --public --source=. --remote=origin --push
   ```
2. **Settings → Pages → Build and deployment → Source: GitHub Actions.**
   Or from a terminal:
   ```sh
   gh api -X POST repos/MattRyanCo/carolryan-xyz/pages -f build_type=workflow
   ```
3. Push (or run the workflow from the **Actions** tab).

> **Done 2026-11-25.** Repo: https://github.com/MattRyanCo/carolryan-xyz.
> Before the custom domain was set, GitHub served the site as a project page
> under the account's user-site domain,
> `https://www.ryno-net.com/carolryan-xyz/`. With the custom domain below it
> is served at the root of **https://carolryan.xyz/**. The workflow reads the
> URL from `configure-pages` either way, so nothing in the repo has to change.

GitHub Pages on a free account requires the repository to be **public**.

## Manual deploy / re-deploy

Actions tab → **Deploy to GitHub Pages** → **Run workflow**.

## Custom domain: carolryan.xyz

> **Custom domain set 2026-11-25** (repo Settings → Pages). Status at that
> time: the domain resolved to Cloudflare proxy addresses, **Enforce HTTPS**
> was not yet ticked, and https://carolryan.xyz/ answered with Cloudflare
> error 526 (invalid certificate at the origin). Steps 1–2 are done; check
> steps 3–5 below.

Steps to move the domain from WordPress hosting to this site:

1. In `config/site.php` set `'cname' => 'carolryan.xyz'` and
   `'site_url' => 'https://carolryan.xyz'`; commit and push.
2. Repo **Settings → Pages → Custom domain**: `carolryan.xyz`.
3. At your DNS provider (currently Cloudflare), replace the existing records
   for the apex with GitHub's:
   - `A` → `185.199.108.153`, `185.199.109.153`, `185.199.110.153`, `185.199.111.153`
   - `AAAA` → `2606:50c0:8000::153`, `2606:50c0:8001::153`, `2606:50c0:8002::153`, `2606:50c0:8003::153`
   - optional `CNAME www` → `mattryanco.github.io`
   If Cloudflare proxies the records (orange cloud), set SSL mode to *Full*.
   GitHub's own HTTPS certificate is issued most reliably with the records
   set to *DNS only* (grey cloud).
4. Once DNS resolves and GitHub shows the certificate as issued, tick
   **Enforce HTTPS** in the Pages settings.
5. Re-run the workflow (or push). `configure-pages` reports `http://…` until
   HTTPS is enforced, so a build made before step 4 has `http://` canonical
   links and sitemap URLs.

The workflow picks up the new base path (`/`) and URL automatically.

Check GitHub's current docs for the IP addresses before changing DNS:
https://docs.github.com/pages/configuring-a-custom-domain-for-your-github-pages-site

## Troubleshooting

| Symptom | Cause / fix |
|---------|-------------|
| Unstyled pages, broken links on github.io | Base path wrong. Check the "Configure Pages" step output; make sure templates use `$site->url()`/`$site->asset()`. |
| Workflow fails at "Configure Pages" | Pages isn't enabled or not set to "GitHub Actions" (step 2 above). |
| Workflow fails at "Lint PHP" | Syntax error in the named file. Run `php build.php` locally. |
| Custom domain resets after deploy | With Actions deploys GitHub ignores the `CNAME` file; the domain lives in Settings → Pages. Set it there again. (`cname` in `config/site.php` still writes the file, which is harmless.) |
| Cloudflare error 526 on carolryan.xyz | Cloudflare (SSL *Full (strict)*) can't find a valid certificate at GitHub. Set the records to *DNS only* until GitHub issues its certificate, or set SSL mode to *Full*. |
| `http://` in canonical links / sitemap | Built before **Enforce HTTPS** was ticked. Tick it and re-run the workflow. |
