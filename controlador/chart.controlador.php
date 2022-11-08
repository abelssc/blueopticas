<?php
    class ControladorChart{
        public static function ctrgetVentaWeek($val){
            $week=ModeloChart::mdlgetVentaWeek($val);
            $data=[0,0,0,0,0,0,0];
            foreach($week as $w){
                $data[$w["dia"]]=floatval($w["total"]);
            }
            return json_encode($data);
        }
        public static function getCountTabla($tabla){
            return ModeloChart::getCountTabla($tabla);
        }
        public static function ctrgetVentaYear($val){
            $year=ModeloChart::mdlgetVentaYear($val);
            $data=[0,0,0,0,0,0,0,0,0,0,0,0];
            foreach($year as $y){
                $data[$y["mes"]-1]=floatval($y["total"]);
            }
            return json_encode($data);
        }
        public static function ctrgetVentaTotalYear(){
            return ModeloChart::mdlgetVentaTotalYear();
        }
        public static function ctrgetVentaTotalWeek(){
            return ModeloChart::mdlgetVentaTotalWeek();
        }
        public static function ctrGetPercentWeek(){
            $week=ModeloChart::mdlGetPercentWeek(0);
            $lastweek=ModeloChart::mdlGetPercentWeek(1)??1;
            $percentaje=(($week/$lastweek)-1)*100;
            return $percentaje;
        }
        public static function ctrGetPercentYear(){
            $year=ModeloChart::mdlGetPercentYear(0);
            $lastyear=ModeloChart::mdlGetPercentYear(1)??1;
            $percentaje=(($year/$lastyear)-1)*100;
            return $percentaje;
        }
    }