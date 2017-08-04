// ページ先頭へ戻るボタンの挙動定義
$(function(){
    var pageTop = $('.page_top');
    pageTop.hide();
    $(window).scroll(function(){
       if($(this).scrollTop() > 200) {
           pageTop.fadeIn();
       } else {
           pageTop.fadeOut();
       }
    });
    pageTop.click(function(){
       $('body, html').animate({scrollTop:0}, 500, 'swing');
       return false;
    });
});