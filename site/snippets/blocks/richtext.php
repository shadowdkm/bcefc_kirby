<?php
/**
 * Rich Text Block
 * Long-form content (about, beliefs, policies)
 * Uses nested blocks for flexible content
 * 
 * @var \Kirby\Cms\Block $block
 */

$content = $block->content()->toBlocks();
if ($content->isEmpty()) return;

?>
<article class="block-richtext">
  <div class="container">
    <div class="block-richtext__content prose">
      <?= $content ?>
    </div>
  </div>
</article>
