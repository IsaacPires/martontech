<x-layout title="Fornecedores - Relatório">

    <!-- Filtro -->
    <form action="{{route('suppliers.index')}}" method="GET">
        <div class='row'>
            <div class="col-md-4">
                <label for="SocialReason" class="form-label">Nome Fornecedor:</label>
                <input value="{{isset($_GET['SocialReason']) && !empty($_GET['SocialReason']) ? $_GET['SocialReason'] : ''}}" type="text" class="form-control" id="SocialReason" name="SocialReason" placeholder="Digite para filtrar...">
            </div>

            <div class="col-md-4">
                <label for="Segments" class="form-label">Segmento:</label>
                <input value="{{isset($_GET['Segments']) && !empty($_GET['Segments']) ? $_GET['Segments'] : ''}}" type="text" class="form-control" id="Segments" name="Segments" placeholder="Digite para filtrar...">
            </div>
            <div class="col-md-3">
                <label for="CNPJ" class="form-label">CNPJ:</label>
                <input value="{{isset($_GET['CNPJ']) && !empty($_GET['CNPJ']) ? $_GET['CNPJ'] : ''}}" type="text" class="form-control" id="CNPJ" name="CNPJ" placeholder="Digite para filtrar...">
            </div>
            <div class="col-md-4">
                <label for="Name" class="form-label">Nome contato:</label>
                <input value="{{isset($_GET['Name']) && !empty($_GET['Name']) ? $_GET['Name'] : ''}}" type="text" class="form-control" id="Name" name="Name" placeholder="Digite para filtrar...">
            </div>
            <div class="col-md-4">
                <label for="Name" class="form-label">Ordenação por fornecedores:</label>
                <select class="form-control" data-live-search="true" name="ordenacao" id="ordenacao">
                    <option value="">-- Selecione --</option>
                    <option {{isset($_GET['ordenacao']) && $_GET['ordenacao'] == 'asc' ? 'selected' : ''}} value="asc">Ascendente</option>
                    <option {{isset($_GET['ordenacao']) && $_GET['ordenacao'] == 'desc' ? 'selected' : ''}} value="desc">Decrescente</option>

                </select>

            </div>
        </div>

        <div style='margin-top: 20px;'>
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a type="button" target="_blank" class="btn btn-success" href="{{ $exportCsvUrl }}">Exportar</a>
        </div>
    </form>

    <x-grid :successMessage="$successMessage" :data="$suppliers" :suppliers="$suppliers" rota="suppliers" :nextPage="$nextPage" :previusPage="$previusPage">
    </x-grid>

</x-layout>

<script src="{{ asset('js/suppliers/index.js') }}"></script>