<?php
    declare(strict_types=1);
    require_once 'coneccion.php';

    class ModeloCategorias{
        /*--===============================================
        VERIFICAR EXISTENCIA
        =================================================*/
        public static function mdlIsset($columna,$value):bool{
            $db=crearConeccion();
            $res=$db->query("SELECT * FROM categorias WHERE $columna='$value'");
            if(empty($res->num_rows)){
                return false;
            }
            return true;
        }
        /*--===============================================
        CREAR CATEGORIA
        =================================================*/
        public static function mdlCrearCategoria(string $categoria){
            $db=crearConeccion();
            $query="INSERT INTO categorias (categoria) VALUES ('$categoria')";
            return $db->query($query);
            $db->close();
            $db=null;
        }
        /*--===============================================
        LLENAR DATOS TABLA
        =================================================*/
        public static function mdlDatosTabla(){
            $db=crearConeccion();
            $query="SELECT * FROM categorias";
            $res=$db->query($query);
            return $res->fetch_all(MYSQLI_ASSOC);
            $db->close();
            $db=null;
        }
        /*--===============================================
        ACTUALIZAR CATEGORIA
        =================================================*/
        public static function mdlActualizarCategoria($categoria,$id):bool{
            $db=crearConeccion();
            $query="UPDATE categorias SET categoria=? WHERE id=?";
            $stmt=$db->prepare($query);
            $stmt->bind_param("si",$categoria,$id);
            $boolean=$stmt->execute();
            return $boolean;
        }
        /*--===============================================
        LLENAR DATOS MODAL ACTUALIZAR
        =================================================*/
        public static function mdlModalActualizar($id){
            $db=crearConeccion();
            $query="SELECT * FROM categorias WHERE id='$id'";
            $res=$db->query($query);
            return $res->fetch_assoc();

        }
        /*--===============================================
        ELIMINAR CATEGORIAS
        =================================================*/
        public static function  mdlEliminarCategorias($id){
            $db=crearConeccion();
            $query="DELETE FROM categorias WHERE id='$id'";
            $res=$db->query($query);
        }
    }


