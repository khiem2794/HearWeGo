//slider banner
jQuery(document).ready(function(){
    $('.my-slider').slick({
      dots: true,
      infinite: true,
      speed: 500,
      cssEase: 'linear'
    });

});
//slider new
 $('.my-slide-top').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    speed: 500,
    cssEase: 'linear'
 });
// $('.slider-nav-new').slick({
//   slidesToShow: 3,
//   slidesToScroll: 1,
//   asNavFor: '.my-sync-slider-new',
//   dots: true,
//   centerMode: true,
//   focusOnSelect: true
// });
//$('.my-sync-slider-new').slick({
//  infinite:true,
//  slidesToShow: 4,
//  slidesToScroll: 1,
//});
//slider view


/* go top
$(function(){
    goTop();
});
function goTop() {
    $("a[href='#top']").click(function() {
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });
}*/