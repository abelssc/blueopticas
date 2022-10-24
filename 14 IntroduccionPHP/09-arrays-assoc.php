<?php include 'includes/header.php';

//A LOS ARREGLOS TAMBIEN SE LES PUEDE PASAR TIPO OBJETOS
//LA DIFERENCIA ES Q YA NO VAN CON CORCHETES {} Y SU ASIGNACION
//NO ES CON : , SINO CON EL SIMBOLO DE FLECHA =>
$cliente=[
    "normal",
    'nombre'=>'Juan',
    'saldo'=>200,
    'informacion'=>[
        'tipo'=>'premium'
    ]
];
echo "<pre>";
var_dump($cliente);
echo"</pre>";

//LOS ARREGLOS ASOCIATIVOS "prop"=>"value", NO SE LLAMAN CON $arreglo[pos];
//SE LLAMAN INDICANDO SU PROPIEDAD $array[prop]
echo "<pre>";
echo $cliente[0];//LOS ARREGLOS NORMALES, SI SE PUEDE POR $arreglo[pos]
echo($cliente["nombre"]);
echo "<br>";
var_dump ($cliente["informacion"]); 
var_dump ($cliente["informacion"]["tipo"]);//PARA ACCEDER AL VALOR EN UN ARRAY DOBLE VOLVEMOS A USAR LOS CORCHETES
echo"</pre>";

//AGREGAR MAS PROPIEDADES AL ARREGLO
$cliente["nuevaProp"]="NuevoValor";//SI NO TIENE LA PROPIEDAD LA ARREGLA, SI LA TIENE, LA REESCRIBE
echo "<pre>";
var_dump($cliente);
echo "</pre>";

#EXTRACT() puedes exportar un arreglo asociativo a variables
$array = [
    'clothes' => 't-shirt',
    'size'    => 'medium',
    'color'   => 'blue',
];
 
extract($array);
 
echo("$clothes $size $color"); // t-shirt medium blue

include 'includes/footer.php';