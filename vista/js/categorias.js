window.addEventListener("DOMContentLoaded",()=>{
    document.addEventListener("click",e=>{
    /*--===============================================
    OBTENER DATOS MODAL ACTUALIZAR CATEGORIA
    =================================================*/
        if(e.target.closest(".btnEditarCategoria")){
            $id=e.target.closest(".btnEditarCategoria").dataset.id;

            fetch('ajax/categorias.ajax.php',{
                method:'POST',
                headers:{
                    'Content-Type': 'application/json'
                },
                body:JSON.stringify({id:$id,modal:"editar"})
            })
            .then(rs=>rs.json())
            .then(rs=>{
                const $categoria=rs;
                $form=document.querySelector("#formEditarCategoria");
                $form.id.value=$categoria.id;
                $form.categoria.value=$categoria.categoria;
            })
            .catch(err=>console.log(err))
        }
    
    /*--===============================================
    ELIMINAR CATEGORIAS
    =================================================*/
        if(e.target.closest(".btnEliminarCategoria")){
            $id=e.target.closest(".btnEliminarCategoria").dataset.id;
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
                    fetch('ajax/categorias.ajax.php',{
                        method:'POST',
                        headers:{
                            'Content-Type':'application/json'
                        },
                        body: JSON.stringify({id:$id,modal:"eliminar"})
                    })
                    .then(()=>{
                        Swal.fire(
                            'Eliminado!',
                            'La categoria ha sido eliminada.',
                            'success'
                        )
                        .then(rs=>window.location='categorias');
                        
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