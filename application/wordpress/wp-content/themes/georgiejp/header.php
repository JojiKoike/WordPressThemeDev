<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns#">
  <meta charset="UTF-8">
  
  <title>
    <?php wp_title('|', true, 'right'); ?>
    <?php bloginfo('name');?>
  </title>

  <meta name="viewport"
    content="width=device-width, initial-scale=1.0">
  
  <!-- StyleSheet -->
  <link rel="stylesheet"
        href="<?php echo get_template_directory_uri()?>/css/normalize.css">
  <link rel="stylesheet" 
        href="<?php echo get_template_directory_uri();?>/css/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet"
    href="<?php echo get_stylesheet_uri(); ?>?var=<?php echo date('U'); ?>">
  
  <!-- Meta Data -->
  <?php if (is_single() || is_page()): ?>
  <!-- Traditional Metadata -->
  <meta name="description" 
        content="<?php echo wp_trim_words($post->post_content, 100, '...'); ?>">
  <?php if(has_tag()): ?>
  <?php $tags = get_the_tags();
  $kwds = array();
 foreach ($tags as $tag) {
     $kwds[] = $tag->name;
 }?>
  <meta name="keywords" content="<?php echo implode(',', $kwds); ?>" >
  <?php endif; ?>
  <!-- OGP -->
  <meta property="og:type" content="article">
  <meta property="og:title" content="<?php the_title(); ?>">
  <meta property="og:url" content="<?php the_permalink(); ?>">
  <meta property="og:description" 
        content="<?php echo wp_trim_words($post->post_content, 100, '...');?>">
  <?php if (has_post_thumbnail()): ?>
    <!-- アイキャッチ画像がある場合 -->
    <?php $postthumb 
            = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large'); 
    ?>
    <meta property="og:image" content="<?php echo $postthumb[0]; ?>">
  <?php else: ?>
    <!--　アイキャッチ画像がない場合：デフォルトの画像のURLをあてる -->
    <meta property="og:image" 
          content="<?php echo get_template_directory_uri(); ?>/sample.jpg">
  <?php endif; ?>
    <meta property="og:image" content="<?php echo mythumb('large'); ?>">
  <?php endif; ?>
  
    <!---- トップページ用メタデータ Start----->
    <?php if (is_home()): ?>
        <meta name="description" content="<?php bloginfo('description'); ?>">

        <?php $allcats = get_categories();
        $twds = array();
        foreach ($allcats as $allcat) {
            $twds[] = $allcat->name;
        } ?>
        <meta name="keywords" content="<?php echo implode(',', $twds);?>">
        <meta property="og:type" content="website">
        <meta property="og:title" content="<?php bloginfo('name');?>">
        <meta property="og:url" content="<?php home_url('/'); ?>">
        <meta property="og:description" content="<?php bloginfo('description');?>">
        <meta property="og:image" content="<?php echo get_template_directory_uri();?>/sample.jpg">
    <?php endif; ?>
    <!---- トップページ用メタデータ End----->
        
    <!-- カテゴリー・タグページ用メタデータ Start -->
    <?php if (is_category() || is_tag()):
        if (is_category()) {
            $termid = $cat;
            $taxname = 'category';
        } else if (is_tag()) {
            $termid = $tag_id;
            $taxname = 'post_tag';
        }
    ?>
        <meta name="description" content="<?php single_term_title(); ?>">
        <?php $childcats = get_categories(['child_of' => $termid]);
        $kwds = array();
        $kwds[] = single_term_title('', false);
        foreach($childcats as $childcat) {
            $kwds[] = $childcat->name;
        }
        ?>
        <meta name="keywords" content="<?php echo implode(',', $kwds);?>">
        <meta property="og:type" content="website">
        <meta property="og:title" content="<?php single_term_title(); ?>に関する記事 | <?php bloginfo('name'); ?>">
        <meta property="og:url" content="<?php echo get_term_link($termid, $taxname)?>">
        <meta property="og:description" content="<?php single_term_title(); ?>に関する記事の一覧です。">
        <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/sample.jpg">
    <?php endif; ?>
    <!-- カテゴリー・タグページ用メタデータ End -->

    
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    <meta property="og:locale" content="ja_JP">
    
    <!-- Twitter Card -->
    <meta name="twitter:site" content="@george390">
    <meta name="twitter:card" content="summary_large_image">

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <header>
    <div class="header-inner">
      <div class="site">
            <h1>
                <a href="<?php echo home_url(); ?>">
                    <?php bloginfo('name');?>
                </a>
            </h1>
            <div class="site-description">
                <?php echo bloginfo('description'); ?>
            </div>
      </div>
      <div class="sitenav">
          <button type="button" id="navbtn">
              <i class="fa fa-bars"></i><span>MENU</span>
          </button>
          <?php wp_nav_menu([
              'theme_location' => 'sitenav',
              'container' => 'nav',
              'container_class' => 'mainmenu',
              'container_id' => 'mainmenu'
          ]); ?>
      </div>
    </div>
  </header>
