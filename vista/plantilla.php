<?php
  session_start();
  function estaAutenticado():bool{
    #?para tener el login el true, previamente debio haberse registrado
    if(isset($_SESSION["login"])&&$_SESSION["login"])
        return true;
    return false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blue Opticas</title>
  <!--===============================================
  CARGAMOS ESTILOS
  ===============================================-->
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/blueopticas/vista/plugins/fontawesome-free/css/all.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/blueopticas/vista/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/blueopticas/vista/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/blueopticas/vista/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">  
  <!-- Theme style -->
  <link rel="stylesheet" href="/blueopticas/vista/dist/css/adminlte.css">
  <!--FAVICON ICO -->
  <link rel="shortcut icon" href="/blueopticas/favicon/favicon.ico" type="image/x-icon"> 
  <!-- MIS ESTILOS -->
  <link rel="stylesheet" href="/blueopticas/vista/css/css.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/blueopticas/vista/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!--EVITAR QUE APARESCA LA OPCION DE TRADUCIR AL CARGAR LA PAGINA-->
  <meta name="google" content="notranslate" />

<!--===============================================
CARGAMOS SCRIPTS
===============================================-->
<!-- jQuery -->
<script src="/blueopticas/vista/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/blueopticas/vista/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/blueopticas/vista/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="/blueopticas/vista/dist/js/demo.js"></script> -->
<!--==========================
DATATABLES
==========================-->
<!-- DataTables  & Plugins -->
<script src="/blueopticas/vista/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/blueopticas/vista/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/blueopticas/vista/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/blueopticas/vista/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/blueopticas/vista/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/blueopticas/vista/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/blueopticas/vista/plugins/jszip/jszip.min.js"></script>
<script src="/blueopticas/vista/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/blueopticas/vista/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/blueopticas/vista/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/blueopticas/vista/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/blueopticas/vista/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!--===============================================
SWEET ALERT
===============================================-->
<script src="/blueopticas/vista/plugins/sweetalert2/sweetalert2.all.js"></script>
</head>
<body class="hold-transition sidebar-mini <?php  if(!estaAutenticado()) echo 'login-page'?> ">
    <?php
    if(estaAutenticado()){
      #<!-- Site wrapper -->
      echo '<div class="wrapper">';
        include 'modulos/cabezote.php';
        include 'modulos/menu.php';
        $rutas=["inicio","usuarios","categorias","productos","clientes","administrar-ventas","crear-ventas","reporte-ventas","editar-venta","reporte-pagos","salir"];
        if(isset($_GET["ruta"])){
          if(in_array($_GET["ruta"],$rutas))
            include 'modulos/'.$_GET["ruta"].".php";
          else{
            include 'modulos/404.php';
          }
        }
        else{#este se ejecuta al iniciar sesion(debido a que no existe $ruta en ell htaccess al inicio)
          include 'modulos/inicio.php';
        }
        include 'modulos/footer.php';
        echo '</div>';
      }
      else{
        include 'modulos/login.php';
      }
    ?>
  
  <!-- ./wrapper -->

</body>
</html>
