<?php include 'includes/header.php';
//EN INCREMENTOS USAMOS ++
$numero1=30;
$numero1++;
echo $numero1;//31

//EN DECREMENTOS USAMOS --
$numero1=30;
$numero1--;
echo $numero1;//29

//DATO IMPORTANTE: ECHO PRIMERO IMPRIME EL VALOR DE LA VARIABLE
// Y LUEGO RECIEN OPERA EL NUMERO!!!

$numero1=30;
echo $numero1++;//30

//SI QUEREMOS Q ECHO IMPRIMA EL VALOR OPERADO ENTONCES
//CAMBIAMOS DE POSICION LOS OPERADORES
$numero1=30;
echo ++$numero1;//31
$numero1=30;
echo --$numero1;//29

//PARA INCREMENTAR O DECREMENTAR VALORES MAS ALTOS USAMOS:
$numero1=30; 
$numero1+=10;
echo $numero1;//40
$numero1=30; 
$numero1-=10;
echo $numero1;//20

include 'includes/footer.php';