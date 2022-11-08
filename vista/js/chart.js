window.addEventListener("DOMContentLoaded",()=>{
    $datayear=document.querySelector(".datayear");
    $dataweek=document.querySelector(".dataweek");

    const GETPERCENTAJE=($data,date)=>{
        fetch(`ajax/chart.ajax.php?${date}`)
        .then(rs=>rs.json())
        .then(percentaje=>{
            $data.innerHTML=$data.innerHTML+percentaje.toFixed(2)+"%";
            if(percentaje>=0){
                $data.classList.add("text-success");
                $data.querySelector(".fas").classList.add("fa-arrow-up");
            }
            else{
                $data.classList.add("text-danger");
                $data.querySelector(".fas").classList.add("fa-arrow-down");
            }
        })
    }

    // EJECUTAMOS
    GETPERCENTAJE($dataweek,"week");
    GETPERCENTAJE($datayear,"year");


})