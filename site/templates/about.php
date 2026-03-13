<?php
/**
 * About Page Template
 * Uses the builder field for blocks-based content
 */
?>

<?php snippet('header') ?>

<?php if ($page->builder()->isNotEmpty()): ?>
  <?= $page->builder()->toBlocks() ?>
<?php endif ?>

<?php snippet('footer') ?>
