<?php
$myPosts = get_posts(
    array(
    'post_type' => 'post',
    'posts_per_page' => '5'
    )
);
if ($myPosts) : ?>
<aside class="sideMenu sideMenu-thumb">
  <h2>新着記事</h2>
  <ul>
    <?php foreach ($myPosts as $post) :
     setup_postdata($post); ?>
      <li>
        <a href="<?php the_permalink(); ?>">
            <div class="thumb" style="background-image: url(<?php echo mythumb('thumbnail'); ?>)">
            </div>
            <div class="text">
                <?php the_title(); ?>
                <?php if (has_category()): ?>
                    <?php $postcat = get_the_category(); ?>
                    <span><?php echo $postcat[0]->name; ?></span>
                <?php endif; ?>
            </div>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</aside>
<?php wp_reset_postdata(); ?>
<?php endif;
