# Content workflow: Panel + Git + Claude Code / Codex

GitHub (`shadowdkm/bcefc_kirby`, branch `master`) is the single source of truth.
Both ways of editing sync through it:

```
 Panel on live site ──save──▶ auto commit ──▶ fetch + merge + push ──▶ GitHub master
                                              └─ on conflict ──────▶ GitHub panel-pending
 Local (Claude/Codex/you) ──commit + push──▶ GitHub ──webhook──▶ live site merges master
```

- **Panel edits**: just save. The [Git Content plugin](https://github.com/thathoff/kirby-git-content)
  (`site/plugins/git-content`) commits the changed page/file as the Panel user.
  Commits look like `panel update(page): about/history`.
- **Local edits**: `git pull` → edit → commit → `git push`. A GitHub webhook calls
  `/git-content/pull` on the live site, which merges `master` immediately (code and content).
- **Syncing** (after each Panel save and on the webhook) is done by `site/plugins/git-sync`:
  fetch `origin/master`, merge, push. If the merge **conflicts**, it is aborted — the live
  site never serves half-merged files — and the server's commits go to the
  **`panel-pending`** branch instead. See *Resolving a conflict* below.

Both plugins are **off locally** and turned on only by `site/config/server.php`,
which exists only on the server (git-ignored, because the repo is public).

## Everyday rules

1. **Always `git pull` before editing locally.** Otherwise you may be editing an old
   copy of a page someone just changed in the Panel.
2. **Push soon after committing.** The longer local and Panel edits diverge, the
   more likely both touch the same `.txt` file and conflict.
3. Code changes (templates, CSS, plugins) deploy the same way: push → live.

## One-time server setup (IONOS, over SSH)

Run inside the site folder (`~/kirby/bcefc_kirby` — on IONOS `~` is `htdocs` itself).

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
# Save the token once at a fixed path: PHP may run git without $HOME,
# and then it cannot find ~/.git-credentials. Home is htdocs (web-served), so keep
# the token in a folder that denies web access:
mkdir -p ~/.private && echo "Require all denied" > ~/.private/.htaccess && chmod 700 ~/.private
git config credential.helper "store --file=$HOME/.private/git-credentials"
git fetch                          # enter GitHub username + token once; it is saved
chmod 600 ~/.private/git-credentials
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
     `"synced with origin/master"`, and the live site shows the change.
   - The Panel menu now has **Git Content** (status, log, manual push). Its *pull*
     button is turned off; a plain pull could leave conflict markers in live files.

## Resolving a conflict (`panel-pending`)

A conflict happens when the same file was changed in the Panel and in a pushed
commit. The live site keeps showing the Panel version, its commits are pushed to
`panel-pending`, and new pushes to `master` **don't go live** until you merge it.
Signs: GitHub shows a "panel-pending had recent pushes" banner, and the webhook's
*Recent Deliveries* returns `"status": "conflict"`.

```bash
git checkout master && git pull
git merge origin/panel-pending   # git fetch first if the branch is missing
# fix the conflicted files (keep the right text from both sides)
git add -A && git commit
git push                         # webhook → live site merges cleanly
```

The live site then syncs and deletes `panel-pending` automatically. Further Panel
saves made before you merge are added to `panel-pending` too, so nothing is lost.

## Staging site (test edits that never reach git)

Do the setup above only on the **live** server. On staging:

- **Simplest:** don't create `site/config/server.php`. The plugin stays off, so Panel
  edits are saved on staging but never committed or pushed. Update staging with
  `git pull` over SSH. A read-only token (Contents: Read) is enough there.
- **Optional auto-update:** create a staging-only `server.php` that only pulls:

  ```php
  <?php
  return [
      'thathoff.git-content.disable'         => false,
      'thathoff.git-content.commit'          => false, // Panel saves stay local
      'bcefc.git-sync.readonly'              => true,  // webhook pulls, never pushes
      'thathoff.git-content.cronHooksSecret' => '<different secret from live>',
  ];
  ```

  Then add a second GitHub webhook to `https://<staging-site>/git-content/pull?secret=…`.

Test edits on staging are uncommitted changes there. If a pull refuses with
"your local changes would be overwritten", throw the test edits away and pull again:

```bash
git status                 # see what was edited on staging
git checkout -- content    # discard staging content edits
git clean -fd content      # remove files/pages created on staging
git pull
```

## When something goes wrong

- **Panel save shows "Unable to update git: …"** — the file *was* saved; only the
  commit failed. Open **Git Content** in the Panel, or SSH in and run `git status`.
- **Sync problems** (fetch/push failed) don't show in the Panel; they are logged
  to the PHP error log with a `[git-sync]` prefix and retried on the next save.
  Calling the webhook URL in a browser shows the current result.
- **Conflict**: see *Resolving a conflict* above.
- **Saves suddenly start failing on push** — the fine-grained token probably
  expired. Create a new one (Contents: Read and write) and update the stored
  credential on the server (`~/.private/git-credentials`).
- **"dubious ownership"**: the repo must be owned by the user PHP runs as
  (normally your SSH user on IONOS).
- **Stuck `index.lock`**: use *Remove index lock* in the Git Content Panel view.

Settings live in `site/config/config.php` (`thathoff.git-content.*`, all defaults)
and `site/config/server.php` (server-only overrides). `config.php` always forces
git-content's own pull/push/webhooks off, because git-sync handles them.
