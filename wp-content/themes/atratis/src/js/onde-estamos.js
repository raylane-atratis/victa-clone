
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

        // 1. Switch Active Pane
        const targetId = btn.getAttribute('data-target');

        panes.forEach(pane => {
          if (pane.id === targetId.replace('#', '')) {
            pane.classList.add('active');
          } else {
            pane.classList.remove('active');
          }
        });

        // 2. Switch Active Button
        buttons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
      });
    });
  }

  // --- Logic for Search Filters ---
  // Setup for City
  setupSearch('busca-cidade', 'results-cidade');
  // Setup for State
  setupSearch('busca-estado', 'results-estado');
}

/**
 * Generic Search Setup Function
 * @param {string} inputId - ID of the input element
 * @param {string} resultsId - ID of the results container (which also holds the JSON data)
 */
function setupSearch(inputId, resultsId) {
  const input = document.getElementById(inputId);
  const resultsContainer = document.getElementById(resultsId);

  if (!input || !resultsContainer) return;

  // 1. Retrieve Data from Data Attribute
  let data = [];
  try {
    const rawData = resultsContainer.getAttribute('data-items');
    data = rawData ? JSON.parse(rawData) : [];
  } catch (e) {
    console.error(`Erro ao analisar dados JSON para ${resultsId}:`, e);
    return;
  }

  // 2. Filter Function
  const filterResults = (query) => {
    // Clear previous results
    resultsContainer.innerHTML = '';

    if (!query) {
      resultsContainer.classList.remove('visible');
      return;
    }

    // Filter items matching query
    const filtered = data.filter(item =>
      item.toLowerCase().includes(query.toLowerCase())
    );

    // Render Logic
    if (filtered.length > 0) {
      // Success State
      filtered.forEach(item => {
        const itemEl = document.createElement('div');
        itemEl.className = 'result-item';

        // Using generic link # for now. In real implementation, this could come from the object.
        itemEl.innerHTML = `
          <span class="city-name">${item}</span>
          <a href="/contato" class="cta-link">Fale com a gente agora!</a>
        `;

        // Populate input on click (optional UX enhancement)
        itemEl.addEventListener('click', (e) => {
          // Prevent if clicking the link directly
          if (!e.target.classList.contains('cta-link')) {
            input.value = item;
            resultsContainer.classList.remove('visible');
          }
        });

        resultsContainer.appendChild(itemEl);
      });
    } else {
      // Empty State (No results)
      const emptyEl = document.createElement('div');
      emptyEl.className = 'no-results';
      emptyEl.innerHTML = `
        <p>Não estamos disponíveis na sua região agora :(</p>
        <a href="/contato" class="btn-sugerir">Sugira sua cidade</a>
      `;
      resultsContainer.appendChild(emptyEl);
    }

    // Show dropdown if there is input
    resultsContainer.classList.add('visible');
  };

  // 3. Event Listeners
  input.addEventListener('input', (e) => {
    filterResults(e.target.value.trim());
  });

  input.addEventListener('focus', (e) => {
    if (e.target.value.trim().length > 0) {
      filterResults(e.target.value.trim());
    }
  });

  // Hide on click outside
  document.addEventListener('click', (e) => {
    if (!input.contains(e.target) && !resultsContainer.contains(e.target)) {
      resultsContainer.classList.remove('visible');
    }
  });
}
