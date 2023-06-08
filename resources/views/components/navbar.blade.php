<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
  <a class="navbar-brand mr-1" href="{{route('home')}}">Festival Cultural Zacatecas 2019</a>

  <button class="btn btn-link btn-sm text-white order-1 d-md-none"
          id="sidebarToggle" href="#">
    <i class="fas fa-bars"></i>
  </button>

  {{-- Agrega el espacio para mandar la ul de abajo hasta la derecha --}}
  <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></div>

  <!-- Navbar -->
  <ul class="navbar-nav ml-auto ml-md-0">
    @if(session('UserLogged'))
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown"
           role="button" data-toggle="dropdown" aria-haspopup="true"
           aria-expanded="false">
          <span class="d-none d-sm-none d-md-inline">Bienvenido, {{session('UserName')}}</span>
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right"
             aria-labelledby="userDropdown">
          <a class="dropdown-item" href="{{ route('user.logout.action') }}">
            Cerrar sesión
          </a>
        </div>
      </li>
    @else
      <li class="nav-item no-arrow">
        <a class="nav-link" href="{{ route('user.login.view') }}">
          <span class="d-none d-sm-none d-md-inline">Ingresar</span>
          <i class="fas fa-sign-in-alt fa-fw"></i>
        </a>
      </li>
    @endif
  </ul>

</nav>
