@extends('layouts.app')
@section('migasdepan')
<h1>
        Giros de Proveedores
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
        <li class="active">Listado de giros</li>
      </ol>
@endsection
@section('content')
<div class="row">
      <div class="col-xs-12">
          <div class="box">
            <p></p>
            <div class="box-header">
              <br>
                <div class="btn-group pull-right">
                    <a href="javascript:void(0)" id="btnmodalagregar" title="Agregar nuevo giro" class="btn btn-success"><span class="fa fa-plus-circle"></span></a>
                    <a href="{{ url('/giros?estado=1') }}" title="Giros activos" class="btn btn-primary">Activos</a>
                    <a href="{{ url('/giros?estado=2') }}" title="Giros desactivados" class="btn btn-primary">Papelera</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-striped table-bordered table-hover" id="example2">
                <thead>
                  <th><center>N°</center></th>
                  <th><center>Nombre</center></th>
                  <th><center>Acciones</center></th>
                </thead>
                <tbody>
                  @foreach($giros as $key => $giro)
                  <tr>
                    <td><center>{{ $key+1}}</center></td>
                    <td>{{ $giro->nombre}}</td>
                    <td><center>
                      @if($estado == 1 || $estado == "")
                        {{ Form::open(['method' => 'POST', 'id' => 'baja', 'class' => 'form-horizontal'])}}
                        <div class="btn-group">
                          <a href="javascript:(0)" id="edit" data-id="{{$giro->id}}" title="Editar" class="btn btn-warning"><span class="fa fa-edit"></span></a>
                          <button class="btn btn-danger" title="Desactivar" type="button" onclick={{ "baja(".$giro->id.",'giros')" }}><span class="fa fa-thumbs-o-down"></span></button>
                        </div>
                        {{ Form::close()}}
                      @else
                        {{ Form::open(['method' => 'POST', 'id' => 'alta', 'class' => 'form-horizontal'])}}
                          <button class="btn btn-success" type="button" title="Activar" onclick={{ "alta(".$giro->id.",'giros')" }}><span class="fa fa-thumbs-o-up"></span></button>
                        {{ Form::close()}}
                      @endif
                      </center>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
                
              <div class="pull-right">

              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
</div>

@include("giros.modales")
@endsection

@section("scripts")
<script>
  $(document).ready(function(e){
    $(document).on("click", "#btnmodalagregar", function(e){
      $("#modal_registrar").modal("show");
    });

    $(document).on("click", "#btnguardar", function(e){
      e.preventDefault();
      var datos=$("#form_giro").serialize();
      modal_cargando();
      $.ajax({
        url:"giros",
        type:"post",
        data:datos,
        success:function(retorno){
          if(retorno[0] == 1){
            toastr.success("Registrado con éxito");
            $("#modal_registrar").modal("hide");
            window.location.reload();
          }
          else{
            toastr.error("Falló, contacte al administrador");
            swal.closeModal();
          }
        },
        error:function(error){
          console.log();
          $(error.responseJSON.errors).each(function(
            index,valor){
            toastr.error(valor.nombre);
          });
          swal.closeModal();
        }
      });
    });

    $(document).on("click", "#edit", function(){
      var id = $(this).attr("data-id");
      $.ajax({
        url:"giros/"+id+"/edit",
        type:"get",
        data:{},
        success:function(retorno){
          if(retorno[0] == 1){
            $("#modal_editar").modal("show");
            $("#e_nombre").val(retorno[2].nombre);
            $("#elid").val(retorno[2].id);
          }
          else{
            toastr.error("error");
          }
        }
      });
    });   //Fin modal editar

    $(document).on("click", "#btneditar", function(e){
      var id = $("#elid").val();
      var nombre = $("#e_nombre").val();
      modal_cargando();
      $.ajax({
        url: "giros/"+id,
        type: "put",
        data: {nombre},
        success:function(retorno){
          if(retorno[0] == 1){
            toastr.success("Exitoso");
            $("#modal_editar").modal("hide");
            window.location.reload();
          }
          else{
            toastr.error("error");
            swal.closeModal();
          }
        },
        error:function(error){
          console.log();
          $(error.responseJSON.errors).each(function(
            index,valor){
            toastr.error(valor.nombre);
          });
          swal.closeModal();
        }
      });
    });       //Fin btneditar

    
  });
</script>
@endsection