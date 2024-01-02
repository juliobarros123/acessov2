<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ url('/') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('logo/logo.png') }}" alt="" height="26">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('logo/logo.png') }}" alt="" height="26"> <span
                            class="logo-txt">Acesso</span>
                    </span>
                </a>

                <a href="{{ url('/') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('logo/logo.png') }}" alt="" height="26">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('logo/logo.png') }}" alt="" height="26"> <span
                            class="logo-txt">Acesso</span>
                    </span>
                </a>

            </div>

            <button type="button" class="btn btn-sm px-3 header-item vertical-menu-btn noti-icon">
                <i class="fa fa-fw fa-bars font-size-16"></i>
            </button>


        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block d-block d-lg-none">
                <button type="button" class="btn header-item noti-icon" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="bx bx-search icon-sm"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
                    <form class="p-2">
                        <div class="search-box">
                            <div class="position-relative">
                                <input type="text" class="form-control rounded bg-light border-0"
                                    placeholder="Search...">
                                <i class="bx bx-search search-icon"></i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block language-switch">
                {{-- <button type="button" class="btn header-item noti-icon" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img id="header-lang-img" src="assets/images/flags/us.jpg" alt="Header Language" height="16">
                    </button> --}}
                <div class="dropdown-menu dropdown-menu-end">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="eng">
                        <img src="assets/images/flags/us.jpg" alt="user-image" class="me-2" height="12"> <span
                            class="align-middle">English</span>
                    </a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="sp">
                        <img src="assets/images/flags/spain.jpg" alt="user-image" class="me-2" height="12"> <span
                            class="align-middle">Spanish</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="gr">
                        <img src="assets/images/flags/germany.jpg" alt="user-image" class="me-2" height="12"> <span
                            class="align-middle">German</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="it">
                        <img src="assets/images/flags/italy.jpg" alt="user-image" class="me-2" height="12"> <span
                            class="align-middle">Italian</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ru">
                        <img src="assets/images/flags/russia.jpg" alt="user-image" class="me-2" height="12"> <span
                            class="align-middle">Russian</span>
                    </a>
                </div>
            </div>

            {{-- <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-bell icon-sm"></i>
                        <span class="noti-dot bg-danger rounded-pill">3</span>
                    </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="m-0 font-size-15"> Notifications </h5>
                            </div>
                            <div class="col-auto">
                                <a href="javascript:void(0);" class="small"> Mark all as read</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 250px;">
                        <h6 class="dropdown-header bg-light">New</h6>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex border-bottom align-items-start">
                                <div class="flex-shrink-0">
                                    <img src="assets/images/users/avatar-3.jpg" class="me-3 rounded-circle avatar-sm" alt="user-pic">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Justin Verduzco</h6>
                                    <div class="text-muted">
                                        <p class="mb-1 font-size-13">Your task changed an issue from "In Progress" to <span class="badge badge-soft-success">Review</span></p>
                                        <p class="mb-0 font-size-10 text-uppercase fw-bold"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex border-bottom align-items-start">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm me-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                <i class="uil-shopping-basket"></i>
                                            </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">New order has been placed</h6>
                                    <div class="text-muted">
                                        <p class="mb-1 font-size-13">Open the order confirmation or shipment confirmation.</p>
                                        <p class="mb-0 font-size-10 text-uppercase fw-bold"><i class="mdi mdi-clock-outline"></i> 5 hours ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <h6 class="dropdown-header bg-light">Earlier</h6>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex border-bottom align-items-start">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm me-3">
                                        <span class="avatar-title bg-soft-success text-success rounded-circle font-size-16">
                                                <i class="uil-truck"></i>
                                            </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Your item is shipped</h6>
                                    <div class="text-muted">
                                        <p class="mb-1 font-size-13">Here is somthing that you might light like to know.</p>
                                        <p class="mb-0 font-size-10 text-uppercase fw-bold"><i class="mdi mdi-clock-outline"></i> 1 day ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="" class="text-reset notification-item">
                            <div class="d-flex border-bottom align-items-start">
                                <div class="flex-shrink-0">
                                    <img src="assets/images/users/avatar-4.jpg" class="me-3 rounded-circle avatar-sm" alt="user-pic">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Salena Layfield</h6>
                                    <div class="text-muted">
                                        <p class="mb-1 font-size-13">Yay ! Everything worked!</p>
                                        <p class="mb-0 font-size-10 text-uppercase fw-bold"><i class="mdi mdi-clock-outline"></i> 3 days ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                            <i class="uil-arrow-circle-right me-1"></i> <span>View More..</span>
                        </a>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon right-bar-toggle" id="right-bar-toggle">
                            <i class="bx bx-cog icon-sm"></i>
                        </button>
                </div> --}}

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item user text-start d-flex align-items-center"
                    id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="assets/images/users/av.jpg"
                        alt="Header Avatar">
                    <span class="ms-2 d-none d-xl-inline-block user-item-desc">
                        <span class="user-name">{{ Auth::User()->vc_primeiro_nome }} {{ Auth::User()->vc_nome_meio }} <i
                                class="mdi mdi-chevron-down"></i></span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    {{-- <h6 class="dropdown-header">Welcome Marie N!</h6> --}}

                    <a class="dropdown-item" id="sessao"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i> <span
                            class="align-middle">Sair</span></a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    {{-- <div class="collapse show verti-dash-content" id="dashtoggle">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Vertical</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">layouts</a></li>
                                <li class="breadcrumb-item active">Vertical</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- start dash info -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card dash-header-box shadow-none border-0">
                        <div class="card-body p-0">
                            <div class="row row-cols-xxl-6 row-cols-md-3 row-cols-1 g-0">
                                <div class="col">
                                    <div class="mt-md-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Campaign Sent </p>
                                        <h3 class="text-white mb-0">197</h3>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Annual Profit</p>
                                        <h3 class="text-white mb-0">$489.4k</h3>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Lead Coversation</p>
                                        <h3 class="text-white mb-0">32.89%</h3>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Sales Forecast</p>
                                        <h3 class="text-white mb-0">75.35%</h3>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-lg-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Daily Average Income</p>
                                        <h3 class="text-white mb-0">$1,596.5</h3>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-lg-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Annual Deals</p>
                                        <h3 class="text-white mb-0">2,659</h3>
                                    </div>
                                </div>
                                <!-- end col -->

                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end dash info -->
        </div>
    </div>

    <!-- start dash troggle-icon -->
    <div>
        <a class="dash-troggle-icon" id="dash-troggle-icon" data-bs-toggle="collapse" href="#dashtoggle" aria-expanded="true" aria-controls="dashtoggle">
            <i class="bx bx-up-arrow-alt"></i>
        </a>
    </div> --}}
    <!-- end dash troggle-icon -->


