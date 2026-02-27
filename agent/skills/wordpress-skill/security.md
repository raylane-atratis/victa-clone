# Playbook Definitivo de Segurança WordPress: Defesa em Profundidade

Este documento estabelece as diretrizes rigorosas de segurança para desenvolvimento, configuração e manutenção do nosso ecossistema WordPress. A segurança aqui é tratada como um processo contínuo e em camadas (Defense in Depth).

---

## FASE 1: Hardening de Servidor e Infraestrutura

A primeira linha de defesa acontece antes mesmo do tráfego atingir o PHP.

### Bloqueio no nível do Nginx/Apache:

- **Arquivos Ocultos:** Negar acesso a todos os arquivos ocultos (começados com `.`, como `.git`, `.env`).
- **Execução PHP Restrita:** Bloquear acesso direto a arquivos `.php` dentro das pastas `/wp-content/uploads/` e `/wp-includes/`.
- **XML-RPC:** Desabilitar o `xmlrpc.php` completamente, a menos que seja estritamente necessário para integrações legadas validadas.
- **Directory Indexing:** Desabilitar listagem de diretórios.

### Headers HTTP de Segurança Rigorosos:

- `Content-Security-Policy` (CSP): Restringir a execução de scripts e carregamento de assets apenas a origens confiáveis.
- `Strict-Transport-Security` (HSTS): Forçar conexões HTTPS (com `includeSubDomains` e `preload`).
- `X-Frame-Options: SAMEORIGIN`: Prevenir Clickjacking.
- `X-Content-Type-Options: nosniff`: Evitar MIME-type sniffing.

---

## FASE 2: Hardening do wp-config.php e Core

A configuração do ambiente deve ser blindada contra manipulações indevidas.

- **Impedir edição de arquivos no painel:** `define( 'DISALLOW_FILE_EDIT', true );`. Impede que um invasor com acesso admin injete código via editor de temas/plugins.
- **Ocultar erros em produção:** `define( 'WP_DEBUG_DISPLAY', false );` e forçar o log em arquivo (`WP_DEBUG_LOG`). Nunca exponha stack traces para os usuários.
- **Forçar SSL em Logins e Admin:** `define( 'FORCE_SSL_ADMIN', true );`.
- **Alterar prefixos de banco de dados:** Nunca utilizar o padrão `wp_`. Opte por prefixos complexos (ex: `wp_x7v9q_`).
- **Chaves de Segurança (Salts):** Rotacionar as chaves `AUTH_KEY`, `SECURE_AUTH_KEY`, etc., periodicamente.

---

## FASE 3: Desenvolvimento Seguro de Temas e Plugins (Código)

Regra de ouro: Nunca confie nos dados do usuário. Todo input é malicioso até que se prove o contrário.

- **Validação (Entrada):** Validar o formato dos dados _antes_ de processá-los no backend (ex: garantir que um e-mail é um e-mail com `is_email()`).
- **Sanitização (Entrada):** Limpar os dados antes de salvar no banco. Uso obrigatório de:
  - `sanitize_text_field()` para strings genéricas.
  - `sanitize_email()`, `sanitize_hex_color()`.
  - `wp_kses()` para permitir apenas tags HTML específicas em áreas de texto rico.
- **Escape (Saída):** Nunca use um `echo` direto com dados dinâmicos. Trate os dados na renderização:
  - `esc_html()` ou `esc_html__()` para textos.
  - `esc_attr()` para atributos HTML.
  - `esc_url()` para links.
- **Proteção de Banco de Dados (SQLi):** Uso absoluto e incondicional de **Prepared Statements** em qualquer query customizada. Nenhuma variável deve ser interpolada diretamente na query.
  - _Exemplo correto:_ `$wpdb->prepare( "SELECT * FROM {$wpdb->prefix}tabela WHERE id = %d", $id );`
- **Proteção CSRF (Nonces):** Todos os formulários, chamadas AJAX e endpoints customizados da REST API devem verificar um Nonce gerado por `wp_create_nonce()` usando `wp_verify_nonce()`.
- **Controle de Acesso:** Verificações rigorosas de Capabilities (`current_user_can()`) antes de executar qualquer ação privilegiada, não apenas checar se o usuário está logado.

---

## FASE 4: Autenticação, APIs e Acesso

Reduzir a superfície de ataque nas portas de entrada do sistema.

- **REST API Hardenizada:** Desabilitar a enumeração de usuários. Por padrão, `/wp-json/wp/v2/users` expõe os logins de todos os autores. Bloquear para visitantes não autenticados.
- **Políticas de Senha e 2FA:** Exigir Autenticação de Dois Fatores (2FA) para todos os usuários com roles de `Editor` para cima.
- **Application Passwords:** Utilizar senhas de aplicação exclusivas (e revogáveis) para integrações externas via REST API, em vez de compartilhar credenciais principais.
- **URL de Login Customizada:** Mover o `/wp-admin` ou `/wp-login.php` para um endpoint não padrão reduz drasticamente o ruído de bots de brute force.

---

## FASE 5: Monitoramento, Atualizações e Auditoria

Segurança é um processo contínuo, não uma configuração estática.

- **Auditoria de Dependências:** Uso do Composer para gerenciar bibliotecas PHP e checar pacotes comprometidos com ferramentas como `Roave/SecurityAdvisories`.
- **Logs de Auditoria:** Registrar ações críticas de usuários (mudanças de senhas, instalação de plugins, alterações em posts) para rastreabilidade forense.
- **Rotina de Backups:** Backups automatizados, incrementais e armazenados _off-site_ (S3, GCS). Um backup só é válido se a rotina de restauração for testada.
- **Scans de Vulnerabilidade:** Integração com WPScan ou Wordfence CLI no pipeline de CI/CD para detectar plugins com vulnerabilidades conhecidas antes do deploy.
