<?php
/**
 * Announcements Block
 * Latest notices (manual items or query from pages)
 * 
 * @var \Kirby\Cms\Block $block
 */

$mode = $block->mode()->or('manual');
$limit = $block->limit()->or(5)->toInt();

// Get items based on mode
if ($mode->value() === 'query' && $block->query_parent()->isNotEmpty()) {
    $parentPage = page($block->query_parent()->value());
    $items = $parentPage ? $parentPage->children()->listed()->sortBy('date', 'desc')->limit($limit) : [];
    $isQuery = true;
} else {
    $items = $block->items()->toStructure();
    $isQuery = false;
}

if ((is_object($items) && $items->isEmpty()) || (is_array($items) && empty($items))) return;

?>
<section class="block-announcements">
  <div class="container">
    <?php if ($block->heading()->isNotEmpty()): ?>
    <header class="block-announcements__header">
      <h2 class="block-announcements__heading"><?= $block->heading()->esc() ?></h2>
      <?php if ($block->view_all_url()->isNotEmpty()): ?>
      <a href="<?= $block->view_all_url() ?>" class="block-announcements__link">
        <?= t('ui.viewall') ?>
        <span class="arrow">→</span>
      </a>
      <?php endif ?>
    </header>
    <?php endif ?>
    
    <ul class="block-announcements__list">
      <?php foreach ($items as $item): 
        if ($isQuery) {
          $title = $item->title();
          $date = $item->date()->isNotEmpty() ? $item->date()->toDate('Y-m-d') : null;
          $tag = $item->tag()->or('');
          $url = $item->url();
        } else {
          $title = $item->title();
          $date = $item->date()->isNotEmpty() ? $item->date()->toDate('Y-m-d') : null;
          $tag = $item->tag()->or('');
          $url = $item->url()->or('');
        }
      ?>
      <li class="announcement-item">
        <?php if ($date): ?>
        <time class="announcement-item__date" datetime="<?= $date ?>"><?= date('M d', strtotime($date)) ?></time>
        <?php endif ?>
        
        <div class="announcement-item__content">
          <?php if ($tag && is_object($tag) ? $tag->isNotEmpty() : !empty($tag)): ?>
          <span class="announcement-item__tag"><?= is_object($tag) ? $tag->esc() : e($tag) ?></span>
          <?php endif ?>
          
          <?php if (is_object($url) ? $url->isNotEmpty() : !empty($url)): ?>
          <a href="<?= $url ?>" class="announcement-item__title"><?= is_object($title) ? $title->esc() : e($title) ?></a>
          <?php else: ?>
          <span class="announcement-item__title"><?= is_object($title) ? $title->esc() : e($title) ?></span>
          <?php endif ?>
        </div>
        
        <span class="announcement-item__arrow">→</span>
      </li>
      <?php endforeach ?>
    </ul>
  </div>
</section>
