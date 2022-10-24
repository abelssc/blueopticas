<?php
    require_once '../controlador/usuarios.controlador.php';
    require_once '../modelo/usuarios.modelo.php';
    #EL METODO POST, Una matriz asociativa de variables pasadas al script actual a través del método HTTP POST cuando se usa application/x-www-form-urlencoded o multipart/form-data como HTTP Content-Type en la solicitud. No cuando se usa application/json
    #para obtener los datos de un json en post, se maneja la funcion file_get_contents('php://input')
    #estos datos son de tipo string json
    #aplicando json_decode, podemos volverlos un ObjtStdClass
    #y un true para obtenerlo como arreglo associativo
    #luego podemos asignar nuestro post al file_get,para seguir manipulandolo como siempre

    $_POST = json_decode(file_get_contents('php://input'),true);

    if(isset($_POST["id"])){
        $id=$_POST["id"];
        $res= ControladorUsuarios::ctrMostrarDatosUsuario($id);
        echo json_encode($res);

    }

?>
