// Importa o SCSS principal (Subimos um nível com ../)
import "../scss/style.scss";

// Importar apenas o necessário
import Swiper from "swiper";
import { Fancybox } from "@fancyapps/ui";

// Importar CSS das libs (O Vite vai juntar no seu style.css final!)
import "swiper/css";
import "@fancyapps/ui/dist/fancybox/fancybox.css";

// Aqui você pode adicionar seus scripts JS modernos
// Exemplo de importação: import './modules/meu-script.js';
import { initDestaquesSwiper } from "./destaques-swiper.js";
import "./menu.js";
import "./banner.js";
import { initFAQ } from "./faq.js";
import { initPhoneMasks } from "./masks.js";
import { initAtuacoesSwiper } from "./atuacoes-swiper.js";
import { initAnimations } from "./animations.js";
import { initSearch } from "./search.js";
import { initSecaoDepoimentoSwiper } from "./secao-depoimento-swiper.js";
import { VideoModal } from "./video-modal.js";
import { initEmpreendimentos } from "./empreendimentos.js";
import { initTimelineSwiper } from "./timeline-swipper.js";
import { initProdutosSwiper } from "./swiper-produtos.js";
import { initEsgSwiper } from "./swiper-esg.js";
import { initFullCarrossel } from "./full-carrossel.js";
import { initFichaTecnica } from "./ficha-tecnica.js";
import { initPlantasSwiper } from "./swiper-plantas.js";
import { initFormMasks } from "./form-masks.js";

// Inicializa os componentes
document.addEventListener("DOMContentLoaded", () => {
  initFAQ();
  initPhoneMasks();
  initAtuacoesSwiper();
  initAnimations();
  initSearch();
  initSecaoDepoimentoSwiper();
  VideoModal.init();
  initEmpreendimentos();
  initDestaquesSwiper();
  initTimelineSwiper();
  initProdutosSwiper();
  initEsgSwiper();
  initFullCarrossel();
  initFichaTecnica();
  initPlantasSwiper();
  initFormMasks();
});
