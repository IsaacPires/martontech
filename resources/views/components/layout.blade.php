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
                        <i class="fas fa-tachometer-alt"></i> Dashboard
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
                            <a href="{{route('products.create')}}" class="dashboard-nav-dropdown-item">Adicionar</a>
                            <a href="{{route('products.index')}}" class="dashboard-nav-dropdown-item">Relatório</a>
                        </div>
                    </div>
                    <div class='dashboard-nav-dropdown'>
                        <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle">
                            <i class="fa fa-wrench"></i> Ferramentas
                        </a>
                        <div class='dashboard-nav-dropdown-menu'>
                            <a href="{{route('tools.create')}}" class="dashboard-nav-dropdown-item">Adicionar</a>
                            <a href="{{route('tools.index')}}" class="dashboard-nav-dropdown-item">Relatório</a>
                            <a href="{{route('maintenances.index')}}" class="dashboard-nav-dropdown-item">Manutenção</a>
                        </div>
                    </div>
                    <div class='dashboard-nav-dropdown'>
                        <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle">
                            <i class="fas fa-exchange-alt"></i>Movimentações
                        </a>
                        <div class='dashboard-nav-dropdown-menu'>
                            <a href="{{route('sale_products.create')}}" class="dashboard-nav-dropdown-item">Retiradas</a>
                            <a href="{{route('sale_products.index')}}" class="dashboard-nav-dropdown-item">Relatório de retiradas</a>
                            <a href="{{route('entry_products.create')}}" class="dashboard-nav-dropdown-item">Entradas</a>
                            <a href="{{route('entry_products.index')}}" class="dashboard-nav-dropdown-item">Relatório Entradas</a>
                        </div>
                    </div>
                    <div class='dashboard-nav-dropdown'>
                        <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i class="fas fa-money-check-alt"></i> Requisição
                        </a>
                        <div class='dashboard-nav-dropdown-menu'>
                            <a href="{{route('request.create')}}" class="dashboard-nav-dropdown-item">Adicionar</a>
                            <a href="{{route('order.index')}}" class="dashboard-nav-dropdown-item">Relatório</a>
                        </div>
                    </div>
                    <div class='dashboard-nav-dropdown'>
                        <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i <i class="far fa-file-alt"></i> Notas Fiscais
                        </a>
                        <div class='dashboard-nav-dropdown-menu'>
                            <a href="{{route('invoices.create')}}" class="dashboard-nav-dropdown-item">Adicionar</a>
                            <a href="{{route('invoices.index')}}" class="dashboard-nav-dropdown-item">Relatório</a>
                        </div>
                    </div>
                    @if(Auth::user()->permission == 'adm')
                    <div class='dashboard-nav-dropdown'>
                        <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i class="fas fa-thumbs-up"></i> Aprovações
                        </a>
                        <div class='dashboard-nav-dropdown-menu'>
                            <a href="/pending" class="dashboard-nav-dropdown-item">Pendentes</a>
                        </div>
                    </div>
                    @endif

                    <div class="nav-item-divider"></div>
                    @if(Auth::user()->permission == 'adm')
                        <div class='dashboard-nav-dropdown'>
                            <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i class="fas fa-users"></i>
                                Usuários
                            </a>
                            <div class='dashboard-nav-dropdown-menu'>
                                <a href="{{route('users.create')}}" class="dashboard-nav-dropdown-item">Criar</a>
                                <a href="/users" class="dashboard-nav-dropdown-item">Relatório</a>
                            </div>
                        </div>

                        <div class='dashboard-nav-dropdown'>
                            <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i class="fas fa-users"></i>
                                Responsáveis
                            </a>
                            <div class='dashboard-nav-dropdown-menu'>
                                <a href="{{route('tools.change')}}" class="dashboard-nav-dropdown-item">Mudar responsável</a>
                            </div>
                        </div>
                    @endif
                </nav>
            </div>
            <div class='dashboard-app'>
                <header class="dashboard-toolbar d-flex justify-content-between align-items-center">
                    <a href="#!" class="menu-toggle">
                        <i class="fas fa-bars" id="menu-toggle-app"></i>
                    </a>
                    <div class="ml-auto d-flex align-items-center">
                        <p style="margin: 10px 0">{{ Auth::user()->name }}</p>
                        @auth
                        <a href="{{ route('logout') }}" style='color:#e93334' class="dashboard-nav-item ml-2"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        @endauth
                    </div>
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