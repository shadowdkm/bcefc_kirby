<?php
/**
 * Story Rows Block
 * Alternating photo / text rows — photo left on odd rows, right on even.
 *
 * Each row carries its own `data-reveal`, so rows animate as the visitor
 * reaches them rather than all firing when the block's top edge appears.
 * site/snippets/builder.php therefore leaves this block unwrapped.
 *
 * @var \Kirby\Cms\Block $block
 */

$rows = $block->rows()->toStructure();
if ($rows->isEmpty()) return;

$ratio = $block->ratio()->or('4/3');
?>
<section class="block-story-rows">
  <div class="container">
    <?php foreach ($rows as $row): ?>
    <?php $photo = $row->photo()->toFile(); ?>
    <div class="story-row<?= $photo ? '' : ' story-row--textonly' ?>" data-reveal>
      <?php if ($photo): ?>
      <?php
        // Sized thumbnail inline, bounded version for the lightbox — matches
        // the gallery block, so originals are never sent to the browser.
        $resizable = $photo->isResizable();
        $src  = $resizable ? $photo->thumb(['width' => 900,  'quality' => 82])->url() : $photo->url();
        $href = $resizable ? $photo->thumb(['width' => 1800, 'quality' => 82])->url() : $photo->url();
      ?>
      <figure class="story-row__media">
        <?php snippet('image', [
          'alt'      => $photo->alt()->or($row->title()),
          'contain'  => false,
          'lightbox' => true,
          'ratio'    => $ratio,
          'src'      => $src,
          'href'     => $href,
        ]) ?>
      </figure>
      <?php endif ?>

      <div class="story-row__body">
        <h3 class="story-row__title"><?= $row->title()->esc() ?></h3>
        <?php if ($row->text()->isNotEmpty()): ?>
        <div class="story-row__text"><?= $row->text()->kt() ?></div>
        <?php endif ?>
      </div>
    </div>
    <?php endforeach ?>
  </div>
</section>
