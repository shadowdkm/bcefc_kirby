<?php
/**
 * Quick Links Row Block
 * 3-6 icon cards for quick navigation (New Here, This Week, Giving, etc.)
 * 
 * @var \Kirby\Cms\Block $block
 */

$items = $block->items()->toStructure();
if ($items->isEmpty()) return;

?>
<section class="block-quick-links">
  <div class="container">
    <div class="block-quick-links__grid" style="--columns: <?= min($items->count(), 4) ?>;">
      <?php foreach ($items as $item): ?>
      <a href="<?= $item->url()->or('#') ?>" class="quick-link-card<?php e($item->emphasis()->toBool(), ' quick-link-card--emphasis') ?>">
        <?php if ($item->icon()->isNotEmpty()): ?>
        <span class="quick-link-card__icon" data-icon="<?= $item->icon()->esc() ?>">
          <svg class="icon"><use href="#icon-<?= $item->icon()->esc() ?>"></use></svg>
        </span>
        <?php endif ?>
        
        <div class="quick-link-card__content">
          <h3 class="quick-link-card__title"><?= $item->title()->esc() ?></h3>
          <?php if ($item->subtitle()->isNotEmpty()): ?>
          <p class="quick-link-card__subtitle"><?= $item->subtitle()->esc() ?></p>
          <?php endif ?>
        </div>
        
        <span class="quick-link-card__arrow">→</span>
      </a>
      <?php endforeach ?>
    </div>
  </div>
</section>
