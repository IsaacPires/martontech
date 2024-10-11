<x-layout title="Mudança de responsável de ferramenta">
    <form action="{{ route('tools.save') }}" method="POST">
    @isset($msg)
        <div class="alert alert-success">
            {{$msg}}
        </div>
        @endisset
      @csrf
      <div class='row'>
        <div class="col-md-6">
            <label for="responsavel_old" class="form-label">Responsável atual</label>
            <select class="form-select" id="responsavel_old" name="responsavel_old" required>
            <option value="">-- Selecione --</option>
                @foreach($tools as $tool)
                    <option value="{{$tool->Owner}}">{{$tool->Owner}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="responsavel_new" class="form-label">Novo Responsável</label>
            <input type="text" class="form-control" id="responsavel_new" name="responsavel_new" required>
        </div>
      </div>
      
      </br>

      <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>    
</x-layout>