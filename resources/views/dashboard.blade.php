@extends('layout')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>

    <html>
            <head>
              <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                  google.charts.load('current', {'packages':['line']});
                  google.charts.setOnLoadCallback(drawChart);
                function drawChart() {         
                  var data = new google.visualization.DataTable();
                  data.addColumn('string', 'Día');
                  data.addColumn('number', 'Vergara 432');
                  data.addColumn('number', 'Grajales 2395');
                  data.addColumn('number', 'Nataniel Cox 153');
                  data.addRows([
                    @foreach ($artefactos as $res)
                        ['{{$res->DAY}}' , {{$res->NIVEL}},{{$res->NIVEL2}},{{$res->NIVEL3}}],
                    @endforeach   
                  ]);
                  var options = {
                    chart: {
                      title: 'Estado Histórico de Contenedores',
                      subtitle: 'en porcentaje de llenado [%]'
                    },
                    width: 900,
                    height: 500,
                    axes: {
                      x: {
                        0: {side: 'top'}
                      }
                    }
                  };
            
                  var chart = new google.charts.Line(document.getElementById('line_top_x'));
            
                  chart.draw(data, google.charts.Line.convertOptions(options));
                }
              </script>
            </head>
            <body>
              <div id="line_top_x"></div>
            </body>
    </html>

    <html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task','Numero'],
          ['Incidentes',     {{$incidente}}],
          ['Sin Incidentes',   {{$noincidente}}]
        ]);

        var options = {
          title: 'Incidentes Mensuales'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>
@endsection
