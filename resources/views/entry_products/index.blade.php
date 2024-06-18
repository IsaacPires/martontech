<x-layout title="Entrada de produtos - Relatório">
    <form action="{{route('entry_products.index')}}" method="GET">
        <div class='row'>
            <div class="col-md-4">
                <label for="SellerName" class="form-label">Colaborador</label>
                <input value="{{isset($_GET['SellerName']) && !empty($_GET['SellerName']) ? $_GET['SellerName'] : ''}}" type="text" class="form-control" id="SellerName" name="SellerName" placeholder="Digite para filtrar...">
            </div>
            <div class="col-md-4">
                <label for="product" class="form-label">Produtos</label>
                <select class="form-control select2" data-live-search="true" name="product" id="product">
                    <option value="">-- Selecione --</option>
                    @foreach ($products as $product)
                    <option {{ isset($_GET['product']) && $_GET['product'] == $product->id ? 'Selected' : ''}} value="{{$product->id}}">{{ $product->Name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="supplier" class="form-label">Fornecedores</label>
                <select class="form-control select2" data-live-search="true" name="supplier" id="supplier">
                    <option value="">-- Selecione --</option>
                    @foreach ($suppliers as $supplier)
                    <option {{ isset($_GET['supplier']) && $_GET['supplier'] == $supplier->id ? 'Selected' : ''}} value="{{$supplier->id}}">{{ $supplier->Name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div style='margin-top: 20px;'>
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a type="button" target="_blank" class="btn btn-success" href="{{ $exportCsvUrl }}">Exportar</a>
        </div>
    </form>

    <x-grid :successMessage="$successMessage" :data="$entryProducts" rota="entry_products" :nextPage="$nextPage" :previusPage="$previusPage">
    </x-grid>
</x-layout>