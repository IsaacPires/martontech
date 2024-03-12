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

<body>

    <div class='dashboard'>
        <div class="dashboard-nav">
            <header>
                <a href="#!" class="menu-toggle">
                    <i class="fas fa-bars" id="menu-toggle-nav"></i>
                </a>
                <a href="#" class="brand-logo">
                    <span>Marton Tech</span>
                </a>
            </header>
            <nav class="dashboard-nav-list">
                <a href="#" class="dashboard-nav-item active">
                    <i class="fas fa-tachometer-alt"></i> dashboard
                </a>

                <div class='dashboard-nav-dropdown'>
                    <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle">
                        <i class="fas fa-truck"></i> Fornecedores
                    </a>
                    <div class='dashboard-nav-dropdown-menu'>
                        <a href="{{route('suppliers.create')}}" class="dashboard-nav-dropdown-item">Adicionar</a>
                        <a href="{{route('suppliers.index')}}" class="dashboard-nav-dropdown-item">Relatório</a>
                    </div>
                </div>
                <div class='dashboard-nav-dropdown'>
                    <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle">
                        <i class="fas fa-archive"></i> Produtos
                    </a>
                    <div class='dashboard-nav-dropdown-menu'>
                        <a href="#" class="dashboard-nav-dropdown-item">All</a>
                        <a href="#" class="dashboard-nav-dropdown-item">Subscribed</a>
                        <a href="#" class="dashboard-nav-dropdown-item">Non-subscribed</a>
                        <a href="#" class="dashboard-nav-dropdown-item">Banned</a>
                        <a href="#" class="dashboard-nav-dropdown-item">New</a>
                    </div>
                </div>
                <div class='dashboard-nav-dropdown'>
                    <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i class="fas fa-money-check-alt"></i> Requisição
                    </a>
                    <div class='dashboard-nav-dropdown-menu'>
                        <a href="#" class="dashboard-nav-dropdown-item">All</a>
                        <a href="#" class="dashboard-nav-dropdown-item">Subscribed</a>
                        <a href="#" class="dashboard-nav-dropdown-item">Non-subscribed</a>
                        <a href="#" class="dashboard-nav-dropdown-item">Banned</a>
                        <a href="#" class="dashboard-nav-dropdown-item">New</a>
                    </div>
                </div>
                <div class='dashboard-nav-dropdown'>
                    <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i <i class="far fa-file-alt"></i> Notas Fiscais
                    </a>
                    <div class='dashboard-nav-dropdown-menu'>
                        <a href="#" class="dashboard-nav-dropdown-item">All</a>
                        <a href="#" class="dashboard-nav-dropdown-item">Subscribed</a>
                        <a href="#" class="dashboard-nav-dropdown-item">Non-subscribed</a>
                        <a href="#" class="dashboard-nav-dropdown-item">Banned</a>
                        <a href="#" class="dashboard-nav-dropdown-item">New</a>
                    </div>
                </div>

                <div class='dashboard-nav-dropdown'>
                    <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i class="fas fa-thumbs-up"></i> Aprovações
                    </a>
                    <div class='dashboard-nav-dropdown-menu'>
                        <a href="#" class="dashboard-nav-dropdown-item">All</a>
                        <a href="#" class="dashboard-nav-dropdown-item">Subscribed</a>
                        <a href="#" class="dashboard-nav-dropdown-item">Non-subscribed</a>
                        <a href="#" class="dashboard-nav-dropdown-item">Banned</a>
                        <a href="#" class="dashboard-nav-dropdown-item">New</a>
                    </div>
                </div>

                <div class="nav-item-divider"></div>

                <a href="#" class="dashboard-nav-item"><i class="fas fa-users"></i> Usuários </a>
                <a href="#" class="dashboard-nav-item"><i class="fas fa-sign-out-alt"></i> Logout </a>
            </nav>
        </div>
        <div class='dashboard-app'>
            <header class='dashboard-toolbar'>
                <a href="#!" class="menu-toggle">
                    <i class="fas fa-bars " id='menu-toggle-app'></i>
                </a>
            </header>
            <div class='dashboard-content'>
                <div class='container'>
                    <div class='card'>
                        <div class='card-header'>
                            <h2>{{ $title }}</h2>
                        </div>
                        <div class='card-body'>
                            {{$slot}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src={{asset('/js/menu/script.js')}}></script>

</body>

</html>