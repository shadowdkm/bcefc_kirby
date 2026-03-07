<?php
/**
 * Signup Form Block
 * Button link or embedded iframe for registrations/guest card
 * 
 * @var \Kirby\Cms\Block $block
 */

$mode = $block->mode()->or('button');
$iframeHeight = $block->iframe_height()->or(800);

?>
<section class="block-form-signup">
  <div class="container">
    <?php if ($block->heading()->isNotEmpty() || $block->description()->isNotEmpty()): ?>
    <header class="block-form-signup__header">
      <?php if ($block->heading()->isNotEmpty()): ?>
      <h2 class="block-form-signup__heading"><?= $block->heading()->esc() ?></h2>
      <?php endif ?>
      
      <?php if ($block->description()->isNotEmpty()): ?>
      <p class="block-form-signup__description"><?= $block->description()->esc() ?></p>
      <?php endif ?>
    </header>
    <?php endif ?>
    
    <?php if ($mode->value() === 'button' && $block->form_url()->isNotEmpty()): ?>
    <div class="block-form-signup__button-wrapper">
      <a href="<?= $block->form_url() ?>" class="btn btn--primary btn--large" target="_blank" rel="noopener">
        <?= $block->button_text()->or(t('ui.register'))->esc() ?>
      </a>
    </div>
    
    <?php elseif ($mode->value() === 'embed' && $block->iframe_html()->isNotEmpty()): ?>
    <div class="block-form-signup__embed" style="--iframe-height: <?= $iframeHeight ?>px;">
      <?= $block->iframe_html()->value() ?>
    </div>
    <?php endif ?>
    
    <?php if ($block->privacy_note()->isNotEmpty()): ?>
    <p class="block-form-signup__privacy"><?= $block->privacy_note()->esc() ?></p>
    <?php endif ?>
  </div>
</section>
