<?php
$cover = $page->cover()->toFile();
?>
<?php snippet('header') ?>

<article class="pastor-post">

  <?php if ($cover): ?>
  <div class="pastor-post__cover">
    <img src="<?= $cover->thumb(['width' => 1400, 'height' => 560, 'crop' => true])->url() ?>"
         alt="<?= $cover->alt()->or($page->title()) ?>">
  </div>
  <?php endif ?>

  <div class="container pastor-post__inner">

    <header class="pastor-post__header">
      <a href="<?= $page->parent()->url() ?>" class="pastor-post__back">
        ← <?= t('pastor.updates.back', '返回牧者心語') ?>
      </a>

      <?php $dateFormat = $kirby->language() && $kirby->language()->code() === 'en' ? 'F j, Y' : 'Y年n月j日' ?>
      <div class="pastor-post__meta">
        <time datetime="<?= $page->date()->toDate('c') ?>">
          <?= $page->date()->toDate($dateFormat) ?>
        </time>
        <?php if ($page->author()->isNotEmpty()): ?>
        <span class="pastor-post__author"><?= $page->author()->esc() ?></span>
        <?php endif ?>
      </div>

      <h1 class="pastor-post__title"><?= $page->title()->esc() ?></h1>

      <?php if ($page->scripture()->isNotEmpty()): ?>
      <p class="pastor-post__scripture">
        <svg class="icon" aria-hidden="true"><use href="#icon-book"></use></svg>
        <?= $page->scripture()->esc() ?>
      </p>
      <?php endif ?>

      <?php if ($page->summary()->isNotEmpty()): ?>
      <p class="pastor-post__summary"><?= $page->summary()->text() ?></p>
      <?php endif ?>
    </header>

    <div class="pastor-post__body">
      <?= $page->text()->toBlocks() ?>
    </div>

    <footer class="pastor-post__footer">
      <?php
        $prev = $page->prevListed();
        $next = $page->nextListed();
      ?>
      <?php if ($prev || $next): ?>
      <nav class="pastor-post__prevnext">
        <?php if ($next): ?>
        <a href="<?= $next->url() ?>" class="prevnext-item prevnext-item--prev">
          <span class="prevnext-label">← <?= t('pagination.newer', '較新') ?></span>
          <span class="prevnext-title"><?= $next->title()->esc() ?></span>
        </a>
        <?php endif ?>
        <?php if ($prev): ?>
        <a href="<?= $prev->url() ?>" class="prevnext-item prevnext-item--next">
          <span class="prevnext-label"><?= t('pagination.older', '較舊') ?> →</span>
          <span class="prevnext-title"><?= $prev->title()->esc() ?></span>
        </a>
        <?php endif ?>
      </nav>
      <?php endif ?>
    </footer>

  </div>
</article>

<?php snippet('footer') ?>
