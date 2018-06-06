@extends('layout')

@section('content')
    <h1>{{ $title }}</h1>
    @if(! empty($contenedores))
    <ul>
        @foreach ($contenedores as $contenedor)
            <li>{{ $contenedor }} </li>
        @endforeach
    </ul>
    @else
        <p>No hay contenedores registrados.</p>
    @endif
@endsection