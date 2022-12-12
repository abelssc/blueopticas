<?php
    require_once '../modelo/caja.modelo.php';
    if($_SERVER["REQUEST_METHOD"]==="GET"){
        if(isset($_GET["date"])){
            $acuenta=ModeloCaja::totalAcuenta($_GET["date"]);
            $recojos=ModeloCaja::totalRecojos($_GET["date"]);
            $gastos=ModeloCaja::totalGastos($_GET["date"]);
            $efectivo=ModeloCaja::totalEfectivo($_GET["date"]);
            $deposito=ModeloCaja::totalDeposito($_GET["date"]);

            $array=[
                "acuenta"=>$acuenta,
                "recojos"=>$recojos,
                "gastos"=>$gastos,
                "efectivo"=>$efectivo,
                "deposito"=>$deposito
            ];
            echo json_encode($array);

        }
    }