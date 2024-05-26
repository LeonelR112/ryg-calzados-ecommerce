@if($_SESSION['session_user']['categoria'] == 1)
<h1 class="logo">
    <a href="#">Menu</a>
</h1>
<div class="nav-wrap">
    <nav class="main-nav" role="navigation">
        <ul class="unstyled list-hover-slide">
            <li><a href="{{route('auth/dashboard')}}"><i class="bi bi-columns-gap"></i> DASHBOARD</a></li>
            <li><a href="{{route("auth/usuarios")}}"><i class="bi bi-people-fill"></i> USUARIOS</a></li>
            <li><a href="#"><i class="bi bi-person-lines-fill"></i> CLIENTES</a></li>
            <li><a href="#"><i class="bi bi-truck"></i> PROVEEDORES</a></li>
            <li><a href="#"><i class="bi bi-boxes"></i> PRODUCTOS</a></li>
            <li><a href="#"><i class="bi bi-megaphone-fill"></i> PÚBLICO</a></li>
            <li><a href="#"><i class="bi bi-envelope-fill"></i> MENSAJES A CLIENTES</a></li>
            <li><a href="{{route('auth/log-out')}}"><i class="bi bi-box-arrow-left"></i> SALIR</a></li>
        </ul>
    </nav>
</div>
@endif