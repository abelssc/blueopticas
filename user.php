<?php 
     require_once __DIR__."/modelo/coneccion.php";

     $db=crearConeccion();
     $password=password_hash("admin",PASSWORD_DEFAULT);
     $query="INSERT INTO usuarios (nombre, usuario,password,rol) 
     VALUES ('Administrador', 'admin', '$password','Administrador')";
     $db->query($query);
     echo '<pre>';
     var_dump($db->insert_id);
     echo '</pre>';
     exit;