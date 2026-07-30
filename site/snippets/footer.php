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
          <div class="brand-name"><?= t('site.name', '本立比華人播道會') ?></div>
          <div class="brand-sub">BCEFC · Since 1991</div>
        </span>
      </a>
      <p class="foot-about"><?= t('footer.about', '致力於建立一個生命轉化的屬靈大家庭，帶領萬民作主耶穌基督的門徒。') ?></p>
    </div>

    <!-- Col 2: quick links -->
    <?php
      $footNewHerePage  = $site->find('new-here');
      $worshipPage      = $site->find('worship');
      $newsPage         = $site->find('news');
      $chineseSchoolPage = $site->find('chinese-school');
      $footGivingPage   = $site->find('giving');
      $privacyPage      = $site->find('privacy-policy');
    ?>
    <div>
      <h4><?= t('footer.quicklinks', '快速連結') ?></h4>
      <ul>
        <li><a href="<?= $footNewHerePage ? $footNewHerePage->url() : '#' ?>"><?= t('nav.new_here', '新朋友') ?></a></li>
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
          <span>6112 Rumble Street<br>Burnaby, BC V5J 2C7<br><a href="https://www.google.com/maps/search/?api=1&query=6112+Rumble+Street+Burnaby+BC+V5J+2C7" target="_blank" rel="noopener"><?= t('footer.view_map', 'View on Google Maps') ?></a></span>
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
        <li><a href="<?= $worshipPage ? $worshipPage->url() : '#' ?>"><?= t('worship.youth', '青年崇拜') ?> · 11:00 AM</a></li>
        <li><a href="<?= $worshipPage ? $worshipPage->url() : '#' ?>"><?= t('footer.kids_youth', '兒童及青少年主日學') ?></a></li>
      </ul>
    </div>

  </div>

  <div class="foot-bottom wrap">
    <span>&copy; <?= date('Y') ?> <?= t('site.name', '本立比華人播道會') ?> Burnaby Chinese Evangelical Free Church &middot; <?= t('footer.rights', 'All rights reserved.') ?></span>
    <?php if ($privacyPage): ?>
    <a href="<?= $privacyPage->url() ?>" class="foot-bottom__privacy"><?= t('footer.privacy', 'Privacy Policy') ?></a>
    <?php endif ?>
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
