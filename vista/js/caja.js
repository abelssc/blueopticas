window.addEventListener("DOMContentLoaded",()=>{
    const $date=document.querySelector("#fecha");

    const $totalAcuenta=document.querySelector("#totalAcuenta");
    const $totalRecojos=document.querySelector("#totalRecojos");
    const $ingresosTotal=document.querySelector("#ingresosTotal");

    const $totalGastos=document.querySelector("#totalGastos");

    const $efectivo=document.querySelector("#efectivo");
    const $deposito=document.querySelector("#deposito");
    const $total=document.querySelector("#total");

    $date.addEventListener("change",e=>{
        caja(e.target.value);
        llenarDatosTabla(e.target.value);
    })
    const llenarDatosResumen=(json)=>{
        const acuenta=parseFloat(json.acuenta??0);
        const recojos=parseFloat(json.recojos??0);
        const gastos=parseFloat(json.gastos??0);
        const efectivo=parseFloat(json.efectivo??0);
        const deposito=parseFloat(json.deposito??0);

        $totalAcuenta.textContent=acuenta;
        $totalRecojos.textContent=recojos;
        $ingresosTotal.textContent=acuenta+recojos;

        $totalGastos.textContent=gastos;

        $efectivo.textContent=efectivo;
        $deposito.textContent=deposito;
        $total.textContent=acuenta+recojos-gastos;
    }
    const llenarDatosTabla=(fecha)=>{
        tablaVentas.ajax.url(`ajax/ventas.ajax.php?datatableVentasDia=${fecha}`);
        tablaVentas.ajax.reload();
        tablaRecojos.ajax.url(`ajax/ventas.ajax.php?datatableRecojosDia=${fecha}`);
        tablaRecojos.ajax.reload();
        tablaGastos.ajax.url(`ajax/gastos.ajax.php?tablaGastosDia=${fecha}`);
        tablaGastos.ajax.reload();

    }
    const caja=(fecha)=>{
        fetch(`ajax/caja.ajax.php?date=${fecha}`)
        .then(rs=>rs.ok?rs.json():Promise.reject(rs))
        .then(json=>{
            llenarDatosResumen(json);
        })
    }
    let hoy=new Date().toLocaleDateString();
    hoy=hoy.split("/").reverse().join("-");
    caja(hoy);


    /*--===============================================
    EVENTOS CLICK
    =================================================*/
    const $caja=document.querySelector(".content-wrapper");
    document.addEventListener("click",e=>{
        if(e.target.closest(".btn-download-caja")){
            document.querySelector(".fechaventasdeldia").textContent=`${$date.value}`
            print();
           
        }
    })
})
