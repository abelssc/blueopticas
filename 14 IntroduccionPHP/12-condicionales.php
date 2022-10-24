<?php include 'includes/header.php';

$autenticado=false;
$admin=true;
$ghost=true;
if($autenticado || $admin && $ghost){
    echo "usuario autenticado correctamente";
}else{
    echo "usuario no autenticado";
}
echo "<br>";
//IF ANIDADOS
$cliente=[
    "nombre"=>"Abel",
    "saldo"=>200,
    "informacion"=>[
        "tipo"=>"premium"
    ]
];
if(!empty($cliente)){
    echo "Arreglo no vacio";
    if($cliente["saldo"]>0){
        echo "<br>Saldo disponible";
    }else{
        echo "<br>Saldo no disponible";
    }
}else{
    echo "Arreglo vacio";
}
//if-else if
// if(){

// }else if{

// }else{

// }

/* EN FORMATO SIN LLAVES, EL ELSEIF VA JUNTO
  if():
        //codigo
    elseif():
        //codigo
    else:
        //codigo
    endif
    
*/
//para la integracion con HTML
/*
<html>
    <body>
    <?php if (condición): ?>
    // Código que sea cierto
    <?php elseif (condición): ?>
    // Código que se ejecutará si no es cierto.
    <?php else: ?>
    // Código que se ejecutará si no es cierto.
    <?php endif; ?>
    </body>
</html>
*/

/*
operador ternario
<?php (condicional) ? 'Valor si se cumple' : 'Valor si no se cumple';?>
<?php echo (5 > 10) ? 'Es verdad' : 'Es mentira'; ?>
*/

/*SWITCH
switch ($variable) {
    case 0:
        ...
        break;
    case 1:
        ...
        break;
    case 2:
        ...
        break;
    default:
        ...
        break;
}
*/


include 'includes/footer.php';