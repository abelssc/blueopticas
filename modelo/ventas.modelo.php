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
    }