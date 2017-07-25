<?php // 広告
 dynamic_sidebar('ad');
?>

<?php
$location_name = 'recommendnav';
$locations = get_nav_menu_locations();
$recommends = wp_get_nav_menu_items($locations[$location_name]);
if ($recommends) : ?>
<aside class="sideMenu sideMenu-large">
  <h2>おすすめ記事</h2>
  <ul>
    <?php foreach ($recommends as $recommend) : 
        if ($recommend->object == 'post'):
        $post = get_post($recommend->object_id);
        setup_postdata($post);
        ?>
      <li>
        <a href="<?php the_permalink(); ?>">
            <div class="thumb" style="background-image:url(<?php echo mythumb('medium'); ?>)">
            </div>
            <div class="text">
                <?php the_title(); ?>
            </div>
        </a>
      </li>
    <?php endif; endforeach; ?>
  </ul>
</aside>
<?php wp_reset_postdata(); ?>
<?php endif; ?>

<?php
$myPosts = get_posts(
    array(
    'post_type' => 'post',
    'posts_per_page' => '6',
    'meta_key' => 'postviews',
    'orderby' => 'meta_value_num'
    )
);
if ($myPosts) : ?>
<aside class="sideMenu sideMenu-thumb">
  <h2>人気記事</h2>
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
<?php endif; ?>
<?php // 検索フォーム
    dynamic_sidebar('submenu'); 
?>