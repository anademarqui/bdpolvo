document.addEventListener("DOMContentLoaded", function () {
    const cepInput = document.querySelector('input[name="cep"]');

    cepInput.addEventListener("blur", function () {
        const cep = cepInput.value.replace(/\D/g, '');

        if (cep.length !== 8) {
            alert("CEP inválido. Insira 8 dígitos.");
            return;
        }

        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Erro na requisição");
                }
                return response.json();
            })
            .then(data => {
                if (data.erro) {
                    alert("CEP não encontrado.");
                    return;
                }

                document.querySelector('input[name="rua"]').value = data.logradouro || "";
                document.querySelector('input[name="bairro"]').value = data.bairro || "";
                document.querySelector('select[name="cidade"]').value = data.localidade || "";
                document.querySelector('select[name="estado"]').value = data.uf || "";
            })
            .catch(error => {
                console.error("Erro ao buscar o CEP: ", error);
                alert("Não foi possível buscar o endereço. Tente novamente.");
            });
    });
});
