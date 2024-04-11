<x-layout title="Produtos - Atualizar">
    <form action='{{route("products.update", ["product" => $products->id])}}' method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <label for="Name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="Name" name="Name" value='{{$products->Name}}' minlength="5" required>
            </div>
            <div class="col-md-4">
                <label for="AlertQuantity" class="form-label">Quantidade em Alerta</label>
                <input type="number" class="form-control" id="AlertQuantity" name="AlertQuantity" value='{{$products->AlertQuantity}}' required>
            </div>
            <div class="col-md-4">
                <label for="StockQuantity" class="form-label">Quatidade em Estoque</label>
                <input type="number" class="form-control" id="StockQuantity" name="StockQuantity" value='{{$products->StockQuantity}}' required>
            </div>
            <div class="col-md-4">
                <label for="suppliers_id" class="form-label">Fornecedor</label>
                <select class="form-control" name="suppliers_id" id="suppliers_id">
                    @foreach ($suppliers as $supplier)
                    <option value="{{$supplier->id}}" {{ $supplier->id == $products->suppliers_id ? 'selected' : '' }}>{{ $supplier->Name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a type="submit" href='{{route("products.index")}}' class="btn btn-secondary">Voltar</a>
    </form>

</x-layout>