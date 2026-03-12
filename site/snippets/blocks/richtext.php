<?php
/**
 * Rich Text Block
 * Long-form content (about, beliefs, policies)
 * Supports both 'text' field (HTML) and 'content' field (nested blocks)
 * 
 * @var \Kirby\Cms\Block $block
 */

// Support 'text' field (direct HTML)
$text = $block->text();

// Check if we have direct text content
if ($text->isNotEmpty()) {
    $output = $text;
} else {
    return; // Nothing to display
}

?>
<article class="block-richtext">
  <div class="container">
    <div class="block-richtext__content prose">
      <?= $output ?>
    </div>
  </div>
</article>
