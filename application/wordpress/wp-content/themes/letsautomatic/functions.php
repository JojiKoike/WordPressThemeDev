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
