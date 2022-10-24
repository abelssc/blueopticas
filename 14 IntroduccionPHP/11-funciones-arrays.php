<?php include 'includes/header.php';

$carrito=["tablet","computadora","tv"];

//in_array : busca elementos en un arreglo
var_dump(in_array("tablet",$carrito));//true
echo in_array("tablet",$carrito);//1:true - nada:falso 
var_dump(in_array("audifonos",$carrito));//false

//sort:ordenar 
$array=[5,4,9,2,1,3,7];

echo "<pre>";
sort(($array));//arreglo de menor a mayor
rsort($array);//ordena de mayor a menor
var_dump($array);
echo "</pre>";

//Ordenar arreglo asociativo
$cliente=[
    "nombre"=>"abel",
    "saldo"=>200,
    "tipo"=>"premium"
];
echo "<pre>";
asort($cliente);//ordena las valores(=>) en orden.. primero numeros, luego letras, en orden alfabetico
arsort($cliente);//ordena los valores (=>), primero las letras Z-A, luego los numeros
ksort($cliente);//ordena las propiedades en orden alfabetico
krsort($cliente);//ordena las propiedades en orden alfabetico al revez, de la Z a la A
var_dump($cliente);
echo "</pre>";


include 'includes/footer.php';