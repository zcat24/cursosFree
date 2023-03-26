<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
    aria-controls="offcanvasNavbar">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="text-start">
    <a class="ms-3 navbar-brand font-monospace " href="{{ route('home') }}"> <img style="margin-left: 100%" class="fluid"
            src="{{ asset('img/curso.png') }}" alt="O" width="40px" /></a>
</div>
<a class="nav-link nav-profile d-flex align-items-center p-0" href="#" data-bs-toggle="dropdown">
    <img width="30px" height="auto" src="https://picsum.photos/300/300" alt="Profile" class="rounded-circle"> <span
        class="d-none d-md-block dropdown-toggle ps-2">{{ ucwords(auth()->user()->nombres) }}</span>
</a>
<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow dropdown-menu-noti p-0">
    <li class="dropdown-header">
        <h6 class="my-1">Administrar mi cuenta</h6>
    </li>
    <li>
        <hr class="dropdown-divider">
    </li>
    <li> <a class="dropdown-item d-flex align-items-center" href="#">
            <i class="me-2 fa-solid fa-user text-secondary"></i>
            <span>Mi Perfil</span> </a>
    </li>
    <li>
        <hr class="dropdown-divider">
    </li>
    <li>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <a class="dropdown-item d-flex align-items-center m-0" href="#"
                onclick="this.closest('form').submit()"><i
                    class="me-2 fa-solid fa-arrow-right-to-bracket text-secondary"></i> <span>Cerrar
                    sesion</span>
            </a>
        </form>
    </li>
</ul>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
    <div class="offcanvas-header">
        <a class="ms-3 navbar-brand font-monospace" href="{{ route('home') }}"> <img class="mover-derecha" style="margin-top:-5px"
                class="fluid" src="{{ asset('img/curso.png') }}" alt="O" width="200px" /></a>
    </div>
    <div class="offcanvas-body">
        <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page"
                        href="{{ route('home') }}"><strong>Inicio</strong></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}"><strong><i
                                class="fa-solid fa-person-breastfeeding fa-xl"></i> Atención de Estudiantes</strong></a>
                </li>
                @can('modulo configuraciones')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <strong><i class="fa-solid fa-gears fa-xl"></i> Configuraciones</strong>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                            @can('gestionar usuarios')
                                <li><a class="dropdown-item" href="{{ route('usuarios') }}"><i
                                            class="fa-solid fa-users fa-xl"></i> Gestión de Usuarios</a></li>
                            @endcan
                            @can('gestionar roles')
                                <li><a class="dropdown-item" href="{{ route('roles') }}"><i
                                            class="fa-solid fa-address-book fa-xl"></i> Gestión de Roles</a></li>
                            @endcan
                            @can('gestionar permisos')
                                <li><a class="dropdown-item" href="{{ route('permisos') }}"><i
                                            class="fa-solid fa-person-chalkboard fa-xl"></i> Gestión de Permisos</a></li>
                            @endcan
                            @can('gestionar estados')
                                <li><a class="dropdown-item" href="{{ route('estados') }}"><i
                                            class="fa-brands fa-usps fa-xl"></i> Gestión de Estados</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('gestionar curso')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <strong><i class="fa-solid fa-folder-plus fa-xl"></i> Gestión de Contenido</strong>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                        @can('gestionar curso')
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-video fa-xl"></i> Gestión de Cursos</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('modulo de consultas')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <strong><i class="fa-solid fa-magnifying-glass fa-xl"></i>Consultas</strong></a>
                        <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                            <li><a class="dropdown-item" href="#"><i
                                        class="fa-brands fa-searchengin fa-xl"></i>Generar Consultas</a></li>
                        </ul>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
