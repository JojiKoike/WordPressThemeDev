<?php get_header(); ?>
<div class="container">
  <div class="contents">
      
    <!---------- Article List Start ---------->
    
    <!----- 1件目だけを大きく表示する ----->
    <?php if (have_posts()) : ?>
        <?php the_post(); ?>
        <?php get_template_part('outline', 'large'); ?>
    <?php endif;?>
    
    <!----- 2件目以降は普通サイズ表示 ----->
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
