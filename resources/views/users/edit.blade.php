<x-layout title='Editar Usuários'>
    <form action='{{route("users.update", ["user" => $user->id])}}' method="POST">
        @csrf
        @method('PUT')        
        <div class='row'>
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="name" value={{$user->name}} required>
            </div>
            <div class="col-md-6">
                <label for="cargo" class="form-label">Cargo</label>
                <input type="text" class="form-control" id="cargo" name="position" value={{$user->position}} required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value={{$user->email}} required>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password" value={{$user->password}}  required>
            </div>
            <div class="mb-3">
                <label for="permission" class="form-label">Permissão</label>
                <select class="form-select" id="permission" name="permission" required>
                    <option {{$user->permission == 'adm' ? 'selected' : ''}} value="adm">Admin</option>
                    <option  {{$user->permission == 'col' ? 'selected' : ''}} value="col">Colaborador</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <a type="submit" href={{route("users.index")}} class="btn btn-secondary">Voltar</a>

    </form>

</x-layout>