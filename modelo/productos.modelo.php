<?php
    require_once 'coneccion.php';
    class ModeloProductos{
        /*--===============================================
        GET ARREGLO DATOS TABLA PRINCIPAL
        =================================================*/
        public static function getMdlDataTable():array{
            $db=crearConeccion();
            $query="SELECT p.id,p.foto,producto,c.categoria,stock,preciocompra,precioventa,agregado FROM productos p JOIN categorias c WHERE p.categorias_id=c.id";
            $res=$db->query($query);
            return $res->fetch_all(MYSQLI_ASSOC);
        }
        /*--===============================================
        EXISTENCIA
        =================================================*/
        public static function getMdlIsset($tabla,$columna,$value):int{
            $db=crearConeccion();
            $query="SELECT * FROM $tabla WHERE $columna='$value'";
            $res=$db->query($query);
            return $res->num_rows;
            $db->close();
            $db=null;
        }
        /*--===============================================
        GET CATEGORIAS SELECT DEL PRODUCTO
        =================================================*/
        public static function getMdlCategorias(){
            $db=crearConeccion();
            $query="SELECT * FROM categorias";
            $res=$db->query($query);
            return $res;
            $db->close();
            $db=null;
        }
        /*--===============================================
        CREAR PRODUCTO
        =================================================*/
        public static function mdlCrearProducto($columnas,$valores){
            $db=crearConeccion();
            $query="INSERT INTO productos ($columnas) VALUES ('$valores')";
            return $db->query($query);
        }
        /*--===============================================
        GET FILA DATOS MODAL EDITAR
        =================================================*/
        public static function getMdlDataProduct($id){
            $db=crearConeccion();
            $query="SELECT * FROM productos WHERE id='$id'";
            $res=$db->query($query);
            return $res->fetch_assoc();
            $db->close();
            $db=null;
        }
        /*--===============================================
        SET FILA DATOS MODAL EDITAR
        =================================================*/
        public static function setMdlDataProduct($cadena,$id){
            $db=crearConeccion();
            $query="UPDATE productos SET $cadena WHERE id='$id'";
            return $db->query($query);
        }
        /*--===============================================
        ELIMINAR PRODUCTO
        =================================================*/
        public static function mdlEliminarProducto($id){
            $db=crearConeccion();
            $query="DELETE FROM productos WHERE id='$id'";
            return $db->query($query);
        }
    }