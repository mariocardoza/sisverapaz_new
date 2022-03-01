@extends('layouts.app')

@section('migasdepan')
<h1>
        Contribuyentes
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="{{ url('/contribuyentes') }}"><i class="fa fa-home"></i> Contribuyentes</a></li>
        <li class="active">Ver</li>
      </ol>
@endsection

@section('content')
<div class="panel">
    <div class="row">
        <div class="col-md-12">
          <div class="page-header" style="overflow: hidden;">
            <div class="pull-left">
              <i class="fa fa-user"></i> {{$c->nombre}}<br />
              <small style="margin-top: 0px; margin-left: 28px">DUI: {{$c->dui}}</small>
            </div>
            <div class="btn-group pull-right"> 
            @if($c->estado==1)         
              <button title="Desactivar" class="btn btn-danger baja" data-id="{{$c->id}}">
                  <i class="fa fa-thumbs-o-down"></i>
              </button>
            @else 
            <button title="Activar" class="btn btn-success restaurar" data-id="{{$c->id}}">
                <i class="fa fa-thumbs-o-up"></i>
            </button>
            @endif
              <button class="btn btn-warning" data-id="{{$c->id}}" id="edi_contri" title='Editar contribuyente'>
                <i class="fa fa-edit"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="invoice-info" >   
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <b>NIT:</b> {{$c->nit}}<br>
              <b>Teléfono:</b> {{$c->telefono}}<br>
              <b>Género:</b> {{$c->sexo}}<br>
              <b>Fecha de registro:</b> {{$c->nacimiento!='' ? $c->nacimiento->format('d/m/Y') : ''}}<br>
             </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
             <b>Dirección: </b>      
              <address>
                {{$c->direccion}}
              </address><br>
              @if($c->estado==2)
              <b>Contribuyente desabilitado el: </b> {{$c->fechabaja->format("d/m/Y")}}<br>
              <b>Por: </b> {{$c->motivo}} <br>
              @endif
            </div>
            <div class="col-sm-4">
              <button type="button" id="emitir_solvencia" class="btn btn-primary pull-right">Emitir solvencia</button>
            </div>
          </div>
      </div>

      <div class="row" style="clear:both;padding-top:30px;">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#inmuebles" data-toggle="tab">Inmuebles</a></li>
                <li><a href="#negocios" data-toggle="tab">Negocios</a></li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="inmuebles" style="max-height: 580px; overflow-y: scroll; overflow-y: auto;">
                    <div class="col-xs-12 table-responsive" style="padding-top: 30px;">
                        <div class="col-xs-12">
                            <div class="btn-group pull-right">
                              <button class="btn btn-success" tooltip-placement='left' id="nuevo_inmueble" title="Agregar inmueble">
                                <i class="fa fa-plus-circle"></i>
                              </button>
                            </div>
                        </div>
                        <table class="table no-margin">
                          <thead>
                            <tr>
                              <th class="text-center"># Catastral</th>
                              <th class="text-center"># Escritura</th>
                              <th class="text-center">Metro Acera</th>
                              <th class="text-center">Área</th>
                              <th class="text-center">Ubicación</th>
                              <th class="text-center">Estado</th>
                              <th class="text-center"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($c->inmuebles as $i)
                            <tr>
                                <td class="text-center">{{$i->numero_catastral}}</td>
                                <td class="text-center"><span class="label label-success">{{$i->numero_escritura}}</span></td>
                                <td class="text-center">{{number_format($i->metros_acera,2)}}</td>
                                <td class="text-center">{{number_format($i->largo_inmueble*$i->ancho_inmueble,2)}}M2</td>
                                <td class="text-center">
                                  <button data-lat="{{$i->latitude}}" data-id="{{$i->id}}" data-lng="{{$i->longitude}}" id="mapa_inmueble" class="btn btn-primary" title="Ven en mapa">Ver Ubicación</button>
                                </td>
                                <td class="text-center">
                                  @if($i->estado==1)
                                  <span class="label label-success">
                                    Activo
                                  </span>
                                  @else 
                                  <span class="label label-danger">
                                    Inactivo
                                  </span>
                                  @endif
                                </td>
                                <td class="text-center">
                                  <div class="btn-group text-align">
                                    <button data-id="{{$i->id}}" title="Editar datos" class="btn btn-warning edit_inmueble">
                                      <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-success verservicios" title="Impuestos aplicados" data-id="{{$i->id}}">
                                      <i class="fa fa-fw fa-dollar"></i>
                                    </button>
                                    @if($i->estado==1)
                                        <button class="btn btn-danger">
                                            <i class="fa fa-thumbs-o-down" title="Desactivar"></i>
                                        </button>
                                        @else 
                                        <button class="btn btn-success">
                                        <i class="fa fa-thumbs-o-up" title="Activar"></i>
                                        </button>
                                        @endif
                                  </div>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                </div>
                <div class="tab-pane" id="negocios" style="max-height: 580px; overflow-y: scroll; overflow-y: auto;">
                    <div class="col-xs-12">
                        <div class="btn-group pull-right">
                          <button class="btn btn-success" title='Agregar Negocio' id="nuevo_negocio">
                            <i class="fa fa-plus-circle"></i>
                          </button>
                        </div>
                      </div>
                      <table class="table no-margin">
                        <thead>
                          <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Rubro</th>
                            <th class="text-center">Capital</th>
                            <th class="text-center">Porcentaje</th>              
                            <th class="text-center">Cobro</th>
                            <th class="text-center"></th>
                            <th class="text-center">Estado</th>
                            <th class="text-center"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($c->negocios as $i=> $n)
                          <tr>
                            <td class="text-center">{{$i+1}}</td>
                            <td class="text-center">{{$n->nombre}}</td>              
                            <td class="text-center"><span class="label label-success">{{$n->rubro->nombre}}</span></td>
                            @if($n->es_granja)
                            <td class="text-center">{{$n->numero_cabezas}} cabezas</td>
                            @else 
                            <td class="text-center">${{number_format($n->capital,2)}}</td>
                            @endif
                            @if($n->rubro->es_formula)
                            <td class="text-center">Ley de arbitrio</td>
                            <td class="text-center">${{number_format(\App\Arbitrio::calculo_impuesto($n->capital),2)}}</td>
                            @elseif($n->es_granja)
                            <td class="text-center">Granja</td>
                            <td class="text-center">${{number_format($n->precio_cabezas,2)}}</td>
                            @else 
                            <td class="text-center">{{number_format(($n->rubro->porcentaje*100),2)}}% </td>
                            <td class="text-center">${{number_format($n->capital*$n->rubro->porcentaje,2)}}</td>
                            @endif
                            
                            <td class="text-center">
                              <button data-lat="{{$n->lat}}" data-lng="{{$n->lng}}" data-id="{{$n->id}}" id="mapa_negocio" class="btn btn-primary" title="Ver en mapa">Ver Ubicación</button>
                            </td>
                            <td class="text-center">
                                @if($n->estado==1)
                                <span class="label label-success">
                                  Activo
                                </span>
                                @else 
                                <span class="label label-danger">
                                  Inactivo
                                </span>
                                @endif
                            </td>
                            <td class="text-center">
                              <div class="btn-group text-align">
                                <button data-id="{{$n->id}}" class="btn btn-warning edit_negocio">
                                  <i class="fa fa-edit" title="Editar datos"></i>
                                </button>
                                @if($n->estado==1)
                                <button class="btn btn-danger" title="Desactivar">
                                    <i class="fa fa-thumbs-o-down"></i>
                                  </button>
                                @else 
                                <button class="btn btn-success" title="Activar">
                                  <i class="fa fa-thumbs-o-up"></i>
                                </button>
                                @endif
                                <a href="{{ url('contribuyentes/recibosn/'.$n->id) }}" class="btn btn-primary" title="Imprimir"><i class="fa fa-print"></i></a>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
      </div>
</div>
<div id="modal_aqui"></div>
@include('contribuyentes.modales')
@endsection

@section('scripts')
<script src="{{asset('js/contribuyente_show.js?cod='.date("Yidisus"))}}"></script>
<script>
  
  var elid='<?php echo $c->id ?>'
  $(function(){
    //emitir solvencia
    $("#emitir_solvencia").on("click",function(e){
      e.preventDefault();
      $.ajax({
        url:'/contribuyentes/solvencia/'+elid,
        type:'get',
        dataType:'json',
        success: function(json){
          if(json[0]==1){
            if(json[2]){
              modal_cargando();
                  var url = '/contribuyentes/pdfsolvencia/'+elid;
                  $('#verpdf').attr('src', url);
                  let interval =setInterval(function(){ 
                    $("#modal_pdf").modal("show");
                    swal.closeModal();
                    clearInterval(interval);
                  }, 5000);
            }else{
              swal('Aviso',json[3],'warning');
            }
          }else{
            swal('Aviso','Ocurrió un error en la petición, intente nuevamente','warning');
          }
        },error:function(error){
          swal('Aviso','Ocurrió un error en la petición, intente nuevamente','warning');
        }
      })
    });
  });

</script>
@endsection
