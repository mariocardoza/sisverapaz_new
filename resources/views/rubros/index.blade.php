@extends('layouts.app')

@section('migasdepan')
<h1>
  Rubros
</h1>
<ol class="breadcrumb">
  <li><a href="{{ url('/home') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
  <li class="active">Listado de Rubros</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <p></p>
      <div class="box-header"><br>
        <div class="btn-group pull-right">
          <a href="javascript:void(0)" id="btnmodalagregar" title="Agregar nuevo" class="btn btn-success"><span class="fa fa-plus-circle"></span></a>
          <a href="{{ url('/rubros?estado=1') }}" title="Rubros activos" class="btn btn-primary">Activos</a>
        <a href="{{ url('/rubros?estado=2') }}" title="Rubros inactivos" class="btn btn-primary">Papelera</a>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
      <table class="table table-striped table-bordered table-hover" id="example2">
        <thead>
          <th>N°</th>
          <th>Categoría rubro</th>
          <th>Nombre </th>
          <th>Porcentaje</th>
          <th>¿Aplica formula?</th>
          <th>Estado</th>
          <th>Acciones</th>
        </thead>
        <tbody>
            @foreach($rubros as $key => $rubro)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $rubro->categoriarubro->nombre }}</td>
              <td>{{ $rubro->nombre }}</td>
              <td>{{ $rubro->porcentaje*100 }}%</td>
              <td>{{ $rubro->es_formula ? 'Si' : 'No' }}</td>
              <td>{{ $rubro->estado ==1  ? 'Activo' : 'Inactivo' }}</td>
              <td>
                @if($rubro->estado == 1)
                {{ Form::open(['method' => 'POST', 'id' => 'baja', 'class' => 'form-horizontal'])}}
                <div class="btn-group">
                  <a href="javascript:(0)" id="edit" data-id="{{ $rubro->id }}" title="Editar" class="btn btn-warning"><span class="fa fa-edit"></span></a>
                  <button class="btn btn-danger" title="Desactivar" type="button" onclick={{ "baja(".$rubro->id.",'rubros')" }}><span class="fa fa-thumbs-o-down"></span></button>
                  {{ Form::close()}}
                  @else
                  {{ Form::open(['method' => 'POST', 'id' => 'alta', 'class' => 'form-horizontal'])}}
                  <button class="btn btn-success" title="Activar" type="button" onclick={{ "alta(".$rubro->id.",'rubros')" }}><span class="fa fa-thumbs-o-up"></span></button>
                </div>
                {{ Form::close()}}
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="pull-right"></div>
      </div>
    </div>
  </div>
</div>
@include('partials.log_tarifas')

@include("rubros.modales")
@endsection

@section("scripts")
<script>
  $(document).ready(function(e){
    rubros();
    $(document).on("click", "#btnmodalagregar",
      function(e){
        $("#modal_registrar").modal("show");
      });

    $(document).on("click", "#btnguardar", function(e){
      e.preventDefault();
      var datos = $("#form_rubro").serialize();
      modal_cargando();
      $.ajax({
        url:"rubros",
        type:"post",
        data:datos,
        success:function(retorno){
          if(retorno.response){
            toastr.success("Registrado con éxito");
            $("#modal_registrar").modal("hide");
            window.location.reload();
          }
          else{
            toastr.error("Falló");
            swal.closeModal();
          }
        },
        error:function(error){
          console.log(error);
          /*$(error.responseJSON.errors).each(
            function(index,valor){
              console.log(valor);
              toastr.error(valor.nombre);
            });*/
            (error.responseJSON.errors.nombre) ? toastr.error(error.responseJSON.errors.nombre ) : '';
            (error.responseJSON.errors.porcentaje) ? toastr.error(error.responseJSON.errors.porcentaje ) : '';
            error.responseJSON.errors.categoriarubro ? toastr.error(error.responseJSON.errors.categoriarubro ) : '';
          swal.closeModal();
        }
      });
    });

    $(document).on("click", "#edit", function(){
      var id = $(this).attr("data-id");
      $.ajax({
        url:"rubros/"+id+"/edit",
        type:"get",
        data:{},
        success:function(retorno){
          if(retorno.response){
            $("#modal_editar").modal("show");
            $("#e_nombre").val(retorno.data.nombre);
            $("#e_porcentaje").val(retorno.data.porcentaje*100);
            $("#e_es_formula").val(retorno.data.es_formula);
            $("#e_categoriarubro_id").val(retorno.data.categoriarubro_id);
            $(".chosen-select-width").trigger('chosen:updated');
            $("#elid").val(retorno.data.id);
          }
          else{
            toastr.error("error");
          }
        }
      });
    });

    $(document).on("click", "#btneditar", function(e){
      var id = $("#elid").val();
      var form = $("#form_edit").serialize();
      modal_cargando();
      $.ajax({
        url: "/rubros/"+id,
        type: "put",
        dataType:'json',
        data: form,
        success: function(retorno){
          if(retorno.ok){
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
          /*$(error.responseJSON.errors)each(function(index,valor){
            toastr.error(valor.nombre);
          });*/
          (error.responseJSON.errors.nombre) ? toastr.error(error.responseJSON.errors.nombre ) : '';
          (error.responseJSON.errors.porcentaje) ? toastr.error(error.responseJSON.errors.porcentaje ) : '';
          error.responseJSON.errors.categoriarubro ? toastr.error(error.responseJSON.errors.categoriarubro ) : '';
          
          swal.closeModal();
        }
      });
    });
  });

  function rubros(){
        $.ajax({
            url:'rubros',
            type:'get',
            dataType:'json',
            success: function(json){
                if(json[0]==1){
                    $(".tbrubro>tbody").empty();
                    $(".tbrubro>tbody").html(json[2]);
                }
            }
        });
    }
</script>

@endsection