<x-layout title="Produtos - Relatório">
    <form action="{{route('order.index')}}" method="GET">
        <div class='row'>
            <div class="col-md-4">
                <label for="ProductName" class="form-label">Nome do Produto</label>
                <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Digite para filtrar...">
            </div>
        </div>

        <div style='margin-top: 20px;'>
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a type="button" target="_blank" class="btn btn-success" href="{{ $exportCsvUrl }}">Exportar</a>
        </div>
    </form>

    <x-grid :successMessage="$successMessage" :data="$orders" rota="products" :nextPage="$nextPage" :previusPage="$previusPage">
    </x-grid>
</x-layout>