<div class="content-wrapper" style="min-height: 1604.44px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Productos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Productos</li>
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
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">Agregar Producto</button>
        </div>
        <div class="card-body">
          <table id="tablaProductos" class="table table-hover">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Categoria</th>
                <th>Stock</th>
                <th>Precio de Compra</th>
                <th>Precio de Venta</th>
                <th>Agregado</th>
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
                  <td class="t_foto"><img class="img-thumbnail" width="40px"></td>
                  <td class="t_producto"></td>
                  <td class="t_categoria"></td>
                  <td class="t_stock"></td>
                  <td class="t_preciocompra"></td>
                  <td class="t_precioventa"></td>
                  <td class="t_agregado"></td>
                  <td>
                  <div class="btn-group">
                      <button class="btn btn-warning btnEditarProducto" data-toggle="modal" data-target="#modalEditarProducto"><i class="fa fa-pencil-alt text-white"></i></button>
                      <button class="btn btn-danger btnEliminarProducto" data-toggle="modal" data-target="#modalEliminarProducto"><i class="fa fa-times"></i></button>
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
    fetch("ajax/productos.ajax.php")
    .then(rs=>rs.json())
    .then(json=>{
      // Obtenemos los templates
      $template=document.querySelector("#t_template");
      // Creamos el fragment
      $fragment=document.createDocumentFragment("fragment");
      // itero
      json.forEach(producto => {
          let $clone=document.importNode($template.content,true);
          $clone.querySelector(".t_id").textContent=producto["id"];
          if(Boolean(producto["foto"])){
            $clone.querySelector(".t_foto img").setAttribute("src",`vista/imagenesbd/productos/${producto["foto"]}`);
          }else{
            $clone.querySelector(".t_foto img").setAttribute("src",`vista/dist/img/profile.png`);
          }
          $clone.querySelector(".t_producto").textContent=producto["producto"];
          $clone.querySelector(".t_categoria").textContent=producto["categoria"];
          $clone.querySelector(".t_stock").textContent=producto["stock"];
          $clone.querySelector(".t_preciocompra").textContent=producto["preciocompra"];
          $clone.querySelector(".t_precioventa").textContent=producto["precioventa"];
          
          $clone.querySelector(".btnEditarProducto").setAttribute("data-id",producto["id"]);
          $clone.querySelector(".btnEliminarProducto").setAttribute("data-id",producto["id"]);
          
          $clone.querySelector(".t_agregado").textContent=producto["agregado"];
          $fragment.appendChild($clone);
      });
      document.querySelector("#t_body").appendChild($fragment);
    })
    .catch($error=>alert(`Surgio un ${error} al hacer la coneccion con la tabla de Productos`))
    .finally(()=>{
      //EJECUTAMOS DATATABLE
      new DataTable("#tablaProductos",{
        "responsive":true, 
        "lengthChange":true,
        "autoWidth":false,
        dom: '<"top d-flex justify-content-between"Bf>t<"bottom d-flex justify-content-between"lip>',
        "buttons": ["excel", "pdf", "print", "colvis"],
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
        "next": "->",
        "previous": "<-"}
        }
      })
      
    })
</script>

