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
    <div class="gallery__grid" data-reveal-stagger>
      <?php foreach ($images as $image): ?>
      <?php
        // Serve a sized thumbnail in the grid and a bounded version to the
        // lightbox — never the original, which can be several megabytes.
        $resizable = $image->isResizable();
        $src  = $resizable ? $image->thumb(['width' => 900,  'quality' => 82])->url() : $image->url();
        $href = $resizable ? $image->thumb(['width' => 1800, 'quality' => 82])->url() : $image->url();
      ?>
      <figure class="gallery__item">
        <?php snippet('image', [
          'alt'      => $image->alt(),
          'contain'  => !$crop,
          'lightbox' => true,
          'ratio'    => $ratio,
          'src'      => $src,
          'href'     => $href,
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
