<?php
require_once 'coneccion.php';
class ModeloUsuarios
{   
    static public function MdlMostrarUsuarios($user){
        $db=crearConeccion();
        #query
        $query="SELECT * FROM usuarios WHERE usuario='$user'";
        #respuesta
        return $db->query($query);
        #si el return no rompe el codigo, cierra la coneccion y vuelve null los valores obtenidos
        $db->close();
        $db=null;
    }
    static public function MdlCrearUsuarios($nombre,$usuario,$password,$rol,$foto){
        $db=crearConeccion();
        #query
        $query="INSERT INTO usuarios (nombre, usuario, password, rol,foto) VALUES ('$nombre','$usuario','$password','$rol','$foto')";
        #respuesta
        return $db->query($query);
        #si el return no rompe el codigo, cierra la coneccion y vuelve null los valores obtenidos
        $db->close();
        $db=null;
    }
    static public function MdlMostrarRoles(){
        $db=crearConeccion();
        #query
        $query="SELECT nombre_rol FROM rol";
        #respuesta
        return $db->query($query);
        #si el return no rompe el codigo, cierra la coneccion y vuelve null los valores obtenidos
        $db->close();
        $db=null;
    }
    static public function MdlMostrarUsuariosTabla(){
        $db=crearConeccion();
        #query
        $query="SELECT id,nombre,foto,usuario,rol,estado,ultimo_login FROM usuarios";
        $res=$db->query($query);
        return $res->fetch_all(MYSQLI_ASSOC);
        $db->close();
        $db=null;
    }
    static public function MdlMostrarDatosUsuario($id){
        $db=crearConeccion();
        $query="SELECT * FROM usuarios WHERE id='$id'";
        $res=$db->query($query);
        return $res->fetch_all(MYSQLI_ASSOC);
        $db->close();
        $db=null;
    }
    static public function MdlMostrarEditarUsuario($tabla,$datos){
        $db=crearConeccion();
        $query="UPDATE $tabla SET nombre=?,password=?,rol=?,estado=?,foto=?  WHERE usuario=?";
        $stmt=$db->prepare($query);
        $stmt->bind_param("ssssss",$datos["nombre"],$datos["password"],$datos["rol"],$datos["estado"],$datos["foto"],$datos["usuario"]);        
        return $stmt->execute();
        $db->close();
        $db=null;
    }
    public static function MdlUpdateLastLogin($fecha,$id){
        $db=crearConeccion();
        $query="UPDATE usuarios SET ultimo_login='$fecha' WHERE id=$id";
        $db->query($query);
        $db->close();
        $db=null;
    }
    public static function MdlDropUser($id){
        $db=crearConeccion();
        $query="SELECT foto FROM usuarios WHERE id=?";
        $stmt=$db->prepare($query);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $res=$stmt->get_result();
        $foto=$res->fetch_column();

        $query="DELETE FROM usuarios WHERE id=?";
        $stmt=$db->prepare($query);
        $stmt->bind_param('i',$id);
        $stmt->execute();

        return $foto;
        $db->close();
        $stmt->close();
        $db=null;
    }
}
