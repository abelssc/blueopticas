<?php include 'includes/header.php';

    $clientes=[];
    $clientes2=array();
    $clientes3=["Abel","Abed"];
    $clientes5=[
        "nombre"=>"Abel",
        "saldo"=>200
    ];
    $clientes6="null";
    $clientes8;

    //EMPTY-PARA VERIFICAR SI EL ARREGLO ESTA VACIO
    var_dump(empty($clientes));//bool(true)
    var_dump(empty($clientes2));//bool(true)
    var_dump(empty($clientes3));//bool(false)
    var_dump(empty($clientes6));//bool(false)
    var_dump(empty($clientes7));//bool(false)
    var_dump(empty($clientes8));//bool(false)


    //ISSET- REVISA SI UN ARREGLO ESTA CREADO O SI UNA ´PROPIEDAD ESTA DEFINIDO
    echo "<br>"; 
    var_dump(isset($clientes));//TRUE
    var_dump(isset($clientes2));//TRUE
    var_dump(isset($clientes3));//TRUE
    var_dump(isset($clientes4));//FALSE
    var_dump(isset($clientes5["nombre"]));//true
    var_dump(isset($clientes3[1000]));//FALSE
    var_dump(isset($clientes5["edad"]));//false
    var_dump(isset($clientes6));//false
    var_dump(isset($clientes8));//false

    echo "<br>";
    $foto=$_FILES["foto"];
    echo ($foto);
    var_dump(isset($foto));//false






include 'includes/footer.php';