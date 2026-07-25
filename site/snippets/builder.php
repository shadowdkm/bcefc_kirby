<?php
/**
 * Builder snippet
 * Renders a blocks field, wrapping each block in a scroll-reveal container
 * so it fades and rises into view as the visitor scrolls (see assets/js/index.js).
 *
 * The first block and any hero block are rendered unwrapped: they sit above the
 * fold, so hiding them until an observer fires would only produce a flash.
 *
 * Blocks in $selfRevealing place `data-reveal` on their own inner parts, so a
 * wrapper would reveal the whole thing at once and defeat that.
 *
 * @var \Kirby\Cms\Blocks $blocks
 */

$selfRevealing = ['story-rows'];

$index = 0;

foreach ($blocks as $block):
    $skip = $index === 0
        || $block->type() === 'hero'
        || in_array($block->type(), $selfRevealing, true);
    $index++;

    if ($skip) {
        echo $block;
        continue;
    }
    ?>
    <div class="reveal" data-reveal><?= $block ?></div>
    <?php
endforeach;
