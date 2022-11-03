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
            $clone.querySelector(".product-item").dataset.id=data.id;
            $clone.querySelector(".btnRetirarProducto").dataset.id=data.id;
            $clone.querySelector(".producto").value=data.producto;
            
            $clone.querySelector(".cantidad").value=1;
            $clone.querySelector(".precioventa").value=data.precioventa;
            $clone.querySelector(".monto").value=data.precioventa;


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
        let inputcantidad=$formVenta.querySelectorAll("[name='cantidad']");
        let inputpreciounit=$formVenta.querySelectorAll("[name='precioventa']");
        let inputmonto=$formVenta.querySelectorAll("[name='monto']");
        for(let i= 0; i < inputmonto.length; i++){
            inputmonto[i].value=inputcantidad[i].value*inputpreciounit[i].value
        }
        let sum=0;
        for (let i = 0; i < inputmonto.length; i++) {
            sum+=parseFloat(inputmonto[i].value||0);
        }
        $formVenta.preciototal.value=sum;
        $formVenta.debe.value= $formVenta.preciototal.value-$formVenta.acuenta.value;
    }
    // EVENTO CHANGE
    $formVenta.addEventListener("change",e=>{
        // ACTUALIZAMOS PRECIO
        actualizarPrecio();
        // DISPLAY SITACIONES VALOR PENDIENTE
        if(e.target.name=="situacion_id"){
            if(e.target.value=="2"){
                $formVenta.querySelector(".pendiente").classList.remove("d-none");
            }else{
                $formVenta.querySelector(".pendiente").classList.add("d-none");
                $formVenta.fecha_recojo.value="";
                $formVenta.hora_recojo.value="";

            }
        }
    });

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

        /*--===============================================
        CREAR VENTA
        =================================================*/
        if(e.target.matches("#formCrearVenta")){
            // CAPTURAMOS VALORES PARA TABLA VENTAS
            // id venta default
            const ventas={
                fecha_recojo:$formVenta.fecha_recojo.value,
                hora_recojo:$formVenta.hora_recojo.value,
                situacion_id:$formVenta.situacion_id.value,
                usuarios_id:$formVenta.usuarios_id.value,
                clientes_id:$formVenta.clientes_id.value
            }
            
            // VALORES PARA TABLA PAGOSVENTAS
            // ventas_id=  SELECT LAST_INSERT_ID() from ventas
            const pagosventas={
                pagos_id:$formVenta.pagos_id.value,
                fecha:$formVenta.fecha.value,
                monto:$formVenta.acuenta.value
            }

            // VALORES PARA TABLA VENTASPRODUCTOS
            // ventas_id=SELECT LAST_INSERT_ID() from ventas
            // CAPTURAMOS LISTA DE PRODUCTOS: {productos_id,cantidad,precio}
            const $productos=$formVenta.querySelectorAll(".product-item");
            if(!$productos.length){
                swal.fire(
                    'Error',
                    'Debe Ingresar Algun Producto',
                    'error'
                )
                return;
            }
            const ventasproductos=[]
            $productos.forEach(producto=>{
                let id=producto.dataset.id;
                let cantidad=producto.querySelector("[name=cantidad]").value;
                let precio=producto.querySelector("[name=precioventa]").value;
                ventasproductos.push({productos_id:id,cantidad:cantidad,precio:precio})
            })
            const data=new FormData();
            data.append("ventas",JSON.stringify(ventas));
            data.append("pagosventas",JSON.stringify(pagosventas));
            data.append("ventasproductos",JSON.stringify(ventasproductos));

            fetch("ajax/ventas.ajax.php",{
                method:"POST",
                body:data
            })
            .then(rs=>rs.json())
            .then(rs=>{
                if(rs){
                    swal.fire(
                        'Se registro la venta',
                        `Venta N° ${rs}`,
                        'success'
                    )
                    // volvemos el formulario a su valor inicial 
                    $formVenta.reset();
                    console.log($formVenta);
                    // reseteamos botonos de acciones
                    $formVenta.querySelectorAll(".product-item").forEach(pr=>{
                        pr.outerHTML="";
                        $listabtnAgregar.forEach((btn,i)=>{               
                            btn.classList.remove("btn-default","btnRecuperarBoton");
                            btn.classList.add("btn-success", "btnAgregarProducto");
                            $listabtnAgregar.splice(i,1);
                        })
                    })
                    // reseteamos select2
                    $formVenta.querySelector(".select2-selection__rendered").textContent="Seleccione Cliente";
                    $formVenta.querySelector(".select2-selection__rendered").title="Seleccione Cliente";
                    // actualizamos nº venta
                    fetch("ajax/ventas.ajax.php?dataid")
                    .then(rs=>rs.json())
                    .then(rs=>$formVenta.id_venta.value=rs);
                }
            })      
        }
    })
})