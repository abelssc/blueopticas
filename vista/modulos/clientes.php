<div class="content-wrapper" style="min-height: 1604.44px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Clientes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Clientes</li>
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
          <button class="btn btn-primary btnCrearCliente" data-toggle="modal" data-target="#modalCrearCliente">Agregar Cliente</button>
        </div>
        <div class="card-body">
          <table id="tablaClientes" class="table table-hover">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Cliente</th>
                <th>DNI</th>
                <th>Celular</th>
                <th>Edad</th>
                <th>Agregado</th>
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
INSERTAR DATOS TABLA Y DATATABLES
==========================-->
<script>
  $(document).ready(function () {
      const $botones= 
      `<div class="btn-group"  style="gap:5px">
        <button class="btn btn-success btnMedidaCliente" data-toggle="modal" data-target="#modalMedidaCliente"><i class="fa fa-eye"></i></button>
        <button class="btn btn-info btnComprasCliente" data-toggle="modal" data-target="#modalComprasCliente"><i class="fa fa-shopping-cart"></i></button>
        <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente"><i class="fa fa-pencil-alt text-white"></i></button>
        <button class="btn btn-danger btnEliminarCliente" data-toggle="modal" data-target="#modalEliminarCliente"><i class="fa fa-times"></i></button>
      </div>`;

       xdatatable=$('#tablaClientes').DataTable({
          ajax: {
            "url":'ajax/clientes.ajax.php',
            "dataSrc":''
          },
          columns: [
              { data: 'id' },
              { data: 'cliente' },
              { data: 'dni' },
              { data: 'celular' },
              { data: 'edad' },
              { data: 'registro' },
              {defaultContent: $botones}
              
          ],
          dom: '<"top d-flex justify-content-between"Bf>t<"bottom d-flex justify-content-between"lip>',
          buttons:[
            'excel',
            'pdf',
            'print',
            'colvis'
          ],
          order: [[0,"desc"]],
          responsive:true, 
          lengthChange:true,
          autoWidth:false,
          language:{
          "decimal": "",
          "emptyTable": "No hay informaci??n",
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
      
  });
</script>


<!--==========================
MODAL CREATE CLIENTE
==========================-->
<div class="modal fade" id="modalCrearCliente">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!--------------------------FORMULARIO------------------------------>
      <form role="form" method="POST" id="formCrearCliente">
        <!-- Modal Header -->
        <div class="modal-header bg-primary text-white">
          <h4 class="modal-title">Agregar Cliente</h4>
          <!-- INPUT HIDDEN PARA EL METODO DE POST -->
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="card-body">
          <!-- CLIENTE -->
            <div class="form-group">
            <label>Nombre y Apellido</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="cliente" placeholder="Ingresar Cliente" required pattern="^.{2,}$">
              </div>
            </div>
            <!-- FECHA NAC -->
            <div class="form-group">
              <label>Fecha de Nacimiento</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric" placeholder="dd/mm/yyyy" name="fecha_nacimiento">
              </div>
            </div>
            <!-- CELULAR -->
            <div class="form-group">
            <label>Celular o Tel??fono</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="text" class="form-control" data-inputmask="'mask': ['999-999-999']" data-mask="" inputmode="text" placeholder="___-___-___ " name="celular">
              </div>
            </div>
            <!-- DNI -->
            <div class="form-group">
            <label>DNI</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                </div>
                <!-- <input type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask="" inputmode="numeric" placeholder="_._._._" name="dni"> -->
                <input type="text" class="form-control" data-inputmask="'mask': ['99.99.99.99']" data-mask="" inputmode="numeric" placeholder="_._._._" name="dni">
              </div>
            </div>
          </div>

        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Registrar Cliente</button>
          <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>
        
        </div>
      </form>
    </div>
  </div>
</div>

<!--==========================
MODAL EDITAR Cliente
==========================-->
<div class="modal fade" id="modalEditarCliente">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!--------------------------FORMULARIO------------------------------>
      <form role="form" method="POST" id="formEditarCliente">
        <!-- Modal Header -->
        <div class="modal-header bg-primary text-white">
          <h4 class="modal-title">Editar Cliente</h4>
          <!-- INPUT HIDDEN PARA EL METODO DE POST -->
          <input type="hidden" name="dataid">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="card-body">
          <!-- CLIENTE -->
            <div class="form-group">
            <label>Nombre y Apellido</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="cliente" placeholder="Ingresar Cliente" required pattern="^.{2,}$">
              </div>
            </div>
            <!-- FECHA NAC -->
            <div class="form-group">
              <label>Fecha de Nacimiento</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric" placeholder="dd/mm/yyyy" name="fecha_nacimiento">
              </div>
            </div>
            <!-- CELULAR -->
            <div class="form-group">
            <label>Celular o Tel??fono</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="text" class="form-control" data-inputmask="'mask': ['999-999-999']" data-mask="" inputmode="text" placeholder="___-___-___ " name="celular">
              </div>
            </div>
            <!-- DNI -->
            <div class="form-group">
            <label>DNI</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                </div>
                <input type="text" class="form-control" data-inputmask="'mask': ['99.99.99.99']" data-mask="" inputmode="numeric" placeholder="_._._._" name="dni">
              </div>
            </div>
          </div>

        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary submitEditar">Editar Cliente</button>
          <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>
        
        </div>
      </form>
    </div>
  </div>
</div>

<!--==========================
MODAL MEDIDAS CLIENTE
==========================-->
<div class="modal fade" id="modalMedidaCliente">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!--------------------------FORMULARIO------------------------------>
      <form role="form" method="POST" id="formMedidaCliente">
        <!-- Modal Header -->
        <div class="modal-header bg-success text-white">
          <h4 class="modal-title">Medida Cliente</h4>
          <!-- INPUT HIDDEN PARA EL METODO DE POST -->
          <input type="hidden" name="paciente_id">
          <!-- <input type="hidden" name="modal"> -->
          <input type="hidden" name="id_medida">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group">
              <div class="grid-abe">
                <div class="grid-item"></div>
                <div class="grid-item">ESFERICO</div>
                <div class="grid-item">CILINDRO</div>
                <div class="grid-item">EJE</div>
                <div class="grid-item">PRISMA</div>
                <div class="grid-item input-group-text w-100 font-weight-bold">OD</div>
                <input class="form-control"  step="0.01" name="esf_der" type="number">
                <input class="form-control"  step="0.01" name="cil_der" type="number">
                <input class="form-control"  step="0.01" name="eje_der" type="number">
                <input class="form-control"  step="0.01" name="pris_der" type="number">
                <div class="grid-item input-group-text w-100 font-weight-bold">OI</div>
                <input class="form-control"  step="0.01" name="esf_izq" type="number">
                <input class="form-control"  step="0.01" name="cil_izq" type="number">
                <input class="form-control"  step="0.01" name="eje_izq" type="number">
                <input class="form-control"  step="0.01" name="pris_izq" type="number">
              </div>
            </div>

            <div class="form-group">
                <div class="row">
                  <div class="col-6">
                    <div class="input-group">
                      <span class="input-group-text">DIP</span>
                      <input type="number" class="form-control input-lg" step="0.01" name="dip" placeholder="DIP">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="input-group">
                      <span class="input-group-text">ADD</span>
                      <input type="number" class="form-control input-lg" step="0.01" name="adicion" placeholder="ADD">
                    </div>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-th"></i></span>
                  <select name="id_optometra" class="form-control input lg" required="">
                    <option value="" disabled="" selected="">Seleccione Optometra</option>
                    <?php $res=ControladorClientes::ctrReadOptometras()?>
                    <?php while($row=$res->fetch_assoc()):?>
                      <option value="<?=$row["id"]?>"><?=$row["nombre"]?></option>
                    <?php endwhile ?>
                  </select>
              </div>
            </div>            
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer justify-content-between" style="padding: 0.75rem 2rem">
          <span class="btn btn-info btn-download-medida"><i class="fa fa-cloud-download-alt"></i></span>
          <div>
            <button type="submit" class="btn btn-success mr-1">Registrar Cliente</button>
            <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!--==========================
MODAL COMPRAS CLIENTE
==========================-->
<div class="modal fade" id="modalComprasCliente">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!--------------------------FORMULARIO------------------------------>
      <form role="form" id="formComprasCliente">
        <!-- Modal Header -->
        <div class="modal-header bg-success text-white">
          <h4 class="modal-title">Compras Cliente</h4>
          <!-- INPUT HIDDEN PARA EL METODO DE POST -->
          <input type="hidden" name="dataid">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
              <div class="grid-compras">
                <div class="compras-titulos">
                  <div class="grid-item font-weight-bold">#</div>
                  <div class="grid-item font-weight-bold">TOTAL</div>
                  <div class="grid-item font-weight-bold">FECHA</div>
                  <div class="grid-item font-weight-bold"></div>
                </div>
                <!-- PRODUCTOS -->
              </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <a href="" type="button" class="btn btn-success">Nueva Compra</a>
          <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--===============================================
FRGMENT MODAL COMPRAS CLIENTE
===============================================-->
<template id="template-compras">
  <div class="compras-item">
    <div class="compras-first mb-2">
      <input class="form-control" name="orden" type="text" readonly>
      <div class="input-group">
        <span class="input-group-text font-weight-bold">S/.</span>         
        <input class="form-control" name="total" type="text" readonly>
      </div>
      <input class="form-control" name="fecha" type="date" readonly>
      <a href="#" class="btn btn-info ruta"><i class="fa fa-shopping-cart"></i></a>
    </div>
    <div class="compras-second">
      <div class="input-group">
        <span class="input-group-text">
          <i class="nav-icon fa fa-box-open"></i>
        </span>
        <input class="form-control" name="producto" type="text" readonly>
      </div>
      <div class="input-group">
        <span class="input-group-text">
          <i class="nav-icon fa fa-user-cog"></i>
        </span>              
        <input class="form-control" name="vendedor" type="text" readonly>
      </div>
    </div>
  </div>                      
</template>


<script src="/blueopticas/vista/js/clientes.js"></script>
<!-- INPUT MASK  -->
<script src="/blueopticas/vista/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- HTML2CANVA -->
<script src="/blueopticas/vista/plugins/html2canvas/html2canvas.min.js"></script>
<script src="/blueopticas/vista/plugins/moment/moment.min.js"></script>
<script>
  $('[data-mask]').inputmask();
</script>
