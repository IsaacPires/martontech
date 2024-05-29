<x-layout title="Entrada de produtos - Adicionar">
    <form action="{{route('entry_products.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="products_id" class="form-label">Produto</label>
                <select class="form-control select2" name="products_id" id="products_id" required>
                    <option value="">-- Selecione --</option>
                    @foreach ($products as $product)
                    <option value="{{$product->id}}">{{ $product->Name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="SellerName" class="form-label">Colaborador</label>
                <input type="text" class="form-control" id="SellerName" name="SellerName" required>
            </div>
            <div class="col-md-4">
                <label for="UnitPrice" class="form-label">Preço por unidade</label>
                <input type="text" class="form-control" id="UnitPrice" name="UnitPrice" required>
            </div>
            <div class="col-md-4">
                <label for="WithdrawalAmount" class="form-label">Quatidade de entrada</label>
                <input type="text" class="form-control" id="WithdrawalAmount" name="WithdrawalAmount" required>
            </div>
            <div class="col-md-4">
                <label for="TotalPrice" class="form-label">Preço final</label>
                <input type="text" class="form-control" id="TotalPrice" name="TotalPrice" readonly required>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Adicionar o item</button>
    </form>
</x-layout>
<script src="{{ asset('js/sale_products/script.js') }}"></script>