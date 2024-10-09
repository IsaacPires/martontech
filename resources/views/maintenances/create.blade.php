<x-layout title="Ferramentas - Manutenção">

    <form action="{{route('maintenances.store')}}" method="POST">
    @csrf
        <div  class="row">
            <div class="col-md-4">
                <label for="Name" class="form-label">Ferramenta</label>
                <input disabled type="text" value="{{$tools->Name}}" class="form-control" id="Name" maxlength='128' name="Name" minlength="5" required>
            </div>

            <div hidden class="col-md-4">
                <input type="text" value="{{$tools->id}}" class="form-control" id="tools_id" maxlength='128' name="tools_id" minlength="5" required>
            </div>


            <div class="col-md-4">
                <label for="value" class="form-label">Valor</label>
                <input type="text" class="form-control" id="value" name="value">
            </div>

            <div class="col-md-4">
                <label for="return_date" class="form-label">Data de retorno</label>
                <input type="date" class="form-control" id="return_date" name="return_date" required>
            </div>

            <div class="col-md-4">
                <label for="quantity" class="form-label">Quatidade</label>
                <input type="number" class="form-control" maxlength="11" id="quantity" name="quantity" required step="1">
            </div>

            <div hidden class="col-md-4">
                <label for="State" class="form-label">Estado da ferramenta</label>
                <select class="form-control select2" name="State" id="State">
                    <option value="">-- Selecione --</option>
                    <option selected value="Com Defeito">Com Defeito</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="defect" class="form-label">Defeito</label>
                <input type="text" class="form-control" id="defect" name="defect" required step="1">
            </div>

            <div class="col-md-4">
                <label for="obs" class="form-label">Observações</label>
                <input type="text" class="form-control" id="obs" maxlength='255' name="obs">
            </div>

        </div>
        <br>
        <button type="submit" class="btn btn-primary">Adicionar o item</button>
    </form>
</x-layout>
<script src="{{ asset('js/maintenance/script.js') }}"></script>