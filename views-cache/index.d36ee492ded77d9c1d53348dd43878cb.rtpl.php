<?php if(!class_exists('Rain\Tpl')){exit;}?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 1.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">CPU Traffic</span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-check-square-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Votos</span>
              <span class="info-box-number">413</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-child"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Usuarios</span>
              <span class="info-box-number">109</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Candidatos</span>
              <span class="info-box-number">87</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
            <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
          <!-- MAP & BOX PANE -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Mapa de votos</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body text-center">
              <div id="container">
                <script src="https://code.highcharts.com/maps/highmaps.js"></script>
                <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
                <script src="https://code.highcharts.com/mapdata/countries/br/br-all.js"></script>

    <script>


// Prepare demo data
// Data is joined to map using value of 'hc-key' property by default.
// See API docs for 'joinBy' for more info on linking data and map.
var data = [
    ['br-sp', 0],
    ['br-ma', 1],
    ['br-pa', 2],
    ['br-sc', 3],
    ['br-ba', 4],
    ['br-ap', 5],
    ['br-ms', 6],
    ['br-mg', 7],
    ['br-go', 8],
    ['br-rs', 9],
    ['br-to', 10],
    ['br-pi', 11],
    ['br-al', 12],
    ['br-pb', 13],
    ['br-ce', 14],
    ['br-se', 15],
    ['br-rr', 16],
    ['br-pe', 17],
    ['br-pr', 18],
    ['br-es', 19],
    ['br-rj', 20],
    ['br-rn', 21],
    ['br-am', 22],
    ['br-mt', 23],
    ['br-df', 24],
    ['br-ac', 25],
    ['br-ro', 46]
];

// Create the chart
Highcharts.mapChart('container', {
    chart: {
        map: 'countries/br/br-all'
    },

    title: {
        text: 'Mapa de calor'
    },

    subtitle: {
        text: 'Fonte: <a href="http://code.highcharts.com/mapdata/countries/br/br-all.js">Brazil</a>'
    },

    mapNavigation: {
        enabled: true,
        buttonOptions: {
            verticalAlign: 'bottom'
        }
    },

    colorAxis: {
        min: 1
    },

    series: [{
        data: data,
        name: 'Votos por região',
        states: {
            hover: {
                color: '#BADA55'
            }
        },
        dataLabels: {
            enabled: true,
            format: '{point.name}'
        }
    }]
});</script>
    </div>

                <!-- /.col
                <div class="col-md-3 col-sm-4 ">
                  <div class="panel-group ">
                    <div class="panel panel-primary">
                      <div class="panel-heading">TOTAL DE VISITAS SITE</div>
                      <div class="panel-body"><?php echo htmlspecialchars( $visits["visitsTotal"], ENT_COMPAT, 'UTF-8', FALSE ); ?> Visitas</div>
                    </div>

                    <div class="panel panel-primary">
                      <div class="panel-heading">TOTAL DE VISITAS API</div>
                      <div class="panel-body"><?php echo htmlspecialchars( $visits["visitsTotal"], ENT_COMPAT, 'UTF-8', FALSE ); ?> Visitas</div>
                    </div>

                    <div class="panel panel-primary">
                      <div class="panel-heading">VISITAS DE HOJE SITE</div>
                      <div class="panel-body"><?php echo htmlspecialchars( $visits["visitsToday"], ENT_COMPAT, 'UTF-8', FALSE ); ?> Visitas</div>
                    </div>

                    <div class="panel panel-primary">
                      <div class="panel-heading">VISITAS DE HOJE API</div>
                      <div class="panel-body"><?php echo htmlspecialchars( $visits["visitsToday"], ENT_COMPAT, 'UTF-8', FALSE ); ?> Visitas</div>
                    </div>
                  </div>-->

                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
               <div class="row">

                <!-- Alterar o link para o link do projeto-->
                        <div class="col-md-6 text-right">
                          <a href="https://analytics.google.com/analytics/web/?authuser=1#/report-home/a127088228w185918552p183013777" class="btn btn-primary" role="button" target="_blank">Ver Visitas</a>
                        </div>
                        <div class="col-md-6 text-left">
                          <a href="/admin/places" class="btn btn-primary" role="button">Ver geoestatisticas</a>
                        </div>
                </div>

               </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->