<nav class="row m-0 bg-primary p-3 position-relative">
    <div class="col-12 col-md-4 col-lg-3 text-center">
        <a class="navbar-brand" href="#"><img src="{{assets('img/ryg-logo-white.png')}}" width="120px" alt=""></a>
    </div>  
    <div class="col-0 col-md-8 col-lg-9">
        <div class="nav-items-content">
            <ul class="nav justify-content-end">
              <li class="nav-item">
                  <a class="nav-link text-light" aria-current="page" href="{{route("")}}">INICIO</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link text-light" href="{{route('productos')}}">PRODUCTOS</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link text-light" href="{{route('por-mayor')}}">POR MAYOR</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link text-light" href="{{route('ingresar')}}">INGRESAR</a>
              </li>
            </ul>
        </div>
    </div>
    <button class="btn btn-light btn-nav-menu" type="button" class="Abrir menú de navegación"><i class="bi bi-list"></i></button>
</nav>