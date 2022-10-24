<div class="content-wrapper" style="min-height: 1604.44px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Usuarios</li>
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
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">Agregar Usuario</button>
        </div>
        <div class="card-body">
          <table id="tablaUsuarios" class="table table-hover">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Nombre</th>
                <th>Foto</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Ultimo Login</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Administrador</td>
                <td><img src="vista/dist/img/avatar.png" class="img-thumbnail" width="40px"></td>
                <td>admin</td>
                <td>Administrador</td>
                <td><button class="btn btn-success btn-xs">Activado</button></td>
                <td>2022-10-14 14:59:00</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning"><i class="fa fa-pencil-alt text-white"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>1</td>
                <td>Administrador</td>
                <td><img src="vista/dist/img/avatar.png" class="img-thumbnail" width="40px"></td>
                <td>admin</td>
                <td>Administrador</td>
                <td><button class="btn btn-success btn-xs">Activado</button></td>
                <td>2022-10-14 14:59:00</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning"><i class="fa fa-pencil-alt text-white"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>1</td>
                <td>Administrador</td>
                <td><img src="vista/dist/img/avatar.png" class="img-thumbnail" width="40px"></td>
                <td>admin</td>
                <td>Administrador</td>
                <td><button class="btn btn-success btn-xs">Activado</button></td>
                <td>2022-10-14 14:59:00</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning"><i class="fa fa-pencil-alt text-white"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>chel</td>
                <td><img src="vista/dist/img/avatar.png" class="img-thumbnail" width="40px"></td>
                <td>Chelsi</td>
                <td>Vendedor(a)</td>
                <td><button class="btn btn-danger btn-xs">Desactivado</button></td>
                <td>2022-10-14 14:59:00</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning"><i class="fa fa-pencil-alt text-white"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>
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
MODAL AGREGAR USUARIO
==========================-->
<!-- The Modal -->
<div class="modal fade" id="modalAgregarUsuario">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form role="form" method="POST" enctype="multipart/form-data">
        <!-- Modal Header -->
        <div class="modal-header bg-primary text-white">
          <h4 class="modal-title">Agregar Usuario</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nombre" placeholder="Ingresar Nombre" required>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-key"></i></span>
                  <input type="text" class="form-control input-lg" name="usuario" placeholder="Ingresar Usuario" required>
              </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-lock"></i></span>
                  <input type="text" class="form-control input-lg" name="password" placeholder="Ingresar Contraseña" required>
              </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-users"></i></span>
                  <select name="rol" id="" class="form-control input lg" required>
                    <option value="" disabled selected>Seleccione Perfil</option>
                    <option value="">Administrador</option>
                    <option value="">Vendedor(a)</option>
                    <option value="">Auxiliar</option>
                  </select>
              </div>
            </div>
            <div class="form-group">
              <div class="font-weight-bold">Subir Foto</div>
              <input type="file" id="foto" name="foto" accept="image/png,image/jpeg,image/webp">
              <p class="text-muted">Peso Máximo de la foto 200mb</p>

              <img src="vista/dist/img/avatar.png" class="img-thumbnail" width="100px">
            </div>    
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Registrar Usuario</button>
          <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>
        
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(function(){
    $("#tablaUsuarios").DataTable({
      "responsive":true, 
      "lengthChange":false,
      "autoWidth":false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "language": {
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
      "next": "Siguiente",
      "previous": "Anterior"}
      }
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  })
</script>