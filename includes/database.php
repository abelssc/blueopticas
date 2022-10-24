<?php
    define("host","localhost");
    define("usuario","root");
    define("password","");
    define("database","blueopticas");

    function crearConeccion(){
        try {
            $db=new mysqli(host,usuario,password,database);
            $db->set_charset("utf8");
            return $db;
        } catch (\Throwable $th) {
            echo "no se pudo crear coneccion $th";
            exit;
        }
    }
