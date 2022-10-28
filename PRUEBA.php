<?php
    #CONTROLADORES
    require_once __DIR__."/controlador/categorias.controlador.php";
    require_once __DIR__."/controlador/clientes.controlador.php";
    require_once __DIR__."/controlador/plantilla.controlador.php";
    require_once __DIR__."/controlador/productos.controlador.php";
    require_once __DIR__."/controlador/usuarios.controlador.php";
    require_once __DIR__."/controlador/ventas.controlador.php";
    #MODELOS
    require_once __DIR__."/modelo/categorias.modelo.php";
    require_once __DIR__."/modelo/clientes.modelo.php";
    require_once __DIR__."/modelo/productos.modelo.php";
    require_once __DIR__."/modelo/usuarios.modelo.php";
    require_once __DIR__."/modelo/ventas.modelo.php";
    require_once __DIR__."/modelo/coneccion.php";
//     echo '<pre>';
//     echo '<pre>';
//     var_dump(ModeloClientes::getMdlDataTable());
//     echo '</pre>';
//     exit;
//     echo '</pre>';
//     exit;
//     //muestro el array numerico original
//     function getMdlIsset($tabla,$columna,$value):int{
//         $db=crearConeccion();
//         $query="SELECT * FROM $tabla WHERE $columna='$value'";
//         $res=$db->query($query);
//         return $res->num_rows;
//         $db->close();
//         $db=null;
//     }
//     $tabla="productos";
//     $columna="producto";
//     $value="blue";
//     $id=4;
//     $new="' and id='$id";
//     $v=$value;
//     $value=$value.''.$new;
//     var_dump($value);
//     var_dump("SELECT * FROM $tabla WHERE $columna='$value'");
//     var_dump(getMdlIsset($tabla,$columna,$value));
    
//     exit;
// //elimino el primer y segundo elemento del array y muestro el array
//     $producto="Algo";
//     $categoria="cat";
//     $stock="";
//     $preciocompra="";
//     $precioventa="";
//     $foto="asdasd";
//     $nuevoproducto=[
//         "producto"=>$producto,
//         "categorias_id"=>$categoria,
//         "stock"=>$stock,
//         "preciocompra"=>$preciocompra,
//         "precioventa"=>$precioventa,
//         "foto"=>$foto
//     ];
//     $new=array_filter($nuevoproducto);

//     function merge($key,$value){
//         return "$key='$value'";
//     };
//     $map=array_map("merge",array_keys($new),array_values($new));

//     var_dump($map);
//     var_dump(implode(",",$map));

//     echo '</pre>';
//     exit;

    $db=crearConeccion();
    $query="SELECT * FROM usuarios";
    $res=$db->query($query);
    var_dump($res);
    // return $res->fetch_assoc();
    echo '<pre>';
    var_dump($res->fetch_all(MYSQLI_ASSOC));
    echo '</pre>';
    exit;


