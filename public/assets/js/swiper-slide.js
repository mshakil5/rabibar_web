<script>
  var swiper = new Swiper('.swiper-container', {
    slidesPerView: 4,
  loopedSlides: 4,
  centeredSlides: false,
  spaceBetween: 10,
  grabCursor: true,
  loop: true,
  pagination: '.swiper-pagination',
  paginationClickable: true,
  autoplay: {
    delay: 5000,
  disableOnInteraction: false,
},
//   pagination: {
    //         el: '.swiper-pagination',
    //         clickable: true,
    //       },
    //       navigation: {
    //         nextEl: '.swiper-button-next',
    //         prevEl: '.swiper-button-prev',
    //       },

    breakpoints: {
    1400: {
    slidesPerView: 4,
  loopedSlides: 5,
  spaceBetween: 30
},
  1200: {
    slidesPerView: 4,
  loopedSlides: 4,
  spaceBetween: 10 
},

  1024: {
    slidesPerView: 3,
  loopedSlides: 3,
spaceBetween: 10 },

  768: {
    slidesPerView: 2,
  loopedSlides: 2,
spaceBetween: 10 },

  675: {
    slidesPerView: 1,
  loopedSlides: 1,
  spaceBetween: 20 
},
  425: {
    slidesPerView: 1,
  loopedSlides: 1,
  spaceBetween: 20 
},

  375: {
    slidesPerView: 1,
  loopedSlides: 1,
  spaceBetween: 20 
},   

}
}

  );

</script>