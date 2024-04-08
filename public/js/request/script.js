document.addEventListener("DOMContentLoaded", function() {
    
    const precoAtualInput = document.getElementById("currentPrice");
    const quantidadeInput = document.getElementById("quantity");
    const valorTotalInput = document.getElementById("totalValue");

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
});