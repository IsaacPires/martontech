<x-layout title="Saídas - Relatório">
    <form action="{{route('sale_products.index')}}" method="GET">
        <div class='row'>
            <div class="col-md-4">
                <label for="SellerName" class="form-label">Colaborador</label>
                <input value="{{isset($_GET['SellerName']) && !empty($_GET['SellerName']) ? $_GET["SellerName"] : '' }}" type="text" class="form-control" id="SellerName" name="SellerName" placeholder="Digite para filtrar...">
            </div>
            <div class="col-md-4">
                <label for="fabricationOrder" class="form-label">Ordem de Fabricação</label>
                <input value="{{isset($_GET['fabricationOrder']) && !empty($_GET['fabricationOrder']) ? $_GET["fabricationOrder"] : '' }}" type="text" class="form-control" id="fabricationOrder" name="fabricationOrder" placeholder="Digite para filtrar...">
            </div>

            <div class="col-md-4">
                <label for="FabricationType" class="form-label">Tipo de Fabricação</label>
                <select class="form-control select2" name="FabricationType" id="FabricationType" >
                    <option value="" selected>-- Selecione --</option>
                    <option {{isset($_GET['FabricationType']) && $_GET['FabricationType']== 'Telescópica' ? 'SELECTED' : '' }} value="Telescópica">Telescópica</option>
                    <option {{isset($_GET['FabricationType']) && $_GET['FabricationType'] == 'Sanfonada' ? 'SELECTED' : '' }} value="Sanfonada">Sanfonada</option>
                    <option {{isset($_GET['FabricationType']) && $_GET['FabricationType'] == 'Transportador de Cavaco' ? 'SELECTED' : '' }} value="Transportador de Cavaco">Transportador de Cavaco</option>
                    <option {{isset($_GET['FabricationType']) && $_GET['FabricationType'] == 'Esteira' ? 'SELECTED' : '' }} value="Esteira">Esteira</option>
                    <option {{isset($_GET['FabricationType']) && $_GET['FabricationType'] == 'Rolo cortina' ? 'SELECTED' : '' }} value="Rolo cortina">Rolo cortina</option>
                    <option {{isset($_GET['FabricationType']) && $_GET['FabricationType'] == 'Outros' ? 'SELECTED' : '' }} value="Outros">Outros</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="TypeProduction" class="form-label">Tipo de produto</label>
                <select class="form-control select2" id="TypeProduction" name="TypeProduction" >
                    <option value="" selected>-- Selecione --</option>
                    <option {{isset($_GET['FabricationType']) && $_GET['TypeProduction'] == 'Produto Novo' ? 'SELECTED' : '' }} value="Produto Novo">Produto Novo</option>
                    <option {{isset($_GET['FabricationType']) && $_GET['TypeProduction'] == 'Reforma' ? 'SELECTED' : '' }} value="Reforma">Reforma</option>
                </select>
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

    <x-grid :successMessage="$successMessage" :data="$saleProducts" rota="sale_products" :nextPage="$nextPage" :previusPage="$previusPage">
    </x-grid>
</x-layout>