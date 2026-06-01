<?php
$fellowships = $block->fellowships()->toStructure();
if ($fellowships->isEmpty()) return;
?>
<section class="block-fellowship-gallery">
  <div class="container">
    <?php if ($block->heading()->isNotEmpty()): ?>
    <header class="fellowship-gallery__header">
      <h2 class="fellowship-gallery__title"><?= $block->heading()->esc() ?></h2>
      <?php if ($block->subheading()->isNotEmpty()): ?>
      <p class="fellowship-gallery__subtitle"><?= $block->subheading()->esc() ?></p>
      <?php endif ?>
    </header>
    <?php endif ?>

    <div class="fellowship-gallery__grid">
      <?php foreach ($fellowships as $fellowship):
        $photo = $fellowship->photo()->toFile();
        $hasLink = $fellowship->url()->isNotEmpty();
        $tag = $hasLink ? 'a' : 'div';
      ?>
      <<?= $tag ?>
        class="fellowship-item"
        <?php if ($hasLink): ?>href="<?= $fellowship->url() ?>"<?php endif ?>
      >
        <?php if ($photo): ?>
        <img
          class="fellowship-item__image"
          src="<?= $photo->thumb(['width' => 800, 'height' => 600, 'crop' => true])->url() ?>"
          alt="<?= $photo->alt()->or($fellowship->name()) ?>"
          loading="lazy"
        >
        <?php endif ?>

        <div class="fellowship-item__overlay">
          <h3 class="fellowship-item__name"><?= $fellowship->name()->esc() ?></h3>
          <?php if ($fellowship->tagline()->isNotEmpty()): ?>
          <p class="fellowship-item__info"><?= $fellowship->tagline()->esc() ?></p>
          <?php endif ?>
        </div>
      </<?= $tag ?>>
      <?php endforeach ?>
    </div>
  </div>
</section>
