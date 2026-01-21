# Implementação de Filtro de Busca Customizado

Este exemplo documenta como criar um filtro de busca customizado com autocomplete (semelhante a um `datalist`, mas com total controle de estilo), como implementado na "Seção Onde Estamos".

## Visão Geral

A funcionalidade permite que o usuário digite o nome de uma cidade ou estado e veja resultados filtrados em um dropdown customizado. Se houver resultados, um link de ação é exibido. Se não houver, um estado de "vazio" com um botão de sugestão é mostrado.

## 1. Estrutura HTML (PHP)

O HTML utiliza um `input` para a busca e uma `div` oculta para os resultados. Os dados para filtragem são passados via atributo `data-items` no container de resultados.

```php
<!-- Exemplo de estrutura para busca de cidades -->
<div class="map-search mt-4">
    <div class="input-group">
        <!-- Ícone decorativo -->
        <span class="input-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- ... path do ícone ... -->
            </svg>
        </span>
        
        <!-- Input com Label Flutuante -->
        <div class="input-wrapper">
            <input type="text" class="form-control" id="busca-cidade" autocomplete="off" placeholder="Buscar minha cidade">
            <label class="input-label" for="busca-cidade">Buscar minha cidade</label>
        </div>
        
        <!-- Container de Resultados (Data Attribute contém o JSON) -->
        <!-- O PHP popula o data-items com um array JSON -->
        <div class="search-results custom-scrollbar" id="results-cidade" data-items='<?php echo json_encode($cidades_mock); ?>'></div>
    </div>
</div>
```

## 2. Estilização (SCSS)

O SCSS trata do posicionamento relativo do dropdown, do estilo do input com label flutuante e da animação de entrada.

**Destaques:**
- `z-index`: Ajustado para garantir que o dropdown apareça sobre outros elementos (`.map-search` com 100, `.search-results` com 999).
- **Label Flutuante**: O Label é posicionado absolutamente e oculto por padrão (`opacity: 0`). Quando o input recebe foco (`&:focus + .input-label`), ele aparece.
- **Placeholder**: O placeholder padrão é visível e ocultado no foco para dar lugar ao label.

```scss
  .map-search {
    max-width: 100%;
    position: relative;
    z-index: 100; // Garante contexto de empilhamento

    .input-wrapper {
      position: relative;
      width: 100%;
    }

    // Label Flutuante
    .input-label {
      position: absolute;
      top: 0;
      left: 56px; // Espaço para o ícone
      transform: translateY(-50%);
      background-color: #FBF7FF; // Cor de fundo para cobrir a borda
      padding: 0 8px;
      z-index: 2;
      pointer-events: none;
      opacity: 0; // Oculto inicialmente
      transition: opacity 0.4s ease-in-out, transform 0.4s ease-in-out;
    }

    .form-control {
      width: 100%;
      padding: 14px 20px 14px 56px;
      border-radius: 50px;
      outline: none;

      // Mostra o label quando focado
      &:focus + .input-label {
        opacity: 1;
      }
      
      // Oculta placeholder quando focado
      &:focus::placeholder {
        opacity: 0;
      }
    }

    // Dropdown de Resultados
    .search-results {
      position: absolute;
      top: calc(100% + 10px);
      left: 0;
      width: 100%;
      background: #fff;
      border-radius: 20px;
      display: none; // Oculto por padrão
      z-index: 999; // Acima de tudo

      &.visible {
        display: block; // JS adiciona essa classe
        animation: fadeIn 0.3s ease;
      }
    }
  }
```

## 3. Lógica JavaScript

O script gerencia a leitura dos dados JSON, a filtragem baseada no input do usuário e a renderização do HTML dos resultados.

```javascript
/**
 * Configuração Genérica de Busca
 * @param {string} inputId - ID do input
 * @param {string} resultsId - ID do container de resultados
 */
function setupSearch(inputId, resultsId) {
  const input = document.getElementById(inputId);
  const resultsContainer = document.getElementById(resultsId);

  if (!input || !resultsContainer) return;

  // 1. Recuperar Dados do atributo data-items
  let data = [];
  try {
    const rawData = resultsContainer.getAttribute('data-items');
    data = rawData ? JSON.parse(rawData) : [];
  } catch (e) {
    console.error(`Erro ao analisar JSON`, e);
    return;
  }

  // 2. Função de Filtro
  const filterResults = (query) => {
    resultsContainer.innerHTML = ''; // Limpa anteriores

    if (!query) {
      resultsContainer.classList.remove('visible');
      return;
    }

    // Filtra array (case insensitive)
    const filtered = data.filter(item =>
      item.toLowerCase().includes(query.toLowerCase())
    );

    // 3. Renderização
    if (filtered.length > 0) {
      filtered.forEach(item => {
        const itemEl = document.createElement('div');
        itemEl.className = 'result-item';
        itemEl.innerHTML = `
          <span class="city-name">${item}</span>
          <a href="/contato" class="cta-link">Fale com a gente agora!</a>
        `;
        
        // Populate input on click
        itemEl.addEventListener('click', (e) => {
            if (!e.target.classList.contains('cta-link')) {
                input.value = item;
                resultsContainer.classList.remove('visible');
            }
        });

        resultsContainer.appendChild(itemEl);
      });
    } else {
      // Estado Vazio
      const emptyEl = document.createElement('div');
      emptyEl.className = 'no-results';
      emptyEl.innerHTML = `
        <p>Não estamos disponíveis na sua região agora :(</p>
        <a href="/contato" class="btn-sugerir">Sugira sua cidade</a>
      `;
      resultsContainer.appendChild(emptyEl);
    }

    resultsContainer.classList.add('visible');
  };

  // Listeners
  input.addEventListener('input', (e) => filterResults(e.target.value.trim()));
  input.addEventListener('focus', (e) => {
      if(e.target.value.trim().length > 0) filterResults(e.target.value.trim());
  });
  
  // Fechar ao clicar fora
  document.addEventListener('click', (e) => {
    if (!input.contains(e.target) && !resultsContainer.contains(e.target)) {
      resultsContainer.classList.remove('visible');
    }
  });
}
```

## Como Usar

1.  **Adicione o HTML** ao seu template PHP, garantindo que `$seus_dados_array` seja um array PHP válido de strings.
2.  **Importe o SCSS** no seu arquivo de estilos do bloco ou global.
3.  **Inicialize o JS** chamando a função `setupSearch` com os IDs corretos.

Esta abordagem desacopla os dados da apresentação, permitindo que o PHP (ACF, Banco de Dados) forneça os dados sem que o JS precise fazer requisições AJAX adicionais para conjuntos de dados pequenos a médios.
