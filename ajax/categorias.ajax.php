<?php
    require_once '../controlador/categorias.controlador.php';
    require_once '../modelo/categorias.modelo.php';
    class CategoriasAjax{
        /*--===============================================
        LLENAR DATOS DE TABLA
        =================================================*/
        public static function ajaxDatosTabla(){
            $tabla=ControladorCategorias::ctrDatosTabla();
            return $tabla;
        }
        /*--===============================================
        LLENAR DATOS DE MODAL ACTUALIZAR
        =================================================*/    
        public static function ajaxModalActualizar($id){
            return ControladorCategorias::getCtrModalActualizar($id);
        }
        /*--===============================================
        ELIMINAR USUARIO
        =================================================*/
        public static function ajaxEliminarUsuario($id){
            ControladorCategorias::ctrEliminarCategorias($id);
        }

    }
   /*--===============================================
   LLENAR DATOS DE MODAL ACTUALIZAR METODO POST
   =================================================*/
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $_POST=json_decode(file_get_contents('php://input'),true);
        /*--===============================================
        PARA ACTUALIZAR SE ENVIA POR FETCH EL ID
        =================================================*/
        if(isset($_POST["id"]) && $_POST["modal"]=="editar"){
            $id=$_POST["id"];
            $res= (new CategoriasAjax())->ajaxModalActualizar($id);
            echo json_encode($res);
        }
        /*--===============================================
        PARA ELIMINAR CATEGORIA 
        =================================================*/
        if(isset($_POST["id"]) && $_POST["modal"]=="eliminar"){
            $id=$_POST["id"];
            (new CategoriasAjax())->ajaxEliminarUsuario($id);
        }        
    }
    

    /*--===============================================
    LLENAR DATOS DE TABLA METODO GET
    =================================================*/
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        $tabla=(new CategoriasAjax())->ajaxDatosTabla();
        echo json_encode($tabla);
    }
    