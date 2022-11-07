<?php
    require_once '../controlador/pagos.controlador.php';
    require_once '../modelo/pagos.modelo.php';

    if($_SERVER["REQUEST_METHOD"]=="GET"){
        if(isset($_GET["tablaPagos"])){
            $tablapagos=ControladorPagos::ctrgetPagos();
            $newtablapagos=array_map(function($pago){

                $pago["monto"]="<span class='min-w-60 btn btn-sm btn-success'>S/. ".$pago["monto"]."</span>";
                $pago["preciototal"]="<span class='min-w-60 btn btn-sm btn-primary'>S/. ".$pago["preciototal"]."</span>";

                $pago["acciones"]='<div class="btn-group" style="gap:5px">
                <button class="btn btn-warning btnEditarPago" data-toggle="modal" data-target="#modalEditarPago" data-id="'.$pago["id"].'"><i class="fa fa-pencil-alt text-white"></i></button>
                <button class="btn btn-danger btnEliminarPago" data-toggle="modal" data-target="#modalEliminarPago" data-id="'.$pago["id"].'"><i class="fa fa-times"></i></button>
              </div>';
              return $pago;
            },$tablapagos);
            echo json_encode($newtablapagos);
        }
        if(isset($_GET["orden"])){
            $rs=ControladorPagos::ctrgetInfoDeuda($_GET["orden"]);
            echo json_encode($rs);
        }
        if(isset($_GET["idEdit"])){
            $rs=ControladorPagos::ctrgetInfoDeudaEdit($_GET["idEdit"]);
            echo json_encode($rs);
        }
        if(isset($_GET["delete"])){
            ControladorPagos::ctrdeletePago($_GET["delete"]);
        }

    }
    if($_SERVER["REQUEST_METHOD"]==="POST"){
        if(isset($_POST["crear"])){
            ControladorPagos::ctrsetPago($_POST);
        }
        if((isset($_POST["editar"]))){
            ControladorPagos::ctrupdatePago($_POST);
        }
    }