<x-layout title="Fornecedores - Adicionar">
    <form action="{{route('products.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="Name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="Name" name="Name" required>
            </div>
            <div class="col-md-4">
                <label for="AlertQuantity" class="form-label">Quantidade em Alerta</label>
                <input type="text" class="form-control" id="AlertQuantity" name="AlertQuantity" required>
            </div>
            <div class="col-md-4">
                <label for="StockQuantity" class="form-label">Quatidade em Estoque</label>
                <input type="text" class="form-control" id="StockQuantity" name="StockQuantity" required>
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