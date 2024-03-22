<x-layout title="Criar Novo Usuário">
    <form action="{{ route('users.store') }}" method="POST">
      @csrf
      <div class='row'>
        <div class="col-md-6">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="name" required>
        </div>
        <div class="col-md-6">
            <label for="cargo" class="form-label">Cargo</label>
            <input type="text" class="form-control" id="cargo" name="position" required>
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="col-md-6">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="permission" class="form-label">Permissão</label>
            <select class="form-select" id="permission" name="permission" required>
                <option value="adm">Admin</option>
                <option value="col">Colaborador</option>
            </select>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Cadastrar</button>
  </form>    
</x-layout>