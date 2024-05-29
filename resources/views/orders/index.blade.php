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
                    <option value="AP">Aprovado</option>

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