</header>

<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">


    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ url('/') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('logo/logo.png') }}" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('logo/logo.png') }}" alt="" height="26"> <span
                    class="logo-txt">Acesso</span>
            </span>
        </a>

        <a href="{{ url('/') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('logo/logo.png') }}" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('logo/logo.png') }}" alt="" height="26"> <span
                    class="logo-txt">Acesso</span>
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="{{ url('home') }}">
                        <i class="bx bx-home-circle nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li class="menu-title" data-key="t-menu">Utilizadores</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-map-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-maps">Utilizadores</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.user.index') }}" data-key="t-google">Listar</a></li>
                        <li><a href="{{ route('admin.user.create') }}" data-key="t-vector">Cadastrar</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-user nav-icon"></i>
                        <span class="menu-item" data-key="t-maps">Candidatos</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.candidato.index') }}" data-key="t-google">Listar</a></li>
                        <li><a href="{{ route('admin.candidato.create') }}" data-key="t-vector">Cadastrar</a></li>

                    </ul>
                </li>
                <li  class="menu-title" data-key="t-menu">SGE</li>
                <li>
                    <a href="{{ route('admin.turmas.sge') }}" class="has-arrow">
                        <i class="bx bx-map-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-maps">Turmas</span>
                    </a>

                </li>
                
                <li class="menu-title" data-key="t-menu">Avaliação</li>
                <li>
                    <a href="{{ route('admin.enunciado.sala.room') }}" class="has-arrow">
                        <i class="bx bx-map-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-maps">Enunciados por Sala</span>
                    </a>

                </li>

                
             



                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-map-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-maps">Correção</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.correcoes.corregir') }}" data-key="t-google">Corregir</a></li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-map-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-maps">Resultados</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.resultados') }}" data-key="t-google">Geral</a></li>
                        <li><a href="{{ route('admin.resultados.individual') }}" data-key="t-google">Individual</a>
                        </li>
                        <li><a href="{{ route('admin.resultados.imprimir') }}" data-key="t-google">Imprimir</a></li>
                        <li><a href="{{ route('admin.resultados.por_prova') }}" data-key="t-google">Por prova</a></li>

                    </ul>
                </li>
                <li class="menu-title" data-key="t-menu">Configurações</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-map-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-maps">Ano Lectivo</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.ano_lectivo.index') }}" data-key="t-google">Listar</a></li>
                        <li><a href="{{ route('admin.ano_lectivo.create') }}" data-key="t-vector">Cadastrar</a></li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-map-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-maps">Prova</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.prova.index') }}" data-key="t-google">Listar</a></li>
                        <li><a href="{{ route('admin.prova.create') }}" data-key="t-vector">Cadastrar</a></li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-map-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-maps">Horário</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.horario.index') }}" data-key="t-google">Listar</a></li>
                        <li><a href="{{ route('admin.horario.create') }}" data-key="t-vector">Cadastrar</a></li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-map-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-maps">Sala</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.sala.index') }}" data-key="t-google">Listar</a></li>
                        <li><a href="{{ route('admin.sala.create') }}" data-key="t-vector">Cadastrar</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-map-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-maps">Período</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.periodo.index') }}" data-key="t-google">Listar</a></li>
                        <li><a href="{{ route('admin.periodo.create') }}" data-key="t-vector">Cadastrar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-map-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-maps">Disciplinas</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.disciplina.index') }}" data-key="t-google">Listar</a></li>
                        <li><a href="{{ route('admin.disciplina.create') }}" data-key="t-vector">Cadastrar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.cursos.index') }}" class="has-arrow">
                        <i class="bx bx-map-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-maps">Cursos</span>
                    </a>
                
                </li>
                <li>
                    <a href="{{ route('admin.cursos_disciplinas') }}" class="has-arrow">
                        <i class="bx bx-map-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-maps">Cursos/Disciplinas</span>
                    </a>
                
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-map-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-maps">Classe</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.classe.index') }}" data-key="t-google">Listar</a></li>
                        <li><a href="{{ route('admin.classe.create') }}" data-key="t-vector">Cadastrar</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-map-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-maps">Pergunta</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.pergunta.index') }}" data-key="t-google">Listar</a></li>
                        {{-- <li><a href="{{ route('admin.pergunta.create') }}" data-key="t-vector">Cadastrar</a></li> --}}

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-map-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-maps">Banco Pergunta</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.banco_pergunta.index') }}" data-key="t-google">Listar</a></li>
                        {{-- <li><a href="{{ route('admin.banco_pergunta.create') }}" data-key="t-vector">Cadastrar</a> --}}
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-map-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-maps">Banco Alinea</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.banco_alinea.index') }}" data-key="t-google">Listar</a></li>
                        {{-- <li><a href="{{ route('admin.banco_alinea.create') }}" data-key="t-vector">Cadastrar</a></li> --}}
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-map-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-maps">Tipo de Usuário</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.tipo_user.index') }}" data-key="t-google">Listar</a></li>
                        <li><a href="{{ route('admin.tipo_user.create') }}" data-key="t-vector">Cadastrar</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
