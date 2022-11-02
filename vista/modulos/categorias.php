<div class="content-wrapper" style="min-height: 1604.44px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categorias</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Categorias</li>
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
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">Agregar Categoria</button>
        </div>
        <div class="card-body">
          <table id="tablaCategorias" class="table table-hover">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Categoria</th>
                <th style="width: 100px;">Acciones</th>
              </tr>
            </thead>
            <tbody id="t_body">
              <!-- LLENADO DE LA TABLA -->
            </tbody>
          </table>
          <template id="t_template">
                <tr>
                  <td class="t_id"></td>
                  <td class="t_categoria text-uppercase"></td>
                  <td>
                  <div class="btn-group">
                      <button class="btn btn-warning btnEditarCategoria" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil-alt text-white"></i></button>
                      <button class="btn btn-danger btnEliminarCategoria" data-toggle="modal" data-target="#modalEliminarCategoria"><i class="fa fa-times"></i></button>
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
    fetch("ajax/categorias.ajax.php")
    .then(rs=>rs.json())
    .then(json=>{
      console.log(json);
      // Obtenemos los templates
      $template=document.querySelector("#t_template");
      // Creamos el fragment
      $fragment=document.createDocumentFragment("fragment");
      // itero
      json.forEach(categoria => {
          let $clone=document.importNode($template.content,true);
          $clone.querySelector(".t_id").textContent=categoria["id"];
          $clone.querySelector(".t_categoria").textContent=categoria["categoria"];

          $clone.querySelector(".btnEditarCategoria").setAttribute("data-id",categoria["id"]);

          $clone.querySelector(".btnEliminarCategoria").setAttribute("data-id",categoria["id"]);

          $fragment.appendChild($clone);
      });
      document.querySelector("#t_body").appendChild($fragment);
    })
    .catch(error=>console.log(`Surgio un ${error} al hacer la coneccion con la tabla de categorias`))
    .finally(()=>{
      //EJECUTAMOS DATATABLE
      new DataTable("#tablaCategorias",{
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
      }).buttons().container().appendTo('#tablaCategorias_wrapper .col-md-6:eq(0)');
      
    })



</script>

<!--==========================
MODAL AGREGAR CATEGORIA
==========================-->
<div class="modal fade" id="modalAgregarCategoria">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form role="form" method="POST" enctype="multipart/form-data">
        <!-- Modal Header -->
        <div class="modal-header bg-primary text-white">
          <h4 class="modal-title">Agregar Categoria</h4>
          <!-- INPUT HIDDEN PARA EL METODO DE POST -->
          <input type="hidden" name="agregarCategoria">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="categoria" placeholder="Ingresar Categoria" required pattern="^.{2,}$">
              </div>
            </div>  
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Registrar Categoria</button>
          <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
  $crearCategoria=new ControladorCategorias();
  $res=$crearCategoria->ctrCrearCategoria();
?>
<!--==========================
MODAL EDITAR Categoria
==========================-->
<div class="modal fade" id="modalEditarCategoria">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form role="form" method="POST" id="formEditarCategoria" enctype="multipart/form-data">
        <!-- Modal Header -->
        <div class="modal-header bg-primary text-white">
          <h4 class="modal-title">Editar Categoria</h4>
          <input type="hidden" name="editarCategoria">
          <input type="hidden" name="id">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="categoria" placeholder="Editar Categoria" required pattern="^.{2,}$">
              </div>
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
  $editarCategoria=new ControladorCategorias();
  $editarCategoria->ctrEditarCategoria();
  
?>
<style>
  .custom-file-input ~ .custom-file-label::after {
    content: "Elegir";
}
</style>
<script src="/blueopticas/vista/js/categorias.js"></script>
