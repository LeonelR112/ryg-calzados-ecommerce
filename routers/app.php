<?php
    $Router = new \Bramus\Router\Router();
    $Router->set404(function(){
        echo "Page not found - 404";
    });

    require_once __DIR__ . "/middleware.php";
    require_once __DIR__ . "/api.php";

    ### Rutas ###
    $Router->get("/", "HomePageController@renderIndex");
    
    ## Productos
    $Router->get("/productos", "ProductoController@renderIndex");

    ## Mi carrito
    $Router->get("/mi-carrito", "MiCarritoController@renderIndex");

    # Ingresar (log in)
    $Router->get("/ingresar", "LoginController@renderIndex");
    $Router->post("/ingresar/verificar", "LoginController@verificarUsuario");
    $Router->get("/registrarse", "LoginController@formularioRegistro");
    $Router->post("/ingresar/verificar-registro", "LoginController@verificarUnRegistro");

    /// Sesión iniciada

    ## Dashboard
    $Router->get("auth/dashboard", "DashboardController@renderIndex");

    ## Usuarios
    $Router->get("auth/usuarios", "UsuarioController@renderIndex");
    $Router->get("auth/usuarios/nuevo-usuario", "UsuarioController@formNuevoUsuario");
    $Router->post("auth/usuarios/crear-usuario", "UsuarioController@crearNuevoUsuario");

    $Router->get("auth/log-out", "LoginController@cerrarSesion");
    $Router->run();
?>