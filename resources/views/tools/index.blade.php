<x-layout title="Ferramentas - Relatório">
    <form action="{{route('tools.index')}}" method="GET">
        <div class='row'>
            <div class="col-md-4">
                <label for="ProductName" class="form-label">Nome da Ferramenta</label>
                <input value="{{isset($_GET['toolsName']) && !empty($_GET['toolsName']) ? $_GET['toolsName'] : ''}}" type="text" class="form-control" id="toolsName" name="toolsName" placeholder="Digite para filtrar...">
            </div>
            <div class="col-md-4">
                <label for="state" class="form-label">Estado</label>
                <select class="form-control" id="State" name="State" >
                    <option value="" selected>-- Selecione --</option>
                    <option {{isset($_GET['State']) && $_GET['State'] == "Novo"  ? 'SELECTED' : '' }} value="Novo">Novo</option>
                    <option {{isset($_GET['State']) && $_GET['State'] == "Usado"  ? 'SELECTED' : '' }} value="Usado">Usado</option>
                    <option {{isset($_GET['State']) && $_GET['State'] == "Com Defeito"  ? 'SELECTED' : '' }} value="Com Defeito">Com Defeito</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="state" class="form-label">Status</label>
                <select class="form-control" id="Status" name="Status" >
                    <option value="" selected>-- Selecione --</option>
                    <option {{isset($_GET['Status']) && $_GET['Status'] == "Em uso"  ? 'SELECTED' : '' }} value="Em uso">Em uso</option>
                    <option {{isset($_GET['Status']) && $_GET['Status'] == "Obsoleto"  ? 'SELECTED' : '' }} value="Obsoleto">Obsoleto</option>
                    
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

    <x-grid :successMessage="$successMessage" :data="$tools" rota="tools" :nextPage="$nextPage" :previusPage="$previusPage">
    </x-grid>
</x-layout>