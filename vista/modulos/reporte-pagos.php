<div class="content-wrapper" style="min-height: 1604.44px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar Pagos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Pagos</a></li>
              <li class="breadcrumb-item active">Administrar Pagos</li>
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
          <button  class="btn btn-success" data-toggle="modal" data-target="#modalIngresarPago">Ingresar Pago
          </button>
        </div>
        <div class="card-body">
          <table id="tablaPagos" class="table table-hover">
            <thead>
              <tr>
                <th style="width: 50px;">#</th>
                <th style="width: 50px;">Orden</th>
                <th>Cliente</th>
                <th>Pago</th>
                <th>Tipo de Pago</th>
                <th>Deuda Total</th>
                <th>Vendedor</th>
                <th>Fecha de Pago</th>
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


<!--==========================
MODAL CREATE Pago
==========================-->
<div class="modal fade" id="modalIngresarPago">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!--------------------------FORMULARIO------------------------------>
      <form role="form" id="formCrearPago">
        <!-- Modal Header -->
        <div class="modal-header bg-primary text-white">
          <h4 class="modal-title">Crear Pago</h4>
          <!-- INPUT HIDDEN PARA EL METODO DE POST -->
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="card-body">
            <!-- FECHA -->
            <div class="form-group">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <label>Fecha de Pago</label>
                        <input type="date" class="form-control" id="formDate" value="<?=date('Y-m-d')?>" name="fecha" required>
                    </div>
                </div>
            </div>    
          <!-- Orden y Deuda -->
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label>Nº de Orden</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-hashtag"></i></span>
                            <input type="number" class="form-control input-lg" name="orden" placeholder="Ingrese Nº de Orden" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label>Deuda:</label>
                        <div class="input-group">
                            <span class="input-group-text">S/.</span>
                            <input type="number" class="form-control input-lg" name="deuda" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Usuario -->
            <div class="form-group">
                <label>Cliente:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control input-lg" name="cliente" disabled>
                </div>
            </div>  
            <!-- Pago -->
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label>Metodo de Pago</label>
                        <select name="pagos_id" class="form-control" required>
                            <option value="" disabled selected>--Metodo de pago--</option>
                            <?php $res=ControladorVentas::ctrgetTiposdePago()?>
                            <?php while($row=$res->fetch_assoc()):?>
                              <option value="<?=$row['id']?>"><?=$row["tipodepago"]?></option>
                            <?php endwhile ?>
                          </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Pago:</label>
                        <div class="input-group">
                            <span class="input-group-text">S/.</span>
                            <input type="number" class="form-control input-lg" name="monto" required step="0.01">
                        </div>
                    </div>
                </div>
            </div>                       
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Registrar Pago</button>
          <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>
        
        </div>
      </form>
    </div>
  </div>
</div>

<!--==========================
MODAL EDITAR PAGO
==========================-->
<div class="modal fade" id="modalEditarPago">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!--------------------------FORMULARIO------------------------------>
      <form role="form" id="formEditarPago">
        <!-- Modal Header -->
        <div class="modal-header bg-primary text-white">
          <h4 class="modal-title">Editar Pago</h4>
          <input type="hidden" name="dataid">
          <!-- INPUT HIDDEN PARA EL METODO DE POST -->
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="card-body">
            <!-- FECHA -->
            <div class="form-group">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <label>Fecha de Pago</label>
                        <input type="date" class="form-control" id="formDate" value="<?=date('Y-m-d')?>" name="fecha" required>
                    </div>
                </div>
            </div>    
          <!-- Orden y Deuda -->
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label>Nº de Orden</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-hashtag"></i></span>
                            <input type="number" class="form-control input-lg" name="orden" placeholder="Ingrese Nº de Orden" required readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label>Deuda:</label>
                        <div class="input-group">
                            <span class="input-group-text">S/.</span>
                            <input type="number" class="form-control input-lg" name="deuda" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Usuario -->
            <div class="form-group">
                <label>Cliente:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control input-lg" name="cliente" disabled>
                </div>
            </div>  
            <!-- Pago -->
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label>Metodo de Pago</label>
                        <select name="pagos_id" class="form-control" required>
                            <option value="" disabled selected>--Metodo de pago--</option>
                            <?php $res=ControladorVentas::ctrgetTiposdePago()?>
                            <?php while($row=$res->fetch_assoc()):?>
                              <option value="<?=$row['id']?>"><?=$row["tipodepago"]?></option>
                            <?php endwhile ?>
                          </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Pago:</label>
                        <div class="input-group">
                            <span class="input-group-text">S/.</span>
                            <input type="number" class="form-control input-lg" name="monto" required step="0.01">
                        </div>
                    </div>
                </div>
            </div>                       
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Registrar Pago</button>
          <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>
        
        </div>
      </form>
    </div>
  </div>
</div>

<!--===============================================
SCRIPTS
===============================================-->
<!--==================JS==================-->

<!--==================DATATABLE==================-->
<script>
  $(document).ready(function(){
    datatable=$("#tablaPagos").DataTable({
      ajax:{
        "url":"ajax/pagos.ajax.php?tablaPagos",
        "dataSrc":''
      },
      columns:[
        {data:"id"},
        {data:"orden"},
        {data:"cliente"},
        {data:"monto"},
        {data:"tipodepago"},
        {data:"preciototal"},
        {data:"usuario"},
        {data:"fecha"},
        {data:"acciones"}
      ],
      dom: '<"d-flex justify-content-between flex-wrap"Bf>t<"bottom d-flex justify-content-between flex-wrap"lip>',
      order: [[0,"desc"]],
      responsive:true, 
      lengthChange:true,
      autoWidth:false,
      buttons: ["excel", "pdf", "print"],
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
<script src="vista/js/pagos.js"></script>

