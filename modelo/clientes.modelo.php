<?php
    require_once 'coneccion.php';
    class ModeloClientes{
        /*--===============================================
        READ DATOS TABLA PRINCIPAL
        =================================================*/
        public static function getMdlDataTable():array{
            $db=crearConeccion();
            $query="SELECT id, cliente, dni, celular,TIMESTAMPDIFF(YEAR,fecha_nacimiento,CURDATE()) as edad,date(registro) as registro FROM clientes order by id desc";
            $res=$db->query($query);
            return $res->fetch_all(MYSQLI_ASSOC);
        }
        /*--===============================================
        READ MEDIDAS
        =================================================*/
        public static function mdlReadMedidas($id){
            $db=crearConeccion();
            $query="SELECT * FROM medidas WHERE paciente_id='$id'";
            $res=$db->query($query);
            return $res->fetch_assoc();
        }
        /*--===============================================
        EXISTENCIA
        =================================================*/
        public static function getMdlIsset($tabla,$columna,$value):int{
            $db=crearConeccion();
            $query="SELECT * FROM $tabla WHERE $columna='$value'";
            $res=$db->query($query);
            return $res->num_rows;
            $db->close();
            $db=null;
        }
        /*--===============================================
        READ DATOS OPTOMETRAS SELECT DEL CLIENTE
        =================================================*/
        public static function mdlReadOptometras(){
            $db=crearConeccion();
            $query="SELECT id,nombre FROM usuarios";
            $res=$db->query($query);
            return $res;
            $db->close();
            $db=null;
        }
        /*--===============================================
        CREATE CLIENTE
        =================================================*/
        public static function mdlCrearCliente($columnas,$valores){
            $db=crearConeccion();
            $query="INSERT INTO clientes ($columnas) VALUES ('$valores')";
            return $db->query($query);
        }

        /*--===============================================
        UPDATE FILA DATOS MODAL EDITAR
        =================================================*/
        public static function mdlUpdateCliente($cadena,$id){
            $db=crearConeccion();
            $query="UPDATE clientes SET $cadena WHERE id='$id'";
            return $db->query($query);
        }
        /*--===============================================
        ELIMINAR CLIENTE
        =================================================*/
        public static function mdlEliminarCliente($id){
            $db=crearConeccion();
            $query="DELETE FROM clientes WHERE id='$id'";
            return $db->query($query);
        }
        /*--===============================================
        GET DATOS COMPRAS
        =================================================*/
        
        public static function mdlgetVentasCliente($clienteID){
            $db=crearConeccion();
            $query="SELECT v.id,s.situacion,u.usuario,c.cliente,acuenta,preciototal,(preciototal-IFNULL(acuenta,0)) as debe,v.registro,GROUP_CONCAT(p.producto) as productos from ventas v 
            LEFT JOIN clientes c ON v.clientes_id=c.id
            LEFT JOIN usuarios u ON v.usuarios_id=u.id
            LEFT JOIN situaciones s ON v.situacion_id=s.id
            LEFT JOIN (SELECT pv.ventas_id, SUM(pv.monto) as acuenta FROM pagosventas pv GROUP BY pv.ventas_id) pagos ON v.id=pagos.ventas_id
            LEFT JOIN (SELECT vp.ventas_id, SUM(vp.cantidad*vp.precio) as preciototal FROM ventasproductos vp GROUP BY vp.ventas_id) preciototal ON v.id=preciototal.ventas_id
            LEFT JOIN ventasproductos vp ON vp.ventas_id=v.id
            LEFT JOIN productos p ON vp.productos_id=p.id
            WHERE c.id=$clienteID
            GROUP BY v.id,s.situacion,u.usuario,c.cliente,acuenta,preciototal,(preciototal-IFNULL(acuenta,0)),v.registro";
            $res=$db->query($query);
            return $res->fetch_all(MYSQLI_ASSOC);
        }
    }