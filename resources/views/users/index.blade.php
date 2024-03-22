<x-layout title="Usuários - Relatório">

    <!-- Filtro -->
    <form action="{{route('users.index')}}" method="GET">
        <div class='row'>
            <div class="col-md-4">
                <label for="Name" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="Name" name="Name" placeholder="Digite para filtrar...">
            </div>

            <div class="col-md-4">
                <label for="Email" class="form-label">Email:</label>
                <input type="text" class="form-control" id="Email" name="Email" placeholder="Digite para filtrar...">
            </div>
            <div class="col-md-3">
                <label for="Permission" class="form-label">Permissão:</label>
                <input type="text" class="form-control" id="Permission" name="Permission" placeholder="Digite para filtrar...">
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
                    <th scope="col">Nome</style=>
                    <th scope="col">E-mail</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Permissão</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody class="table-group-divider table-data">
                @foreach ($users as $user)
                <tr>
                    <td>{{$user['name']}}</td>
                    <td>{{$user['email']}}</td>
                    <td>{{$user['position']}}</td>
                    <td>
                    @switch($user['permission'])
                        @case('col')
                            Colaborador
                            @break

                        @case('adm')
                            Administrador
                            @break

                        @default
                            N/I
                    @endswitch
                    </td>

                    <td>
                        <a class="btn btn-primary btn-sm ms-2" href="{{ route('users.edit', $user->id) }}">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="users_id" value="{{ $user->id }}">
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

<script src="{{ asset('js/users/index.js') }}"></script>