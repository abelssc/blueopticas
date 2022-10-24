<?php
    require_once '../controlador/usuarios.controlador.php';
    require_once '../modelo/usuarios.modelo.php';

    $_POST=json_decode(file_get_contents('php://input'),true);
    if(isset($_POST["id"])){
        $id=$_POST["id"];
        echo ControladorUsuarios::ctrDropUser($id);

    
    }