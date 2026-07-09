<?php
/**
 * Hero Banner Block
 * Full-width background image with overlay text and CTAs
 * 
 * @var \Kirby\Cms\Block $block
 */

$bgImages = $block->bg_image()->toFiles();
$overlayStrength = $block->overlay_strength()->or(45);
$align = $block->align()->or('center');
$valign = $block->valign()->or('center');
$height = $block->height()->or('large');

// Height mapping
$heights = [
    'large'  => '640px',
    'medium' => '480px',
    'small'  => '320px',
];
$heroHeight = $heights[$height->value()] ?? '640px';

?>
<section class="block-hero block-hero--<?= $align ?> block-hero--v<?= $valign ?>" style="--hero-height: <?= $heroHeight ?>;">
  <?php if ($bgImages->isNotEmpty()): ?>
  <div class="block-hero__bg"<?php if ($bgImages->count() > 1): ?> data-hero-slideshow data-interval="6000"<?php endif ?>>
    <?php foreach ($bgImages->values() as $i => $bgImage): $first = $i === 0; ?>
    <img
      class="block-hero__slide<?= $first ? ' is-active' : '' ?>"
      src="<?= $bgImage->thumb(['width' => 1920, 'quality' => 82])->url() ?>"
      alt="<?= $bgImage->alt()->or('') ?>"
      loading="<?= $first ? 'eager' : 'lazy' ?>"
    >
    <?php endforeach ?>
    <div class="block-hero__overlay" style="opacity: <?= $overlayStrength->value() / 100 ?>;"></div>
    <?php if ($height->value() === 'large'): ?>
    <div class="hero-divider" aria-hidden="true">
      <svg viewBox="0 0 1280 147" preserveAspectRatio="none">
        <path fill="var(--bg)"
          d="M0,147 L0,144 L32,141 L33,99 L44,98 L87,41 L108,73 L119,73 L122,62 L139,68 L210,60 L212,126 L347,118 L479,113 L583,111 L783,112 L909,116 L1025,122 L1161,132 L1279,144 L1279,147 Z" />
        <g fill="#9A8C7C">
          <rect x="186" y="88" width="6" height="31" rx="1.5"/>
          <rect x="179" y="96" width="20" height="6" rx="1.5"/>
        </g>
      </svg>
    </div>
    <?php endif ?>
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
      <a href="<?= pageUrl((string)$block->cta_primary_url()) ?>" class="btn btn--primary">
        <?= $block->cta_primary_text()->esc() ?>
      </a>
      <?php endif ?>

      <?php if ($block->cta_secondary_text()->isNotEmpty()): ?>
      <a href="<?= pageUrl((string)$block->cta_secondary_url()) ?>" class="btn btn--secondary">
        <?= $block->cta_secondary_text()->esc() ?>
      </a>
      <?php endif ?>
    </div>
    <?php endif ?>
  </div>
</section>
