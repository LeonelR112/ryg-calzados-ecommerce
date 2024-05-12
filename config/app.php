<?php
    ini_set('session.gc_probability', 1);
    ini_set('session.gc_divisor', 100);
    session_save_path(__DIR__ . "/../cache/sesiones");
    session_start([
        'gc_maxlifetime' => 14440, 'cookie_lifetime' => 28800
    ]);
    date_default_timezone_set($_ENV['REGION_HORARIA']);
    const VIEWS = __DIR__ . '/../app/views/';
    const CACHE_BLADE = __DIR__ . "/../cache/bladeone";
    const CACHE_SESIONES = __DIR__ . "/../cache/sesiones";
    const TITLE_PAGE = "R&G Calzados";
    const MAIN_URL = "http://localhost/ryg-ecommerce/";
?>