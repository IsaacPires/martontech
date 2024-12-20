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
                @foreach (array_keys((array) $data->first()) as $key)
                    <th style='white-space: nowrap;' scope="col">{{$key}}</th>
                @endforeach
                @if (!isset($requestButton))
                    <th scope='col'>Ações</th>
                @endif
            </tr>
        </thead>
        @foreach ($data as $d)
        <tbody class="table-group-divider table-data">
            <tr>
                @foreach ($d as $value)
                <td style='white-space: nowrap;' >{{$value}}</td>
                @endforeach
                <td style='white-space: nowrap;' scope="col">

                    @if(!isset($pending))
                        @if(isset($d->Status) && $d->Status == 'Compra aprovada')
                            <a class="btn btn-primary btn-sm ms-2" title='Confirmar entrada no estoque.' href='{{ route("$rota.accept", $d->id) }}'>
                                <i class="fas fa-check"></i>
                            </a>
          
                        @endif

                        @if(isset($tool))
                            <a class="btn btn-primary btn-sm ms-2" href='{{ route("maintenances.create", $d->id) }}'>
                            <i class="fas fa-wrench"></i>
                        @endif

                        @if (!isset($requestButton))
                            <a class="btn btn-primary btn-sm ms-2" href='{{ route("$rota.edit", $d->id) }}'>
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            {{--<form action='{{ route("$rota.destroy", $d->id) }}' method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="delete_id" value="{{ $d->id }}">
                            <button class="btn btn-danger btn-sm ms-2  delete-button" data-id="{{ $d->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            </form> --}}
                            <button class="btn btn-danger delete-button btn-sm ms-2" data-id="{{ $d->id }}"><i class="fas fa-trash-alt"></i></button>
                        @endif

                    @endif
                    @if(isset($showList))
                        <a class="btn btn-primary btn-sm ms-2" href='{{ route("request.index", $d->id) }}'>
                            <i class="fas fa-file-alt"></i>
                        </a>

                        <a class="btn btn-primary btn-sm ms-2" href='{{ route("$rota.pdf", $d->id) }}'>
                            <i class="fas fa-print"></i>
                        </a>
                    @endif
                    @if(isset($pending))

                        <a class="btn btn-primary btn-sm ms-2" href='{{ route("request.index", $d->id) }}'>
                            <i class="fas fa-file-alt"></i>
                        </a>

                        @if($d->Status == 'Enviado')

                            <a class="btn btn-primary btn-sm ms-2" href='{{ route("$rota.accept", $d->id) }}'>
                                <i class="fas fa-check"></i>
                            </a>
                            <a class="btn btn-danger btn-sm ms-2 " href='{{ route("$rota.deny", $d->id) }}'>
                                <i class="fas fa-times "></i>
                            </a>
                        @endif
                    @endif
                </td>
            </tr>
        </tbody>
        @endforeach
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

<div id="deleteModal" class="modal" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content" style='padding: 20px'>
            <p>Esta ação é irreversível. Você tem certeza?</p>
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <input type="hidden" id="deleteId" name="delete_id">
                <button type="submit" class="btn btn-danger ms-2">
                    <i class="fas fa-trash-alt"></i> Excluir
                </button>
                <button type="button" class="btn btn-secondary close ms-2">Cancelar</button>
            </form>
        </div>
    </div>
</div>

<div id="namesModal" class="modal" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="padding: 20px">
            <h5>Produtos da Requisição</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Valor Atual</th>
                        <th>Quantidade</th>
                    </tr>
                </thead>
                <tbody id="namesList">
                    <!-- Dados serão inseridos aqui -->
                </tbody>
            </table>
            <button type="button" class="btn btn-secondary closeNamesModal ms-2">Fechar</button>
        </div>
    </div>
</div>

