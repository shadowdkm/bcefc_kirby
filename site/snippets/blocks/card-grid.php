<?php
/**
 * Card Grid Block
 * Generic grid of content cards (ministries, resources, highlights)
 * 
 * @var \Kirby\Cms\Block $block
 */

$items = $block->items()->toStructure();
if ($items->isEmpty()) return;

$columns = $block->columns()->or('3');
$cardStyle = $block->card_style()->or('default');
$imageRatio = $block->image_ratio()->or('3/2');

?>
<section class="block-card-grid block-card-grid--<?= $cardStyle ?>">
  <div class="container">
    <div class="block-card-grid__grid" style="--columns: <?= $columns ?>; --image-ratio: <?= $imageRatio ?>;">
      <?php foreach ($items as $item): 
        $image = $item->image()->toFile();
        $hasLink = $item->url()->isNotEmpty();
        $tag = $hasLink ? 'a' : 'div';
      ?>
      <<?= $tag ?> 
        class="card-grid-item"
        <?php if ($hasLink): ?>href="<?= $item->url() ?>"<?php endif ?>
      >
        <?php if ($image): ?>
        <div class="card-grid-item__image">
          <img 
            src="<?= $image->thumb(['width' => 600, 'quality' => 80])->url() ?>" 
            alt="<?= $image->alt()->or($item->title()) ?>"
            loading="lazy"
          >
          <?php if ($item->badge()->isNotEmpty()): ?>
          <span class="card-grid-item__badge card-grid-item__badge--<?= $item->badge_color()->or('primary') ?>">
            <?= $item->badge()->esc() ?>
          </span>
          <?php endif ?>
        </div>
        <?php endif ?>
        
        <div class="card-grid-item__content">
          <h3 class="card-grid-item__title"><?= $item->title()->esc() ?></h3>
          <?php if ($item->text()->isNotEmpty()): ?>
          <p class="card-grid-item__text"><?= $item->text()->esc() ?></p>
          <?php endif ?>
        </div>
        
        <?php if ($hasLink): ?>
        <span class="card-grid-item__arrow">→</span>
        <?php endif ?>
      </<?= $tag ?>>
      <?php endforeach ?>
    </div>
  </div>
</section>
