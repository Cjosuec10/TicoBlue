@extends('layout.administracion')
@section('content')
    <div class="pagetitle">
        <h1>@yield('page-title', 'Administración')</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
            <li class="breadcrumb-item active">@yield('breadcrumb')</li>
        </ol>




</div>
        </nav>
    </div>
@endsection
