<x-layout title="Fornecedores - Relatório">

    <!-- Filtro -->
    <form action="{{route('suppliers.index')}}" method="GET">
        <div class='row'>
            <div class="col-md-4">
                <label for="SocialReason" class="form-label">Razão Social:</label>
                <input type="text" class="form-control" id="SocialReason" name="SocialReason" placeholder="Digite para filtrar...">
            </div>

            <div class="col-md-4">
                <label for="Segments" class="form-label">Segmento:</label>
                <input type="text" class="form-control" id="Segments" name="Segments" placeholder="Digite para filtrar...">
            </div>
            <div class="col-md-3">
                <label for="CNPJ" class="form-label">CNPJ:</label>
                <input type="text" class="form-control" id="CNPJ" name="CNPJ" placeholder="Digite para filtrar...">
            </div>
            <div class="col-md-4">
                <label for="Name" class="form-label">Nome contato:</label>
                <input type="text" class="form-control" id="Name" name="Name" placeholder="Digite para filtrar...">
            </div>
        </div>

        <div style='margin-top: 20px;'>
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <button type="button" class="btn btn-success">Exportar</button>
        </div>
    </form>

    <hr>

    <div class="table-responsive" style="overflow-x: auto;">



        <table class="table">
            @isset($successMessage)
            <div class="alert alert-success">
                {{$successMessage}}
            </div>
            @endisset
            <thead>
                <tr class="text-nowrap">
                    <th scope="col">Razão Social</style=>
                    <th scope="col">Segmentos</th>
                    <th scope="col">CNPJ</th>
                    <th scope="col">Rua</th>
                    <th scope="col">Número</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Estado</th>
                    <th scope="col">CEP</th>
                    <th scope="col">Nome Cont.</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody class="table-group-divider table-data">
                @foreach ($suppliers as $supplier)
                <tr>
                    <td>{{$supplier->Name}}</td>
                    <td>{{$supplier->Segments}}</td>
                    <td>{{$supplier->Cnpj}}</td>
                    <td>{{$supplier->AddressStreet}}</td>
                    <td>{{$supplier->AddressNumber}}</td>
                    <td>{{$supplier->AddressNeighborhood}}</td>
                    <td>{{$supplier->AddressCity}}</td>
                    <td>{{$supplier->AddressState}}</td>
                    <td>{{$supplier->AddressZipCode}}</td>
                    <td>{{$supplier->ContactNameOne}}</td>
                    <td>{{$supplier->ContactPhoneOne}}</td>
                    <td>{{$supplier->ContactEmailOne}}</td>
                    <td>
                        <a class="btn btn-primary btn-sm ms-2" href="{{ route('suppliers.edit', $supplier->id) }}">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">
                            <button class="btn btn-danger btn-sm ms-2">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <div class="ms-2">

        <nav style='margin:20px 0 0 0 ;'>
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" {{ !$previusPage ? 'hidden' : '' }} href="{{ $previusPage }}" tabindex="-1" aria-disabled="true">
                        <i class="fas fa-caret-left"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" {{ !$nextPage ? 'hidden' : '' }} href="{{ $nextPage }}">
                        <i class="fas fa-caret-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</x-layout>

<script src="{{ asset('js/suppliers/index.js') }}"></script>