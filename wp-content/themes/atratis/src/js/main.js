// Importa o SCSS principal (Subimos um nível com ../)
import '../scss/style.scss';

// Importar apenas o necessário
import Swiper from 'swiper';
import { Fancybox } from "@fancyapps/ui";

// Importar CSS das libs (O Vite vai juntar no seu style.css final!)
import 'swiper/css';
import '@fancyapps/ui/dist/fancybox/fancybox.css';

// Aqui você pode adicionar seus scripts JS modernos
// Exemplo de importação: import './modules/meu-script.js';
import './menu.js';
import './banner.js';
import './tabs.js';

console.log('Atratis Theme: Vite Loaded');
