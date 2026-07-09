<?php
/**
 * Contact Info & Map Block
 * Address/phone/email/hours + a map embed for a specific page's contact section.
 * (Not a site footer -- the shared site footer already covers brand/quick-links/socials/copyright.)
 *
 * @var \Kirby\Cms\Block $block
 */
?>
<div class="block-contact-footer">
  <div class="container">
    <div class="block-contact-footer__grid">
      <!-- Contact Info -->
      <div class="block-contact-footer__col block-contact-footer__col--contact">
        <h3 class="block-contact-footer__heading"><?= t('footer.contact') ?></h3>
        <ul class="block-contact-footer__contact-list">
          <?php if ($block->address()->isNotEmpty()): ?>
          <li class="contact-item">
            <svg class="icon" aria-hidden="true"><use href="#icon-location"></use></svg>
            <span><?= $block->address()->esc() ?></span>
          </li>
          <?php endif ?>
          
          <?php if ($block->phone()->isNotEmpty()): ?>
          <li class="contact-item">
            <svg class="icon" aria-hidden="true"><use href="#icon-phone"></use></svg>
            <a href="tel:<?= $block->phone() ?>"><?= $block->phone()->esc() ?></a>
          </li>
          <?php endif ?>
          
          <?php if ($block->email()->isNotEmpty()): ?>
          <li class="contact-item">
            <svg class="icon" aria-hidden="true"><use href="#icon-email"></use></svg>
            <a href="mailto:<?= $block->email() ?>"><?= $block->email()->esc() ?></a>
          </li>
          <?php endif ?>
          
          <?php if ($block->hours()->isNotEmpty()): ?>
          <li class="contact-item">
            <svg class="icon" aria-hidden="true"><use href="#icon-clock"></use></svg>
            <span><?= $block->hours()->esc() ?></span>
          </li>
          <?php endif ?>
        </ul>
      </div>
      
      <!-- Map -->
      <?php if ($block->map_embed()->isNotEmpty()): ?>
      <div class="block-contact-footer__col block-contact-footer__col--map">
        <h3 class="block-contact-footer__heading"><?= t('footer.map') ?></h3>
        <div class="block-contact-footer__map">
          <?= $block->map_embed()->value() ?>
        </div>
      </div>
      <?php endif ?>
    </div>
  </div>
</div>
