window.addEventListener("DOMContentLoaded",()=>{
    document.addEventListener("click",e=>{
        /*--===============================================
            EDITAR USUARIO
        =================================================*/
        if(e.target.closest(".btnEditarUsuario")){
            $id=e.target.closest(".btnEditarUsuario").dataset.id;

            fetch('ajax/usuarios.actualizar.ajax.php',{
                method:'POST',
                headers:{
                    'Content-Type': 'application/json'
                },
                body:JSON.stringify({id:$id})
            })
            .then(rs=>rs.json())
            .then(rs=>{
                const user=rs[0];
                $form=document.querySelector("#formEditarUser");
                $form.nombre.value=`${user.nombre}`;
                $form.usuario.value=`${user.usuario}`;
                $form.prevPassword.value=`${user.password}`;
                $form.rol.querySelector(`[value='${user.rol}']`).selected=true;
                $form.foto.nextElementSibling.textContent=`${user.foto}`;
                
                if(Boolean(Number(user.estado))){
                    $form.estado.checked=true;
                    $form.estado.value="1";
                    $form.estado.nextElementSibling.textContent="Activado";
                    $form.estado.nextElementSibling.classList.remove("text-danger");
                    $form.estado.nextElementSibling.classList.add("text-success");
                }else{
                    $form.estado.checked=false;
                    $form.estado.nextElementSibling.textContent="Desactivado";
                    $form.estado.nextElementSibling.classList.remove("text-success");
                    $form.estado.nextElementSibling.classList.add("text-danger");
                }
                $form.estado.addEventListener("change",function(){
                    this.nextElementSibling.classList.toggle("text-danger");
                    this.nextElementSibling.classList.toggle("text-success");
                    if(this.checked){
                        this.nextElementSibling.textContent="Activado";
                        $form.estado.value="1";
                    }else{
                        this.nextElementSibling.textContent="Desactivado";
                    }
                })
                
                
                if(user.foto){
                    $form.querySelector(".file_imagen_editar").src=`vista/imagenesbd/${user.foto}`;
                    $form.prevFoto.value=`${user.foto}`;
                }else{
                    $form.querySelector(".file_imagen_editar").src=`vista/imagenesbd/profile.png`;
                    $form.prevFoto.value=``;
                }   
            })
        }
        /*--===============================================
            ELIMINAR USUARIO
        =================================================*/ 
        if(e.target.closest(".btnEliminarUsuario")){
            $id=e.target.closest(".btnEliminarUsuario").dataset.id;
            Swal.fire({
                title: 'Esta seguro de eliminar al usuario?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminarlo!'
              }).then((result) => {
                if (result.isConfirmed) {
                    fetch('ajax/usuarios.eliminar.ajax.php',{
                        method:'POST',
                        headers:{
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({id:$id})
                    })
                    .then(rs=>{
                        Swal.fire(
                            'Eliminado!',
                            'El usuario ha sido eliminado.',
                            'success'
                        )
                        .then(rs=>window.location='usuarios');
                        
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
ACTUALIZAR IMG DEL FORM
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

//ACTUALIZAR BTNACTIVADO DESACTIVADO

//ACTUALIZAR LBL FILE UPLOAD
document.querySelectorAll(".custom-file-input").forEach(input=>{
  	input.addEventListener("change",function(){
      let filename=input.value.split("\\").pop();
      input.nextElementSibling.textContent=filename
    })
});


