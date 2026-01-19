import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, Parallax, EffectFade } from 'swiper/modules';

document.addEventListener('DOMContentLoaded', () => {

  // 1. Banner Principal (Desktop)
  const bannerDesktop = document.querySelector('.swiper-banner-principal');
  if (bannerDesktop) {
    new Swiper(bannerDesktop, {
      modules: [Navigation, Pagination, Autoplay, Parallax, EffectFade],
      slidesPerView: 1,
      spaceBetween: 0,
      loop: true,
      // effect: 'fade', // Opcional: Efeito Fade para transição suave
      // fadeEffect: { crossFade: true },
      speed: 1000, // Velocidade da transição (1s)
      parallax: true, // Ativa o efeito parallax
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  }

  // 2. Banner Mobile
  const bannerMobile = document.querySelector('.swiper-banner-mobile');
  if (bannerMobile) {
    new Swiper(bannerMobile, {
      modules: [Pagination, Autoplay],
      slidesPerView: 1,
      spaceBetween: 0,
      loop: true,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
    });
  }

});
