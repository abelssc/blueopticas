<?php
    require_once 'coneccion.php';
    class ModeloPagos{

        public static function mdlgetPagos(){
            $db=crearConeccion();

            $query="SELECT pv.id,v.id as orden,u.usuario,c.cliente,preciototal,pv.fecha,pv.monto,tipodepago from ventas v 
            JOIN clientes c ON v.clientes_id=c.id
            JOIN usuarios u ON v.usuarios_id=u.id
            JOIN pagosventas pv ON pv.ventas_id=v.id
            JOIN tipodepagos tp ON tp.id=pv.pagos_id
            JOIN (SELECT vp.ventas_id, SUM(vp.cantidad*vp.precio) as preciototal FROM ventasproductos vp GROUP BY vp.ventas_id) preciototal ON v.id=preciototal.ventas_id";

            $res=$db->query($query);
            return $res->fetch_all(MYSQLI_ASSOC);
        }

        public static function mdlgetInfoDeuda($orden){
            $db=crearConeccion();
            $query="SELECT c.cliente,acuenta,preciototal,(preciototal-acuenta) as debe from ventas v 
            JOIN clientes c ON v.clientes_id=c.id
            JOIN (SELECT pv.ventas_id, SUM(pv.monto) as acuenta FROM pagosventas pv GROUP BY pv.ventas_id) pagos ON v.id=pagos.ventas_id
            JOIN (SELECT vp.ventas_id, SUM(vp.cantidad*vp.precio) as preciototal FROM ventasproductos vp GROUP BY vp.ventas_id) preciototal ON v.id=preciototal.ventas_id
            WHERE pagos.ventas_id=$orden";
            $res=$db->query($query);
            return $res->fetch_assoc();
        }
        public static function mdlgetInfoDeudaEdit($id){
            $db=crearConeccion();
            $query="SELECT pv.id,pv.ventas_id as orden,pv.pagos_id,pv.fecha,pv.monto,c.cliente,preciototal from ventas v 
            JOIN clientes c ON v.clientes_id=c.id
            JOIN pagosventas pv ON pv.ventas_id=v.id
            JOIN tipodepagos tp ON tp.id=pv.pagos_id
            JOIN (SELECT vp.ventas_id, SUM(vp.cantidad*vp.precio) as preciototal FROM ventasproductos vp GROUP BY vp.ventas_id) preciototal ON v.id=preciototal.ventas_id
            WHERE pv.id='$id'";
            $res=$db->query($query);
            return $res->fetch_assoc();
        }
        public static function mdlsetPago($col,$val){
            $db=crearConeccion();
            $query="INSERT INTO pagosventas($col) VALUES ('$val')";
            $db->query($query);
        }
        public static function mdlupdatePago($cadena,$id){
            $db=crearConeccion();
            $query="UPDATE pagosventas SET $cadena WHERE id='$id'";
            $db->query($query);
        }
        public static function mdldeletePago($id){
            $db=crearConeccion();
            $query="DELETE FROM pagosventas WHERE id='$id'";
            $db->query($query); 
        }
    }