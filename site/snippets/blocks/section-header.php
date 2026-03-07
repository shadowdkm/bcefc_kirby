<?php
/**
 * Section Header Block
 * Section title + subtitle + optional right-aligned link
 * 
 * @var \Kirby\Cms\Block $block
 */

if ($block->title()->isEmpty()) return;

?>
<header class="block-section-header">
  <div class="container">
    <div class="block-section-header__inner">
      <div class="block-section-header__text">
        <h2 class="block-section-header__title"><?= $block->title()->esc() ?></h2>
        <?php if ($block->subtitle()->isNotEmpty()): ?>
        <p class="block-section-header__subtitle"><?= $block->subtitle()->esc() ?></p>
        <?php endif ?>
      </div>
      
      <?php if ($block->link_text()->isNotEmpty()): ?>
      <a href="<?= $block->link_url()->or('#') ?>" class="block-section-header__link">
        <?= $block->link_text()->esc() ?>
        <span class="arrow">→</span>
      </a>
      <?php endif ?>
    </div>
  </div>
</header>
