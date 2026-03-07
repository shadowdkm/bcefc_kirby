<?php
/**
 * People / Team List Block
 * Pastors/staff/deacons list with photo + role + bio
 * 
 * @var \Kirby\Cms\Block $block
 */

$people = $block->people()->toStructure();
if ($people->isEmpty()) return;

$layout = $block->layout()->or('grid');

?>
<section class="block-people-list block-people-list--<?= $layout ?>">
  <div class="container">
    <?php if ($block->heading()->isNotEmpty()): ?>
    <header class="block-people-list__header">
      <h2 class="block-people-list__heading"><?= $block->heading()->esc() ?></h2>
    </header>
    <?php endif ?>
    
    <div class="block-people-list__grid">
      <?php foreach ($people as $person): 
        $photo = $person->photo()->toFile();
      ?>
      <article class="person-card">
        <div class="person-card__photo">
          <?php if ($photo): ?>
          <img 
            src="<?= $photo->thumb(['width' => 300, 'height' => 300, 'crop' => true])->url() ?>" 
            alt="<?= $photo->alt()->or($person->name()) ?>"
            loading="lazy"
          >
          <?php else: ?>
          <div class="person-card__placeholder">
            <svg class="icon"><use href="#icon-user"></use></svg>
          </div>
          <?php endif ?>
        </div>
        
        <div class="person-card__content">
          <h3 class="person-card__name">
            <?= $person->name()->esc() ?>
            <?php if ($person->name_en()->isNotEmpty()): ?>
            <span class="person-card__name-en"><?= $person->name_en()->esc() ?></span>
            <?php endif ?>
          </h3>
          
          <?php if ($person->role()->isNotEmpty()): ?>
          <p class="person-card__role"><?= $person->role()->esc() ?></p>
          <?php endif ?>
          
          <?php if ($person->bio()->isNotEmpty()): ?>
          <p class="person-card__bio"><?= $person->bio()->esc() ?></p>
          <?php endif ?>
          
          <?php if ($person->email()->isNotEmpty() || $person->phone()->isNotEmpty()): ?>
          <div class="person-card__contact">
            <?php if ($person->email()->isNotEmpty()): ?>
            <a href="mailto:<?= $person->email() ?>" class="person-card__email">
              <?= $person->email()->esc() ?>
            </a>
            <?php endif ?>
            <?php if ($person->phone()->isNotEmpty()): ?>
            <a href="tel:<?= $person->phone() ?>" class="person-card__phone">
              <?= $person->phone()->esc() ?>
            </a>
            <?php endif ?>
          </div>
          <?php endif ?>
        </div>
      </article>
      <?php endforeach ?>
    </div>
  </div>
</section>
