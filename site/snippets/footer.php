<?php
/*
  Footer snippet — BCEFC redesign 4-column dark footer
*/
?>
</main>

<footer class="foot">
  <div class="wrap foot-top">

    <!-- Col 1: brand + about + social -->
    <div>
      <a class="brand" href="<?= $site->url() ?>">
        <svg class="brand-emblem foot-emblem" width="42" height="28" viewBox="6 10 116 74" fill="none" aria-hidden="true">
          <g stroke="currentColor" stroke-width="5" stroke-linejoin="round" stroke-linecap="round" fill="none">
            <path d="M12,77.5 L12,49.6 L18.4,49.1 L43.3,16 L55.5,34.6 L61.9,34.6 L63.6,28.2 L73.5,31.7 L114.7,27 L115.8,65.3 L115.8,77.5" />
          </g>
          <g stroke="currentColor" stroke-width="4.5" stroke-linecap="round">
            <line x1="101.5" y1="42" x2="101.5" y2="62" />
            <line x1="95" y1="49.5" x2="108" y2="49.5" />
          </g>
        </svg>
        <span>
          <div class="brand-name">本立比華人播道會</div>
          <div class="brand-sub">BCEFC · Since 1991</div>
        </span>
      </a>
      <p class="foot-about"><?= t('footer.about', '致力於建立一個生命轉化的屬靈大家庭，帶領萬民作主耶穌基督的門徒。') ?></p>
      <div class="foot-social">
        <a href="https://facebook.com/bcefc" target="_blank" rel="noopener" aria-label="Facebook">
          <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18" aria-hidden="true">
            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
          </svg>
        </a>
        <a href="https://instagram.com/bcefc" target="_blank" rel="noopener" aria-label="Instagram">
          <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18" aria-hidden="true">
            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
          </svg>
        </a>
      </div>
    </div>

    <!-- Col 2: quick links -->
    <?php
      $worshipPage      = $site->find('worship');
      $newsPage         = $site->find('news');
      $chineseSchoolPage = $site->find('chinese-school');
      $footGivingPage   = $site->find('giving');
    ?>
    <div>
      <h4><?= t('footer.quicklinks', '快速連結') ?></h4>
      <ul>
        <li><a href="<?= $worshipPage ? $worshipPage->url() : '#' ?>"><?= t('nav.worship', '主日崇拜時間') ?></a></li>
        <li><a href="<?= $newsPage ? $newsPage->url() : '#' ?>"><?= t('nav.news', '最新消息與活動') ?></a></li>
        <li><a href="<?= $chineseSchoolPage ? $chineseSchoolPage->url() : '#' ?>"><?= t('nav.school', '中文學校') ?></a></li>
        <li><a href="<?= $footGivingPage ? $footGivingPage->url() : '#' ?>"><?= t('nav.giving', '奉獻支持 Giving') ?></a></li>
      </ul>
    </div>

    <!-- Col 3: contact info -->
    <div>
      <h4><?= t('footer.contact', '聯絡資料') ?></h4>
      <div class="foot-contact">
        <div class="c-row">
          <svg class="icon" aria-hidden="true"><use href="#icon-location"></use></svg>
          <span>6112 Rumble Street<br>Burnaby, BC V5J 2C7</span>
        </div>
        <div class="c-row">
          <svg class="icon" aria-hidden="true"><use href="#icon-phone"></use></svg>
          <span><a href="tel:+16044316969">(604) 431-6969</a></span>
        </div>
        <div class="c-row">
          <svg class="icon" aria-hidden="true"><use href="#icon-email"></use></svg>
          <span><a href="mailto:info@bcefc.ca">info@bcefc.ca</a></span>
        </div>
        <div class="c-row">
          <svg class="icon" aria-hidden="true"><use href="#icon-clock"></use></svg>
          <span><?= t('footer.office_hours', '辦公時間 週二至週五 9AM–5PM') ?></span>
        </div>
      </div>
    </div>

    <!-- Col 4: Sunday services -->
    <div>
      <h4><?= t('footer.sunday_services', '主日聚會') ?></h4>
      <ul>
        <li><a href="<?= $worshipPage ? $worshipPage->url() : '#' ?>"><?= t('worship.mandarin', '國語崇拜') ?> · 9:15 AM</a></li>
        <li><a href="<?= $worshipPage ? $worshipPage->url() : '#' ?>"><?= t('worship.cantonese', '粵語崇拜') ?> · 11:00 AM</a></li>
        <li><a href="<?= $worshipPage ? $worshipPage->url() : '#' ?>"><?= t('worship.english', '英語崇拜') ?> · 11:00 AM</a></li>
        <li><a href="<?= $worshipPage ? $worshipPage->url() : '#' ?>"><?= t('footer.kids_youth', '兒童及青少年主日學') ?></a></li>
      </ul>
    </div>

  </div>

  <div class="foot-bottom wrap">
    &copy; <?= date('Y') ?> 本立比華人播道會 Burnaby Chinese Evangelical Free Church &middot; All Rights Reserved.
  </div>
</footer>

<?= js([
  'assets/js/prism.js',
  'assets/js/lightbox.js',
  'assets/js/index.js',
  '@auto'
]) ?>
<script>
// Mobile nav toggle
(function() {
  var toggle = document.getElementById('nav-toggle');
  var nav = document.getElementById('site-nav');
  if (!toggle || !nav) return;
  toggle.addEventListener('click', function() {
    var expanded = this.getAttribute('aria-expanded') === 'true';
    this.setAttribute('aria-expanded', !expanded);
    nav.classList.toggle('nav-open');
  });
  // Mobile dropdown toggles
  nav.querySelectorAll('.nav-item > a').forEach(function(link) {
    link.addEventListener('click', function(e) {
      if (window.innerWidth < 1024) {
        e.preventDefault();
        this.closest('.nav-item').classList.toggle('dropdown-open');
      }
    });
  });
})();
</script>

</body>
</html>
