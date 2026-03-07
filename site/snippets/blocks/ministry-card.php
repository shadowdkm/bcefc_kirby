<?php
/**
 * Ministry Card Block
 * Individual ministry highlight with photo
 * 
 * @var \Kirby\Cms\Block $block
 */

$image = $block->image()->toFile();
$hasLink = $block->url()->isNotEmpty();

?>
<article class="block-ministry-card">
  <div class="container">
    <div class="ministry-card">
      <?php if ($image): ?>
      <div class="ministry-card__image">
        <img 
          src="<?= $image->thumb(['width' => 800, 'height' => 500, 'crop' => true])->url() ?>" 
          alt="<?= $image->alt()->or($block->title()) ?>"
          loading="lazy"
        >
      </div>
      <?php endif ?>
      
      <div class="ministry-card__content">
        <h3 class="ministry-card__title"><?= $block->title()->esc() ?></h3>
        
        <?php if ($block->age_group()->isNotEmpty() || $block->meeting_time()->isNotEmpty()): ?>
        <div class="ministry-card__meta">
          <?php if ($block->age_group()->isNotEmpty()): ?>
          <span class="ministry-card__age"><?= $block->age_group()->esc() ?></span>
          <?php endif ?>
          <?php if ($block->meeting_time()->isNotEmpty()): ?>
          <span class="ministry-card__time"><?= $block->meeting_time()->esc() ?></span>
          <?php endif ?>
        </div>
        <?php endif ?>
        
        <?php if ($block->description()->isNotEmpty()): ?>
        <p class="ministry-card__description"><?= $block->description()->esc() ?></p>
        <?php endif ?>
        
        <?php if ($block->contact_name()->isNotEmpty()): ?>
        <div class="ministry-card__contact">
          <span class="ministry-card__contact-name"><?= $block->contact_name()->esc() ?></span>
          <?php if ($block->contact_email()->isNotEmpty()): ?>
          <a href="mailto:<?= $block->contact_email() ?>" class="ministry-card__contact-email">
            <?= $block->contact_email()->esc() ?>
          </a>
          <?php endif ?>
        </div>
        <?php endif ?>
        
        <?php if ($hasLink): ?>
        <a href="<?= $block->url() ?>" class="ministry-card__link btn btn--outline">
          <?= t('ui.learnmore') ?>
        </a>
        <?php endif ?>
      </div>
    </div>
  </div>
</article>
