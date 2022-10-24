<?php
declare(strict_types=1);//PARTE 4
include 'includes/header.php';

//1.funcion simple
function sumar(){
    echo 2+2;
}
sumar();
//4

//2.funcion simple con parametro
function sumar2($num1,$num2){
    echo $num1+$num2;
}
sumar2(3,4);
//7

//3.funcion simple con parametro default
function sumar3($num1=0,$num2=5){
    echo $num1+$num2;
}
sumar3(3);
//8

//4.funcion con tipado fuerte-disponible desde la v.7 de php
//declare(strict_types=1);enciende los tipo de datos estrictos
//declare strict_types: avisa si esta ingresando un tipo de dato incorrecto
//debe ser llamado al inicio del script

function sumar4(int $num1=0,int $num2=1){
    echo $num1+$num2;
}
sumar4(5,8);
//13
#TIPOS DE DATOS
#string
#int
#float
#bool
#array
#callable,self,

//5. FUNCION ANONIMA
function(){
    echo "soy anonima";
};
//6. FUNCION ANONIMA AUTOEJECUTABLE
(function(){
    echo "soy anonima autoejecutable";
})();
include 'includes/footer.php';