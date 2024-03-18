<x-layout title="Fornecedores - Relatório">
    <table class="table">
        @isset($successMessage)
        <div class="alert alert-success">
            {{$successMessage}}
        </div>
        @endisset
        <thead>
            <tr>
                <th scope="col">Nome Fornecedores</th>
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
                <th scope="col">Editar</th>
                <th scope="col">Remover</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
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
                <td><a class="btn btn-primary btn-sm ms-2" href="{{ route('suppliers.edit', $supplier->id) }}">E</a></td>
                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <td>
                        <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">
                        <button class="btn btn-danger btn-sm ms-2">X</button>
                    </td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="ms-2">
        @if ($nextPage)
        <a href="{{ $nextPage }}">Proxima pagina</a>
        @endif
    </div>
    <div>
        @if ($previusPage)
        <a href="{{ $previusPage }}">Página Anterior</a>
        @endif
    </div>
</x-layout>