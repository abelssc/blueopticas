<div class="content-wrapper" style="min-height: 1604.44px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              Caja  
              <span class="btn btn-info btn-download-caja"><i class="fa fa-cloud-download-alt"></i></span>  
            </h1>
            <div class="input-group caja-date">
              <label for="fecha"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></label>
              <input type="date" class="form-control-sm" value="<?=date('Y-m-d')?>" name="fecha" id="fecha" required>  
            </div>
          
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Caja</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    
      <div class="row">
        <!--===============================================
        TABLAS INFO
        ===============================================-->
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                  <h5>
                    Ventas del dia <span class="fechaventasdeldia"></span>
                  </h5>
                </div>
                <div class="card-body">
                    <table id="tablaVentas" class="table table-hover">
                        <thead>
                        <tr>
                            <th style="width: 50px;">Orden</th>
                            <th>Cliente</th>
                            <th>Productos</th>
                            <th>Total</th>
                            <th>A Cuenta</th>
                            <th>Saldo</th>
                            <th>Tipo de Pago</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- LLENADO DE LA TABLA -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                  <h5>
                    Recojos y Adelantos
                  </h5>
                </div>
                <div class="card-body">
                    <table id="tablaRecojos" class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 50px;">Orden</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Total</th>
                                <th>A Cuenta</th>
                                <th>Tipo de Pago</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- LLENADO DE LA TABLA -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                  <h5>
                    Gastos
                  </h5>
                </div>
                <div class="card-body">
                    <table id="tablaGastos" class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Monto</th>
                                <th>Tipo de Gasto</th>
                                <th>Descripcion</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- LLENADO DE LA TABLA -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--===============================================
        RESUMEN
        ===============================================-->
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                  <h5>
                    Resumen
                  </h5>
                </div>
                <div class="card-body">
                    <div class="resumen-grid">
                      <p class="resumen-title">Ingresos</p>
                      <label>Total a Cta</label>
                      <span>:S/. </span>
                      <span id="totalAcuenta"></span>
                      <label>Recojo</label>
                      <span>:S/. </span>
                      <span id="totalRecojos"></span>   
                      <label class="resumen-total"></label>  
                      <label class="resumen-total">:S/. </label>
                      <label class="resumen-total" id="ingresosTotal"></label>
                    </div>
                    <div class="resumen-grid">
                      <p class="resumen-title">Egresos</p>
                      <label>Gastos</label>
                      <label>:S/. </label>
                      <label id="totalGastos"></label>
                    </div>
                    <div class="resumen-grid">
                      <p class="resumen-title">Total</p>
                      <label>Efectivo</label>
                      <span>:S/. </span>
                      <span id="efectivo"></span>
                      <label>Deposito</label>
                      <span>:S/. </span>
                      <span id="deposito"></span>
                      <label class="resumen-total"></label>
                      <label class="resumen-total">:S/. </label>
                      <label class="resumen-total" id="total"></label>
                    </div>
                </div>
                <div class="card-footer">
                   
                </div>
            </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

  <!--===============================================
  DATATABLE
  ===============================================-->
  <!--==================DATATABLE==================-->
  <script>
  let hoy=new Date().toLocaleDateString();
  hoy=hoy.split("/").reverse().join("-");

  $(document).ready(function(){
    tablaVentas=$("#tablaVentas").DataTable({
      ajax:{
        "url":`ajax/ventas.ajax.php?datatableVentasDia=${hoy}`,
        "dataSrc":''
      },
      columns:[
        {data:"id"},
        {data:"cliente"},
        {data:"productos"},
        {data:"preciototal"},
        {data:"acuenta"},
        {data:"debe"},
        {data:"tipodepago"}
      ],
      order: [[0,"desc"]],
      responsive:true, 
      lengthChange:false,
      autoWidth:false,
      searching:false,
      info:false,
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
    tablaRecojos=$("#tablaRecojos").DataTable({
      ajax:{
        "url":`ajax/ventas.ajax.php?datatableRecojosDia=${hoy}`,
        "dataSrc":''
      },
      columns:[
        {data:"id"},
        {data:"registro"},
        {data:"cliente"},
        {data:"preciototal"},
        {data:"acuenta"},
        {data:"tipodepago"}
      ],
      order: [[0,"desc"]],
      responsive:true, 
      lengthChange:false,
      autoWidth:false,
      searching:false,
      info:false,
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
    tablaGastos=$("#tablaGastos").DataTable({
      ajax:{
        "url":`ajax/gastos.ajax.php?tablaGastosDia=${hoy}`,
        "dataSrc":''
      },
      columns:[
        {data:"id"},
        {data:"monto"},
        {data:"tipodepago"},
        {data:"descripcion"},
        {data:"fecha"}
      ],
      order: [[0,"desc"]],
      responsive:true, 
      lengthChange:false,
      autoWidth:false,
      searching:false,
      info:false,
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
  })
  </script>
  <!-- HTML2CANVA -->

  <!--===============================================
  SCRIPT
  ===============================================-->
  <script src="vista/js/caja.js"></script>



