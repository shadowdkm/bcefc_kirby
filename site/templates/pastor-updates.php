<?php snippet('header') ?>
<?php $dateFormat = $kirby->language() && $kirby->language()->code() === 'en' ? 'F j, Y' : 'Y年n月j日' ?>

<section class="pastor-updates-hero">
  <div class="container">
    <p class="section-eyebrow"><?= t('pastor.updates.eyebrow', 'Pastor\'s Corner') ?></p>
    <h1><?= $page->title()->esc() ?></h1>
  </div>
</section>

<section class="pastor-updates-list">
  <div class="container">

    <?php if ($posts->isEmpty()): ?>
    <p class="pastor-updates-empty"><?= t('pastor.updates.empty', 'No updates yet. Check back soon.') ?></p>

    <?php else: ?>
    <div class="pastor-updates-grid">
      <?php foreach ($posts as $post):
        $cover = $post->cover()->toFile();
      ?>
      <a href="<?= $post->url() ?>" class="pastor-card">
        <?php if ($cover): ?>
        <div class="pastor-card__img">
          <img src="<?= $cover->thumb(['width' => 800, 'height' => 480, 'crop' => true])->url() ?>"
               alt="<?= $cover->alt()->or($post->title()) ?>"
               loading="lazy">
        </div>
        <?php else: ?>
        <div class="pastor-card__img pastor-card__img--placeholder" aria-hidden="true">
          <svg class="icon" width="36" height="36"><use href="#icon-book"></use></svg>
        </div>
        <?php endif ?>

        <div class="pastor-card__body">
          <div class="pastor-card__meta">
            <time datetime="<?= $post->date()->toDate('c') ?>">
              <?= $post->date()->toDate($dateFormat) ?>
            </time>
            <?php if ($post->author()->isNotEmpty()): ?>
            <span class="pastor-card__author"><?= $post->author()->esc() ?></span>
            <?php endif ?>
          </div>

          <h2 class="pastor-card__title"><?= $post->title()->esc() ?></h2>

          <?php if ($post->scripture()->isNotEmpty()): ?>
          <p class="pastor-card__scripture">
            <svg class="icon" aria-hidden="true"><use href="#icon-book"></use></svg>
            <?= $post->scripture()->esc() ?>
          </p>
          <?php endif ?>

          <?php if ($post->summary()->isNotEmpty()): ?>
          <p class="pastor-card__summary"><?= $post->summary()->text()->excerpt(160) ?></p>
          <?php endif ?>
        </div>
      </a>
      <?php endforeach ?>
    </div>

    <?php if ($posts->pagination()->hasPages()): ?>
    <nav class="pastor-updates-pagination" aria-label="Pagination">
      <?php if ($posts->pagination()->hasPrevPage()): ?>
      <a href="<?= $posts->pagination()->prevPageUrl() ?>" class="btn btn--outline">← <?= t('pagination.prev', '上一頁') ?></a>
      <?php endif ?>
      <span><?= $posts->pagination()->page() ?> / <?= $posts->pagination()->pages() ?></span>
      <?php if ($posts->pagination()->hasNextPage()): ?>
      <a href="<?= $posts->pagination()->nextPageUrl() ?>" class="btn btn--outline"><?= t('pagination.next', '下一頁') ?> →</a>
      <?php endif ?>
    </nav>
    <?php endif ?>

    <?php endif ?>

  </div>
</section>

<?php snippet('footer') ?>
