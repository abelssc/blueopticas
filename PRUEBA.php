<?php
    #CONTROLADORES
    require_once __DIR__."/controlador/categorias.controlador.php";
    require_once __DIR__."/controlador/clientes.controlador.php";
    require_once __DIR__."/controlador/plantilla.controlador.php";
    require_once __DIR__."/controlador/productos.controlador.php";
    require_once __DIR__."/controlador/usuarios.controlador.php";
    require_once __DIR__."/controlador/ventas.controlador.php";
    require_once __DIR__."/controlador/pagos.controlador.php";

    #MODELOS
    require_once __DIR__."/modelo/categorias.modelo.php";
    require_once __DIR__."/modelo/clientes.modelo.php";
    require_once __DIR__."/modelo/productos.modelo.php";
    require_once __DIR__."/modelo/usuarios.modelo.php";
    require_once __DIR__."/modelo/ventas.modelo.php";
    require_once __DIR__."/modelo/coneccion.php";
    require_once __DIR__."/modelo/pagos.modelo.php";
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

    // $db=crearConeccion();
    // $query="SELECT * FROM usuarios";
    // $res=$db->query($query);
    // var_dump($res);
    // // return $res->fetch_assoc();
    // echo '<pre>';
    // var_dump($res->fetch_all(MYSQLI_ASSOC));
    // echo '</pre>';
//     // exit;
// $db=crearConeccion();
// $query="INSERT INTO situaciones (situacion) VALUES ('v1000')";
// $db->query($query);
// $last_insert_id_venta=$db->insert_id;
// $query="INSERT INTO situaciones (situacion) VALUES ('$last_insert_id_venta')";
// $db->query($query);
// echo '<pre>';
// var_dump($last_insert_id_venta);
// echo '</pre>';
// var_dump($db->insert_id);

// $db=crearConeccion();
// // $query="SELECT * FROM tipodepagos";
// $query="INSERT INTO tipodepagos (tipodepago) VALUES ('pruebapago')";
// $rs=$db->query($query);
// echo '<pre>';
// var_dump($rs->fetch_field());
// echo '</pre>';
// exit;
// exit;

// $ventas=(object)[
//     "fecha_recojo"=>"2022-01-01",
//     "hora_recojo"=>"00:00",
//     "situacion_id"=>"0",
//     "usuarios_id"=>"15" 
// ];
// echo "<pre>";
// var_dump($ventas);
// echo "<pre>";
// var_dump($ventas->fecha_recojo);
// echo "<pre>";
// var_dump(array_filter(get_object_vars($ventas)));
// $ventas2=(object)[
//     "fecha_recojo"=>"2021-10-02",
//     "hora_recojo"=>"12:02",
//     "precio"=>"0",
//     "usuarios_id"=>"8"
// ];
// echo "<pre>";
// $listventas=[$ventas,$ventas2];
// var_dump($listventas);
// exit;
// $db=crearConeccion();
// $db->query("INSERT INTO clientes (cliente) VALUES ('CLIENTE DESDE PRUEBA v2')");
// $last_id=$db->insert_id;
// $stmt=$db->prepare("INSERT INTO ventas(fecha_recojo,hora_recojo,situacion_id,usuarios_id,clientes_id) VALUES (?,?,?,?,?)");
// foreach ($listventas as  $venta) {
//     $stmt->bind_param("ssiii",$venta->fecha_recojo,$venta->hora_recojo,$venta->situacion_id,$venta->usuarios_id,$last_id);
//     $stmt->execute();
// }
// $res=ControladorVentas::ctrgetVentas();
// $newres=array_map(function($r){
//     $r['situacion']="Situacion ";
//     return $r;
// },$res);

// $productos=ControladorVentas::ctrReadProductos();
// $newproductos=array_map(function($producto){
//     $producto['foto']="<img src='vista/imagenesbd/productos/".$producto["foto"]."' width='40px'>";
//     $producto['acciones']="<button class='btn btn-success btnAgregarProducto' data-id='".$producto['id']."'>Agregar</button>";
//     return $producto;
// },$productos);
$newres=ModeloPagos::mdlgetPagos();
echo '<pre>';
echo '<pre>';
echo '<pre>';
var_dump($newres);
echo '</pre>';
exit;


