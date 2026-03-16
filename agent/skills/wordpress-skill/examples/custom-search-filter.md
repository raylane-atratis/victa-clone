# Grid de Empreendimentos de Alta Performance

Este exemplo documenta como implementar um sistema de filtragem de imóveis ultra-rápido, onde todos os dados são carregados inicialmente em JSON e processados inteiramente no client-side (navegador), eliminando a necessidade de requisições AJAX lentas.

## 1. Visão Geral da Arquitetura

Em vez de disparar requisições para o servidor a cada filtro, o servidor entrega todos os imóveis de uma vez na primeira carga da página em um formato JSON invisível. O JavaScript no navegador do usuário faz o filtro e a renderização dos cards instantaneamente (em milissegundos).

## 2. Implementação Passo a Passo

### Passo 1: O Back-end (Preparação dos Dados no WordPress)

Precisamos extrair os dados do Custom Post Type (`empreendimentos`) e enviá-los para o Front-end. Insira este código no `functions.php` do seu tema ou no arquivo do seu plugin (ajuste os nomes dos campos ACF/Taxonomias conforme o seu banco de dados):

```php
<?php
// Função para carregar os dados dos imóveis no rodapé da página
add_action('wp_footer', 'injetar_dados_empreendimentos_json');

function injetar_dados_empreendimentos_json() {
    // Só carrega na página onde a seção existe (ajuste o ID ou slug da página)
    if (!is_page('home')) return;

    $args = array(
        'post_type'      => 'empreendimentos',
        'posts_per_page' => -1, // Pega todos os ativos
        'post_status'    => 'publish',
    );

    $query = new WP_Query($args);
    $imoveis = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            
            // Pega as taxonomias (Filtros)
            $estado = wp_get_post_terms(get_the_ID(), 'estado', array('fields' => 'slugs'));
            $cidade = wp_get_post_terms(get_the_ID(), 'cidade', array('fields' => 'slugs'));
            $bairro = wp_get_post_terms(get_the_ID(), 'bairro', array('fields' => 'slugs'));
            $estagio = wp_get_post_terms(get_the_ID(), 'estagio_obra', array('fields' => 'slugs'));

            // Monta o Array Limpo
            $imoveis[] = array(
                'id'        => get_the_ID(),
                'titulo'    => get_the_title(),
                'link'      => get_permalink(),
                // Use a URL da imagem otimizada (ex: tamanho 'medium_large')
                'imagem'    => get_the_post_thumbnail_url(get_the_ID(), 'medium_large'), 
                'local'     => get_field('local_texto'), // Ex: "Praia do Futuro | Fortaleza-CE"
                'area'      => get_field('area_texto'),  // Ex: "49,65m² a 100,02m²"
                'quartos'   => get_field('quartos'),     // Ex: "2 Quartos"
                'badge'     => get_field('badge_texto'), // Ex: "100% vendido" (vazio se não tiver)
                
                // Filtros (Slugs para comparação no JS)
                'estado'    => !empty($estado) ? $estado[0] : '',
                'cidade'    => !empty($cidade) ? $cidade[0] : '',
                'bairro'    => !empty($bairro) ? $bairro[0] : '',
                'estagio'   => !empty($estagio) ? $estagio[0] : '',
            );
        }
        wp_reset_postdata();
    }

    // A MÁGICA: Converte o PHP em um JSON nativo no JavaScript
    echo '<script type="text/javascript">';
    echo 'const imoveisData = ' . json_encode($imoveis) . ';';
    echo '</script>';
}
?>
```

### Passo 2: O Front-end (Estrutura HTML)

Monte o esqueleto base na sua página (pode ser via Gutenberg, Elementor usando widget de HTML, ou direto no arquivo do tema).

```html
<section class="secao-empreendimentos">
    <div class="header-secao">
        <span class="subtitle">IMÓVEIS</span>
        <h2>Empreendimentos</h2>
    </div>

    <div class="barra-filtros">
        <span>Filtro:</span>
        <select id="filtro-estado">
            <option value="todos">Estado</option>
            <option value="ceara">Ceará</option>
        </select>
        
        <select id="filtro-cidade">
            <option value="todos">Cidade</option>
            <option value="fortaleza">Fortaleza</option>
            <option value="eusebio">Eusébio</option>
        </select>

        <select id="filtro-bairro">
            <option value="todos">Bairro</option>
            <option value="praia-do-futuro">Praia do Futuro</option>
            <option value="joquei-clube">Jóquei Clube</option>
        </select>

        <select id="filtro-estagio">
            <option value="todos">Estágio da obra</option>
            <option value="lancamento">Lançamento</option>
            <option value="obras-iniciadas">Obras iniciadas</option>
        </select>

        <button id="btn-filtrar" class="btn-filtrar">Filtrar</button>
    </div>

    <div id="grid-imoveis" class="grid-imoveis">
        <!-- Cards serão renderizados aqui pelo JS -->
    </div>
</section>
```

