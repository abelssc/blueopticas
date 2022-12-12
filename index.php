<?php
    #CONTROLADORES
    require_once __DIR__."/controlador/categorias.controlador.php";
    require_once __DIR__."/controlador/clientes.controlador.php";
    require_once __DIR__."/controlador/plantilla.controlador.php";
    require_once __DIR__."/controlador/productos.controlador.php";
    require_once __DIR__."/controlador/usuarios.controlador.php";
    require_once __DIR__."/controlador/ventas.controlador.php";
    require_once __DIR__."/controlador/pagos.controlador.php";
    require_once __DIR__."/controlador/chart.controlador.php";
    #MODELOS
    require_once __DIR__."/modelo/categorias.modelo.php";
    require_once __DIR__."/modelo/clientes.modelo.php";
    require_once __DIR__."/modelo/productos.modelo.php";
    require_once __DIR__."/modelo/usuarios.modelo.php";
    require_once __DIR__."/modelo/ventas.modelo.php";
    require_once __DIR__."/modelo/pagos.modelo.php";
    require_once __DIR__."/modelo/chart.modelo.php";
    require_once __DIR__."/modelo/caja.modelo.php";
    $plantilla=new ControladorPlantilla();
    $plantilla->ctrPlantilla();