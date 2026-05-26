document.addEventListener('DOMContentLoaded', function() {
  const swiper = new Swiper('.mySwiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    centeredSlides: false,
    loop: true,
    grabCursor: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
  });

  swiper.autoplay.start();
});