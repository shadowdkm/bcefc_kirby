# Content workflow: Panel + Git + Claude Code / Codex

GitHub (`shadowdkm/bcefc_kirby`, branch `master`) is the single source of truth.
Both ways of editing sync through it:

```
 Panel on live site ──save──▶ auto commit ──▶ pull + push ──▶ GitHub
 Local (Claude/Codex/you) ──commit + push──▶ GitHub ──webhook──▶ live site git pull
```

- **Panel edits**: just save. The [Git Content plugin](https://github.com/thathoff/kirby-git-content)
  (`site/plugins/git-content`) commits the changed page/file as the Panel user,
  pulls from GitHub, then pushes. Commits look like `panel update(page): about/history`.
- **Local edits**: `git pull` → edit → commit → `git push`. A GitHub webhook calls
  `/git-content/pull` on the live site, which pulls immediately (code and content).

The plugin is **off locally** and turned on only by `site/config/server.php`,
which exists only on the server (git-ignored, because the repo is public).

## Everyday rules

1. **Always `git pull` before editing locally.** Otherwise you may be editing an old
   copy of a page someone just changed in the Panel.
2. **Push soon after committing.** The longer local and Panel edits diverge, the
   more likely both touch the same `.txt` file and conflict.
3. Code changes (templates, CSS, plugins) deploy the same way: push → live.

## One-time server setup (IONOS, over SSH)

Run inside the site folder (`~/htdocs/kirby/bcefc_kirby`).

```bash
# 1. Get this commit onto the server and make sure the tree is clean
git status            # must be clean; commit or discard leftover server edits first
git pull

# 2. Identity for Panel commits (author is still the Panel user)
git config user.name  "BCEFC Panel"
git config user.email "panel@bcefc.ca"

# 3. Write access to GitHub — the server uses an HTTPS fine-grained token.
#    The token needs Repository access: shadowdkm/bcefc_kirby,
#    Permissions → Contents: Read and write (pull alone only needs Read).
git config --show-origin --get-all credential.helper   # where the token is stored
# If it's the "store" helper, pin the file path: PHP may run git without $HOME,
# and then it can't find ~/.git-credentials.
git config credential.helper "store --file=$HOME/.git-credentials"
git fetch && git push --dry-run    # both must succeed without prompting

# 4. Turn the plugin on with a webhook secret
cp site/config/server.example.php site/config/server.php
openssl rand -hex 24               # paste as cronHooksSecret in server.php
nano site/config/server.php
```

5. **GitHub webhook**: repo → Settings → Webhooks → Add webhook
   - Payload URL: `https://<live-site>/git-content/pull?secret=<the secret>`
   - Content type: `application/x-www-form-urlencoded`
   - Events: *Just the push event*

6. **Test**
   - Save any page in the Panel → a `panel update(page): …` commit appears on GitHub.
   - Push a local commit → webhook's *Recent Deliveries* shows `200` with
     `"successfully pulled"`, and the live site shows the change.
   - The Panel menu now has **Git Content** (status, log, manual pull/push).

## When something goes wrong

- **Panel save shows "Unable to update git: …"** — the file *was* saved; only the
  git step failed (GitHub unreachable, or a conflict). Open **Git Content** in the
  Panel, or SSH in and run `git status`.
- **Conflict** (same file changed in Panel and locally): SSH in, `git status`,
  resolve the file, `git commit`, `git push`. Then `git pull` locally.
- **Saves suddenly start failing on push** — the fine-grained token probably
  expired. Create a new one (Contents: Read and write) and update the stored
  credential on the server (`~/.git-credentials`).
- **"dubious ownership"**: the repo must be owned by the user PHP runs as
  (normally your SSH user on IONOS).
- **Stuck `index.lock`**: use *Remove index lock* in the Git Content Panel view.

Settings live in `site/config/config.php` (`thathoff.git-content.*`, all defaults)
and `site/config/server.php` (server-only overrides).
