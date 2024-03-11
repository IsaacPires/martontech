<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="{{route('suppliers.create')}}">Adicionar</a>
    <ul>
        @foreach ($suppliers as $supplier)
        <li>
            {{$supplier}}
        </li>
        @endforeach
    </ul>
</body>

</html>