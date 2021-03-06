<?php

// ライブラリーの読み込み
function load_library() {
    // ----- jQuery ------ //
    // WordPress標準のjQueryを読み込まない
    wp_deregister_script('jquery');
    // 公式のjQueryを読み込む
    wp_enqueue_script('jquery', get_template_directory_uri() .'/js/jquery-3.2.1.min.js');
}
add_action('wp_enqueue_scripts', 'load_library');

// 概要（抜粋）の文字数
function custom_excerpt_mblength()
{
    return 50;
}
add_filter('excerpt_mblength', 'custom_excerpt_mblength');

// 概要（抜粋）の省略記号
function custom_excerpt_more()
{
    return '...';
}
add_filter('excerpt_more', 'custom_excerpt_more');

// コンテンツの最大幅
if (!isset($content_width)) {
    $content_width = 747;
}

// Youtubeのビデオ：<div>でマークアップ
function ytwrapper($return, $data, $url) {
    if ($data->provider_name == 'YouTube') {
        return '<div class="ytvideo">'.$return.'</div>';
    } else {
        return $return;
    }
}
add_filter('oembed_dataparse','ytwrapper',10,3);

//// Youtubeのビデオ：キャッシュのクリア
//function clear_ytwrapper($post_id) {
//    global $wp_embed;
//    $wp_embed->delete_oembed_caches($post_id);
//}
//add_action('pre_post_update','clear_ytwrapper');

// アイキャッチ画像
add_theme_support('post-thumbnails');

// 編集画面の設定
function editor_setting($init) {
    $init['block_formats'] = "Paragraph=p;Heading 2=h2;"
            . "Heading 3=h3;Heading 4=h4;"
            . "Heading 5=h5;Heading 6=h6;Preformatted=pre";
    
    $style_formats = [
        [
            'title' => '補足情報',
            'block' => 'div',
            'classes' => 'point'
        ],
        [
            'title' => '注意書き',
            'block' => 'div',
            'classes' => 'attention'
        ],
        [
            'title' => 'ハイライト',
            'inline' => 'span',
            'classes' => 'highlight'
        ]
    ];
$init['style_formats'] = json_encode($style_formats);
    
    return $init;
}
add_filter('tiny_mce_before_init', 'editor_setting');

// スタイルメニューを有効化
function add_stylemenu($buttons) {
    array_splice($buttons, 1, 0, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'add_stylemenu');

// エディタスタイルシート
add_editor_style();
add_editor_style(get_template_directory_uri().'/css/normalize.css');
add_editor_style(get_template_directory_uri().'/css/font-awesome-4.7.0/css/font-awesome.min.css');

// サムネイル画像出力処理
function mythumb($size) {
    if (has_post_thumbnail()) {
        $postthumb = wp_get_attachment_image_src(get_post_thumbnail_id(), $size);
        $url = $postthumb[0];
    } else {
        $url = get_template_directory_uri() . '/sample.jpg';
    }
    return $url;
}

// カスタムメニュー
register_nav_menu('sitenav', 'サイトナビゲーション');
register_nav_menu('recommendnav', 'おすすめ記事');

// メニューのトグルボタン
function navbtn_scripts() {
    wp_enqueue_script('navbtn-script', get_template_directory_uri() .'/js/navbtn.js', ['jquery']);
}
add_action('wp_enqueue_scripts', 'navbtn_scripts');

// 前後の記事に関するメタデータの出力を禁止
// Firefox先読みによる記事表示回数ノイズ対策
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// クローラー (BOT)からのアクセスを判別
function is_bot() {
    $ua = $_SERVER['HTTP_USER_AGENT'];
    
    $bots = ['googlebot', 'msnbot', 'yahoo'];
    
    foreach($bots as $bot) {
        if (stripos($ua, $bot) !== false) {
            return true;
        }
    }
}

// ウィジェットエリア
register_sidebar([
    'id' => 'submenu',
    'name' => 'サブメニュー',
    'description' => 'サイドバーに表示するウィジェットを指定。',
    'before_widget' => '<aside id="%1$s" class="sideMenu widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h2 class="widgettitle">',
    'after_title' => '</h2>'
]);

// 広告
register_sidebar([
    'id' => 'ad',
    'name' => '広告',
    'description' => 'サイドバーに表示する広告を指定。',
    'before_widget' => '<aside id="%1$s" class="myad sideMenu widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h2 class="widgettitle">',
    'after_title' => '</h2>'
]);

// 検索フォーム
add_theme_support('html5',[
   'search-form' 
]);

// ページトップへ戻るボタン
function backtotopbtn_scripts() {
    wp_enqueue_script('backtotopbtn-script', get_template_directory_uri() .'/js/backtopagetop.js', ['jquery']);
}
add_action('wp_enqueue_scripts', 'backtotopbtn_scripts');