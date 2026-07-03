<?php
/**
 * Icon Feature Grid Block
 * A row of icon + title + description feature tiles
 *
 * @var \Kirby\Cms\Block $block
 */

$columns = $block->columns()->toStructure();
if ($columns->isEmpty()) return;

?>
<section class="block-icon-feature-grid">
  <div class="container">
    <?php if ($block->title()->isNotEmpty()): ?>
    <h2 class="block-icon-feature-grid__title"><?= $block->title()->esc() ?></h2>
    <?php endif ?>

    <div class="icon-feature-grid" style="--columns: <?= min($columns->count(), 4) ?>;">
      <?php foreach ($columns as $item): ?>
      <div class="icon-feature">
        <span class="icon-feature__icon">
          <svg class="icon" aria-hidden="true"><use href="#icon-<?= $item->icon()->or('heart')->esc() ?>"></use></svg>
        </span>
        <h3 class="icon-feature__title"><?= $item->title()->esc() ?></h3>
        <?php if ($item->description()->isNotEmpty()): ?>
        <p class="icon-feature__description"><?= $item->description()->esc() ?></p>
        <?php endif ?>
      </div>
      <?php endforeach ?>
    </div>
  </div>
</section>
