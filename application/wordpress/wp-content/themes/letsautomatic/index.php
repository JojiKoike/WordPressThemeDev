<?php get_header(); ?>
<div class="container">
  <div class="contents">
    <!-- Article Lists -->
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>
            <article <?php post_class('outline'); ?>>
              <a href="<?php the_permalink(); ?>">
                  <img src="<?php echo mythumb('medium'); ?>" alt="">
                  <div class="text">
                    <h1><?php the_title(); ?></h1>
                    <div class="article-date">
                        <i class="fa fa-pencil"></i>
                        <time datetime="<?php echo get_the_date('Y-m-d'); ?>">
                            投稿:<?php echo get_the_date('Y年m月d日'); ?>
                        </time>
                    </div>
                    <?php the_excerpt(); ?>
                  </div>
              </a>
            </article>
        <?php endwhile; ?>
    <?php endif;?>
    <div class="pagination pagination-index">
        <?php echo paginate_links([
            'type' => 'list',
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;'
        ]);?>
    </div>
  </div>
  <div class="sub">
    <?php get_sidebar(); ?>
  </div>
</div>
<?php get_footer();
