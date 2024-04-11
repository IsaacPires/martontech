<x-layout title="Notas Fiscais - Relatório">
    <form action="{{route('invoices.index')}}" method="GET">
        <div class='row'>
            <div class="col-md-4">
                <label for="Client" class="form-label">Cliente</label>
                <input type="text" class="form-control" id="Client" name="Client" placeholder="Digite para filtrar...">
            </div>
        </div>

        <div style='margin-top: 20px;'>
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a type="button" target="_blank" class="btn btn-success" href="{{ $exportCsvUrl }}">Exportar</a>
        </div>
    </form>

    <x-grid :successMessage="$successMessage" :data="$invoices" rota="invoices" :nextPage="$nextPage" :previusPage="$previusPage">
    </x-grid>
</x-layout>