@extends('layout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Ruta Sugerida</h1>
</div>
    <html>
        <head>
            {!!$map['js']!!}
        </head>
        <body>
            {!!$map['html']!!}
            <div id="directionsDiv"></div>
        </body>
    </html>
@endsection