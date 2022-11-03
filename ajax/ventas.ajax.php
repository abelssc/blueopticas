<?php
    require_once '../controlador/ventas.controlador.php';
    require_once '../modelo/ventas.modelo.php';

    if($_SERVER["REQUEST_METHOD"]=="GET"){
    /*--===============================================
    READ DATOS DE TABLA PRODUCTOS
    =================================================*/
        if(isset($_GET["datatable"])){
            $productos=ControladorVentas::ctrReadProductos();
            $newproductos=array_map(function($producto){
                $producto['foto']="<img src='vista/imagenesbd/productos/".$producto["foto"]."' width='40px'>";
                $producto['acciones']="<button class='btn btn-success btnAgregarProducto' data-id='".$producto['id']."'>Agregar</button>";
                return $producto;
            },$productos);
            
            echo json_encode($newproductos);
        }
    /*--===============================================
    READ DATOS DE CLIENTES
    =================================================*/
        if(isset($_GET["dataclientes"])){
            $clientes=ControladorVentas::ctrReadClientes($_GET["q"]??"");
            echo json_encode($clientes);
        }
    /*--===============================================
    GET DATOS ULTIMA ORDEN/ID
    =================================================*/
        if(isset($_GET["dataid"])){
            $res=ControladorVentas::ctrgetIdVenta();
            echo json_encode($res);
        }
    /*--===============================================
    GET VENTAS
    =================================================*/
        if(isset($_GET["datatableVentas"])){
            ControladorVentas::ctrgetVentas();
        }
    
    }
    /*--===============================================
    SET VENTA   
    =================================================*/
    if($_SERVER["REQUEST_METHOD"]=="POST"){
       
        $ventas=json_decode($_POST["ventas"]);
        $pagosventas=json_decode($_POST["pagosventas"]);
        $ventasproductos=json_decode($_POST["ventasproductos"]);
        $res= ControladorVentas::ctrsetVenta($ventas,$pagosventas,$ventasproductos);
        echo json_decode($res);

    }
    