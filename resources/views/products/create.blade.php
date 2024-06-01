<x-layout title="Produtos - Adicionar">

    <div class='row'>
        <div class='col-md-8'>
        <h3> Instruções: </h3>
            <p style='color:blue;'>Matéria prima e insumos:</p>
            <p>(Produto) + (Tipo) + (Material) + (Dimensões D x C ou A x C)</p>
            <p>Ex: Parafuso Allen cilíndrico ZP M4x15 mm</p>

            <p style='color:purple;'>Ferramentas:</p>
            <p>F- + (Nome Ferramenta) + (Modelo) + (Dimensões)</p>
            <p>Ex: F- MINI ESMIRILHADEIRA BOSCH 900W GWS 9-125S 060139</p>

            <p style='text-decoration: underline;'>Sempre informar unidade de medida usado para cada item em específico. Exemplos abaixo:</p>

            <span style='color:red'>mm</span> = Milímetros para medição de tamanhos <br>
            <span style='color:red'>ml</span> = Mililitros para medição de volume<br>
            <span style='color:red'>L</span> = Litros para medição de volumes maiores, latões de tintas e etc.<br>
            <span style='color:red'>Ø</span> = Diâmetro para identificação de barras e etc.  
        </div>
    </div>
    <hr>
    <form action="{{route('products.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="Name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="Name" maxlength='128' name="Name" minlength="5" required>
            </div>
            <div class="col-md-4">
                <label for="AlertQuantity" class="form-label">Quantidade de Alerta</label>
                <input type="text" class="form-control" maxlength="11" id="AlertQuantity" name="AlertQuantity" required>
            </div>
            {{-- <div class="col-md-4">
                <label for="StockQuantity" class="form-label">Quatidade em Estoque</label>
                <input type="number" class="form-control" maxlength="11" id="StockQuantity" name="StockQuantity" required step="1">
            </div> --}}
            <div class="col-md-4">
                <label for="primary_suppliers_id" class="form-label">Fornecedor 1</label>
                <select class="form-control select2" name="primary_suppliers_id" id="primary_suppliers_id">
                    <option value="">-- Selecione --</option>
                    @foreach ($suppliers as $supplier)
                    <option value="{{$supplier->id}}">{{ $supplier->Name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="secondary_supplier_id" class="form-label">Fornecedor 2</label>
                <select class="form-control select2" name="secondary_supplier_id" id="secondary_supplier_id">
                    <option value="">-- Selecione --</option>
                    @foreach ($suppliers as $supplier)
                    <option value="{{$supplier->id}}">{{ $supplier->Name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Adicionar o item</button>
    </form>
</x-layout>
<script src="{{ asset('js/products/script.js') }}"></script>