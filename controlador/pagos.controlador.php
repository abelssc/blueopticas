<?php
    class ControladorPagos{

        public static function ctrgetPagos(){
            return ModeloPagos::mdlgetPagos();
        }
        public static function ctrgetInfoDeuda($orden){
            return ModeloPagos::mdlgetInfoDeuda($orden);
        }
        public static function ctrgetInfoDeudaEdit($id){
            return ModeloPagos::mdlgetInfoDeudaEdit($id);
        }
        public static function ctrsetPago($pago){
            $pago=array_filter($pago);
            #obtenemos columnas
            $colpago=implode(",",array_keys($pago));
            #obtenemos valores
            $valpago=implode("','",array_values($pago));
            ModeloPagos::mdlsetPago($colpago,$valpago);
        }
        public static function ctrupdatePago($pago){
            $id=$pago["id"];
            $pago=array_filter($pago);
            ##nos aseguramos que exista un pago de cero
            if(!isset($pago["monto"])){
                $pago["monto"]=0;
            }
             ##creamos el formato para el update $c1='v1',$c2='$v2'
             function merge($key,$value){
                return "$key='$value'";
            }
            $map=array_map("merge",array_keys($pago),array_values($pago));
            $cadena=implode(",",$map);

            ModeloPagos::mdlupdatePago($cadena,$id);
        }
        public static function ctrdeletePago($id){
            ModeloPagos::mdldeletePago($id);
        }
    }