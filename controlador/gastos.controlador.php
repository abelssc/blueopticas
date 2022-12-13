<?php
    class ControladorGastos{
        public static function ctrgetGastos(){
            return ModeloGastos::mdlgetGastos();
        }
        public static function ctrgetGastosDia($date){
            return ModeloGastos::mdlgetGastosDia($date);
        }
        public static function ctrsetGasto($gasto){
            $gasto=array_filter($gasto);
            #obtenemos columnas
            $colgasto=implode(",",array_keys($gasto));
            #obtenemos valores
            $valgasto=implode("','",array_values($gasto));
            ModeloGastos::mdlsetGasto($colgasto,$valgasto);
        }
        public static function ctrgetInfoGasto($id){
            return ModeloGastos::mdlgetInfoGasto($id);
        }
        public static function ctrupdateGasto($gasto){
            $id=$gasto["id"];
            $gasto=array_filter($gasto);
            ##nos aseguramos que exista un pago de cero
            if(!isset($gasto["monto"])){
                $gasto["monto"]=0;
            }
             ##creamos el formato para el update $c1='v1',$c2='$v2'
             function merge($key,$value){
                return "$key='$value'";
            }
            $map=array_map("merge",array_keys($gasto),array_values($gasto));
            $cadena=implode(",",$map);

            ModeloGastos::mdlupdateGasto($cadena,$id);
        }
        public static function ctrdeleteGasto($id){
            ModeloGastos::mdldeleteGasto($id);
        }
    }