<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <link rel="stylesheet" href={{asset("/css/app.css")}}>
    <link rel="stylesheet" href={{asset("/css/menu/style.css")}}>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

    {{$slot}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src={{asset('/js/menu/script.js')}}></script>
</body>
</html>
