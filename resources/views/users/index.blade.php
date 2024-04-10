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

    <x-grid :successMessage="$successMessage" :data="$users" rota="users" :nextPage="$nextPage" :previusPage="$previusPage">
    </x-grid>
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