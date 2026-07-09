<?php
/*
  Header snippet — BCEFC redesign nav
*/

if (!function_exists('pageUrl')) {
    function pageUrl(string $raw): string {
        $raw = trim($raw);
        if ($raw === '' || $raw === '#') return '#';
        if (
            strpos($raw, 'http')    === 0 ||
            strpos($raw, 'mailto:') === 0 ||
            strpos($raw, 'tel:')    === 0 ||
            strpos($raw, '//')      === 0
        ) {
            return $raw;
        }
        $p = page(trim($raw, '/'));
        return $p ? $p->url() : $raw;
    }
}
?>
<!DOCTYPE html>
<html lang="<?= $kirby->language() ? $kirby->language()->code() : 'en' ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title><?= $page->seo_title()->or($site->title() . ' | ' . $page->title())->esc() ?></title>
  <?php if ($page->seo_description()->isNotEmpty()): ?>
  <meta name="description" content="<?= $page->seo_description()->esc() ?>">
  <?php endif ?>
  <?= css([
    'assets/css/prism.css',
    'assets/css/lightbox.css',
    'assets/css/blocks.css',
    'assets/css/bcefc.css',
    '@auto'
  ]) ?>
  <link rel="shortcut icon" type="image/x-icon" href="<?= url('favicon.ico') ?>">
</head>
<body>

<?php /* SVG Icon Sprite */ ?>
<?php include kirby()->root('assets') . '/icons/icons.svg'; ?>

<nav class="nav" id="site-nav">

  <!-- Brand -->
  <a class="brand" href="<?= $site->url() ?>">
    <svg class="brand-emblem" width="42" height="28" viewBox="6 10 116 74" fill="none" aria-hidden="true">
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
      <div class="brand-sub">Burnaby Chinese Evangelical Free Church</div>
    </span>
  </a>

  <!-- Mobile toggle -->
  <button class="nav-toggle" id="nav-toggle" aria-label="<?= t('menu.toggle', 'Toggle menu') ?>" aria-expanded="false" aria-controls="nav-collapse">
    <svg class="icon icon--menu" aria-hidden="true"><use href="#icon-menu"></use></svg>
    <svg class="icon icon--close" aria-hidden="true"><use href="#icon-close"></use></svg>
  </button>

  <!-- Nav links -->
  <div class="nav-links" id="nav-collapse">
    <?php foreach ($site->children()->listed()->filterBy('uid', '!=', 'giving')->filterBy('uid', '!=', 'new-here') as $item): ?>
    <?php $hasChildren = $item->hasListedChildren(); ?>
    <?php if ($hasChildren): ?>
    <div class="nav-item">
      <a href="<?= $item->url() ?>" <?php e($item->isOpen(), 'aria-current="page"') ?>>
        <?= $item->title()->esc() ?>
        <span class="caret" aria-hidden="true">
          <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
            <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </span>
      </a>
      <div class="nav-dropdown">
        <?php foreach ($item->children()->listed() as $child): ?>
        <a href="<?= $child->url() ?>" <?php e($child->isOpen(), 'aria-current="page"') ?>>
          <?= $child->title()->esc() ?>
        </a>
        <?php endforeach ?>
      </div>
    </div>
    <?php else: ?>
    <a href="<?= $item->url() ?>" <?php e($item->isOpen(), 'aria-current="page"') ?>>
      <?= $item->title()->esc() ?>
    </a>
    <?php endif ?>
    <?php endforeach ?>
  </div>

  <!-- Right: language + new here + giving CTA -->
  <div class="nav-right">
    <?php snippet('language-switcher') ?>
    <?php $newHerePage = $site->find('new-here') ?>
    <a href="<?= $newHerePage ? $newHerePage->url() : '#' ?>" class="btn btn-outline btn-sm">
      <?= t('nav.new_here', '新朋友') ?>
    </a>
    <?php $givingPage = $site->find('giving') ?>
    <a href="<?= $givingPage ? $givingPage->url() : '#' ?>" class="btn btn-primary btn-sm">
      <svg class="icon" aria-hidden="true"><use href="#icon-heart"></use></svg>
      <?= t('nav.giving', '奉獻支持') ?>
    </a>
  </div>

</nav>

<main class="main">
