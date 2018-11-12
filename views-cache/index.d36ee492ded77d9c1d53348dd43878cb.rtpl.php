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
            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

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
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

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
              <h3 class="box-title">Visitors Report (Analytics)</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body text-center">
              <div class="row">
                <div class="col-md-12">
                <div id="embed-api-auth-container"></div>
                <div id="chart-container"></div>
                <div id="view-selector-container"></div>
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
                          <a href="https://analytics.google.com/analytics/web/?authuser=1#/report-home/a127088228w185918552p183013777" class="btn btn-primary" role="button" target="_blank">Mais estatisticas</a>
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

  <script>
(function(w,d,s,g,js,fs){
  g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
  js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
  js.src='https://apis.google.com/js/platform.js';
  fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
}(window,document,'script'));
</script>

<script>

gapi.analytics.ready(function() {

  /**
   * Authorize the user immediately if the user has already granted access.
   * If no access has been created, render an authorize button inside the
   * element with the ID "embed-api-auth-container".
   */
  gapi.analytics.auth.authorize({
    container: 'embed-api-auth-container',
    clientid: '584545529296-k3oltdf4e96ta7tpjsa6j5p8p5bfi32j.apps.googleusercontent.com'
  });


  /**
   * Create a new ViewSelector instance to be rendered inside of an
   * element with the id "view-selector-container".
   */
  var viewSelector = new gapi.analytics.ViewSelector({
    container: 'view-selector-container'
  });

  // Render the view selector to the page.
  viewSelector.execute();


  /**
   * Create a new DataChart instance with the given query parameters
   * and Google chart options. It will be rendered inside an element
   * with the id "chart-container".
   */
  var dataChart = new gapi.analytics.googleCharts.DataChart({
    query: {
      metrics: 'ga:sessions',
      dimensions: 'ga:date',
      'start-date': '30daysAgo',
      'end-date': 'yesterday'
    },
    chart: {
      container: 'chart-container',
      type: 'LINE',
      options: {
        width: '100%'
      }
    }
  });


  /**
   * Render the dataChart on the page whenever a new view is selected.
   */
  viewSelector.on('change', function(ids) {
    dataChart.set({query: {ids: ids}}).execute();
  });

});
</script>
  <!-- /.content-wrapper -->