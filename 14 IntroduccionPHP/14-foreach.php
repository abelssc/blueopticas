<?php include 'includes/header.php';
?>
<!--FOREACH EN EL HTML-->
    <select>
        <?php foreach(range(1,10) as $num): ?>
        <option value="<?php echo $num?>"><?php echo $num . " años"?></option>
        <?php endforeach?>
    </select>
<?php
//FOREACH EN EL CODIGO
    $animalesFantasticos = ['fénix', 'dragón', 'grifo', 'pegaso', 'cerbero'];
    foreach($animalesFantasticos as $animal){
        echo "<br>${animal}";
    }
    // fénix dragón grifo pegaso cerbero

//FOREACH CON POSICION
echo "<br>";
    foreach($animalesFantasticos as $posicion =>$animal){
        echo "<br>${animal} en la posicion ${posicion}";
    }

//EN ARREGLOS ASOCIATIVOS, la iteracion es sobre los valores, no sobre las keys
$cliente=[
    "nombre"=>"Abel",
    "saldo"=>200,
    "tipo"=>"Premium"
];
foreach($cliente as $value):
    echo "<br> ${value}";
endforeach;

//PARA ITERAR EN LAS KEYS
foreach($cliente as $key=>$value):
    echo "<br> Key: ${key}  valor: ${value}";
endforeach;
include 'includes/footer.php';