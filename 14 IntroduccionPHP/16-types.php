<?php 
declare(strict_types=1);
include 'includes/header.php';

#TIPOS DE DATOS
#string
#int
#float
#bool
#array
#callable,self,

//7. FUNCIONES con RETURN 
function usuarioAutenticado(){
    return "El usuario esta autenticado";
}
$usuario=usuarioAutenticado();
echo $usuario;

//8. FUNCIONES CON RETURN Y TIPO DE DATO EXPLICITO, se debe debe declarar el strict_types=1.
//ESTO MEJORA LA CALIDAD DE NUESTRO CODIGO :')
function usuarioAutenticado2():string{
    return "El usuario esta autenticado";
}
$usuario2=usuarioAutenticado2();
echo $usuario2;

//9. FUNCION QUE NO RETURNA NADA, IMPRIME ALGO...
function usuarioAutenticado3():void{
    echo "El usuario esta autenticado3";
}
usuarioAutenticado3();

//10. RETORNAR UN TIPO DE DATO O UN NULL
function usuarioAutenticado4(bool $autenticado): ?string{
    return ($autenticado) ? "Usuario autenticado4" : null;
};
$usuario=usuarioAutenticado4(false);
echo $usuario;

//11. RETORNAR UN TIPO DE DATO U OTRO
function usuarioAutenticado5(bool $autenticado):string|int{
    if($autenticado){
        return "usuario autenticado5";
    }else{
        return 20;
    }
}
$usuario=usuarioAutenticado5(false);
echo $usuario;

//12. ASIGNAR UNA FUNCION A UNA VARIABLE
$hola=function(){
    echo "hola";
};
$hola();
//13.Si vas a usar variables que están presentes en tu código, puedes enriquecer el contenido de la función usando use.
//Ya que las funciones no leen VARIABLES fuera de su escope
//DATO: Las funciones pueden leer CONSTANTES fuera de su escope
$tienda = 'pescadería';

$ubicacion= function () use ($tienda) {
    return "Estoy en la $tienda";
};
echo $ubicacion();

//14.FUNCION CON OPERADOR &
#&: el operador & hace que el valor dentro del parentesis no sea un parametro, sino sea el mismo argumento que lo llamo. POR ENDE EL & HACE QUE LA FX MODIFIQUE EL VALOR ORIGINAL(ARGUMENTO) , EN LUGAR DE LA COPIA(PRAMETRO) 
function foo($x){
    $x++;}
function bar(&$x){
    $x++; }

$x = 1;
foo($x);
echo "$x\n";    
bar($x);
echo "$x\n";
//DEVUELVE
#1
#2

include 'includes/footer.php';