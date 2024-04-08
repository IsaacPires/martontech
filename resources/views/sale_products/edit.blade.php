<x-layout title="Vendas - Adicionar">
    <form action='{{route("sale_products.update", ["sale_product" => $saleProducts->id])}}' method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <label for="products_id" class="form-label">Produto</label>
                <select class="form-control" name="products_id" id="products_id">
                    @foreach ($products as $product)
                    <option value="{{$product->id}}" {{ $product->id == $saleProducts->products_id ? 'selected' : '' }}>{{ $product->Name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="SellerName" class="form-label">Vendedor</label>
                <input type="text" class="form-control" id="SellerName" name="SellerName" value='{{$saleProducts->SellerName}}' required>
            </div>
            <div class="col-md-4">
                <label for="FabricationOrder" class="form-label">Tipo de pedido</label>
                <input type="text" class="form-control" id="FabricationOrder" name="FabricationOrder" value='{{$saleProducts->FabricationOrder}}' required>
            </div>
            <div class="col-md-4">
                <label for="TypeProduction" class="form-label">Tipo de produção</label>
                <input type="text" class="form-control" id="TypeProduction" name="TypeProduction" value='{{$saleProducts->TypeProduction}}' required>
            </div>
            <div class="col-md-4">
                <label for="UnitPrice" class="form-label">Preço por unidade</label>
                <input type="text" class="form-control" id="UnitPrice" name="UnitPrice" value='{{$saleProducts->UnitPrice}}' required>
            </div>
            <div class="col-md-4">
                <label for="WithdrawalAmount" class="form-label">Quatidade de retirada</label>
                <input type="text" class="form-control" id="WithdrawalAmount" name="WithdrawalAmount" value='{{$saleProducts->WithdrawalAmount}}' required>
            </div>
            <div class="col-md-4">
                <label for="TotalPrice" class="form-label">Preço final</label>
                <input type="text" class="form-control" id="TotalPrice" name="TotalPrice" value='{{$saleProducts->TotalPrice}}' required>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>

</x-layout>