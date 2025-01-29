// import Swiper bundle with all modules installed
import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.mjs';

const swiper = new Swiper('.swiper', {
  // Optional parameters
  effect: 'fade',
  loop: true,
  autoplay: {
    delay: 5000,
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});
