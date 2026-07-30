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

// Shuffle here rather than in JS so each visit opens on a different photo *and*
// the photo shown first is the one the browser loads eagerly. Shuffling in the
// browser would hand the head start to a slide that may never be shown first.
$slides = $bgImages->values();
if (count($slides) > 1) {
    shuffle($slides);
}

$canResize = extension_loaded('gd') || extension_loaded('imagick');

?>
<section class="block-hero block-hero--<?= $align ?> block-hero--v<?= $valign ?>" style="--hero-height: <?= $heroHeight ?>;">
  <?php if ($bgImages->isNotEmpty()): ?>
  <div class="block-hero__bg" data-hero-slideshow data-interval="6000">
    <?php foreach ($slides as $i => $bgImage): $first = $i === 0; ?>
    <?php
      // Responsive variants so phones don't pull down the 1920px file. Widths
      // wider than the original are dropped — upscaling only wastes bytes.
      $srcset = '';
      $bgSrc  = $bgImage->url();

      if ($canResize && $bgImage->isResizable()) {
          $widths = array_values(array_filter(
              [768, 1200, 1600, 1920],
              fn ($w) => $w <= $bgImage->width()
          )) ?: [$bgImage->width()];

          $srcset = implode(', ', array_map(
              fn ($w) => $bgImage->thumb(['width' => $w, 'quality' => 82])->url() . ' ' . $w . 'w',
              $widths
          ));
          $bgSrc = $bgImage->thumb(['width' => end($widths), 'quality' => 82])->url();
      }
    ?>
    <?php if ($first): ?>
    <?php /* Only the first slide carries a real src: four 1920px photos racing
             each other is what delays the hero. The rest are swapped in by
             assets/js/index.js once the page has finished loading. */ ?>
    <img
      class="block-hero__slide"
      src="<?= $bgSrc ?>"
      <?php if ($srcset): ?>srcset="<?= $srcset ?>" sizes="100vw"<?php endif ?>
      alt="<?= $bgImage->alt()->or('')->esc() ?>"
      loading="eager"
      fetchpriority="high"
      decoding="async"
    >
    <?php else: ?>
    <img
      class="block-hero__slide"
      data-src="<?= $bgSrc ?>"
      <?php if ($srcset): ?>data-srcset="<?= $srcset ?>" sizes="100vw"<?php endif ?>
      alt=""
      decoding="async"
    >
    <?php endif ?>
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
