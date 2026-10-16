<?php

/**
 * Git Sync — conflict-safe pull/push for the live server
 *
 * The git-content plugin commits every Panel save. This plugin then syncs
 * with GitHub (after every Panel change and on the /git-content/pull webhook):
 *
 *   fetch → merge origin/master → push master
 *
 * If the merge conflicts (the same file changed in the Panel and in a
 * pushed commit), the merge is aborted so the live site never serves
 * half-merged files, and the server's commits are pushed to the
 * `panel-pending` branch instead. Merge that branch into master by hand;
 * the next sync then succeeds and deletes `panel-pending` again.
 *
 * Enabled together with git-content (site/config/server.php).
 * See guides/content-workflow.md.
 */

if (option('thathoff.git-content.disable', false)) {
    return;
}

final class BcefcGitSync
{
    public const BRANCH  = 'master';
    public const PENDING = 'panel-pending';

    public static function root(): string
    {
        return option('thathoff.git-content.path', kirby()->root('index'));
    }

    /** Runs git in the repo; returns [exitCode, combined output]. */
    public static function git(string ...$args): array
    {
        $env = array_merge(getenv(), [
            'LC_ALL'              => 'C',
            'GIT_TERMINAL_PROMPT' => '0', // fail instead of waiting for a password
        ]);

        $process = proc_open(
            ['git', '-C', static::root(), ...$args],
            [1 => ['pipe', 'w'], 2 => ['pipe', 'w']],
            $pipes,
            null,
            $env
        );

        if (!is_resource($process)) {
            return [1, 'could not start git'];
        }

        $output = stream_get_contents($pipes[1]) . stream_get_contents($pipes[2]);
        fclose($pipes[1]);
        fclose($pipes[2]);

        return [proc_close($process), trim($output)];
    }

    /** Staging: only pull, never commit or push. */
    public static function readonly(): bool
    {
        return (bool)option('bcefc.git-sync.readonly', false);
    }

    public static function sync(): array
    {
        $gitDir = static::root() . '/.git';
        $lock   = fopen($gitDir . '/bcefc-sync.lock', 'c');
        flock($lock, LOCK_EX);

        try {
            [$code, $branch] = static::git('rev-parse', '--abbrev-ref', 'HEAD');
            if ($code !== 0 || $branch !== static::BRANCH) {
                return static::result('error', 'Server is not on ' . static::BRANCH . ": $branch");
            }

            // Content written by nested updates (e.g. prayer-topic autodate)
            // isn't committed by git-content, so pick it up here.
            if (!static::readonly()) {
                static::git('add', '--all', '--', 'content');
                if (static::git('diff', '--cached', '--quiet')[0] !== 0) {
                    static::git('commit', '-m', 'panel update: remaining content changes');
                }
            }

            [$code, $out] = static::git('fetch', 'origin', static::BRANCH);
            if ($code !== 0) {
                return static::result('error', "fetch failed: $out");
            }

            [$code, $mergeOut] = static::git('merge', '--no-edit', 'origin/' . static::BRANCH);
            if ($code !== 0) {
                if (is_file($gitDir . '/MERGE_HEAD')) {
                    static::git('merge', '--abort');
                }

                if (static::readonly()) {
                    return static::result('error', "pull failed (discard staging test edits?):\n\n$mergeOut");
                }

                [$code, $out] = static::git('push', 'origin', '+HEAD:refs/heads/' . static::PENDING);
                if ($code !== 0) {
                    return static::result('error', "merge failed and push to " . static::PENDING . " failed: $out\n\n$mergeOut");
                }

                touch($gitDir . '/bcefc-pending');
                return static::result('conflict', 'Merge conflict; Panel changes pushed to ' . static::PENDING . ". Merge it into " . static::BRANCH . ".\n\n$mergeOut");
            }

            if (static::readonly()) {
                return static::result('ok', 'pulled origin/' . static::BRANCH . ' (read-only)');
            }

            [$code, $out] = static::git('push', 'origin', 'HEAD:' . static::BRANCH);
            if ($code !== 0) {
                return static::result('error', "push failed: $out");
            }

            // Back in sync: the pending branch has been merged, remove it.
            if (is_file($gitDir . '/bcefc-pending')) {
                static::git('push', 'origin', '--delete', static::PENDING);
                unlink($gitDir . '/bcefc-pending');
            }

            return static::result('ok', 'synced with origin/' . static::BRANCH);
        } finally {
            flock($lock, LOCK_UN);
            fclose($lock);
        }
    }

    protected static function result(string $status, string $message): array
    {
        if ($status !== 'ok') {
            error_log("[git-sync] $status: $message");
        }

        return ['status' => $status, 'message' => $message];
    }
}

// Sync once at the end of the request, after git-content and every other
// hook (incl. nested updates like prayer-topic autodate) have finished.
// No wildcards: `page.*:after` would also match page.render:after.
$syncAfterChange = function () {
    static $scheduled = false;
    if (!$scheduled) {
        $scheduled = true;
        register_shutdown_function([BcefcGitSync::class, 'sync']);
    }
};

$hooks = [];
foreach (BcefcGitSync::readonly() ? [] : [
    'site.update', 'site.changeTitle',
    'page.create', 'page.update', 'page.delete', 'page.duplicate',
    'page.changeNum', 'page.changeSlug', 'page.changeStatus',
    'page.changeTemplate', 'page.changeTitle',
    'file.create', 'file.replace', 'file.update', 'file.delete',
    'file.changeName', 'file.changeSort',
] as $event) {
    $hooks[$event . ':after'] = $syncAfterChange;
}

Kirby::plugin('bcefc/git-sync', [
    'hooks' => $hooks,
    'routes' => [
        [
            // Same URL the GitHub webhook already uses.
            'pattern' => 'git-content/pull',
            'method'  => 'GET|POST',
            'action'  => function () {
                $secret = (string)option('thathoff.git-content.cronHooksSecret', '');
                $passed = (string)kirby()->request()->get('secret', '');

                if ($secret === '' || !hash_equals($secret, $passed)) {
                    return Kirby\Cms\Response::json(['status' => 'forbidden', 'message' => 'Invalid secret passed'], 403);
                }

                $result = BcefcGitSync::sync();
                return Kirby\Cms\Response::json($result, $result['status'] === 'error' ? 500 : 200);
            },
        ],
    ],
]);
