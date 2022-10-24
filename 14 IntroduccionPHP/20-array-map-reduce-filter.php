<?php include 'includes/header.php';
#MAP: array_map(función($e){}, array);  transforma el contenido de un array, obtenemos un nuevo array del mismo tamaño
#FILTER: array_filter(array, función($e){}); obtenemos un array mas pequeño en base a una condicion
#REDUCE: array_reduce(array, función($acumulador,$e){}, valor_inicial); obtenemos un solo valor, en base a operaciones del contenido del array
//PARA ARREGLOS  ASOCIATIVOS
#FILTER array_filter(arrayassoc):elimina los elementos vacíos, ceros, valores false y null.
#MAP: array_map(función($e){}, array_key(array),array);//funcion,llaves del array,valores del array: CREA UN NUEVO ARREGLO
#WALK: array_walk(array,function(&$value, $key)) CAMBIA EL CONTENIDO DEL MISMO ARREGLO

// Diccionario
$apartamentos = [
    [
        'precio/noche' => 40,
        'ciudad' => 'Valencia',
        'wifi' => True,
        'pagina web' => 'https://hotel.com'
    ],
    [
        'precio/noche' => 87,
        'ciudad' => 'Calpe',
        'wifi' => True,
        'pagina web' => 'https://calpe.com'
    ],
    [
        'precio/noche' => 67,
        'ciudad' => 'Valencia',
        'wifi' => False,
        'pagina web' => 'https://denia.com'
    ],
    [
        'precio/noche' => 105,
        'ciudad' => 'Benidorm',
        'wifi' => False,
        'pagina web' => 'https://benidorm.com'
    ]
];

#MAP
$nuevoArregloDepartamentos=array_map(function($apartamento){
    $apartamento['precio/noche']-=1;
    return $apartamento;
},$apartamentos);
echo "MAP";
echo "<pre>";
var_dump($nuevoArregloDepartamentos);
echo "</pre>";


#FILTER
$nuevoArregloFilter=array_filter($apartamentos,function($apartamento){
    if($apartamento['ciudad']=='Valencia'){
        return $apartamento;
    }
});
echo "FILTER";
echo "<pre>";
var_dump($nuevoArregloFilter);
echo "</pre>";

#REDUCE
echo "REDUCE<br>";
$precioPromedio=array_reduce($apartamentos,function($acumulador,$apartamento){
    return $apartamento['precio/noche']+$acumulador;
},0)/count($apartamentos);
echo "Precio Promedio ${precioPromedio}";

#MAP
$model = ['id' => 7, 'name'=>'James'];
 
$callback = function($key, $value) {
    return "$key is $value";
};
 
$res = array_map($callback, array_keys($model), $model);
print_r($res);
 
// Array
// (
//     [0] => id is 7
//     [1] => name is James
// )

#WALK
$fruits = [
    'banana' => 'yellow',
    'apple' => 'green',
    'orange' => 'orange',
];
 
array_walk($fruits, function(&$value, $key) {
    $value = "$key is $value";
});
 
print_r($fruits);
 
// Array
// (
//     [banana] => banana is yellow
//     [apple] => apple is green
//     [orange] => orange is orange
// )










include 'includes/footer.php'?>;

