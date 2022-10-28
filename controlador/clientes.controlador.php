<?php
    class ControladorClientes{
        public $errores=[];
        /*--===============================================
        READ DATOS TABLA PRINCIPAL
        =================================================*/
        public static function getCtrDataTable():array{
            return ModeloClientes::getMdlDataTable();
        }
        /*--===============================================
        READ MEDIDAS
        =================================================*/
        public static function ctrReadMedidas($post){
            if(isset($post["id"])){
                return ModeloClientes::mdlReadMedidas($post["id"]);
            }
        }
        /*--===============================================
        EXISTENCIA
        =================================================*/
        public static function getCtrIsset($tabla,$columna,$value){
            return ModeloClientes::getMdlIsset($tabla,$columna,$value);
        }
        /*--===============================================
        CREATE CLIENTE
        =================================================*/
        public function ctrCrearCliente($post){
            extract($post);
            #cliente
            #fecha_nacimiento
            #dni
            #celular

            #error de existencia
            if(!isset($cliente,$fecha_nacimiento,$dni,$celular)){
                $this->errores[]="Debe ingresar una cliente";
            }else{
                $cliente=trim($cliente);
                #error de tamaño cliente
                if(strlen($cliente)<2){
                    $this->errores[]="Debe ingresar un nombre de cliente mayor a 2 letras";
                }
            }
            ###si no hay errores
            if(!$this->errores){
                ##creamos el arreglo
                $nuevocliente=[
                    "cliente"=>$cliente,
                    "fecha_nacimiento"=>$fecha_nacimiento,
                    "dni"=>$dni,
                    "celular"=>$celular,
                ];
                ##eliminamos valores vacios
                $nuevocliente=array_filter($nuevocliente);
                ##obtenemos columnas y valores
                $columnas=implode(",",array_keys($nuevocliente));
                $valores=implode("','",array_values($nuevocliente));
                ##ejecutamos la bbdd
                return $res=Modeloclientes::mdlCrearcliente($columnas,$valores);
            }else{
                    return implode("<br>",$this->errores);
            }
        }

        /*--===============================================
        UPDATE CLIENTE
        =================================================*/
        public function ctrActualizarCliente($post){
                extract($post);
                #id
                #cliente
                #fecha_nacimiento
                #dni
                #celular

                #error de existencia
                if(!isset($id,$cliente,$fecha_nacimiento,$dni,$celular)){
                    $this->errores[]="Debe ingresar una cliente";
                }else{
                    #error de id
                    if(filter_var($id,FILTER_VALIDATE_INT)==false){
                        $this->errores[]="ID no valido";
                    }
                    $cliente=trim($cliente);
                    #error de tamaño cliente
                    if(strlen($cliente)<2){
                        $this->errores[]="Debe ingresar un nombre de cliente mayor a 2 letras";
                    }
                }
                ###si no hay errores
                if(!$this->errores){
            
                    ##creamos el arreglo
                    $nuevocliente=[
                        "id"=>$id,
                        "cliente"=>$cliente,
                        "fecha_nacimiento"=>$fecha_nacimiento,
                        "dni"=>$dni,
                        "celular"=>$celular,
                    ];
                    ##eliminamos valores vacios
                    $prod=array_filter($nuevocliente);
                    ##creamos el formato para el update $c1='v1',$c2='$v2'
                    function merge($key,$value){
                        return "$key='$value'";
                    }
                    $map=array_map("merge",array_keys($prod),array_values($prod));
                    $cadena=implode(",",$map);

                    ##ejecutamos la bbdd
                    return $res=Modeloclientes::mdlUpdateCliente($cadena,$id);
                   
                }else{
                    return $error=implode("<br>",$this->errores);
                } 
        }
        
        /*--===============================================
        DELETE CLIENTE
        =================================================*/
        public static function ctrEliminarCliente($id){
            if(filter_var($id,FILTER_VALIDATE_INT)){
                return ModeloClientes::mdlEliminarCliente($id);
            }else{
                return false;  
            }
        }
        /*--===============================================
        READ DATOS OPTOMETRAS
        =================================================*/
        public static function ctrReadOptometras(){
            return ModeloClientes::mdlReadOptometras();   
        }
    }
