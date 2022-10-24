window.addEventListener("DOMContentLoaded",()=>{
    document.addEventListener("click",e=>{
    /*--===============================================
    OBTENER DATOS MODAL ACTUALIZAR PRODUCTOS
    =================================================*/
        if(e.target.closest(".btnEditarProducto")){
            $id=e.target.closest(".btnEditarProducto").dataset.id;

            fetch('ajax/productos.ajax.php',{
                method:'POST',
                headers:{
                    'Content-Type': 'application/json'
                },
                body:JSON.stringify({id:$id,modal:"editar"})
            })
            .then(rs=>rs.json())
            .then(rs=>{
                console.log(rs);
                console.log("stock:"+ rs.stock,typeof rs.stock);
                console.log("preciocompra:"+ rs.preciocompra,typeof rs.preciocompra);
                console.log("precioventa:"+ rs.precioventa,typeof rs.precioventa);

                const producto=rs;
                $form=document.querySelector("#formEditarProducto");
                $form.id.value=producto.id;
                $form.producto.value=`${producto.producto}`;
        
                $form.categoria.querySelector(`[value='${producto.categorias_id}']`).selected=true;

                $form.stock.value=producto.stock;
                $form.preciocompra.value=producto.preciocompra;
                $form.precioventa.value=producto.precioventa;

                $form.foto.nextElementSibling.textContent=producto.foto;     
                if(producto.foto){
                    $form.querySelector(".file_imagen_editar").src=`vista/imagenesbd/productos/${producto.foto}`;
                    $form.prevFoto.value=producto.foto;
                }else{
                    $form.querySelector(".file_imagen_editar").src=`vista/imagenesbd/profile.png`;
                    $form.prevFoto.value=``;
                }   
            })
            .catch(err=>console.log(err))
        }
    /*--===============================================
    ELIMINAR productoS
    =================================================*/
        if(e.target.closest(".btnEliminarProducto")){
            $id=e.target.closest(".btnEliminarProducto").dataset.id;
            Swal.fire({
                title: 'Esta seguro de eliminar la categoria?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('ajax/productos.ajax.php',{
                        method:'POST',
                        headers:{
                            'Content-Type':'application/json'
                        },
                        body: JSON.stringify({id:$id,modal:"eliminar"})
                    })
                    .then(()=>{
                        Swal.fire(
                            'Eliminado!',
                            'El producto ha sido eliminado.',
                            'success'
                        )
                        .then(rs=>window.location='productos');
                        
                    })
                    .catch(err=>{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Surgio un error:!',
                            footer: `${err}`
                        })
                    })
                }
            })    
        }
    })
})
 /*--===============================================
    MOSTRAR IMG MODAL AGREGAR Y ACTUALIZAR
    =================================================*/
        // Para Crear
        const $foto_agregar=document.querySelector(".file_foto_agregar");
        const $imagen_agregar=document.querySelector(".file_imagen_agregar");

        $foto_agregar.addEventListener("change",()=>{
                let path=URL.createObjectURL($foto_agregar.files[0]);
                $imagen_agregar.src=path;
        })
        // Para actualizar
        const $foto_editar=document.querySelector(".file_foto_editar");
        const $imagen_editar=document.querySelector(".file_imagen_editar");

        $foto_editar.addEventListener("change",()=>{
                let path=URL.createObjectURL($foto_editar.files[0]);
                $imagen_editar.src=path;
        }) 
        // Actualizar Label de la imagen
        document.querySelectorAll(".custom-file-input").forEach(input=>{
            input.addEventListener("change",function(){
            let filename=input.value.split("\\").pop();
            input.nextElementSibling.textContent=filename
          })
        });   