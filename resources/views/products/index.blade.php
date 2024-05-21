<x-layout title="Produtos - Relatório">
    <form action="{{route('products.index')}}" method="GET">
        <div class='row'>
            <div class="col-md-4">
                <label for="ProductName" class="form-label">Nome do Produto</label>
                <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Digite para filtrar...">
            </div>
            <div class="col-md-4">
                <label for="Supplier" class="form-label">Fornecedor</label>
                <select class="form-control select2" data-live-search="true" name="Supplier" id="Supplier">
                    <option value="">-- Selecione --</option>
                    @foreach ($suppliers as $supplier)
                    <option {{ isset($_GET['Supplier']) && $_GET['Supplier'] == $supplier->id ? 'Selected' : ''}} value="{{$supplier->id}}">{{ $supplier->Name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="ordenacao" class="form-label">Ordenar</label>
                <select class="form-control select2" data-live-search="true" name="ordenacao" id="ordenacao">
                    <option value="">-- Selecione --</option>
                    <option {{ isset($_GET['ordenacao']) && $_GET['ordenacao'] == 'Aging' ? 'Selected' : ''}} value="Aging">Ordenção Aging</option>
                    <option {{ isset($_GET['ordenacao']) && $_GET['ordenacao'] == 'Utilizados' ? 'Selected' : ''}} value="Utilizados">Mais Utilizados</option>
                    <option {{ isset($_GET['ordenacao']) && $_GET['ordenacao'] == 'Criticos' ? 'Selected' : ''}} value="Criticos">Itens Critícos</option>
                </select>
            </div>
        </div>

        <div style='margin-top: 20px;'>
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a type="button" target="_blank" class="btn btn-success" href="{{ $exportCsvUrl }}">Exportar</a>
        </div>
    </form>

    <x-grid :successMessage="$successMessage" :data="$products" rota="products" :nextPage="$nextPage" :previusPage="$previusPage">
    </x-grid>
</x-layout>