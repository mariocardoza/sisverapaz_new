@extends('layouts.app')
@section('content')
    <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i><b> Oops! Página no encontrada.</b></h3>

            <p>
            <h4>
                No pudimos encontrar la página que buscas.
                Talvez tú desees <a href="{{url('/home')}}">Volver a la página de inicio</a>
            </h4>
            </p>
        </div>
        <!-- /.error-content -->
    </div>
@endsection