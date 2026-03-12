import Swiper from "swiper";
import { Pagination, Navigation } from "swiper/modules";

export function initSecaoDepoimentoSwiper() {
  const container = document.querySelector(".swiper-depoimentos");
  if (!container) return;

  new Swiper(container, {
    modules: [Pagination, Navigation],
    slidesPerView: "auto",
    spaceBetween: 16,
    centeredSlides: true,
    initialSlide: 1, // Começa no segundo slide (do meio se houver 3)
    navigation: {
      nextEl: ".secao-depoimento__swiper-container .swiper-button-next",
      prevEl: ".secao-depoimento__swiper-container .swiper-button-prev",
    },
    pagination: {
      el: ".swiper-depoimentos-pagination",
      clickable: true,
    },
    breakpoints: {
      1024: {
        slidesPerView: 3,
        spaceBetween: 24,
        centeredSlides: false,
        initialSlide: 0,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 20,
        centeredSlides: false,
        initialSlide: 0,
      },
    },
  });
}
