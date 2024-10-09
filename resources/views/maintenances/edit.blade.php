<x-layout title="Ferramenta manutenção - Editar">
<form action='{{ route("maintenances.update", ["maintenance" => $maintenance->id]) }}' method="POST">
@csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <label for="Name" class="form-label">Ferramenta</label>
                <input disabled type="text" class="form-control" id="Name" maxlength='128' value="{{$tool->Name}}" name="Name" minlength="5" required>
            </div>

            <div class="col-md-4">
                <label for="return_date" class="form-label">Data de retorno</label>
                <input type="date" class="form-control" id="return_date" name="return_date" value="{{date('Y-m-d', strtotime($maintenance->return_date))}}" required>
            </div>
            <div class="col-md-4">
                <label for="quantity" class="form-label">Quatidade</label>
                <input type="number" class="form-control" value="{{$maintenance->quantity}}" maxlength="11" id="quantity" name="quantity" required step="1">
            </div>

            <div class="col-md-4">
                <label for="value" class="form-label">Valor</label>
                <input type="text" value="{{$maintenance->value}}" class="form-control" id="value" name="value">
            </div>

            <div class="col-md-4">
                <label for="obs" class="form-label">Observações</label>
                <input type="text" class="form-control" id="obs" maxlength='255' name="obs" value="{{$maintenance->obs}}">
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</x-layout>
<script src="{{ asset('js/maintenance/script.js') }}"></script>