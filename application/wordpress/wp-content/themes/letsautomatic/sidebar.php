<?php
$myPosts = get_posts(
    array(
    'post_type' => 'post',
    'posts_per_page' => '5'
    )
);
if ($myPosts) : ?>
<aside class="sideMenu">
  <h2>新着記事</h2>
  <ul>
    <?php foreach ($myPosts as $post) : ?>
      <li>
        <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</aside>
<?php wp_reset_postdata(); ?>
<?php endif;
