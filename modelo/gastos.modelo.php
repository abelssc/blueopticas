<?php
    require_once 'coneccion.php';
    class ModeloGastos{
        public static function mdlGetGastos(){
            $db=crearConeccion();
            $query="SELECT g.id, monto, descripcion, tipopago_id, fecha,tipodepago FROM gastos g JOIN tipodepagos tp ON g.tipopago_id=tp.id";
            $res=$db->query($query);
            return $res->fetch_all(MYSQLI_ASSOC);
        }
        public static function mdlgetGastosDia($date){
            $db=crearConeccion();
            $query="SELECT g.id, monto, descripcion, tipopago_id, fecha,tipodepago FROM gastos g JOIN tipodepagos tp ON g.tipopago_id=tp.id WHERE fecha='$date'";
            $res=$db->query($query);
            return $res->fetch_all(MYSQLI_ASSOC);
        }
        public static function mdlsetGasto($col,$val){
            $db=crearConeccion();
            $query="INSERT INTO gastos($col) VALUES ('$val')";
            $db->query($query);
        }
        public static function mdlgetInfoGasto($id){
            $db=crearConeccion();
            $query="SELECT * FROM gastos WHERE id='$id'";
            $res=$db->query($query);
            return $res->fetch_assoc();
        }
        public static function mdlupdateGasto($cadena,$id){
            $db=crearConeccion();
            $query="UPDATE gastos SET $cadena WHERE id='$id'";
            $db->query($query);
        }
        public static function mdldeleteGasto($id){
            $db=crearConeccion();
            $query="DELETE FROM gastos WHERE id='$id'";
            $db->query($query); 
        }
    }