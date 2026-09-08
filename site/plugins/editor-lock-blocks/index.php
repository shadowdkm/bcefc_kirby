<?php

/**
 * Editor Lock Blocks
 *
 * Kirby's role permissions can't distinguish between editing block content
 * and adding/removing/reordering blocks — both fall under `pages.update`.
 * This hook enforces the difference: users with the `editor` role may only
 * change the *content* inside existing blocks. Any change to block count,
 * type, or order is rejected.
 */

Kirby::plugin('bcefc/editor-lock-blocks', [
    'hooks' => [
        'page.update:before' => function ($page, $values) {
            $user = kirby()->user();
            if (!$user || $user->role()->name() !== 'editor') {
                return;
            }

            $decode = function ($raw) {
                if (is_array($raw)) return $raw;
                if (empty($raw)) return [];
                $arr = json_decode((string)$raw, true);
                return is_array($arr) ? $arr : [];
            };

            foreach ($page->blueprint()->fields() as $key => $fieldDef) {
                if (($fieldDef['type'] ?? null) !== 'blocks') {
                    continue;
                }
                if (!array_key_exists($key, $values)) {
                    continue;
                }

                $oldBlocks = $decode($page->content()->get($key)->value());
                $newBlocks = $decode($values[$key]);

                if (count($oldBlocks) !== count($newBlocks)) {
                    throw new Exception('編輯者不能新增或刪除區塊，請只修改現有區塊內的文字和檔案。 Editors may not add or remove blocks — only edit content inside existing blocks.');
                }

                foreach ($oldBlocks as $i => $oldBlock) {
                    $newBlock = $newBlocks[$i] ?? [];
                    if (($oldBlock['type'] ?? '') !== ($newBlock['type'] ?? '')) {
                        throw new Exception('編輯者不能更改區塊類型。 Editors may not change block types.');
                    }
                    if (isset($oldBlock['id']) && ($oldBlock['id'] ?? '') !== ($newBlock['id'] ?? '')) {
                        throw new Exception('編輯者不能重新排序區塊。 Editors may not reorder blocks.');
                    }
                }
            }
        }
    ]
]);
