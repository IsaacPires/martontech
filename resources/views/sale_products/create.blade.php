<x-layout title="Retiradas - registrar">
    <form action="{{route('sale_products.store')}}" method="POST">
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
                <label for="FabricationType" class="form-label">Tipo de Fabricação</label>
                <select class="form-control select2" name="FabricationType" id="FabricationType" required>
                    <option value="" selected>-- Selecione --</option>
                    <option value="Telescópica">Telescópica</option>
                    <option value="Sanfonada">Sanfonada</option>
                    <option value="Transportador de Cavaco">Transportador de Cavaco</option>
                    <option value="Esteira">Esteira</option>
                    <option value="Rolo cortina">Rolo cortina</option>
                    <option value="Outros">Outros</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="TypeProduction" class="form-label">Tipo de produto</label>
                <select class="form-control select2" id="TypeProduction" name="TypeProduction" required>
                    <option value="" selected>-- Selecione --</option>
                    <option value="Produto Novo">Produto Novo</option>
                    <option value="Reforma">Reforma</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="FabricationOrder" class="form-label">Ordem de Fabricação</label>
                <input type="text" class="form-control" id="FabricationOrder" name="FabricationOrder" required>
            </div>
            <div class="col-md-4">
                <label for="UnitPrice" class="form-label">Preço por unidade</label>
                <input type="text" class="form-control" id="UnitPrice" name="UnitPrice" required>
            </div>
            <div class="col-md-4">
                <label for="WithdrawalAmount" class="form-label">Quantidade de retirada</label>
                <input type="text" class="form-control" id="WithdrawalAmount" name="WithdrawalAmount" required>
            </div>
            <div class="col-md-4">
                <label for="TotalPrice" class="form-label">Preço final</label>
                <input type="text" class="form-control" id="TotalPrice" name="TotalPrice" readonly required>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>

</x-layout>
<script src="{{ asset('js/sale_products/script.js') }}"></script>