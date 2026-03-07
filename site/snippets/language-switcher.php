<?php
/**
 * Language Switcher Snippet
 * Displays compact language buttons: EN | 繁 | 简
 * 
 * Usage: <?php snippet('language-switcher') ?>
 */

// Language code to display label mapping
$labels = [
    'en'    => 'EN',
    'zh-TW' => '繁',
    'zh-CN' => '简',
];

?>
<?php if ($kirby->multilang()): ?>
<nav class="language-switcher" aria-label="<?= t('ui.language', 'Language') ?>">
  <?php 
  $languages = $kirby->languages();
  $count = $languages->count();
  $i = 0;
  foreach ($languages as $language): 
    $i++;
    $isActive = $kirby->language()->code() === $language->code();
    $label = $labels[$language->code()] ?? strtoupper(substr($language->code(), 0, 2));
  ?>
    <a 
      href="<?= $page->url($language->code()) ?>" 
      hreflang="<?= $language->code() ?>"
      <?php e($isActive, 'aria-current="page" class="is-active"', '') ?>
      title="<?= $language->name() ?>"
    ><?= $label ?></a><?php if ($i < $count): ?><span class="language-divider">|</span><?php endif ?>
  <?php endforeach ?>
</nav>
<?php endif ?>
