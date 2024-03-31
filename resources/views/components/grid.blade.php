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
        @foreach (array_keys((array) $suppliers->first()) as $key)
            <th scope="col">{{$key}}</th>
        @endforeach
        <th scope="col">Ações</th>
    </tr>
</thead>


        @foreach ($suppliers as $supplier)
          <tbody class="table-group-divider table-data">
              <tr>
                  @foreach ($supplier as $value)
                      <td>{{$value}}</td>
                  @endforeach
                  <td>

                      <a class="btn btn-primary btn-sm ms-2" href='{{ route("$rota.edit", $supplier->id) }}'>
                          <i class="fas fa-pencil-alt"></i>
                      </a>
                      <form action='{{ route("$rota.destroy", $supplier->id) }}' method="POST">
                          @csrf
                          @method('DELETE')
                          <input type="hidden" name="delete_id" value="{{ $supplier->id }}">
                          <button class="btn btn-danger btn-sm ms-2">
                              <i class="fas fa-trash-alt"></i>
                          </button>
                      </form>
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