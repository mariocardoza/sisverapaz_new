@extends('layouts.app')

@section('migasdepan')
<h1>
        Proyectos
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/proyectos') }}"><i class="fa fa-dashboard"></i> Proyectos</a></li>
        <li class="active">Inventario del proyecto</li>
      </ol>
@endsection

@section('content')
<div class="row">
<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-striped table-bordered table-hover" id="example2">
          <thead>
                  <th>N°</th>
                  <th>Descripción</th>
                  <th>Cantidad disponible</th>
                  <th>Proyecto</th>
                  <th>Accion</th>
                  @php
                    $correlativo=0;
                  @endphp
                </thead>
                <tbody>
                  @foreach($inventarios as $inventario)
                    <tr>
                      @php
                        $correlativo++;
                      @endphp
                      <td>{{$correlativo}}</td>
                      <td>{{$inventario->descripcion}}</td>
                      <td>{{$inventario->cantidad}}</td>
                      <td>{{$inventario->proyecto->nombre}}</td>
                      <td>
                        <div class="btn-group">
                          <a onclick="{{ "movimiento(".$inventario->id.")" }}" class="btn btn-danger btn-xs" href="#"><span class="fa fa-cloud-download"></span></a>
                          <a class="btn btn-primary btn-xs" href="#"><span class="fa fa-exchange"></span></a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <script>
                function movimiento(id){
                  var cantidad=0;
                  var idm=0;
                  var idp=0;
                  $.get('/'+carpeta()+'/public/inventarios/getmaterial/'+ id , function(data){
            		        //var dataJson = JSON.stringify({ id: data[i].fondocat.id, monto: data[i].monto })
            		  			$("#modaldescuento").modal("show");
            		  			$(data).each(function(key, value){
                          $("#material").text(value.descripcion);
                          cantidad=value.cantidad;
                          idm=value.id;
                          idp=value.proyecto_id;
            		  			});
            	    	});

                    $("#descontar").on("click" ,function(e){
                      var desc=$("#canti").val();
                      if( desc > cantidad ){
                        alert('es mayor')
                      }else{
                        actualizar(idm,desc,idp);
                      }
                    });

                    $("#cerrar").on("click", function(e){
                      $("#canti").val("");
                      $("#modaldescuento").modal("hide");
                    });

                    function actualizar(idm,desc,idp){
                      var ruta ="/"+carpeta()+"/public/inventarios";
                  		var token = $('meta[name="csrf-token"]').attr('content');

                      $.ajax({
                        url: ruta,
                  			headers: {'X-CSRF-TOKEN':token},
                  			type: 'POST',
                  			dataType: 'json',
                        data: {idm,desc,idp},
                        success: function(msj){
                          console.log(msj);
                          if(msj.mensaje==='exito'){
                            toastr.success('Cantidad actualizada con éxito');
                            window.location.href = "/"+carpeta()+"/public/inventarios?proyecto="+msj.proyecto;
                          }else {
                            toastr.error('Ocurrió un error, contacte al administrador')
                          }
                        },
                        error: function(msj){
                          toastr.error('Ocurrió un error, contacte al administrador')
                        }
                      });
                    }
                }
              </script>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
</div>
@endsection

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modaldescuento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">Registre el movimiento de inventario
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="panel-body">
                  <div class="form-group">
                    <div id="material"></div>
                  </div>
                    <div class="form-group">
                      <label for="" class="col-md-4">Digite la cantidad a descontar</label>
                      <div class="col-md-6">
                        {{Form::number('',null,['class' => 'form-control', 'id' => 'canti'])}}
                      </div>
                    </div>
                </div>
                <div class="panel-footer">
                  <button type="button" id="descontar" class="btn btn-primary">Aceptar</button>
                    <button type="button" class="btn btn-default" id="cerrar">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
