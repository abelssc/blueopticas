<?php
class ControladorUsuarios{
    public $errores=[];
    public function ctrIngresoUsuario($user,$password){
        if(!isset($user,$password))
        $this->errores[]="Debe ingresar un usuario y contraseña";
        else if (!preg_match("/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$/",$user))
        $this->errores[]="Usuario incorrecto";

        if(!$this->errores){
            $res=ModeloUsuarios::MdlMostrarUsuarios($user);
            if($res->num_rows){
                $row=$res->fetch_assoc();
                if($row["estado"]=="0"){
                    $this->errores[]="Usuario inhabilitado, consulte al administrador";
                }else{
                    #verificamos password
                  if(password_verify($password,$row["password"])){
                    #iniciamos session
                    session_start();
                    #llenamos datos a la session
                    $_SESSION["login"]=true;
                    $_SESSION["id"]=$row["id"];
                    $_SESSION["nombre"]=$row["nombre"];
                    $_SESSION["usuario"]=$row["usuario"];
                    $_SESSION["rol"]=$row["rol"];
                    if($row["foto"]=="null"||$row["foto"]==""){
                      $_SESSION["foto"]='profile.png';
                    }else{
                      $_SESSION["foto"]=$row["foto"];
                    }
                    /*--===============================================
                    ASIGNAR ULTIMO LOGIN
                    =================================================*/
                    date_default_timezone_set('America/Lima');
                    $date=date('Y-m-d H:i:s');
                    ModeloUsuarios::MdlUpdateLastLogin($date,$row["id"]);
                    
                    #redireccionamos
                    header("location:/blueopticas");
                  }else{
                    $this->errores[]="Contraseña incorrecta";
                  }
                }
              }
              else{
                $this->errores[]="El usuario no existe";
              }
        }
    }
    public function errores(){
        return $this->errores;
    }

