<?php
$people = $block->people()->toStructure();
if ($people->isEmpty()) return;

$layout = $block->layout()->or('grid');
?>
<section class="block-people-list block-people-list--<?= $layout ?>">
  <div class="container">
    <?php if ($block->heading()->isNotEmpty()): ?>
    <h2 class="people-list__title"><?= $block->heading()->esc() ?></h2>
    <?php endif ?>

    <div class="people-list__grid">
      <?php foreach ($people as $person):
        $photo = $person->photo()->toFile();
      ?>
      <article class="people-list__item">
        <?php if ($photo): ?>
        <img
          class="people-list__photo"
          src="<?= $photo->thumb(['width' => 400, 'height' => 400, 'crop' => true])->url() ?>"
          alt="<?= $photo->alt()->or($person->name())->esc() ?>"
          loading="lazy"
        >
        <?php else: ?>
        <div class="people-list__photo people-list__photo--placeholder">
          <svg class="icon"><use href="#icon-users"></use></svg>
        </div>
        <?php endif ?>

        <div class="people-list__body">
        <h3 class="people-list__name"><?= $person->name()->esc() ?></h3>

        <?php if ($person->role()->isNotEmpty()): ?>
        <p class="people-list__role"><?= $person->role()->esc() ?></p>
        <?php endif ?>

        <?php if ($person->bio()->isNotEmpty()): ?>
        <div class="people-list__bio">
          <?php foreach (preg_split('/\R\s*\R/', trim($person->bio()->value())) as $paragraph): ?>
          <p><?= esc(trim($paragraph)) ?></p>
          <?php endforeach ?>
        </div>
        <?php endif ?>

        <?php if ($person->email()->isNotEmpty()): ?>
        <a href="mailto:<?= $person->email() ?>" class="people-list__email">
          <?= $person->email()->esc() ?>
        </a>
        <?php endif ?>
        <?php if ($person->phone()->isNotEmpty()): ?>
        <a href="tel:<?= $person->phone() ?>" class="people-list__email">
          <?= $person->phone()->esc() ?>
        </a>
        <?php endif ?>
        </div>
      </article>
      <?php endforeach ?>
    </div>
  </div>
</section>
