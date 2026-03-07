<?php
/**
 * Media Embed Block
 * YouTube livestream/playlist, Google Map, audio player iframe
 * 
 * @var \Kirby\Cms\Block $block
 */

$provider = $block->provider()->or('youtube');
$aspect = $block->aspect()->or('16/9');
$maxWidth = $block->max_width()->or('full');
$content = $block->url_or_embed()->value();

// Width classes
$widthClasses = [
    'full'   => '',
    'large'  => 'block-media-embed--narrow-lg',
    'medium' => 'block-media-embed--narrow-md',
];
$widthClass = $widthClasses[$maxWidth->value()] ?? '';

?>
<section class="block-media-embed <?= $widthClass ?>">
  <div class="container">
    <?php if ($block->title()->isNotEmpty()): ?>
    <h2 class="block-media-embed__title"><?= $block->title()->esc() ?></h2>
    <?php endif ?>
    
    <div class="block-media-embed__wrapper" style="--aspect-ratio: <?= $aspect ?>;">
      <?php if ($provider->value() === 'youtube'): 
        // Extract YouTube video/playlist ID
        preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|playlist\?list=)|youtu\.be\/)([^&\s]+)/', $content, $matches);
        $videoId = $matches[1] ?? '';
        $isPlaylist = strpos($content, 'playlist') !== false || strpos($content, 'list=') !== false;
        
        if ($isPlaylist) {
          preg_match('/list=([^&\s]+)/', $content, $playlistMatches);
          $playlistId = $playlistMatches[1] ?? '';
          $embedUrl = "https://www.youtube.com/embed/videoseries?list={$playlistId}";
        } else {
          $embedUrl = "https://www.youtube.com/embed/{$videoId}";
        }
      ?>
      <iframe 
        src="<?= $embedUrl ?>" 
        frameborder="0" 
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
        allowfullscreen
        loading="lazy"
      ></iframe>
      
      <?php elseif ($provider->value() === 'vimeo'):
        preg_match('/vimeo\.com\/(\d+)/', $content, $matches);
        $vimeoId = $matches[1] ?? '';
      ?>
      <iframe 
        src="https://player.vimeo.com/video/<?= $vimeoId ?>" 
        frameborder="0" 
        allow="autoplay; fullscreen; picture-in-picture" 
        allowfullscreen
        loading="lazy"
      ></iframe>
      
      <?php elseif ($provider->value() === 'map' || $provider->value() === 'iframe'): ?>
      <?= $content ?>
      
      <?php endif ?>
    </div>
  </div>
</section>
