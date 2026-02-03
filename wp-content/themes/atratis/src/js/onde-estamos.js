
/**
 * Onde Estamos - Tabs & Filter Logic
 */
export function initOndeEstamos() {
  const section = document.querySelector('.secao-onde-estamos');
  if (!section) return;

  // --- Logic for Tabs ---
  const buttons = section.querySelectorAll('.map-tab-btn');
  const panes = section.querySelectorAll('.map-pane');

  if (buttons.length > 0) {
    buttons.forEach((btn) => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const targetId = btn.getAttribute('data-target');

        panes.forEach(pane => {
          if (pane.id === targetId.replace('#', '')) {
            pane.classList.add('active');
          } else {
            pane.classList.remove('active');
          }
        });

        buttons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
      });
    });
  }

  // --- Logic for Search Filters ---
  setupSearch('busca-cidade', 'results-cidade');
  setupSearch('busca-estado', 'results-estado');

  // --- Logic for Modal ---
  setupModal();
}

/**
 * setupModal handles the modal interactions
 */
function setupModal() {
  const modal = document.getElementById('modal-sugestao');
  const closeBtn = modal?.querySelector('.modal-close');
  const overlay = modal; // The modal div itself acts as overlay in our CSS

  if (!modal) return;

  // Function to open modal
  window.openSuggestionModal = function () {
    modal.classList.add('active');
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
    loadBitrixScript();
  };

  // Function to close modal
  const closeModal = () => {
    modal.classList.remove('active');
    document.body.style.overflow = '';
  };

  closeBtn?.addEventListener('click', closeModal);

  // Close on click outside (overlay)
  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      closeModal();
    }
  });

  // Close on Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modal.classList.contains('active')) {
      closeModal();
    }
  });
}

/**
 * Loads the Bitrix24 script only once
 */
let isBitrixLoaded = false;
function loadBitrixScript() {
  if (isBitrixLoaded) return;

  const container = document.getElementById('bitrix-form-container');
  if (!container) return;

  isBitrixLoaded = true;

  // Create the script element provided by the user
  // The user script finds the first script tag to insert before. 
  // We want to control where the form appears.
  // Bitrix inline forms usually replace the script tag that calls them.
  // So we will append a script tag correctly configured into our container.

  const script = document.createElement('script');
  script.setAttribute('data-b24-form', 'inline/10/wtw9vl');
  script.setAttribute('data-skip-moving', 'true');

  // The loader script logic
  (function (w, d, u) {
    var s = d.createElement('script');
    s.async = true;
    s.src = u + '?' + (Date.now() / 180000 | 0);
    // We append the loader to the head, but the form configuration is on 'script' element we just created?
    // Actually, the snippet:
    // (function(w,d,u){...})(window,document,'https://cdn.bitrix24.com.br/b34224559/crm/form/loader_10.js');
    // just loads the library. 
    // The library then looks for elements with data-b24-form.

    const h = d.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s, h);
  })(window, document, 'https://cdn.bitrix24.com.br/b34224559/crm/form/loader_10.js');

  // We need the data-b24-form element to exist for the loader to find it.
  // The loader scans the DOM.
  // Let's create a div or script that acts as the anchor.
  // The user snippet had the data attribute ON the script tag itself efficiently.

  // Let's append the anchor script to our container
  container.innerHTML = ''; // Clear loading text
  container.appendChild(script);

}

/**
 * Generic Search Setup Function
 */
function setupSearch(inputId, resultsId) {
  const input = document.getElementById(inputId);
  const resultsContainer = document.getElementById(resultsId);

  if (!input || !resultsContainer) return;

  let data = [];
  try {
    const rawData = resultsContainer.getAttribute('data-items');
    data = rawData ? JSON.parse(rawData) : [];
  } catch (e) {
    console.error(`Erro ao analisar dados JSON para ${resultsId}:`, e);
    return;
  }

  const linkContato = resultsContainer.getAttribute('data-link-contato') || '/contato';

  const filterResults = (query) => {
    resultsContainer.innerHTML = '';

    if (!query) {
      resultsContainer.classList.remove('visible');
      return;
    }

    const filtered = data.filter(item =>
      item.toLowerCase().includes(query.toLowerCase())
    );

    if (filtered.length > 0) {
      filtered.forEach(item => {
        const itemEl = document.createElement('div');
        itemEl.className = 'result-item';
        itemEl.innerHTML = `
          <span class="city-name">${item}</span>
          <a href="${linkContato}" target="_blank" class="cta-link">Fale com a gente agora!</a>
        `;
        itemEl.addEventListener('click', (e) => {
          if (!e.target.classList.contains('cta-link')) {
            input.value = item;
            resultsContainer.classList.remove('visible');
          }
        });
        resultsContainer.appendChild(itemEl);
      });
    } else {
      // Empty State
      const emptyEl = document.createElement('div');
      emptyEl.className = 'no-results';
      // Added ID or class trigger logic here
      emptyEl.innerHTML = `
        <p>Não estamos disponíveis na sua região agora :(</p>
        <button type="button" class="btn-sugerir" onclick="window.openSuggestionModal()">Sugira sua cidade</button>
      `;
      // Note: Changed <a> to <button> and added onclick handler simply
      // because we exposed openSuggestionModal globally.
      resultsContainer.appendChild(emptyEl);
    }

    resultsContainer.classList.add('visible');
  };

  input.addEventListener('input', (e) => {
    filterResults(e.target.value.trim());
  });

  input.addEventListener('focus', (e) => {
    if (e.target.value.trim().length > 0) {
      filterResults(e.target.value.trim());
    }
  });

  document.addEventListener('click', (e) => {
    if (!input.contains(e.target) && !resultsContainer.contains(e.target)) {
      resultsContainer.classList.remove('visible');
    }
  });
}
