<?php
/**
 * Testimonial Block
 * Member testimony/quote
 * 
 * @var \Kirby\Cms\Block $block
 */

$photo = $block->author_photo()->toFile();
$style = $block->style()->or('standard');

?>
<blockquote class="block-testimonial block-testimonial--<?= $style ?>">
  <div class="container">
    <div class="testimonial">
      <div class="testimonial__quote-mark">"</div>
      
      <p class="testimonial__text"><?= $block->quote()->esc() ?></p>
      
      <footer class="testimonial__footer">
        <?php if ($photo): ?>
        <img 
          src="<?= $photo->thumb(['width' => 80, 'height' => 80, 'crop' => true])->url() ?>" 
          alt="<?= $photo->alt()->or($block->author_name()) ?>"
          class="testimonial__photo"
          loading="lazy"
        >
        <?php endif ?>
        
        <div class="testimonial__author">
          <?php if ($block->author_name()->isNotEmpty()): ?>
          <cite class="testimonial__name"><?= $block->author_name()->esc() ?></cite>
          <?php endif ?>
          
          <?php if ($block->author_role()->isNotEmpty()): ?>
          <span class="testimonial__role"><?= $block->author_role()->esc() ?></span>
          <?php endif ?>
        </div>
      </footer>
    </div>
  </div>
</blockquote>
