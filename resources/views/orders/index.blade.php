<x-layout title="Pedidos de compra - Relatório">
    <form action="{{route('order.index')}}" method="GET">
        <div class='row'>
            <div class="col-md-4">
               <label for="status" class="form-label">Status</label>
                <select class="form-control" data-live-search="true" name="status" id="status">
                    <option value="">-- Selecione --</option>
                    <option value="E">Enviado</option>
                    <option value="A">Aberto</option>
                    <option value="N">Negada</option>
                    <option value="AC">Compra aprovada</option>
                    <option value="AP">Compra aprovada e recebida</option>
                </select>
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
                <label for="ids" class="form-label">ID</label>
                <input value = "{{isset($_GET['ids']) && !empty($_GET['ids']) ? $_GET['ids'] : '' }}" type="text" class="form-control" id="ids" name="ids" placeholder="Digite para filtrar...">
            </div>

            <div class="col-md-4">
                <label for="limiter" class="form-label">Retorno por página</label>
                <select class="form-control" id="limiter" name="limiter" >
                    <option value="" selected>-- Selecione --</option>
                    <option {{isset($_GET['limiter']) && $_GET['limiter'] == 25  ? 'SELECTED' : '' }} value="25">25</option>
                    <option {{isset($_GET['limiter']) && $_GET['limiter'] == 50  ? 'SELECTED' : '' }} value="50">50</option>
                    <option {{isset($_GET['limiter']) && $_GET['limiter'] == 75  ? 'SELECTED' : '' }} value="75">75</option>
                    <option {{isset($_GET['limiter']) && $_GET['limiter'] == 100 ? 'SELECTED' : '' }} value="100">100</option>
                </select>
            </div>
        </div>

        <div style='margin-top: 20px;'>
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a type="button" target="_blank" class="btn btn-success" href="{{ $exportCsvUrl }}">Exportar</a>
        </div>
    </form>

    <x-grid :showList='true' :successMessage="$successMessage" :data="$orders" rota="order" :nextPage="$nextPage" :previusPage="$previusPage">
    </x-grid>
</x-layout>