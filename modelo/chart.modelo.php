<?php
    require_once 'coneccion.php';
    class ModeloChart{
        public static function getCountTabla($tabla){
            $db=crearConeccion();
            $query="SELECT COUNT(*) FROM $tabla";
            $res=$db->query($query);
            return $res->fetch_column();
        }
        public static function mdlgetVentaWeek($val){
            $db=crearConeccion();
            $query="SELECT WEEKDAY(v.registro) as dia ,SUM(vp.precio*vp.cantidad) as total FROM ventas v 
            JOIN ventasproductos vp ON v.id=vp.ventas_id
            WHERE YEARWEEK(v.registro,1)=YEARWEEK(CURDATE(),1)-$val
            GROUP BY WEEKDAY(v.registro)";
            $res=$db->query($query);
            return $res->fetch_all(MYSQLI_ASSOC);
        }
        public static function mdlgetVentaYear($val){
            $db=crearConeccion();
            $query="SELECT MONTH(v.registro) as mes,SUM(vp.cantidad*vp.precio) as total FROM ventas v
            JOIN ventasproductos vp ON v.id=vp.ventas_id
            WHERE YEAR(v.registro)=YEAR(curdate())-$val
            GROUP BY mes";
            $res=$db->query($query);
            return $res->fetch_all(MYSQLI_ASSOC);
        }
        public static function mdlgetVentaTotalYear(){
            $db=crearConeccion();
            $query="SELECT SUM(vp.cantidad*vp.precio) as total FROM ventas v
            JOIN ventasproductos vp ON v.id=vp.ventas_id
            WHERE YEAR(v.registro)=YEAR(curdate())";
            $res=$db->query($query);
            return $res->fetch_column();
        }
        public static function mdlgetVentaTotalWeek(){
            $db=crearConeccion();
            $query="SELECT SUM(vp.cantidad*vp.precio) as total FROM ventas v
            JOIN ventasproductos vp ON v.id=vp.ventas_id
            WHERE YEARWEEK(v.registro,1)=YEARWEEK(curdate(),1)";
            $res=$db->query($query);
            return $res->fetch_column();
        }
        public static function mdlGetPercentWeek($val){
            $db=crearConeccion();
            $query="SELECT SUM(vp.cantidad*vp.precio) as total FROM ventas v
            JOIN ventasproductos vp ON v.id=vp.ventas_id
            WHERE YEARWEEK(v.registro,1)=YEARWEEK(curdate(),1)-$val
            AND WEEKDAY(v.registro)<WEEKDAY(curdate())";
            $total=$db->query($query);
            return $total->fetch_column();
        }
        public static function mdlGetPercentYear($val){
            $db=crearConeccion();
            $query="SELECT SUM(vp.cantidad*vp.precio) as total FROM ventas v
            JOIN ventasproductos vp ON v.id=vp.ventas_id
            WHERE YEAR(v.registro)=YEAR(curdate())-$val
            AND MONTH(v.registro)<MONTH(curdate())";
            $total=$db->query($query);
            return $total->fetch_column();
        }
    }