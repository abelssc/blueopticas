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
            <tbody id="t_body">
              <!-- LLENADO DE LA TABLA -->
            </tbody>
          </table>
          <template id="t_template">
                <tr>
                  <td class="t_id"></td>
                  <td class="t_nombre"></td>
                  <td class="t_foto"><img class="img-thumbnail" width="40px"></td>
                  <td class="t_usuario"></td>
                  <td class="t_rol"></td>
                  <td class="t_estado"><button class="btn btn-xs"></button></td>
                  <td class="t_ultimo_login"></td>
                  <td>
                  <div class="btn-group">
                      <button class="btn btn-warning btnEditarUsuario" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil-alt text-white"></i></button>
                      <button class="btn btn-danger btnEliminarUsuario" data-toggle="modal" data-target="#modalEliminarUsuario"><i class="fa fa-times"></i></button>
                  </div>
                  </td>
                </tr>
              </template>             
            
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
    fetch("ajax/usuarios.ajax.php")
    .then(rs=>rs.json())
    .then(json=>{
      // Obtenemos los templates
      $template=document.querySelector("#t_template");
      // Creamos el fragment
      $fragment=document.createDocumentFragment("fragment");
      // itero
      json.forEach(user => {
          let $clone=document.importNode($template.content,true);
          $clone.querySelector(".t_id").textContent=user["id"];
          $clone.querySelector(".t_nombre").textContent=user["nombre"];
          if(Boolean(user["foto"])){
            $clone.querySelector(".t_foto img").setAttribute("src",`vista/imagenesbd/${user["foto"]}`);
          }else{
            $clone.querySelector(".t_foto img").setAttribute("src",`vista/dist/img/profile.png`);
          }
          $clone.querySelector(".t_usuario").textContent=user["usuario"];
          $clone.querySelector(".t_rol").textContent=user["rol"];
          if(user["estado"]=="1"){
              $clone.querySelector(".t_estado button").classList.add("btn-success");
              $clone.querySelector(".t_estado button").textContent="Activado";
  
          }else{
              $clone.querySelector(".t_estado button").classList.add("btn-danger");
              $clone.querySelector(".t_estado button").textContent="Desactivado";
  
          }
          $clone.querySelector(".btnEditarUsuario").setAttribute("data-id",user["id"]);
          // $clone.querySelector(".btnEditarUsuario").addEventListener("click",function(){console.log(this)})
          $clone.querySelector(".btnEliminarUsuario").setAttribute("data-id",user["id"]);
          
          $clone.querySelector(".t_ultimo_login").textContent=user["ultimo_login"];
          $fragment.appendChild($clone);
      });
      document.querySelector("#t_body").appendChild($fragment);
    })
    .catch($error=>alert(`Surgio un ${error} al hacer la coneccion con la tabla de usuarios`))
    .finally(()=>{
      //EJECUTAMOS DATATABLE
      new DataTable("#tablaUsuarios",{
        "responsive":true, 
        "lengthChange":true,
        "autoWidth":false,
        dom: '<"top d-flex justify-content-between"Bf>t<"bottom d-flex justify-content-between"lip>',
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
      }).buttons().container().appendTo('#tablaUsuarios_wrapper .col-md-6:eq(0)');
      
    })



</script>

<!--==========================
MODAL AGREGAR USUARIO
==========================-->
<div class="modal fade" id="modalAgregarUsuario">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form role="form" method="POST" enctype="multipart/form-data">
        <!-- Modal Header -->
        <div class="modal-header bg-primary text-white">
          <h4 class="modal-title">Agregar Usuario</h4>
          <!-- INPUT HIDDEN PARA EL METODO DE POST -->
          <input type="hidden" name="agregarUsuario">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nombre" placeholder="Ingresar Nombre" required pattern="^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-key"></i></span>
                  <input type="text" class="form-control input-lg" name="usuario" placeholder="Ingresar Usuario" required pattern="^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$">
              </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-lock"></i></span>
                  <input type="password" class="form-control input-lg" name="password" placeholder="Ingresar Contraseña" require>
              </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-users"></i></span>
                  <select name="rol" id="" class="form-control input lg" required>
                    <option value="" disabled selected>Seleccione Perfil</option>
                    <?php $roles=ModeloUsuarios::MdlMostrarRoles();?>
                    <?php while ($row=$roles->fetch_assoc()):?>
                      <option value="<?php echo $row["nombre_rol"]?>"><?php echo $row["nombre_rol"]?></option>
                    <?php endwhile ?>
                  </select>
              </div>
            </div>
            <div class="form-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input file_foto_agregar" name="foto" accept="image/png,image/jpeg,image/webp" lang="es">
                <label class="custom-file-label" for="customFile">Elegir Foto</label>
                <input type="hidden" name="prevFoto">
              </div>
              <p class="text-muted">Peso Máximo de la foto 200mb</p>
              
              <img src="vista/dist/img/profile.png" class="img-thumbnail file_imagen_agregar agregar" width="100px">
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
<?php
  $crearUsuario=new ControladorUsuarios();
  $crearUsuario->ctrCrearUsuario();
?>
<!--==========================
MODAL EDITAR USUARIO
==========================-->
<div class="modal fade" id="modalEditarUsuario">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form role="form" method="POST" id="formEditarUser" enctype="multipart/form-data">
        <!-- Modal Header -->
        <div class="modal-header bg-primary text-white">
          <h4 class="modal-title">Editar Usuario</h4>
          <input type="hidden" name="editarUsuario">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nombre" placeholder="Editar Nombre" required pattern="^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-key"></i></span>
                  <input type="text" class="form-control input-lg" name="usuario" placeholder="Editar Usuario" required pattern="^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$"  readonly>
              </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-lock"></i></span>
                  <input type="password" class="form-control input-lg" name="password" placeholder="Editar Contraseña">
                  <input type="hidden" name="prevPassword">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-users"></i></span>
                  <select name="rol" id="" class="form-control input lg" required>
                    <option value="" disabled selected>Seleccione Perfil</option>
                    <?php $roles=ModeloUsuarios::MdlMostrarRoles();?>
                    <?php while ($row=$roles->fetch_assoc()):?>
                      <option value="<?php echo $row["nombre_rol"]?>"><?php echo $row["nombre_rol"]?></option>
                    <?php endwhile ?>
                  </select>
              </div>
            </div>
            <div class="form-group">
              <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                <input type="checkbox" name="estado" class="custom-control-input" id="customSwitch3">
                <label class="custom-control-label" for="customSwitch3"></label>
              </div>
            </div>
            
            <div class="form-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input file_foto_editar" name="foto" accept="image/png,image/jpeg,image/webp" lang="es">
                <label class="custom-file-label" for="customFile">Elegir Foto</label>
                <input type="hidden" name="prevFoto">
              </div>

              <p class="text-muted">Peso Máximo de la foto 200mb</p>

              <img src="vista/dist/img/avatar.png" class="img-thumbnail file_imagen_editar" width="100px">
            </div>    
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
          <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>
        
        </div>
      </form>
    </div>
  </div>
</div>
<?php
  $editarUsuario=new ControladorUsuarios();
  $editarUsuario->ctrEditarUsuario();
  
?>
<style>
  .custom-file-input ~ .custom-file-label::after {
    content: "Elegir";
}
</style>
<script src="/blueopticas/vista/js/usuarios.js"></script>
