<?php
/**
 * Prayer Topic Block
 * A titled block of prayer items with a "last updated" date, meant to
 * be updated on a weekly or monthly cadence by editor-role Panel users.
 *
 * @var \Kirby\Cms\Block $block
 */

$heading = $block->heading();
$content = $block->content()->get('content');
$updated = $block->last_updated()->toDate();
$open    = $block->default_open()->toBool();

if ($heading->isEmpty() && $content->isEmpty()) return;

$langCode = kirby()->language()?->code() ?? 'en';
$isChinese = str_starts_with($langCode, 'zh');
$updatedLabel = $isChinese ? '上次更新' : 'Last updated';
$updatedFormat = $isChinese ? 'Y年n月j日' : 'F j, Y';
?>
<article class="block-prayer-topic">
  <div class="container">
    <details class="block-prayer-topic__details"<?php e($open, ' open') ?>>
      <summary class="block-prayer-topic__summary">
        <?php if ($heading->isNotEmpty()): ?>
        <span class="block-prayer-topic__heading"><?= $heading->esc() ?></span>
        <?php endif ?>
        <?php if ($updated): ?>
        <span class="block-prayer-topic__updated"><?= $updatedLabel ?>：<?= date($updatedFormat, $updated) ?></span>
        <?php endif ?>
      </summary>

      <?php if ($content->isNotEmpty()): ?>
      <div class="block-prayer-topic__content prose">
        <?= $content->permalinksToUrls() ?>
      </div>
      <?php endif ?>
    </details>
  </div>
</article>
