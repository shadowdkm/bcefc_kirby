<?php
/**
 * FAQ / Accordion Block
 * Collapsible Q&A sections
 * 
 * @var \Kirby\Cms\Block $block
 */

$items = $block->items()->toStructure();
if ($items->isEmpty()) return;

$initiallyOpen = $block->initially_open()->or('0')->value();

?>
<section class="block-faq">
  <div class="container">
    <?php if ($block->heading()->isNotEmpty()): ?>
    <header class="block-faq__header">
      <h2 class="block-faq__heading"><?= $block->heading()->esc() ?></h2>
    </header>
    <?php endif ?>
    
    <div class="block-faq__list">
      <?php $index = 0; foreach ($items as $item): 
        $isOpen = ($initiallyOpen === 'all') || ($initiallyOpen === '1' && $index === 0);
      ?>
      <details class="faq-item"<?php e($isOpen, ' open') ?>>
        <summary class="faq-item__question">
          <span class="faq-item__question-text"><?= $item->question()->esc() ?></span>
          <span class="faq-item__icon" aria-hidden="true">
            <span class="faq-item__icon-plus">+</span>
            <span class="faq-item__icon-minus">−</span>
          </span>
        </summary>
        <div class="faq-item__answer">
          <?= $item->answer()->kt() ?>
        </div>
      </details>
      <?php $index++; endforeach ?>
    </div>
  </div>
</section>
