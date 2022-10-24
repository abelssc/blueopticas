<?php include 'includes/header.php';
$numero1=20;
$numero2=30;
$numero3=30;
$numero4="30";
//MAYOR
var_dump($numero1>$numero2);
echo "<br>";
//MENOR
var_dump($numero1<$numero2);
echo "<br>";
//MENOR IGUAL
var_dump($numero1<=$numero2);
echo "<br>";
//MAYOR IGUAL
var_dump($numero1>=$numero2);
echo "<br>";
//IGUAL
var_dump($numero2==$numero3);
echo "<br>";
//IGUAL.. TAMBIEN COMPARA SIN IMPORTAR EL TIPO DE DATO, COMO JS
//AQUI NOS DARIA TRUE
var_dump($numero3==$numero4);
echo "<br>";
//Y TAMBIEN HAY UN ESTRICTAMENTE IGUAL
//AQUI NOS DARIA FALSE
var_dump($numero3===$numero4);
echo "<br>";
//<=> ARRROJA 3 VALORES ENTEROS
// -1: SI EL NUMERO DE LA IZQUIERDA ES MENOR
// 1 : SI EL NUMERO DE LA IZQUIERDA ES MAYOR
// 0 :SI SON IGUALES 
var_dump($numero1<=>$numero2);//-1
echo "<br>";
var_dump($numero2<=>$numero3);//0
echo "<br>";
var_dump($numero2<=>$numero1);//1
echo "<br>";


include 'includes/footer.php';