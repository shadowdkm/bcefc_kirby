<?php

/**
 * Prayer Topic — Auto Date
 *
 * When a prayer-topic block's rich-text content changes on save, stamp
 * `last_updated` to today automatically — unless the editor also
 * changed the date themselves (in which case their pick wins). This
 * gives editors one less thing to remember on the weekly update.
 */

Kirby::plugin('bcefc/prayer-topic-autodate', [
    'hooks' => [
        'page.update:before' => function ($page, $values) {
            $decode = function ($raw) {
                if (is_array($raw)) return $raw;
                if (empty($raw)) return [];
                return json_decode((string)$raw, true) ?: [];
            };

            foreach ($page->blueprint()->fields() as $key => $fieldDef) {
                if (($fieldDef['type'] ?? null) !== 'blocks') continue;
                if (!array_key_exists($key, $values)) continue;

                $oldBlocks = $decode($page->content()->get($key)->value());
                $newBlocks = $decode($values[$key]);
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

                    $newBlock['content']['last_updated'] = date('Y-m-d');
                    $modified = true;
                }
                unset($newBlock);

                if ($modified) {
                    $values[$key] = is_string($values[$key])
                        ? json_encode($newBlocks, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
                        : $newBlocks;
                }
            }

            return $values;
        }
    ]
]);
