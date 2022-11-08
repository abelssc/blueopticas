<?php
    require_once '../controlador/chart.controlador.php';
    require_once '../modelo/chart.modelo.php';

    if($_SERVER["REQUEST_METHOD"]=="GET"){
        if(isset($_GET["week"])){
            $percentaje=ControladorChart::ctrGetPercentWeek();
            echo json_encode($percentaje);
        }
        if(isset($_GET["year"])){
            $percentaje=ControladorChart::ctrGetPercentYear();
            echo json_encode($percentaje);
        }
    }