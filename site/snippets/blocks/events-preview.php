<?php
/**
 * Upcoming Events Preview Block
 * Event cards (manual or from query)
 * 
 * @var \Kirby\Cms\Block $block
 */

$mode = $block->mode()->or('manual');
$limit = $block->limit()->or(3)->toInt();

// Get items based on mode
if ($mode->value() === 'query' && $block->query_parent()->isNotEmpty()) {
    $parentPage = page($block->query_parent()->value());
    $today = date('Y-m-d');
    $items = $parentPage ? $parentPage->children()->listed()->filter(function($p) use ($today) {
        return $p->date()->toDate('Y-m-d') >= $today;
    })->sortBy('date', 'asc')->limit($limit) : [];
    $isQuery = true;
} else {
    $items = $block->items()->toStructure();
    $isQuery = false;
}

if ((is_object($items) && $items->isEmpty()) || (is_array($items) && empty($items))) return;

?>
<section class="block-events-preview">
  <div class="container">
    <?php if ($block->heading()->isNotEmpty()): ?>
    <header class="block-events-preview__header">
      <h2 class="block-events-preview__heading"><?= $block->heading()->esc() ?></h2>
      <?php if ($block->view_all_url()->isNotEmpty()): ?>
      <a href="<?= $block->view_all_url() ?>" class="block-events-preview__link">
        <?= t('ui.viewall') ?>
        <span class="arrow">→</span>
      </a>
      <?php endif ?>
    </header>
    <?php endif ?>
    
    <div class="block-events-preview__grid">
      <?php foreach ($items as $item): 
        if ($isQuery) {
          $title = $item->title();
          $date = $item->date()->toDate('Y-m-d');
          $time = $item->time()->or('');
          $location = $item->location()->or('');
          $image = $item->image()->toFile();
          $url = $item->url();
        } else {
          $title = $item->title();
          $date = $item->date()->toDate('Y-m-d');
          $time = $item->time()->or('');
          $location = $item->location()->or('');
          $image = $item->image()->toFile();
          $url = $item->url()->or('');
        }
        $hasLink = is_object($url) ? $url->isNotEmpty() : !empty($url);
        $tag = $hasLink ? 'a' : 'div';
      ?>
      <<?= $tag ?> 
        class="event-card"
        <?php if ($hasLink): ?>href="<?= $url ?>"<?php endif ?>
      >
        <?php if ($image): ?>
        <div class="event-card__image">
          <img 
            src="<?= $image->thumb(['width' => 400, 'height' => 250, 'crop' => true])->url() ?>" 
            alt="<?= $image->alt()->or($title) ?>"
            loading="lazy"
          >
        </div>
        <?php endif ?>
        
        <div class="event-card__content">
          <div class="event-card__date-badge">
            <span class="event-card__month"><?= date('M', strtotime($date)) ?></span>
            <span class="event-card__day"><?= date('d', strtotime($date)) ?></span>
          </div>
          
          <div class="event-card__details">
            <h3 class="event-card__title"><?= is_object($title) ? $title->esc() : e($title) ?></h3>
            
            <div class="event-card__meta">
              <?php if ($time && (is_object($time) ? $time->isNotEmpty() : !empty($time))): ?>
              <span class="event-card__time"><?= is_object($time) ? $time->esc() : e($time) ?></span>
              <?php endif ?>
              <?php if ($location && (is_object($location) ? $location->isNotEmpty() : !empty($location))): ?>
              <span class="event-card__location"><?= is_object($location) ? $location->esc() : e($location) ?></span>
              <?php endif ?>
            </div>
          </div>
        </div>
      </<?= $tag ?>>
      <?php endforeach ?>
    </div>
  </div>
</section>
