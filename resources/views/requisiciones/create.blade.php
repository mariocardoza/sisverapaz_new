@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['action' => 'RequisicionController@store','class' => '','id' => 'form_requisicion']) }}
                    @include('requisiciones.formulario')
                    {{Form::hidden('conpresupuesto',1)}}
                    <br>
                    <!--button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                      Agregar requisiciones
                    </button-->
                    <br>
                    
                    
                    <center><div class="form-group">
                        <div class="">
                            <a href="{{route('requisiciones.porusuario')}}" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-success">
                                <span class=""></span>    Guardar
                            </button>
                        </div>
                    </div>
                    </center>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
{!! Html::script('js/requisicion.js?cod='.date('Yidisus')) !!}
@endsection
