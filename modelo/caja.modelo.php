<?php
    require_once 'coneccion.php';
    class ModeloCaja{
        public static function totalAcuenta($date){
            $db=crearConeccion();
            $query="SELECT SUM(pv.monto) as acuenta FROM pagosventas pv
            JOIN ventas v ON pv.ventas_id=v.id
            WHERE v.registro='$date' and pv.fecha='$date'";
            $res=$db->query($query);
            return $res->fetch_column();
        }  
        public static function totalRecojos($date){
            $db=crearConeccion();
            $query="SELECT SUM(pv.monto) as acuenta FROM pagosventas pv
            JOIN ventas v ON pv.ventas_id=v.id
            WHERE v.registro<>'$date' and pv.fecha='$date'";
            $res=$db->query($query);
            return $res->fetch_column();
        } 
        public static function totalGastos($date){
            $db=crearConeccion();
            $query="SELECT SUM(monto) FROM gastos WHERE fecha='$date'";
            $res=$db->query($query);
            return $res->fetch_column();
        } 
        public static function totalEfectivo($date){
            $db=crearConeccion();
            $query="SELECT IFNULL(acuenta,0)-IFNULL(gasto,0) as efectivo
            FROM
                (SELECT SUM(monto) as acuenta FROM pagosventas pv 
                JOIN tipodepagos tp ON tp.id=pv.pagos_id
                WHERE fecha='$date' and tipodepago='efectivo') acuenta,
                (SELECT SUM(monto) as gasto FROM gastos g
                JOIN tipodepagos tp ON tp.id=g.tipopago_id
                WHERE fecha='$date' and tipodepago='efectivo') gasto";
            $res=$db->query($query);
            return $res->fetch_column();
        }
        public static function totalDeposito($date){
            $db=crearConeccion();
            $query="SELECT IFNULL(acuenta,0)-IFNULL(gasto,0) as deposito
            FROM
                (SELECT SUM(monto) as acuenta FROM pagosventas pv 
                JOIN tipodepagos tp ON tp.id=pv.pagos_id
                where fecha='$date' and tipodepago<>'efectivo') acuenta,
                (SELECT SUM(monto) as gasto FROM gastos g
                JOIN tipodepagos tp ON tp.id=g.tipopago_id
                WHERE fecha='$date' and tipodepago<>'efectivo') gasto;";
            $res=$db->query($query);
            return $res->fetch_column();

        }
        public static function ventasTotal($date){
            $db=crearConeccion();
            $query="SELECT SUM(preciototal) FROM ventas v
            JOIN (SELECT vp.ventas_id, SUM(vp.cantidad*vp.precio) as preciototal FROM ventasproductos vp GROUP BY vp.ventas_id) preciototal ON v.id=preciototal.ventas_id
            WHERE registro='$date'";
            $res=$db->query($query);
            return $res->fetch_column();
        }
    }