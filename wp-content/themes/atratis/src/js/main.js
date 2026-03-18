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
});
