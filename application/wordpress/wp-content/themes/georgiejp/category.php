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
                <?php if ($cat): ?>
                    <?php $catdata=get_category($cat); ?>
                    <?php if($catdata->parent) :?>
                        <?php echo get_category_parents($$catdata->parent, true, '</li><li>'); ?>
                    <?php endif; ?>
                <?php endif; ?>
                <a><?php single_term_title(); ?></a>
            </li>
        </ol>
    </div>
</div>
<div class="container">
  <div class="contents">
      
      <h1><?php single_term_title(); ?>に関する記事</h1>
      
    <!---------- Article List Start ---------->
    
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>
                <?php get_template_part('outline', 'medium'); ?>
        <?php endwhile; ?>
    <?php endif;?>
    
    <!---------- Article List End ---------->

    <!---------- Pagination Start ---------->
    <div class="pagination pagination-index">
        <?php echo paginate_links([
            'type' => 'list',
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;'
        ]);?>
    </div>
    <!---------- Pagination End ------------>
    
  </div>
    
  <!--------------- SideBar Start--------------->
  <div class="sub">
    <?php get_sidebar(); ?>
  </div>
  <!--------------- SideBar End  --------------->

</div>
<?php get_footer();
