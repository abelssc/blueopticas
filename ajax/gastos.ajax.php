<?php
    require_once '../controlador/gastos.controlador.php';
    require_once '../modelo/gastos.modelo.php';

    if($_SERVER["REQUEST_METHOD"]=="GET"){
        if(isset($_GET["tablaGastos"])){
            $tablaGastos=ControladorGastos::ctrgetGastos();
            $newtablaGastos=array_map(function($gasto){

                $gasto["monto"]="<span class='min-w-60 btn btn-sm btn-success'>S/. ".$gasto["monto"]."</span>";

                $gasto["acciones"]='<div class="btn-group" style="gap:5px">
                <button class="btn btn-warning btnEditarGasto" data-toggle="modal" data-target="#modalEditarGasto" data-id="'.$gasto["id"].'"><i class="fa fa-pencil-alt text-white"></i></button>
                <button class="btn btn-danger btnEliminarGasto" data-toggle="modal" data-target="#modalEliminarGasto" data-id="'.$gasto["id"].'"><i class="fa fa-times"></i></button>
              </div>';
              return $gasto;
            },$tablaGastos);
            echo json_encode($newtablaGastos);
        }
        if(isset($_GET["tablaGastosDia"])){
            $tablaGastos=ControladorGastos::ctrgetGastosDia($_GET["tablaGastosDia"]);
            $newtablaGastos=array_map(function($gasto){

                $gasto["monto"]="<span class='min-w-60 btn btn-sm btn-danger'>S/. ".$gasto["monto"]."</span>";
                return $gasto;
            },$tablaGastos);
            echo json_encode($newtablaGastos);
        }
        if(isset($_GET["idEdit"])){
            $rs=ControladorGastos::ctrgetInfoGasto($_GET["idEdit"]);
            echo json_encode($rs);
        }
        if(isset($_GET["delete"])){
            ControladorGastos::ctrdeleteGasto($_GET["delete"]);
        }


    }

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST["crear"])){
            ControladorGastos::ctrsetGasto($_POST);
        }
        if(isset($_POST["editar"])){
            ControladorGastos::ctrupdateGasto($_POST);
        }
    }