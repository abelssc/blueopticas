<link rel="stylesheet" href="vista/plugins/chart.js/Chart.css">
<div class="content-wrapper" style="min-height: 1604.44px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tablero</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Tablero</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?=ControladorChart::getCountTabla("ventas")?></h3>

                  <p>Ventas / Ordenes</p>
                </div>
                <div class="icon">
                  <i class="fa fa-shopping-bag"></i>
                </div>
                <a href="administrar-ventas" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?=ControladorChart::getCountTabla("clientes")?></h3>

                  <p>Clientes Registrados</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user-plus"></i>
                </div>
                <a href="clientes" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>            
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?=ControladorChart::getCountTabla("categorias")?></h3>
                  <p>Categorias Ingresadas</p>
                </div>
                <div class="icon">
                  <i class="fa fa-tag"></i>
                </div>
                <a href="categorias" class="small-box-footer">Más información <i class="fa fa-tag"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?=ControladorChart::getCountTabla("productos")?></h3>
                  <p>Productos Registrados</p>
                </div>
                <div class="icon">
                  <i class="fa fa-box-open"></i>
                </div>
                <a href="productos" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Ventas Anuales</h3>
                  <a href="administrar-ventas">Ver Reporte</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">S/.<?=ControladorChart::ctrgetVentaTotalYear()?></span>
                    <span>Ventas del año</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="datayear">
                      <i class="fas"></i>
                    </span>
                    <span class="text-muted">Respecto al año anterior</span>
                  </p>
                </div>
                <canvas id="chartVentas" ></canvas>
              </div>
              
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Ventas Semanales</h3>
                  <a href="administrar-ventas">Ver Reporte</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">S/.<?=ControladorChart::ctrgetVentaTotalWeek()?></span>
                    <span>Ventas de la semana</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success dataweek">
                      <i class="fas"></i>
                    </span>
                    <span class="text-muted">Respecto a la semana anterior</span>
                  </p>
                </div>
                <canvas id="chartVentasWeek"></canvas>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </section>
</div>
    <!-- /.content -->
  <script src="vista/plugins/chart.js/Chart.v3.9.1.min.js"></script>
  <script>
    /*--===============================================
    CHART MENSUAL
    =================================================*/
 const labels = [
    'Enero',
    'Febrero',
    'Marzo',
    'Abril',
    'Mayo',
    'Junio',
    'Julio',
    'Agosto',
    'Septiembre',
    'Octubre',
    'Noviembre',
    'Diciembre'
  ];

  const data = {
    labels: labels,
    datasets: [
      {
      label: '2021',
      backgroundColor: 'rgba(200,200,200,0.2)',
      borderColor: 'rgb(200,200,200)',
      data: [20, 30, 15, 2, 10, 3,5],
      fill: true,
      type:"line"
      // tension: 0.4
      } ,
      {
      label: '2022',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: <?=ControladorChart::ctrgetVentaYear(0)?>,
      fill: true
      }
    ]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom',
          align: 'end'
        }
      }
    }
  };
  
  const myChart = new Chart(
    document.getElementById('chartVentas'),
    config
  );
  /*--===============================================
  CHART SEMANAL
  =================================================*/
  const labels2 = [
    'Lunes',
    'Martes',
    'Miercoles',
    'Jueves',
    'Viernes',
    'Sabado',
    'Domingo'
  ];
  const data2={
    labels:labels2,
    datasets:[
    {
      label:"Semana Anterior",
      backgroundColor: 'rgb(200,200,200)',
      borderColor: 'rgb(200,200,200)',
      data:<?=ControladorChart::ctrgetVentaWeek(1)?>,
      // tension:0.2

    },
    {
      label:"Esta Semana",
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data:<?=ControladorChart::ctrgetVentaWeek(0)?>,
      // tension:0.2
    }
    ]
  }
  const config2={
    type:"line",
    data:data2,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom',
          align: 'end'
        }
      }
    }
  }
  const chartWeek=new Chart(document.querySelector("#chartVentasWeek"),config2);
  </script>
  <script src="vista/js/chart.js"></script>