<?php get_header(); ?>
<div class="container">
  <div class="contents">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>
            <article <?php post_class('article') ?>>
                <h1><?php the_title(); ?></h1>
                
                <div class="article-date">
                    <time datetime="<?php echo get_the_date('Y-m-d'); ?>">
                        <i class="fa fa-pencil"></i>
                        投稿:<?php echo get_the_date('Y年m月d日'); ?>
                    </time>
                    <?php if(get_the_modified_date('Ymd') > get_the_date('Ymd')): ?>
                    |
                    <time datetime="<?php echo get_the_modified_date('Y-m-d'); ?>">
                        更新:<?php echo get_the_modified_date('Y年m月d日'); ?>
                    </time>
                    <?php endif; ?>
                </div>
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
