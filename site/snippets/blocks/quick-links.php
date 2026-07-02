<?php
/**
 * Quick Links Block — qcard design
 */

$items = $block->items()->toStructure();
if ($items->isEmpty()) return;

$iconMap = [
  'time'    => 'clock',
  'people'  => 'users',
  'news'    => 'book',
  'church'  => 'cross',
];

?>
<section style="padding: 52px 0; position: relative; z-index: 2;">
  <div class="wrap-wide">
    <div class="qlinks" style="--columns: <?= $items->count() ?>;">
      <?php foreach ($items as $item):
        $iconRaw = (string)$item->icon();
        $icon    = isset($iconMap[$iconRaw]) ? $iconMap[$iconRaw] : $iconRaw;
        $url     = pageUrl((string)$item->url());
        $feature = (string)$item->emphasis() === 'true';
      ?>
      <a href="<?= esc($url) ?>" class="qcard<?= $feature ? ' feature' : '' ?>">
        <span class="q-ico">
          <svg class="icon" aria-hidden="true"><use href="#icon-<?= esc($icon) ?>"></use></svg>
        </span>
        <span>
          <div class="q-title"><?= $item->title()->esc() ?></div>
          <?php if ($item->subtitle()->isNotEmpty()): ?>
          <div class="q-sub"><?= $item->subtitle()->esc() ?></div>
          <?php endif ?>
        </span>
        <span class="q-go">
          <?= t('ui.goto', '前往') ?>
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </span>
      </a>
      <?php endforeach ?>
    </div>
  </div>
</section>
