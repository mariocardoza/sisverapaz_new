@extends('layouts.app')

@section('migasdepan')
<h1>
	Bienes e Insumos
</h1>
<ol class="breadcrumb">
	<li><a href="{{ url('/home') }}"><i class="fa fa-home"></i>Inicio</a></li>
	<li class="active">Listado de Bienes e Insumos</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<p></p>
		<div class="box-header">
			<br>
			<div class="btn-group pull-right">
				<a href="javascript:void(0)" id="btnmodalagregar" title="Agregar bien o insumo" class="btn btn-success"><span class="fa fa-plus-circle"></span></a>
				<a href="{{ url('/materiales?estado=1') }}" title="Registros activos" class="btn btn-primary">Activos</a>
				<a href="{{ url('/materiales?estado=2') }}" title="Registros inactivos" class="btn btn-primary">Papelera</a>
			</div>
		</div>

		<div class="box-body table-responsive">
			<table class="table table-striped table-bordered table-hover" id="example2">
				<thead>
					<th><center>N°</center></th>
					<th><center>Nombre de catálogo</center></th>
					<th><center>Precio estimado</center></th>
					<th><center>Tipo</center></th>
					<th><center>Acciones</center></th>
					<?php $contador = 0 ?>
				</thead>
			<tbody>
				@foreach($materiales as $key => $material)
				<tr>
					<td><center>{{ $key+1 }}</center></td>
					<td>{{ $material->nombre }}</td>
					<td>{{ $material->precio_estimado }}</td>
					<td>
						@if($material->servicio==0)
						No es servicio
						@else
						Es servicio
						@endif
					</td>
					<td>
						@if($material->estado == 1)
						{{ Form::open(['method' => 'POST', 'id' => 'baja', 'class' => 'form-horizontal'])}}
						<div class="btn-group">
							<a href="javascript:(0)" id="edit" data-id="{{$material->id}}" title="Editar" class="btn btn-warning"><span class="fa fa-edit"></span></a>
							<button class="btn btn-danger" title="Desactivar" type="button" onclick={{ "baja(".$material->id.",'materiales')" }}><span class="fa fa-thumbs-o-down"></span></button>
						</div>
						{{ Form::close()}}
						@else
						{{ Form::open(['method' => 'POST', 'id' => 'alta', 'class' => 'form-horizontal'])}}
						<button class="btn btn-success" type="button" onclick={{ "alta(".$material->id.",'material')" }}><span class="fa fa-thumbs-o-up"></span></button>
						{{ Form::close()}}
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
			</table>
			<div class="pull-right">
				
			</div>
		</div>
	</div>
	</div>
	<div id="aqui_modal"></div>
</div>


@include("materiales.modales")
@endsection

@section("scripts")
<script>
	$(document).ready(function(e){
		$(document).on("click","#btnmodalagregar", function(e){
			$("#modal_registrar").modal("show");
		});

		$(document).on("click","#btnguardar", function(e){
			e.preventDefault();
			var datos = $("#form_material").serialize();
			modal_cargando();
			$.ajax({
				url:"materiales",
				type:"post",
				data:datos,
				success: function(retorno){
					if(retorno[0] == 1){
						toastr.success("Registrado con éxito");
						$("#modal_registrar").modal("hide");
						window.location.reload();
					}
					else{
						toastr.error("Falló");
						swal.closeModal();
					}
				},

				error: function(error){
					console.log();
					$(error.responseJSON.errors).each(
						function(index,valor){
							toastr.error(valor.nombre);
						});
					swal.closeModal();
				}
			});
		});

		$(document).on("click", "#edit", function(){
			var id = $(this).attr("data-id");
			$.ajax({
				url:"materiales/"+id+"/edit",
				type:"get",
				data:{},
				success: function(retorno){
					if(retorno[0] == 1){
						$("#aqui_modal").empty();
						$("#aqui_modal").html(retorno[2]);
						$("#md_material_edit").modal("show");
					}
					else{
						toastr.error("error");
					}
				}
			});
		});//modal editar

		$(document).on("click", "#editar_material", function(e){
			var id = $(this).attr('data-id');
			var datos = $("#form_ematerial").serialize();
			modal_cargando();
			$.ajax({
				url:"materiales/"+id,
				type:"put",
				data:datos,
				success: function(retorno){
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
				error: function(error){
					console.log();
					$(error.responseJSON.errors).each(function(index,valor){
						toastr.error(valor.nombre);
					});
					swal.closeModal();
				}
			});
		});
		$(document).on()
	});
</script>
@endsection