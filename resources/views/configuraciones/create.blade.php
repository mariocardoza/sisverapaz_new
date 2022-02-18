@extends('layouts.app')

@section('migasdepan')
<h1>
	Configuraciones
</h1>
<ol class="breadcrumb">
	<li><a href="{{ url('/cuentas') }}"><i class="fa fa-home"></i>Inicio</a></li>
	<li class="active">Configuraciones de la alcaldía</li> </ol>
@endsection

@section('content')
<div class="">
	<div class="row">
        <div class="col-md-12">
            @include('errors.validacion')
            <div class="nav-tabs-custom" style=" ">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#alcaldia" data-toggle="tab">Datos de la alcaldía</a></li>
                  <li><a href="#logo" data-toggle="tab">Logo alcaldía</a></li>
                  <li><a href="#logo_gobierno" data-toggle="tab">Logo gobierno</a></li>
                  <li><a href="#alcalde" data-toggle="tab">Datos del alcalde</a></li>
                  {{--<li><a href="#limites" data-toggle="tab">Límites de los proyectos</a></li>--}}
                  <li><a href="#porcentajes" data-toggle="tab">Porcentajes</a></li>
                  <li><a href="#retenciones" data-toggle="tab">Retenciones</a></li>
                  <li><a href="#emergencia" data-toggle="tab">Emergencia</a></li>
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane" id="alcaldia" style="max-height: 580px; overflow-y: scroll; overflow-y: auto;">
                    <div class="panel-body">

                        @if($configuraciones != null)
                          {{ Form::model($configuraciones, array('method' => 'put', 'class' => '' , 'route' => array('configuraciones.ualcaldia', $configuraciones->id))) }}
                        @else
                          {{ Form::open(['action'=> 'ConfiguracionController@alcaldia', 'class' => '']) }}
                        @endif
                        @include('configuraciones.alcaldia')
                        @if($configuraciones != null)
                          <div class="form-group">
                              <div class="col-md-6 col-md-offset-4">
                                  <button type="submit" class="btn btn-success">
                                      <span> Guardar</span>
                                  </button>
                              </div>
                          </div>
                        @else
                          <div class="form-group">
                              <div class="col-md-6 col-md-offset-4">
                                  <button type="submit" class="btn btn-success">
                                      <span> Guardar</span>
                                  </button>
                              </div>
                          </div>
                      @endif
            
                      {{Form::close()}}
                      </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="logo">
                    <p class="text-center">Haga click sobre la imagen, seleccione el logo de su elección y le aparecerá la opción de guardar</p>
                    <div class="panel-body text-center">
                        <h3 class="text-center">Modificar logo de la alcaldía</h3>
                        @if($configuraciones!='')
                        <img src="{{ $configuraciones->url_path }}" id="img_file" width="150" height="200" class="user-image" alt="User Image">
                        <form method='post' action="{{ url('configuraciones/logo/'.$configuraciones->id) }}" enctype='multipart/form-data'>
                        @else 
                        <img src="{{ asset('img/logos/escudo.png') }}" id="img_file" width="150" height="200" class="user-image" alt="User Image">
                        <form method='post' action="{{ url('configuraciones/logog') }}" enctype='multipart/form-data'>
                        @endif
                                  {{csrf_field()}}
                                
                          <div class='form-group text-center'>
                            <input type="file" class="hidden" name="logo" id="file_1" />
                            <div class='text-danger'>{{$errors->first('avatar')}}</div>
                          </div>
                          <button type='submit' class='btn btn-success elsub' style="display: none;">Cambiar</button>
                        
                              </form>
                    </div>
                  </div>
                  <div class="tab-pane" id="logo_gobierno">
                    <p class="text-center">Haga click sobre la imagen, seleccione el logo de su elección y le aparecerá la opción de guardar</p>
                    <div class="panel-body text-center">
                        <h3 class="text-center">Modificar logo del Gobierno central</h3>
                        @if($configuraciones!='')
                        <img src="{{ $configuraciones->url_gob }}" id="img_gobierno" width="150" height="200" class="user-image" alt="User Image">
                        <form method='post' action="{{ url('configuraciones/logo_gobierno/'.$configuraciones->id) }}" enctype='multipart/form-data'>
                        @else 
                        <img src="{{ asset('img/logos/escudo.png') }}" id="img_gobierno" width="150" height="200" class="user-image" alt="User Image">
                        <form method='post' action="{{ url('configuraciones/logo_gob') }}" enctype='multipart/form-data'>
                        @endif
                                  {{csrf_field()}}
                                
                          <div class='form-group text-center'>
                            <input type="file" class="hidden" name="logo" id="file_2" />
                            <div class='text-danger'>{{$errors->first('avatar')}}</div>
                          </div>
                          <button type='submit' class='btn btn-success elsub2' style="display: none;">Cambiar</button>
                        
                              </form>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="alcalde">
                      <div class="panel">
                        <div class="panel-body">
                            @if($configuraciones != null)
                              {{ Form::model($configuraciones, array('method' => 'put', 'class' => '','autocomplete'=>'off' , 'route' => array('configuraciones.ualcalde', $configuraciones->id))) }}
                            @else
                              {{ Form::open(['action'=> 'ConfiguracionController@alcalde', 'class' => '','autocomplete'=>'off']) }}
                            @endif
                            @include('configuraciones.alcalde')
                            @if($configuraciones != null)
                              <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                  <button type="submit" class="btn btn-success">
                                    <span> Guardar</span>
                                  </button>
                                </div>
                              </div>
                            @else
                            <div class="form-group">
                              <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                  <span> Guardar</span>
                                </button>
                              </div>
                            </div>
                          @endif
                          {{Form::close()}}
                          </div>
                      </div>
                  </div>

                  <div class="tab-pane" id="limites">
                    <div class="panel">
                        <div class="panel-body">
                            @if($configuraciones != null)
                              {{ Form::model($configuraciones, array('method' => 'put', 'class' => '','autocomplete'=>'off' , 'route' => array('configuraciones.ulimites', $configuraciones->id))) }}
                            @else
                              {{ Form::open(['action'=> 'ConfiguracionController@limitesproyecto', 'class' => '','autocomplete'=>'off']) }}
                            @endif
                            @include('configuraciones.limites')
                            @if($configuraciones != null)
                              <div class="form-group">
                                <div class="col-md-6 ">
                                  <button type="submit" class="btn btn-success">
                                    <span> Guardar</span>
                                  </button>
                                </div>
                              </div>
                            @else
                            <div class="form-group">
                              <div class="col-md-6">
                                <button type="submit" class="btn btn-success">
                                  <span> Guardar</span>
                                </button>
                              </div>
                            </div>
                          @endif
                          {{Form::close()}}
                          </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="porcentajes">
                    <div class="panel">
                      <div class="panel-body">
                        <div class="row">
                          @foreach($porcentajes as $p)
                          <div class="col-md-3">
                            <label for="" class="control-label"> {{$p->tipo}} {{$p->nombre}}</label>
                            <div class="input-group">
                              <input type="number" min="0" value="{{$p->porcentaje}}"  name="porcentaje" class="form-control {{$p->nombre_simple}}">
                              <span class="input-group-btn">
                                <button type="button" data-porcen="{{$p->nombre_simple}}" data-id="{{$p->id}}" class="btn btn-success porcen"><i class="fa fa-refresh"></i></button>
                              </span>
                            </div><p></p>
                          </div>
                          @endforeach 
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="retenciones">
                    <div class="panel">
                      <div class="panel body">
                        <div class="row">
                          @foreach($retenciones as $r)
                          <div class="col-md-3">
                            <label for="" class="control-label">% {{$r->nombreCompleto($r->nombre)}}</label>
                            <div class="input-group">
                              <input type="number" min="0" value="{{$r->porcentaje}}"  name="porcentaje" class="form-control {{$r->nombre}}">
                              <span class="input-group-btn">
                                <button type="button" data-reten="{{$r->nombre}}" data-id="{{$r->id}}" class="btn btn-success reten"><i class="fa fa-refresh"></i></button>
                              </span>
                            </div><p></p>
                          </div>
                          @endforeach 
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="emergencia">
                    <div class="panel-body">
                        <h3 class="text-center text-center">Declaratorias de emergencia</h3>
                        <button class="btn btn-success pull-right nueva_declaratoria" type="button">Nueva declaratoria</button>
                        <br>
                        <br>
                        <table class="table table-stripped table-bordered" id="example2">
                          <thead>
                            <tr>
                              <th>N°</th>
                              <th>Acuerdo</th>
                              <th>Motivo</th>
                              <th>Inicio</th>
                              <th>Fin</th>
                              <th>Estado</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($emergencias as $i=> $e)
                                <tr>
                                  <td>{{$i+1}}</td>
                                  <td>{{$e->numero_acuerdo}}</td>
                                  <td>{{$e->detalle}}</td>
                                  <td>{{$e->fecha_inicio->format("d/m/Y")}}</td>
                                  <td>{{$e->fecha_fin}}</td>
                                  <td>
                                    @if($e->estado==1)
                                    <label for="" class="label label-primary col-sx-12">Activa</label>
                                    @else
                                    <label for="" class="label label-success col-sx-12">Finalizada</label>
                                    @endif
                                  </td>
                                  <td>
                                    <button class="btn btn-success" id="finalizar_emergencia" data-id="{{$e->id}}"><i class="fa fa-check"></i></button>
                                  </td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                      
                    </div>
                  </div>
                  
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>
        </div>
  </div>
 
