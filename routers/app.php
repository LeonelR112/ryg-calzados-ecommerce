<?php
    $Router = new \Bramus\Router\Router();
    $Router->set404(function(){
        echo "Page not found - 404";
    });

    require_once __DIR__ . "/middleware.php";
    require_once __DIR__ . "/api.php";

    ### Rutas ###
    $Router->get("/", function(){
        MainController::renderIndex();
    });
    
    ## Productos
    $Router->get("/productos", "ProductoController@renderIndex");

    $Router->run();
?>