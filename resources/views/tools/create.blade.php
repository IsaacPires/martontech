<x-layout title="Ferramentas - Adicionar">

    <form action="{{route('tools.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="Name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="Name" maxlength='128' name="Name" minlength="5" required>
            </div>
            <div class="col-md-4">
                <label for="Owner" class="form-label">Responsável</label>
                <input type="text" class="form-control" id="Owner" maxlength='128' name="Owner" minlength="5" required>
            </div>
            <div class="col-md-4">
                <label for="Date" class="form-label">Data</label>
                <input type="date" class="form-control" id="Date" name="Date" required>
            </div>
            <div class="col-md-4">
                <label for="Quantity" class="form-label">Quatidade</label>
                <input type="number" class="form-control" maxlength="11" id="Quantity" name="Quantity" required step="1">
            </div>
            <div class="col-md-4">
                <label for="Number" class="form-label">N°</label>
                <input type="number" class="form-control" maxlength="11" id="Number" name="Number" required step="1">
            </div>
            <div class="col-md-4">
                <label for="State" class="form-label">Estado da ferramenta</label>
                <select class="form-control select2" name="State" id="State">
                    <option value="">-- Selecione --</option>
                    <option value="Novo">Novo</option>
                    <option value="Usado">Usado</option>
                    <option value="Com Defeito">Com Defeito</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="Status" class="form-label">Status</label>
                <select class="form-control" name="Status" id="Status">
                    <option value="">-- Selecione --</option>
                    <option value="Em uso">Em uso</option>
                    <option value="Obsoleto">Obsoleto</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="Note" class="form-label">Observações</label>
                <input type="text" class="form-control" id="Note" maxlength='255' name="Note">

            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Adicionar o item</button>
    </form>
</x-layout>
