document.addEventListener("DOMContentLoaded", function() {

    const precoAtualInput = document.getElementById("currentPrice");
    const quantidadeInput = document.getElementById("quantity");
    const valorTotalInput = document.getElementById("totalValue");
    
    if(precoAtualInput) {
        precoAtualInput.addEventListener("input", calcularValorTotal);
    }

    if(quantidadeInput) {
        quantidadeInput.addEventListener("input", calcularValorTotal);
    }
    
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
/*     $('#suppliers_id').select2();

    $('#suppliers_id').on('select2:select', function (e) {
        let supplierId = e.params.data.id;
        console.log('Fornecedor selecionado:', supplierId);

        if (supplierId) {
            fetch(`/products-by-supplier/${supplierId}`)
                .then(response => response.json())
                .then(data => {
                    var productsSelect = $('#product_id');
                    productsSelect.empty();
                    data.forEach(product => {
                        productsSelect.append(`<option value="${product.id}">${product.Name}</option>`);
                    });
                    productsSelect.trigger('change'); // Notify Select2 of changes
                })
                .catch(error => console.error('Erro:', error));
        }
    });

 */
    
    $('#product_id').select2();

    $('#product_id').on('select2:select', function (e) {
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
                $('#lastPrice').val(data); // Define o valor do campo UnitPrice com o valor retornado da requisição
            })
            .catch(error => console.error('Erro:', error));
    });

    document.getElementById('currentPrice').addEventListener('input', function (e) {
        // Remove tudo que não é número ou vírgula
        this.value = this.value.replace(/[^0-9,]/g, '');
        
        // Se houver mais de uma vírgula, mantenha apenas a primeira
        if ((this.value.match(/,/g) || []).length > 1) {
            this.value = this.value.split(',').slice(0, 2).join(',').replace(/,/g, (m, offset, string) => offset === string.indexOf(',') ? m : '');
        }
    });

    document.getElementById('lastPrice').addEventListener('input', function (e) {
        // Remove tudo que não é número ou vírgula
        this.value = this.value.replace(/[^0-9,]/g, '');
        
        if ((this.value.match(/,/g) || []).length > 1) {
            this.value = this.value.split(',').slice(0, 2).join(',').replace(/,/g, (m, offset, string) => offset === string.indexOf(',') ? m : '');
        }
    });

});