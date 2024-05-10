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




    document.getElementById('suppliers_id').addEventListener('change', function() {
        let supplierId = this.value;
        
        if (supplierId) {
            fetch(`/products-by-supplier/${supplierId}`)
            .then(response => response.json())
            .then(data => {
                var productsSelect = document.getElementById('product_id');
                productsSelect.innerHTML = '';
                data.forEach(product => {
                    var option = document.createElement('option');
                    option.value = product.id;
                    option.text = product.Name;
                    productsSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Erro:', error));
        }
    });
    
});