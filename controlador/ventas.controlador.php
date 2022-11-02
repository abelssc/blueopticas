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
    }