<?php include 'includes/header.php';

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
echo "<pre>";
var_dump($apartamentos);
echo "</pre>";
#json_encode(array[,tipodeconversion]): convierte un arreglo a un string
#tipodeconverison, el tipo de formato q deseas convertirlo: json_unescaped_unicode: utiliza el formato con tildes y eñe
$json=json_encode($apartamentos,JSON_UNESCAPED_UNICODE);
var_dump($json);

#json_decode: convierte un string a un arreglo/objeto
$json_array=json_decode($json,true);
echo "<pre>";
var_dump($json_array);
echo "</pre>";

/*
associative
Cuando es true, los objects JSON devueltos serán convertidos a array asociativos, cuando es false los objects JSON devueltos serán convertidos a objects. Cuando es null, los objects JSON serán convertidos a array asociativos u objects dependiendo de si JSON_OBJECT_AS_ARRAY es establecida en los flags
*/

include 'includes/footer.php';