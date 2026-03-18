import Swiper from "swiper";
import { Navigation, Autoplay } from "swiper/modules";

export function initDestaquesSwiper() {
  const carousels = document.querySelectorAll('.destaques-carousel');
  
  if (!carousels.length) return;

  carousels.forEach((carouselWrapper) => {
    const swiperContainer = carouselWrapper.querySelector('.swiper');
    const prevBtn = carouselWrapper.querySelector('.swiper-button-prev');
    const nextBtn = carouselWrapper.querySelector('.swiper-button-next');

    if (!swiperContainer) return;

    new Swiper(swiperContainer, {
      modules: [Navigation, Autoplay],
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: nextBtn,
        prevEl: prevBtn,
      },
    });
  });
}
