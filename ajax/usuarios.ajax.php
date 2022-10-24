<?php
    
    require_once '../controlador/usuarios.controlador.php';
    require_once '../modelo/usuarios.modelo.php';
    class AjaxUsuarios{

        static public function ajaxMostrarUsuariosTabla(){
            $arrayUsuarios=ControladorUsuarios::ctrMostrarUsuariosTabla();
            echo json_encode($arrayUsuarios);
        }
    }
    $mostrar=new AjaxUsuarios();
    $mostrar->ajaxMostrarUsuariosTabla();

?>