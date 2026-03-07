<?php
/**
 * Church Page Template
 * Generic template for blocks-based pages
 */
?>

<?php snippet('header') ?>

<?php if ($page->builder()->isNotEmpty()): ?>
  <?= $page->builder()->toBlocks() ?>
<?php endif ?>

<?php snippet('footer') ?>