<!--==========================
MODAL AGREGAR PRODUCTO
==========================-->
<div class="modal fade" id="modalAgregarProducto">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!--------------------------FORMULARIO------------------------------>
      <form role="form" method="POST" enctype="multipart/form-data">
        <!-- Modal Header -->
        <div class="modal-header bg-primary text-white">
          <h4 class="modal-title">Agregar Producto</h4>
          <!-- INPUT HIDDEN PARA EL METODO DE POST -->
          <input type="hidden" name="agregarProducto">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-box-open"></i></span>
                <input type="text" class="form-control input-lg" name="producto" placeholder="Ingresar Producto" required pattern="^.{2,}$">
              </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-th"></i></span>
                  <select name="categoria" class="form-control input lg" required>
                    <option value="" disabled selected>Seleccione Categoria</option>
                    <?php $categoria=ModeloProductos::getMdlCategorias();?>
                    <?php while ($row=$categoria->fetch_assoc()):?>
                      <option value="<?= $row["id"]?>"><?= $row["categoria"]?></option>
                    <?php endwhile ?>
                  </select>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-check"></i></span>
                <input type="number" class="form-control input-lg" name="stock" placeholder="Stock">
              </div>
            </div>
            <div class="form-group">
                <div class="row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa fa-arrow-down"></i></span>
                      <input type="text" class="form-control input-lg" name="preciocompra" placeholder="Precio de Compra" pattern="^\d*(\.\d{0,2})?$">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa fa-arrow-up"></i></span>
                      <input type="text" class="form-control input-lg" name="precioventa" placeholder="Precio de Venta" pattern="^\d*(\.\d{0,2})?$">
                    </div>
                  </div>
                </div>
            </div>
            
            <div class="form-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input file_foto_agregar" name="foto" accept="image/png,image/jpeg,image/webp" lang="es">
                <label class="custom-file-label" for="customFile">Elegir Foto</label>
              </div>
              <p class="text-muted">Peso Máximo de la foto 5mb</p>
              
              <img src="vista/dist/img/profile.png" class="img-thumbnail file_imagen_agregar agregar" width="100px">
            </div>   
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Registrar Producto</button>
          <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>
        
        </div>
      </form>
    </div>
  </div>
</div>
<?php
  $crearProducto=new ControladorProductos();
  $crearProducto->ctrCrearProducto();
?>
<!--==========================
MODAL EDITAR Producto
==========================-->
<div class="modal fade" id="modalEditarProducto">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!----------------------INICIA EL FORMULARIO---------------------------->
      <form role="form" method="POST" enctype="multipart/form-data" id="formEditarProducto">
        <!-- Modal Header -->
        <div class="modal-header bg-primary text-white">
          <h4 class="modal-title">Editar Producto</h4>
          <!-- INPUT HIDDEN PARA EL METODO DE POST -->
          <input type="hidden" name="editarProducto">
          <input type="hidden" name="id">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-box-open"></i></span>
                <input type="text" class="form-control input-lg" name="producto" placeholder="Ingresar Producto" required pattern="^.{2,}$">
              </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-th"></i></span>
                  <select name="categoria" class="form-control input lg" required>
                    <option value="" disabled selected>Seleccione Categoria</option>
                    <?php $categoria=ModeloProductos::getMdlCategorias();?>
                    <?php while ($row=$categoria->fetch_assoc()):?>
                      <option value="<?= $row["id"]?>"><?= $row["categoria"]?></option>
                    <?php endwhile ?>
                  </select>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-check"></i></span>
                <input type="number" class="form-control input-lg" name="stock" placeholder="Stock">
              </div>
            </div>
            <div class="form-group">
                <div class="row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa fa-arrow-down"></i></span>
                      <input type="text" class="form-control input-lg" name="preciocompra" placeholder="Precio de Compra" pattern="^\d*(\.\d{0,2})?$">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa fa-arrow-up"></i></span>
                      <input type="text" class="form-control input-lg" name="precioventa" placeholder="Precio de Venta" pattern="^\d*(\.\d{0,2})?$">
                    </div>
                  </div>
                </div>
            </div>
            
            <div class="form-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input file_foto_editar" name="foto" accept="image/png,image/jpeg,image/webp" lang="es">
                <label class="custom-file-label" for="customFile">Elegir Foto</label>
                <input type="hidden" name="prevFoto">
              </div>
              <p class="text-muted">Peso Máximo de la foto 5mb</p>
              
              <img src="vista/dist/img/profile.png" class="img-thumbnail file_imagen_editar editar" width="100px">
            </div>   
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Actualizar Producto</button>
          <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>
        
        </div>
      </form>
    </div>
  </div>
</div>
<?php
  $editarProducto=new ControladorProductos();
  $editarProducto->ctrActualizarProducto();
  
?>
<style>
  .custom-file-input ~ .custom-file-label::after {
    content: "Elegir";
}
</style>
<script src="/blueopticas/vista/js/productos.js"></script>
