import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
  plugins: [],
  css: {
    preprocessorOptions: {
      scss: {
        api: 'modern-compiler', // Usa o compilador moderno para evitar "legacy-js-api"
        silenceDeprecations: ['legacy-js-api', 'import', 'global-builtin', 'color-functions', 'mixed-decls', 'if-function'],
      }
    }
  },
  build: {
    // Pasta de saída dos arquivos compilados
    outDir: 'assets',
    emptyOutDir: true,

    // GARANTIA: Minificação ativa usando 'esbuild' (padrão ultra-rápido e eficiente)
    minify: 'esbuild',

    rollupOptions: {
      // Ponto de entrada: seu JS
      input: path.resolve(__dirname, 'src/js/main.js'),

      output: {
        // Remove hashes dos nomes de arquivo para facilitar o enqueue no WordPress
        entryFileNames: 'js/script.min.js',
        assetFileNames: (assetInfo) => {
          // Garante que o CSS saia em assets/css/all.css
          if (assetInfo.name && assetInfo.name.endsWith('.css')) {
            return 'css/all.css';
          }
          return 'assets/[name][extname]';
        },
      }
    }
  }
});
