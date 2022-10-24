<?php
declare(strict_types=1);
    class ControladorCategorias{
        public $errores=[];
        /*--===============================================
        VERIFICAR EXISTENCIA DE COLUMNA
        =================================================*/
        
        public static function ctrIsset(string $columna,string $value):bool{
            return ModeloCategorias::mdlIsset($columna,$value);
        }
        /*--===============================================
        CREAR CATEGORIA
        =================================================*/
        public function ctrCrearCategoria(){
            if(isset($_POST["agregarCategoria"])){
                #error de existencia
                if(!isset($_POST["categoria"])){
                    $this->errores[]="Debe ingresar una categoria";
                }else{
                    $categoria=trim($_POST["categoria"]);
                    #error de tamaño
                    if(strlen($categoria)<2){
                        $this->errores[]="Debe ingresar un nombre de categoria mayor a 2 letras";
                    }
                    #error de existencia
                    if($this->ctrIsset("categoria",$categoria)){
                        $this->errores[]="Categoria Existente";
                    }
                    ##si no hay errores
                    if(!$this->errores){
                        #insertamos en la bbdd
                        $res=ModeloCategorias::mdlCrearCategoria($categoria);
                        if($res){
                            echo
                              "
                              <script>
                              swal.fire(
                                'Buen Trabajo!',
                                'Se Registro la Categoria!',
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
                                'No se logro registrar la categoria',
                                'error'
                              ).then(rs=>window.location='categorias')
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
                          ).then(rs=>window.location='categorias')
                          </script>
                          ";
                    }
                }
                
            }
        }
        /*--===============================================
        LLENAR DATOS TABLA
        =================================================*/
        
        public static function ctrDatosTabla(){
            return ModeloCategorias::mdlDatosTabla();
        }
        /*--===============================================
        ACTUALIZAR CATEGORIA
        =================================================*/
        public function ctrEditarCategoria(){
   
            if(isset($_POST["editarCategoria"])){
                #error de existencia
                if(!isset($_POST["categoria"],$_POST["id"])){
                    $this->errores[]="Debe ingresar una categoria";
                    echo "<script>console.log('estamos en existencia')</script>";

                }else{
                    $categoria=trim($_POST["categoria"]);
                    $id=$_POST["id"];
                    #error de tamaño
                    if(strlen($categoria)<2){
                        $this->errores[]="Debe ingresar un nombre de categoria mayor a 2 letras";
                        echo "<script>console.log('estamos en tamaño')</script>";

                    }
                    #error de existencia categoria
                    if($this->ctrIsset("categoria",$categoria)){
                        $this->errores[]="Categoria Existente";
                        echo "<script>console.log('estamos en exist categ')</script>";

                    }
                    #error de existencia de id
                    if(!$this->ctrIsset("id",$id)){
                        $this->errores[]="Categoria Existente";
                        echo "<script>console.log('estamos en exits id')</script>";

                    }
                    ##si no hay errores
                    if(!$this->errores){
                        echo "<script>console.log('estamos en no error')</script>";

                        #insertamos en la bbdd
                        $res=ModeloCategorias::mdlActualizarCategoria($categoria,$id);
                        if($res){
                            echo
                              "
                              <script>
                              swal.fire(
                                'Buen Trabajo!',
                                'Se Actualizo la Categoria!',
                                'success'
                              ).then(rs=>window.location='categorias')
                              </script>
                              ";
                
                        }else{
                            echo
                              "
                              <script>
                              swal.fire(
                                'Surgio un Error',
                                'No se logro actualizar la categoria',
                                'error'
                              ).then(rs=>window.location='categorias')
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
                          ).then(rs=>window.location='categorias')
                          </script>
                          ";
                    }
                }
            }
        }
        /*--===============================================
        LLENAR DATOS MODAL ACTUALIZAR
        =================================================*/
        public static function getCtrModalActualizar($id){
            return ModeloCategorias::mdlModalActualizar($id);
            
        }
        /*--===============================================
        ELIMINAR CATEGORIAS
        =================================================*/
        public static function ctrEliminarCategorias($id){
            ModeloCategorias::mdlEliminarCategorias($id);
        }
    }

?>