    public function ctrCrearUsuario(){
      if(isset($_POST["agregarUsuario"])){
        extract($_POST);
    
        $foto=$_FILES["foto"];
        #errores de existencia
        if(!isset($nombre,$usuario,$password,$rol,$foto)){
          $this->errores[]="Debe llenar los campos requeridos";
        }else{
          #errores de nombre
          if (!preg_match("/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/",$nombre))
          $this->errores[]="Nombre incorrecto";

          #errores de usuario
          else if (!preg_match("/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$/",$usuario))
          $this->errores[]="Usuario incorrecto";
          $usuarios=ModeloUsuarios::MdlMostrarUsuarios($usuario);
          if($usuarios->num_rows)
          $this->errores[]="Usuario existente";

          #errores de roles
          $roles=ModeloUsuarios::MdlMostrarRoles();
          $roles=$roles->fetch_all();
          $perfil=[];
          foreach ($roles as $r) {
          $perfil[]=$r[0];
          }
          if(!in_array($rol,$perfil))
          $this->errores[]="Rol Erroneo";

          #errores de img
          if(!empty($foto["name"])){
            $regImagen="/^image\/(webp|jpeg|png)$/";
            if(!preg_match($regImagen,$foto["type"]))
              $this->errores[]="El tipo de formato de no coincide con una imagen aceptada, webp,jpeg,jpg,png";
            else if($foto["size"]>5242880)
              $this->errores[]="La imagen sobrepasa las 5MB, minimizar el peso de la imagen";
            else if($foto["error"]===1)
              $this->errores[]="Surgio un error";
          }
          
          #si no hubo errores de comprobacion
          if(!$this->errores){
            #nombre
            #usuario
            #password
            $password=password_hash($password,PASSWORD_DEFAULT);
            #rol
            #foto-ornull
            if(!empty($foto["name"])){
              #creamos la carpeta
              $carpetaImagenes="vista/imagenesbd";
              if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
              }
             #creamos hash
             $foto=$this->crearHash($foto["tmp_name"]);
            }else{
              #si no se subio una img, conservamos la foto previa
              $foto="";
            }
            #guarda los datos
            $res=ModeloUsuarios::MdlCrearUsuarios($nombre,$usuario,$password,$rol,$foto);
            if($res){
              echo
              "
              <script>
              swal.fire(
                'Buen Trabajo!',
                'Se ingreso un nuevo Usuario!',
                'success'
              ).then(rs=>window.location='usuarios')
              </script>
              ";

            }else{
              echo
              "
              <script>
              swal.fire(
                'Surgio un Error',
                'No se logro registrar el nuevo usuario',
                'error'
              ).then(rs=>window.location='usuarios')
              </script>
              ";
            }
          }
        }

        if($this->errores){
        $error=implode("<br>",$this->errores);
        echo
          "
          <script>
          swal.fire(
            'Surgieron errores',
            '".$error."',
            'error'
          ).then(rs=>window.location='usuarios')
          </script>
          ";
        }
      }
    } 
    public function crearHash($foto){
      $carpetaImagenes='vista/imagenesbd';
      $hashImg=md5(uniqid(rand(),true)).".jpg";
      move_uploaded_file($foto,"$carpetaImagenes/$hashImg");
      return $hashImg;
    }
    static public function ctrMostrarUsuariosTabla(){
      return ModeloUsuarios::MdlMostrarUsuariosTabla();
    }
    static public function ctrMostrarDatosUsuario($id){
      return ModeloUsuarios::MdlMostrarDatosUsuario($id);
    }
    static public function ctrDropUser($id){

      $res= ModeloUsuarios::MdlDropUser($id);
      $carpetaImagenes=__DIR__.'/../vista/imagenesbd';
      if(!empty($res)){
        if(is_file($carpetaImagenes."/".$res)){            
            unlink($carpetaImagenes."/".$res);
        }
      }
    }

    public function ctrEditarUsuario(){
      if(isset($_POST["editarUsuario"])){

        // OBTENEMOS DATOS
        extract($_POST);
       
        #$editarUsuario
        #nombre
        #usuario
        #password-prevPassword
        #rol
        #estado
        #prevFoto
        #foto
        $estado??="0";#si el checkbox no es chekeado, el POST no recibe su value, por ello debemos especificarle alguno
        $foto=$_FILES["foto"];
    
        #errores de existencia
        if(!isset($nombre,$usuario,$password,$rol,$estado,$foto)){
          $this->errores[]="Debe llenar los campos requeridos";

        #errores de nombre
        }else if (!preg_match("/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/",$nombre))
          $this->errores[]="Nombre incorrecto";

        #errores de roles
        $roles=ModeloUsuarios::MdlMostrarRoles();
        $roles=$roles->fetch_all();
        $perfil=[];
        foreach ($roles as $r) {
          $perfil[]=$r[0];
        }
        if(!in_array($rol,$perfil))
          $this->errores[]="Rol Erroneo";

        #errores de estado
        if(!in_array($estado,["0","1"])){
          $this->errores[]="Estado no aceptado: $estado";
        }

        #errores de foto
        if(!empty($foto["name"])){
          $regImagen="/^image\/(webp|jpeg|png)$/";
           if(!preg_match($regImagen,$foto["type"]))
              $this->errores[]="El tipo de formato de no coincide con una imagen aceptada, webp,jpeg,jpg,png";
            else if($foto["size"]>20971520)
              $this->errores[]="La imagen sobrepasa las 20MB, minimizar el peso de la imagen";
            else if($foto["error"]===1)
              $this->errores[]="Surgio un error";
        }
        #si no hubo errores de comprobacion
        if(!$this->errores){
          #nombre
          #usuario
          #password-prevPassword
          if(empty($password)){
            $password=$prevPassword;
          }else{
            $password=password_hash($password,PASSWORD_DEFAULT);
          }
          #rol
          #estado
          #foto-prevFoto
          if(!empty($foto["name"])){
            #creamos la carpeta
            $carpetaImagenes="vista/imagenesbd";
            if(!is_dir($carpetaImagenes)){
              mkdir($carpetaImagenes);
            }
            #eliminamos la foto previa
            if(!empty($prevFoto)){
              unlink($carpetaImagenes."/".$prevFoto);
            }
            #creamos hash
            $foto=$this->crearHash($foto["tmp_name"]);
          }else{
            #si no se subio una img, conservamos la foto previa
            $foto=$prevFoto;
          }
          
          #GUARDAMOS LOS DATOS
          $tabla="usuarios";
          $datos=[
            "nombre"=>$nombre,
            "usuario"=>$usuario,
            "password"=>$password,
            "rol"=>$rol,
            "estado"=>$estado,
            "foto"=>$foto
          ];
          $res=ModeloUsuarios::MdlMostrarEditarUsuario($tabla,$datos);
          if($res){
            echo
              "
              <script>
              swal.fire(
                'Buen Trabajo!',
                'Se Edito el Usuario!',
                'success'
              ).then(rs=>window.location='usuarios')
              </script>
              ";

          }else{
            echo
              "
              <script>
              swal.fire(
                'Surgio un Error',
                'No se logro editar el usuario',
                'error'
              ).then(rs=>window.location='usuarios')
              </script>
              ";
          }

        }

        if($this->errores){
          $error=implode("<br>",$this->errores);
          echo
            "
            <script>
            swal.fire(
              'Surgieron errores',
              '".$error."',
              'error'
            ).then(rs=>window.location='usuarios')
            </script>
            ";
          }
      }
      
    } 
}