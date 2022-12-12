<div class="content-wrapper" style="min-height: 1604.44px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar Gastos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Gastos</a></li>
              <li class="breadcrumb-item active">Administrar Gastos</li>
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
          <button  class="btn btn-success" data-toggle="modal" data-target="#modalIngresarGasto">Ingresar Gasto
          </button>
        </div>
        <div class="card-body">
          <table id="tablaGastos" class="table table-hover">
            <thead>
              <tr>
                <th style="width: 50px;">#</th>
                <th>Monto S/</th>
                <th>Descripcion</th>
                <th>Tipo de Gasto</th>
                <th>Fecha</th>
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
MODAL CREATE GASTOS
==========================-->
<div class="modal fade" id="modalIngresarGasto">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!--------------------------FORMULARIO------------------------------>
      <form role="form" id="formCrearGasto">
        <!-- Modal Header -->
        <div class="modal-header bg-primary text-white">
          <h4 class="modal-title">Crear Gasto</h4>
          <!-- INPUT HIDDEN PARA EL METODO DE POST -->
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group">
              <div class="row mb-4">
                <!-- FECHA -->
                <div class="col-sm-6">
                        <label>Fecha de Gasto</label>
                        <input type="date" class="form-control" id="formDate" value="<?=date('Y-m-d')?>" name="fecha" required>
                  </div>
              </div>
            </div>
            <div class="form-group">
                <div class="row mb-4">
                     <!-- MONTO -->
                    <div class="col-sm-6">
                        <label>Monto</label>
                        <div class="input-group">
                            <span class="input-group-text">S/.</span>
                            <input type="number" class="form-control" name="monto" placeholder="Ingrese Monto" required step="0.01">
                        </div>
                    </div>
                    <div class="col-sm-6">
                      <label>Tipo de Gasto</label>
                      <!-- TIPO DE GASTO -->
                      <div class="input-group">
                        <select name="tipopago_id" id="" class="form-control" required>
                            <option value="" disabled selected>--Metodo de pago--</option>
                            <?php $res=ControladorVentas::ctrgetTiposdePago()?>
                            <?php while($row=$res->fetch_assoc()):?>
                              <option value="<?=$row['id']?>"><?=$row["tipodepago"]?></option>
                            <?php endwhile ?>
                        </select>
                      </div>
                    </div>
                </div>
            </div>    
            <!-- DESCRIPCCION -->
            <div class="form-group">
                <div class="row mb-4">
                    <div class="col-12">
                        <label>Motivo</label>
                        <div class="input-group">
                           <textarea style="overflow:auto;resize:none" name="descripcion" rows="3" cols="100" required maxlength="200"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Registrar Gasto</button>
          <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>
        
        </div>
      </form>
    </div>
  </div>
</div>
<!--==========================
MODAL EDITAR PAGO
==========================-->
<div class="modal fade" id="modalEditarGasto">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!--------------------------FORMULARIO------------------------------>
      <form role="form" id="formEditarGasto">
        <!-- Modal Header -->
        <div class="modal-header bg-primary text-white">
          <h4 class="modal-title">Editar Gasto</h4>
          <input type="hidden" name="dataid">
          <!-- INPUT HIDDEN PARA EL METODO DE POST -->
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group">
              <div class="row mb-4">
                <!-- FECHA -->
                <div class="col-sm-6">
                        <label>Fecha de Gasto</label>
                        <input type="date" class="form-control" id="formDate" value="<?=date('Y-m-d')?>" name="fecha" required>
                  </div>
              </div>
            </div>
            <div class="form-group">
                <div class="row mb-4">
                     <!-- MONTO -->
                    <div class="col-sm-6">
                        <label>Monto</label>
                        <div class="input-group">
                            <span class="input-group-text">S/.</span>
                            <input type="number" class="form-control" name="monto" placeholder="Ingrese Monto" required step="0.01">
                        </div>
                    </div>
                    <div class="col-sm-6">
                      <label>Tipo de Gasto</label>
                      <div class="input-group">
                        <select name="tipopago_id" id="" class="form-control" required>
                            <option value="" disabled selected>--Metodo de pago--</option>
                            <?php $res=ControladorVentas::ctrgetTiposdePago()?>
                            <?php while($row=$res->fetch_assoc()):?>
                              <option value="<?=$row['id']?>"><?=$row["tipodepago"]?></option>
                            <?php endwhile ?>
                        </select>
                      </div>
                    </div>
                </div>
            </div>    
            <!-- DESCRIPCCION -->
            <div class="form-group">
                <div class="row mb-4">
                    <div class="col-12">
                        <label>Motivo</label>
                        <div class="input-group">
                           <textarea style="overflow:auto;resize:none" name="descripcion" rows="3" cols="100" required maxlength="200"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Editar Gasto</button>
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
    datatable=$("#tablaGastos").DataTable({
      ajax:{
        "url":"ajax/gastos.ajax.php?tablaGastos",
        "dataSrc":''
      },
      columns:[
        {data:"id"},
        {data:"monto"},
        {data:"descripcion"},
        {data:"tipodepago"},
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
<script src="vista/js/gastos.js"></script>
