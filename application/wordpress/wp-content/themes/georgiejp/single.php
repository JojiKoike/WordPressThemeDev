<?php get_header(); ?>
<div class="sub-header">
    <div class="bread">
        <ol>
            <li>
                <a href="<?php echo home_url(); ?>">
                    <i class="fa fa-home"></i>
                    <span>TOP</span>
                </a>
            </li>
            <li>
                <?php if (has_category()): ?>
                <?php $postcat= get_the_category(); ?>
                <?php echo get_category_parents($postcat[0], true, '</li><li>'); ?>
                <?php endif;?>
                <a><?php the_title(); ?></a>
            </li>
        </ol>
    </div>
</div>
<div class="container">
  <div class="contents">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>
            <article <?php post_class('article') ?>>
                <h1><?php the_title(); ?></h1>
                <div class="article-tag">
                    <i class="fa fa-tags"></i>
                    <?php the_tags('<ul><li>','</li><li>', '</li></ul>');?>
                </div>
                <div class="article-date">
                    <i class="fa fa-pencil"></i>
                    <time datetime="<?php echo get_the_date('Y-m-d'); ?>">
                        投稿:<?php echo get_the_date('Y年m月d日'); ?>
                    </time>
                    <?php if(get_the_modified_date('Ymd') > get_the_date('Ymd')): ?>
                    |
                    <time datetime="<?php echo get_the_modified_date('Y-m-d'); ?>">
                        更新:<?php echo get_the_modified_date('Y年m月d日'); ?>
                    </time>
                    <?php endif; ?>
                </div>
                <?php if (has_post_thumbnail() && $page==1): ?>
                <div class="catch">
                    <?php the_post_thumbnail('large'); ?>
                </div>
                <?php endif; ?>
                <div class="article-body">
                    <?php the_content(); ?>
                </div>
                <?php wp_link_pages([
                    'before' => '<div class="pagination"><ul><li>',
                    'separator' => '</li><li>',
                    'after' => '</li></ul></div>',
                    'pagelink' => '<span>%</span>'
                ]); ?>
                <!-- SNS Share -->
                <div class="share">
                    <ul>
                        <li>
                            <a href="" class="share-tw">
                                <i class="fa fa-twitter"></i>
                                <span>Twitter</span> でシェア
                            </a>
                        </li>
                        <li>
                            <a href="" class="share-fb">
                                <i class="fa fa-facebook-official"></i>
                                <span>Facebook</span> でシェア
                            </a>
                        </li>
                        <li>
                            <a href="" class="share-gp">
                                <i class="fa fa-google-plus-official"></i>
                                <span>Google+</span> でシェア
                            </a>
                        </li>
                    </ul>
                </div>
                
            <?php // 関連記事
            if (has_category()) {
                $cats = get_the_category();
                $catkwds = array();
                foreach ($cats as $cat) {
                    $catkwds[] = $cat->term_id;
                }
            }
            $myPosts = get_posts([
                'post_type' => 'post',
                'posts_per_page' => '4',
                'post__not_in' => [$post->ID],
                'category__in' => $catkwds,
                'orderby' => 'rand'
            ]);
            if ($myPosts) : ?>
            <aside class="sideMenu sideMenu-thumb sideMenu-related">
            <h2>関連記事</h2>
            <ul>
                <?php foreach ($myPosts as $post) :
                setup_postdata($post); ?>
                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <div class="thumb" style="background-image: url(<?php echo mythumb('thumbnail'); ?>)">
                            </div>
                            <div class="text">
                                <?php the_title(); ?>
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            </aside>
            <?php wp_reset_postdata();
            endif; ?>
                
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
  </div>
  <div class="sub">
    <?php get_sidebar(); ?>
  </div>
</div>
<?php get_footer(); ?>

<?php // アクセス数の記録
if (!is_bot() && !is_user_logged_in()) {
    $count_key = 'postviews';
    $count = get_post_meta($post->ID, $count_key, true);
    $count++;
    update_post_meta($post->ID, $count_key, $count);
}
