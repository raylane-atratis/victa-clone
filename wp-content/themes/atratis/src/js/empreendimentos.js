import Swiper from "swiper";
import { Navigation, Pagination } from "swiper/modules";

/**
 * Filtro de Empreendimentos de Alta Performance.
 * Utiliza o JSON injetado no footer (imoveisData) para renderizar o grid sem reload.
 *
 * Detecta automaticamente se é:
 *  - Seção ACF (carrossel Swiper)
 *  - Página Archive (grid com paginação)
 */
export function initEmpreendimentos() {
  // Swiper Instance (somente para modo carrossel)
  let swiperInstance = null;

  // 1. Elementos da DOM
  const gridImoveis = document.getElementById("grid-imoveis");
  const btnFiltrar = document.getElementById("btn-filtrar");

  // Selects
  const selEstado = document.getElementById("filtro-estado");
  const selCidade = document.getElementById("filtro-cidade");
  const selBairro = document.getElementById("filtro-bairro");
  const selEstagio = document.getElementById("filtro-estagio");

  // 2. Trava de segurança
  if (typeof imoveisData === "undefined" || !gridImoveis) return;

  // 3. Detecta modo: archive (grid) ou seção (swiper)
  const isArchive = gridImoveis.classList.contains(
    "secao-empreendimentos__grid-archive"
  );
  const ITEMS_PER_PAGE = 6; // Itens por página no modo archive
  let currentPage = 1;
  let currentResults = []; // Armazena resultados filtrados para paginação

  // ─── Gerador do HTML de um card ───
  function gerarCardHtml(imovel) {
    let badgeHtml = imovel.badge
      ? `<span class="card-imovel__badge">${imovel.badge}</span>`
      : "";

    let estagioFormatado = imovel.estagio
      ? imovel.estagio
          .replace(/-/g, " ")
          .replace(/\b\w/g, (l) => l.toUpperCase())
      : "Lançamento";

    return `
      <div class="card-imovel">
          <div class="card-imovel__imagem">
              ${badgeHtml}
              <img src="${imovel.imagem}" alt="${imovel.titulo}" loading="lazy">
          </div>
          <div class="card-imovel__conteudo">
              <h3 class="card-imovel__titulo">${imovel.titulo}</h3>
              <p class="card-imovel__local">
                  <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M11.9413 17.9968C12.785 18.8217 13.8925 19.2342 15 19.2342C16.1075 19.2342 17.215 18.8217 18.0588 17.9968L21.1862 14.9369C22.8387 13.2844 23.75 11.087 23.75 8.74964C23.75 6.41223 22.8387 4.21607 21.1862 2.56239C19.535 0.909962 17.3375 0 15 0C12.6625 0 10.465 0.909962 8.8125 2.56239C5.40125 5.9735 5.40125 11.5245 8.8225 14.9456L11.9413 17.9955V17.9968ZM10.58 4.33107C11.76 3.15112 13.33 2.50115 15 2.50115C16.67 2.50115 18.2388 3.15112 19.4188 4.33107C20.5987 5.51102 21.25 7.08096 21.25 8.75089C21.25 10.4208 20.5988 11.9895 19.4288 13.1607L16.3112 16.2106C15.5887 16.9155 14.4113 16.9155 13.6888 16.2106L10.58 13.1707C8.14375 10.7333 8.14375 6.76722 10.58 4.33107ZM11.25 8.73839C11.25 6.66722 12.9288 4.98854 15 4.98854C17.0712 4.98854 18.75 6.66722 18.75 8.73839C18.75 10.8095 17.0712 12.4882 15 12.4882C12.9288 12.4882 11.25 10.8095 11.25 8.73839ZM30 20.9591C30 21.3991 29.7687 21.8053 29.3937 22.0303L17.0675 29.4263C16.43 29.8088 15.715 30 15.0013 30C14.2875 30 13.5712 29.8088 12.935 29.4263L0.60625 22.0316C0.23 21.8053 0 21.3991 0 20.9604C0 20.5216 0.23125 20.1142 0.60625 19.8892L5.8925 16.7181C6.48625 16.3618 7.25375 16.5543 7.6075 17.1468C7.9625 17.7393 7.77125 18.5067 7.17875 18.8617L3.67875 20.9616L14.22 27.2864C14.7013 27.5739 15.2987 27.5739 15.78 27.2864L26.3212 20.9616L22.8213 18.8617C22.2288 18.5067 22.0375 17.7393 22.3925 17.1468C22.7475 16.5543 23.5138 16.3618 24.1075 16.7181L29.3937 19.8892C29.77 20.1154 30 20.5204 30 20.9591Z" fill="#B0B0B0"/>
                  </svg>
                  ${imovel.local}
              </p>
              <div class="card-imovel__infos">
                  <span>
                      <svg width="30" height="29" viewBox="0 0 30 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M30 11.6458V14.5651L15 23.5783L0 14.5651V11.6458L15 20.659L30 11.6458ZM0 17.0675V19.9868L15 29L30 19.9868V17.0675L15 26.0807L0 17.0675ZM15 17.9413L0.07 8.97065L15 0L29.93 8.97065L15 17.9413ZM15 15.022L18.8475 12.7099L15.0538 10.4303L11.2063 12.7412L15 15.022ZM25.07 8.97065L21.2762 6.69106L17.4825 8.97065L21.2762 11.2502L25.07 8.97065ZM15 2.91928L11.2063 5.19887L15.0538 7.50976L18.8475 5.23016L15 2.91928ZM4.93 8.97065L8.77625 11.2815L12.6237 8.97065L8.77625 6.65976L4.93 8.97065Z" fill="#B0B0B0"/>
                      </svg>
                      ${imovel.area}
                  </span>
                  <span>
                      <svg width="30" height="25" viewBox="0 0 30 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M23.75 0H6.25C2.80375 0 0 2.80375 0 6.25V23.75C0 24.4413 0.56 25 1.25 25C1.94 25 2.5 24.4413 2.5 23.75V21.25H27.5V23.75C27.5 24.4413 28.0588 25 28.75 25C29.4412 25 30 24.4413 30 23.75V6.25C30 2.80375 27.1963 0 23.75 0ZM6.25 2.5H23.75C25.8175 2.5 27.5 4.1825 27.5 6.25V13.75H25C25 10.9925 22.7575 8.75 20 8.75H18.75C17.2575 8.75 15.9175 9.4075 15 10.4463C14.0825 9.40625 12.7425 8.75 11.25 8.75H10C7.2425 8.75 5 10.9925 5 13.75H2.5V6.25C2.5 4.1825 4.1825 2.5 6.25 2.5ZM16.25 13.75C16.25 12.3713 17.3713 11.25 18.75 11.25H20C21.3787 11.25 22.5 12.3713 22.5 13.75H16.25ZM7.5 13.75C7.5 12.3713 8.62125 11.25 10 11.25H11.25C12.6287 11.25 13.75 12.3713 13.75 13.75H7.5ZM2.5 18.75V16.25H27.5V18.75H2.5Z" fill="#B0B0B0"/>
                      </svg>
                      ${imovel.quartos}
                  </span>
              </div>
              <div class="card-imovel__footer">
                  <span class="card-imovel__estagio">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M12 2C6.486 2 2 6.486 2 12C2 17.514 6.486 22 12 22C17.514 22 22 17.514 22 12C22 6.486 17.514 2 12 2ZM12 20C7.589 20 4 16.411 4 12C4 7.589 7.589 4 12 4C16.411 4 20 7.589 20 12C20 16.411 16.411 20 12 20Z" fill="currentColor"/>
                          <path d="M11 7H13V13H11V7Z" fill="currentColor"/>
                          <path d="M11 15H13V17H11V15Z" fill="currentColor"/>
                      </svg>
                      ${estagioFormatado}
                  </span>
                  <a href="${imovel.link}" class="btn">Mais detalhes</a>
              </div>
          </div>
      </div>
    `;
  }

  // ─── Renderizar no modo ARCHIVE (Grid + Paginação) ───
  function renderizarGrid(dados, page = 1) {
    currentResults = dados;
    currentPage = page;

    gridImoveis.innerHTML = "";

    if (dados.length === 0) {
      gridImoveis.innerHTML =
        '<p class="msg-vazio">Nenhum empreendimento encontrado com estes filtros.</p>';
      renderizarPaginacao(0);
      return;
    }

    // Calcula paginação
    const totalPages = Math.ceil(dados.length / ITEMS_PER_PAGE);
    const start = (page - 1) * ITEMS_PER_PAGE;
    const end = start + ITEMS_PER_PAGE;
    const paginatedData = dados.slice(start, end);

    let html = "";
    paginatedData.forEach((imovel) => {
      html += gerarCardHtml(imovel);
    });

    gridImoveis.innerHTML = html;
    renderizarPaginacao(totalPages);

    // Scroll suave para o topo do grid ao mudar de página (exceto na primeira carga)
    if (page > 1) {
      gridImoveis.scrollIntoView({ behavior: "smooth", block: "start" });
    }
  }

  // ─── Paginação ───
  function renderizarPaginacao(totalPages) {
    const paginacaoEl = document.getElementById("paginacao-empreendimentos");
    if (!paginacaoEl) return;

    paginacaoEl.innerHTML = "";

    if (totalPages <= 1) return;

    let html = "";

    // Botão anterior
    html += `<button class="secao-empreendimentos__pag-btn ${currentPage === 1 ? "disabled" : ""}" 
              data-page="${currentPage - 1}" ${currentPage === 1 ? "disabled" : ""} aria-label="Página anterior">
              <svg width="8" height="14" viewBox="0 0 15 28" fill="none" xmlns="http://www.w3.org/2000/svg" style="transform: scaleX(-1);">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.4273 15.5127C14.794 15.1183 15 14.5835 15 14.0258C15 13.4682 14.794 12.9334 14.4273 12.539L3.36277 0.642037C3.18234 0.441174 2.96652 0.280959 2.72789 0.17074C2.48926 0.0605213 2.23261 0.00250594 1.9729 7.94035e-05C1.7132 -0.00234713 1.45565 0.0508642 1.21527 0.156607C0.974899 0.262351 0.756516 0.418509 0.572871 0.61597C0.389226 0.813431 0.243994 1.04824 0.145649 1.3067C0.0473042 1.56515 -0.00218296 1.84208 7.34329e-05 2.12132C0.00233078 2.40057 0.0562868 2.67653 0.158793 2.93311C0.261301 3.18969 0.410306 3.42175 0.597115 3.61575L10.2789 14.0258L0.597115 24.4359C0.24083 24.8326 0.0436859 25.3638 0.0481424 25.9152C0.052599 26.4666 0.258299 26.9941 0.62094 27.384C0.983582 27.774 1.47415 27.9951 1.98698 27.9999C2.49981 28.0047 2.99388 27.7927 3.36277 27.4097L14.4273 15.5127Z" fill="#00512A"/>
              </svg>
            </button>`;

    // Números de página
    for (let i = 1; i <= totalPages; i++) {
      html += `<button class="secao-empreendimentos__pag-num ${i === currentPage ? "active" : ""}" 
                data-page="${i}" aria-label="Página ${i}" ${i === currentPage ? 'aria-current="page"' : ""}>
                ${i}
              </button>`;
    }

    // Botão próximo
    html += `<button class="secao-empreendimentos__pag-btn ${currentPage === totalPages ? "disabled" : ""}" 
              data-page="${currentPage + 1}" ${currentPage === totalPages ? "disabled" : ""} aria-label="Próxima página">
              <svg width="8" height="14" viewBox="0 0 15 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.4273 15.5127C14.794 15.1183 15 14.5835 15 14.0258C15 13.4682 14.794 12.9334 14.4273 12.539L3.36277 0.642037C3.18234 0.441174 2.96652 0.280959 2.72789 0.17074C2.48926 0.0605213 2.23261 0.00250594 1.9729 7.94035e-05C1.7132 -0.00234713 1.45565 0.0508642 1.21527 0.156607C0.974899 0.262351 0.756516 0.418509 0.572871 0.61597C0.389226 0.813431 0.243994 1.04824 0.145649 1.3067C0.0473042 1.56515 -0.00218296 1.84208 7.34329e-05 2.12132C0.00233078 2.40057 0.0562868 2.67653 0.158793 2.93311C0.261301 3.18969 0.410306 3.42175 0.597115 3.61575L10.2789 14.0258L0.597115 24.4359C0.24083 24.8326 0.0436859 25.3638 0.0481424 25.9152C0.052599 26.4666 0.258299 26.9941 0.62094 27.384C0.983582 27.774 1.47415 27.9951 1.98698 27.9999C2.49981 28.0047 2.99388 27.7927 3.36277 27.4097L14.4273 15.5127Z" fill="#00512A"/>
              </svg>
            </button>`;

    paginacaoEl.innerHTML = html;

    // Event listeners para a paginação
    paginacaoEl.querySelectorAll("[data-page]").forEach((btn) => {
      btn.addEventListener("click", () => {
        const page = parseInt(btn.dataset.page);
        if (page >= 1 && page <= totalPages) {
          renderizarGrid(currentResults, page);
        }
      });
    });
  }

  // ─── Renderizar no modo SWIPER (Carrossel) ───
  function renderizarSwiper(dados) {
    gridImoveis.innerHTML = "";

    if (dados.length === 0) {
      gridImoveis.innerHTML =
        '<p class="msg-vazio">Nenhum empreendimento encontrado com estes filtros.</p>';
      return;
    }

    let html = "";
    dados.forEach((imovel) => {
      html += `<div class="swiper-slide">${gerarCardHtml(imovel)}</div>`;
    });

    gridImoveis.innerHTML = html;

    // Inicializa ou atualiza o Swiper
    if (swiperInstance) {
      swiperInstance.destroy(true, true);
    }

    swiperInstance = new Swiper(".swiper-empreendimentos", {
      modules: [Navigation, Pagination],
      slidesPerView: 1,
      spaceBetween: 16,
      pagination: {
        el: ".swiper-empreendimentos-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".secao-empreendimentos__nav--next",
        prevEl: ".secao-empreendimentos__nav--prev",
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
          spaceBetween: 24,
        },
        992: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
      },
    });
  }

  // ─── Função principal de renderização ───
  function renderizarCards(dados) {
    if (isArchive) {
      renderizarGrid(dados, 1);
    } else {
      renderizarSwiper(dados);
    }
  }

  // 4. Lógica de Filtragem
  function aplicarFiltros() {
    const est = selEstado.value;
    const cid = selCidade.value;
    const bai = selBairro.value;
    const stg = selEstagio.value;

    const resultados = imoveisData.filter((imovel) => {
      let passaEstado = est === "todos" || imovel.estado === est;
      let passaCidade = cid === "todos" || imovel.cidade === cid;
      let passaBairro = bai === "todos" || imovel.bairro === bai;
      let passaEstagio = stg === "todos" || imovel.estagio === stg;

      return passaEstado && passaCidade && passaBairro && passaEstagio;
    });

    renderizarCards(resultados);
  }

  // 5. Inicialização
  renderizarCards(imoveisData);

  if (btnFiltrar) {
    btnFiltrar.addEventListener("click", aplicarFiltros);
  }
}
