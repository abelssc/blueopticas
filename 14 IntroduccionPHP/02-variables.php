<?php include 'includes/header.php';

$nombre="Abel";
$nombre="Abel2";//LAS VARIABLES PHP SE PUEDEN REASIGNAR SU VALOR.. FUNCIONA COMO LET
echo $nombre; //PARA IMPRIMIR UNA VARIABLE
var_dump($nombre);//PARA MOSTRAR EL TIPO DE DATO, SU LENGTH Y SU VALOR
define('constante','Este es el valor de la constante');//DEFINE(nombreVariable,value)PARA DEFINIR CONSTANTES SE UTILIZA LA FX DEFINE
echo constante;//SE IMPRIME SIN EL DOLAR
var_dump(constante);

const constante2="HOla2";//tambien podemos definir constantes de esta manera, pero mas se usa con la fx define()
echo constante2;

$nombre_cliente="Pedro";
echo($nombre_cliente);


include 'includes/footer.php';