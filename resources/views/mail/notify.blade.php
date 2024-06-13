@component('mail::message')
  Nova requisição de compra solicitada.
  Acesse o sistema para realizar a aprovação.
  @component('mail::button', ['url' => route('pending.index') ])
    Acessar
  @endcomponent
@endcomponent