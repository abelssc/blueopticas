window.addEventListener("DOMContentLoaded",()=>{
    const $d=document;
    const $listabtnAgregar=[];
    const $formVenta=$d.querySelector("#formCrearVenta");

    // EVENTRO CLICK
    $d.addEventListener("click",(e)=>{
        /*--===============================================
        SELECCIONANDO PRODUCTOS
        =================================================*/
        if(e.target.matches(".btnAgregarProducto")){
            let $botonAgregar=e.target;
            $listabtnAgregar.push($botonAgregar);
            // REMOVIENDO CLASES
             $botonAgregar.classList.remove("btn-success", "btnAgregarProducto");
             $botonAgregar.classList.add("btn-default","btnRecuperarBoton");
            // OBTENEMOS LA DATA DEL DATATABLE
            let data;
            if( $botonAgregar.closest("tr").classList.contains("child")){
                data=datatable.row($botonAgregar.closest("tr").previousElementSibling).data();
            }else{
                data=datatable.row($botonAgregar.closest("tr")).data();
            }
            // ENVIAMOS DATOS AL FORMVenta
            const $template=$d.querySelector("#fragmentProductos");
            const $fragment=$d.createDocumentFragment();
            
            let $clone=document.importNode($template.content,true);
            $clone.querySelector(".btnRetirarProducto").dataset.id=data.id;
            $clone.querySelector(".producto").value=data.producto;
            
            $clone.querySelector(".cantidad").value=1;
            $clone.querySelector(".precioventa").value=data.precioventa;

            $fragment.appendChild($clone);
            $formVenta.querySelector(".nuevoProducto").appendChild($fragment);

            // ACTUALIZANDO PRECIO
            actualizarPrecio();
        }
        /*--===============================================
        RETIRANDO   PRODUCTOS
        =================================================*/
        if(e.target.closest(".btnRetirarProducto")){
            $id=e.target.closest(".btnRetirarProducto").dataset.id;
            // RETIRAMOS EL PRODUCTO
            e.target.closest(".product-item").outerHTML="";
            // ACTIVAMO EL BTN AGREGAR PRODUCTO
            // AQUI SURGE UN PROBLEMA, DEBIDO A QUE SI LA FILA DEL PRODUCTO A VOLVER A ACTICAR NO EXISTE EN EL DOM, NO NOS PERMITIRA ACCEDER A SU DATASET-ID, ENTONCES LO QUE SE HIZO FUE, GUARDAR EL NODO EN UNA VARIABLE, O EN UNA LISTA DE NODOS, ARREGLOS, Y ASI YA TENEMOS LA REFERENCIA AL NODO, DESDE JAVASCRIPT, Y YA NO LO NECESITAMOS EN EL DOM.
            $listabtnAgregar.forEach((btn,i)=>{
                if(btn.dataset.id==$id){
                    btn.classList.remove("btn-default","btnRecuperarBoton");
                    btn.classList.add("btn-success", "btnAgregarProducto");
                    $listabtnAgregar.splice(i,1);
                }
            })
            // ACTUALIZANDO PRECIO
            actualizarPrecio();
        }       
    })
    const actualizarPrecio=function(){
        let inputprecio=$formVenta.querySelectorAll("[name='precioventa']");
        let sum=0;
        for (let i = 0; i < inputprecio.length; i++) {
            sum+=parseFloat(inputprecio[i].value||0);
        }
        $formVenta.preciototal.value=sum;
        $formVenta.debe.value= $formVenta.preciototal.value-$formVenta.acuenta.value;
    }
    // EVENTO CHANGE
    $formVenta.addEventListener("change",actualizarPrecio);

   /*--===============================================
    EVENTOS SUBMIT
    =================================================*/
    document.addEventListener("submit",(e)=>{
        e.preventDefault();
        /*--===============================================
        CREATE CLIENTE
        =================================================*/
        if(e.target.matches("#formCrearCliente")){
            // OBTENEMOS DATOS
            let $formCliente=document.querySelector("#formCrearCliente");
            let $cliente=$formCliente.cliente.value;
            let $fecha_nacimiento=$formCliente.fecha_nacimiento.value.split("/").reverse().join("/");
            let $dni=$formCliente.dni.value.replaceAll(/[._]/g,"");
            let $celular=$formCliente.celular.value.replaceAll(/[.-]/g,"");
            // GUARDAMOS DATOS
            let datos=new FormData();
            datos.append("modal","crear");
            datos.append("cliente",$cliente);
            datos.append("fecha_nacimiento",$fecha_nacimiento);
            datos.append("dni",$dni);
            datos.append("celular",$celular);

            fetch("ajax/clientes.ajax.php",{
                method:"POST",
                body: datos
            })
            .then(rs=>rs.json())
            .then(rs=>{
                if(rs===true){
                    $("#modalCrearCliente").modal("hide");
                    swal.fire(
                        'Se Creo el cliente!',
                        'Bien',
                        'success'
                    )
                    $formCliente.querySelectorAll("input").forEach(input=>input.value="");

                }else{
                    swal.fire(
                        'Surgieron errores',
                        `${rs}`,
                        'error'
                    )
                }
            })

        }
    })


})