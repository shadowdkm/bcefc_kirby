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
    // Resolve /@/page/<uuid> permalinks (from the Panel link picker) into real
    // URLs. In multilingual mode this yields the current language's URL, so a
    // link keeps working when the page is moved or renamed.
    $output = $text->permalinksToUrls();
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
