<?php
    require_once '../controlador/ventas.controlador.php';
    require_once '../modelo/ventas.modelo.php';
    /*--===============================================
    READ DATOS DE TABLA PRODUCTOS
    =================================================*/
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        if(isset($_GET["datatable"])){
            $productos=ControladorVentas::ctrReadProductos();
            $newproductos=array_map(function($producto){
                $producto['foto']="<img src='vista/imagenesbd/productos/".$producto["foto"]."' width='40px'>";
                $producto['acciones']="<button class='btn btn-success btnAgregarProducto' data-id='".$producto['id']."'>Agregar</button>";
                return $producto;
            },$productos);
            
            echo json_encode($newproductos);
        }
        if(isset($_GET["dataclientes"])){
            $clientes=ControladorVentas::ctrReadClientes($_GET["q"]??"");
            echo json_encode($clientes);
        }
        
    }