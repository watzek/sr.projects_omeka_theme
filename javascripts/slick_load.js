    $(document).ready(function(){
      $('.featured-collections').slick({
        dots: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
      });
      $('.featured-studio-art').slick({
       slidesToShow: 1,
       slidesToScroll: 1,
       arrows: false,
       fade: true,
       adaptiveHeight: true,
       asNavFor: '.slider-nav'
      });
      $('.slider-nav').slick({
       slidesToShow: 3,
       slidesToScroll: 1,
       asNavFor: '.featured-studio-art',
       dots: true,
       centerMode: true,
       focusOnSelect: true
      });
    });
