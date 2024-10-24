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
                <label for="output_date" class="form-label">Data de saída</label>
                <input type="date" class="form-control" id="output_date" name="output_date" value="{{$maintenance->output_date ? date('Y-m-d', strtotime($maintenance->output_date)) : ''}}" required>
            </div>

            <div class="col-md-4">
                <label for="return_date" class="form-label">Data de retorno</label>
                <input type="date" class="form-control" id="return_date" name="return_date" value="{{$maintenance->return_date ? date('Y-m-d', strtotime($maintenance->return_date)) : ''}}" required>
            </div>

            <div class="col-md-4">
                <label for="value" class="form-label">Valor</label>
                <input type="text" value="{{$maintenance->value}}" class="form-control" id="value" name="value">
            </div>

            <div class="col-md-4">
                <label for="defect" class="form-label">Defeito</label>
                <input type="text" class="form-control" id="defect" maxlength='255' name="defect" value="{{$maintenance->defect}}">
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