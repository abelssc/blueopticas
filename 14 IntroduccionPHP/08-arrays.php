<?php include 'includes/header.php';

//FORMA 1. DE CREAR UN ARREGLO
$arreglo=[];
//FORMA 2.
$arrego=array();
//FORMA 3. range($inicio,$fin[,$paso]) crea un array de numeros, con inicio final y su paso
$inicio=1;
$fin=10;
$paso=1;
var_dump(range($inicio,$fin,$paso));

//SE IMPRIME CON VAR_DUMP, NO FUNCIONA EL ECHO $NOMBRE.. AQUI
$arreglo=['Tablet','Tv','Pc'];
echo "<pre>";//SIRVE PARA REALIZAR SALTOS DE LINEA CADA VEZ Q SE INVOCA UN ELEM DEL ARREGLO
var_dump($arreglo);
echo "</pre>";

//ACCEDER AL INDICE
var_dump($arreglo[0]); 
echo $arreglo[0]; //echo si imprime un valor, no varios

//AÑADIR ELEMENTO A LA POS ESPECIFICA
$arreglo[3]="Nuevo producto";
//AÑADIR UN ELEMENTO A LA ULT. POS
array_push($arreglo,'Audifonos');
$arreglo[]="ultimo";//añade un elemento. a la ultima pos
//AÑADIR UN ELEMENTO A LA PRIM. POS
array_unshift($arreglo,'SmartWathc');

echo "<pre>";
var_dump($arreglo);
echo "</pre>";

// array_merge : sirve para crear un nuevo array a partir de otro...similar a la  destructuracion
$planetas = ['Marte', 'Tierra', 'Venus'];
// Añadimos 'Mercurio'
$nuevosPlanetas = array_merge($planetas, ['Mercurio']);
echo "<pre>";
var_dump($nuevosPlanetas);

echo "</pre>";
//count - devuelve el length de un array
echo count($planetas);

//unset - elimina un elemento de un arrray... pero no rellena el campo reduciendo el tamaño de los indices
unset($planetas[1]);
var_dump($planetas);
/*
array(2) {
  [0] =>
  string(5) "Marte"
  [2] =>
  string(5) "Venus"
}
*/

//crear un array a partir de un string
//preg_split(condicion,array)
$frase = 'En un lugar de la mancha';
$arrayDeFrase = preg_split('/[\s,]+/', $frase);
echo $arrayDeFrase[2];
// Lugar
var_dump($arrayDeFrase);
/*
array(6) {
  [0] =>
  string(2) "En"
  [1] =>
  string(2) "un"
  [2] =>
  string(5) "lugar"
  [3] =>
  string(2) "de"
  [4] =>
  string(2) "la"
  [5] =>
  string(6) "mancha"
}
*/

#LIST asignar variables de una manera corta. 
// define array
$array = ['a', 'b', 'c'];
list($a, $b, $c) = $array;

include 'includes/footer.php';