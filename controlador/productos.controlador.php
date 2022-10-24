<?php
    class ControladorProductos{
        public $errores=[];
        /*--===============================================
        GET ARREGLO DATOS TABLA PRINCIPAL
        =================================================*/
        public static function getCtrDataTable():array{
            return ModeloProductos::getMdlDataTable();
        }
        /*--===============================================
        EXISTENCIA
        =================================================*/
        public static function getCtrIsset($tabla,$columna,$value){
            return ModeloProductos::getMdlIsset($tabla,$columna,$value);
        }
        /*--===============================================
        CREAR DIR Y HASH
        =================================================*/
        public static function ctrCrearDirHash(string $foto,$prevFoto):string{
            $carpetaImagenes="vista/imagenesbd/productos";
            if(!is_dir($carpetaImagenes))
                mkdir($carpetaImagenes);
            if(!empty($prevFoto)){
                unlink($carpetaImagenes."/".$prevFoto);
            }
            $hashImg=md5(uniqid(rand(),true)).".jpg";
            move_uploaded_file($foto,"$carpetaImagenes/$hashImg");
            return $hashImg;
        }
        /*--===============================================
        GET FILA DATOS MODAL EDITAR
        =================================================*/
        public static function getCtrDataProduct($id){
            return ModeloProductos::getMdlDataProduct($id);
        }
        /*--===============================================
        CREAR PRODUCTO
        =================================================*/
        public function ctrCrearProducto(){
            if(isset($_POST["agregarProducto"])){
                extract($_POST);
                #producto
                #categoria-categoria_id
                #stock
                #preciocompra
                #precioventa
                #foto
                $foto=$_FILES["foto"];

                #error de existencia
                if(!isset($producto,$categoria,$stock,$preciocompra,$precioventa)){
                    $this->errores[]="Debe ingresar una producto";
                }else{
                    $producto=trim($producto);
                    #error de tamaño producto
                    if(strlen($producto)<2){
                        $this->errores[]="Debe ingresar un nombre de producto mayor a 2 letras";
                    }
                    #error de existencia producto
                    if($this->getCtrIsset("productos","producto",$producto)){
                        $this->errores[]="producto Existente";
                    }
                    #error de no existencia categoria
                    if(!$this->getCtrIsset("categorias","id",$categoria)){
                        $this->errores[]="Categoria Inexistente";
                    }
                    #error stock
                    if(!preg_match("/^[0-9]*$/",$stock)){
                        $this->errores[]="Stock Solo recibe numeros enteros";
                    }
                    #error precioventa
                    if(!preg_match("/^\d*(\.\d{0,2})?$/",$precioventa)){
                        $this->errores[]="El Precio de venta puede tener hasta 2 decimales";
                    }
                    #error preciocompra
                    if(!preg_match("/^\d*(\.\d{0,2})?$/",$preciocompra)){
                        $this->errores[]="El Precio de compra puede tener hasta 2 decimales";
                    }
                    #error foto
                    if(!empty($foto["name"])){
                        $regImagen="/^image\/(webp|jpeg|png)$/";
                        if(!preg_match($regImagen,$foto["type"]))
                          $this->errores[]="El tipo de formato de no coincide con una imagen aceptada, webp,jpeg,jpg,png";
                        else if($foto["size"]>5242880)
                          $this->errores[]="La imagen sobrepasa las 5MB, minimizar el peso de la imagen";
                        else if($foto["error"]===1)
                          $this->errores[]="Surgio un error";
                    }
                  

                    ###si no hay errores
                    if(!$this->errores){
                        ##creamos el dir y hash
                        if(!empty($foto["name"])){
                            $foto=ControladorProductos::ctrCrearDirHash($foto["tmp_name"]);
                        }else{
                            $foto="";
                        }

                        ##creamos el arreglo
                        $nuevoproducto=[
                            "producto"=>$producto,
                            "categorias_id"=>$categoria,
                            "stock"=>$stock,
                            "preciocompra"=>$preciocompra,
                            "precioventa"=>$precioventa,
                            "foto"=>$foto
                        ];
                        ##eliminamos valores vacios
                        $nuevoproducto=array_filter($nuevoproducto);
                        ##obtenemos columnas y valores
                        $columnas=implode(",",array_keys($nuevoproducto));
                        $valores=implode("','",array_values($nuevoproducto));
                        ##ejecutamos la bbdd
                        $res=Modeloproductos::mdlCrearproducto($columnas,$valores);
                        if($res){
                            echo
                              "
                              <script>
                              swal.fire(
                                'Buen Trabajo!',
                                'Se Registro la producto!',
                                'success'
                              )
                              </script>
                              ";
                          }else{
                            echo
                              "
                              <script>
                              swal.fire(
                                'Surgio un Error',
                                'No se logro registrar la producto',
                                'error'
                              ).then(rs=>window.location='productos')
                              </script>
                              ";
                          }
                    }else{
                        $error=implode("<br>",$this->errores);
                        echo
                          "
                          <script>
                          swal.fire(
                            'Surgieron errores',
                            '".$error."',
                            'error'
                          ).then(rs=>window.location='productos')
                          </script>
                          ";
                    }
                }
                
            }
        }
        /*--===============================================
        ACTUALIZAR PRODUCTO
        =================================================*/
        public function ctrActualizarProducto(){
            if(isset($_POST["editarProducto"])){
                extract($_POST);
                #id
                #producto
                #categoria-categoria_id
                #stock
                #preciocompra
                #precioventa
                #foto
                #prevFoto
                $foto=$_FILES["foto"];

                #error de existencia
                if(!isset($id,$producto,$categoria,$stock,$preciocompra,$precioventa)){
                    $this->errores[]="Debe ingresar una producto";
                }else{
                    #error de id
                    if(filter_var($id,FILTER_VALIDATE_INT)==false){
                        $this->errores[]="ID no valido";
                    }
                    $producto=trim($producto);
                    #error de tamaño producto
                    if(strlen($producto)<2){
                        $this->errores[]="Debe ingresar un nombre de producto mayor a 2 letras";
                    }
                    #error de existencia producto se debe comprobar adicional con un id
                    #hackearemos la tercera columna del getCtrIsste
                    $str="' and id<>'$id";
                    $record=$producto;
                    $producto=$producto.''.$str;
                    if($this->getCtrIsset("productos","producto",$producto)){
                        $this->errores[]="producto Existente";
                    }
                    $producto=$record;
                    unset($record);
                    #error de no existencia categoria
                    if(!$this->getCtrIsset("categorias","id",$categoria)){
                        $this->errores[]="Categoria Inexistente";
                    }
                    #error stock
                    if(!preg_match("/^[0-9]*$/",$stock)){
                        $this->errores[]="Stock Solo recibe numeros enteros";
                    }
                    #error precioventa
                    if(!preg_match("/^\d*(\.\d{0,2})?$/",$precioventa)){
                        $this->errores[]="El Precio de venta puede tener hasta 2 decimales";
                    }
                    #error preciocompra
                    if(!preg_match("/^\d*(\.\d{0,2})?$/",$preciocompra)){
                        $this->errores[]="El Precio de compra puede tener hasta 2 decimales";
                    }
                    #error foto
                    if(!empty($foto["name"])){
                        $regImagen="/^image\/(webp|jpeg|png)$/";
                        if(!preg_match($regImagen,$foto["type"]))
                          $this->errores[]="El tipo de formato de no coincide con una imagen aceptada, webp,jpeg,jpg,png";
                        else if($foto["size"]>5242880)
                          $this->errores[]="La imagen sobrepasa las 5MB, minimizar el peso de la imagen";
                        else if($foto["error"]===1)
                          $this->errores[]="Surgio un error";
                    }
                  

                    ###si no hay errores
                    if(!$this->errores){
                        ##creamos el dir y hash y drop
                        if(!empty($foto["name"])){
                            $foto=ControladorProductos::ctrCrearDirHash($foto["tmp_name"],$prevFoto);
                        }else{
                            $foto=$prevFoto;
                        }

                        ##creamos el arreglo
                        $nuevoproducto=[
                            "producto"=>$producto,
                            "categorias_id"=>$categoria,
                            "stock"=>$stock,
                            "preciocompra"=>$preciocompra,
                            "precioventa"=>$precioventa,
                            "foto"=>$foto
                        ];
                        ##eliminamos valores vacios
                        $prod=array_filter($nuevoproducto);
                        ##creamos el formato para el update $c1='v1',$c2='$v2'
                        function merge($key,$value){
                            return "$key='$value'";
                        }
                        $map=array_map("merge",array_keys($prod),array_values($prod));
                        $cadena=implode(",",$map);

                        ##ejecutamos la bbdd
                        $res=Modeloproductos::setMdlDataProduct($cadena,$id);
                        if($res){
                            echo
                              "
                              <script>
                              swal.fire(
                                'Se Actualizo el producto!',
                                ''
                                ,
                                'success'
                              )
                              </script>
                              ";
                          }else{
                            echo
                              "
                              <script>
                              swal.fire(
                                'Surgio un Error',
                                'No se logro registrar el producto',
                                'error'
                              ).then(rs=>window.location='productos')
                              </script>
                              ";
                          }
                    }else{
                        $error=implode("<br>",$this->errores);
                        echo
                          "
                          <script>
                          swal.fire(
                            'Surgieron errores',
                            '".$error."',
                            'error'
                          ).then(rs=>window.location='productos')
                          </script>
                          ";
                    }
                }
                
            }
        }
        /*--===============================================
        ELIMINAR PRODUCTO
        =================================================*/
        public static function ctrEliminarProducto($id){
            if(filter_var($id,FILTER_VALIDATE_INT)){
                return ModeloProductos::mdlEliminarProducto($id);
            }else{
                return false;  
            }
        }

    }
