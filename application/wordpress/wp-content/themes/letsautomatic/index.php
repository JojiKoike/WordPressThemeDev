<?php get_header(); ?>
<div class="container">
  <div class="contents">
    <!-- Article Lists -->
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>
            <article <?php post_class('outline'); ?>>
              <a href="<?php the_permalink(); ?>">
                <h1><?php the_title(); ?></h1>
                <?php the_excerpt(); ?>
              </a>
            </article>
        <?php endwhile; ?>
    <?php endif;?>
  </div>
  <div class="sub">
    <?php get_sidebar(); ?>
  </div>
</div>
<?php get_footer();
