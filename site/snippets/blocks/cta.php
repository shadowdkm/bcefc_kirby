<?php
/**
 * CTA Banner Block
 * Strong call-to-action strip (signup, giving, newcomer guide)
 * 
 * @var \Kirby\Cms\Block $block
 */

$variant = $block->variant()->or('primary');
$alignment = $block->alignment()->or('center');

?>
<section class="block-cta block-cta--<?= $variant ?> block-cta--<?= $alignment ?>">
  <div class="container">
    <div class="block-cta__inner">
      <div class="block-cta__content">
        <h2 class="block-cta__title"><?= $block->title()->esc() ?></h2>
        
        <?php if ($block->text()->isNotEmpty()): ?>
        <p class="block-cta__text"><?= $block->text()->esc() ?></p>
        <?php endif ?>
      </div>
      
      <?php if ($block->button_text()->isNotEmpty()): ?>
      <div class="block-cta__action">
        <a href="<?= $block->button_url()->or('#') ?>" class="btn btn--<?php e($variant->value() === 'primary', 'white', 'primary') ?> btn--large">
          <?= $block->button_text()->esc() ?>
        </a>
      </div>
      <?php endif ?>
    </div>
  </div>
</section>
