<?php get_header(); ?>

<section class="error-404-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="icon-error-404">
          <!-- SVG Simple Illustration -->
            <svg width="250" height="200" viewBox="0 0 250 200" fill="none" xmlns="http://www.w3.org/2000/svg" class="img-fluid">
                <circle cx="125" cy="180" r="100" fill="#f0f2f5" fill-opacity="0.5"/>
                  <!-- Octagon Sign -->
                <path d="M95 20 L155 20 L185 50 L185 110 L155 140 L95 140 L65 110 L65 50 Z" fill="#4B5596" stroke="#fff" stroke-width="4"/>
                <text x="125" y="95" font-family="Arial, sans-serif" font-weight="bold" font-size="36" fill="white" text-anchor="middle">404</text>
                <rect x="121" y="140" width="8" height="60" fill="#2c3e50"/>
                <!-- Cone -->
                <path d="M40 180 L80 180 L60 120 Z" fill="#E67E22"/>
                <rect x="35" y="180" width="50" height="5" rx="2" fill="#2c3e50"/>
                <path d="M60 120 L75 165 L45 165 Z" fill="#fff" fill-opacity="0.3"/>
                <circle cx="210" cy="60" r="5" fill="#333" fill-opacity="0.1"/>
                <circle cx="30" cy="100" r="20" fill="none" stroke="#333" stroke-opacity="0.1" stroke-dasharray="4 4"/>
            </svg>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="tile-error-404">
          <h1>404</h1>
          <h3>Parece que você está perdido!</h3>
          <p>Desculpe, mas a página que você está procurando não foi encontrada.</p>
          <a href="<?php echo home_url(); ?>" class="btn btn--primary">Voltar para a Home</a>
        </div>
      </div>
    </div>
  </div>
</section>



<?php get_footer(); ?>
