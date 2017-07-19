<?php

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