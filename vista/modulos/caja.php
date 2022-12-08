<div class="content-wrapper" style="min-height: 1604.44px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Caja</h1>
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
        CREAR VENTAS
        ===============================================-->
        <div class="col-12 col-lg-6">
            <div class="card card-success">
              <div class="card-header with-border"></div>
              <!-- FORMULARIO -->
              <form id="formCrearVenta" data-type="crear">
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
                      <input type="hidden" name="usuarios_id" value="<?=$_SESSION["id"]?>" required>
                    </div>
                  </div>
                  <!-- N° ORDEN -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon input-group-text"><i class="fa fa-key"></i></span>
                      <input type="text" class="form-control" readonly value="<?=ControladorVentas::ctrgetIdVenta()?>" required name="id_venta">
                    </div>
                  </div>
                  <!-- CLIENTE -->
                  <div class="form-group row">
                    <div class="input-group col-sm-8 mb-3 mb-sm-0">
                      <span class="input-group-text"><i class="fa fa-users"></i></span>
                      <select class="form-control" required name="clientes_id" id="selectbuscador">
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
                          <select name="pagos_id" id="" class="form-control" required>
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
                                <input type="number" class="form-control" name="acuenta" required min="0">
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
                  <!-- SITUACION -->
                  <div class="form-group">
                    <div>
                      <label for="">Estado:</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="fa fa fa-heartbeat"></i></span>
                        <select class="form-control" required name="situacion_id">
                            <option value='' disabled selected>Seleccione Estado</option>
                            <?php $rs=ControladorVentas::ctrgetTiposSituacion()?>
                            <?php while($row=$rs->fetch_assoc()):?>
                              <option value="<?=$row['id']?>"><?=$row['situacion']?></option>
                            <?php endwhile ?>
                        </select>
                      </div>
                    </div>
                    <div class="row d-none pendiente">
                      <div class="col-6">
                        <label for="">Fecha de recojo</label>
                        <input type="date" name="fecha_recojo" class="form-control">
                      </div>
                      <div class="col-6">
                        <label for="">Hora de recojo</label>
                        <input type="time" name="hora_recojo" class="form-control">
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
        DATATABLE PRODUCTOS
        ===============================================-->
        <div class="col-12 col-lg-6">
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
                    <!-- <th>Precio de Venta</th>
                    <th>Stock</th> -->
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



