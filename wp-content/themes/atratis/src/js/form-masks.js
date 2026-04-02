export function initFormMasks() {
    // Seleciona pelos nomes exatos que o CF7 gera no HTML
    const phoneInput = document.querySelector('input[name="your-whatsapp"]');
    const emailInput = document.querySelector('input[name="your-email"]');

    // Teste de debug: Abra o console (F12) e veja se aparece "Campos encontrados"
    if (!phoneInput || !emailInput) {
        console.warn("Mascara: Campos do formulário não encontrados no DOM.");
        return;
    }

    console.log("Mascara: Campos encontrados e prontos!");

    phoneInput.addEventListener('input', (e) => {
        let value = e.target.value.replace(/\D/g, ""); // Remove tudo que não é número
        
        if (value.length > 11) value = value.slice(0, 11);

        // Lógica de máscara dinâmica (fixo ou celular)
        if (value.length > 10) {
            // Formato (99) 99999-9999
            value = value.replace(/^(\d{2})(\d{5})(\d{4}).*/, "($1) $2-$3");
        } else if (value.length > 6) {
            // Formato (99) 9999-9999
            value = value.replace(/^(\d{2})(\d{4})(\d{4}).*/, "($1) $2-$3");
        } else if (value.length > 2) {
            value = value.replace(/^(\d{2})(\d{0,5})/, "($1) $2");
        } else if (value.length > 0) {
            value = value.replace(/^(\d*)/, "($1");
        }
        
        e.target.value = value;
    });

    emailInput.addEventListener('input', (e) => {
        // Remove espaços e força minúsculo em tempo real
        e.target.value = e.target.value.toLowerCase().replace(/\s/g, '');
    });
}