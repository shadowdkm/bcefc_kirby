<?php
/**
 * Hero Banner Block
 * Full-width background image with overlay text and CTAs
 * 
 * @var \Kirby\Cms\Block $block
 */

$bgImage = $block->bg_image()->toFile();
$overlayStrength = $block->overlay_strength()->or(45);
$align = $block->align()->or('center');
$height = $block->height()->or('large');

// Height mapping
$heights = [
    'large'  => '640px',
    'medium' => '480px',
    'small'  => '320px',
];
$heroHeight = $heights[$height->value()] ?? '640px';

?>
<section class="block-hero block-hero--<?= $align ?>" style="--hero-height: <?= $heroHeight ?>;">
  <?php if ($bgImage): ?>
  <div class="block-hero__bg">
    <img 
      src="<?= $bgImage->url() ?>" 
      alt="<?= $bgImage->alt()->or('') ?>"
      loading="eager"
    >
    <div class="block-hero__overlay" style="opacity: <?= $overlayStrength->value() / 100 ?>;"></div>
  </div>
  <?php endif ?>
  
  <div class="block-hero__content container">
    <?php if ($block->eyebrow()->isNotEmpty()): ?>
    <p class="block-hero__eyebrow"><?= $block->eyebrow()->esc() ?></p>
    <?php endif ?>
    
    <?php if ($block->title()->isNotEmpty()): ?>
    <h1 class="block-hero__title"><?= $block->title()->esc() ?></h1>
    <?php endif ?>
    
    <?php if ($block->subtitle()->isNotEmpty()): ?>
    <p class="block-hero__subtitle"><?= $block->subtitle()->esc() ?></p>
    <?php endif ?>
    
    <?php if ($block->cta_primary_text()->isNotEmpty() || $block->cta_secondary_text()->isNotEmpty()): ?>
    <div class="block-hero__actions">
      <?php if ($block->cta_primary_text()->isNotEmpty()): ?>
      <a href="<?= $block->cta_primary_url()->or('#') ?>" class="btn btn--primary">
        <?= $block->cta_primary_text()->esc() ?>
      </a>
      <?php endif ?>
      
      <?php if ($block->cta_secondary_text()->isNotEmpty()): ?>
      <a href="<?= $block->cta_secondary_url()->or('#') ?>" class="btn btn--secondary">
        <?= $block->cta_secondary_text()->esc() ?>
      </a>
      <?php endif ?>
    </div>
    <?php endif ?>
  </div>
</section>
