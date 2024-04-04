<x-layout title="Produtos - Relatório">
    <form action="{{route('products.index')}}" method="GET">
        <div class='row'>
            <div class="col-md-4">
                <label for="ProductName" class="form-label">Nome do Produto</label>
                <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Digite para filtrar...">
            </div>
            <div class="col-md-4">
                <label for="Supplier" class="form-label">Fornecedor</label>
                <input type="text" class="form-control" id="Supplier" name="Supplier" placeholder="Digite para filtrar...">
            </div>
        </div>

        <div style='margin-top: 20px;'>
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
    </form>
</x-layout>