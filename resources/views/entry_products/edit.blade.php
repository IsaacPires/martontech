<x-layout title="Entrade de produto - Atualizar">
    <form action='{{ route("entry_products.update", ["entry_product" => $entryProducts->id]) }}' method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <label for="products_id" class="form-label">Produto</label>
                <select class="form-control select2" name="products_id" id="products_id" required>
                    <option value="">-- Selecione --</option>
                    @foreach ($products as $product)
                    <option value="{{$product->id}}" {{ $product->id == $entryProducts->products_id ? 'selected' : '' }}>
                        {{ $product->Name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="SellerName" class="form-label">Colaborador</label>
                <input type="text" class="form-control" id="SellerName" name="SellerName" value='{{ $entryProducts->SellerName }}' required>
            </div>
            <div class="col-md-4">
                <label for="UnitPrice" class="form-label">Preço por unidade</label>
                <input type="text" class="form-control" id="UnitPrice" name="UnitPrice" value='{{ $entryProducts->UnitPrice }}' required>
            </div>
            <div class="col-md-4">
                <label for="WithdrawalAmount" class="form-label">Quantidade de entrada</label>
                <input type="text" class="form-control" id="WithdrawalAmount" name="WithdrawalAmount" value='{{ $entryProducts->WithdrawalAmount }}' required>
            </div>
            <div class="col-md-4">
                <label for="TotalPrice" class="form-label">Preço final</label>
                <input type="text" class="form-control" id="TotalPrice" name="TotalPrice" value='{{ $entryProducts->TotalPrice }}' readonly required>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</x-layout>
<script src="{{ asset('js/entry_products/script.js') }}"></script>