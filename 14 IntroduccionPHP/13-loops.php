<?php include 'includes/header.php';

//EN PHP EXISTEN 4 BUCLES
/*
while-se ejecuta si cumple la condicion
    while(){
        //codigo
    }
    while():
        //codigo
    endwhile
do while-se ejecuta y luego verifica si cumple la condicion
    do{

    }while();
for-se ejecuta en un rango asignado
    for(){
        codigo
    }
    for():
        //codigo
    endfor
for each-se ejecuta por cada elem, en un array
    foreach(){
        //codigo
    }
    foreach():
        //codigo
    endforeach
*/


//WHILE
$i = 1;
while ($i < 10) {
    echo $i++;
}
// 123456789
//DO WHILE
echo "<br>";
$i = 20;
do {
    echo $i++;
} while ($i < 10);
// 20

//FOR
echo "<br>";
for ($i = 0; $i < 10; $i++/*$i-- || $i+=2 || $i-=$a*/) {
    echo "$i \n";
}
// 0
// 1
// 2
// 3
// 4
// 5
// 6
// 7
// 8
// 9

include 'includes/footer.php';