@extends('layouts.app')

@section('migasdepan')
<h1>Tipo de servicio</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/home') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
    <li class="active">Listado de Servicios</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listado</h3>
                <div class="btn-group pull-right">
                    <a href="javascript:void(0)" id="btnmodalagregar" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span></a>
                    <a href="{{ url('/tiposervicios?estado=1') }}" class="btn btn-primary">Activos</a>
                    <a href="{{ url('/tiposervicios?estado=2') }}" class="btn btn-primary">Papelera</a>
                </div>
            </div>
            <!-- Header -->
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered table-hover" id="example2">
                    <thead>
                        <th>N°</th>
                        <th>Nombre</th>
                        <th>Costo</th>
                        <th>Vigente desde</th>
                        <th>Tipo cobro</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        @foreach($tipoServicios as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nombre }}</td>
                            <td>${{ $item->costo }}</td>
                            <td>{{ $item->updated_at->format('d/m/Y') }} </td>
                            <td>{{ $item->isObligatorio ? 'Fijo' : 'Variable' }}</td>
                            <td>{{ $item->estado == 1 ? 'Activo' : 'Inactivo'}}</td>
                            <td>
                                @if($item->estado == 1)
                                {{ Form::open(['method' => 'POST', 'id' => 'baja', 'class' => 'form-horizontal']) }}
                                <a href="javascript:(0)" id="edit" data-id="{{$item->id}}" class="btn btn-warning btn-sm"><span class="fa fa-edit"></span></a>
                                <button class="btn btn-danger btn-sm" type="button" onclick={{ "baja(".$item->id.",'tiposervicios')" }}><span class="fa fa-thumbs-o-down"></span></button>
                                {{ Form::close() }}
                                @else
                                {{ Form::open(['method' => 'POST', 'id' => 'alta', 'class' => 'form-horizontal']) }}
                                <button class="btn btn-success btn-sm" type="button" onclick={{ "alta(".$item->id.",'tiposervicios')" }}><span class="fa fa-thumbs-o-up"></span></button>
                                {{ Form::close() }}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br><br>
                
                <div class="pull-right">
                    
                </div>
            </div> <!--box header -->
        </div>
    </div>
</div>
@include('partials.log_tarifas')
@include("tiposervicios.modales")
@endsection

@section('scripts')
<script>
    $(document).ready(function(e){
        $(document).on("click", "#btnmodalagregar", function(e){
            $("#modal_registrar").modal("show");
        });

        $(document).on("click", "#btnguardar", function(e){
            e.preventDefault();
            var datos = $("#form_tiposervicio").serialize();
            modal_cargando();
            $.ajax({
                url:"tiposervicios",
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
                    console.log();
                    /*$(error.responseJSON.errors).each(function(index,valor){
                        toastr.error(valor.nombre);
                    });*/
                    (error.responseJSON.errors.nombre) ? toastr.error(error.responseJSON.errors.nombre ) : '';
                    (error.responseJSON.errors.costo) ? toastr.error(error.responseJSON.errors.costo ) : '';
                    error.responseJSON.errors.isObligatorio ? toastr.error(error.responseJSON.errors.isObligatorio ) : '';
          
                    swal.closeModal();
                }
            });
        });
        $(document).on("click", "#edit", function(){
            var id = $(this).attr("data-id");
            $.ajax({
                url:"tiposervicios/"+id+"/edit",
                type:"get",
                data:{},
                success:function(retorno){
                    if(retorno.response){
                        $("#modal_editar").modal("show");
                        $("#e_nombre").val(retorno.data.nombre);
                        $("#e_costo").val(retorno.data.costo);
                        $("#e_isObligatorio").val(retorno.data.isObligatorio);
                        $("#elid").val(retorno.data.id);
                        $(".chosen-select-width").trigger('chosen:updated');

                    }
                    else{
                        toastr.error("error");
                    }
                }
            });
        });//Modal edit

        $(document).on("click", "#btneditar", function(e){
            var id = $("#elid").val();
            var form = $("#form_edit").serialize();
            modal_cargando();
            $.ajax({
                url: "tiposervicios/"+id,
                type: "put",
                data: form,
                success:function(retorno){
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
                    (error.responseJSON.errors.nombre) ? toastr.error(error.responseJSON.errors.nombre ) : '';
                    (error.responseJSON.errors.costo) ? toastr.error(error.responseJSON.errors.costo ) : '';
                    error.responseJSON.errors.isObligatorio ? toastr.error(error.responseJSON.errors.isObligatorio ) : '';
          
                    swal.closeModal();
                }
            });
        });// btn editar
    });
</script>
@endsection
