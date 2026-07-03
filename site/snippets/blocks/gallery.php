<?php
/**
 * Gallery Block
 * A grid of photo cards, each optionally captioned.
 *
 * @var \Kirby\Cms\Block $block
 */

$images = $block->images()->toFiles();
if ($images->isEmpty()) return;

$ratio = $block->ratio()->or('4/3');
$crop  = $block->crop()->isTrue();
?>
<section class="block-gallery">
  <div class="container">
    <div class="gallery__grid">
      <?php foreach ($images as $image): ?>
      <figure class="gallery__item">
        <?php snippet('image', [
          'alt'      => $image->alt(),
          'contain'  => !$crop,
          'lightbox' => true,
          'ratio'    => $ratio,
          'src'      => $image->url(),
        ]) ?>
        <?php if ($image->caption()->isNotEmpty()): ?>
        <figcaption class="gallery__item-caption"><?= $image->caption() ?></figcaption>
        <?php endif ?>
      </figure>
      <?php endforeach ?>
    </div>
    <?php if ($block->caption()->isNotEmpty()): ?>
    <p class="gallery__caption"><?= $block->caption() ?></p>
    <?php endif ?>
  </div>
</section>
