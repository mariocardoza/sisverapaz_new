@extends('layouts.app')

@section('migasdepan')
<h1>
        Usuarios
        <small>Ver contrato <b>{{ $contrato->nombree }}</b></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/contratos') }}"><i class="fa fa-dashboard"></i>Contratos</a></li>
        <li class="active">Ver</li>
      </ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">Datos de Contrato</div>
                <!DOCTYPE html>
                <html>
                ALCALDIA MUNICIPAL DE VERAPAZ, DEPARTAMENTO DE SAN VICENTE
                <p>CONTRATO</p>
                </html>

                <!DOCTYPE html>
                <html>
                NOSOTROS: ______________________________, de ___________ años de edad, ___________, del domicilio de Verapaz, Departamento de San Vicente, portador de mi Documento Único de Identidad Número _________________________, con mi Número de Identificación Tributaria _____________________________________; actuando en nombre y representación, en mi carácter de Alcalde Municipal, de la Alcaldía Municipal de Verapaz, Departamento de San Vicente, con Número de Identificación Tributaria UN MIL TRECE- CIENTO UN MIL SETENTA Y NUEVE - CERO CERO UNO - UNO;  situación que compruebo con la Credencial emitida por el Tribunal Supremo Electoral, en la que consta que he sido electo al cargo en mención, para el período constitucional que comprende del primero de mayo del año dos mil quince al treinta de abril del año dos mil dieciocho y certificación de acta número ____, acuerdo número ____________ de cesión ordinaria de fecha __________ del año dos mil ___________, los que me conceden facultades para firmar en el carácter en que actúo contrato como el presente; que en lo sucesivo y en el transcurso del presente instrumento me denominaré "El Contratante" por una parte y por la otra el señor 
                </html>

                <!--AQUI VOY    22222222222222222222-->

                <div class="panel-body">
                        <div class="form-group{{ $errors->has('nombree') ? ' has-error' : '' }}">
                            <label for="nombree" class="col-md-4 control-label">Nombre de la Empresa o Representante: </label>
                            <label for="nombree" class="col-md-4 control-label">{{$contrato->nombree}}</label><br>
                            
                        </div>

                         <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                            <label for="direccion" class="col-md-4 control-label">Dirección: </label>
                            <label for="nombree" class="col-md-4 control-label">{{$contrato->direccion}}</label><br>
                            
                        </div>

                        <div class="form-group{{ $errors->has('telefonoe') ? ' has-error' : '' }}">
                            <label for="telefonoe" class="col-md-4 control-label">Telefono de la Empresa o Representante: </label>
                            <label for="nombree" class="col-md-4 control-label">{{$contrato->telefonoe}}</label><br>
                            
                        </div>

                        <div class="form-group{{ $errors->has('emaile') ? ' has-error' : '' }}">
                            <label for="emaile" class="col-md-4 control-label">E-Mail Empresa: </label>
                            <label for="nombree" class="col-md-4 control-label">{{$contrato->emaile}}</label><br>
                            
                        </div>

                        <div class="form-group{{ $errors->has('nombrer') ? ' has-error' : '' }}">
                            <label for="nombrer" class="col-md-4 control-label">Nombre de Represetante: </label>
                            <label for="nombree" class="col-md-4 control-label">{{$contrato->nombrer}}</label><br>
                            
                        </div>

                        <div class="form-group{{ $errors->has('telfijor') ? ' has-error' : '' }}">
                            <label for="telfijor" class="col-md-4 control-label">Telefono fijo Representante (si lo hay): </label>
                            <label for="nombree" class="col-md-4 control-label">{{$contrato->teldijor}}</label><br>
                            
                        </div>

                        <div class="form-group{{ $errors->has('celr') ? ' has-error' : '' }}">
                            <label for="celr" class="col-md-4 control-label">Celular Representante: </label>
                            <label for="nombree" class="col-md-4 control-label">{{$contrato->celr}}</label><br>
                           
                        </div>

                        <div class="form-group{{ $errors->has('emailr') ? ' has-error' : '' }}">
                            <label for="emailr" class="col-md-4 control-label">Dirección email del Representante:</label>
                            <label for="nombree" class="col-md-4 control-label">{{$contrato->emailr}}</label><br>
                            
                        </div>

                        <a href="{{ url('/contratos/'.$contrato->id.'/edit') }}" class="btn btn-warning">Editar</a> |
                      {{ Form::open(['route' => ['contratos.destroy', $contrato->id ], 'method' => 'DELETE', 'class' => 'form-horizontal'])}}
                        <button class="btn btn-danger" type="submit">Eliminar</button>
                      {{ Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
