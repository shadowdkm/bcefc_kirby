<?php

/*
  Snippets are a great way to store code snippets for reuse
  or to keep your templates clean.

  Block snippets control the HTML for individual blocks
  in the blocks field. This image snippet overwrites
  Kirby's default image block to add custom classes
  and data attributes.

  More about snippets:
  https://getkirby.com/docs/guide/templates/snippets
*/

$src  = null;
$full = null;

if ($block->location()->value() === 'web') {
    $alt  = $block->alt();
    $src  = $block->src();
    $full = $src;
} else if ($image = $block->image()->toFile()) {
    $alt = $block->alt()->or($image->alt());
    // Sized thumbnail inline, bounded version for the lightbox — not the original.
    $resizable = $image->isResizable();
    $src  = $resizable ? $image->thumb(['width' => 1200, 'quality' => 82])->url() : $image->url();
    $full = $resizable ? $image->thumb(['width' => 1800, 'quality' => 82])->url() : $image->url();
}

?>
<?php if ($src): ?>
<figure>
  <?php snippet('image', [
    'alt'      => $alt,
    'contain'  => $block->crop()->isFalse(),
    'lightbox' => $block->link()->isEmpty(),
    'href'     => $block->link()->or($full),
    'src'      => $src,
    'ratio'    => $block->ratio()->or('auto')
  ]) ?>

  <?php if ($block->caption()->isNotEmpty()): ?>
  <figcaption class="img-caption">
    <?= $block->caption() ?>
  </figcaption>
  <?php endif ?>
</figure>
<?php endif ?>
