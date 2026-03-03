export function initPhoneMasks() {
  const phoneInputs = document.querySelectorAll(
    'input[type="tel"], .wpcf7-tel',
  );

  phoneInputs.forEach((input) => {
    input.addEventListener("input", function (e) {
      let value = e.target.value.replace(/\D/g, ""); // Remove tudo que não for dígito numérico

      // Limita a 11 números no máximo
      if (value.length > 11) {
        value = value.substring(0, 11);
      }

      // Aplica a máscara BR com base na quantidade de números lidos
      if (value.length === 0) {
        e.target.value = "";
      } else if (value.length <= 2) {
        e.target.value = "(" + value;
      } else if (value.length <= 6) {
        e.target.value =
          "(" + value.substring(0, 2) + ") " + value.substring(2);
      } else if (value.length <= 10) {
        // Formato Celular Antigo / Fixo: (XX) XXXX-XXXX
        e.target.value =
          "(" +
          value.substring(0, 2) +
          ") " +
          value.substring(2, 6) +
          "-" +
          value.substring(6);
      } else {
        // Formato Celular Novo: (XX) XXXXX-XXXX
        e.target.value =
          "(" +
          value.substring(0, 2) +
          ") " +
          value.substring(2, 7) +
          "-" +
          value.substring(7);
      }
    });

    // Se o usuário tentar colar algo, disparamos a validação manual logo após
    input.addEventListener("paste", function () {
      setTimeout(() => {
        let event = new Event("input", { bubbles: true });
        input.dispatchEvent(event);
      }, 0);
    });
  });
}
