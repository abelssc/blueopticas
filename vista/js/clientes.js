window.addEventListener("DOMContentLoaded",()=>{
    /*--===============================================
    EVENTOS CLICK
    =================================================*/
    document.addEventListener("click",e=>{
        /*--===============================================
        READ DATOS MODAL ACTUALIZAR CLIENTES
        =================================================*/
        if(e.target.closest(".btnEditarCliente")){
            // devolvemos como objeto los datos dentro del tr
            let data;
            if(e.target.closest("tr").classList.contains("child")){
                data=xdatatable.row(e.target.closest("tr").previousElementSibling).data();
            }else{
                data=xdatatable.row(e.target.closest("tr")).data();
            }
            //  Llenamos los datos del modal actualizar
            let $form=document.querySelector("#formEditarCliente");

            $form.dataid.value=data.id??"";
            $form.cliente.value=data.cliente??"";
            // $form.fecha_nacimiento.value=data.edad??"";
            $form.dni.value=data.dni??"";
            $form.celular.value=data.celular??""; 
        }
        /*--===============================================
        READ MEDIDAS
        =================================================*/
        if(e.target.closest(".btnMedidaCliente")){
            // Limpiamos valores previos
            let $form=document.querySelector("#formMedidaCliente");
            $form.querySelectorAll("input").forEach(input=>input.value="");
            // Obtenemos el ID de la row q invoco
            let data;
            if(e.target.closest("tr").classList.contains("child")){
                data=xdatatable.row(e.target.closest("tr").previousElementSibling).data();
            }else{
                data=xdatatable.row(e.target.closest("tr")).data();
            }
            let $id=data.id;
            let $cliente=data.cliente;
            $form.querySelector("h4").textContent=`${$cliente}`;

            let datos=new FormData();
            datos.append("id",$id);
            datos.append("modal","leerMedidas");
            fetch("ajax/clientes.ajax.php",{
                method:'POST',
                body: datos
            })
            .then(rs=>rs.json())
            .then(medida=>{
                if(medida){
                    
                    $form.esf_der.value=medida.esf_der;
                    $form.cil_der.value=medida.cil_der;
                    $form.eje_der.value=medida.eje_der;
                    $form.pris_der.value=medida.pris_der;
                    $form.esf_izq.value=medida.esf_izq;
                    $form.cil_izq.value=medida.cil_izq;
                    $form.eje_izq.value=medida.eje_izq;
                    $form.pris_izq.value=medida.pris_izq;
                    $form.dip.value=medida.dip;
                    $form.adicion.value=medida.adicion;
                    if(medida.id_optometra)
                        $form.id_optometra.querySelector(`[value='${medida.id_optometra}']`).selected=true;
                }
                
            })

        }
        /*--===============================================
        DELETE clienteS
        =================================================*/
        if(e.target.closest(".btnEliminarCliente")){
            let data;
            if(e.target.closest("tr").classList.contains("child")){
                data=xdatatable.row(e.target.closest("tr").previousElementSibling).data();
            }else{
                data=xdatatable.row(e.target.closest("tr")).data();
            }
            Swal.fire({
                title: 'Esta seguro de eliminar el cliente?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let datos=new FormData();
                    datos.append("id",data.id);
                    datos.append("modal","eliminar");

                    fetch('ajax/clientes.ajax.php',{
                        method:'POST',
                        body: datos
                    })
                    .then(rs=>rs.json())
                    .then(rs=>{
                        if(rs){
                            Swal.fire(
                                'Eliminado!',
                                'El cliente ha sido eliminado.',
                                'success'
                            )
                            xdatatable.ajax.reload(null,false);// user paging is not reset on reload
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Surgio un error :!',
                            })
                        }
                    })
                    .catch(err=>{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Surgio un error :!',
                            footer: `${err}`
                        })
                    })
                }
            })    
        }
    })

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
            let $form=document.querySelector("#formCrearCliente");
            let $cliente=$form.cliente.value;
            let $fecha_nacimiento=$form.fecha_nacimiento.value.split("/").reverse().join("/");
            let $dni=$form.dni.value.replaceAll(/[._]/g,"");
            let $celular=$form.celular.value.replaceAll(/[.-]/g,"");
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
                    xdatatable.ajax.reload(null,false);// user paging is not reset on reload
                    $form.querySelectorAll("input").forEach(input=>input.value="");

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
        UPDATE CLIENTE
        =================================================*/
        if(e.target.matches("#formEditarCliente")){
            // OBTENEMOS DATOS
            let $form=document.querySelector("#formEditarCliente");
            let $id=$form.dataid.value;
            let $cliente=$form.cliente.value;
            let $fecha_nacimiento=$form.fecha_nacimiento.value.split("/").reverse().join("/");
            let $dni=$form.dni.value.replaceAll(/[._]/g,"");
            let $celular=$form.celular.value.replaceAll(/[.-]/g,"");
            // GUARDAMOS DATOS
            let datos=new FormData();
            datos.append("id",$id);
            datos.append("modal","actualizar");
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
                    $("#modalEditarCliente").modal("hide");
                    swal.fire(
                        'Se Actualizo el cliente!',
                        'Bien',
                        'success'
                    )
                    xdatatable.ajax.reload(null,false);// user paging is not reset on reload
                    

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
