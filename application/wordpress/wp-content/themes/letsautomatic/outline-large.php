<article <?php post_class('outline-large'); ?>>
    <a href="<?php the_permalink(); ?>">
        <div class="thumb" style="background-image: url(<?php echo mythumb('large'); ?>)"></div>
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