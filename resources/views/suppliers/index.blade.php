<x-layout title="Fornecedores - Relatório">

    <!-- Filtro -->
    <form action="{{route('suppliers.index')}}" method="GET">
        <div class='row'>
            <div class="col-md-4">
                <label for="SocialReason" class="form-label">Razão Social:</label>
                <input type="text" class="form-control" id="SocialReason" name="SocialReason" placeholder="Digite para filtrar...">
            </div>

            <div class="col-md-4">
                <label for="Segments" class="form-label">Segmento:</label>
                <input type="text" class="form-control" id="Segments" name="Segments" placeholder="Digite para filtrar...">
            </div>
            <div class="col-md-3">
                <label for="CNPJ" class="form-label">CNPJ:</label>
                <input type="text" class="form-control" id="CNPJ" name="CNPJ" placeholder="Digite para filtrar...">
            </div>
            <div class="col-md-4">
                <label for="Name" class="form-label">Nome contato:</label>
                <input type="text" class="form-control" id="Name" name="Name" placeholder="Digite para filtrar...">
            </div>
        </div>

        <div style='margin-top: 20px;'>
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a type="button" target="_blank" class="btn btn-success"  href="{{ $exportCsvUrl }}">Exportar</a>
        </div>
    </form>

    <x-grid :successMessage="$successMessage" :suppliers="$suppliers" rota="suppliers" :nextPage="$nextPage" :previusPage="$previusPage">
    </x-grid>

</x-layout>

<script src="{{ asset('js/suppliers/index.js') }}"></script>