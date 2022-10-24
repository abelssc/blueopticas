<?php include 'includes/header.php';

$nombre_cliente="Abel Anthony";
//LENGTH
echo strlen($nombre_cliente);//12
var_dump($nombre_cliente);
echo "<br>";
//ELIMINAR ESPACIOS EN BLANCO
$nombre_cliente="                Abel Anthony               ";
$texto=trim($nombre_cliente);//"Abel Anthony"
echo "<br>";
echo $texto;//Abel Anthony
echo "<br>";
echo strlen($texto);//12
echo "<br>";
//UPPERCASE
$nombre_cliente="Abel Anthony";
echo strtoupper($nombre_cliente);
//LOWERCASE
echo "<br>";
$nombre_cliente="Abel Anthony";
echo strtolower($nombre_cliente);

//COMPARAR STRINGS
echo "<br>";
$mail1="correo@correo.com";
$mail2="Correo@correo.com";
var_dump(strtolower($mail1)==strtolower($mail2));

//REPLACE str_replace(strOld,strNew,strobjetivo)
echo "<br>";
$nombre_cliente="Abel Anthony";
echo str_replace("Abel","Abed",$nombre_cliente);

//REVISAR SI EXISTE UN STRING-DEVUELVE LA POSICION DE LA PRIMERA COINCIDENCIA
//SI DEVUELVE CERO, NO EXISTE COINCIDENCIA
echo "<br>";
$nombre_cliente="Abel Anthony";
echo strpos($nombre_cliente,"Anthony");
echo "<br>";
//CONCATENACION, SE CONTATENA CON PUNTO, O SE UTILIZA COMILLA DOBLE ""+ ${} COMO TEMPLATE STRING
$tipoCliente="premium";
echo "El cliente " . $nombre_cliente . " Es " . $tipoCliente;
echo "<br>"; 
echo "El cliente ${nombre_cliente} es ${tipoCliente}";


//contiene este texto, este otro texto?
/*if (str_contains('La duda es uno de los nombres de la inteligencia', 'duda')) {
    // Entra
}*/

/*inicia este texto, con este texto?
if (str_starts_with('La duda es uno de los nombres de la inteligencia', 'La duda es')) {
    // Entra
}
*/
/*finaliza este texto con este otro texo?
 if (str_end_with('La duda es uno de los nombres de la inteligencia', 'inteligencia')) {
    // Entra
}
 */
include 'includes/footer.php';