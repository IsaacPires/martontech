<x-layout title="Detalhes Requisição">
    

    <x-grid :requestButton='true' :data="$requests" rota="pending" :nextPage="$nextPage" :previusPage="$previusPage">
    </x-grid>

    <a type="submit" href='{{route("order.index")}}' class="btn btn-secondary">Voltar</a>

</x-layout>