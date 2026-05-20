const swiper = new Swiper('.mySwiper', {
  slidesPerView: 1.5,
  spaceBetween: 20,
  centeredSlides: true,
  loop: true,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
});