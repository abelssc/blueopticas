<?php
    require_once 'coneccion.php';
    class ModeloVentas{
        public static function mdlReadProductos(){
            $db=crearConeccion();
            $query="SELECT p.id,foto,producto,c.categoria,precioventa,stock FROM productos p join categorias c WHERE p.categorias_id=c.id";
            $res=$db->query($query);
            return $res->fetch_all(MYSQLI_ASSOC);
        }
        public static function mdlgetTiposdePago(){
            $db=crearConeccion();
            $query="SELECT * FROM tipodepagos";
            $res=$db->query($query);
            return $res;
        }
        public static function mdlReadClientes($q){
            $db=crearConeccion();
            if(strlen($q)){
                $stmt=$db->prepare("SELECT id,cliente FROM clientes WHERE cliente LIKE ? OR id LIKE ? ORDER BY id DESC");
                $param="%$q%";
                $stmt->bind_param("ss",$param,$param);
            }else{
                $stmt=$db->prepare("SELECT id,cliente FROM clientes ORDER BY registro DESC LIMIT 20");
            }
            $data=[];
            if($stmt->execute()){
                $rs=$stmt->get_result();
                if($rs->num_rows>0){
                    while($row=$rs->fetch_assoc()){
                        $id=$row["id"];
                        $cliente=$row["id"].": ".$row["cliente"];
                        $data[]=array("id"=>$id,"text"=>$cliente);
                    }
                    $stmt->close();
                }else{
                    $data[]=array("id"=>0,"text"=>"Cliente no encontrado");
                }
            }
            return $data;
        }
        public static function mdlgetIdVenta(){
            $db=crearConeccion();
            $versionsql=$db->get_server_info();
            $pattern="/\..+/";
            #obtenemos la version ejm string 8.5.13-> int 8 
            $versionsql=intval(preg_replace($pattern,"",$versionsql));
            if($versionsql>=8){
                $query="set information_schema_stats_expiry=0";
                $db->query($query);
                $query="SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'blueopticas' and TABLE_NAME='ventas'";
            }else{
                $query="SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'blueopticas' and TABLE_NAME='ventas'";
            }
            
            $rs=$db->query($query);
            return $rs->fetch_column();
        }
        public static function mdlgetTiposSituacion(){
            $db=crearConeccion();
            $query="SELECT * FROM situaciones";
            return $rs=$db->query($query);
        }
        
        public static function mdlsetVenta(string $colventas,string $valventas,string $colpagosventas,string $valpagosventas,array $ventasproductos){
            $db=crearConeccion();
            // TABLA VENTAS
            $query="INSERT INTO ventas ($colventas) VALUES ('$valventas')";
            $db->query($query);
            $last_id_venta=$db->insert_id;
            // TABLA PAGOSVENTAS
            $query="INSERT INTO pagosventas (ventas_id,$colpagosventas) VALUES ('$last_id_venta','$valpagosventas')";
            $db->query($query);
            // TABLA VENTASPRODUCTOS
            $stmt=$db->prepare("INSERT INTO ventasproductos (ventas_id,productos_id,cantidad,precio) VALUES (?,?,?,?)");
            foreach ($ventasproductos as $row) {
                $stmt->bind_param("iiid",$last_id_venta,$row->productos_id,$row->cantidad,$row->precio);
                $stmt->execute();
            }
            $stmt->close();
            return  $last_id_venta;

        }
        public static function mdlupdateVenta(string $cadena,string $id,array $ventasproductos){
            $db=crearConeccion();
            // TABLA VENTAS
            $query="UPDATE ventas SET $cadena WHERE id='$id'";
            $db->query($query);

            // TABLA VENTASPRODUCTOS
            //ELIMINAMOS LAS VENTAS PRODUCTIS ANTERIORES
            $stmt=$db->prepare("DELETE FROM ventasproductos WHERE ventas_id=?");
            $stmt->bind_param('i',$id);
            $stmt->execute();
            //ENVIAMOS NUEVALISTA
            $stmt=$db->prepare("INSERT INTO ventasproductos (ventas_id,productos_id,cantidad,precio) VALUES (?,?,?,?)");
            foreach ($ventasproductos as $row) {
                $stmt->bind_param("iiid",$id,$row->productos_id,$row->cantidad,$row->precio);
                $stmt->execute();
            }
            $stmt->close();
            return  $id;

        }


        public static function mdlgetVentas(){
            $db=crearConeccion();
            $query="SELECT v.id,s.situacion,u.usuario,c.cliente,acuenta,preciototal,(preciototal-IFNULL(acuenta,0)) as debe,v.registro,GROUP_CONCAT(p.producto) as productos from ventas v 
            LEFT JOIN clientes c ON v.clientes_id=c.id
            LEFT JOIN usuarios u ON v.usuarios_id=u.id
            LEFT JOIN situaciones s ON v.situacion_id=s.id
            LEFT JOIN (SELECT pv.ventas_id, SUM(pv.monto) as acuenta FROM pagosventas pv GROUP BY pv.ventas_id) pagos ON v.id=pagos.ventas_id
            LEFT JOIN (SELECT vp.ventas_id, SUM(vp.cantidad*vp.precio) as preciototal FROM ventasproductos vp GROUP BY vp.ventas_id) preciototal ON v.id=preciototal.ventas_id
            LEFT JOIN ventasproductos vp ON vp.ventas_id=v.id
            LEFT JOIN productos p ON vp.productos_id=p.id
            GROUP BY v.id,s.situacion,u.usuario,c.cliente,acuenta,preciototal,(preciototal-IFNULL(acuenta,0)),v.registro";
            $res=$db->query($query);
            return $res->fetch_all(MYSQLI_ASSOC);
        }
        
        public static function mdlgetVenta($id){
            $db=crearConeccion();
             // TABLA VENTAS
             $query="SELECT v.id,v.fecha_recojo,v.hora_recojo, v.situacion_id, v.usuarios_id,v.clientes_id,v.registro,c.cliente FROM ventas v LEFT JOIN clientes c ON v.clientes_id=c.id WHERE v.id='$id'";
             $rs=$db->query($query);
             $venta=$rs->fetch_assoc();
             $registro=$venta["registro"];
            //  TABLA PAGOSVENTAS
            $query="SELECT * FROM pagosventas WHERE ventas_id='$id' and fecha='$registro'";
            $rs=$db->query($query);
            $pagosventas=$rs->fetch_assoc();
            // TABLA VENTASPRODUCTOS
            $query="SELECT vp.ventas_id,vp.productos_id,vp.cantidad,vp.precio,p.producto FROM ventasproductos vp LEFT JOIN productos p ON vp.productos_id=p.id WHERE ventas_id='$id'";
            $rs=$db->query($query);
            $ventasproductos=$rs->fetch_all(MYSQLI_ASSOC);
            return ["venta"=>$venta,"pagosventas"=>$pagosventas,"ventasproductos"=>$ventasproductos];
        }
        public static function mdlgetVentasDia($date){
            $db=crearConeccion();
            $query="SELECT v.id,c.cliente,preciototal,pv.monto as acuenta,(preciototal-IFNULL(pv.monto,0)) as debe,v.registro,GROUP_CONCAT(p.producto) as productos,tp.tipodepago from ventas v 
            LEFT JOIN clientes c ON v.clientes_id=c.id
            LEFT JOIN pagosventas pv ON v.id=pv.ventas_id
            LEFT JOIN (SELECT vp.ventas_id, SUM(vp.cantidad*vp.precio) as preciototal FROM ventasproductos vp GROUP BY vp.ventas_id) preciototal ON v.id=preciototal.ventas_id
            LEFT JOIN ventasproductos vp ON vp.ventas_id=v.id
            LEFT JOIN productos p ON vp.productos_id=p.id
            LEFT JOIN tipodepagos tp ON pv.pagos_id=tp.id
            WHERE v.registro='$date' and v.registro=pv.fecha
            GROUP BY v.id,c.cliente,acuenta,preciototal,(preciototal-IFNULL(acuenta,0)),v.registro,tp.tipodepago";
            $res=$db->query($query);
            return $res->fetch_all(MYSQLI_ASSOC);
        }
        public static function mdlgetRecojosDia($date){
            $db=crearConeccion();
            $query="SELECT v.id,c.cliente,preciototal,pv.monto as acuenta,v.registro,pv.fecha,GROUP_CONCAT(p.producto) as productos,tp.tipodepago from ventas v 
            LEFT JOIN clientes c ON v.clientes_id=c.id
            LEFT JOIN pagosventas pv ON v.id=pv.ventas_id
            LEFT JOIN (SELECT vp.ventas_id, SUM(vp.cantidad*vp.precio) as preciototal FROM ventasproductos vp GROUP BY vp.ventas_id) preciototal ON v.id=preciototal.ventas_id
            LEFT JOIN ventasproductos vp ON vp.ventas_id=v.id
            LEFT JOIN productos p ON vp.productos_id=p.id
            LEFT JOIN tipodepagos tp ON pv.pagos_id=tp.id
            WHERE pv.fecha='$date' and pv.fecha<>v.registro
            GROUP BY v.id,c.cliente,acuenta,preciototal,v.registro,tp.tipodepago";
            $res=$db->query($query);
            return $res->fetch_all(MYSQLI_ASSOC);
        }

    }