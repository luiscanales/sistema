@extends('layout')

@section('content')
    <br>
    <br>
    <br>
    <br>
    <br>
    <html>
        <head>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <script type="text/javascript">
            google.charts.load('current', {'packages':['table']});
            google.charts.setOnLoadCallback(drawTable);
      
            function drawTable() {
              var data = new google.visualization.DataTable();
              data.addColumn('string', 'Ubicación');
              data.addColumn('number', 'Nivel [%]');
              data.addColumn('string', 'INCENDIO');
              data.addColumn('string', 'GAS');
              data.addColumn('string', 'INCIDENTE');
              data.addRows([
                @foreach ($contenedores as $res)
                    ['{{$res->UBICACION}}',{v:{{$res->NIVEL}}},'{{$res->INCENDIO}}','{{$res->GAS}}','{{$res->INCIDENTE}}'],
                @endforeach
              ]);
      
              var table = new google.visualization.Table(document.getElementById('table_div'));
      
              table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
            }
          </script>
        </head>
        <body>
          <div id="table_div"></div>
        </body>
    </html>
@endsection