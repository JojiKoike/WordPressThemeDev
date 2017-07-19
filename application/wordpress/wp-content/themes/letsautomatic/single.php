<?php get_header(); ?>
<div class="container">
  <div class="contents">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>
            <article <?php post_class('article') ?>>
                <h1><?php the_title(); ?></h1>
                <?php if (has_post_thumbnail()): ?>
                <div class="catch">
                    <?php the_post_thumbnail('large'); ?>
                </div>
                <?php endif; ?>
                <?php the_content(); ?>
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
  </div>
  <div class="sub">
    <?php get_sidebar(); ?>
  </div>
</div>
<?php get_footer();
