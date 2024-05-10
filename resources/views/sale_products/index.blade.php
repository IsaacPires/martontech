<x-layout title="Retiradas - Relatório">
    <form action="{{route('sale_products.index')}}" method="GET">
        <div class='row'>
            <div class="col-md-4">
                <label for="SellerName" class="form-label">Colaborador</label>
                <input type="text" class="form-control" id="SellerName" name="SellerName" placeholder="Digite para filtrar...">
            </div>
        </div>

        <div style='margin-top: 20px;'>
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a type="button" target="_blank" class="btn btn-success" href="{{ $exportCsvUrl }}">Exportar</a>
        </div>
    </form>

    <x-grid :successMessage="$successMessage" :data="$saleProducts" rota="sale_products" :nextPage="$nextPage" :previusPage="$previusPage">
    </x-grid>
</x-layout>