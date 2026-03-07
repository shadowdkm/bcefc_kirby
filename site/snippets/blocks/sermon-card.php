<?php
/**
 * Sermon Card Block
 * Featured sermon with video/audio
 * 
 * @var \Kirby\Cms\Block $block
 */

$thumbnail = $block->thumbnail()->toFile();

?>
<article class="block-sermon-card">
  <div class="container">
    <div class="sermon-card">
      <?php if ($thumbnail || $block->video_url()->isNotEmpty()): ?>
      <div class="sermon-card__media">
        <?php if ($block->video_url()->isNotEmpty()): ?>
        <div class="sermon-card__video">
          <?php 
          // Extract YouTube video ID
          $videoUrl = $block->video_url()->value();
          preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\s]+)/', $videoUrl, $matches);
          $videoId = $matches[1] ?? '';
          if ($videoId): ?>
          <iframe 
            src="https://www.youtube.com/embed/<?= $videoId ?>" 
            frameborder="0" 
            allowfullscreen
            loading="lazy"
          ></iframe>
          <?php endif ?>
        </div>
        <?php elseif ($thumbnail): ?>
        <img 
          src="<?= $thumbnail->thumb(['width' => 800, 'height' => 450, 'crop' => true])->url() ?>" 
          alt="<?= $thumbnail->alt()->or($block->title()) ?>"
          loading="lazy"
        >
        <?php endif ?>
      </div>
      <?php endif ?>
      
      <div class="sermon-card__content">
        <h3 class="sermon-card__title"><?= $block->title()->esc() ?></h3>
        
        <div class="sermon-card__meta">
          <?php if ($block->speaker()->isNotEmpty()): ?>
          <span class="sermon-card__speaker"><?= $block->speaker()->esc() ?></span>
          <?php endif ?>
          
          <?php if ($block->date()->isNotEmpty()): ?>
          <time class="sermon-card__date" datetime="<?= $block->date()->toDate('Y-m-d') ?>">
            <?= $block->date()->toDate('Y年m月d日') ?>
          </time>
          <?php endif ?>
          
          <?php if ($block->scripture()->isNotEmpty()): ?>
          <span class="sermon-card__scripture"><?= $block->scripture()->esc() ?></span>
          <?php endif ?>
        </div>
        
        <?php if ($block->description()->isNotEmpty()): ?>
        <p class="sermon-card__description"><?= $block->description()->esc() ?></p>
        <?php endif ?>
        
        <div class="sermon-card__actions">
          <?php if ($block->video_url()->isNotEmpty()): ?>
          <a href="<?= $block->video_url() ?>" class="btn btn--primary" target="_blank" rel="noopener">
            <?= t('ui.livestream', 'Watch Video') ?>
          </a>
          <?php endif ?>
          
          <?php if ($block->audio_url()->isNotEmpty()): ?>
          <a href="<?= $block->audio_url() ?>" class="btn btn--outline" target="_blank" rel="noopener">
            Listen Audio
          </a>
          <?php endif ?>
          
          <?php if ($block->notes_url()->isNotEmpty()): ?>
          <a href="<?= $block->notes_url() ?>" class="btn btn--outline" download>
            <?= t('ui.download', 'Download Notes') ?>
          </a>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
</article>