### Passo 3: O Motor de Renderização (Vanilla JavaScript)

Crie um arquivo JS (ex: `filtros-imoveis.js`) e carregue no rodapé, ou coloque direto em uma tag `<script>` na página. Este é o cérebro da operação.

```javascript
document.addEventListener('DOMContentLoaded', function() {
    
    // 1. Elementos da DOM
    const gridImoveis = document.getElementById('grid-imoveis');
    const btnFiltrar = document.getElementById('btn-filtrar');
    
    // Selects
    const selEstado = document.getElementById('filtro-estado');
    const selCidade = document.getElementById('filtro-cidade');
    const selBairro = document.getElementById('filtro-bairro');
    const selEstagio = document.getElementById('filtro-estagio');

    // 2. Trava de segurança: Verifica se os dados existem
    if (typeof imoveisData === 'undefined' || !gridImoveis) return;

    // 3. Função de Renderização dos Cards
    function renderizarCards(dados) {
        gridImoveis.innerHTML = ''; // Limpa o grid atual

        if (dados.length === 0) {
            gridImoveis.innerHTML = '<p class="msg-vazio">Nenhum empreendimento encontrado com estes filtros.</p>';
            return;
        }

        let html = '';
        
        dados.forEach(imovel => {
            // Verifica se tem badge de "100% vendido"
            let badgeHtml = imovel.badge ? `<span class="badge-vendido">${imovel.badge}</span>` : '';

            // Monta o Card (Ajuste as classes CSS conforme seu layout)
            html += `
                <div class="card-imovel">
                    <div class="card-imagem">
                        ${badgeHtml}
                        <img src="${imovel.imagem}" alt="${imovel.titulo}" loading="lazy">
                    </div>
                    <div class="card-conteudo">
                        <h3>${imovel.titulo}</h3>
                        <p class="localizacao"><i class="icon-pin"></i> ${imovel.local}</p>
                        
                        <div class="infos-tecnicas">
                            <span><i class="icon-area"></i> ${imovel.area}</span>
                            <span><i class="icon-bed"></i> ${imovel.quartos}</span>
                        </div>
                        
                        <div class="card-footer">
                            <span class="estagio-obra"><i class="icon-crane"></i> ${imovel.estagio.replace('-', ' ')}</span>
                            <a href="${imovel.link}" class="btn-detalhes">Mais detalhes</a>
                        </div>
                    </div>
                </div>
            `;
        });

        gridImoveis.innerHTML = html;
    }

    // 4. Lógica de Filtragem
    function aplicarFiltros() {
        const est = selEstado.value;
        const cid = selCidade.value;
        const bai = selBairro.value;
        const stg = selEstagio.value;

        // Filtra o array original em memória (MUITO RÁPIDO)
        const resultados = imoveisData.filter(imovel => {
            let passaEstado  = (est === 'todos' || imovel.estado === est);
            let passaCidade  = (cid === 'todos' || imovel.cidade === cid);
            let passaBairro  = (bai === 'todos' || imovel.bairro === bai);
            let passaEstagio = (stg === 'todos' || imovel.estagio === stg);

            return passaEstado && passaCidade && passaBairro && passaEstagio;
        });

        renderizarCards(resultados);
    }

    // 5. Inicialização
    // Renderiza todos os imóveis logo que a página carrega
    renderizarCards(imoveisData);

    // Escuta o clique do botão filtrar
    btnFiltrar.addEventListener('click', aplicarFiltros);
});
```

## 3. Checklist de Performance (Obrigatório para nota 100)

Para que essa seção não afunde sua nota no Google Lighthouse, siga estas regras de ouro no CSS/Assets:

1.  **loading="lazy"**: Como visto no HTML gerado pelo JS, a tag de imagem tem `loading="lazy"`. O navegador só vai baixar a imagem do empreendimento quando o usuário rolar a tela até ela.
2.  **Tamanho das Imagens**: No Passo 1, usamos `medium_large`. Se as imagens subidas no painel forem pesadas, o WordPress entregará uma versão comprimida de 768px (ou tamanho configurado), pesando cerca de 60kb.
3.  **Formato**: Certifique-se de usar um plugin no WP (como WebP Express ou nativo do Litespeed/Cloudflare) para converter essas imagens para `.webp`.
4.  **CSS Grid**: Não use bibliotecas JS pesadas para organizar lado a lado. Use:
    ```css
    #grid-imoveis {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }
    ```
