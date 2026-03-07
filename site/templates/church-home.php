<?php
/**
 * Church Home Template
 * Renders blocks-based home page
 */
?>

<?php snippet('header') ?>

<?php if ($page->builder()->isNotEmpty()): ?>
  <?= $page->builder()->toBlocks() ?>
<?php endif ?>

<?php snippet('footer') ?>
