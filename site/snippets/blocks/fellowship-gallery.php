<?php
/**
 * Fellowship Gallery Block
 * Gallery-style overview of all fellowships
 * 
 * @var \Kirby\Cms\Block $block
 */

$fellowships = $block->fellowships()->toStructure();
if ($fellowships->isEmpty()) return;

?>
<section class="block-fellowship-gallery">
  <div class="container">
    <?php if ($block->heading()->isNotEmpty()): ?>
    <header class="block-fellowship-gallery__header">
      <h2 class="block-fellowship-gallery__heading"><?= $block->heading()->esc() ?></h2>
      <?php if ($block->subheading()->isNotEmpty()): ?>
      <p class="block-fellowship-gallery__subheading"><?= $block->subheading()->esc() ?></p>
      <?php endif ?>
    </header>
    <?php endif ?>
    
    <div class="block-fellowship-gallery__grid">
      <?php foreach ($fellowships as $fellowship): 
        $photo = $fellowship->photo()->toFile();
        $hasLink = $fellowship->url()->isNotEmpty();
        $tag = $hasLink ? 'a' : 'div';
      ?>
      <<?= $tag ?> 
        class="fellowship-card"
        <?php if ($hasLink): ?>href="<?= $fellowship->url() ?>"<?php endif ?>
      >
        <div class="fellowship-card__image">
          <?php if ($photo): ?>
          <img 
            src="<?= $photo->thumb(['width' => 400, 'height' => 300, 'crop' => true])->url() ?>" 
            alt="<?= $photo->alt()->or($fellowship->name()) ?>"
            loading="lazy"
          >
          <?php endif ?>
        </div>
        
        <div class="fellowship-card__overlay">
          <h3 class="fellowship-card__name"><?= $fellowship->name()->esc() ?></h3>
          <?php if ($fellowship->tagline()->isNotEmpty()): ?>
          <p class="fellowship-card__tagline"><?= $fellowship->tagline()->esc() ?></p>
          <?php endif ?>
        </div>
      </<?= $tag ?>>
      <?php endforeach ?>
    </div>
  </div>
</section>