</div>

<div class="modal fade" tabindex="-1" id="modal_emergencia" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-sm">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Declaratoria de emergencia</h4>
      </div>
      <div class="modal-body">
          <form id="form_emergencia" class="">
              <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="" class="control-label">Número de acuerdo</label>
                      <input type="text" name="numero_acuerdo" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="" class="control-label">Detalle de la emergencia</label>
                      <input type="text" name="detalle" class="form-control">
                    </div>

                    <div class="form-group">
                      <label for="" class="control-label">Fecha de inicio</label>
                      <input type="text" name="fecha_inicio" class="form-control fechita" autocomplete="off">
                    </div>
                  </div>
            </div>
          
      </div>
      <div class="modal-footer">
        <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Registrar</button></center>
      </div>
    </form>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="modal_ayuda" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Ayuda</h4>
      </div>
      <div class="modal-body">
      <p>
        Esta sección es para modificar información básica de la alcaldía como pueden ser: nombre del alcalde, el logo de la alcaldía o los porcentajes de IVA y Renta.
      </p>
      </div>
      <div class="modal-footer">
        <center><button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button></center>
      </div>
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function(e){

    //Guardar o editar alcaldia


  	$(document).on("click", "#img_file", function (e) {
        $("#file_1").click();
    });

    $(document).on("click", "#img_gobierno", function (e) {
        $("#file_2").click();
    });

    ///declaratoria de emergencia
    $(document).on("click",".nueva_declaratoria",function(e){
      e.preventDefault();
      $("#modal_emergencia").modal("show");
    });

    $(document).on("submit","#form_emergencia",function(e){
      e.preventDefault();
      var datos=$("#form_emergencia").serialize();
      modal_cargando();
      $.ajax({
        url:'api/emergencia',
        type:'post',
        dataType:'json',
        data:datos,
        success: function(json){
          if(json[0]==1){
            toastr.success("Emergencia declarada con éxito");
            location.reload();
          }else{
            if(json[0]==2){
              swal.closeModal();
              swal('aviso',json[1],'warning');
            }else{
              toastr.error("Ocurrió un error en el servidor");
              swal.closeModal();
            }
          }
        },
        error: function(error){
          toastr.error("Ocurrió un error en el servidor");
          swal.closeModal();
        }
      });
    })

    $(document).on("change", "#file_1", function(event) {
        validar_archivo($(this));
    });

    $(document).on("change", "#file_2", function(event) {
        validar_archivo_gobierno($(this));
    });

    $(document).on("click","#subir_imagen",function(e){
    	var elid=$("#elid").val();
    	insertar_imagen($("#file_1"),elid);
    });

    ///cambiar el porcentaje
    $(document).on("click",".porcen",function(e){
      e.preventDefault();
      var id=$(this).attr("data-id");
      var input=$(this).attr("data-porcen");
      var elvalor=$("."+input).val();
      modal_cargando();
      $.ajax({
        url:'configuraciones/porcentajes',
        type:'POST',
        dataType:'json',
        data:{id,porcentaje:elvalor},
        success: function(json){
          if(json[0]==1){
            toastr.success("Porcentaje actualizado con éxito");
            location.reload();
          }else{
            swal.closeModal();
            toastr.error("Ocurrió un error");
          }
        },
        error: function(error){
          swal.closeModal();
        }
      });
    });

    //cambiar el porcentaje a las retenciones /// ISSS, AFP...
    $(document).on("click",".reten",function(e){
      e.preventDefault();
      var id=$(this).attr("data-id");
      var input=$(this).attr("data-reten");
      var elvalor=$("."+input).val();
      modal_cargando();
      $.ajax({
        url:'configuraciones/retenciones',
        type:'POST',
        dataType:'json',
        data:{id,porcentaje:elvalor},
        success: function(json){
          if(json[0]==1){
            toastr.success("Porcentaje de la retención actualizado con éxito");
            location.reload();
          }else{
            swal.closeModal();
            toastr.error("Ocurrió un error");
          }
        },
        error: function(error){
          swal.closeModal();
        }
      });
    });
  });

