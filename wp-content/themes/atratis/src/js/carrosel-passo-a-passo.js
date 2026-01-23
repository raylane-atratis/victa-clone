import Swiper from 'swiper';
import { Navigation, EffectFade, Controller } from 'swiper/modules';

export function initCarroselPassoAPasso() {
  const section = document.querySelector('.secao-passo-a-passo');
  if (!section) return;

  const totalPassos = parseInt(section.dataset.totalPassos) || 0;

  // 1. Swiper de Imagem (Fade)
  const swiperImg = new Swiper('.swiper-passo-img', {
    modules: [EffectFade, Controller],
    effect: 'fade',
    fadeEffect: { crossFade: true },
    allowTouchMove: false, // Só muda via controle do texto
  });

  // 2. Swiper de Texto (Slide + Navigation + Controller)
  const swiperTxt = new Swiper('.swiper-passo-txt', {
    modules: [Navigation, Controller],
    slidesPerView: 1,
    spaceBetween: 30,
    speed: 600,
    navigation: {
      nextEl: '.swiper-button-next-custom',
      prevEl: '.swiper-button-prev-custom',
    },
    // Sincronização: O Texto controla a Imagem
    controller: {
      control: swiperImg,
      by: 'slide',
    },
    on: {
      // Verifica se está no último slide
      slideChange: function () {
        const isLastSlide = this.activeIndex === totalPassos - 1;

        if (isLastSlide) {
          section.classList.add('ultimo-passo');
        } else {
          section.classList.remove('ultimo-passo');
        }
      },
      // Verifica no init também
      init: function () {
        const isLastSlide = this.activeIndex === totalPassos - 1;

        if (isLastSlide) {
          section.classList.add('ultimo-passo');
        }
      }
    }
  });
}
