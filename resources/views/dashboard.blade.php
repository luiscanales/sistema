@extends('layout')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
            </button>
        </div>
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
                        ['{{$res->FECHA}}' , {{$res->NIVEL}},{{$res->NIVEL2}},{{$res->NIVEL3}}],
                    @endforeach   
                  ]);
                  var options = {
                    chart: {
                      title: 'Estado de Contenedores',
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
@endsection
