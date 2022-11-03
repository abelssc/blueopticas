<?php
    class ControladorVentas{
        public static function ctrReadProductos(){
            return ModeloVentas::mdlReadProductos();
        }
        public static function ctrgetTiposdePago(){
            return ModeloVentas::mdlgetTiposdePago();
        }
        public static function ctrReadClientes($q){
            return ModeloVentas::mdlReadClientes($q);
        }
        public static function ctrgetIdVenta(){
            return ModeloVentas::mdlgetIdVenta();
        }
        public static function ctrgetTiposSituacion(){
            return ModeloVentas::mdlgetTiposSituacion();
        }
        public static function ctrsetVenta(object $ventas,object $pagosventas,array $ventasproductos){
            #obtenemos un arreglo asociativo del objeto ventas
            $ventas=get_object_vars($ventas);
            #filtramos los valores vacios
            $ventas=array_filter($ventas);//si fecha="" debemos quitarla xq mysql no entiende fecha =""
            #obtenemos columnas
            $colventas=implode(",",array_keys($ventas));
            #obtenemos valores
            $valventas=implode("','",array_values($ventas));

            #obtenemos un arreglo asociativo del objeto pagosventas
            $pagosventas=get_object_vars($pagosventas);
            #filtramos los valores vacios
            // $pagosventas=array_filter($pagosventas);//En este caso como fecha es rquired en el for y el campo monto puede ser =0 , no necesitamos filtrarlo
            #obtenemos columnas
            $colpagosventas=implode(",",array_keys($pagosventas));
            #obtenemos valores
            $valpagosventas=implode("','",array_values($pagosventas));

            return ModeloVentas::mdlsetVenta($colventas,$valventas,$colpagosventas,$valpagosventas,$ventasproductos);
        }
        public static function ctrgetVentas(){
            
        }
    }