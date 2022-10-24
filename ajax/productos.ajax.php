<?php
    require_once '../controlador/productos.controlador.php';
    require_once '../modelo/productos.modelo.php';
    /*--===============================================
    LLENAR DATOS DE TABLA METODO GET
    =================================================*/
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        $tabla=ControladorProductos::getCtrDataTable();
        echo json_encode($tabla);
    }

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $_POST=json_decode(file_get_contents('php://input'),true);
        /*--===============================================
        LLENAR DATOS MODAL EDITAR
        =================================================*/
        if(isset($_POST["id"]) && $_POST["modal"]=="editar"){
            $row=ControladorProductos::getCtrDataProduct($_POST["id"]);
            echo json_encode($row);
        }
        /*--===============================================
        ELIMINAR PRODUCTO
        =================================================*/
        if(isset($_POST["id"]) && $_POST["modal"]=="eliminar"){
            ControladorProductos::ctrEliminarProducto($_POST["id"]);
     
        }
    }