<div class="content-wrapper" style="min-height: 1604.44px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar Ventas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Ventas</a></li>
              <li class="breadcrumb-item active">Administrar Ventas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <a  class="btn btn-primary" href="crear-ventas">Crear Venta
          </a>
        </div>
        <div class="card-body">
          <table id="tablaVentas" class="table table-hover">
            <thead>
              <tr>
                <th style="width: 50px;">Orden</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Debe</th>
                <th>Estado</th>
                <th>Fecha Recojo</th>
                <th>Hora Recojo</th>
                <th>Vendedor</th>
                <th>Registro</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <!-- LLENADO DE LA TABLA -->
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!--===============================================
SCRIPTS
===============================================-->
<!--==================JS==================-->

<!--==================DATATABLE==================-->
<script>
  $(document).ready(function(){
    datatable=$("#tablaVentas").DataTable({
      ajax:{
        "url":"ajax/ventas.ajax.php?datatableVentas",
        "dataSrc":''
      },
      columns:[
        {data:"id"},
        {data:"cliente"},
        {data:"preciototal"},
        {data:"debe"},
        {data:"situacion"},
        {data:"fecha_recojo"},
        {data:"hora_recojo"},
        {data:"usuario"},
        {data:"registro"},
        {data:"acciones"}
      ],
      dom: '<"d-flex justify-content-between flex-wrap"Bf>t<"bottom d-flex justify-content-between flex-wrap"lip>',
      order: [[0,"desc"]],
      responsive:true, 
      lengthChange:true,
      autoWidth:false,
      buttons: ["excel", "pdf", "print", "colvis"],
      language:{
      "decimal": "",
      "emptyTable": "No hay información",
      "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
      "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
      "infoFiltered": "(Filtrado de _MAX_ total entradas)",
      "infoPostFix": "",
      "thousands": ",",
      "lengthMenu": "Mostrar _MENU_ Entradas",
      "loadingRecords": "Cargando...",
      "processing": "Procesando...",
      "search": "Buscar:",
      "zeroRecords": "Sin resultados encontrados",
      "paginate": {
      "first": "Primero",
      "last": "Ultimo",
      "next": "->",
      "previous": "<-"}
      }
    });
    // datatable.order(0,"desc");
  })

</script>


