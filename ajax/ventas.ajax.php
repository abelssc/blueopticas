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
                if($producto["foto"]=="null"||$producto["foto"]==""){
                    $producto['foto']="profile.png";
                }
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
                <a href="index.php?ruta=info-venta&ventaid='.$venta["id"].'" class="btn btn-info btnComprasCliente"><i class="fa fa-shopping-cart"></i></a>
        
                <a href="index.php?ruta=editar-venta&ventaid='.$venta["id"].'" class="btn btn-warning btnEditarVenta"><i class="fa fa-pencil-alt text-white"></i></a>
              </div>';
            //   <button class="btn btn-danger btnEliminarVenta" data-toggle="modal" data-target="#modalEliminarVenta" data-id="'.$venta["id"].'"><i class="fa fa-times"></i></button>

                return $venta;
            },$ventas);
            echo json_encode($newventas);
        }
    /*--===============================================
    GET VENTAS DIA
    =================================================*/
        if(isset($_GET["datatableVentasDia"])){
            $ventas=ControladorVentas::ctrgetVentasDia($_GET["datatableVentasDia"]);
            $newventas=array_map(function($venta){
                //ACUENTA
                $venta["acuenta"]="<span class='min-w-60 btn btn-sm btn-success'>S/. ".$venta["acuenta"]."</span>";
                // TOTAL
                $venta["preciototal"]="<span class='min-w-60 btn btn-sm btn-primary'>S/. ".$venta["preciototal"]."</span>";
                // DEBE
                $venta["debe"]="<span class='min-w-60 btn btn-sm btn-danger'>S/. ".$venta["debe"]."</span>";

                //PRODUCTOS
                $venta['productos']??="";
                $productos=preg_split('/,/',$venta['productos']);
                $string="";
                foreach ($productos as $producto) {
                    $string.="<span class='btn btn-secondary btn-xs mr-1'>$producto</span>";
                }
                $venta['productos']="<div style='max-width:250px'>$string</div>";

                return $venta;
            },$ventas);
            echo json_encode($newventas);
        }
        if(isset($_GET["datatableRecojosDia"])){
            $ventas=ControladorVentas::ctrgetRecojosDia($_GET["datatableRecojosDia"]);
            $newventas=array_map(function($venta){
                //ACUENTA
                $venta["acuenta"]="<span class='min-w-60 btn btn-sm btn-success'>S/. ".$venta["acuenta"]."</span>";
                // TOTAL
                $venta["preciototal"]="<span class='min-w-60 btn btn-sm btn-primary'>S/. ".$venta["preciototal"]."</span>";


                //PRODUCTOS
                $venta['productos']??="";
                $productos=preg_split('/,/',$venta['productos']);
                $string="";
                foreach ($productos as $producto) {
                    $string.="<span class='btn btn-secondary btn-xs mr-1'>$producto</span>";
                }
                $venta['productos']="<div style='max-width:250px'>$string</div>";

                return $venta;
            },$ventas);
            echo json_encode($newventas);
        }
    
    }
    /*--===============================================
    SET VENTA   
    =================================================*/
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST["setventa"])){
            $ventas=json_decode($_POST["ventas"]);
            $pagosventas=json_decode($_POST["pagosventas"]);
            $ventasproductos=json_decode($_POST["ventasproductos"]);
            $res= ControladorVentas::ctrsetVenta($ventas,$pagosventas,$ventasproductos);
            echo json_decode($res);
        }
        if(isset($_POST["updateventa"])){
            $ventas=json_decode($_POST["ventas"]);
            $ventasproductos=json_decode($_POST["ventasproductos"]);
            $res= ControladorVentas::ctrupdateVenta($ventas,$ventasproductos);
            echo json_decode($res);
        }

    }

    