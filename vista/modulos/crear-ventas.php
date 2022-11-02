<?php
  date_default_timezone_set('America/Lima');
?>
<link rel="stylesheet" href="/blueopticas/vista/plugins/select2/css/select2.css">
<script src="/blueopticas/vista/plugins/select2/js/select2.js"></script>

<div class="content-wrapper" style="min-height: 1604.44px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Crear Ventas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Ventas</a></li>
              <li class="breadcrumb-item active">Crear Ventas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    
      <div class="row">
        <!--===============================================
        CREAR VENTAS
        ===============================================-->
        <div class="col-lg-5 col-12">
            <div class="card card-success">
              <div class="card-header with-border"></div>
              <!-- FORMULARIO -->
              <form id="formCrearVenta">
                <div class="card-body">
                  <!-- FECHA -->
                  <div class="row mb-2 justify-content-end">
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="formDate" value="<?=date('Y-m-d')?>" name="fecha" required>  
                    </div>
                  </div>
                  <!-- USUARIO -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon input-group-text"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control" readonly value="<?=$_SESSION["usuario"]?>">
                      <input type="hidden" name="id_usuario" value="<?=$_SESSION["id"]?>" required>
                    </div>
                  </div>
                  <!-- N° ORDEN -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon input-group-text"><i class="fa fa-key"></i></span>
                      <input type="text" class="form-control" readonly value="10001" required name="id_venta">
                    </div>
                  </div>
                  <!-- CLIENTE -->
                  <div class="form-group row">
                    <div class="input-group col-sm-8 mb-3 mb-sm-0">
                      <span class="input-group-text"><i class="fa fa-users"></i></span>
                      <select class="form-control" required name="id_cliente" id="selectbuscador">
                        <option value='' disabled selected>Seleccione Cliente</option>
                      </select>
                    </div>
                    <div class="input-group col-sm-4">
                      <button type="button" class="btn btn-success w-100 btnCrearCliente" data-toggle="modal" data-target="#modalCrearCliente">Agregar Cliente</button>
                    </div>
                  </div>
                  <hr>
                  <!-- PRODUCTOS -->
                  <div class="form-group nuevoProducto">
                    <input type="hidden" name="listaProductos">
                    <div class="input-group mb-2 border-bottom">
                      <label>Productos: </label>
                    </div>
                  </div>
                  <hr>
                  <!-- PRECIO TOTAL -->
                  <div class="form-group row  justify-content-end">
                    <div class="col-sm-4 col-8">
                      <label for="">Total</label>
                      <div class="input-group">
                        <span class="input-group-text">S/.</span>
                        <input type="number" class="form-control input-lg" name="preciototal" readonly required>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <!-- METODO DE PAGO -->
                  <div class="form-group">
                    <div class="input-group">
                      <div class="row align-items-end">
                        <div class="input-group col-sm-4">
                          <select name="id_tipodepagos" id="" class="form-control" required>
                            <option value="" disabled selected>--Metodo de pago--</option>
                            <?php $res=ControladorVentas::ctrgetTiposdePago()?>
                            <?php while($row=$res->fetch_assoc()):?>
                              <option value="<?=$row['id']?>"><?=$row["tipodepago"]?></option>
                            <?php endwhile ?>
                          </select>
                        </div>
                        <div class="col-sm-8">
                          <div class="row justify-content-end">
                            <div class="col-8 col-sm-6">
                              <label for="">A cuenta:</label>
                              <div class="input-group">
                                <span class="input-group-text">S/.</span>
                                <input type="number" class="form-control" name="acuenta" required>
                              </div>
                            </div>
                            <div class="col-8 col-sm-6">
                              <label for="">Debe:</label>
                              <div class="input-group">
                                <span class="input-group-text">S/.</span>
                                <input type="number" class="form-control" name="debe" readonly required>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <!-- GUARDAR VENTA -->
                  <div class="row justify-content-end">
                    <button class="btn btn-primary">Guardar Venta</button>
                  </div>
                </div>
                <div class="card-footer">

                </div>
              </form>
            </div>
        </div>
        <!--===============================================
        TEMPLATE LISTA DE  PRODUCTOS 
        ===============================================-->
        <template id="fragmentProductos">
          <div class="row mb-2 product-item">
            <div class="input-group col-sm-6 mb-3 mb-sm-0">
              <button class="btn btn-danger btnRetirarProducto"><i class="fa fa-times"></i></button>
              <input class="form-control producto" type="text" name="producto" id="" readonly>
            </div>
            <div class="input-group col-sm-6">
              <div class="row ml-0">
                <input class="form-control col-4 cantidad" type="number" name="cantidad" id="" placeholder="Cantidad" required>
                <div class="input-group col-8">
                  <span class="input-group-text">S/.</span>
                  <input class="form-control precioventa" type="number" name="precioventa" id="" required>
                </div>
              </div>
            </div>
          </div>
        </template>
        
        <!--===============================================
        DATATABLE PRODUCTOS
        ===============================================-->
        <div class="col-lg-7 col-12">
          <div class="card card-warning">
            <div class="card-header with-boder"></div>
            <div class="card-body">
              <table id="tablaProductos" class="table table-hover">
                <thead>
                  <tr>
                    <th style="width: 10px;">#</th>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Categoria</th>
                    <th>Precio de Venta</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- LLENADO DE LA TABLA -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>



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
            <label>Celular o Teléfono</label>
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

  <!--===============================================
  SCRIPTS
  ===============================================-->
  <!--===============================================
  LLENADO DE TABLA
  ===============================================-->
  <script>
    const acciones=`
    <button class="btn btn-success btnAgregarProducto">Agregar</button>
    `
    $(document).ready(function(){
      datatable=$("#tablaProductos").DataTable({
        ajax:{
          "url":'ajax/ventas.ajax.php?datatable',
          "dataSrc":''
        },
        columns:[
          {data: 'id'},
          {data: 'foto'},
          {data: 'producto'},
          {data: 'categoria'},
          {data: 'precioventa'},
          {data: 'stock'},
          {data: 'acciones'}
          // {defaultContent: acciones}
        ],
        responsive:true, 
        lengthChange:false,
        autoWidth:false,
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
      })
    })
  </script>
  <script>
    $(document).ready(function(){
      $("#selectbuscador").select2({
          // minimumInputLength:2,
          ajax:{
            url:"ajax/ventas.ajax.php?dataclientes",
            dataType:"json",
            type:"GET",
            delay:250,
            data: function (params) {
              return {q:params.term}  
            },
            processResults:function(data){
              return {results:data}
            },
            cache:true

          }
      })
    })

  </script>
  <script src="/blueopticas/vista/js/ventas.js"></script>
  <!-- INPUT MASK  -->
  <script src="/blueopticas/vista/plugins/inputmask/jquery.inputmask.min.js"></script>
  <script src="/blueopticas/vista/plugins/moment/moment.min.js"></script>
  <script>
    $('[data-mask]').inputmask();
  </script>   