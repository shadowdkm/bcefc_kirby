<?php
/**
 * Contact & Footer Block
 * Contact section with address/phone/email + map embed + quick links
 * 
 * @var \Kirby\Cms\Block $block
 */

$quickLinks = $block->quick_links()->toStructure();
$socials = $block->socials()->toStructure();

?>
<footer class="block-contact-footer">
  <div class="container">
    <div class="block-contact-footer__grid">
      <!-- Logo & Description -->
      <div class="block-contact-footer__col block-contact-footer__col--brand">
        <a href="<?= $site->url() ?>" class="block-contact-footer__logo">
          <?= $site->title()->esc() ?>
        </a>
        <p class="block-contact-footer__tagline">
          <?= $site->description()->or('') ?>
        </p>
        
        <?php if ($socials->isNotEmpty()): ?>
        <div class="block-contact-footer__socials">
          <?php foreach ($socials as $social): ?>
          <a 
            href="<?= $social->url() ?>" 
            class="social-icon social-icon--<?= $social->platform() ?>"
            target="_blank"
            rel="noopener noreferrer"
            aria-label="<?= $social->platform() ?>"
          >
            <svg class="icon"><use href="#icon-<?= $social->platform() ?>"></use></svg>
          </a>
          <?php endforeach ?>
        </div>
        <?php endif ?>
      </div>
      
      <!-- Quick Links -->
      <?php if ($quickLinks->isNotEmpty()): ?>
      <nav class="block-contact-footer__col block-contact-footer__col--links">
        <h3 class="block-contact-footer__heading"><?= t('footer.quicklinks') ?></h3>
        <ul class="block-contact-footer__link-list">
          <?php foreach ($quickLinks as $link): ?>
          <li>
            <a href="<?= $link->url() ?>"><?= $link->label()->esc() ?></a>
          </li>
          <?php endforeach ?>
        </ul>
      </nav>
      <?php endif ?>
      
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
    
    <!-- Copyright -->
    <div class="block-contact-footer__copyright">
      <?php if ($block->copyright_text()->isNotEmpty()): ?>
      <p><?= $block->copyright_text()->esc() ?></p>
      <?php else: ?>
      <p><?= t('footer.copyright') ?></p>
      <?php endif ?>
    </div>
  </div>
</footer>