function validar_archivo(file){
  $("#img_file").attr("src","../img/photo.svg");//31.gif
      //var ext = file.value.match(/\.(.+)$/)[1];
       //Para navegadores antiguos
       if (typeof FileReader !== "function") {
          $("#img_file").attr("src",'../img/photo.svg');
          return;
       }
       var Lector;
       var Archivos = file[0].files;
       var archivo = file;
       var archivo2 = file.val();
       if (Archivos.length > 0) {

          Lector = new FileReader();

          Lector.onloadend = function(e) {
              var origen, tipo, tamanio;
              //Envia la imagen a la pantalla
              origen = e.target; //objeto FileReader
              //Prepara la información sobre la imagen
              tipo = archivo2.substring(archivo2.lastIndexOf("."));
              console.log(tipo);
              tamanio = e.total / 1024;
              console.log(tamanio);

              //Si el tipo de archivo es válido lo muestra, 

              //sino muestra un mensaje 

              if (tipo !== ".jpeg" && tipo !== ".JPEG" && tipo !== ".jpg" && tipo !== ".JPG" && tipo !== ".png" && tipo !== ".PNG") {
                  $("#img_file").attr("src",'../img/photo.svg');
                  $("#error_formato1").removeClass('hidden');
                  //$("#error_tamanio"+n).hide();
                  //$("#error_formato"+n).show();
                  console.log("error_tipo");
                  
              }
              else{
                  $("#img_file").attr("src",origen.result);
                  $("#error_formato1").addClass('hidden');
                  $(".elsub").show();
              }


         };
          Lector.onerror = function(e) {
          console.log(e)
         }
         Lector.readAsDataURL(Archivos[0]);
    }
  }

  function validar_archivo_gobierno(file){
  $("#img_gobierno").attr("src","../img/photo.svg");//31.gif
      //var ext = file.value.match(/\.(.+)$/)[1];
       //Para navegadores antiguos
       if (typeof FileReader !== "function") {
          $("#img_gobierno").attr("src",'../img/photo.svg');
          return;
       }
       var Lector;
       var Archivos = file[0].files;
       var archivo = file;
       var archivo2 = file.val();
       if (Archivos.length > 0) {

          Lector = new FileReader();

          Lector.onloadend = function(e) {
              var origen, tipo, tamanio;
              //Envia la imagen a la pantalla
              origen = e.target; //objeto FileReader
              //Prepara la información sobre la imagen
              tipo = archivo2.substring(archivo2.lastIndexOf("."));
              console.log(tipo);
              tamanio = e.total / 1024;
              console.log(tamanio);

              //Si el tipo de archivo es válido lo muestra, 

              //sino muestra un mensaje 

              if (tipo !== ".jpeg" && tipo !== ".JPEG" && tipo !== ".jpg" && tipo !== ".JPG" && tipo !== ".png" && tipo !== ".PNG") {
                  $("#img_gobierno").attr("src",'../img/photo.svg');
                  $("#error_formato1").removeClass('hidden');
                  //$("#error_tamanio"+n).hide();
                  //$("#error_formato"+n).show();
                  console.log("error_tipo");
                  
              }
              else{
                  $("#img_gobierno").attr("src",origen.result);
                  $("#error_formato1").addClass('hidden');
                  $(".elsub2").show();
              }


         };
          Lector.onerror = function(e) {
          console.log(e)
         }
         Lector.readAsDataURL(Archivos[0]);
    }
  }

function insertar_imagen(archivo,elid){
        var file =archivo.files;
        var formData = new FormData();
        formData.append('formData', $("#form_logo"));
        var data = new FormData();
         //Append files infos
         jQuery.each(archivo[0].files, function(i, file) {
            data.append('file-'+i, file);
         });

         console.log("data",data);
         $.ajax({  
            url: "configuraciones/logo",  
            type: "POST", 
            dataType: "json",  
            data: {data,elid},  
            cache: false,
            processData: false,  
            contentType: false, 
            context: this,
            success: function (json) {
                console.log(json);

            }
        });
    }
</script>
@endsection
