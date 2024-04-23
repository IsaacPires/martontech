<x-layout title="Produtos - Adicionar">
    <form action="{{route('products.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="Name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="Name" maxlength='128' name="Name" minlength="5" required>
            </div>
            <div class="col-md-4">
                <label for="AlertQuantity" class="form-label">Quantidade em Alerta</label>
                <input type="number" class="form-control" maxlength="11" id="AlertQuantity" name="AlertQuantity" required>
            </div>
            <div class="col-md-4">
                <label for="StockQuantity" class="form-label">Quatidade em Estoque</label>
                <input type="number" class="form-control" maxlength="11" id="StockQuantity" name="StockQuantity" required step="1">
            </div>
            <div class="col-md-4">
                <label for="suppliers_id" class="form-label">Fornecedor</label>
                <select class="form-control" name="suppliers_id" id="suppliers_id">
                    @foreach ($suppliers as $supplier)
                    <option value="{{$supplier->id}}">{{ $supplier->Name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>

</x-layout>