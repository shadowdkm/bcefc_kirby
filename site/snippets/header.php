<?php
/*
  Header snippet for BCEFC Church Website
  Matches the design from screenshots with:
  - Logo (BCEFC branding)
  - Main navigation with dropdowns
  - Language switcher
  - Giving CTA button
*/
?>
<!DOCTYPE html>
<html lang="<?= $kirby->language() ? $kirby->language()->code() : 'en' ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  
  <title><?= $site->title()->esc() ?> | <?= $page->title()->esc() ?></title>
  
  <?= css([
    'assets/css/prism.css',
    'assets/css/lightbox.css',
    'assets/css/index.css',
    'assets/css/blocks.css',
    '@auto'
  ]) ?>
  
  <link rel="shortcut icon" type="image/x-icon" href="<?= url('favicon.ico') ?>">
</head>
<body>

  <?php /* SVG Icon Sprite */ ?>
  <?php include kirby()->root('assets') . '/icons/icons.svg'; ?>

  <header class="site-header">
    <div class="site-header__container container">
      
      <!-- Logo -->
      <a class="site-header__logo" href="<?= $site->url() ?>">
        <span class="site-header__logo-main">BCEFC</span>
        <span class="site-header__logo-sub"><?= t('site.subtitle', 'BURNABY CHINESE EVANGELICAL FREE CHURCH') ?></span>
      </a>
      
      <!-- Mobile menu toggle -->
      <button class="site-header__toggle" aria-label="<?= t('menu.toggle', 'Toggle menu') ?>" aria-expanded="false">
        <svg class="icon icon--menu"><use href="#icon-menu"></use></svg>
        <svg class="icon icon--close"><use href="#icon-close"></use></svg>
      </button>
      
      <!-- Navigation -->
      <nav class="site-header__nav" id="main-nav">
        <ul class="site-header__menu">
          <?php foreach ($site->children()->listed()->filterBy('uid', '!=', 'giving') as $item): ?>
          <li class="site-header__item<?php e($item->hasListedChildren(), ' has-dropdown') ?>">
            <a 
              href="<?= $item->url() ?>" 
              <?php e($item->isOpen(), 'aria-current="page"') ?>
              class="site-header__link"
            >
              <?= $item->title()->esc() ?>
              <?php if ($item->hasListedChildren()): ?>
              <svg class="icon icon--dropdown"><use href="#icon-chevron-down"></use></svg>
              <?php endif ?>
            </a>
            
            <?php if ($item->hasListedChildren()): ?>
            <ul class="site-header__dropdown">
              <?php foreach ($item->children()->listed() as $child): ?>
              <li>
                <a href="<?= $child->url() ?>" <?php e($child->isOpen(), 'aria-current="page"') ?>>
                  <?= $child->title()->esc() ?>
                </a>
              </li>
              <?php endforeach ?>
            </ul>
            <?php endif ?>
          </li>
          <?php endforeach ?>

          <!-- More dropdown for overflow items (Priority+ pattern) -->
          <li class="site-header__item site-header__more has-dropdown" style="display: none;">
            <button class="site-header__link site-header__more-btn" aria-expanded="false">
              <?= t('nav.more', 'More') ?> (<span class="site-header__more-count">0</span>)
              <svg class="icon icon--dropdown"><use href="#icon-chevron-down"></use></svg>
            </button>
            <ul class="site-header__dropdown site-header__more-dropdown">
              <!-- Items will be dynamically added here by priority-nav.js -->
            </ul>
          </li>
        </ul>
        
        <!-- Right side: Language + Giving -->
        <div class="site-header__actions">
          <?php snippet('language-switcher') ?>
          
          <a href="<?= url('giving') ?>" class="site-header__giving btn btn--accent">
            <?= t('nav.giving', 'Giving') ?>
          </a>
        </div>
      </nav>
      
    </div>
  </header>

  <main class="main">
