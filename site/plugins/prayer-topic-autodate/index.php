<?php

/**
 * Prayer Topic — Auto Date
 *
 * When a prayer-topic block's rich-text content changes on save, stamp
 * `last_updated` to today automatically — unless the editor also
 * changed the date themselves (in which case their pick wins). This
 * gives editors one less thing to remember on the weekly update.
 *
 * Runs as an `:after` hook: in Kirby 5 the return value of a `:before`
 * hook replaces the page object, so it can't be used to rewrite $values.
 * Instead we compare old/new content and apply a follow-up update.
 */

Kirby::plugin('bcefc/prayer-topic-autodate', [
    'hooks' => [
        'page.update:after' => function ($newPage, $oldPage) {
            $decode = function ($raw) {
                if (is_array($raw)) return $raw;
                if (empty($raw)) return [];
                return json_decode((string)$raw, true) ?: [];
            };

            $changes = [];

            foreach ($newPage->blueprint()->fields() as $key => $fieldDef) {
                if (($fieldDef['type'] ?? null) !== 'blocks') continue;

                $oldBlocks = $decode($oldPage->content()->get($key)->value());
                $newBlocks = $decode($newPage->content()->get($key)->value());
                if (empty($newBlocks)) continue;

                $modified = false;
                foreach ($newBlocks as $i => &$newBlock) {
                    if (($newBlock['type'] ?? '') !== 'prayer-topic') continue;

                    $oldBlock = $oldBlocks[$i] ?? null;
                    if (!$oldBlock || ($oldBlock['type'] ?? '') !== 'prayer-topic') continue;

                    $oldContent = $oldBlock['content'] ?? [];
                    $newContent = $newBlock['content'] ?? [];

                    $oldText = (string)($oldContent['content'] ?? '');
                    $newText = (string)($newContent['content'] ?? '');
                    if ($oldText === $newText) continue;

                    $oldDate = (string)($oldContent['last_updated'] ?? '');
                    $newDate = (string)($newContent['last_updated'] ?? '');
                    if ($oldDate !== $newDate) continue;

                    $today = date('Y-m-d');
                    if ($newDate === $today) continue;

                    $newBlock['content']['last_updated'] = $today;
                    $modified = true;
                }
                unset($newBlock);

                if ($modified) {
                    $changes[$key] = json_encode($newBlocks, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                }
            }

            // The follow-up update re-triggers this hook, but the text is
            // then unchanged, so it stops after one extra pass.
            return empty($changes) ? $newPage : $newPage->update($changes);
        }
    ]
]);
