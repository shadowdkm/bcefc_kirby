<?php
/**
 * Church Page Template
 * Generic template for blocks-based pages
 */
?>

<?php snippet('header') ?>

<?php if ($page->password_protected()->toBool() && $kirby->session()->get('bcefc_content_unlocked') !== true): ?>
  <?php snippet('password-gate') ?>
<?php elseif ($page->builder()->isNotEmpty()): ?>
  <?php snippet('builder', ['blocks' => $page->builder()->toBlocks()]) ?>
<?php endif ?>

<?php snippet('footer') ?>
