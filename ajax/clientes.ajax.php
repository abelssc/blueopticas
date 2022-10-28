<?php
    require_once '../controlador/clientes.controlador.php';
    require_once '../modelo/clientes.modelo.php';
    /*--===============================================
    READ DATOS DE TABLA METODO GET
    =================================================*/
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        $tabla=ControladorClientes::getCtrDataTable();
        echo json_encode($tabla);
    }

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        // $_POST=json_decode(file_get_contents('php://input'),true);
        /*--===============================================
        CREAR CLIENTE
        =================================================*/
        if($_POST["modal"]==="crear"){
            $crear= new ControladorClientes();
            $res=json_encode($crear->ctrCrearCliente($_POST));
            echo $res;
        }
        /*--===============================================
        READ DATOS TABLA MEDIDAS
        =================================================*/
        if(isset($_POST["id"]) && $_POST["modal"]==="leerMedidas"){
            $medidas= new ControladorClientes();
            $res=json_encode($medidas->ctrReadMedidas($_POST));
            echo $res;
        }
        /*--===============================================
        UPDATE CLIENTE
        =================================================*/
        if(isset($_POST["id"]) && $_POST["modal"]==="actualizar"){
            $actualizar= new ControladorClientes();
            $res=json_encode($actualizar->ctrActualizarCliente($_POST));
            echo $res;
        }

        /*--===============================================
        DELETE CLIENTE
        =================================================*/
        if(isset($_POST["id"]) && $_POST["modal"]==="eliminar"){
            $eliminar= new ControladorClientes();
            $res=$eliminar->ctrEliminarCliente($_POST["id"]);
            echo json_encode($res);
     
        }
    }