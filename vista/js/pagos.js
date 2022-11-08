window.addEventListener("DOMContentLoaded",()=>{
    const $formPago=document.querySelector("#formCrearPago");
    const $formEditar=document.querySelector("#formEditarPago");

    $formPago.addEventListener("change",(e)=>{
        if(e.target.matches("[name=orden]")){
            ruta=`ajax/pagos.ajax.php?orden=${e.target.value}`;
            fetch(ruta)
            .then(rs=>rs.json())
            .then(rs=>{
                if(rs){
                    $formPago.deuda.value=rs.debe;
                    $formPago.cliente.value=rs.cliente;
                }else{
                    swal.fire(
                        'No existe la orden',
                        `${$formPago.orden.value}`,
                        'error'
                    )
                    $formPago.reset();
                }
            })
        }
    })

    document.addEventListener("submit",e=>{
        e.preventDefault();
        if(e.target.matches("#formCrearPago")){
            $ventas_id=$formPago.orden.value;
            $pagos_id=$formPago.pagos_id.value;
            $fecha=$formPago.fecha.value
            $monto=$formPago.monto.value;
            
            data=new FormData();
            data.append("crear","");
            data.append("ventas_id",$ventas_id);
            data.append("pagos_id",$pagos_id);
            data.append("fecha",$fecha);
            data.append("monto",$monto);

            fetch("ajax/pagos.ajax.php",{
                method:"POST",
                body:data
            })
            .then(rs=>{
                if(rs.ok){
                    $("#modalIngresarPago").modal("hide");
                    $formPago.reset();
                    swal.fire(
                        'Se registro la orden',
                        `${$ventas_id}`,
                        'success'
                    )
                    datatable.ajax.reload(null,false);// user paging is not reset on reload
                    $formPago.reset();    
                }else{
                    swal.fire(
                        'Error al registrar la orden',
                        `${$ventas_id}`,
                        'error'
                    )
                }
            })
        }
        if(e.target.matches("#formEditarPago")){
            $id=$formEditar.dataid.value;
            $ventas_id=$formEditar.orden.value;
            $pagos_id=$formEditar.pagos_id.value;
            $fecha=$formEditar.fecha.value
            $monto=$formEditar.monto.value;
            
            data=new FormData();
            data.append("editar","");
            data.append("id",$id);
            data.append("ventas_id",$ventas_id);
            data.append("pagos_id",$pagos_id);
            data.append("fecha",$fecha);
            data.append("monto",$monto);

            fetch("ajax/pagos.ajax.php",{
                method:"POST",
                body:data
            })
            .then(rs=>{
                if(rs.ok){
                    $("#modalEditarPago").modal("hide");
                    $formEditar.reset();
                    swal.fire(
                        'Se registro la orden',
                        `${$ventas_id}`,
                        'success'
                    )
                    datatable.ajax.reload(null,false);// user paging is not reset on reload  
                }else{
                    swal.fire(
                        'Error al registrar la orden',
                        `${$ventas_id}`,
                        'error'
                    )
                }
            })
        }
    })

    document.addEventListener("click",(e)=>{
        if(e.target.closest(".btnEditarPago")){
            $id=e.target.closest(".btnEditarPago").dataset.id;
            
            ruta=`ajax/pagos.ajax.php?idEdit=${$id}`;
            fetch(ruta)
            .then(rs=>rs.json())
            .then(rs=>{
                if(rs){
                    $formEditar.fecha.value=rs.fecha;
                    $formEditar.orden.value=rs.orden;
                    $formEditar.deuda.value=rs.debe;
                    $formEditar.cliente.value=rs.cliente;
                    $formEditar.pagos_id.value=rs.pagos_id;
                    $formEditar.monto.value=rs.monto;
                    $formEditar.dataid.value=rs.id;
                }else{
                    swal.fire(
                        'No existe la orden',
                        `${$formEditar.orden.value}`,
                        'error'
                    )
                    $formEditar.reset();
                }
            })
        }
        if(e.target.closest(".btnEliminarPago")){
            $id=e.target.closest(".btnEliminarPago").dataset.id;
            Swal.fire({
                title: 'Esta seguro de eliminar el pago?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminarlo!'
            })
            .then(result=>{
                if(result.isConfirmed){
                    ruta=`ajax/pagos.ajax.php?delete=${$id}`;
                    fetch(ruta)
                    .then(rs=>{
                        if(rs.ok){
                            swal.fire(
                                'Se elimino el pago',
                                `${$id}`,
                                'success'
                            )
                            datatable.ajax.reload(null,false);
                        }else{
                            swal.fire(
                                'Surgio un error',
                                `${$id}`,
                                'error'
                            ) 
                        }
                    })
                }
            })
            
        }
    })
})