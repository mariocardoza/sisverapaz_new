@extends('layouts.app')

@section('migasdepan')
<h1>&nbsp;
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="{{ url('empleados')}}"><i class="fa fa-user"></i> Empleados</a></li>
        <li class="active">Detalle</li>
      </ol>
@endsection

@section('content')
<div class="">
    <div class="row">
        <div class="col-md-5">
          <p></p>
          <h1></h1>

          <div class="panel panel-primary">
            <div class="panel-heading">Datos del empleado </div>
            <div class="panel-body">
              <div class="box-body box-profile">
                @if($empleado->avatar!="")
                <img class="profile-user-img img-responsive img-circle" src="{{ $empleado->img_path }}" id="img_file" alt="User profile picture">
                @else
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('avatars/avatar.jpg') }}" id="img_file" alt="User profile picture">
              @endif
              <form method='post' action="{{ url('empleados/foto/'.$empleado->id) }}" enctype='multipart/form-data'>
                {{csrf_field()}}
              <input type="file" class="archivos hidden" id="file_1" name="foto" />
              <center><button type="submit" class="btn btn-primary" style="display: none;" id="elquecambia">Cambiar</button></center>
              </form>
              <div class="form-group">
                <div id="error_formato1" class="hidden"><span style="color: red;">Formato de archivo invalido. Solo se permiten los formatos JPG y PNG.</span>
                </div>
              </div>
              
              <h3 class="profile-username text-center">{{$empleado->nombre}}</h3>

              
                <?php if ($empleado->es_usuario=='si' && $empleado->user): ?>
                  <p class="text-muted text-center">
                    {{$empleado->user->roleuser->role->description}}</p>
                  <?php else: ?>
                  <p class="text-muted text-center">Empleado</p>
                <?php endif ?>
            

              </div>
              <table class="table">
                <tr>
                  <td>N??mero de DUI</td>
                  <th>{{$empleado->dui}}</th>
                </tr>
                <tr>
                  <td>N??mero de NIT</td>
                  <th>{{$empleado->nit}}</th>
                </tr>
                <tr>
                  <td>Sexo</td>
                  <th>{{$empleado->sexo}}</th>
                </tr>
                <tr>
                  <td>N??mero de tel??fono</td>
                  <th>{{$empleado->telefono_fijo}}</th>
                </tr>
                <tr>
                  <td>N??mero de celular</td>
                  <th>{{$empleado->celular}}</th>
                </tr>
                <tr>
                  <td>Direcci??n</td>
                  <th>{{$empleado->direccion}}</th>
                </tr>
                <tr>
                  <td>Fecha de nacimiento</td>
                  <th>{{$empleado->fecha_nacimiento->format("d/m/Y")}}</th>
                </tr>
                <tr>
                  <td>Edad</td>
                  <th>{{$empleado->fecha_nacimiento->age}}</th>
                </tr>
              </table>

              <center>
              @if(Auth()->user()->hasAnyRole(['admin','tesoreria']))
              <a id="modal_editar" class="btn btn-warning"><span>Editar</span> </a>
              @endif
                <!--button class="btn btn-danger" type="button" id="dar_baja"><span class="glyphicon glyphicon-trash"></span> Eliminar</button-->
              
              </center>
            </div>
          </div>
        </div>
        
        <div class="col-md-7">
          <div class="btn-group">
            <button class="btn btn-primary que_ver" type="button" data-opcion="1">Contrato</button>
            @if(isset($empleado->detalleplanilla))
            <button class="btn btn-primary que_ver" type="button" data-opcion="2">Informaci??n</button>
            <button class="btn btn-primary que_ver" type="button" data-opcion="3">Descuentos</button>
            @endif
          </div>
          <br><br>
          <div class="row" id="contrato">
            <div class="col-md-12">
              @if(isset($empleado->detalleplanilla))
              <div class="panel panel-primary" id="info_contra">
                <div class="panel-heading">Informaci??n del contrato</div>
                <div class="panel" style="padding: 6px;">
                  <table class="table">
                    <tr>
                      <td>Salario</td>
                      <th>${{number_format($empleado->detalleplanilla->salario,2)}}</th>
                    </tr>
                    <tr>
                      <td>??rea</td>
                      @if($empleado->detalleplanilla->cargo)
                      <th>{{$empleado->detalleplanilla->cargo->catcargo->nombre}}</th>
                      @else
                      <th>??rea no asignado</th>
                      @endif
                    </tr>
                    <tr>
                      <td>Cargo</td>
                      @if($empleado->detalleplanilla->cargo)
                      <th>{{$empleado->detalleplanilla->cargo->cargo}}</th>
                      @else
                      <th>Cargo no asignado</th>
                      @endif
                    </tr>
                    <tr>
                        <td>Unidad</td>
                        @if($empleado->detalleplanilla->unidad_id)
                        <th>{{$empleado->detalleplanilla->unidad->nombre_unidad}}</th>
                        @else
                        <th>Unidad de proyectos</th>
                        @endif
                      </tr>
                    <tr>
                      <td>Tipo de pago</td>
                      @if($empleado->detalleplanilla->tipo_pago==1)
                      <th>Planilla</th>
                      @else
                      <th>Honorarios</th>
                      @endif
                    </tr>
                    
                    <tr>
                      <td>Pago</td>
                      @if($empleado->detalleplanilla->pago==1)
                      <th>Mensual</th>
                      @else
                      <th>Quincenal</th>
                      @endif
                    </tr>
                    <tr>
                      <td>Fecha de inicio de labores</td>
                      @if($empleado->detalleplanilla->fecha_inicio!="")
                      <th>{{$empleado->detalleplanilla->fecha_inicio->format("d/m/Y")}}</th>
                      @else
                      <th>Fecha no registrada</th>
                      @endif
                    </tr>
                    <tr>
                      <td>N?? de acuerdo</td>
                      <th>{{$empleado->detalleplanilla->numero_acuerdo}}</th>
                    </tr>
                  </table>
                  @if(Auth()->user()->hasAnyRole(['admin','tesoreria']))
                  <center>
                    <button class="btn btn-warning" data-tipo="{{$empleado->detalleplanilla->tipo_pago}}" data-id="{{$empleado->detalleplanilla->id}}" id="formedit_contrato">Editar</button>
                  </center>
                  @endif
                </div>
              </div>
              @else
                <div class="panel panel-primary" id="reg_contrato">
                <div class="panel-heading">Registrar contrato</div>
                <div class="panel" style="padding: 10px;">
                 <form id="form_planilla" class="">
                   @include('detalleplanillas.formulario')
                   @if(Auth()->user()->hasAnyRole(['admin','tesoreria']))
                   <center><button class="btn btn-success" id="btn_guardarcontrato" type="button">Guardar</button></center>
                    @endif
                  </form>
                </div>
                
              </div>
              @endif
              <div class="panel panel-primary" id="edi_contrato" style="display:none;">
                <div class="panel-heading">Editar contrato</div>
                @if(isset($empleado->detalleplanilla))
                <div class="panel" style="padding: 10px;">
                    {{ Form::model($empleado->detalleplanilla, array('method' => 'put','id'=>'form_editcontra' , 'route' => array('detalleplanillas.update', $empleado->detalleplanilla->id))) }}
                    @include('detalleplanillas.formulario')

                   <div class="form-group">
                    <center>
                      <button class="btn btn-danger" id="btn_cancelarcontrato" type="button">Cancelar</button>
                      <button class="btn btn-success" id="btn_editarcontrato" type="button">Guardar</button>
                   </center>
                   </div>
                 </form>
                </div>
                @endif
              </div>
            </div>
          </div>
          <div class="row" id="general" style="display: none;">
            <?php if ($empleado->es_usuario=='si'): ?>
             <div class="col-md-12">
              <div class="panel panel-primary">
                <div class="panel-heading">Datos de inicio de sesi??n</div>
                <div class="panel-body">
                  <form action="">
                    <div class="form-group">
                      <?php if ($empleado->user): ?>
                        <table class="table">
                          <tr>
                            <td>Nombre de usuario</td>
                            <th>{{$empleado->user->username}}</th>
                          </tr>
                          <tr>
                            <td>Correo electr??nico</td>
                            <th>{{$empleado->user->email}}</th>
                          </tr>
                          @if(isset($empleado->user->unidad_id))
                          <tr>
                            <td>Unidad</td>
                            <th>{{$empleado->user->unidad->nombre_unidad}}</th>
                          </tr>
                          @endif
                        </table>
                        @if(Auth()->user()->hasAnyRole(['admin','tesoreria']))
                        <center><button class="btn btn-warning" id="editar_usuario" type="button">Editar</button></center>
                        @endif
                      <?php else: ?>
                        <center>
                          <h4 class="text-yellow"><i class="glyphicon glyphicon-warning-sign"></i> Advertencia</h4>
                          <span>Agregue los datos para iniciar sesi??n</span><br>
                          @if(Auth()->user()->hasAnyRole(['admin','tesoreria']))
                          <button class="btn btn-success" id="modal_usuarios">Agregar</button>
                          @endif
                        </center>
                      
                    <?php endif; ?>
                      
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <?php endif ?>
            <div class="col-md-12">
              <div class="panel panel-primary">
                <div class="panel-heading">Datos Bancarios</div>
                <div class="panel-body">
                  <form action="">
                    <div class="form-group">
                      <?php if ($empleado->num_cuenta): ?>
                        <table class="table">
                          <tr>
                            <td>Banco</td>
                            <th>{{$empleado->banco->nombre}}</th>
                          </tr>
                          <tr>
                            <td>N??mero de cuenta</td>
                            <th>{{$empleado->num_cuenta}}</th>
                          </tr>
                        </table>
                        <center><button class="btn btn-warning" id="editar_cuentas" type="button">Editar</button></center>
                      <?php else: ?>
                        <center>
                          <h4 class="text-yellow"><i class="glyphicon glyphicon-warning-sign"></i> Advertencia</h4>
                          <span>Agregue los datos bancarios para visualizar la informaci??n</span><br>
                          @if(Auth()->user()->hasAnyRole(['admin','tesoreria']))
                          <button class="btn btn-success" id="modal_banco">Agregar</button>
                          @endif
                        </center>
                      
                    <?php endif; ?>
                      
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="panel panel-primary">
                <div class="panel-heading">Datos del AFP</div>
                <div class="panel-body">
                  <form action="">
                    <div class="form-group">
                      <?php if ($empleado->num_afp): ?>
                    <table class="table">
                    <tr>
                      <td>Nombre de la AFP</td>
                      <th>{{$empleado->afp->nombre}}</th>
                    </tr>
                    <tr>
                      <td>N??mero del AFP</td>
                      <th>{{$empleado->num_afp}}</th>
                    </tr>
                  </table>
                  <center><button class="btn btn-warning" id="editar_afp" type="button">Editar</button></center>
                    <?php else: ?>
                      <center>
                        <h4 class="text-yellow"><i class="glyphicon glyphicon-warning-sign"></i> Advertencia</h4>
                        <span>Agregue datos del AFP para visualizar la informaci??n</span><br>
                        @if(Auth()->user()->hasAnyRole(['admin','tesoreria']))
                        <button type="button" class="btn btn-success" id="modal_afp">Agregar</button>
                        @endif
                      </center>
                  <?php endif ?>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="panel panel-primary">
                <div class="panel-heading">Datos del Seguro Social</div>
                <div class="panel-body">
                  <form action="">
                    <div class="form-group">
                      <?php if ($empleado->num_seguro_social): ?>
                    <table class="table">
                    <tr>
                      <td>N??mero del ISSS</td>
                      <th>{{$empleado->num_seguro_social}}</th>
                    </tr>
                  </table>
                  <center><button class="btn btn-warning" id="editar_isss" type="button">Editar</button></center>
                    <?php else: ?>
                      <center>
                        <h4 class="text-yellow"><i class="glyphicon glyphicon-warning-sign"></i> Advertencia</h4>
                        <span>Agregue datos del ISSS para visualizar la informaci??n</span><br>
                        @if(Auth()->user()->hasAnyRole(['admin','tesoreria']))
                        <button class="btn btn-success" id="modal_numisss">Agregar</button>
                        @endif
                      </center>
                  <?php endif; ?>
                    </div>
                  </form>
                </div>
              </div>
            </div> <!--fin col datos isss-->
          </div><!--Fin class row-->
          <div class="row" id="descuentos" style="display: none;">
            <div class="col-md-10">
              <div class="panel panel-primary">
                <div class="panel-heading">Pr??stamos</div>
                <div class="panel">
                  @if(Auth()->user()->hasAnyRole(['admin','tesoreria']))
                  <button class="btn btn-success btn-sm pull-right" type="button" id="modal_prestamo"><i class="fa fa-plus"></i></button><br>
                  @endif
                  <table class="table">
                  <thead>
                    <tr>
                      <th>N??</th>
                      <th>Banco</th>
                      <th>N?? de cuenta</th>
                      <th>Monto</th>
                      <th>Cuota</th>
                      <th>Tipo</th>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($empleado->prestamo as $key => $prestamo): ?>
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$prestamo->banco->nombre}}</td>
                        <td>{{$prestamo->numero_de_cuenta}}</td>
                        <td>${{number_format($prestamo->monto,2)}}</td>
                        <td>${{number_format($prestamo->cuota,2)}}</td>
                        <td>{{$prestamo->prestamotipo->nombre}}</td>
                        <td><button class="btn btn-primary btn-sm" type="button" id="ver_prestamo"><i class="fa fa-eye"></i></button></td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
                </div>
              </div>
              <br>

              <div class="panel panel-primary">
                <div class="panel-heading">Otros Descuentos</div>
                <div class="panel">
                  @if(Auth()->user()->hasAnyRole(['admin','tesoreria']))
                  <button class="btn btn-success btn-sm pull-right" type="button" id="modal_descuento"><i class="fa fa-plus"></i></button><br>
                  @endif
                  <table class="table">
                    <thead>
                      <tr>
                        <th>N??</th>
                        <th>Descuento</th>
                        <th>Cuota</th>
                        <td></td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($empleado->descuento as $key => $descuento): ?>
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>{{$descuento->categoriadescuento->nombre}}</td>
                          <td>${{number_format($descuento->cuota,2)}}</td>
                          <td><button class="btn btn-primary btn-sm" type="button" id="ver_prestamo"><i class="fa fa-eye"></i></button></td>
                        </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>


    </div>
    @include('empleados.modales')
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  elempleado='<?php echo $empleado->id ?>';
</script>
{!! Html::script('js/empleados.js?cod='.date('Yidisus')) !!}
@endsection
