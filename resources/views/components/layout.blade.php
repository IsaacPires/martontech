<x-basic title={{$title}}>
<body>

    <div class='dashboard'>
        <div class="dashboard-nav">
            <header>
                <a href="#!" class="menu-toggle">
                    <i class="fas fa-bars" id="menu-toggle-nav"></i>
                </a>
                <a href="/" class="brand-logo">
                    <img src={{asset("/img/logo.png")}}>
                </a>
            </header>
            <nav class="dashboard-nav-list">
                <a href="/" class="dashboard-nav-item active">
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
                        <a href="/" class="dashboard-nav-dropdown-item">Adicionar</a>
                        <a href="/" class="dashboard-nav-dropdown-item">Relatório</a>
                    </div>
                </div>
                <div class='dashboard-nav-dropdown'>
                    <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i class="fas fa-money-check-alt"></i> Requisição
                    </a>
                    <div class='dashboard-nav-dropdown-menu'>
                        <a href="/" class="dashboard-nav-dropdown-item">Adicionar</a>
                        <a href="/" class="dashboard-nav-dropdown-item">Relatório</a>
                    </div>
                </div>
                <div class='dashboard-nav-dropdown'>
                    <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i <i class="far fa-file-alt"></i> Notas Fiscais
                    </a>
                   <div class='dashboard-nav-dropdown-menu'>
                        <a href="/" class="dashboard-nav-dropdown-item">Adicionar</a>
                        <a href="/" class="dashboard-nav-dropdown-item">Relatório</a>
                    </div>
                </div>

                <div class='dashboard-nav-dropdown'>
                    <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i class="fas fa-thumbs-up"></i> Aprovações
                    </a>
                    <div class='dashboard-nav-dropdown-menu'>
                        <a href="/" class="dashboard-nav-dropdown-item">Pendentes</a>
                        <a href="/" class="dashboard-nav-dropdown-item">Relatório</a>
                    </div>
                </div>

                <div class="nav-item-divider"></div>

                <a href="{{route('users.index')}}" class="dashboard-nav-item"><i class="fas fa-users"></i> Usuários </a>
                @auth
                <a href="{{route('logout')}}" class="dashboard-nav-item"><i class="fas fa-sign-out-alt"></i> Logout </a>
                @endauth
                @guest
                <a href="{{route('login')}}" class="dashboard-nav-item"><i class="fas fa-sign-out-alt"></i> Logout </a>
                @endguest
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
</x-basic>