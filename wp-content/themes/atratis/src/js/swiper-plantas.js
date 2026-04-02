import Swiper from "swiper";
import { Pagination } from "swiper/modules";

// Importe o CSS aqui para o Vite processar, ou garanta que está no seu main.scss
import 'swiper/css';
import 'swiper/css/pagination';

export function initPlantasSwiper() {
    const container = document.querySelector('.swiper-plantas');
    if (!container) return;

    new Swiper('.swiper-plantas', {
        // ESSENCIAL: Adicione os módulos que você quer usar aqui
        modules: [Pagination], 
        
        slidesPerView: 1.2,
        spaceBetween: 20,
        grabCursor: true,
        watchSlidesProgress: true,
        
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        
        breakpoints: {
            480: {
                slidesPerView: 1.5,
                spaceBetween: 25,
            },
            640: {
                slidesPerView: 2.2,
                spaceBetween: 25,
            },
            768: {
                slidesPerView: 3.2,
                spaceBetween: 25,
            },
            1024: {
                slidesPerView: 3.8, 
                spaceBetween: 30,
            },
        }
    });
}