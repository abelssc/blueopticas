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
            $ventas=ControladorVentas::ctrgetVentas();
            $newventas=array_map(function($venta){
                // ACUENTA
                // $venta["acuenta"]="<span class='min-w-60 btn btn-sm btn-success'>S/. ".$venta["acuenta"]."</span>";
                // TOTAL
                $venta["preciototal"]="<span class='min-w-60 btn btn-sm btn-primary'>S/. ".$venta["preciototal"]."</span>";
                // DEBE
                $venta["debe"]="<span class='min-w-60 btn btn-sm btn-danger'>S/. ".$venta["debe"]."</span>";
                // ESTADO
                $estado="";
                if($venta['situacion']==="entregado"){
                    $estado="btn-success";
                }elseif($venta['situacion']==="pendiente"){
                    $estado="btn-warning";
                }else{
                    $estado="btn-danger";}
              
                $venta['situacion']="<button class='btn btn-sm $estado'>".$venta['situacion']."</button>";

                //PRODUCTOS
                $venta['productos']??="";
                $productos=preg_split('/,/',$venta['productos']);
                $string="";
                foreach ($productos as $producto) {
                    $string.="<span class='btn btn-secondary btn-xs mr-1'>$producto</span>";
                }
                $venta['productos']="<div style='max-width:250px'>$string</div>";
                // ACCIONES
                $venta['acciones']='<div class="btn-group" style="gap:5px">
                <button class="btn btn-info btnComprasCliente" data-toggle="modal" data-target="#modalComprasCliente" data-id="'.$venta["id"].'"><i class="fa fa-shopping-cart"></i></button>
                <a href="index.php?ruta=editar-venta&ventaid='.$venta["id"].'" class="btn btn-warning btnEditarVenta"><i class="fa fa-pencil-alt text-white"></i></a>
                <button class="btn btn-danger btnEliminarVenta" data-toggle="modal" data-target="#modalEliminarVenta" data-id="'.$venta["id"].'"><i class="fa fa-times"></i></button>
              </div>';


                return $venta;
            },$ventas);
            echo json_encode($newventas);
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
    