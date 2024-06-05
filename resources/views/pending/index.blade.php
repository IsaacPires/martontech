<x-layout title="Pedidos de compras Pendentes">
    <form action="{{route('pending.index')}}" method="GET">
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
                <label for="ids" class="form-label">ID</label>
                <input type="text" class="form-control" id="ids" name="ids" placeholder="Digite para filtrar...">
            </div>
        </div>

        <div style='margin-top: 20px;'>
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a type="button" target="_blank" class="btn btn-success" href="{{ $exportCsvUrl }}">Exportar</a>
        </div>
    </form>

    <x-grid :successMessage="$successMessage" :pending='true' :data="$orders" rota="pending" :nextPage="$nextPage" :previusPage="$previusPage">
    </x-grid>
</x-layout>