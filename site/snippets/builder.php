<?php
/**
 * Builder snippet
 * Renders a blocks field, wrapping each block in a scroll-reveal container
 * so it fades and rises into view as the visitor scrolls (see assets/js/index.js).
 *
 * The first block and any hero block are rendered unwrapped: they sit above the
 * fold, so hiding them until an observer fires would only produce a flash.
 *
 * @var \Kirby\Cms\Blocks $blocks
 */

$index = 0;

foreach ($blocks as $block):
    $skip = $index === 0 || $block->type() === 'hero';
    $index++;

    if ($skip) {
        echo $block;
        continue;
    }
    ?>
    <div class="reveal" data-reveal><?= $block ?></div>
    <?php
endforeach;
