<?php
/*
  Footer snippet for BCEFC Church Website
  Based on sitemap requirements:
  - Address & Map
  - Contact (phone, email)
  - Quick links
  - Social media
  - Copyright
*/
?>
  </main>

  <footer class="site-footer">
    <div class="site-footer__main">
      <div class="container">
        <div class="site-footer__grid">
          
          <!-- Column 1: Church Info -->
          <div class="site-footer__col site-footer__col--info">
            <div class="site-footer__logo">
              <span class="site-footer__logo-main">BCEFC</span>
              <span class="site-footer__logo-sub"><?= t('site.subtitle', 'BURNABY CHINESE EVANGELICAL FREE CHURCH') ?></span>
            </div>
            <p class="site-footer__tagline"><?= t('site.tagline', '同行深化靈命・生活延展真光') ?></p>
          </div>
          
          <!-- Column 2: Contact Info -->
          <div class="site-footer__col">
            <h3 class="site-footer__heading"><?= t('footer.contact', 'Contact Us') ?></h3>
            <address class="site-footer__address">
              <p>
                <svg class="icon"><use href="#icon-location"></use></svg>
                <span>6580 Thomas Street<br>Burnaby, BC V5B 4P9</span>
              </p>
              <p>
                <svg class="icon"><use href="#icon-phone"></use></svg>
                <a href="tel:+16042991414">(604) 299-1414</a>
              </p>
              <p>
                <svg class="icon"><use href="#icon-email"></use></svg>
                <a href="mailto:info@bcefc.ca">info@bcefc.ca</a>
              </p>
              <p>
                <svg class="icon"><use href="#icon-clock"></use></svg>
                <span><?= t('footer.office_hours', 'Office: Mon-Fri 9am-5pm') ?></span>
              </p>
            </address>
          </div>
          
          <!-- Column 3: Quick Links -->
          <div class="site-footer__col">
            <h3 class="site-footer__heading"><?= t('footer.quicklinks', 'Quick Links') ?></h3>
            <ul class="site-footer__links">
              <li><a href="<?= url('about') ?>"><?= t('nav.about', 'About Us') ?></a></li>
              <li><a href="<?= url('worship') ?>"><?= t('nav.worship', 'Worship') ?></a></li>
              <li><a href="<?= url('ministries') ?>"><?= t('nav.ministries', 'Ministries') ?></a></li>
              <li><a href="<?= url('news') ?>"><?= t('nav.news', 'News') ?></a></li>
              <li><a href="<?= url('new-here') ?>"><?= t('nav.new_here', 'New Here') ?></a></li>
              <li><a href="<?= url('giving') ?>"><?= t('nav.giving', 'Giving') ?></a></li>
            </ul>
          </div>
          
          <!-- Column 4: Connect -->
          <div class="site-footer__col">
            <h3 class="site-footer__heading"><?= t('footer.connect', 'Connect') ?></h3>
            <div class="site-footer__social">
              <a href="https://facebook.com/bcefc" target="_blank" rel="noopener" aria-label="Facebook">
                <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
              </a>
              <a href="https://instagram.com/bcefc" target="_blank" rel="noopener" aria-label="Instagram">
                <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                </svg>
              </a>
              <a href="https://youtube.com/@bcefc" target="_blank" rel="noopener" aria-label="YouTube">
                <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                </svg>
              </a>
            </div>
            
            <!-- Map embed placeholder -->
            <div class="site-footer__map">
              <a href="https://maps.google.com/?q=6580+Thomas+Street+Burnaby+BC" target="_blank" rel="noopener" class="site-footer__map-link">
                <svg class="icon"><use href="#icon-location"></use></svg>
                <?= t('footer.view_map', 'View on Google Maps') ?>
              </a>
            </div>
          </div>
          
        </div>
      </div>
    </div>
    
    <!-- Bottom bar -->
    <div class="site-footer__bottom">
      <div class="container">
        <p class="site-footer__copyright">
          &copy; <?= date('Y') ?> <?= $site->title()->esc() ?>. <?= t('footer.rights', 'All rights reserved.') ?>
        </p>
        <nav class="site-footer__legal">
          <a href="<?= url('privacy') ?>"><?= t('footer.privacy', 'Privacy Policy') ?></a>
        </nav>
      </div>
    </div>
  </footer>

  <?= js([
    'assets/js/prism.js',
    'assets/js/lightbox.js',
    'assets/js/index.js',
    '@auto'
  ]) ?>
  
  <script>
    // Mobile menu toggle
    document.addEventListener('DOMContentLoaded', function() {
      const toggle = document.querySelector('.site-header__toggle');
      const nav = document.querySelector('.site-header__nav');
      
      if (toggle && nav) {
        toggle.addEventListener('click', function() {
          const expanded = this.getAttribute('aria-expanded') === 'true';
          this.setAttribute('aria-expanded', !expanded);
          nav.classList.toggle('is-open');
          document.body.classList.toggle('nav-open');
        });
      }
      
      // Dropdown toggles for mobile
      const dropdownItems = document.querySelectorAll('.site-header__item.has-dropdown > .site-header__link');
      dropdownItems.forEach(function(item) {
        item.addEventListener('click', function(e) {
          if (window.innerWidth < 1024) {
            e.preventDefault();
            this.parentElement.classList.toggle('dropdown-open');
          }
        });
      });
    });
  </script>

</body>
</html>
