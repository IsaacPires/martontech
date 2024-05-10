<x-layout title="Dashboard">

    <div class="container">
        <div class='row'>
             <div class="col-md-12">
              <div class="card">
                  <div class="card-body">
                      <h4 class="card-title">
                        <i class="fas fa-money-bill-wave"></i>
                        <b>Total de Compras do mês</b>
                      </h4>
                      <h5><i>R$ {{$totalValue}}</i></h5>
                  </div>
              </div>
            </div>
        </div>
        <div class="row mt-5">

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                          <i class="fas fa-exclamation-circle"></i>
                          <b>Itens Critícos</b>
                        </h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ( $alertItens as $alertItem )
                                    <tr>
                                        <td>{{$alertItem->Name}}</td>
                                        <td>{{$alertItem->StockQuantity}}</td>                               
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @if(empty($alertItens))
                            Nenhum produto em alerta.
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                          <i class="fas fa-box"></i>
                          <b> Mais Utilizados deste mês</b>
                        </h4>
                          <table class="table">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Valor</th>
                                    <th>Quantidade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $mostUseds as $mostUsed )
                                    <tr>
                                        <td>{{$mostUsed->Name}}</td>
                                        <td>R$ {{number_format($mostUsed->total_value, 2, ',', '.') }}</td>                               
                                        <td>{{$mostUsed->total_quantity}}</td>                               
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                  <i class="fas fa-times-circle"></i>
                  <b>Produtos em Aging</b>
                        </h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>última Venda</th>
                                    <th>Quantidade</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <tbody>
                                @foreach ( $agings as $aging )
                                    <tr>
                                        <td>{{$aging->Name}}</td>
                                        <td>{{!empty($aging->last_sold) ? $aging->last_sold : 'N/I' }}</td>                               
                                        <td>{{$aging->StockQuantity}}</td>                               
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</x-layout>