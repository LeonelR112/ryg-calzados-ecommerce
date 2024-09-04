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
    $Router->get("/catalogo", "CatalogoPublicoController@renderIndex");

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
    $Router->post("auth/usuarios/eliminar-usuario", "UsuarioController@borrarUnUsuario");
    $Router->get("usuarios/editar/{id}", "UsuarioController@formModificarUsuario");
    $Router->post("auth/usuarios/modificar-usuario", "UsuarioController@modificarUsuario");

    ## Productos
    $Router->get("/auth/adm-productos", "MisProductosController@renderIndex");

        // Editor de productos
        $Router->get("auth/productos/editor-productos", "EditorProductoController@renderIndex");
        $Router->get("auth/productos/editor-productos/crear", "EditorProductoController@formNuevoProducto");
        $Router->post("auth/producto/editor-productos/crear-producto", "EditorProductoController@crearNuevoProducto");
        $Router->get("auth/productos/editor-producto/modificar/{id}", "EditorProductoController@formEditarProducto");
        $Router->post("auth/producto/editor-productos/actualiar-producto", "EditorProductoController@actualizarProducto");
        $Router->post("auth/productos/editor-productos/borrar-producto", "EditorProductoController@borrarProducto");

        // Categorías
        $Router->get("auth/productos/categorias", "CategoriaController@renderIndex");
        $Router->get("auth/categorias/nueva-categoria", "CategoriaController@formNuevaCategoria");
        $Router->post("auth/categorias/nueva-categoria/guardar", "CategoriaController@guardarNuevaCategoria");
        $Router->get("auth/productos/categorias/modificar/{id}", "CategoriaController@formModificarCategoria");
        $Router->post("auth/categorias/modificar-categoria/actualizar", "CategoriaController@actualizarCategoria");
        $Router->post("auth/productos/categorias/borrar-categoria", "CategoriaController@borrarCategoria");

        // Imagenes
        $Router->get('auth/productos/imagenes', "ImagenesController@renderIndex");
        $Router->post("auth/productos/imagenes/subir-imagenes", "ImagenesController@subirImagenes");
        $Router->post("auth/productos/imagenes/borrar-imagen", "ImagenesController@borrarUnaImagen");

    $Router->get("auth/log-out", "LoginController@cerrarSesion");
    $Router->run();
?>