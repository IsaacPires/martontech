document.addEventListener("DOMContentLoaded", function () {

    const precoAtualInput = document.getElementById("UnitPrice");
    const quantidadeInput = document.getElementById("WithdrawalAmount");
    const valorTotalInput = document.getElementById("TotalPrice");

    precoAtualInput.addEventListener("input", calcularValorTotal);
    quantidadeInput.addEventListener("input", calcularValorTotal);

    function calcularValorTotal() {
        const precoAtual = parseFloat(precoAtualInput.value);
        const quantidade = parseFloat(quantidadeInput.value);
        const valorTotal = precoAtual * quantidade;
        if (!isNaN(valorTotal)) {
            valorTotalInput.value = valorTotal.toFixed(2);
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



});
