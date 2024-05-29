<x-layout title="Requisição de comprar">
    <form action="{{route('request.store')}}" method="POST">
        @csrf
        <div class="row">

            @isset($successMessage)
                <div class="alert alert-success">
                    {{$successMessage}}
                </div>
            @endisset

            <div  style="{{$SupRequests ? 'pointer-events: none; opacity: 1;' : '' }}"  class='col-md-4'>
                <label for="suppliers_id" class="form-label">Fornecedor</label>
                <select style="pointer-events: none; opacity: 1;" class="form-control select2" name="suppliers_id" id="suppliers_id" required>
                    <option value="">-- Selecione --</option>
                    @foreach ($suppliers as $supplier)
                    <option {{$SupRequests == $supplier->id ? 'selected' : '' }} value="{{$supplier->id}}">{{ $supplier->Name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="product_id" class="form-label">Produto</label>
                <select class="form-control select2" name="product_id" id="product_id" required>
                    <option value="">-- Selecione --</option>
                    @foreach ($products as $product)
                        <option value="{{$product->id}}">{{ $product->Name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="brand" class="form-label">Marca</label>
                <input type="text" class="form-control" id="brand" name="brand" required>
            </div>
            <div class="col-md-4">
                <label for="lastPrice" class="form-label">Último preço</label>
                <input type="float" class="form-control" id="lastPrice" name="lastPrice" required>
            </div>
             <div class="col-md-4">
                <label for="currentPrice" class="form-label">Preço Atual</label>
                <input type="float" class="form-control" id="currentPrice" name="currentPrice" required>
            </div>
            <div class="col-md-4">
                <label for="quantity" class="form-label">Quantidade</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
            <div class="col-md-4">
                <label for="totalValue" class="form-label">Valor Total</label>
                <input  readonly type="float" class="form-control" id="totalValue" name="totalValue">
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Adicionar o pedido</button>
    </form>
    @if(!empty($orders) && !empty($requests))

        <hr>

        <div>
            <h4>Resumo da requisição atual:</h4>
            <table>
                <tr>
                    <th>Produto<th>         
                    <th>Último Preço<th>
                    <th>Preço unitario Atual<th>
                    <th>Quantidade<th>
                    <th>Valor Total<th>
                    <th>Ação<th>

                <tr>
                @foreach ($requests as $request )
                    <tr>
                        <td>{{$request->product->Name}}<td>
                        <td>R${{number_format($request->lastPrice, 2, ',', '.')}}<td>
                        <td>R${{number_format($request->currentPrice, 2, ',', '.')}}<td>
                        <td>{{$request->quantity}}<td>
                        <td>R${{number_format($request->totalValue, 2, ',', '.')}}<td>
                        <td> 
                            <form action='{{ route("request.destroy", $request->id) }}' method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="delete_id" value="{{ $request->id }}">
                                <button class="btn btn-danger btn-sm ms-2">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        <td>
                    <tr>
                @endforeach
                <tr>
                    <td><strong>Preço Total<strong></td>
                    <td><strong>R${{number_format($orders->totalValue, 2, ',', '.')}}<strong></td>
                </tr>
            </table>
            <form action="{{ route('order.update', ['order' => $orders->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-success">Concluir Pedido</button>
            </form>        
        </div>
    @endif

</x-layout>
<script src={{asset('/js/request/script.js')}}></script>
