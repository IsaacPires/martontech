document.addEventListener("DOMContentLoaded", function () {

    const precoAtualInput = document.getElementById("UnitPrice");
    const quantidadeInput = document.getElementById("WithdrawalAmount");
    const valorTotalInput = document.getElementById("TotalPrice");

    precoAtualInput.addEventListener("input", calcularValorTotal);
    quantidadeInput.addEventListener("input", calcularValorTotal);

    function calcularValorTotal() {

        const precoAtual = parseFloat(precoAtualInput.value.replace(',', '.'));
        const quantidade = parseFloat(quantidadeInput.value);
        const valorTotal = precoAtual * quantidade;
        if (!isNaN(valorTotal)) {
            valorTotalInput.value = valorTotal.toFixed(2).replace('.', ',');
        } else {
            valorTotalInput.value = "";
        }
    }


    $('#products_id').select2();

    $('#products_id').on('select2:select', function (e) {
        var productId = e.params.data.id;
        console.log('Produto selecionado:', productId);

        fetch(`/request/atualizar-preco/${productId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao atualizar o preço');
                }
                return response.json();
            })
            .then(data => {
                $('#UnitPrice').val(data); // Define o valor do campo UnitPrice com o valor retornado da requisição
            })
            .catch(error => console.error('Erro:', error));
    });

    document.getElementById('UnitPrice').addEventListener('input', function (e) {
        // Remove tudo que não é número ou vírgula
        this.value = this.value.replace(/[^0-9,]/g, '');
        
        // Se houver mais de uma vírgula, mantenha apenas a primeira
        if ((this.value.match(/,/g) || []).length > 1) {
            this.value = this.value.split(',').slice(0, 2).join(',').replace(/,/g, (m, offset, string) => offset === string.indexOf(',') ? m : '');
        }
    });



});
