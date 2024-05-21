
function buscarEndereco(cep) {
    fetch(`/api/via-cep/${cep}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('AddressStreet').value = data.logradouro;
            document.getElementById('AddressNeighborhood').value = data.bairro;
            document.getElementById('AddressCity').value = data.localidade;
            if(typeof data.uf != 'undefined'){
                document.getElementById('AddressState').value = data.uf;
            }
        })
        .catch(error => console.error('Erro:', error));
  }


  document.getElementById('AddressZipCode').addEventListener('blur', function() {
    let cep = this.value.replace(/\D/g, '');
    if (cep.length === 8) {
        buscarEndereco(cep); 
    }
});

        const cepInput = document.getElementById('AddressZipCode');

        // Adiciona um event listener para o evento 'input'
        cepInput.addEventListener('input', function() {
            // Obtém o valor atual do input
            let cep = cepInput.value;

            // Remove caracteres não numéricos
            cep = cep.replace(/\D/g, '');

            // Adiciona o hífen conforme o tamanho do CEP
            if (cep.length > 5) {
                cep = cep.replace(/^(\d{5})(\d)/, '$1-$2');
            }

            // Atualiza o valor do input
            cepInput.value = cep;
        });

        const cnpjInput = document.getElementById('Cnpj');

        // Adiciona um event listener para o evento 'input'
        cnpjInput.addEventListener('input', function() {
            // Obtém o valor atual do input
            let cnpj = cnpjInput.value;

            // Remove caracteres não numéricos
            cnpj = cnpj.replace(/\D/g, '');

            // Adiciona a pontuação (pontos e barra) conforme o tamanho do CNPJ
            if (cnpj.length > 2 && cnpj.length <= 5) {
                cnpj = cnpj.replace(/^(\d{2})(\d)/, '$1.$2');
            } else if (cnpj.length > 5 && cnpj.length <= 8) {
                cnpj = cnpj.replace(/^(\d{2})(\d{3})(\d)/, '$1.$2.$3');
            } else if (cnpj.length > 8 && cnpj.length <= 12) {
                cnpj = cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d)/, '$1.$2.$3/$4');
            } else if (cnpj.length > 12 && cnpj.length <= 14) {
                cnpj = cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d)/, '$1.$2.$3/$4-$5');
            }

            // Atualiza o valor do input
            cnpjInput.value = cnpj;


        });

        function formatPhoneNumber(input) {
            let phoneNumber = input.value.replace(/\D/g, '');
        
            if (phoneNumber.length > 2 && phoneNumber.length <= 6) {
                phoneNumber = phoneNumber.replace(/^(\d{2})(\d{1,4})/, '($1) $2');
            } else if (phoneNumber.length > 6 && phoneNumber.length <= 10) {
                phoneNumber = phoneNumber.replace(/^(\d{2})(\d{4})(\d{1,4})/, '($1) $2-$3');
            } else if (phoneNumber.length > 10 && phoneNumber.length <= 11) {
                phoneNumber = phoneNumber.replace(/^(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            } else if (phoneNumber.length > 11 && phoneNumber.length <= 12) {
                phoneNumber = phoneNumber.replace(/^(\d{2})(\d{5})(\d{4})(\d)/, '($1) $2-$3$4');
            }
        
            input.value = phoneNumber;
        }
        
        const phoneNumberInput = document.getElementById('ContactPhoneOne');
        const phoneNumberInput2 = document.getElementById('ContactPhoneTwo');
        
        phoneNumberInput.addEventListener('input', function() {
            formatPhoneNumber(phoneNumberInput);
        });
        
        phoneNumberInput2.addEventListener('input', function() {
            formatPhoneNumber(phoneNumberInput2);
        });