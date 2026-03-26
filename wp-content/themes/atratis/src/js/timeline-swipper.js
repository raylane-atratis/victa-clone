import Swiper from "swiper";
import { Pagination } from "swiper/modules";

export function initTimelineSwiper() {
  const container = document.querySelector(".js-swiper-timeline");
  if (!container) return;

  new Swiper(container, {
    modules: [Pagination],
    grabCursor: true,
    observer: true,
    observeParents: true,
    slidesPerView: "auto", // ← respeita o width fixo do CSS
    spaceBetween: 30,
    pagination: {
      el: container
        .closest(".secao-timeline__slider-wrapper")
        .querySelector(".timeline-pagination"),
      clickable: true,
    },
    breakpoints: {
      320: { spaceBetween: 20 },
      768: { spaceBetween: 30 },
      1024: { spaceBetween: 40 },
    },
  });
}
