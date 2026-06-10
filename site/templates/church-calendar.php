<?php
$embedUrl   = $page->google_embed_url()->value();
$title      = $page->calendar_title()->or($page->title())->esc();
$subtitle   = $page->calendar_subtitle()->value();
?>
<?php snippet('header') ?>

<section class="cal-hero">
  <div class="container">
    <h1><?= $title ?></h1>
    <?php if ($subtitle): ?>
    <p class="cal-hero__subtitle"><?= esc($subtitle) ?></p>
    <?php endif ?>
  </div>
</section>

<section class="cal-wrap">
  <div class="container">
    <?php if ($embedUrl): ?>
    <div class="cal-google-embed">
      <iframe
        src="<?= esc($embedUrl) ?>&wkst=1&bgcolor=%23ffffff&showTitle=0&showNav=1&showDate=1&showPrint=0&showTabs=1&showCalendars=0&showTz=0&hl=<?= $kirby->language() ? $kirby->language()->code() : 'en' ?>"
        style="border:0"
        width="100%"
        height="700"
        frameborder="0"
        scrolling="no"
        loading="lazy"
      ></iframe>
    </div>
    <?php else: ?>
    <div class="cal-empty">
      <p><?= t('cal.no_embed', '行事曆尚未設定。請在 Panel 貼上 Google Calendar 的 Embed URL。') ?></p>
    </div>
    <?php endif ?>
  </div>
</section>

<?php snippet('footer') ?>
