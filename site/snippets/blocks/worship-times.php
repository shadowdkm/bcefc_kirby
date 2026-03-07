<?php
/**
 * Worship Times Block
 * Service cards showing worship times (Cantonese/Mandarin/English)
 * 
 * @var \Kirby\Cms\Block $block
 */

$services = $block->services()->toStructure();
if ($services->isEmpty()) return;

?>
<section class="block-worship-times">
  <div class="container">
    <?php if ($block->heading()->isNotEmpty()): ?>
    <header class="block-worship-times__header">
      <div class="block-worship-times__titles">
        <h2 class="block-worship-times__heading"><?= $block->heading()->esc() ?></h2>
        <?php if ($block->subheading()->isNotEmpty()): ?>
        <p class="block-worship-times__subheading"><?= $block->subheading()->esc() ?></p>
        <?php endif ?>
      </div>
      
      <?php if ($block->view_all_text()->isNotEmpty()): ?>
      <a href="<?= $block->view_all_url()->or('#') ?>" class="block-worship-times__link">
        <?= $block->view_all_text()->esc() ?>
        <span class="arrow">→</span>
      </a>
      <?php endif ?>
    </header>
    <?php endif ?>
    
    <div class="block-worship-times__grid" style="--columns: <?= min($services->count(), 3) ?>;">
      <?php foreach ($services as $service): ?>
      <article class="worship-card<?php e($service->featured()->toBool(), ' worship-card--featured') ?>">
        <h3 class="worship-card__name"><?= $service->name()->esc() ?></h3>
        
        <div class="worship-card__details">
          <?php if ($service->time()->isNotEmpty()): ?>
          <div class="worship-card__detail">
            <svg class="icon" aria-hidden="true"><use href="#icon-clock"></use></svg>
            <span><?= $service->time()->esc() ?></span>
          </div>
          <?php endif ?>
          
          <?php if ($service->location()->isNotEmpty()): ?>
          <div class="worship-card__detail">
            <svg class="icon" aria-hidden="true"><use href="#icon-location"></use></svg>
            <span><?= $service->location()->esc() ?></span>
          </div>
          <?php endif ?>
          
          <?php if ($service->extra_info()->isNotEmpty()): ?>
          <div class="worship-card__detail">
            <svg class="icon" aria-hidden="true"><use href="#icon-broadcast"></use></svg>
            <span><?= $service->extra_info()->esc() ?></span>
          </div>
          <?php endif ?>
        </div>
        
        <?php if ($service->description()->isNotEmpty()): ?>
        <p class="worship-card__description"><?= $service->description()->esc() ?></p>
        <?php endif ?>
        
        <?php if ($service->cta_text()->isNotEmpty()): ?>
        <a href="<?= $service->cta_url()->or('#') ?>" class="worship-card__cta btn<?php e($service->featured()->toBool(), ' btn--accent', ' btn--outline') ?>">
          <?= $service->cta_text()->esc() ?>
        </a>
        <?php endif ?>
      </article>
      <?php endforeach ?>
    </div>
  </div>
</section>
