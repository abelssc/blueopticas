window.addEventListener("DOMContentLoaded",()=>{
    const $formGasto=document.querySelector("#formCrearGasto");
    const $formEditar=document.querySelector("#formEditarGasto");

    document.addEventListener("submit",e=>{
        e.preventDefault();
        if(e.target.matches("#formCrearGasto")){
            let data=new FormData($formGasto);
            data.append("crear","");
            fetch("ajax/gastos.ajax.php",{
                method:"POST",
                body:data
            })
            .then(rs=>{
                if(rs.ok){
                    $("#modalIngresarGasto").modal("hide");
                    $formGasto.reset();
                    swal.fire(
                        'Se registro el gasto',
                        'Bien',
                        'success'
                    )
                    datatable.ajax.reload(null,false);// user paging is not reset on reload
                    $formGasto.reset();    
                }else{
                    swal.fire(
                        'Error al registrar el gasto',
                        'Bad',
                        'error'
                    )
                }
            })

        }
        if(e.target.matches("#formEditarGasto")){
            let data=new FormData();
            data.append("id",$formEditar.dataid.value);
            data.append("monto",$formEditar.monto.value);
            data.append("descripcion",$formEditar.descripcion.value);
            data.append("tipopago_id",$formEditar.tipopago_id.value)
            data.append("fecha",$formEditar.fecha.value)
            data.append("editar","");
            fetch("ajax/gastos.ajax.php",{
                method:"POST",
                body:data
            })
            .then(rs=>{
                if(rs.ok){
                    $("#modalEditarGasto").modal("hide");
                    $formGasto.reset();
                    swal.fire(
                        'Se registro el gasto',
                        'Bien',
                        'success'
                    )
                    datatable.ajax.reload(null,false);// user paging is not reset on reload
                    $formGasto.reset();    
                }else{
                    swal.fire(
                        'Error al registrar el gasto',
                        'Bad',
                        'error'
                    )
                }
            })

        }
    })
    document.addEventListener("click",e=>{
        if(e.target.closest(".btnEditarGasto")){
            let $id=e.target.closest(".btnEditarGasto").dataset.id;
            let ruta=`ajax/gastos.ajax.php?idEdit=${$id}`;
            fetch(ruta)
            .then(rs=>rs.json())
            .then(rs=>{
                if(rs){
                    $formEditar.fecha.value=rs.fecha;
                    $formEditar.monto.value=rs.monto;
                    $formEditar.tipopago_id.value=rs.tipopago_id;
                    $formEditar.descripcion.value=rs.descripcion;
                    $formEditar.dataid.value=rs.id;
                }else{
                    swal.fire(
                        'No existe el gasto',
                        `${$formEditar.orden.value}`,
                        'error'
                    )
                    $formEditar.reset();
                }
            })
        }
        if(e.target.closest(".btnEliminarGasto")){
            $id=e.target.closest(".btnEliminarGasto").dataset.id;
            Swal.fire({
                title: 'Esta seguro de eliminar el Gasto?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminarlo!'
            })
            .then(result=>{
                if(result.isConfirmed){
                    ruta=`ajax/gastos.ajax.php?delete=${$id}`;
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